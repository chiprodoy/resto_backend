<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
           // 'order_id'=>'required',
            'product_id'=>'required',
            'item_name'=>'required',
            'satuan'=>'required',
            'price'=>'integer|min:1',
            'qty'=>'integer|min:1',
            'meja_id'=>'required'
        ];
    }
}
