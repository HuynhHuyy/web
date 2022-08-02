<?php
	session_start();  
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="/style.css"> <!-- Sử dụng link tuyệt đối tính từ root, vì vậy có dấu / đầu tiên -->
	<title>Login</title>
</head>
<body>
    <div class="container" id = "design_form">
        <div class="row">
            <div class="col-md-8 col-lg-5 my-5 mx-2 mx-sm-auto border rounded px-3 py-3" id="box">    
                <h2 class="header text-center mb-3">ĐĂNG NHẬP HỆ THỐNG </h2>
                <form action="/admin/login_process.php" method="post">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" value="" id="username" class="form-control" placeholder="Your username">
                    </div>
                    <div class="form-group">
                        <label for="pwd">Password</label>
                        <input type="password" name="pwd" value="" id="pwd" class="form-control" placeholder="Your password">
                    </div>
                    <div class="errorMessage my-3"><?php if(isset($_GET["msg1"])) echo $_GET["msg1"];?></div>
                    <button type="submit" class="btn btn-primary px-5 mr-2" name = "login" id="submit">ĐĂNG NHẬP</button>
                </form>
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