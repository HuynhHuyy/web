<?php
  $id = $_SESSION['id'];
	$sql = "SELECT * FROM Task, Users WHERE Task.id_receiver = Users.Id AND id_sender = '$id' ORDER BY date_send DESC";
	$query = mysqli_query($mysqli,$sql);

  $sql_waiting = "SELECT * FROM Task, Users WHERE Task.id_receiver = Users.Id AND id_sender = '$id' AND Task.status = 2 ORDER BY date_send DESC";
	$query_waiting = mysqli_query($mysqli,$sql_waiting);

  $sql_completed = "SELECT * FROM Task, Users WHERE Task.id_receiver = Users.Id AND id_sender = '$id' AND Task.status IN (3,5) ORDER BY date_send DESC";
	$query_completed = mysqli_query($mysqli,$sql_completed);

  $numberRoom = $user['numberRoom'];
	$sql_staff = " SELECT * FROM Users WHERE numberRoom = '$numberRoom' AND Id != '$id' ";
	$query_staff = mysqli_query($mysqli,$sql_staff);
?>
<!-- alert -->
<?php include('../includes/alert.php') ?>
<div class="container">
<a class="btn btn-primary mb-2" data-toggle="modal" data-target="#add-task">&#10133; Thêm task</a>
</div>

<!-- table -->
<div class="container min-vh-100" id="box">
<h1>Danh sách công việc</h1>   
  <!-- Nav pills -->   
  <ul class="nav nav-pills" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="pill" href="#all">All</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="pill" href="#waiting">Waiting</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="pill" href="#completed">Completed</a>
    </li>
  </ul>
  <!-- Tab panes -->
  <div class="tab-content">
    <!-- Tab All -->
    <div id="all" class="container tab-pane active"><br>
      <table class="table table-striped" data-spy="scroll" data-target=".navbar" data-offset="50">
        <thead>
          <tr>
            <th class="text-center">STT</th>
            <th>Tittle</th>
            <th>Người được giao</th>
            <th>Nội dung</th>
            <th class="text-center">Trạng thái</th>
            <th class="text-center">Thao tác</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $i = 1;
            while($data = mysqli_fetch_array($query)){
              ?>
              <tr id = "rows">
                <td class="text-center"><?php echo $i; ?></td>
                <td><?php echo $data['tittle']; ?></td>
                <td><?php echo $data['name']; ?></td>
                <td class="d-inline-block text-break" ><?php echo $data['content']; ?></td>
                <!-- #0: new #1: in progress #2: waiting #3: completed -->
                <td class="text-center"><?php switch($data['status']){
                    case 0:
                      ?><span class="badge badge-pill badge-danger">New</span><?php
                      break;
                    case 1:
                      ?><span class="badge badge-pill badge-info">In progress</span><?php
                      break;
                    case 2:
                      ?><span class="badge badge-pill badge-warning">Waiting</span><?php
                      break;
                    case 3:
                      ?><span class="badge badge-pill badge-success">Completed</span><?php
                      break;
                    case 4:
                      ?><span class="badge badge-pill badge-secondary">Rejected</span><?php
                      break;
                    default:
                      ?><span class="badge badge-pill badge-light">Cancel</span><?php
                } ?></td>
                 <td class="text-center">
                  <a href="../pages/department_index.php?manage=detailTask<?php echo $data['status'] ?>&idTask=<?php echo $data['id'] ?>" type="submit" id="detail-task" class="btn btn-danger"> Chi tiết </a>
                </td>
              </tr>
            <?php
              $i++;
            }
          ?>
        </tbody>
      </table>
    </div>
    <!-- Tab Waiting -->
    <div id="waiting" class="container tab-pane fade"><br>
      <table class="table table-striped" data-spy="scroll" data-target=".navbar" data-offset="50">
        <thead>
          <tr>
            <th class="text-center">STT</th>
            <th>Tittle</th>
            <th>Người được giao</th>
            <th>Nội dung</th>
            <th class="text-center">Trạng thái</th>
            <th class="text-center">Thao tác</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $i = 1;
            while($data_waiting = mysqli_fetch_array($query_waiting)){
              ?>
              <tr id = "rows">
                <td class="text-center"><?php echo $i; ?></td>
                <td><?php echo $data_waiting['tittle']; ?></td>
                <td><?php echo $data_waiting['name']; ?></td>
                <td class="d-inline-block text-truncate" ><?php echo $data_waiting['content']; ?></td>
                <!-- #0: new #1: in progress #2: waiting #3: completed -->
                <td class="text-center"><span class="badge badge-pill badge-warning">Waiting</span></td>
                <td class="text-center">
                  <a href="../pages/department_index.php?manage=detailTask<?php echo $data_waiting['status'] ?>&idTask=<?php echo $data_waiting['id'] ?>" type="submit" id="detail-task" class="btn btn-danger"> Chi tiết </a>
                </td>
              </tr>
            <?php
              $i++;
            }
          ?>
        </tbody>
      </table>
    </div>
    <!-- Tab Completed -->
    <div id="completed" class="container tab-pane fade"><br>
    <table class="table table-striped" data-spy="scroll" data-target=".navbar" data-offset="50">
        <thead>
          <tr>
            <th class="text-center">STT</th>
            <th>Tittle</th>
            <th>Người được giao</th>
            <th>Nội dung</th>
            <th class="text-center">Trạng thái</th>
            <th class="text-center">Thao tác</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $i = 1;
            while($data_completed = mysqli_fetch_array($query_completed)){
              ?>
              <tr id = "rows">
                <td class="text-center"><?php echo $i; ?></td>
                <td><?php echo $data_completed['tittle']; ?></td>
                <td><?php echo $data_completed['name']; ?></td>
                <td class="d-inline-block text-break" ><?php echo $data_completed['content']; ?></td>
                <!-- #0: new #1: in progress #2: waiting #3: completed -->
                <td class="text-center"><?php switch($data_completed['status']){
                    case 3:
                      ?><span class="badge badge-pill badge-success">Completed</span><?php
                      break;
                    default:
                      ?><span class="badge badge-pill badge-light">Cancel</span><?php
                } ?></td>
                 <td class="text-center">
                  <a href="../pages/department_index.php?manage=detailTask<?php echo $data_completed['status'] ?>&idTask=<?php echo $data_completed['id'] ?>" type="submit" id="detail-task" class="btn btn-danger"> Chi tiết </a>
                </td>
              </tr>
            <?php
              $i++;
            }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<!-- add task -->
