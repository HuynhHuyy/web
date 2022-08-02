<?php
    include('../config/config.php');

    if(isset($_GET['file_id'])){
        $sql_temp = $_GET['file_id'];
        $sql = "SELECT * FROM Furlough WHERE idForm = '$sql_temp'";
        $sql_run = mysqli_query($mysqli,$sql);
        $sql_row = mysqli_num_rows($sql_run);
        if($sql_row >0){
            $row = mysqli_fetch_assoc($sql_run);
            echo ($row['files']);

        }else{
            echo "lỗi tên file";
        }


    }

?>