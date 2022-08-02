<?php
    session_start();
    include('../config/config.php');

    if (isset($_POST['changepass'])) {
        $changepass = addslashes($_POST['changepass']);
    } else {
        $changepass = '';
    }
    if(isset($_SESSION['id'])){
        $idStaff = $_SESSION['id'];
    } else{
        $idStaff = "";
    }
    if (isset($_POST['pwd'])) {
        $pwd = addslashes($_POST['pwd']);
    } else {
        $pwd = '';
    }
    if (isset($_POST['pwd-confirm'])) {
        $pwdconfirm = addslashes($_POST['pwd-confirm']);
    } else {
        $pwdconfirm = '';
    }
    if (isset($_POST['oldpassword'])) {
        $oldpassword = addslashes($_POST['oldpassword']);
    } else {
        $oldpassword = '';
    }
    
    if(isset($_POST['changepass'])){
      
        $sql_select_oldpasswordfromdb = "SELECT * FROM Users WHERE Id = '$idStaff' LIMIT 1 ";
        $query_select = mysqli_query($mysqli,$sql_select_oldpasswordfromdb);
        $count_temp = mysqli_num_rows($query_select);
        $oldpass_data = mysqli_fetch_array($query_select);

        $verify_oldpassword = password_verify($oldpassword,$oldpass_data['pwd']);

        if ($verify_oldpassword != 1){
            $error = "Mật khẩu cũ bị sai ";
             header("Location:../change_password.php?msg1=".$error);
        }else if($verify_oldpassword == 1){
                if($pwd == $pwdconfirm){
                    $pwd_hash = password_hash($pwd,PASSWORD_BCRYPT);
                    $sql_update = "UPDATE Users SET 
                    Users.pwd = '$pwd_hash' where Id = '$idStaff'";
                    mysqli_query($mysqli,$sql_update);
                    header('Location:../includes/direction.php');
                }
                else{
                    $error = "Mật khẩu không trùng khớp";
                    header("Location:../change_password.php?msg1=".$error);
                
                } 
            }
            
    }
?>