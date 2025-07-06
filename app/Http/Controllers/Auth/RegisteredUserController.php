<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use DB;

use App\Models\Users\Subjects;
use App\Models\Users\User;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $subjects = Subjects::all();
        return view('auth.register.register', compact('subjects'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
{

    // tryの外でバリデーション
    $request->validate([
        'over_name' => 'required',
        'under_name' => 'required',
        'over_name_kana' => 'required',
        'under_name_kana' => 'required',
        'mail_address' => 'required|email|unique:users,mail_address',
        'sex' => 'required',
        'old_year' => 'required',
        'old_month' => 'required',
        'old_day' => 'required',
        'role' => 'required',
        'password' => 'required|confirmed|min:8',
    ], [
        'over_name.required' => '姓は必須項目です。',
        'under_name.required' => '名は必須項目です。',
        'over_name_kana.required' => 'セイは必須項目です。',
        'under_name_kana.required' => 'メイは必須項目です。',
        'mail_address.required' => 'メールアドレスは必須項目です。',
        'mail_address.email' => '有効なメールアドレス形式で入力してください。',
        'mail_address.unique' => 'そのメールアドレスは既に登録されています。',
        'sex.required' => '性別を選択してください。',
        'old_year.required' => '生年月日の「年」を選択してください。',
        'old_month.required' => '生年月日の「月」を選択してください。',
        'old_day.required' => '生年月日の「日」を選択してください。',
        'role.required' => '役職を選択してください。',
        'password.required' => 'パスワードは必須項目です。',
        'password.confirmed' => '確認用パスワードと一致しません。',
        'password.min' => 'パスワードは8文字以上で入力してください。',
    ]);
    DB::beginTransaction();

    try {
        $user = User::create([
            'over_name' => $request->over_name,
            'under_name' => $request->under_name,
            'over_name_kana' => $request->over_name_kana,
            'under_name_kana' => $request->under_name_kana,
            'mail_address' => $request->mail_address,
            'sex' => $request->sex,
            'birth_day' => "{$request->old_year}-{$request->old_month}-{$request->old_day}",
            'role' => $request->role,
            'password' => bcrypt($request->password),
        ]);

        if ($request->role == 4 && $request->has('subject')) {
            $subjectIds = array_map('intval', (array) $request->subject);
            $user->subjects()->attach($subjectIds);
        }

        DB::commit();

        return redirect()->route('loginView')->with('success', '登録が完了しました。ログインしてください。');

    } catch (\Exception $e) {
        DB::rollback();
        return redirect()->back()->withErrors(['error' => '登録に失敗しました。'])->withInput();
    }
}
}
