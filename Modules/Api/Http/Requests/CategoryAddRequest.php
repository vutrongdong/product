<?php

namespace Modules\Api\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryAddRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'slug' => "unique:categories,slug,".$this->id,
            'title' => "unique:categories,title,".$this->id,
        ];
    }

    public function messages()
    {
        return [
            'slug.unique' => "Tên không dấu không được trùng",
            'title.unique' => "Tiêu đề không được trùng",
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
