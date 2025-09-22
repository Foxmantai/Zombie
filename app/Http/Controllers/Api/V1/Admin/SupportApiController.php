<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreSupportRequest;
use App\Http\Requests\UpdateSupportRequest;
use App\Http\Resources\Admin\SupportResource;
use App\Models\Support;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SupportApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('support_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SupportResource(Support::with(['team'])->get());
    }

    public function store(StoreSupportRequest $request)
    {
        $support = Support::create($request->all());

        foreach ($request->input('beweismittel', []) as $file) {
            $support->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('beweismittel');
        }

        return (new SupportResource($support))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Support $support)
    {
        abort_if(Gate::denies('support_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SupportResource($support->load(['team']));
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

        return (new SupportResource($support))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Support $support)
    {
        abort_if(Gate::denies('support_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $support->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
