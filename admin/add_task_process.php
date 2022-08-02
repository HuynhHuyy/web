<?php
    session_start();
    $id_sender = $_SESSION['id'];
    include('../config/config.php');

    $file = $_FILES["uploadfile_task"]['name'];

    if (isset($_POST['tittle']) && isset($_POST['content'])) {
        $tittle = addslashes($_POST['tittle']);
        $content = addslashes($_POST['content']);
        $staff = addslashes($_POST['staff']);
        $due = addslashes($_POST['deadline']);
    } else {
        $tittle = '';
        $content = '';
        $staff = '';
    } 
    if(isset($_POST['task'])){  

        $sql_add = "INSERT INTO Task (content, id_receiver, id_sender, tittle, due,files) VALUES ('$content', '$staff', '$id_sender','$tittle', '$due','$file')";
        mysqli_query($mysqli,$sql_add);
        move_uploaded_file($_FILES["uploadfile_task"]["tmp_name"],"../file_upload/".$_FILES["uploadfile_task"]["name"]);
        header('Location:../pages/department_index.php?success='.'Thêm thành công');
    } 
?>