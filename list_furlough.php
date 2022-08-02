<?php
  $id = $_SESSION['id'];
	$sql = "SELECT * FROM Furlough, Users WHERE Furlough.id_sender = Users.Id AND id_sender = '$id' ORDER BY date_send DESC";
	$query = mysqli_query($mysqli,$sql);
  $dayRemain =$user['sumDay'] - $user['sumOff'];

  $sql_remain = "SELECT * FROM Furlough, Users WHERE Furlough.id_sender = Users.Id AND id_sender = '$id' ORDER BY date_send DESC";
	$query_remain = mysqli_query($mysqli,$sql_remain);
  $date_send = mysqli_fetch_array($query_remain);
  if(isset($date_send['date_send'])){
    $date_send1 = date("Y-m-d", strtotime($date_send['date_send']));
    $datetime1 = date_create($date_send1);
    $datetime2 = date_create(date("Y-m-d"));
    $interval = date_diff($datetime1, $datetime2);
    $num_day_remain = $interval->d;
  }
?>
<!-- alert -->
<?php include('../includes/alert.php') ?>
<div class="container">
<a class="btn btn-primary mb-2 <?php if($num_day_remain < 7 && isset($num_day_remain)){ ?> disabled <?php } ?>" data-toggle="modal" data-target="#add-form">&#10133; Thêm yêu cầu</a>
</div>

<!-- table -->
<div class="container min-vh-100" id="box">
<h1>Nghỉ phép</h1>   
  <!-- Nav pills -->   
  <ul class="nav nav-pills" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="pill" href="#info">Thông tin</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="pill" href="#list">Danh sách đơn</a>
    </li>
  </ul>
  <!-- Tab panes -->
  <div class="tab-content">
    <!-- Tab Info -->
    <div id="info" class="container tab-pane active text-center"><br>
      <h2>Thông tin nghỉ phép </h2>
      <p> Tổng số ngày có thể nghỉ trong năm: <?php echo $user['sumDay'] ?></p>
      <p> Số ngày đã nghỉ trong năm: <?php echo $user['sumOff'] ?></p>
      <p> Số ngày có thể nghỉ: <?php echo $dayRemain ?></p>
    </div>
    <!-- Tab List -->
    <div id="list" class="container tab-pane"><br>
      <table class="table table-striped" data-spy="scroll" data-target=".navbar" data-offset="50">
        <thead>
          <tr>
            <th class="text-center">STT</th>
            <th>Người gửi</th>
            <th>Ngày gửi</th>
            <th>Lí do</th>
            <th class="text-center">Trạng thái</th>
            <th class="text-center">Thao tác</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $i = 1;
            while($data = mysqli_fetch_array($query)){
              $date_send = date_create($data['date_send']);
              ?>
              <tr id = "rows">
                <td class="text-center"><?php echo $i; ?></td>
                <td><?php echo $data['name']; ?></td>
                <td ><?php echo date_format($date_send,'d/m/Y')?></td>
                <td><?php echo $data['reason']; ?></td>
                <!-- #0: new #1: in progress #2: waiting #3: completed -->
                <td class="text-center"><?php switch($data['status']){
                    case 0:
                      ?><span class="badge badge-pill badge-warning">Waiting</span><?php
                      break;
                    case 1:
                      ?><span class="badge badge-pill badge-success">Approved</span><?php
                      break;
                    case 2:
                      ?><span class="badge badge-pill badge-danger">Refused</span><?php
                      break;
                } ?></td>
                <td class="text-center">
                <a href="<?php echo $url?>?manage=detailForm&idForm=<?php echo $id_receiver = $data['idForm']; ?>" type="submit" id="detail-form" class="btn btn-danger"> Chi tiết </a>
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
<!-- add application -->
<form action="../admin/add_form_process.php?&url=<? echo $url ?>" method="post" class="modal fade" id="add-form" enctype= multipart/form-data>
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h3 class="modal-title">Đơn xin nghỉ phép</h3>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
          <div class="form-group">
            <label for="numDay">Chọn số ngày muốn nghỉ</label>
            <select class="form-control" name="numDay" id="numDay">
              <?php for($i = 0; $i <= $dayRemain;  $i++){
                  ?><option value="<?php echo $i ?>"><?php echo $i ?></option><?php
              }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label for="reason">Lí do</label>
            <textarea id="reason" name="reason" rows="4" class="form-control" placeholder="Nội dung" required></textarea>
          </div>
          <div class="form-group">
              <label for="date_off">Ngày bắt đầu nghỉ</label>
              <input class="form-control" type="date" id="date_off" name="date_off">
          </div>
          <div class="form-group">
                    <label for="upfile">Tệp đính kèm</label>
                    <input type="file" name="uploadfile" class="form-control">
                </div>
          <input id="numberRoom" name="numberRoom" value="<?php echo $room ?>" class="d-none"></input>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary <?php if($dayRemain == 0){ echo "disabled"; } ?>" name="form">Tạo</button>
          <button type="button" class="btn btn-dark" data-dismiss="modal">Hủy</button>
          
        </div>
        <div class="errorMessage my-3"></div>
      </div>
    </div>
  </form>
