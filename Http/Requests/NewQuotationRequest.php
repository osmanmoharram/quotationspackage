<?php

namespace DOCore\DOQuot\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewQuotationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'client_id' => 'required|exists:org_clients,client_id',
            'tax' => 'required|numeric',
            'validity' => 'nullable|numeric', 
            'products' => 'required',
            'products.*.product_id' => 'required|numeric',
            'products.*.quantity' => 'required|numeric|gt:0.00',
            'products.*.unit_price' => 'required|numeric|gt:0.00',
            'total' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'client_id.required' => 'client name is missing',
            'products.required' => 'there are no products provided',
            'products.*.product_id.required' => 'product name is missing',
            'products.*.quantity.required' => 'quantity is missing',
            'products.*.quantity.gt' => 'quantity must be greater than 0',
            'products.*.unit_price.required' => 'unit price is missing',
            'products.*.unit_price.gt' => 'unit price must be greater than 0',
            'products.*.subtotal.required' => 'subtotal is missing',
            'products.*.unit_price.gt' => 'subtotal must be greater than 0',
        ];
    }
}
