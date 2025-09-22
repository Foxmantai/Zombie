<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreTebexLizenzenRequest;
use App\Http\Requests\UpdateTebexLizenzenRequest;
use App\Http\Resources\Admin\TebexLizenzenResource;
use App\Models\TebexLizenzen;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TebexLizenzenApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('tebex_lizenzen_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TebexLizenzenResource(TebexLizenzen::with(['team'])->get());
    }

    public function store(StoreTebexLizenzenRequest $request)
    {
        $tebexLizenzen = TebexLizenzen::create($request->all());

        return (new TebexLizenzenResource($tebexLizenzen))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(TebexLizenzen $tebexLizenzen)
    {
        abort_if(Gate::denies('tebex_lizenzen_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TebexLizenzenResource($tebexLizenzen->load(['team']));
    }

    public function update(UpdateTebexLizenzenRequest $request, TebexLizenzen $tebexLizenzen)
    {
        $tebexLizenzen->update($request->all());

        return (new TebexLizenzenResource($tebexLizenzen))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(TebexLizenzen $tebexLizenzen)
    {
        abort_if(Gate::denies('tebex_lizenzen_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tebexLizenzen->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
