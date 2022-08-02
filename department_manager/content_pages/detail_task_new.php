<?php
    $id = $_GET['idTask'];
	$sql_task = "SELECT * FROM Task WHERE  id = '$id' LIMIT 1";
	$query_task = mysqli_query($mysqli,$sql_task);
    $task = mysqli_fetch_array($query_task);

    $id_staff = $task['id_receiver'];
    $sql_staff = "SELECT * FROM Users WHERE  Id = '$id_staff' LIMIT 1";
    $query_staff = mysqli_query($mysqli,$sql_staff);
    $name = mysqli_fetch_array($query_staff);
    $date_send = date_create($task['date_send']);
    $date_deadline = date_create($task['due']);
?>
<div class="container ">
    <form action="../admin/task_status_department_process.php?idTask=<?php echo $id ?>" method="post" enctype= multipart/form-data>
        <div class="card col-md-6 mx-sm-auto" id="box">
            <div class="card-header bg-danger text-white rounded">
                <h1 class="text-center mb-3">NEW</h1>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Nhân viên</label>
                    <p><?php echo $name['name'] ?></p>
                </div>
                <div class="form-group">
                    <label for="name">Tiêu đề</label>
                    <p><?php echo $task['tittle'] ?></p>
                </div>
                <div class="form-group">
                    <label for="email">Nội dung</label>
                    <p><?php echo $task['content'] ?></p>
                </div>
                <div class="form-group">
                    <label class="col-form-label">Ngày giao</label>
                    <p><?php echo date_format($date_send, 'd/m/Y') ?></p>
                </div>
                <div class="form-group">
                    <label class="col-form-label">Hạn Deadline</label>
                    <p class="text-danger"><?php echo date_format($date_deadline, 'd/m/Y') ?></p>
                </div>
              
            </div>
            <div class="form-group">
                    <label for="exampleFormControlFile1">Tệp đính kèm</label>
                <a href="../admin/download_form.php?files=<?php echo $task['files'] ?>" ><?php echo $task['files'] ?></a>
            </div>
            <div class="card-footer">
                <button type="submit" name="cancel" class="btn btn-danger">Cancel</button>
                <button class="btn btn-dark mt-3">Close</button>
            </div>
         
        </div>
    </form>
   
</div>


