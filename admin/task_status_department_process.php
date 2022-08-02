<?php
    include('../config/config.php');

   

    if(isset($_POST['cancel']) && isset($_GET['idTask'])){
        $idTask = $_GET['idTask'];
        $sql = "UPDATE Task SET status = 5 WHERE id = '$idTask'";
        if(mysqli_query($mysqli,$sql)){
            header("Location:../pages/department_index.php");
            exit;
        }
    }
    if(isset($_POST['approve']) && isset($_GET['idTask'])){
        $idTask = $_GET['idTask'];
        $rate = $_POST['rate'];
        $sql = "UPDATE Task SET status = 3, rate = '$rate' WHERE id = '$idTask'";
        if(mysqli_query($mysqli,$sql)){
            header("Location:../pages/department_index.php");
            exit;
        }
    }
    if(isset($_POST['reject']) && isset($_GET['idTask'])){

        $file = $_FILES["reject_name"]['name'];


        $idTask = $_GET['idTask'];
        $feedback = addslashes($_POST['feedback']);
        $deadline = $_POST['deadline'];
        $sql = "UPDATE Task SET status = 4,due = '$deadline', feedback = '$feedback',files ='$file'  WHERE id = '$idTask'";
        if(mysqli_query($mysqli,$sql)){
            move_uploaded_file($_FILES["reject_name"]["tmp_name"],"../file_upload/".$_FILES["reject_name"]["name"]);
            header("Location:../pages/department_index.php");
            exit;
        }
    }
    if(isset($_POST['submit']) && isset($_GET['idTask'])){
        // $file = $_FILES["uploadfile_staff"]['name'];
        $idTask = $_GET['idTask'];
        $date_submit = date("Y/m/d");
        $description = addslashes($_POST['description']);
        $sql_file = 
        $sql = "UPDATE Task SET status = 2, date_submit = '$date_submit', description_task = '$description'' WHERE id = '$idTask'";
        if(mysqli_query($mysqli,$sql)){
            // move_uploaded_file($_FILES["uploadfile_staff"]["tmp_name"],"../file_upload/".$_FILES["uploadfile_staff"]["name"]);
            header("Location:../pages/department_index.php?manage=detailTask2&idTask=$idTask");
            exit;
        }
    }
    else{
        header("Location:../pages/department_index.php");
        exit;
    }
?>