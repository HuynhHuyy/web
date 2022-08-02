<?php
    include('../config/config.php');
    if(!isset($_GET['id_staff_department'])){
            die(json_encode(array('code' => 4,'list' => "Không tìm thấy giá trị đưa vào")));
    }

    if(empty($_GET['id_staff_department'])){
            die(json_encode(array('code'=> 4,'list'=>"Giá trị biến rỗng")));
    }

    $id_department_to_staff = $_GET['id_staff_department'];

    $sql = "SELECT * FROM Users WHERE numberRoom = '$id_department_to_staff' and level > 0 ";
    $row = mysqli_query($mysqli,$sql);
    $data = array();
    if(mysqli_num_rows($row) > 0){
        foreach($row as $i){
            $data[] = $i;
        };
            echo json_encode(array('code' => 0,'list' => $data));

    }
    else{
        echo json_encode(array('code' => 1,'list' => "Lỗi"));
    }
?>