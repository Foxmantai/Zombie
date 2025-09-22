<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreFahrzeugeRequest;
use App\Http\Requests\UpdateFahrzeugeRequest;
use App\Http\Resources\Admin\FahrzeugeResource;
use App\Models\Fahrzeuge;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FahrzeugeApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('fahrzeuge_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FahrzeugeResource(Fahrzeuge::with(['kategories', 'team'])->get());
    }

    public function store(StoreFahrzeugeRequest $request)
    {
        $fahrzeuge = Fahrzeuge::create($request->all());
        $fahrzeuge->kategories()->sync($request->input('kategories', []));
        foreach ($request->input('fahrzeug_bild', []) as $file) {
            $fahrzeuge->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('fahrzeug_bild');
        }

        return (new FahrzeugeResource($fahrzeuge))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Fahrzeuge $fahrzeuge)
    {
        abort_if(Gate::denies('fahrzeuge_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FahrzeugeResource($fahrzeuge->load(['kategories', 'team']));
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

        return (new FahrzeugeResource($fahrzeuge))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Fahrzeuge $fahrzeuge)
    {
        abort_if(Gate::denies('fahrzeuge_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fahrzeuge->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
