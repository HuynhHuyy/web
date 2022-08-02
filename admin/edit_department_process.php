<?php
    include('../config/config.php');

    if(isset($_POST['checking_edit_btn'])){
        $d_id = $_POST['department_id'];

        $result_array = [];

        $sql = "SELECT * FROM Department WHERE id = '$d_id'";//$sql = $query
        $row = mysqli_query($mysqli,$sql);      //$row = $query_run   $mysqli = $conn $data = $rows

        if(mysqli_num_rows($row) > 0){ 
            foreach($row as $data){
                array_push($result_array, $data);
                header('Content-type: application/json');
                echo json_encode($result_array);
            }
        }
        else{
            echo $return ="Not Found";
        }
    }

    if(isset($_POST['edit_department'])){

        $id = $_POST['edit_id'];
        $nameRoom = $_POST['nameRoom'];
        $numberRoom = $_POST['numberRoom'];
        $description = $_POST['description'];
        $id_leader = $_POST['id_leader'];

    $sql = "UPDATE Department SET nameRoom = '$nameRoom', numberRoom = '$numberRoom', description = '$description', id_staff = '$id_leader'  WHERE id ='$id'";
    $sql_1 = "UPDATE Users SET level = 1, sumDay = 15 WHERE Id = '$id_leader'"; 
    
    
   

    mysqli_query($mysqli,$sql_1);  
    mysqli_query($mysqli,$sql);

    $sql_2 =    $sql_1 = "UPDATE Users SET level = 2, sumDay = 12 WHERE Id != '$id_leader' and numberRoom = '$numberRoom' "; 
    mysqli_query($mysqli,$sql_2);
    header('Location:../pages/admin_index.php?manage=listDepartment&success='.'Sửa thành công');

}

?>