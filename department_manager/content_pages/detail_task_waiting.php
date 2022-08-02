<?php
    $id = $_GET['idTask'];
	$sql_task = "SELECT * FROM Task WHERE id = '$id'";
	$query_task = mysqli_query($mysqli,$sql_task);
    $task = mysqli_fetch_array($query_task);
    $date_submit = date_create($task['date_submit']);

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
            <div class="card-header bg-warning text-white rounded">
                <h1 class="text-center mb-3">WAITING</h1>
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
                    <label for="description">Mô tả</label>
                    <p><?php echo $task['description_task'] ?></p>
                </div>
                <div class="form-group">
                    <label class="col-form-label">Hạn Deadline</label>
                    <p class="text-danger"><?php echo date_format($date_deadline, 'd/m/Y') ?></p>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlFile1">Tệp đính kèm:</label>
                <a href="../admin/download_form.php?files=<?php echo $task['files'] ?>" ><?php echo $task['files'] ?></a>
            </div>

            <div class="form-group">
                    <label for="exampleFormControlFile1">Tệp đính kèm của nhân viên:</label>
                <a href="../admin/download_form.php?files=<?php echo $task['files_staff'] ?>"><?php echo $task['files_staff'] ?></a>
            </div>
                <div class="form-check form-check-inline">
                    <?php if($date_deadline >= $date_submit){   
                    ?> 
                    <input class="form-check-input" type="radio" name="rate" id="rate" value="Good">
                    <label class="form-check-label mr-5" for="rate">Good</label>
                    <?php }
                    ?>
                    <input class="form-check-input" type="radio" name="rate" id="rate" value="Ok">
                    <label class="form-check-label mr-5" for="rate">Ok</label>
                    <input class="form-check-input" type="radio" name="rate" id="rate" value="Bad" checked>
                    <label class="form-check-label" for="rate">Bad</label>
                </div>
            </div>
            <div class="card-footer">
                <span class="d-flex justify">
                    <button type="approve" name="approve" class="btn btn-outline-success col-6">Approve</button>
                    <a class="btn btn-outline-secondary col-6" data-toggle="modal" data-target="#reject">Reject</a>
                </span>
                <button class="btn btn-dark mt-3">Close</button>
            </div>
        </div>
    </form>
</div>

<!-- reject -->
<form action="../admin/task_status_department_process.php?idTask=<?php echo $id ?>" method="post" class="modal fade" id="reject" enctype= multipart/form-data>
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h3 class="modal-title">REJECT</h3>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
            <div class="form-group">
                <label for="feedback">Feedback</label>
                <textarea id="feedback" name="feedback" rows="4" class="form-control" placeholder="Feedback" required></textarea>
            </div>
            <div class="form-group">
                <label for="deadline">Deadline</label>
                <input class="form-control"type="date" id="deadline" name="deadline" required>
            </div>
            <div class="form-group">
              <label for="exampleFormControlFile1">Tệp đính kèm</label>
              <input type="file" name="reject_name"  class="form-control" >
          </div>
        
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" name="reject">Gửi</button>
          <button type="button" class="btn btn-dark" data-dismiss="modal">Hủy</button>
        </div>
        <div class="errorMessage my-3"></div>
      </div>
    </div>
  </form>


