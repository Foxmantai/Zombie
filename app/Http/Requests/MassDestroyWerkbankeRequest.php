<?php

namespace App\Http\Requests;

use App\Models\Werkbanke;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyWerkbankeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('werkbanke_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:werkbankes,id',
        ];
    }
}
