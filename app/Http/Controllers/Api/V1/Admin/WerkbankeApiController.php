<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWerkbankeRequest;
use App\Http\Requests\UpdateWerkbankeRequest;
use App\Http\Resources\Admin\WerkbankeResource;
use App\Models\Werkbanke;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WerkbankeApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('werkbanke_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new WerkbankeResource(Werkbanke::with(['endergebnis', 'kategories', 'team'])->get());
    }

    public function store(StoreWerkbankeRequest $request)
    {
        $werkbanke = Werkbanke::create($request->all());
        $werkbanke->kategories()->sync($request->input('kategories', []));

        return (new WerkbankeResource($werkbanke))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Werkbanke $werkbanke)
    {
        abort_if(Gate::denies('werkbanke_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new WerkbankeResource($werkbanke->load(['endergebnis', 'kategories', 'team']));
    }

    public function update(UpdateWerkbankeRequest $request, Werkbanke $werkbanke)
    {
        $werkbanke->update($request->all());
        $werkbanke->kategories()->sync($request->input('kategories', []));

        return (new WerkbankeResource($werkbanke))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Werkbanke $werkbanke)
    {
        abort_if(Gate::denies('werkbanke_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $werkbanke->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
