<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyTebexLizenzenRequest;
use App\Http\Requests\StoreTebexLizenzenRequest;
use App\Http\Requests\UpdateTebexLizenzenRequest;
use App\Models\Team;
use App\Models\TebexLizenzen;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class TebexLizenzenController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('tebex_lizenzen_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = TebexLizenzen::with(['team'])->select(sprintf('%s.*', (new TebexLizenzen)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'tebex_lizenzen_show';
                $editGate      = 'tebex_lizenzen_edit';
                $deleteGate    = 'tebex_lizenzen_delete';
                $crudRoutePart = 'tebex-lizenzens';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('haendler', function ($row) {
                return $row->haendler ? $row->haendler : '';
            });

            $table->editColumn('tebexid', function ($row) {
                return $row->tebexid ? $row->tebexid : '';
            });
            $table->editColumn('preis', function ($row) {
                return $row->preis ? $row->preis : '';
            });
            $table->editColumn('url', function ($row) {
                return $row->url ? $row->url : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $teams = Team::get();

        return view('admin.tebexLizenzens.index', compact('teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('tebex_lizenzen_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.tebexLizenzens.create');
    }

    public function store(StoreTebexLizenzenRequest $request)
    {
        $tebexLizenzen = TebexLizenzen::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $tebexLizenzen->id]);
        }

        return redirect()->route('admin.tebex-lizenzens.index');
    }

    public function edit(TebexLizenzen $tebexLizenzen)
    {
        abort_if(Gate::denies('tebex_lizenzen_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tebexLizenzen->load('team');

        return view('admin.tebexLizenzens.edit', compact('tebexLizenzen'));
    }

    public function update(UpdateTebexLizenzenRequest $request, TebexLizenzen $tebexLizenzen)
    {
        $tebexLizenzen->update($request->all());

        return redirect()->route('admin.tebex-lizenzens.index');
    }

    public function show(TebexLizenzen $tebexLizenzen)
    {
        abort_if(Gate::denies('tebex_lizenzen_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tebexLizenzen->load('team');

        return view('admin.tebexLizenzens.show', compact('tebexLizenzen'));
    }

    public function destroy(TebexLizenzen $tebexLizenzen)
    {
        abort_if(Gate::denies('tebex_lizenzen_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tebexLizenzen->delete();

        return back();
    }

    public function massDestroy(MassDestroyTebexLizenzenRequest $request)
    {
        $tebexLizenzens = TebexLizenzen::find(request('ids'));

        foreach ($tebexLizenzens as $tebexLizenzen) {
            $tebexLizenzen->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('tebex_lizenzen_create') && Gate::denies('tebex_lizenzen_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new TebexLizenzen();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
