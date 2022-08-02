<?php
    session_start();    
    include('../config/config.php');

    if(isset($_POST['login'])){

        $username = addslashes($_POST['username']);
        $pwd = addslashes($_POST['pwd']);

        $sql_select_id_level = "SELECT Users.Id, Users.level FROM Users WHERE username = '$username'  LIMIT 1";
        $select_id_level = mysqli_query($mysqli,$sql_select_id_level);
        $row_pro = mysqli_fetch_array($select_id_level);

        $sql_temp = "SELECT * FROM Users WHERE username = '$username'LIMIT 1";
        $row_temp = mysqli_query($mysqli,$sql_temp);
        $count_temp = mysqli_num_rows($row_temp);
        if($count_temp > 0){ 
            $row_data = mysqli_fetch_assoc($row_temp);
            $verify = password_verify($pwd,$row_data['pwd']);
            $_SESSION['id'] = $row_pro['Id'];
            $_SESSION['level'] = $row_pro['level'];
            if($verify == 1){
                 if($username == $pwd){
                    header('Location:../change_password.php');
                    }
                else{
                    header("Location:../includes/direction.php");
                }
            }else{
                $error = 'Sai tài khoản hoặc mật khẩu';
                header("Location:/index.php?msg1=$error");
                exit;
            }
            }
        else{
            $error = 'Sai tài khoản hoặc mật khẩu';
            header("Location:/index.php?msg1=$error");
            exit;
        }
    }
?>