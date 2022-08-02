<?php
    include('../config/config.php');
    if (isset($_POST['account'])) {
        $account = addslashes($_POST['account']);
        $fullname = addslashes($_POST['fullname']);
        $department = addslashes($_POST['department']);
        $phone = addslashes($_POST['phone']);
        $address = addslashes($_POST['address']);
        $gender = addslashes($_POST['gender']);

    } else {
        $account = '';
        $fullname = '';
        $department = '';
        $phone = '';
        $address = '';
        $gender = '';

    }
    $sql = "SELECT * FROM Users WHERE username = '$account'";
    $row = mysqli_query($mysqli,$sql);
    $count = mysqli_num_rows($row);
    
    if(isset($_POST['signup'])){
        if($count > 0){
            header("Location:../pages/admin_index.php?manage=listStaff&fail=".'Tài khoản đã tồn tại');
        }
        else{
            $hash_pass = password_hash($account,PASSWORD_BCRYPT)  ;
            $pass = $account;

            $sql_add = "INSERT INTO Users (username, pwd, name, numberRoom, phone, gender,address) VALUES ('$account', '$hash_pass', '$fullname','$department','$phone','$gender','$address')";
           
            mysqli_query($mysqli,$sql_add);
            header('Location:../pages/admin_index.php?manage=listStaff&success='.'Thêm thành công');
        }
    }
?>