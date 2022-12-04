<?
include("config.php");

$db = mysqli_connect($db_url, $db_name, $db_pw, $db_schema);
$sql = "select * from member";
$result = mysqli_query($db,$sql);
$no = $_GET['no'];
$userid = $_GET['userid'];
$name = $_GET['name'];
$password = $_GET['password'];
$memo = $_GET['memo'];
$cmd = $_GET['cmd'];

if($cmd == "update"){
    $sql = "UPDATE member SET userid = '$userid', name = '$name', password= '$password', memo='$memo' where no = '$no'";
    mysqli_query($db,$sql); 
}

if($cmd == "delete"){
    $sql= "delete from member where no =$no"; 
    mysqli_query($db,$sql);
}

if($cmd == "insert") {
    $sql = "INSERT INTO member( userid,name,password,memo)
           VALUES ('$userid','$name','$password','$memo')";
    mysqli_query($db,$sql); 
}
//$cmd = $_GET['cmd'] ? $_GET['cmd']:'insert';
echo "<a class='button' href='member_prc2.php'>리셋</a>";
echo "<br>";


if($cmd!='delete'&&$no!='' ) { //no값이 있을때
    $sql = "SELECT * from member where no=$no";

    $rows = mysqli_query($db,$sql);
    $row= mysqli_fetch_assoc($rows);
    $cmd = 'update';
    $userid = $row['userid'];
    $name = $row['name'];
    $password = $row['password'];
    $memo = $row['memo'];
    $button_name = "수정";
} else { //no가없을때
    $cmd = 'insert';
    $userid = $row[''];
    $name = $row[''];
    $password = $row[''];
    $memo = $row[''];
    $button_name = "추가";
  
}

    $sql="select * from member";
    $result = mysqli_query($db,$sql); 
    while($row= mysqli_fetch_assoc($result)) {
        echo $row['no'];
        echo"-";
        echo $row['userid'];
        echo"-";
        echo $row['name'];
        echo"-";
        echo $row['password'];
        echo"-";
        echo $row['memo'];
        echo "<a class='button' href='member_prc2.php?cmd=delete&no={$row['no']}'>삭제</a>";
        echo "<a class='button' href='member_prc2.php?no={$row['no']}'>수정</a>";
        echo "<br>";
    };
?>

<form method="GET" action="member_prc2.php">
    <input type="hidden" name="cmd" value="<?=$cmd?>"/>
    <input type="hidden" name="no" value="<?=$no?>"/> 
    userid:<input type="text" name="userid" value="<?=$userid?>" placeholder="userid"/><br> 
    name:<input type="text" name="name" value="<?=$name?>" placeholder="name"/> <br> 
    password:<input type="text" name="password" value="<?=$password?>" placeholder="passoword"/><br> 
    memo:<input type="text" name="memo" value="<?=$memo?>" placeholder="memo"/><br> 
    <input type="submit" value="<?=$button_name?>">

</form>
