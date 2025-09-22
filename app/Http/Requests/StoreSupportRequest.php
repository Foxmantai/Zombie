<?php

namespace App\Http\Requests;

use App\Models\Support;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSupportRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('support_create');
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
            'kategorie' => [
                'required',
            ],
            'beweismittel' => [
                'array',
            ],
        ];
    }
}
