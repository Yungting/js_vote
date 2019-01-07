
<link href="css/all.css" rel="stylesheet" href="style.css">
<div class="container">
<?php
session_start();
if(isset($_SESSION["user"])){
	$u_id = $_SESSION["user"];
}
?>
<div id="headbox">
    <a href="index.php" class="logo">首頁</a>
    <a href="login.php" class="login">登入</a>
</div>
<?php

header("Content-Type:text/html; charset=utf-8");

include("mysql/mysql.php");
$all_vote = mysqli_query($link, "SELECT * FROM vote ORDER BY v_id DESC");

//熱門排行
$hot = mysqli_query($link, "SELECT v_id, option1_number,option2_number,option3_number,option4_number,option5_number FROM vote");
$row_hot = mysqli_fetch_all($hot);

//每個投票ID對應總票數
$id_optioncount = array();
foreach($row_hot as $every_option){
    //echo $every_option[0];

    $all_option_word = '';
    for($i=1; $i<=5; $i++){
        if(empty($every_option[$i]) == FALSE){
           $all_option_word = $all_option_word.$every_option[$i].',';
        }
    }

    $all_option_array = explode(',',substr($all_option_word,0,-1));
    //echo count($all_option_array).'<br>';
    
    $id_optioncount[$every_option[0]] = count($all_option_array);
    
}
//排序
arsort($id_optioncount);
//只抓前三筆
$top3 = array_slice(array_keys($id_optioncount),0,3);

//前三名id
// echo $top3[0];
// echo $top3[1];
// echo $top3[2];

//前三名的資訊列出來
$top3_vote = mysqli_query($link, "SELECT * FROM vote WHERE v_id = $top3[2] || v_id = $top3[1] || v_id = $top3[0]");

?>

<div class="top">
    <h3 class="hot2">熱門排行</h3>
<?php
for($j=0; $j<3; $j++){
    $top3_vote = mysqli_query($link, "SELECT * FROM vote WHERE v_id = $top3[$j]");
    $top3_vote = mysqli_fetch_all($top3_vote);
    foreach($top3_vote as $every_option){
        echo '<a class="hot">第'.((int)$j+1).'名 ';
        //echo $every_option[0];  //ID
        echo $every_option[3].'</a>';      //title
    }
}
?>
</div>


<div class="left">
<?php
//每一筆投票
while($row = mysqli_fetch_assoc($all_vote)){
    $id = $row["v_id"];
    //echo "<img src='".$row["v_photo"]."'>";
    //echo 'ID: '.$id;
    ?>
    <div class="item"><img src='./upload/vote.png'><br>

    <!-- <?php echo $row["v_photo"]; ?> -->

    <?php
    echo '<a class="title">'. $row["v_title"].'<a/><br>';
    //echo '<a class="user">'. $row["v_user"].'<a/><br>';
    echo '<a class="dep">'. $row["v_depiction"].'<a/><br>';
    echo "<a href='vote_detail.php?id=".$id."'><button>查看詳情</button><a/></div>";
    echo "<br>";
}
?>
<div style="clear:both">
</div>

</div>