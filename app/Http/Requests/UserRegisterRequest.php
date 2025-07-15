<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

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
            'old_year' => ['required'],
            'old_month' => ['required'],
            'old_day' => ['required'],
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

    public function withValidator($validator)
{
    $validator->after(function ($validator) {
        $year = (int) $this->input('old_year');
        $month = (int) $this->input('old_month');
        $day = (int) $this->input('old_day');

        // 正しい日付でない場合（例：2/31や6/31など）
        if (!checkdate($month, $day, $year)) {
            $validator->errors()->add('birth_day', '存在しない日付です。');
            return;
        }

        // 日付の範囲制限（2000年1月1日～今日まで）
        $birthDate = Carbon::createFromDate($year, $month, $day);
        $minDate = Carbon::create(2000, 1, 1);
        $today = Carbon::today();

        if ($birthDate->lt($minDate) || $birthDate->gt($today)) {
            $validator->errors()->add('birth_day', '生年月日は2000年1月1日から今日までの間で入力してください。');
        }
    });

}
}
