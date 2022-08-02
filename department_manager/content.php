<?php
    if(isset($_GET['manage'])){
        $manage = $_GET['manage'];
    }
    else{
        $manage='';
    }
    if($manage=="listStaff"){

        include('content_pages/list_staff.php');

    }else if($manage=="detailTask0"){

        include('content_pages/detail_task_new.php');

    }else if($manage=="detailTask1"){

        include('content_pages/detail_task_inprogress.php');

    }else if($manage=="detailTask2"){

        include('content_pages/detail_task_waiting.php');

    }else if($manage=="detailTask3"){

        include('content_pages/detail_task_completed.php');

    }else if($manage=="detailTask4"){

        include('content_pages/detail_task_rejected.php');

    }else if($manage=="detailTask5"){

        include('content_pages/detail_task_cancel.php');

    }else if($manage=="profile"){

        include('../detail_profile.php');

    }else if($manage == "list_applicationform"){

        include('../list_applicationform.php');

    }else if($manage=="furlough"){

        include('../list_furlough.php');

    }else if($manage == "detailForm"){
        include('../detail_form.php');
    }
    else{
        include('content_pages/list_task.php');
    }
?>