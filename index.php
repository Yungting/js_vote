
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

while($row = mysqli_fetch_assoc($all_vote)){
    $id = $row["v_id"];
    //echo "<img src='".$row["v_photo"]."'>";
    //echo '<div class="item"><a>ID: '.$id.'<a/><br>';
    ?>
    <div class="item"><a class="img"><img src=' <?php echo $row["v_photo"]; ?>'><a/><br>
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