<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'main_category_id' => 'required|exists:main_categories,id',
            'sub_category_name' => [
                'required',
                'string',
                'max:100',
                'unique:sub_categories,sub_category'
            ],
        ];
    }

    public function attributes(): array
    {
        return [
            'main_category_id' => 'メインカテゴリー',
            'sub_category_name' => 'サブカテゴリー名',
        ];
    }
}
