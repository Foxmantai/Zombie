<?php

namespace App\Http\Requests;

use App\Models\Fahrzeuge;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateFahrzeugeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('fahrzeuge_edit');
    }

    public function rules()
    {
        return [
            'fahrzeug_bild' => [
                'array',
            ],
            'fahrzeug_name' => [
                'string',
                'nullable',
            ],
            'spawn_name' => [
                'string',
                'nullable',
            ],
            'preis' => [
                'string',
                'nullable',
            ],
            'kofferraum_groesse' => [
                'string',
                'nullable',
            ],
            'kategories.*' => [
                'integer',
            ],
            'kategories' => [
                'array',
            ],
        ];
    }
}
