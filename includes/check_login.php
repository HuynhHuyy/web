<?php 
  include('../config/config.php');
	session_start();

	$id_temp = $_SESSION['id'];
	$check_changepassword = "SELECT * FROM Users WHERE Id = $id_temp"; 
	$check_querychangepassword= mysqli_query($mysqli,$check_changepassword);  
    $check_query = mysqli_fetch_array($check_querychangepassword);

	if(!isset($_SESSION['id']) || $check_query['username'] == $check_query['pwd']){
		header('Location:../index.php');
		exit;
	}
?>