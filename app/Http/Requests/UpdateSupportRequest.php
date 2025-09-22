<?php

namespace App\Http\Requests;

use App\Models\Support;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSupportRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('support_edit');
    }

    public function rules()
    {
        return [
            'ingame_name' => [
                'string',
                'required',
            ],
            'titel' => [
                'string',
                'required',
            ],
            'grund' => [
                'required',
            ],
            'supporter' => [
                'string',
                'nullable',
            ],
            'kategorie' => [
                'required',
            ],
            'beweismittel' => [
                'array',
            ],
        ];
    }
}
