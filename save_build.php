<?php

session_start();
if(isset($_SESSION["user"])){
    $u_id = $_SESSION["user"];
}

include("mysql/mysql.php");
// $photo = $_POST["addPhoto"];
$title = $_POST["title"];
$depiction = $_POST["depiction"];
$mutiple = isset($_POST["mutiple"]);
$text = implode(" ",$_POST["text"]);
$dateline_date = $_POST["dateline_date"];

//圖片
$name=$_FILES['addPhoto']['name'];
$tmp_name=$_FILES['addPhoto']['tmp_name'];
move_uploaded_file($_FILES["addPhoto"]["tmp_name"],"upload/".$_FILES["addPhoto"]["name"]);
$photo = "upload/".$name;

if($mutiple == 1){
    $mutiple = "yes";
}else{
    $mutiple = "no";
}

//將text內選項分別放入option[]
$option = explode(" ",$text);

//將檔案寫入資料庫
$insert = mysqli_query($link, "INSERT INTO vote ( v_title,v_user, v_photo, v_depiction, v_mutiple, v_option1, v_option2, v_option3, v_option4, v_option5, v_dateline_date, v_dateline_time ) VALUES( '$title','$u_id', '$photo', '$depiction', '$mutiple', '$option[0]', '$option[1]', '$option[2]','$option[3]','$option[4]', '$dateline_date', '$dateline_time' )");
sleep(1);

header("Location: all_vote.php");
