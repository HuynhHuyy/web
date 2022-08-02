<?php
    include("../config/config.php");
    $role = $_SESSION['level'];
	if(isset($_SESSION['id']) && isset($_SESSION['level'])) 
	{
		$id = $_SESSION['id'] ;
		$sql_level = "SELECT * FROM Users WHERE Id='$id' LIMIT 1";
		$query_level = mysqli_query($mysqli, $sql_level);
		$user = mysqli_fetch_array($query_level);

        $room = $user['numberRoom'];
        $sql_room = "SELECT * FROM Department WHERE numberRoom = '$room' ";
	    $nameRoom = mysqli_query($mysqli,$sql_room);
        $name = mysqli_fetch_array($nameRoom);
        
	}
    else{
        header('Location:../index.php');
		exit;
    }
?>
<nav class="navbar navbar-expand-md navbar-dark">
    <!-- Brand -->
    <div class="container">
    <a class="navbar-brand" href= <?php if($role == 0){?> "admin_index.php" <?php } ?>
    <?php if($role == 1){ ?> "department_index.php" <?php } ?> <?php if($role == 2){?> "staff_index.php" <?php } ?> > <h4><?php echo $name['nameRoom'] ?></h4> </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Navbar links -->
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav ml-auto">
                <!-- for admin -->
                <?php
                if(isset($_GET['manage'])){
                    $active = $_GET['manage'];
                } else $active = "";
                if($role == 0){
                     ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link <?=($active == 'listStaff') ? 'text-light':'' ?>" id="navbardrop"  href="admin_index.php?manage=listStaff">Danh sách nhân viên</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link <?=($active == 'listDepartment') ? 'text-light':'' ?>" id="navbardrop"  href="admin_index.php?manage=listDepartment">Danh sách phòng ban</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link <?=($active == 'list_applicationform') ? 'text-light':'' ?>" id="navbardrop"  href="admin_index.php?manage=list_applicationform">Danh sách đơn cần duyệt</a>
                        </li>
                    <?php $url = "admin_index.php";
                    }
                ?>
                <!-- for department -->
                <?php
                if($role == 1){ ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link <?=($active == 'listStaff') ? 'text-light':'' ?>" id="navbardrop"  href="department_index.php?manage=listStaff">Danh sách nhân viên</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link <?=($active == 'list_applicationform') ? 'text-light':'' ?>" id="navbardrop"  href="department_index.php?manage=list_applicationform">Danh sách đơn cần duyệt</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link <?=($active == 'furlough') ? 'text-light':'' ?>" id="navbardrop"  href="department_index.php?manage=furlough">Xin nghỉ phép</a>
                        </li>
                        
                    <?php $url = "department_index.php";
                    }
                ?>
                <!-- for staff -->
                <?php
                if($role == 2){ ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link <?=($active == 'furlough') ? 'text-light':'' ?>" id="navbardrop"  href="staff_index.php?manage=furlough">Xin nghỉ phép</a>
                        </li>
                    <?php $url = "staff_index.php";
                    }
                ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?=($active == 'profile') ? 'text-light':'' ?>" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo $user['name'] ?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item <?=($active == 'profile') ? 'bg-primary':'' ?>" href="<?php echo $url?>?manage=profile">Profile</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/logout.php">Sign out</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>


