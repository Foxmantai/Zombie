<?php

namespace App\Http\Requests;

use App\Models\Shop;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreShopRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('shop_create');
    }

    public function rules()
    {
        return [
            'shop_name' => [
                'string',
                'nullable',
            ],
            'item_name' => [
                'string',
                'nullable',
            ],
            'preis' => [
                'string',
                'nullable',
            ],
            'verkaufs_preis' => [
                'string',
                'nullable',
            ],
        ];
    }
}
