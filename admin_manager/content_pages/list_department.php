<?php
	$sql = "SELECT * FROM Department";
	$query = mysqli_query($mysqli,$sql);
  $sql_user = "SELECT * FROM Users";
  $query_user = mysqli_query($mysqli,$sql_user);

?>
<!-- alert -->
<?php include('../includes/alert.php') ?>
<div class="container">
<a class="btn btn-primary mb-2" data-toggle="modal" data-target="#add-department">&#10133; Thêm phòng ban</a>
</div>
<!-- table -->
<div class="container min-vh-100" id="box">
  <h1>Danh sách phòng ban</h1>           
  <table class="table table-striped">
    <thead>
      <tr class = "text-center">
        <th>STT</th>
        <th>Tên phòng ban</th>
        <th>Mô tả</th>
        <th>Mã phòng ban</th>
        <th colspan = 3 >Thao tác</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $i = 1;
        while($data = mysqli_fetch_array($query)){
          ?>
          <tr class = "text-center" room ="<?php echo $data['numberRoom'] ?>" id="rows">
            <td class ="department_id"><?php echo $data['id']; ?></td>
            <td ><?php echo $i; ?></td>
            <td ><?php echo $data['nameRoom']; ?></td>
            <td><?php echo $data['description']; ?></td>
            <td ><?php echo $data['numberRoom'] ;?></td>
            <td>
              <a href="#" class="btn btn-primary view_btn">Xem</a>    
            </td>
            <td>
              <a href="#" class="btn btn-primary edit_btn">Sửa</a>    
            </td>
            <td>
              <a href="#" class="btn btn-danger delete_btn">Xóa</a>
            </td>
          </tr>
        <?php
          $i++;
        }
      ?>
    </tbody>
  </table>
</div>
<!-- add department -->
<form action="../admin/add_department_process.php" method="post" class="modal fade" id="add-department">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h3 class="modal-title">Thêm phòng ban</h3>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
            <label for="nameRoom">Tên phòng ban</label>
            <input type="text" name="nameRoom" id="nameRoom" class="form-control" placeholder="Tên phòng ban">
            <br>
            <label for="numberRoom">Số phòng</label>
            <input type="text" name="numberRoom" id="numberRoom" class="form-control" placeholder="Số phòng">
            <br>
            <label for="description">Mô tả</label>
            <textarea id="description" name="description" rows="4" class="form-control" placeholder="Mô tả" required></textarea>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" name="create">Tạo</button>
          <button type="button" class="btn btn-dark" data-dismiss="modal">Hủy</button>
        </div>
        <div class="errorMessage my-3"></div>
      </div>
    </div>
  </form>


  <!-- //View modal -->
  <!-- Modal -->
<div class="modal fade" id="view-department" tabindex="-1" aria-labelledby="view-department" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h2 class="modal-title w-100" id="exampleModalLabel">Chi tiết phòng ban</h2>
      </div>
      <div class="modal-body">
        <div class ="department_viewing_data w-100">
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-dark" data-dismiss="modal">Đóng</button>
      </div>
    </div>
  </div>
</div>


<!-- //edit modal -->
<div class="modal fade" id="editdepartment" tabindex="-1" aria-labelledby="editdepartment" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Sửa thông tin phòng ban</h3>
      </div>
  <form action="../admin/edit_department_process.php" method="POST">
        <!-- Modal body -->
        <div class="modal-body">
            <input type="hidden" name = "edit_id" id ="edit_id">
            <div class ="form-group">
              <label for="nameRoom">Tên phòng ban</label>
              <input type="text" name="nameRoom" id="edit_nameRoom" class="form-control" placeholder="Tên phòng ban">
            </div>
            <br>
            <div class ="form-group">
            <label for="user">Trưởng phòng</label>
            <select name="id_leader"  class="form-select form-select-lg mb-3 form-control" id ="list_leader" >
              <option selected></option>
              <?php
                while($data_user = mysqli_fetch_array($query_user)){
                  ?><option value="<?php echo $data_user['username'] ?>"><?php echo $data_user['name'] ?></option>
                  <?php
                }
              ?>
            </select>
              </div>
            <br>

            <div class ="form-group">
            <label for="numberRoom">Số phòng</label>
            <input type="text" name="numberRoom" id="edit_numberRoom" class="form-control" placeholder="Số phòng">
            </div>
            <br>
            <div class ="form-group">
            <label for="description">Mô tả</label>
            <input type="text" name="description" id="edit_description" class="form-control" placeholder="Mô tả">
          </div>
      </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" name="edit_department">Lưu</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  
  <!-- //delete modal -->
  <div class="modal fade" id="delete-department" tabindex="-1" aria-labelledby="delete-department" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h2 class="modal-title w-100" id="delete-department">Xoá phòng ban</h2>
      </div>
        <form action="../admin/delete_department_process.php" method = "POST">

        <div class="modal-body">

        <input type = "hidden" name="department_id" id ="delete_id">
           <h3>Bạn có chắc xoá phòng ban này ?</h3>
      </div>
      <div class="modal-footer">
      <button type="submit" name="delete_department" class="btn btn-danger">Xoá</button>
        <button type="button" class="btn btn-dark" data-dismiss="modal">Đóng</button>
      </div>
      </form>
    </div>
    
  </div>
  
</div>
