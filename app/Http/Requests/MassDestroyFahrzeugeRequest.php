<?php

namespace App\Http\Requests;

use App\Models\Fahrzeuge;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyFahrzeugeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('fahrzeuge_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:fahrzeuges,id',
        ];
    }
}
