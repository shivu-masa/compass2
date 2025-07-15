<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MainCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // 認証済みユーザーのみ許可など必要であればここで制御
    }

    public function rules(): array
    {
        return [
            'main_category_name' => [
                'required',
                'string',
                'max:100',
                'unique:main_categories,main_category'
            ],
        ];
    }

    public function attributes(): array
    {
        return [
            'main_category_name' => 'メインカテゴリー名',
        ];
    }


}
