<?php

namespace App\Http\Requests;

use App\Models\Werkbanke;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateWerkbankeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('werkbanke_edit');
    }

    public function rules()
    {
        return [
            'werkbank' => [
                'string',
                'nullable',
            ],
            'bauteile' => [
                'string',
                'nullable',
            ],
            'xp' => [
                'string',
                'nullable',
            ],
            'kategories.*' => [
                'integer',
            ],
            'kategories' => [
                'array',
            ],
            'lvl' => [
                'string',
                'nullable',
            ],
        ];
    }
}
