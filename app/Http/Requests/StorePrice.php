<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePrice extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'current' => 'numeric|nullable',
            'people' => 'numeric|nullable',
            'price' => 'numeric|nullable|required_with:current,people,piece,unit,description',
            'description' => 'string|nullable',
            'parent_id' => 'numeric|nullable',
            'unit' => 'string|nullable'
        ];
    }
}
