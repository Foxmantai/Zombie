<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyKategorienRequest;
use App\Http\Requests\StoreKategorienRequest;
use App\Http\Requests\UpdateKategorienRequest;
use App\Models\Kategorien;
use App\Models\Team;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class KategorienController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('kategorien_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Kategorien::with(['team'])->select(sprintf('%s.*', (new Kategorien)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'kategorien_show';
                $editGate      = 'kategorien_edit';
                $deleteGate    = 'kategorien_delete';
                $crudRoutePart = 'kategoriens';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('kategorie', function ($row) {
                return $row->kategorie ? $row->kategorie : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $teams = Team::get();

        return view('admin.kategoriens.index', compact('teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('kategorien_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.kategoriens.create');
    }

    public function store(StoreKategorienRequest $request)
    {
        $kategorien = Kategorien::create($request->all());

        return redirect()->route('admin.kategoriens.index');
    }

    public function edit(Kategorien $kategorien)
    {
        abort_if(Gate::denies('kategorien_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kategorien->load('team');

        return view('admin.kategoriens.edit', compact('kategorien'));
    }

    public function update(UpdateKategorienRequest $request, Kategorien $kategorien)
    {
        $kategorien->update($request->all());

        return redirect()->route('admin.kategoriens.index');
    }

    public function show(Kategorien $kategorien)
    {
        abort_if(Gate::denies('kategorien_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kategorien->load('team', 'kategorieItems', 'kategorieDatenbanks', 'kategorieFahrzeuges', 'kategorieWerkbankes');

        return view('admin.kategoriens.show', compact('kategorien'));
    }

    public function destroy(Kategorien $kategorien)
    {
        abort_if(Gate::denies('kategorien_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kategorien->delete();

        return back();
    }

    public function massDestroy(MassDestroyKategorienRequest $request)
    {
        $kategoriens = Kategorien::find(request('ids'));

        foreach ($kategoriens as $kategorien) {
            $kategorien->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
