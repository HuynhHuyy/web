<?php
  if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
    $sql = "SELECT * FROM Users WHERE Id = '$id'";
	  $query = mysqli_query($mysqli,$sql);
    $data = mysqli_fetch_array($query);
    $numberRoom = $data['numberRoom'];
  }
?>
<div class="container h-100 ">
  <h1 class="text-center">Thông tin cá nhân</h1>
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-lg-8 mb-4 mb-lg-0">
        <div class="card mb-3">
          <div class="row g-0" id="box">
            <div class="col-md-4 gradient-custom text-center">
              <img
                src="<?php echo "../images/".$data['avatar']; ?>"
                alt="Avatar"
                class="img-fluid my-5 rounded-circle"
              />
         <!-- //Sửa nút thay đổi ảnh đại diện -->
              <a class="btn btn-outline-primary btn-sm mb-3" data-toggle="modal" data-target="#avatar_btn">Thay đổi ảnh đại diện</a>
              <h5><?php echo $data['name']; ?></h5>
              <p><?php if($data['level'] == 0){echo 'Giám đốc';} else if($data['level'] == 1){echo 'Trưởng phòng';} else echo 'Nhân viên'; ?></p>
              <p><?php echo $data['gender']; ?></p>
            </div>
            <div class="col-md-8">
                <div class="card-body p-4">
                <h6>Liên lạc</h6>
                <hr class="mt-0 mb-4">
                <div class="row pt-1">
                    <div class="col-6 mb-3">
                    <h6>&#128516; Username</h6>
                    <p class="text-muted"><?php echo $data['username']; ?></p>
                    </div>
                    <div class="col-6 mb-3">
                    <h6> &#128222; Điện thoại</h6>
                    <p class="text-muted"><?php echo $data['phone']; ?></p>
                    </div>
                    <div class="col-6 mb-3">
                    <h6> &#127968; Địa chỉ</h6>
                    <p class="text-muted"><?php echo $data['address']; ?></p>
                </div>
            </div>
                <h6>Công ty</h6>
                <hr class="mt-0 mb-4">
                <div class="row pt-1">
                  <div class="col-6 mb-3">
                    <h6> &#127970; Phòng ban</h6>
                    <p class="text-muted"><?php echo $name['nameRoom']; ?></p>
                  </div>
                  <div class="col-6 mb-3">
                    <h6>&#127380; Mã phòng ban</h6>
                    <p class="text-muted"><?php echo $numberRoom ?></p>
                  </div>
                </div>
                <div class="d-flex justify-content-end">
                    <a class="btn btn-dark mr-1" href="/change_password.php">Change password</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<!-- //change avatar modal-->
  <form action="../admin/change_avatar_process.php" method="POST" class="modal fade" >
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h3 class="modal-title">Thêm phòng ban</h3>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
          <div class ="form-group">
            <label for="avatar">Chọn nơi lưu ảnh của bạn</label>
            <input type="file" name="avatar" class="form-control" placeholder="Chọn nơi lưu ảnh">
            <br>
          </div>
        </div>
        <!-- Modal footer -->
       
        <div class="errorMessage my-3"></div>
      </div>
    </div>
  </form>


<!-- //change avatar-->

  <div class="modal fade" id="avatar_btn" tabindex="-1" aria-labelledby="avatar_btn" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h2 class="modal-title w-100 btn-sm" >Thay đổi ảnh đại diện</h2>
      </div>
      <form action="../admin/change_avatar_process.php" method = "POST" enctype= multipart/form-data>
        <div class="modal-body">
          <div class ="form-group">
            <input class = "d-none" name = "get_level_user" value = "<? echo $data['level'] ?>" >
            <input class = "d-none" name = "get_id_user" value="<? echo $_SESSION['id']?>" > 
            <label for="avatar">Chọn nơi lưu ảnh của bạn</label>
            <input type="file" name="avatar" accept="image/*" class="form-control" required placeholder="Chọn nơi lưu ảnh">
            <br>
          </div>
        </div>
      <div class="modal-footer">
          <button type="submit" class="btn btn-primary" name="save_avatar">Lưu</button>
          <button type="button" class="btn btn-dark" data-dismiss="modal">Hủy</button>
        </div>
        </form>
      </div>
    
    </div>
  