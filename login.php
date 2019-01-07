<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>登入</title>
    <link href="css/all.css" rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
<?php 
if(!isset($_POST['user'])){ ?>
<div id="headbox">
    <a href="index.php" class="logo">首頁</a>
    <a href="register.php" class="login">註冊</a>
    </div>
    <form method="POST" action="login.php">
    <a>帳號：<input type="text" name="user" required></a><br>
    <a>密碼：<input type="password" name="pass" required></a><br>
    <input type="submit" value="送出" class="button">
    </form>
<?php
} else { 
    $user = $_POST["user"];
    $pass = $_POST["pass"];
    include("mysql/mysql.php");
    $sql2 = "SELECT * FROM user WHERE username = '$user' AND password = '$pass';";
    $result = mysqli_query($link, $sql2);
    $row = mysqli_fetch_assoc($result);
    if(isset($row)){
        $_SESSION["user"] = $user;
        $_SESSION["pass"] = $pass;
        header("Location: all_vote.php");
    }else{
        $_POST = array();
        header("Location: login.php");
    }
} ?>
</div>
</body>
</html>