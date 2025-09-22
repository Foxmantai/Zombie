<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyFahrzeugeRequest;
use App\Http\Requests\StoreFahrzeugeRequest;
use App\Http\Requests\UpdateFahrzeugeRequest;
use App\Models\Fahrzeuge;
use App\Models\Kategorien;
use App\Models\Team;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class FahrzeugeController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('fahrzeuge_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Fahrzeuge::with(['kategories', 'team'])->select(sprintf('%s.*', (new Fahrzeuge)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'fahrzeuge_show';
                $editGate      = 'fahrzeuge_edit';
                $deleteGate    = 'fahrzeuge_delete';
                $crudRoutePart = 'fahrzeuges';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('fahrzeug_bild', function ($row) {
                if (! $row->fahrzeug_bild) {
                    return '';
                }
                $links = [];
                foreach ($row->fahrzeug_bild as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank"><img src="' . $media->getUrl('thumb') . '" width="50px" height="50px"></a>';
                }

                return implode(' ', $links);
            });
            $table->editColumn('fahrzeug_name', function ($row) {
                return $row->fahrzeug_name ? $row->fahrzeug_name : '';
            });
            $table->editColumn('spawn_name', function ($row) {
                return $row->spawn_name ? $row->spawn_name : '';
            });
            $table->editColumn('preis', function ($row) {
                return $row->preis ? $row->preis : '';
            });
            $table->editColumn('kofferraum_groesse', function ($row) {
                return $row->kofferraum_groesse ? $row->kofferraum_groesse : '';
            });
            $table->editColumn('herstellbar', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->herstellbar ? 'checked' : null) . '>';
            });
            $table->editColumn('im_shop', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->im_shop ? 'checked' : null) . '>';
            });
            $table->editColumn('kategorie', function ($row) {
                $labels = [];
                foreach ($row->kategories as $kategorie) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $kategorie->kategorie);
                }

                return implode(' ', $labels);
            });

            $table->rawColumns(['actions', 'placeholder', 'fahrzeug_bild', 'herstellbar', 'im_shop', 'kategorie']);

            return $table->make(true);
        }

        $kategoriens = Kategorien::get();
        $teams       = Team::get();

        return view('admin.fahrzeuges.index', compact('kategoriens', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('fahrzeuge_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kategories = Kategorien::pluck('kategorie', 'id');

        return view('admin.fahrzeuges.create', compact('kategories'));
    }

    public function store(StoreFahrzeugeRequest $request)
    {
        $fahrzeuge = Fahrzeuge::create($request->all());
        $fahrzeuge->kategories()->sync($request->input('kategories', []));
        foreach ($request->input('fahrzeug_bild', []) as $file) {
            $fahrzeuge->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('fahrzeug_bild');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $fahrzeuge->id]);
        }

        return redirect()->route('admin.fahrzeuges.index');
    }

    public function edit(Fahrzeuge $fahrzeuge)
    {
        abort_if(Gate::denies('fahrzeuge_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kategories = Kategorien::pluck('kategorie', 'id');

        $fahrzeuge->load('kategories', 'team');

        return view('admin.fahrzeuges.edit', compact('fahrzeuge', 'kategories'));
    }

    public function update(UpdateFahrzeugeRequest $request, Fahrzeuge $fahrzeuge)
    {
        $fahrzeuge->update($request->all());
        $fahrzeuge->kategories()->sync($request->input('kategories', []));
        if (count($fahrzeuge->fahrzeug_bild) > 0) {
            foreach ($fahrzeuge->fahrzeug_bild as $media) {
                if (! in_array($media->file_name, $request->input('fahrzeug_bild', []))) {
                    $media->delete();
                }
            }
        }
        $media = $fahrzeuge->fahrzeug_bild->pluck('file_name')->toArray();
        foreach ($request->input('fahrzeug_bild', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $fahrzeuge->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('fahrzeug_bild');
            }
        }

        return redirect()->route('admin.fahrzeuges.index');
    }

    public function show(Fahrzeuge $fahrzeuge)
    {
        abort_if(Gate::denies('fahrzeuge_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fahrzeuge->load('kategories', 'team');

        return view('admin.fahrzeuges.show', compact('fahrzeuge'));
    }

    public function destroy(Fahrzeuge $fahrzeuge)
    {
        abort_if(Gate::denies('fahrzeuge_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fahrzeuge->delete();

        return back();
    }

    public function massDestroy(MassDestroyFahrzeugeRequest $request)
    {
        $fahrzeuges = Fahrzeuge::find(request('ids'));

        foreach ($fahrzeuges as $fahrzeuge) {
            $fahrzeuge->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('fahrzeuge_create') && Gate::denies('fahrzeuge_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Fahrzeuge();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
