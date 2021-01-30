<link rel="stylesheet" href="../css/layout.css">

<!-- Header Bar -->
<div class="bar">
    <div class="burger" id="COmenu">
        <div></div>
        <div></div>
        <div></div>
    </div>
    <!-- <button class="btn btn-sm btn-danger btn-logout">Sign out</button> -->
    <div class="dropdown profile d-none d-md-block">
        <button class="btn dropdown-toggle text-white" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
           <span class="profile_img">
            <i class="fas fa-user-circle" style="font-size: 20px"></i>&nbsp;<?php echo $_SESSION['USERNAME'] ?>
        </span>
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a id="" class="dropdown-item" href="account.php"><i class="fas fa-user-cog mr-2"></i>แก้ไขข้อมูล</a>
            <a id="logout" class="dropdown-item logout" href=""><i class="fas fa-power-off mr-2"></i>ออกจากระบบ</a>
        </div>
    </div>
</div>

<?php
    $path = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
?>

<!-- Side Menu -->
<div class="side-menu">
    <div class="logo">
        <img src="https://fph.tu.ac.th/uploads/fph/DownloadLogo/2018_FPHHorz%20Logo%20%28EN%29.png" alt="">
    </div>
    <div class="menu-content">
        <?php if(isset($_SESSION['TYPE']) && $_SESSION['TYPE'] == 'admin' || $_SESSION['TYPE'] == 'staff'){?>
        <a href="dashboard.php" class="menu <?php if($path == 'dashboard.php') echo "active"; ?>">ภาพรวม</a>
        <a href="lists.php" class="menu <?php if($path == 'lists.php' || $path == 'add_lists.php' || $path == 'edit_lists.php') echo "active"; ?>">รายการพัสดุ</a>
        <a href="sort_mail.php" class="menu <?php if($path == 'sort_mail.php') echo "active"; ?>">คัดแยกพัสดุ</a>
        <?php } ?>
        <a href="update_status.php" class="menu <?php if($path == 'update_status.php') echo "active"; ?>">อัพเดทสถานะพัสดุ</a>
        <?php if(isset($_SESSION['TYPE']) && $_SESSION['TYPE'] == 'admin' || $_SESSION['TYPE'] == 'staff'){?>
        <a href="history.php" class="menu <?php if($path == 'history.php' || $path == 'transaction_history.php') echo "active"; ?>">ประวัติการทำรายการ</a>
        <?php } ?>
        <?php if(isset($_SESSION['TYPE']) && $_SESSION['TYPE'] == 'admin'){?>
        <a href="manage_user.php" class="menu <?php if($path == 'manage_user.php') echo "active"; ?>">จัดการรายชื่อพนักงาน</a>
        <?php } ?>
    </div>
    <div class="dropup m-profile d-none d-md-none">
        <button class="btn dropdown-toggle text-white" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php echo $_SESSION['USERNAME'] ?>
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a id="" class="dropdown-item" href="account.php"><i class="fas fa-user-cog mr-2"></i>แก้ไขข้อมูล</a>
            <a id="logout-m" class="dropdown-item logout" href=""><i class="fas fa-power-off mr-2"></i>ออกจากระบบ</a>
        </div>
    </div>
</div>

<div class="overlay"></div>

<script>
    $('#COmenu').on('click', function(){
        $('body').toggleClass('no-scroll');
        $(this).toggleClass('active');
        $('.side-menu, .overlay').toggleClass('active');
        $('.m-profile').toggleClass('d-none');
        $('.m-profile').toggleClass('d-block');
    });

    $('.overlay').on('click', function(){
        $('body').toggleClass('no-scroll');
        $(this).toggleClass('active');
        $('.side-menu, #COmenu').toggleClass('active');
        $('.m-profile').toggleClass('d-none');
        $('.m-profile').toggleClass('d-block');
    });
    
    $(window).resize(function() {
        if($(window).width() > 992) {
            $('body').removeClass('no-scroll');
            $('#COmenu').removeClass('active');
            $('.side-menu, .overlay').removeClass('active');
            $('.m-profile').toggleClass('d-block');
            $('.m-profile').toggleClass('d-none');
        }
    });
</script>