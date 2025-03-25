<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TradeItemsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'item_id1' => 'required',
            'item_id2' => 'required'
        ];
    }
}
