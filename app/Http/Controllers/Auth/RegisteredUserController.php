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
use Illuminate\Validation\Rule;
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
        'over_name' => ['required', 'string', 'max:10'],
        'under_name' => ['required', 'string', 'max:10'],
        'over_name_kana' => ['required', 'string', 'max:30', 'regex:/^[ァ-ヶー　]+$/u'],
        'under_name_kana' => ['required', 'string', 'max:30', 'regex:/^[ァ-ヶー　]+$/u'],
        'mail_address' => ['required', 'email', 'max:100', 'unique:users,mail_address'],
        'sex' => ['required', Rule::in([1, 2, 3])], // 1:男性, 2:女性, 3:その他
        'old_year' => ['required', 'integer'],
        'old_month' => ['required', 'integer'],
        'old_day' => ['required', 'integer'],
        'role' => ['required', Rule::in([1, 2, 3, 4])], // 1:国語, 2:数学, 3:英語, 4:生徒
        'password' => ['required', 'confirmed', 'min:8', 'max:30'],
    ]);
    if (!checkdate((int)$request->old_month, (int)$request->old_day, (int)$request->old_year)) {
        return back()->withErrors(['birth_day' => '存在しない日付です。'])->withInput();
    }


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
