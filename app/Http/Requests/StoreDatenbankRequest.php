<?php

namespace App\Http\Requests;

use App\Models\Datenbank;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreDatenbankRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('datenbank_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'nullable',
            ],
            'spawn_name' => [
                'string',
                'nullable',
            ],
        ];
    }
}
