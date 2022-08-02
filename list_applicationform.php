<?php
  $level = $_SESSION['level']+1;
  $id = $_SESSION['id'];
  
	$sql_list_application = "SELECT * FROM Furlough, Users WHERE id_sender = Id AND id_receiver = $id AND level = $level ORDER BY date_send DESC";
  $query = mysqli_query($mysqli,$sql_list_application);

?>

<div class="container min-vh-100" id="box">
    <h1>Danh sách đơn nghỉ phép</h1>
    <table class="table table-striped ">
        <thead>
            <tr class="text-center">
                <th>STT</th>
                <th>Họ và Tên</th>
                <th>Lí do</th>
                <th>Ngày gửi</th>
                <th>Trạng thái</th>
                <?php if($_SESSION['level'] == 0){
          ?><th>Phòng ban</th><?php
        }
        ?>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php
      $i = 1;
        while($data = mysqli_fetch_array($query)){
          $date_send = date_create($data['date_send']);
          ?>
            <tr class="text-center" id="rows">
                <td class="form_id"><?php echo $data['idForm'] ?></td>
                

                <td><?php echo $i ?></td>
                <td><?php echo $data['name']; ?></td>
                <td><?php echo $data['reason'] ;?></td>
                <td><?php echo date_format($date_send,'d/m/Y')?></td>
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
                } ?>
                </td>
                <?php if($_SESSION['level'] == 0){
            ?>
                <td><?php echo $data['numberRoom'] ?></td><?php
                }
            ?>
                <td>
                    <a class="btn btn-primary view_departmentform"
                        id="leader_viewform <?php echo $data['idForm'] ?> ">Xem</a>
                </td>
            </tr>
            <?php
        $i++;
        }
      ?>
        </tbody>
    </table>
</div>


<!-- //view modal -->
<form action="../admin/leader_statusform_process.php" method="POST" enctype=multipart/form-data>
    <div class="modal fade" id="view_leaderform" tabindex="-1" aria-labelledby="view_leaderform" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h2 class="modal-title w-100" id="exampleModalLabel">Chi tiết đơn xin nghỉ phép</h2>
                </div>
                <div class="modal-body">
                    <div class="leaderform_viewing_data w-100">

                    </div>
                    <button class="btn btn-success" id="link_download">Nhấn vào đây để xem tệp đính kèm</button>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary approved_btn " name="approved_btn"
                        id="leader_approve">approved</button>
                    <button type="submit" class="btn btn-primary" name="refused_btn">refused</button>
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Hủy</button>
</form>

</div>

</div>
</div>

</div>