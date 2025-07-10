<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'over_name' => ['required', 'string', 'max:10'],
            'under_name' => ['required', 'string', 'max:10'],
            'over_name_kana' => ['required', 'string', 'max:30', 'regex:/^[ァ-ヶー　]+$/u'],
            'under_name_kana' => ['required', 'string', 'max:30', 'regex:/^[ァ-ヶー　]+$/u'],
            'mail_address' => ['required', 'email', 'max:100', 'unique:users,mail_address'],
            'sex' => ['required', Rule::in([1, 2, 3])],
            'old_year' => ['required', 'integer'],
            'old_month' => ['required', 'integer'],
            'old_day' => ['required', 'integer'],
            'role' => ['required', Rule::in([1, 2, 3, 4])],
            'password' => ['required', 'confirmed', 'min:8', 'max:30'],
        ];
    }

    public function attributes(): array
    {
        return [
            'over_name' => '姓',
            'under_name' => '名',
            'over_name_kana' => 'セイ',
            'under_name_kana' => 'メイ',
            'mail_address' => 'メールアドレス',
            'sex' => '性別',
            'old_year' => '生年月日（年）',
            'old_month' => '生年月日（月）',
            'old_day' => '生年月日（日）',
            'role' => '役割',
            'password' => 'パスワード',
        ];
    }
}
