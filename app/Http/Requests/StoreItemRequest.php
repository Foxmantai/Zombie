<?php

namespace App\Http\Requests;

use App\Models\Item;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreItemRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('item_create');
    }

    public function rules()
    {
        return [
            'item_name' => [
                'string',
                'nullable',
            ],
            'spawn_name' => [
                'string',
                'nullable',
            ],
            'gewicht' => [
                'string',
                'nullable',
            ],
        ];
    }
}
