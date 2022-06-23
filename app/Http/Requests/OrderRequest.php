<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [];
        switch ($this->method()) {
            case 'POST':
                $rules = [
                    'foods.*'       => 'required|exists:foods,id',
                    'quantity.*'    => 'required|numeric|min:0',
                    'address'       => 'required|numeric|min:0',
                ];
                break;
            case 'PATCH':
            case 'PUT':
                $rules = [
                    'status'    => 'required|in:0,1'
                ];
                break;
        }
        return $rules;
    }
}
