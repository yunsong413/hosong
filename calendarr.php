<table class="calendar">
<tr>
    <td>일</td>
    <td>월</td>
    <td>화</td>
    <td>수</td>
    <td>목</td>
    <td>금</td>
    <td>토</td>
</tr>

<?php

$this_year = date("Y"); //출력할 연도
$this_month = date("m");  //출력할 월

echoCalendar($this_year,$this_month);



function echoCalendar($this_year,$this_month) {

    $today = date($this_year."-".$this_month);
    $last_date = date('t', strtotime($today));
    $last_date_day = date('w',strtotime(date($this_year."-".$this_month."-".$last_date)));

    //달의 첫 날 구하기
    $first_all_date = date($this_year."-".$this_month."-1");
    $first_all_day = strtotime($first_all_date);
    $first_day = date('w', $first_all_day);

    //지난 달 값 구하기
    $d = mktime(0,0,0, date("$this_month"), 1, date("$this_year")); 
    $prev_month = strtotime("-1 month", $d); 
    $prev_month_last = date("t", $prev_month ); //지난달 말일

    $one_month_arr = array(); //달력 한 달 배열 선언

    //첫 줄에 나오는 빈칸 개수는 현재 달의 1일의 요일의 수와 같음 예) 월=1이고 1개 필요
    //echo "첫 줄에 나와야 하는 빈 칸의 개수: ".$first_day."개<br><br>";

    //전 달 날짜 출력
    for($i=0;$i<$first_day;$i++){
        $i_prev_month_date = $prev_month_last-($first_day-1)+$i;
        $weekday = $daily_arr[$i];
        $one_month_arr[] = $i_prev_month_date;
    }

    //i가 달의 마지막 날보다 커지기 전까지 i를 하나씩 더해가면서 출력
    //요일도 같이 붙어서 출력
    for($i=1;$i<=$last_date;$i++){
        $one_month_arr[]=$i;
    }

    $today_month_last_day = 7-$last_date_day;
    //echo $today_month_last_day;

    //다음 달 날짜도 이어서 출력
    for($i=1;$i<$today_month_last_day;$i++){
        $one_month_arr[]=$i;
    }

    //array를 7로 나누기
    $temp = array_chunk($one_month_arr,7);
    //7로 나눈걸 출력
    foreach ($temp as $arr){
        echo "<tr>";
        foreach ($arr as $ii) {
            echo "<td>". $ii . "</td>";
        }
        echo"</tr>";
    }
}
?>

<style>
    .calendar {border: 1px solid #000; border-collapse: collapse; text-align: center;}
    .calendar tr td {border: 1px solid #000;}
    .calendar tr :first-child {color: red;}
    .calendar tr :last-child {color: blue;}
</style>