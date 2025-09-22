<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyDatenbankRequest;
use App\Http\Requests\StoreDatenbankRequest;
use App\Http\Requests\UpdateDatenbankRequest;
use App\Models\Datenbank;
use App\Models\Kategorien;
use App\Models\Team;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class DatenbankController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('datenbank_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Datenbank::with(['kategorie', 'team'])->select(sprintf('%s.*', (new Datenbank)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'datenbank_show';
                $editGate      = 'datenbank_edit';
                $deleteGate    = 'datenbank_delete';
                $crudRoutePart = 'datenbanks';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('spawn_name', function ($row) {
                return $row->spawn_name ? $row->spawn_name : '';
            });
            $table->addColumn('kategorie_kategorie', function ($row) {
                return $row->kategorie ? $row->kategorie->kategorie : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'kategorie']);

            return $table->make(true);
        }

        $kategoriens = Kategorien::get();
        $teams       = Team::get();

        return view('admin.datenbanks.index', compact('kategoriens', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('datenbank_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kategories = Kategorien::pluck('kategorie', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.datenbanks.create', compact('kategories'));
    }

    public function store(StoreDatenbankRequest $request)
    {
        $datenbank = Datenbank::create($request->all());

        return redirect()->route('admin.datenbanks.index');
    }

    public function edit(Datenbank $datenbank)
    {
        abort_if(Gate::denies('datenbank_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kategories = Kategorien::pluck('kategorie', 'id')->prepend(trans('global.pleaseSelect'), '');

        $datenbank->load('kategorie', 'team');

        return view('admin.datenbanks.edit', compact('datenbank', 'kategories'));
    }

    public function update(UpdateDatenbankRequest $request, Datenbank $datenbank)
    {
        $datenbank->update($request->all());

        return redirect()->route('admin.datenbanks.index');
    }

    public function show(Datenbank $datenbank)
    {
        abort_if(Gate::denies('datenbank_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $datenbank->load('kategorie', 'team');

        return view('admin.datenbanks.show', compact('datenbank'));
    }

    public function destroy(Datenbank $datenbank)
    {
        abort_if(Gate::denies('datenbank_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $datenbank->delete();

        return back();
    }

    public function massDestroy(MassDestroyDatenbankRequest $request)
    {
        $datenbanks = Datenbank::find(request('ids'));

        foreach ($datenbanks as $datenbank) {
            $datenbank->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
