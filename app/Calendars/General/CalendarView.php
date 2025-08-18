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

public function render() {
    $html = [];
    $html[] = '<h4 class="text-center mb-3 mt-3">' . $this->getTitle() . '</h4>';
    $html[] = '<div class="calendar text-center">';
    $html[] = '<table class="table">';
    $html[] = '<thead>';
    $html[] = '<tr>';
    $html[] = '<th>月</th>';
    $html[] = '<th>火</th>';
    $html[] = '<th>水</th>';
    $html[] = '<th>木</th>';
    $html[] = '<th>金</th>';
    $html[] = '<th style="color:#0000ff;">土</th>'; // 土曜を青
    $html[] = '<th style="color:#dc3545;">日</th>'; // 日曜を赤
    $html[] = '</tr>';
    $html[] = '</thead>';
    $html[] = '<tbody>';

    $weeks = $this->getWeeks();
    foreach($weeks as $week) {
        $html[] = '<tr class="'.$week->getClassName().'">';
        $days = $week->getDays();

        foreach($days as $day) {
            $startDay = $this->carbon->copy()->format("Y-m-01");
            $toDay = \Carbon\Carbon::today();
            $dayDate = $day->everyDay();
            $dayDateCarbon = \Carbon\Carbon::parse($dayDate);

            $isPast = $dayDateCarbon->lte($toDay);

            // 曜日ごとの文字色
            $dayOfWeek = $dayDateCarbon->dayOfWeek; // 0=日, 6=土
            $dayColor = '';
            if ($dayOfWeek == 6) {
                $dayColor = 'color:#0000ff;'; // 土曜
            } elseif ($dayOfWeek == 0) {
                $dayColor = 'color:#dc3545;'; // 日曜
            } else {
                $dayColor = 'color:#000000;'; // 平日
            }

            $tdClass = 'calendar-td ' . $day->getClassName();
            if ($isPast) {
                $tdClass .= ' bg-past';
            }

            $html[] = '<td class="' . $tdClass . '" style="'.$dayColor.'">';
            $html[] = $day->render();
            $html[] = $day->getDate();

            if (in_array($dayDate, $this->authReserveDay())) {
                $reservePart = $day->authReserveDate($dayDate)->first()->setting_part;
                $reserveLabel = 'リモ' . $reservePart . '部';

                if ($isPast) {
                    $html[] = '<p class="text-center m-auto p-1 w-75 text-dark" style="font-size:12px;">' . $reserveLabel . '</p>';
                } else {
                    $html[] = '<button type="button" class="btn btn-danger p-0 w-75 open-cancel-modal"
                        data-date="' . $dayDate . '"
                        data-label="' . $reserveLabel . '"
                        style="font-size:12px;">' . $reserveLabel . '</button>';
                }

                $html[] = '<input type="hidden" name="getPart[]" value="' . $reservePart . '" form="reserveParts">';
            } else {
                if ($isPast) {
                    $html[] = '<p class="m-auto p-1 w-75 text-dark" style="font-size:12px;">受付終了</p>';
                    $html[] = '<input type="hidden" name="getPart[]" value="" form="reserveParts">';
                } else {
                    $html[] = $day->selectPart($dayDate);
                }
            }

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
