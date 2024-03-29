<?php
include("auth_onpage.php");
if($_SESSION['TYPE'] != 'admin' && $_SESSION['TYPE'] != 'staff'){
    header("Location: javascript://history.go(-1)");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ประวัติการทำรายการ</title>

    <link rel="stylesheet" href="../lib/bootstrap-4.5.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link href="../css/main_custom.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.gstatic.com"> 
    <link href="https://fonts.googleapis.com/css2?family=Prompt:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <script src="../lib/jQuery/jquery-3.5.1.min.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="../lib/bootstrap-4.5.3-dist/js/bootstrap.bundle.min.js" type="text/javascript" charset="utf-8"></script>

    <script src="../js/common.js?v=<?php echo JS_VERSION ?>" type="text/javascript" charset="utf-8"></script>
    <script src="../js/history.js?v=<?php echo JS_VERSION ?>" type="text/javascript" charset="utf-8"></script>
    <script src="../js/logout.js?v=<?php echo JS_VERSION ?>" type="text/javascript" charset="utf-8"></script>
</head>
<body>
    <?php include('menu_layout.php'); ?>
    
    <section>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>ประวัติการทำรายการ</h1>
                </div>
            </div>
            <div class="row mt-2 mb-4">
                <div class="col-lg-1">ค้นหา</div>
                <div class="col-lg-3"><input class="filter mt-2 mt-lg-0 mb-2 mb-lg-0" type="text" name="search" id="search" placeholder="ค้นหา"></div>
                <div class="col-lg-2">วันนำเข้าพัสดุ</div>
                <div class="col-lg-3"><input class="filter datepicker mt-2 mt-lg-0" type="text" name="filter_date" id="filter_date" placeholder="เลือกช่วงวัน" readonly></div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="overflow-auto">
                        <div class="table_wrap_loading_box">
                            <div>
                                <i class="fas fa-spinner fa-spin"></i>
                            </div>
                        </div>
                        <table class="table table-sm table-hover"></table>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 my-3" style="display: flex;">
                    <nav aria-label="Page navigation">
                        <ul class="pagination pagination-sm justify-content-center">
                            <div class="main_pagination"></div>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>
</body>
</html>