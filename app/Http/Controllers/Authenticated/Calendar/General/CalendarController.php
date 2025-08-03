<?php

namespace App\Http\Controllers\Authenticated\Calendar\General;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Calendars\General\CalendarView;
use App\Models\Calendars\ReserveSettings;
use App\Models\Calendars\Calendar;
use App\Models\USers\User;
use Auth;
use DB;

class CalendarController extends Controller
{
    public function show(){
        $calendar = new CalendarView(time());
        return view('authenticated.calendar.general.calendar', compact('calendar'));
    }

    public function reserve(Request $request)
{
    DB::beginTransaction();
    try {
        $getPart = $request->input('getPart', []);
        $getDate = $request->input('getData', []);

        foreach ($getDate as $i => $date) {
            $part = $getPart[$i] ?? null;
            if (!empty($part)) {
                $reserve_settings = ReserveSettings::where('setting_reserve', $date)
                    ->where('setting_part', $part)
                    ->first();

                if ($reserve_settings) {
                    $reserve_settings->decrement('limit_users');
                    $reserve_settings->users()->attach(Auth::id());
                }
            }
        }

        DB::commit();
    } catch (\Exception $e) {
        DB::rollback();
        // エラー内容をログに出力しておくとデバッグしやすい
        \Log::error('予約処理中にエラーが発生', [
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);

        return back()->with('error', '予約処理中にエラーが発生しました。');
    }

    return redirect()->route('calendar.general.show', ['user_id' => Auth::id()])
        ->with('success', '予約が完了しました。');
}

    public function delete(Request $request)
{
    DB::beginTransaction();
    try {
        $deleteDate = $request->input('delete_date');

        // ログインユーザーが予約している情報を取得
        $user = Auth::user();
        $reserveSetting = $user->reserveSettings()
            ->where('setting_reserve', $deleteDate)
            ->first();

        if ($reserveSetting) {
            $reserveSetting->increment('limit_users'); // 上限人数を元に戻す
            $reserveSetting->users()->detach($user->id); // ユーザーとの紐付け解除
        }

        DB::commit();
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('error', 'キャンセルに失敗しました');
    }

    return redirect()->route('calendar.general.show', ['user_id' => Auth::id()]);
}
}
