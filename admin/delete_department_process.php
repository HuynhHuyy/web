<?php
    include('../config/config.php');

    if(isset($_POST['delete_department'])){
        $id = $_POST['department_id'];

        $sql_numberRoom = "SELECT numberRoom FROM Department WHERE id = '$id'";
        $sql_run = mysqli_query($mysqli,$sql_numberRoom);
        $room =  mysqli_fetch_array($sql_run);
        $select_room =  $room['numberRoom'];

        $sql_user = "SELECT numberRoom FROM Users WHERE numberRoom = '$select_room' ";
        $sql_row = mysqli_query($mysqli,$sql_user);
        
        $count = mysqli_num_rows($sql_row);
        if($count > 0){
            header('Location:../pages/admin_index.php?manage=listDepartment&fail='.'Không thể xoá vì phòng này có nhân viên');
        }else{
        $sql = "DELETE FROM Department WHERE id = '$id'";
        mysqli_query($mysqli,$sql);
        header('Location:../pages/admin_index.php?manage=listDepartment&success='.'Xoá thành công');
    }
}
?>