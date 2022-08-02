<?php
    include('../config/config.php');
    if (isset($_POST['create'])) {
        $nameRoom = addslashes($_POST['nameRoom']);
        $numberRoom = addslashes($_POST['numberRoom']);
        $description = addslashes($_POST['description']);
    } else {
        $nameRoom = '';
        $numberRoom = '';
        $description = '';
    }
    $sql = "SELECT * FROM Department WHERE numberRoom = '$numberRoom'";
    $row = mysqli_query($mysqli,$sql);
    $count = mysqli_num_rows($row);
    
    if(isset($_POST['create'])){
        if($count > 0){
            header("Location:../pages/admin_index.php?manage=listDepartment&fail=".'Phòng đã tồn tại');
        }
        else{
            $sql_add = "INSERT INTO Department (numberRoom, nameRoom, description) VALUES ('$numberRoom', '$nameRoom','$description')";
            mysqli_query($mysqli,$sql_add);
            header('Location:../pages/admin_index.php?manage=listDepartment&success='.'Thêm thành công');
        }
    } 
?>