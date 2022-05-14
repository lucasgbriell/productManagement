<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(){
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(){
        return [
            'description' => 'required|max:255|min:5',
            'category_id' => 'nullable|exists:categories,id|integer',
            'code' => 'required|max:255',
            'reference' => 'required|max:255',
            'quantity' => 'required|integer',
            'price' => 'required',
            'is_active' => 'nullable'
        ];
    }


    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
