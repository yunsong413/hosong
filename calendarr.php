    <?php

    include("config.php");
    include("funtion.php");

    $db = mysqli_connect($db_url, $db_name, $db_pw, $db_schema);

    $this_year = ($_GET['this_year'] != "") ? $_GET['this_year'] : date("Y"); //출력할 연도
    $this_month = ($_GET['this_month'] != "") ? $_GET['this_month'] : date("m"); //출력할 월
    $cmd = $_GET['cmd'] ? $_GET['cmd'] : 'insert';
    $today_year = date('Y');
    $today_month = date('m');
    
    $today = date ("Y-m-d");
    echo "<br>";
    if($cmd == 'update') {
        $no = $_GET['no'];

        $sql = "SELECT * from calendar where no = $no ";
        $rows = mysqli_query($db,$sql);
        $row= mysqli_fetch_assoc($rows);

        $userid = $row['userid'];
        $year = $row['year'];
        $month = $row['month'];
        $date = $row['date'];
        $memo = $row['memo'];

    

    } else if($cmd == 'insert') {
        $userid = '';
        $year = '';
        $month = '';
        $date = '';
        $memo = '';

    
    }

    ?>
    
    <div class = 'all'>
    <a href="member_list.php">memberlist </a><br>
    <a href="calendarr.php?this_year= <?=$this_year-1 ?>&this_month=<?= $this_month ?> ">작년 </a>
    <a href="calendarr.php?this_year= <?=$today_year ?>&this_month=<?= $today_month ?> ">현재 </a>
    <a href="calendarr.php?this_year= <?=$this_year+1 ?>&this_month=<?= $this_month ?> ">내년 </a>
    
    
<?
    echoCalendar($this_year,$this_month);
?>





    <?php
    $sql = "SELECT * FROM calendar where year =$this_year and month=$this_month";
    $result = mysqli_query($db,$sql);
    
    while($rows= mysqli_fetch_assoc($result)) {
        echo $rows['memo'];
        echo "<a class= 'button' href='live_prc.php?cmd=delete&no={$rows['no']}'>삭제</a>";
        echo "<a class='button' href='calendarr.php?cmd=update&no={$rows['no']}'>수정</a>";
        echo "<br>";
    }
        
    ?>


    <form method='get' action='live_prc.php'>  
        <input type='hidden' name='cmd' value='<?= $cmd ?>'/>  <!-- <  ? =  는에코  -->
        <input type='hidden' name='no' value='<?= $no ?>'/> 
        <select name='userid'>
            <? 
            $sql = "select userid from member";
            $result = mysqli_query($db,$sql);
                foreach($result as $i){
                    echo "<option> ".$i['userid']."</option>";
                }
            ?>
            <option value="<?=$userid?>"></option>
        </select>
        <select name='year'>
            <?php for($i=1950; $i <= 2050; $i++){
                if($i==$this_year){
                    echo "<option value= '$i' selected> $i 년</option>";
                }else {
        echo "<option value='{$i}'> {$i}년</option>";}
        }?>
        </select>    
        <select name='month'>
            <?php for($i=1; $i<=12; $i++){
                if($i==$this_month){
                    echo "<option value='$i' selected> $i 월</option>";
                 } else {
        echo"<option value='{$i}'> {$i}월</option>";}
        }?>
        </select>
        <select name='day'>
            <?php for($i=1; $i<=31; $i++){
                if($i==date('d')){
                    echo "<option value='$i' selected> $i 일</option>";
                }else {
        echo "<option value='{$i}'> {$i}일</option>";}
        }?>
        </select>
        memo:<input type='text' name='memo' value='<?= $memo ?>' size='5' />
        <input type='submit'/>
    </form>

</div>

    <style>
        .all {display: block; margin: 0 auto; width: 100%; max-width: 960px;}
        .calendar {border: 1px solid #000; border-collapse: collapse; text-align: center;}
        .calendar tr td {border: 1px solid #000;}
        .calendar tr :first-child {color: red;}
        .calendar tr :last-child {color: blue;}
        .button{background-color: #ccc; color:#000; margin: 10px; }
        .today{background-color:aqua; color:#000;}
    </style>


<script>
    function day_click(msg){
        alert(msg);
    }
</script>