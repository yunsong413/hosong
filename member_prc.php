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
$cmd = $_GET['cmd'] ? $_GET['cmd']:'insert';

if($cmd == 'update') {
    $no = $_GET['no'];

    $sql = "SELECT * from member where no=$no";
    $rows = mysqli_query($db,$sql);
    $row= mysqli_fetch_assoc($rows);

    $userid = $row['userid'];
    $name = $row['name'];
    $password = $row['password'];
    $memo = $row['memo'];



} else if($cmd == 'insert') {
    $userid = '';
    $name = '';
    $password = '';
    $memo = '';


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

if($cmd=="update"){
    $sql = "UPDATE member SET userid='$userid',name='$name',password='$password,'memo='$memo' where no= '$no'";
    mysqli_query($db,$sql); 

}
    $sql="select * from member";
    $result = mysqli_query($db,$sql); 
    while($rows= mysqli_fetch_assoc($result)) {
        echo $rows['userid'];
        echo $rows['name'];
        echo $rows['password'];
        echo $rows['memo'];
        echo "<a class='button' href='member_prc.php?cmd=delete&no={$rows['no']}'>삭제</a>";
        echo "<a class='button' href='member_prc.php?cmd=update&no={$rows['no']}'>수정</a>";
        echo "<br>";
    }
?>

<form method="GET" action="member_prc.php">
    <input type="hidden" name="cmd" value="<?=$cmd?>"/>
    <input type="hidden" name="no" value="<?=$no?>"/> 
    <input type="text" name="userid" value="<?=$userid?>"/> 
    <input type="text" name="name" value="<?=$name?>"/> 
    <input type="text" name="password" value="<?=$password?>"/>
    <input type="text" name="memo" value="<?=$memo?>"/>
    <input type="submit"/>
</form>
