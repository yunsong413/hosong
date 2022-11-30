<?
include("config.php");

$db = mysqli_connect($db_url, $db_name, $db_pw, $db_schema);
$cmd = $_GET['cmd'] ? $_GET['cmd'] : 'insert';

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
$sql = "SELECT * FROM member";
$resut = mysqli_query($db,$sql);


$sql="select * from member";
    $result = mysqli_query($db,$sql); 
    while($rows= mysqli_fetch_assoc($result)) {
        echo $rows['userid'];
        echo $rows['name'];
        echo $rows['password'];
        echo $rows['memo'];
        echo "<a class='button' href='member_prc.php?cmd=delete&no={$rows['no']}'>삭제</a>";
        echo "<a class='button' href='member_list.php?cmd=update&no={$rows['no']}'>수정</a>";
        echo "<br>";
    }

mysqli_close($db);
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
<a href = "member_prc.php">prc로돌아가기</a>
<a href = 'member_list.php'>리셋</a>