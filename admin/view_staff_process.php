<?php
    include('../config/config.php');
    if(isset($_POST['checking_staffviewbtn'])){
        $s_username = $_POST['staffusername'];

        // echo $return = $d_name;

        $sql = "SELECT * FROM Users, Department WHERE Users.numberRoom = Department.numberRoom AND username = '$s_username' LIMIT 1";//$sql = $query
        $row = mysqli_query($mysqli,$sql);      //$row = $query_run   $mysqli = $conn $data = $rows

        if(mysqli_num_rows($row) > 0){
            foreach($row as $data){
                echo $return = '
                <table class="table">
                    <img
                        src="../images/'.$data['avatar'].'"
                        alt="Avatar"
                        class="img-fluid my-5 rounded-circle rounded mx-auto d-block"
                    />
                    <tr>
                        <td> ID:</td> 
                        <td>'.$data['Id'].'</td>
                    </tr>
                    <tr>
                        <td> Họ và tên: </td> 
                        <td>'.$data['name'].'</td>
                    </tr>
                    <tr>
                        <td> Giới tính: </td> 
                        <td> '.$data['gender'].'</td>
                    </tr>
                    <tr>
                        <td> Phòng ban: </td> 
                        <td>'.$data['nameRoom'].'</td>
                    </tr>

                    <tr>
                        <td> Số điện thoại: </td> 
                        <td>'.$data['phone'].'</td>
                    </tr>
                    <tr>
                        <td> Địa chỉ: </td> 
                        <td>'.$data['address'].'</td>
                    </tr>
                </table>
                ';
            }
        }
        else{
            echo $return ="<h5> Not Found</h5>";
        }
    }
?>