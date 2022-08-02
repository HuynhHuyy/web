<?php
    include('../config/config.php');

    if(isset($_POST['save_avatar'])){
       $id = $_POST['get_id_user'];
       $level_user = $_POST['get_level_user'];

        $image = $_FILES['avatar']['name'];
        $sql = "UPDATE Users SET  avatar = '$image' Where Id = '$id' ";
        $query = mysqli_query($mysqli,$sql);

        if($query){
            if($level_user == 0){
                move_uploaded_file($_FILES["avatar"]["tmp_name"],"../images/".$_FILES["avatar"]["name"]);
                header('Location: ../pages/admin_index.php?manage=profile');
            }else if($level_user == 1){
                move_uploaded_file($_FILES["avatar"]["tmp_name"],"../images/".$_FILES["avatar"]["name"]);
                header('Location: ../pages/department_index.php?manage=profile');
            }else{
                move_uploaded_file($_FILES["avatar"]["tmp_name"],"../images/".$_FILES["avatar"]["name"]);
                header('Location: ../pages/staff_index.php?manage=profile');
            }  
        }else{
            echo "Xảy ra lỗi";
        }
    }
?>