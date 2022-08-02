<?php
    if(isset($_GET['manage']))
        {
        $manage = $_GET['manage'];
        }
    else{
        $manage='';
    }
    if($manage=="detailStaff"){
        include('content_pages/detail_staff.php');
    } else if($manage=="listDepartment"){
        include('content_pages/list_department.php');
    } else if($manage=="list_applicationform"){
        include('../list_applicationform.php');
    }else if($manage=="profile"){
        include('../detail_profile.php');
    }else{
        include('content_pages/list_staff.php');
    }
?>