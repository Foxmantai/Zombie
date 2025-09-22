<?php

namespace App\Http\Requests;

use App\Models\Kategorien;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyKategorienRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('kategorien_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:kategoriens,id',
        ];
    }
}
