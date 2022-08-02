<?php
    include('../config/config.php');
    if(isset($_POST['checking_viewbtn'])){
        $d_id = $_POST['department_id'];

        // echo $return = $d_id;
        $sql = "SELECT * FROM Department WHERE id = '$d_id'";
        $sql_leader = "SELECT * FROM Users, Department WHERE Users.Id = id_staff and Department.id = '$d_id'";//$sql = $query
        $row_leader = mysqli_query($mysqli,$sql_leader);      //$row = $query_run   $mysqli = $conn $data = $rows
        $row = mysqli_query($mysqli,$sql);  

        if(mysqli_num_rows($row) > 0){
            if(mysqli_num_rows($row_leader) > 0){
                foreach($row_leader as $data){
                    echo $return = '
                    <table class="table">
                        <tr>
                            <td> Tên phòng ban: </td> 
                            <td>'.$data['nameRoom'].'</td>
                        </tr>
                        <tr>
                        <td> Tên trưởng phòng: </td> 
                        <td>'.$data['name'].'</td>
                        </tr>
    
                        <tr>
                            <td> Mô tả: </td> 
                            <td>'.$data['description'].'</td>
                        </tr>
                        <tr>
                            <td> Số phòng: </td> 
                            <td>'.$data['numberRoom'].'</td>
                        </tr>
                    </table>
                    ';
                }


            }else{
                foreach($row as $data){
                    echo $return = '
                    <table class="table">
                        <tr>
                            <td> Tên phòng ban: </td> 
                            <td>'.$data['nameRoom'].'</td>
                        </tr>
                        <tr>
                        <td> Tên trưởng phòng: </td> 
                        <td>Trống</td>
                        </tr>
    
                        <tr>
                            <td> Mô tả: </td> 
                            <td>'.$data['description'].'</td>
                        </tr>
                        <tr>
                            <td> Số phòng: </td> 
                            <td>'.$data['numberRoom'].'</td>
                        </tr>
                    </table>
                    ';
                }  

            }  
        }
        else{
            echo $return ="<h5> Not Found</h5>";
        }
    }
?>