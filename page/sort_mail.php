<?php
include("auth_onpage.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>คัดแยกพัสดุ</title>

    <link rel="stylesheet" href="../lib/bootstrap-4.5.3-dist/css/bootstrap.min.css">
    <link href="../lib/fontawesome-free-5.15.1-web/css/all.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <link rel="preconnect" href="https://fonts.gstatic.com"> 
    <link href="https://fonts.googleapis.com/css2?family=Prompt:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="../css/main_custom.css" rel="stylesheet">

    <script src="../lib/jQuery/jquery-3.5.1.min.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="../lib/bootstrap-4.5.3-dist/js/bootstrap.bundle.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="../lib/sweetalert2/sweetalert2.all.min.js" type="text/javascript" charset="utf-8"></script>

    <script src="../js/common.js?v=<?php echo JS_VERSION ?>" type="text/javascript" charset="utf-8"></script>
    <script src="../js/sort_mail.js?v=<?php echo JS_VERSION ?>" type="text/javascript" charset="utf-8"></script>
    <script src="../js/logout.js?v=<?php echo JS_VERSION ?>" type="text/javascript" charset="utf-8"></script>

    <style>
        .form-title {
            margin-top: 10px;
            margin-bottom: 0;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <?php include('menu_layout.php'); ?>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-9">
                    <h1>คัดแยกพัสดุ</h1>
                </div>
            </div>
            <div class="row mt-2 mb-4">
                <div class="col-12 text-right">
                    <span class="mr-2">Filter</span>
                    <input class="filter" type="text" name="search" id="search" placeholder="ค้นหา">
                    <input class="filter datepicker" type="text" name="filter_date" id="filter_date" placeholder="เลือกช่วงวัน" readonly>
                </div>
                <div class="col-12 mt-3 text-right">
                    <span class="filter-title">สถานะ</span>
                    <select class="filter" name="filter_status" id="filter_status" onchange="filterStatus(this.value)">
                        <option value="" selected>ทั้งหมด</option>
                        <option value="waiting">พัสดุถูกนำเข้าสู่ระบบ</option>
                        <option value="sending">พัสดุกำลังถูกนำส่งไปยังผู้รับ</option>
                        <option value="success">พัสดุถูกนำส่งถึงมือผู้รับเรียบร้อยแล้ว</option>
                        <option value="return_distribution_center">พัสดุถูกตีกลับสู่ศูนย์กระจายสินค้า</option>
                    </select>
                    <span class="filter-title">เขตจัดส่ง</span>
                    <select class="filter" name="filter_district" id="filter_district">
                        <option value="" selected>ทั้งหมด</option>
                    </select>
                    <span class="filter-title">คนนำจ่าย</span>
                    <select class="filter" name="filter_shipper" id="filter_shipper" onchange="filterShipper(this.value)">
                        <option value="" selected>ทั้งหมด</option>
                    </select>
                </div>
            </div>
            <div class="overflow-auto">
                <div class="table_wrap_loading_box">
                    <div>
                        <i class="fas fa-spinner fa-spin"></i>
                    </div>
                </div>
                <table class="table table-sm table-hover">
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-12 my-3">
                <nav aria-label="Page navigation">
                    <ul class="pagination pagination-sm justify-content-center">
                        <div class="main_pagination"></div>
                    </ul>
                </nav>
            </div>
        </div>

        <div class="modal fade" id="editData" tabindex="-1" aria-labelledby="editDataLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            </div>
        </div>
    </section>
</body>
</html>