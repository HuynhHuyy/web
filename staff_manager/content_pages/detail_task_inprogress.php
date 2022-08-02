<?php
    $id = $_GET['idTask'];
	$sql_task = "SELECT * FROM Task WHERE id = '$id'";
	$query_task = mysqli_query($mysqli,$sql_task);
    $task = mysqli_fetch_array($query_task);

    $date_send = date_create($task['date_send']);
    $date_deadline = date_create($task['due']);
?>
<div class="container ">
    <form action="../admin/task_status_process.php?idTask=<?php echo $id ?>" method="post" enctype= multipart/form-data>
        <div class="card col-md-6 mx-sm-auto" id="box">
            <div class="card-header bg-primary text-white rounded">
                <h1 class="text-center mb-3">IN PROGRESS</h1>
            </div>
            <div class="card-body">
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
                    <label for="description">Mô tả</label>
                    <textarea id="description" name="description" rows="4" class="form-control" placeholder="Mô tả"></textarea>
                </div>

                <div class="form-group">
                    <label for="exampleFormControlFile1">File mô tả:</label>
                <a href="../admin/download_form.php?files=<?php echo $task['files'] ?>"><?php echo $task['files'] ?></a>
            </div>

                <div class="form-group">
                    <label for="exampleFormControlFile1">Tệp đính kèm</label>
                    <input type="file" name ="staff_file" class="form-control-file" id="exampleFormControlFile1">
                </div>
                <div class="form-group">
                    <label class="col-form-label">Hạn Deadline</label>
                    <p class="text-danger"><?php echo date_format($date_deadline, 'd/m/Y') ?></p>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" name="submit" class="btn btn-success">Submit</button>
                <button class="btn btn-dark mt-3">Close</button>
            </div>
        </div>
    </form>
</div>