<form action="../admin/add_task_process.php" method="post" class="modal fade" id="add-task" enctype= multipart/form-data>
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h3 class="modal-title">Thêm Task</h3>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
          <div class="form-group">
            <label for="tittle">Tiêu đề</label>
            <input type="text" name="tittle" id="tittle" class="form-control" placeholder="Tiêu đề" required>
          </div>
          <div class="form-group">
            <label for="content">Nội dung</label>
            <textarea id="content" name="content" rows="4" class="form-control" placeholder="Nội dung" required></textarea>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="deadline">Deadline:</label>
              <input class="form-control" type="date" id="deadline" name="deadline">
            </div>
            <div class="form-group col-md-6">
              <label for="staff">Nhân viên:</label> <br>
              <select name="staff" class="form-control">
                <?php
                  while($data_staff = mysqli_fetch_array($query_staff)){
                    ?><option value="<?php echo $data_staff['Id'] ?>"><?php echo $data_staff['name'] ?>  -  (<?php echo $data_staff['username'] ?>)</option>
                    <?php
                  }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group">
              <label for="exampleFormControlFile1">Tệp đính kèm</label>
              <input type="file" name = "uploadfile_task" class="form-control" >
          </div>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" name="task">Tạo</button>
          <button type="button" class="btn btn-dark" data-dismiss="modal">Hủy</button>
        </div>
        <div class="errorMessage my-3"></div>
      </div>
    </div>
  </form>
