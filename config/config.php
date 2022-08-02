<?php
    
    $mysqli = new mysqli("mysql-server","root","root","staff_management");
    // Check connection
    $mysqli->set_charset("utf8");
    if ($mysqli->connect_error) {
        die('Không thể kết nối database: ' . $mysqli->connect_error);
    }
?>