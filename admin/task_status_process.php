<?php
    include('../config/config.php');
    if(isset($_POST['start']) && isset($_GET['idTask'])){
        $idTask = $_GET['idTask'];
        $sql = "UPDATE Task SET status = 1 WHERE id = '$idTask'";
        if(mysqli_query($mysqli,$sql)){
            header("Location:../pages/staff_index.php?manage=detailTask1&idTask=$idTask");
            exit;
        }
    }
    if(isset($_POST['submit']) && isset($_GET['idTask'])){
        $file = $_FILES["staff_file"]['name'];
        $idTask = $_GET['idTask'];
        $date_submit = date("Y/m/d");
        $description = addslashes($_POST['description']);
        $sql = "UPDATE Task SET status = 2, date_submit = '$date_submit', description_task = '$description', files_staff='$file' WHERE id = '$idTask'";
        if(mysqli_query($mysqli,$sql)){
            move_uploaded_file($_FILES["staff_file"]["tmp_name"],"../file_upload/".$_FILES["staff_file"]["name"]);
            header("Location:../pages/staff_index.php?manage=detailTask2&idTask=$idTask");
            exit;
        }
    }
    else{
        header("Location:../pages/staff_index.php");
        exit;
    }
?>