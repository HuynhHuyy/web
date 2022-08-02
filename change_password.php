<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="/style.css"> <!-- Sử dụng link tuyệt đối tính từ root, vì vậy có dấu / đầu tiên -->
	<title>Change Password</title>
</head>

<body>
    <?php
        include('config/config.php');
        if (isset($_GET['idStaff'])) {
            $idStaff = $_GET['idStaff'];
        } else {
            $idStaff = '';
        }
        $sql = "SELECT * FROM Users WHERE Id = '$idStaff'";
        $query = mysqli_query($mysqli,$sql);
    ?>
    <div class="container " id = "design_form">
        <div class="row">
            <div class="col-md-8 col-lg-5 my-5 mx-2 mx-sm-auto  px-3 py-3" id="box">    
                <h1 class="header text-center mb-3">Thay đổi mật khẩu</h1>
                <form action="admin/change_password_process.php" method="post">
                    <div class="form-group">
                        <label for="pwd">Mật khẩu cũ</label>
                        <input type="password" name="oldpassword" value="" id="oldpassword" class="form-control" placeholder="Your old password">
                    </div>
                    <div class="form-group">
                        <label for="pwd">Mật khẩu mới</label>
                        <input type="password" name="pwd" value="" id="pwd" class="form-control" placeholder="Your password">
                    </div>
                    <div class="form-group">
                        <?php
                            while($row = mysqli_fetch_array($query)){
                        ?>
                            <input type="text" name="idStaff" value="<?php echo $row['Id'];?>" class="form-control" require hidden>
                        <?php } ?>
                        
                        <label for="pwd-confirm">Xác nhận mật khẩu</label>
                        <input type="password" name="pwd-confirm" value="" id="pwd-confirm" class="form-control" placeholder="Confirm your password">
                    </div>
                    <div class="errorMessage my-3"><?php if(isset($_GET["msg1"])) echo $_GET["msg1"];?></div>
                    <div class="form-group">
                        <button type="submit" name='changepass' class="btn btn-primary px-5 mr-2 form-control" id="changepass">Xác nhận</button>
                           
                    </div>
                </form>
                <button onclick="history.go(-1)" class="btn btn-primary px-5 mt-2 btn-danger form-control">Huỷ</button>
            </div>
        </div>
    </div>
    <?php
        require_once('includes/footer.php');
    ?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<script src="/main.js"></script> <!-- Sử dụng link tuyệt đối tính từ root, vì vậy có dấu / đầu tiên -->
</body>

</html>