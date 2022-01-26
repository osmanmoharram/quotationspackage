<?php

namespace DOCore\DOQuot\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateQuotationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'client_id' => 'required|exists:org_clients,client_id',
            'tax' => 'nullable|numeric',
            'products' => 'required',
            // 'products.*.product_id' => 'required|numeric',
            // 'products.*.quantity' => 'required|numeric|gt:0.00',
            // 'products.*.unit_price' => 'required|numeric|gt:0.00'
        ];
    }

    public function messages()
    {
        return [
            'status.in' => 'status should be either approved or rejected',
            'products.required' => 'there are no products provided',
            'products.*.product_id.required' => 'product name is missing',
            'products.*.quantity.required' => 'quantity is missing',
            'products.*.quantity.gt' => 'quantity must be greater than 0',
            'products.*.unit_price.required' => 'unit price is missing',
            'products.*.unit_price.gt' => 'unit price must be greater than 0'
        ];
    }
}
