<?php
  $numberRoom = $user['numberRoom'];
	$sql = " SELECT * FROM Users WHERE numberRoom = '$numberRoom' AND Id != '$id' ";
	$query = mysqli_query($mysqli,$sql);
?>
<!-- table -->
<div class="container min-vh-100" id="box">
  <h1>Danh sách nhân viên</h1>        
  <table class="table table-striped " data-spy="scroll" data-target=".navbar" data-offset="50">
    <thead>
      <tr>
        <th>STT</th>
        <th>Họ và Tên</th>
        <th>Username</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $i = 1;
        while($data = mysqli_fetch_array($query)){
          ?>
          <tr id = "rows">
            <td><?php echo $i; ?></td>
            <td><?php echo $data['name']; ?></td>
            <td><?php echo $data['username']; ?></td>
          </tr>
        <?php
          $i++;
        }
      ?>
    </tbody>
  </table>
</div>