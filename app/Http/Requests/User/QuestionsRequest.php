<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class QuestionsRequest extends FormRequest
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
            'title'   => 'required|max:250',
            'content' => 'required|max:1000',
            'tag_category_id' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'Title',
            'content' => 'Content',
            'tag_category_id' => 'Category'
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attributeは必須の項目です。',
            'max'      => ':max文字以内でお願いします。'
        ];
    }
}
