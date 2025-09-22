<?php

namespace App\Http\Requests;

use App\Models\TebexLizenzen;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTebexLizenzenRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('tebex_lizenzen_create');
    }

    public function rules()
    {
        return [
            'haendler' => [
                'string',
                'nullable',
            ],
            'gekauft_am' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'tebexid' => [
                'string',
                'nullable',
            ],
            'preis' => [
                'string',
                'nullable',
            ],
            'url' => [
                'string',
                'nullable',
            ],
        ];
    }
}
