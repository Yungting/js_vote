<html lang="en">
    <head>
    <?php
        session_start();
        if(isset($_SESSION["user"])){
            $u_id = $_SESSION["user"];
        }

        include("mysql/mysql.php");

        $id = $_POST["id"];
        $detail_vote = mysqli_query($link, "SELECT * FROM vote WHERE v_id = '$id' ");
        $row = mysqli_fetch_assoc($detail_vote);
    ?>

        <meta charset="UTF-8">
        <title>投票頁</title>
        <script src="https://d3js.org/d3.v4.0.0-alpha.4.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link href="css/all.css" rel="stylesheet" href="style.css">
        <script type="text/javascript">     
        var mutiple = '<?php echo $row["v_mutiple"]; ?>';
        //控制每次最多可投幾票
        $(document).ready(function() {
            // 項目 選取的checkbox
            $('input[type=checkbox]').click(function() {
                // 若不行多選，則把其他選項關閉
                if(mutiple == "no"){
					$("input[name='radio[]']:checked").prop('checked', false);	
                    $(this).prop("checked", true);
				}else{
                    $("input[name='radio[]']").attr('disabled', false);
				}
            });
        })
        </script>

    </head>
    <body>
    <div class="container">
        <div id="headbox">
            <a href="all_vote.php" class="logo">首頁</a>
            <a href="build.php" class="login">建立投票</a>
        </div>
    <div class="text">
    <ul>
        <li><img src=' <?php echo $row["v_photo"]; ?>'</li>
        <li class="title"><?php echo $row["v_title"]; ?> </li>
        <li>發起人：<?php echo $row["v_user"]; ?></li>
        <li class="title"><?php echo $row["v_depiction"]; ?></li>
        <li class="title">選項：</li>
        <form action="save_vote.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value=" <?php echo $id; ?> " id="xd">
            <?php
            //是否能複選            
            if($row["v_mutiple"] == "yes"){
                echo '<p name="mutiple">可以複選</p>';
            }else{
                echo '<p name="mutiple">只能選一個選項</p>';
            }

             for($i=1; $i<=5; $i++){
                if(empty($row['v_option'.$i]) == FALSE && $row['v_option'.$i] != "NULL"){
                    // if(stristr($row['option'.$i.'_number'], $u_id) != false){
                    //     echo '<li><input type="radio" name="radio" value="option"'.$i.' checked disabled >'.$row['v_option'.$i].'</li>';
                    // }
                     echo '<li><input type="checkbox" class="magic-checkbox" name="radio[]" value="option'.$i.'" id="xd">'.$row['v_option'.$i].'</li>';
                 }
             }

            ?>

            <input type="submit" value="投票" class="button">
        </form>
    </ul>
    </div>
    </div>
    </body>
</html>





