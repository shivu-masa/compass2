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
     $dayOfWeek = $this->carbon->dayOfWeek;

    if ($dayOfWeek === 0) {         // 日曜
        return '';       // 赤文字
    } elseif ($dayOfWeek === 6) {   // 土曜
        return '';      // 青文字
    } else {                        // 平日
        return 'text-dark';         // 黒文字
    }
    return "day-" . strtolower($this->carbon->format("D"));
  }

 function pastClassName(){
    if ($this->carbon->isPast() && !$this->carbon->isToday()) {
        return '';   // 背景グレーだけ付与
    }
    return '';
}

  /**
   * @return
   */

   function render(){
    $weekdayClass = $this->getClassName();   // 曜日クラス（赤,青,黒）
    $pastClass    = $this->pastClassName();  // 過去日クラス（背景グレーのみ）

    return '<p class="' . $weekdayClass . ' ' . $pastClass . '">'
         . $this->carbon->format("j") . '日</p>';
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



}
