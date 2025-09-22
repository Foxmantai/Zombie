<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreKategorienRequest;
use App\Http\Requests\UpdateKategorienRequest;
use App\Http\Resources\Admin\KategorienResource;
use App\Models\Kategorien;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class KategorienApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('kategorien_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new KategorienResource(Kategorien::with(['team'])->get());
    }

    public function store(StoreKategorienRequest $request)
    {
        $kategorien = Kategorien::create($request->all());

        return (new KategorienResource($kategorien))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Kategorien $kategorien)
    {
        abort_if(Gate::denies('kategorien_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new KategorienResource($kategorien->load(['team']));
    }

    public function update(UpdateKategorienRequest $request, Kategorien $kategorien)
    {
        $kategorien->update($request->all());

        return (new KategorienResource($kategorien))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Kategorien $kategorien)
    {
        abort_if(Gate::denies('kategorien_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kategorien->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
