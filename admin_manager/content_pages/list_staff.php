<?php
	$sql = "SELECT * FROM Users";
  $sql_department = "SELECT * FROM Department";
	$query = mysqli_query($mysqli,$sql);
  $query_department = mysqli_query($mysqli,$sql_department);
?>
<?php include('../includes/alert.php') ?>
<div class="container">
<a class="btn btn-primary mb-2" data-toggle="modal" data-target="#add-staff">&#10133;Thêm nhân viên</a>
</div>
<!-- table -->
<div class="container min-vh-100" id="box">
  <h1>Danh sách nhân viên</h1>        
  <table class="table table-striped" data-spy="scroll" data-target=".navbar" data-offset="50">
    <thead>
      <tr class="text-center">
        <th>STT</th>
        <th>Họ và Tên</th>
        <th>Username</th>
        <th>Chức vụ</th>
        <th colspan=3> Thao tác</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $i = 1;
        while($data = mysqli_fetch_array($query)){
          ?>
          <tr id = "rows" class = "text-center"> 
            <td ><?php echo $i; ?></td>
            <td ><?php echo $data['name']; ?></td>
            <td class = "viewstaffusername"><?php echo $data['username']; ?></td>
            <td><?php if($data['level'] == 0){echo 'Giám đốc';} else if($data['level'] == 1){echo 'Trưởng phòng';} else echo 'Nhân viên'; ?></td> 
            <td>
              <a class="btn btn-primary staffview_btn">Xem</a>
            </td>

            <td>
              <a  type="submit" id="delete" class="btn btn-danger" data-toggle="modal" data-target="#delete-staff" data-id="<?php echo $data['Id'] ?>">Xóa</a>
            </td>
            <td>
              <a class="btn btn-primary" href="../admin/reset_staff_process.php?id=<?php echo $data['Id']; ?>" onclick="return confirm('Bạn có chắc muốn reset password?')">Reset</a>
            </td>
            
          </tr>
        <?php
          $i++;
        }
      ?>
    </tbody>
  </table>
</div>
<!-- Add staff modal -->
<form action="../admin/add_staff_process.php" method="post" class="modal fade" id="add-staff">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h3 class="modal-title">Thêm nhân viên</h3>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
            <label for="fullname">Họ và Tên</label>
            <input type="text" name="fullname" id="fullname" class="form-control" placeholder="Họ và Tên" required>
            <br>
            <label for="username">Tên tài khoản</label>
            <input type="text" name="account" id="username" class="form-control" placeholder="username" required>
            <br>
            <label for="department">Phòng ban:</label> <br>
            <select name="department" class="form-select form-select-lg mb-3 form-control" aria-label=".form-select-lg example">
              <option selected>Chọn phòng ban</option>
              <?php
                while($data_department = mysqli_fetch_array($query_department)){
                  ?><option value="<?php echo $data_department['numberRoom'] ?>"><?php echo $data_department['nameRoom'] ?></option>
                  <?php
                }
              ?>
            </select>
            <br>
            <label for="gender">Giới tính:</label>
            <div class="form-check-inline">
                <label class="form-check-label">
                  <input type="radio" class="form-check-input ml-4" checked name="gender" value = "Nam">Nam
                  <input type="radio" class="form-check-input ml-4" name="gender" value = "Nữ">Nữ
              </label>
            </div>
            <br>
            <label for="address">Địa chỉ</label>
            <input type="text" name="address" id="address" class="form-control" placeholder="Địa chỉ" required>
            <br>
            <label for="phone">Số điện thoại</label>
            <input type="text" name="phone" id="phone" class="form-control" placeholder="Số điện thoại" required>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" name="signup">Tạo</button>
          <button type="button" class="btn btn-dark" data-dismiss="modal">Hủy</button>
        </div>
        <div class="errorMessage my-3"></div>
      </div>
    </div>
  </form>
<!-- Delete modal -->
  <form action="../admin/delete_staff_process.php" method="get" >
    <div class="modal fade" id="delete-staff">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header bg-danger text-white ">
                Xóa nhân viên
            </div>
            <div class="modal-body">
                <p>Bạn có chắc chắn muốn xóa?</p>
            </div>
            <div class="modal-footer">
                <input id="staffId" name="id" value="" class="d-none"></input>
                <button type="submit" id="delete-button" value="" class="btn btn-danger">Xóa</button>
                <button type="button" class="btn btn-dark" data-dismiss="modal">Không</button>
            </div>
        </div>
    </div>
    </div>
  </form>


  <!-- View modal -->
    <!-- Modal -->
<div class="modal fade" id="view-staff" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h2 class="modal-title w-100" id="exampleModalLabel">Thông tin chi tiết nhân viên</h2>
      </div>
      <div class="modal-body">
        <div class ="staff_viewing_data w-100">
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-dark" data-dismiss="modal">Đóng</button>
      </div>
    </div>
  </div>
</div>