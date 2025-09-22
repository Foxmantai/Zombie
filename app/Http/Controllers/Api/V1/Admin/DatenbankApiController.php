<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDatenbankRequest;
use App\Http\Requests\UpdateDatenbankRequest;
use App\Http\Resources\Admin\DatenbankResource;
use App\Models\Datenbank;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DatenbankApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('datenbank_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DatenbankResource(Datenbank::with(['kategorie', 'team'])->get());
    }

    public function store(StoreDatenbankRequest $request)
    {
        $datenbank = Datenbank::create($request->all());

        return (new DatenbankResource($datenbank))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Datenbank $datenbank)
    {
        abort_if(Gate::denies('datenbank_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DatenbankResource($datenbank->load(['kategorie', 'team']));
    }

    public function update(UpdateDatenbankRequest $request, Datenbank $datenbank)
    {
        $datenbank->update($request->all());

        return (new DatenbankResource($datenbank))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Datenbank $datenbank)
    {
        abort_if(Gate::denies('datenbank_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $datenbank->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
