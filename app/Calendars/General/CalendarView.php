<?php
namespace App\Calendars\General;

use Carbon\Carbon;
use Auth;

class CalendarView{

  private $carbon;
  function __construct($date){
    $this->carbon = new Carbon($date);
  }

  public function getTitle(){
    return $this->carbon->format('Y年n月');
  }

  function render(){
    $html = [];
    $html[] = '<div class="calendar text-center">';
    $html[] = '<table class="table">';
    $html[] = '<thead>';
    $html[] = '<tr>';
    $html[] = '<th>月</th>';
    $html[] = '<th>火</th>';
    $html[] = '<th>水</th>';
    $html[] = '<th>木</th>';
    $html[] = '<th>金</th>';
    $html[] = '<th>土</th>';
    $html[] = '<th>日</th>';
    $html[] = '</tr>';
    $html[] = '</thead>';
    $html[] = '<tbody>';

    $weeks = $this->getWeeks();
    foreach($weeks as $week){
        $html[] = '<tr class="'.$week->getClassName().'">';
        $days = $week->getDays();

        foreach($days as $day){
    $startDay = $this->carbon->copy()->format("Y-m-01");
    $toDay = \Carbon\Carbon::today();

    $dayDate = $day->everyDay(); // 'Y-m-d' 形式の文字列
    $dayDateCarbon = \Carbon\Carbon::parse($dayDate);

    $isPast = $dayDateCarbon->lt($toDay); // 今日より前の日付か

    $tdClass = 'calendar-td ' . $day->getClassName();
    if ($isPast) {
        $tdClass .= ' bg-secondary text-light';
    }

    $html[] = '<td class="' . $tdClass . '">';
    $html[] = $day->render();

    if (in_array($dayDate, $this->authReserveDay())) {
    $reservePart = $day->authReserveDate($dayDate)->first()->setting_part;
    $reserveLabel = 'リモ' . $reservePart . '部';

    if ($isPast) {
        $html[] = '<p class="text-center m-auto p-1 w-75 bg-dark text-white" style="font-size:12px;">' . $reserveLabel . '</p>';
    } else {
        $html[] = '<button type="button" class="btn btn-danger p-0 w-75 open-cancel-modal"
    data-date="' . $dayDate . '"
    data-label="' . $reserveLabel . '"
    style="font-size:12px;"
>' . $reserveLabel . '</button>';
    }

    $html[] = '<input type="hidden" name="getPart[]" value="" form="reserveParts">';
} else {
    if ($isPast) {
        $html[] = '<p class="text-muted m-auto p-1 w-75 border" style="font-size:12px;">受付終了</p>';
        $html[] = '<!-- debug: 受付終了表示される日付 -> ' . $dayDate . ' -->';
    } else {
        $html[] = $day->selectPart($dayDate);
    }
}
    $html[] = $day->getDate();
    $html[] = '</td>';
}
        $html[] = '</tr>';
    }
    $html[] = '</tbody>';
    $html[] = '</table>';
    $html[] = '</div>';
    return implode("", $html);
}


public function authReserveDay() {
    return Auth::user()->reserveSettings->pluck('setting_reserve')->toArray();
}
  protected function getWeeks(){
    $weeks = [];
    $firstDay = $this->carbon->copy()->firstOfMonth();
    $lastDay = $this->carbon->copy()->lastOfMonth();
    $week = new CalendarWeek($firstDay->copy());
    $weeks[] = $week;
    $tmpDay = $firstDay->copy()->addDay(7)->startOfWeek();
    while($tmpDay->lte($lastDay)){
      $week = new CalendarWeek($tmpDay, count($weeks));
      $weeks[] = $week;
      $tmpDay->addDay(7);
    }
    return $weeks;
  }
}
