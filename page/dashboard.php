<?php
include("auth_onpage.php");
// if($_SESSION['TYPE'] != 'admin' && $_SESSION['TYPE'] != 'staff'){
//     header("Location: javascript://history.go(-1)");
//     exit;
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <link rel="stylesheet" href="../lib/bootstrap-4.5.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
    <link href="../css/main_custom.css" rel="stylesheet">
    <link href="../css/dashboard.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <link rel="stylesheet" href="https://earthchie.github.io/jquery.Thailand.js/jquery.Thailand.js/dist/jquery.Thailand.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com"> 
    <link href="https://fonts.googleapis.com/css2?family=Prompt:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <script src="../lib/jQuery/jquery-3.5.1.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="../lib/bootstrap-4.5.3-dist/js/bootstrap.bundle.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="../lib/sweetalert2/sweetalert2.all.min.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <script src="../js/common.js?v=<?php echo JS_VERSION ?>" type="text/javascript" charset="utf-8"></script>
    <script src="../js/dashboard.js?v=<?php echo JS_VERSION ?>" type="text/javascript" charset="utf-8"></script>
    <script src="../js/logout.js?v=<?php echo JS_VERSION ?>" type="text/javascript" charset="utf-8"></script>
</head>
<body>
    <?php include('menu_layout.php'); ?>

    <section>
        <div class="container" style="margin-bottom: 20px">
            <div class="row">
                <div class="col-lg-9">
                    <h1>ภาพรวม</h1>
                </div>
                <div class="col-lg-3 d-flex justify-content-end align-items-center">
                    <button type="button" class="btn btn-sm btn-success btn_export"><i class="fas fa-file-export"></i> ส่งออกข้อมูล</button>
                </div>
            </div>

            <div class="row mt-2 mb-4">
                <div class="col-lg-1">สาขา</div>
                <div class="col-lg-2">
                    <select class="filter mt-2 mt-lg-0" name="filter_branch" id="filter_branch">
                        <option value="all" selected>ทั้งหมด</option>
                    </select>
                </div>
                <div class="col-lg-1">ช่วงเวลา</div>
                <div class="col-lg-2">
                    <select class="filter mt-2 mt-lg-0" name="filter_date_absoulte" id="filter_date_absoulte">
                        <option value="today" selected>วันนี้</option>
                        <option value="last_7">7วันที่ผ่านมา</option>
                        <option value="last_30">30วันที่ผ่านมา</option>
                        <option value="custom_date">กำหนดเอง</option>
                        <option value="all">ทั้งหมด</option>
                    </select>
                </div>
                <div class="col-lg-3">
                    <input class="filter datepicker mt-2 mt-lg-0" type="text" name="filter_date" id="filter_date" placeholder="เลือกช่วงวัน" readonly>
                </div>

            </div>


            <div class="wrap_overall">
                <div class="box">
                    <div class="title"><i class="fas fa-dolly-flatbed"></i> จำนวนพัสดุในระบบ</div>
                    <div class="detail summary_items_in_system"></div>
                </div>
                <div class="box">
                    <div class="title"><i class="fas fa-truck"></i> พัสดุที่รอดำเนินการส่ง</div>
                    <div class="detail summary_items_waiting"></div>
                </div>
                <div class="box">
                    <div class="title"><i class="fas fa-shipping-fast"></i> พัสดุที่อยู่ระหว่างจัดส่ง</div>
                    <div class="detail summary_items_sending"></div>
                </div>
                <div class="box">
                    <div class="title"><i class="fas fa-receipt"></i> จำนวนการทำรายการ</div>
                    <div class="detail summary_total_transaction"></div>
                </div>
                <div class="box">
                    <div class="title"><i class="fas fa-hand-holding-usd"></i> รายได้</div>
                    <div class="detail summary_total_price"></div>
                </div>
                <div class="box">
                    <div class="title"><i class="fas fa-coins"></i> เก็บเงินปลายทาง</div>
                    <div class="detail summary_items_cod_price"></div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>