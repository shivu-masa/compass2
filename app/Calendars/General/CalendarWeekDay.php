<?php
namespace App\Calendars\General;

use App\Models\Calendars\ReserveSettings;
use Carbon\Carbon;
use Auth;

class CalendarWeekDay{
  protected $carbon;

  function __construct($date){
    $this->carbon = new Carbon($date);
  }

  function getClassName(){
    return "day-" . strtolower($this->carbon->format("D"));
  }

 function pastClassName(){
    if ($this->carbon->isPast() && !$this->carbon->isToday()) {
        return 'past-day'; // CSSでグレー背景指定
    }
    return '';
}

  /**
   * @return
   */

   function render(){
    $class = $this->getClassName() . ' ' . $this->pastClassName(); // 曜日＋過去日CSS

    return '<p class="' . $class . '">' . $this->carbon->format("j") . '日</p>';
}

   function selectPart($ymd){
     $one_part_frame = ReserveSettings::with('users')->where('setting_reserve', $ymd)->where('setting_part', '1')->first();
     $two_part_frame = ReserveSettings::with('users')->where('setting_reserve', $ymd)->where('setting_part', '2')->first();
     $three_part_frame = ReserveSettings::with('users')->where('setting_reserve', $ymd)->where('setting_part', '3')->first();
     if($one_part_frame){
       $one_part_frame = ReserveSettings::with('users')->where('setting_reserve', $ymd)->where('setting_part', '1')->first()->limit_users;
     }else{
       $one_part_frame = '0';
     }
     if($two_part_frame){
       $two_part_frame = ReserveSettings::with('users')->where('setting_reserve', $ymd)->where('setting_part', '2')->first()->limit_users;
     }else{
       $two_part_frame = '0';
     }
     if($three_part_frame){
       $three_part_frame = ReserveSettings::with('users')->where('setting_reserve', $ymd)->where('setting_part', '3')->first()->limit_users;
     }else{
       $three_part_frame = '0';
     }

     $html = [];
     $html[] = '<select name="getPart[]" class="border-primary" style="width:70px; border-radius:5px;" form="reserveParts">';
     $html[] = '<option value="" selected></option>';
     if($one_part_frame == "0"){
       $html[] = '<option value="1" disabled>リモ1部(残り0枠)</option>';
     }else{
       $html[] = '<option value="1">リモ1部(残り'.$one_part_frame.'枠)</option>';
     }
     if($two_part_frame == "0"){
       $html[] = '<option value="2" disabled>リモ2部(残り0枠)</option>';
     }else{
       $html[] = '<option value="2">リモ2部(残り'.$two_part_frame.'枠)</option>';
     }
     if($three_part_frame == "0"){
       $html[] = '<option value="3" disabled>リモ3部(残り0枠)</option>';
     }else{
       $html[] = '<option value="3">リモ3部(残り'.$three_part_frame.'枠)</option>';
     }
     $html[] = '</select>';
     return implode('', $html);
   }

   function getDate(){
     return '<input type="hidden" value="'. $this->carbon->format('Y-m-d') .'" name="getData[]" form="reserveParts">';
   }

   function everyDay(){
     return $this->carbon->format('Y-m-d');
   }

   function authReserveDay(){
     return Auth::user()->reserveSettings->pluck('setting_reserve')->toArray();
   }

   function authReserveDate($reserveDate){
     return Auth::user()->reserveSettings->where('setting_reserve', $reserveDate);
   }

function reserveStatusText($ymd){
    // 今日より前の日付なら過去
    if (Carbon::parse($ymd)->isPast() && !Carbon::parse($ymd)->isToday()) {
        $reserve = $this->authReserveDate($ymd);
        if ($reserve->isEmpty()) {
            return '<p class="text-danger small">受付終了</p>';
        } else {
            // 参加した部を配列で取得
            $parts = $reserve->pluck('setting_part')->sort()->all();
            return '<p class="text-primary small">参加：' . implode('・', $parts) . '部</p>';
        }
    }
    return ''; // 未来日なら表示なし（必要なら変えてOK）
}

}
