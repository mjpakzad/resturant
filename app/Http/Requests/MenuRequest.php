<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
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
        ];
        switch ($this->method()) {
            case 'POST':
                $rules['slug']          =  'required|max:255|alpha_dash|unique:menus';
                break;
            case 'PATCH':
            case 'PUT':
                $rules['slug']          = 'required|max:255|alpha_dash|unique:menus,id,' . $this->id;
                break;
        }
        return $rules;
    }
}
