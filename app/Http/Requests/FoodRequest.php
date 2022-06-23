<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FoodRequest extends FormRequest
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
        $rules = [
            'heading'           => 'required|max:191',
            'stock'             => 'required|numeric|min:0',
            'price'             => 'required|numeric|min:0',
            'preparation_time'  => 'required|numeric|min:0',
            'history'           => 'nullable|string',
            'menu_id'           => 'required|exists:foods,id',
        ];
        switch ($this->method()) {
            case 'POST':
                $rules['slug']          =  'required|max:255|alpha_dash|unique:articles';
                break;
            case 'PATCH':
            case 'PUT':
                $rules['slug']          = 'required|max:255|alpha_dash|unique:articles,id,' . $this->id;
                break;
        }
        return $rules;
    }
}
