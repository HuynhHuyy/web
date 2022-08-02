<?php
    include('../config/config.php');
    if(isset($_POST['checking_leaderformbtn'])){
        $form_id = $_POST['form_id'];

        $sql = "SELECT * FROM Furlough WHERE idForm = '$form_id'";

        $row = mysqli_query($mysqli,$sql);  
        

        if(mysqli_num_rows($row) > 0){
            foreach($row as $data){
                $get_data_id = $data['id_sender'];
                $sql_1 =  "SELECT * FROM Users WHERE Id = '$get_data_id'";
                $row_1 = mysqli_query($mysqli,$sql_1);  
                $data_username = mysqli_fetch_array($row_1);
                echo $return = '
                <table class="table">
                    <tr>
                        <td> Họ và tên: </td> 
                        <td>'.$data_username['name'].'</td>
                    </tr>
                    <tr>
                        <td> Mã phòng ban: </td> 
                        <td>'.$data_username['numberRoom'].'</td>
                     </tr>

                    <tr>
                    <td> Lý do: </td> 
                    <td>'.$data['reason'].'</td>
                    </tr>

                    <tr>
                        <td> Ngày gửi: </td> 
                        <td>'.$data['date_send'].'</td>
                    </tr>
                    <tr>
                        <td> Ngày bắt đầu nghỉ: </td> 
                        <td>'.$data['date_off'].'</td>
                    </tr>
                <tr>
                    <td> Số ngày muốn nghỉ: </td> 
                    <td>'.$data['numDay'].'</td>
                </tr>
                <tr>
              
                <td> Tệp đính kèm: </td> 
                <td >'.$data['files'].'</td>
            </tr>
                </table>
                
                
                <input class ="d-none" type="text" name = "form_id" id ="form_id" value = '.$data['idForm'].'>
                ';
                
            }
            
           
        }else{
                echo $return ="<h5> Not Found</h5>";
            }

    }


//đồng ý


if(isset($_POST['approved_btn'])){
    $form_id = $_POST['form_id'];

    $sql_level = "SELECT * FROM Users, Furlough WHERE Id = id_sender and idForm = '$form_id'";

    $sql_level_run = mysqli_query($mysqli,$sql_level);

    $sql_row = mysqli_fetch_array($sql_level_run);

    $sql = "UPDATE Furlough SET status = 1 WHERE idForm = '$form_id'";
    $sql_run =  mysqli_query($mysqli,$sql);
    $sql_user = "UPDATE Users, Furlough SET sumOff = numDay WHERE Id = id_sender and idForm = '$form_id'";
    $sql_user_run = mysqli_query($mysqli,$sql_user);
    
    if( $sql_row['level'] == 1){
        if($sql_run){
            if($sql_user_run){
            header('Location:/pages/admin_index.php?manage=list_applicationform');
        }else{
            echo "Lỗi data";
        }
        }else{
            echo "lỗi";
        }

    }else{
        if($sql_run){
            if($sql_user_run){
            header('Location:/pages/department_index.php?manage=list_applicationform');
        }else{
            echo "Lỗi data";
        }
        }else{
            echo "lỗi";
        }

    }

    }

if(isset($_POST['refused_btn'])){
    $form_id = $_POST['form_id'];


    $form_id = $_POST['form_id'];

    $sql_level = "SELECT * FROM Users, Furlough WHERE Id = id_sender and idForm = '$form_id'";

    $sql_level_run = mysqli_query($mysqli,$sql_level);

    $sql_row = mysqli_fetch_array($sql_level_run);

    $sql_refused = "UPDATE Furlough SET status = 2 WHERE idForm = '$form_id'";
    $sql_run =  mysqli_query($mysqli,$sql_refused);
    $sql_user = "UPDATE Users, Furlough SET sumOff = numDay WHERE Id = id_sender and idForm = '$form_id'";
    $sql_user_run = mysqli_query($mysqli,$sql_user);


   
//    $sql_run =  mysqli_query($mysqli,$sql_refused);
if( $sql_row['level'] == 1){
    if($sql_run){
        if($sql_user_run){
            header('Location:/pages/admin_index.php?manage=list_applicationform');
        }else{
            echo "lỗi data";
        }
    }else{
        echo "lỗi";
    }
}else{
    if($sql_run){
        if($sql_user_run){
        header('Location:/pages/department_index.php?manage=list_applicationform');
    }else{
        echo "Lỗi data";
    }
    }else{
        echo "lỗi";
    }

    }

}






?>