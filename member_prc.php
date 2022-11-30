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



$sql = "SELECT * FROM member"; 
$result = mysqli_query($db,$sql);

while($row= mysqli_fetch_assoc($result)){
    echo $row['no']." ";
    echo $row['userid']." ";
    echo $row['name']." ";
    echo $row['password']." ";
    echo $row['memo']."<br>";


}

mysqli_close($db);

?>

<a href ="member_list.php">리스트로 돌아가기</a>