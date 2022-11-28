<?php

$db = mysqli_connect('localhost:3307', 'root', 'zxcv2020!!', 'hosong');//''쓰기
$sql = "SELECT * FROM calendar"; // "" 쓰는 위치, sql이란?
$result = mysqli_query($db,$sql);//mysqli_query 함수는 mysqli_connect 를 통해 연결된 객체를 이용하여 MySQL 쿼리를 실행시키는 함수입니다
$userid= $_GET['userid'];
$no = $_GET ['no'];
$year = $_GET ['year'];
$month = $_GET ['month'];
$date = $_GET['date'];
$memo = $_GET['memo'];
$cmd = $_GET ['cmd'];

if($cmd == "delete"){
    $sql= "delete from calendar where no =$no"; 
    mysqli_query($db,$sql); //매번 입력하는이유?
}

if($cmd == "insert") {
    $sql = "INSERT INTO calendar( userid, year,month,date,memo)
           VALUES ('$userid', '$year','$month', '$date', '$memo')";
    mysqli_query($db,$sql); 
}

if($cmd=="update"){
    $sql = "UPDATE calendar SET userid='$userid', year='$year',month='$month' , date= '$date', memo='$memo' where no= '$no'";
mysqli_query($db,$sql); 
echo $sql."<br>";
}

echo $userid,$year,$month,$date,$memo;


while($row= mysqli_fetch_assoc($result)){
    echo $row['no']." ";
    echo $row['userid']." ";
    echo $row['year']." ";
    echo $row['month']." ";
    echo $row['date']." ";
    echo $row['memo']."<br>";
    

}

mysqli_close($db);

?>

<a href ="calendarr.php">캘린더로 돌아가기</a>