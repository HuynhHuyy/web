<?php 
	include('../includes/check_login.php');
	if($_SESSION['level'] != 1){
		header('Location:../index.php');
		exit;
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="/style.css"> <!-- Sử dụng link tuyệt đối tính từ root, vì vậy có dấu / đầu tiên -->
	<title>Department Home Page</title>
</head>

<body>
	<?php
		require_once('../includes/navbar.php');
	?>
	<div class="container-fluid mt-4">
        <main class="tm-main">
            <?php include("../config/config.php"); ?>
            <?php include ('../department_manager/content.php'); ?>          
        </main>
    </div>
	<?php
		require_once('../includes/footer.php');
	?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<script src="/main.js"></script> <!-- Sử dụng link tuyệt đối tính từ root, vì vậy có dấu / đầu tiên -->
</body>

</html>