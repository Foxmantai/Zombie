<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyWerkbankeRequest;
use App\Http\Requests\StoreWerkbankeRequest;
use App\Http\Requests\UpdateWerkbankeRequest;
use App\Models\Item;
use App\Models\Kategorien;
use App\Models\Team;
use App\Models\Werkbanke;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class WerkbankeController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('werkbanke_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Werkbanke::with(['endergebnis', 'kategories', 'team'])->select(sprintf('%s.*', (new Werkbanke)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'werkbanke_show';
                $editGate      = 'werkbanke_edit';
                $deleteGate    = 'werkbanke_delete';
                $crudRoutePart = 'werkbankes';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('werkbank', function ($row) {
                return $row->werkbank ? $row->werkbank : '';
            });
            $table->addColumn('endergebnis_item_name', function ($row) {
                return $row->endergebnis ? $row->endergebnis->item_name : '';
            });

            $table->editColumn('bauteile', function ($row) {
                return $row->bauteile ? $row->bauteile : '';
            });
            $table->editColumn('xp', function ($row) {
                return $row->xp ? $row->xp : '';
            });
            $table->editColumn('kategorie', function ($row) {
                $labels = [];
                foreach ($row->kategories as $kategorie) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $kategorie->kategorie);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('lvl', function ($row) {
                return $row->lvl ? $row->lvl : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'endergebnis', 'kategorie']);

            return $table->make(true);
        }

        $items       = Item::get();
        $kategoriens = Kategorien::get();
        $teams       = Team::get();

        return view('admin.werkbankes.index', compact('items', 'kategoriens', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('werkbanke_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $endergebnis = Item::pluck('item_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $kategories = Kategorien::pluck('kategorie', 'id');

        return view('admin.werkbankes.create', compact('endergebnis', 'kategories'));
    }

    public function store(StoreWerkbankeRequest $request)
    {
        $werkbanke = Werkbanke::create($request->all());
        $werkbanke->kategories()->sync($request->input('kategories', []));

        return redirect()->route('admin.werkbankes.index');
    }

    public function edit(Werkbanke $werkbanke)
    {
        abort_if(Gate::denies('werkbanke_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $endergebnis = Item::pluck('item_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $kategories = Kategorien::pluck('kategorie', 'id');

        $werkbanke->load('endergebnis', 'kategories', 'team');

        return view('admin.werkbankes.edit', compact('endergebnis', 'kategories', 'werkbanke'));
    }

    public function update(UpdateWerkbankeRequest $request, Werkbanke $werkbanke)
    {
        $werkbanke->update($request->all());
        $werkbanke->kategories()->sync($request->input('kategories', []));

        return redirect()->route('admin.werkbankes.index');
    }

    public function show(Werkbanke $werkbanke)
    {
        abort_if(Gate::denies('werkbanke_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $werkbanke->load('endergebnis', 'kategories', 'team');

        return view('admin.werkbankes.show', compact('werkbanke'));
    }

    public function destroy(Werkbanke $werkbanke)
    {
        abort_if(Gate::denies('werkbanke_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $werkbanke->delete();

        return back();
    }

    public function massDestroy(MassDestroyWerkbankeRequest $request)
    {
        $werkbankes = Werkbanke::find(request('ids'));

        foreach ($werkbankes as $werkbanke) {
            $werkbanke->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
