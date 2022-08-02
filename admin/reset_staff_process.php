<?php
    include('../config/config.php');
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    } else {
        $id = '';
    }
    if(isset($_GET['id'])){
        $sql_select_username = "SELECT username FROM Users WHERE Id = '$id' LIMIT 1 ";
        $username = mysqli_query($mysqli,$sql_select_username);
        $data = mysqli_fetch_array($username);
        $reset = $data['username'];
        $reset_hash = password_hash($reset,PASSWORD_BCRYPT);
        $sql_reset = "UPDATE Users SET Users.pwd = '$reset_hash' where Id = '$id'";
        if(mysqli_query($mysqli,$sql_reset)){
            header('Location:../pages/admin_index.php?manage=listStaff&success='.'Sửa thành công');
        }
        else{
            echo 'fail';
        }
    } 
?>