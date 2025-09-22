<?php

namespace App\Http\Requests;

use App\Models\Kategorien;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateKategorienRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('kategorien_edit');
    }

    public function rules()
    {
        return [
            'kategorie' => [
                'string',
                'nullable',
            ],
        ];
    }
}
