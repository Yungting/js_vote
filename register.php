<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>註冊</title>
    <link href="css/all.css" rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
<?php
if(isset($_POST['user']) && isset($_POST['pass'])){ 
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    include("mysql/mysql.php");
    $sql2 = "INSERT INTO user SET username = '$user', password = '$pass';";
    mysqli_query($link, $sql2);
    header('Location: login.php');
} else {
    ?>
    <div id="headbox">
    <a href="index.php" class="logo">首頁</a>
    <a href="login.php" class="login">登入</a>
    </div>
    <form method="POST" action="login.php">
    <a>帳號：<input type="text" name="user" required></a><br>
    <a>密碼：<input type="password" name="pass" required></a><br>
    <input type="submit" value="送出" class="button">
    </form>
    <?php
}?>
</div>
</body>
</html>
