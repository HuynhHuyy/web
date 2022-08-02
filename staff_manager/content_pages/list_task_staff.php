<?php
  $id = $_SESSION['id'];
	$sql = "SELECT * FROM Task WHERE id_receiver = '$id' AND Task.status != 5 ORDER BY date_send DESC";
	$query = mysqli_query($mysqli,$sql);

?>
<!-- table -->
<div class="container min-vh-100" id="box">
  <h1>Danh sách công việc</h1>        
  <table class="table table-striped" data-spy="scroll" data-target=".navbar" data-offset="50">
    <thead>
      <tr>
        <th class="text-center">STT</th>
        <th>Tittle</th>
        <th>Thời gian</th>
        <th>Nội dung</th>
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
            <td><?php echo $data['tittle']; ?></td>
            <td><?php echo date_format($date_send, 'd/m/Y') ?></td>
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
            } ?></td>
            <td class="text-center">
              <a href="../pages/staff_index.php?manage=detailTask<?php echo $data['status'] ?>&idTask=<?php echo $data['id'] ?>" type="submit" id="detail-task" class="btn btn-danger"> Chi tiết </a>
            </td>
          </tr>
        <?php
          $i++;
        }
      ?>
    </tbody>
  </table>
</div>