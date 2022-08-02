<?php
    //  $file = $_FILES["uploadfile"]['name'];
    $id = $_GET['idForm'];
	$sql_form = "SELECT * FROM Furlough WHERE idForm = '$id'";
	$query_form = mysqli_query($mysqli,$sql_form);
    $form = mysqli_fetch_array($query_form);
    if($form['status'] == 0){
        $status = 'WAITING';
        $bg = 'bg-warning';
    } else if($form['status'] == 1){
        $status = 'APPROVE';
        $bg = 'bg-success';
    }
     else{
        $status = 'REFUSE';
        $bg = 'bg-danger';
    }
     
?>
<div class="container ">
    
        <div class="card col-md-6 mx-sm-auto" id="box">
            <div class="card-header <?php echo $bg ?> text-white rounded">
                <h1 class="text-center mb-3"><?php echo $status ?></h1>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="numDay">Số ngày muốn nghỉ</label>
                    <p><?php echo $form['numDay'] ?></p>
                </div>
                <div class="form-group">
                    <label for="email">Lí do</label>
                    <p><?php echo $form['reason'] ?></p>
                </div>
                <div class="form-group">
                    <label class="col-form-label">Ngày bắt đầu nghỉ</label>
                    <p><?php echo $form['date_off'] ?></p>
                </div>
                <div class="form-group">
                    <label class="col-form-label">Ngày gửi</label>
                    <p class="text-danger"><?php echo $form['date_send'] ?></p>
                </div>
             
                <div class="form-group">
                    <label for="exampleFormControlFile1">Tệp đính kèm: </label>
                <a href="../admin/download_form.php?files=<?php echo $form['files'] ?>"><?php echo $form['files'] ?></a>


            </div>
            <div class="card-footer">
                <a href="../pages/<?php echo $url ?>?manage=furlough" class="btn btn-dark mt-3">Close</a>
            </div>
        </div>
    
</div>

