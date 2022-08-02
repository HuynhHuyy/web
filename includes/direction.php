<?php
    session_start();
    if($_SESSION['level'] == 0){
        header("Location:../pages/admin_index.php");
    } else if($_SESSION['level'] == 1){
        header("Location:../pages/department_index.php");
    } else if($_SESSION['level'] == 2){
        header("Location:../pages/staff_index.php");
    }
    else{
        header('Location:../index.php');
        exit;
    }
?>