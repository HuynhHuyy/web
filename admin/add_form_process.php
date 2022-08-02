<?php
    include('../config/config.php');
    session_start();
    $url = $_GET['url'];
    $numbeRoom = $_POST['numberRoom'];
    $id_sender = $_SESSION['id'];
    $level = $_SESSION['level'];
    $file = $_FILES["uploadfile"]['name'];

    if($level == 2){
        $sql = "SELECT Id FROM Users WHERE numberRoom = '$numbeRoom' AND level = 1 LIMIT 1";
    } else{
        $sql = "SELECT Id FROM Users WHERE level = 0 LIMIT 1";
    }
    $query = mysqli_query($mysqli,$sql);
    $data = mysqli_fetch_array($query);
    $id_receiver = $data['Id'];
    if (isset($_POST['numDay']) && isset($_POST['reason'])) {
        $numDay = addslashes($_POST['numDay']);
        $reason = addslashes($_POST['reason']);
        $date_off = addslashes($_POST['date_off']);
    } else {
        $numDay = '';
        $reason = '';
        $date_off = '';
    } 
    if(isset($_POST['form'])){  
       
        $sql_add = "INSERT INTO Furlough (reason, id_sender, id_receiver, numDay, date_off,files) VALUES ('$reason', '$id_sender','$id_receiver','$numDay', '$date_off','$file')";
        mysqli_query($mysqli,$sql_add);
        move_uploaded_file($_FILES["uploadfile"]["tmp_name"],"../file_upload/".$_FILES["uploadfile"]["name"]);
        header("Location:../pages/$url?manage=furlough&success=Thêm thành công");
    } 

?>