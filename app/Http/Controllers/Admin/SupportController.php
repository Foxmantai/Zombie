<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroySupportRequest;
use App\Http\Requests\StoreSupportRequest;
use App\Http\Requests\UpdateSupportRequest;
use App\Models\Support;
use App\Models\Team;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SupportController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('support_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Support::with(['team'])->select(sprintf('%s.*', (new Support)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'support_show';
                $editGate      = 'support_edit';
                $deleteGate    = 'support_delete';
                $crudRoutePart = 'supports';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('titel', function ($row) {
                return $row->titel ? $row->titel : '';
            });
            $table->editColumn('ingame_name', function ($row) {
                return $row->ingame_name ? $row->ingame_name : '';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? Support::STATUS_SELECT[$row->status] : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $teams = Team::get();

        return view('admin.supports.index', compact('teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('support_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.supports.create');
    }

    public function store(StoreSupportRequest $request)
    {
        $support = Support::create($request->all());

        foreach ($request->input('beweismittel', []) as $file) {
            $support->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('beweismittel');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $support->id]);
        }

        return redirect()->route('admin.supports.index');
    }

    public function edit(Support $support)
    {
        abort_if(Gate::denies('support_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $support->load('team');

        return view('admin.supports.edit', compact('support'));
    }

    public function update(UpdateSupportRequest $request, Support $support)
    {
        $support->update($request->all());

        if (count($support->beweismittel) > 0) {
            foreach ($support->beweismittel as $media) {
                if (! in_array($media->file_name, $request->input('beweismittel', []))) {
                    $media->delete();
                }
            }
        }
        $media = $support->beweismittel->pluck('file_name')->toArray();
        foreach ($request->input('beweismittel', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $support->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('beweismittel');
            }
        }

        return redirect()->route('admin.supports.index');
    }

    public function show(Support $support)
    {
        abort_if(Gate::denies('support_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $support->load('team');

        return view('admin.supports.show', compact('support'));
    }

    public function destroy(Support $support)
    {
        abort_if(Gate::denies('support_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $support->delete();

        return back();
    }

    public function massDestroy(MassDestroySupportRequest $request)
    {
        $supports = Support::find(request('ids'));

        foreach ($supports as $support) {
            $support->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('support_create') && Gate::denies('support_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Support();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
