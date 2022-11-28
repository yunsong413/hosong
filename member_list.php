<?
echo "hello";

    include("config.php");

    $db = mysqli_connect($db_url, $db_name, $db_pw, $db_schema);
    $sql = "select * from member";
    $result = mysqli_query($db,$sql);
    while($rows = mysqli_fetch_assoc($result)) {
        echo $rows['no'];
        echo $rows['userid'];
        echo $rows['name'];
        echo $rows['password'];
        echo $rows['memo'];
    }
        
?>