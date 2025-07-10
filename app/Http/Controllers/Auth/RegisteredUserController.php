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
use App\Http\Requests\UserRegisterRequest;

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
    public function store(UserRegisterRequest $request)
{
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
