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
    <title>Lists</title>

    <link rel="stylesheet" href="../lib/bootstrap-4.5.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link href="../css/main_custom.css" rel="stylesheet">
    <link href="../css/list.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.gstatic.com"> 
    <link href="https://fonts.googleapis.com/css2?family=Prompt:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <script src="../lib/jQuery/jquery-3.5.1.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="../lib/sweetalert2/sweetalert2.all.min.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="../lib/bootstrap-4.5.3-dist/js/bootstrap.bundle.min.js" type="text/javascript" charset="utf-8"></script>

    <script src="../js/common.js?v=<?php echo JS_VERSION ?>" type="text/javascript" charset="utf-8"></script>
    <script src="../js/lists.js?v=<?php echo JS_VERSION ?>" type="text/javascript" charset="utf-8"></script>
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
                <div class="col-12">
                    <div class="row">
                        <div class="col-lg-9">
                            <h1>รายการพัสดุ</h1>
                        </div>
                        <div class="col-lg-3 d-flex align-items-center justify-content-end">
                            <a href="add_lists.php">
                                <button type="button" class="btn btn-sm btn-success">เพิ่มรายการพัสดุ <i class="fas fa-plus"></i></button>
                            </a>
                        </div>
                    </div>
                    <div class="row mt-2 mb-2">
                        <div class="col-lg-1">ค้นหา</div>
                        <div class="col-lg-3"><input class="filter mt-2 mt-lg-0 mb-2 mb-lg-0" type="text" name="search" id="search" placeholder="ค้นหา"></div>
                        <div class="col-lg-2">วันนำเข้าพัสดุ</div>
                        <div class="col-lg-3"><input class="filter datepicker mt-2 mt-lg-0" type="text" name="filter_date" id="filter_date" placeholder="เลือกช่วงวัน" readonly></div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-lg-1">สถานะ</div>
                        <div class="col-lg-3">
                            <select class="filter mt-2 mt-lg-0" name="filter_status" id="filter_status">
                                <option value="" selected>ทั้งหมด</option>
                                <option value="waiting">พัสดุถูกนำเข้าสู่ระบบ</option>
                                <option value="sending">พัสดุกำลังถูกนำส่งไปยังผู้รับ</option>
                                <option value="success">พัสดุถูกนำส่งถึงมือผู้รับเรียบร้อยแล้ว</option>
                                <option value="return_distribution_center">พัสดุถูกตีกลับสู่ศูนย์กระจายสินค้า</option>
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
        </div>

        <div class="modal fade" id="editData" tabindex="-1" aria-labelledby="editDataLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <!-- <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editDataLabel">แก้ไขข้อมูลพัสดุ No.xxxxx</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="fas fa-times"></i></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post">
                            <p class="form-title">ข้อมูลผู้ทำรายการ</p>
                            <div class="row">
                                <div class="col">
                                    <label for="firstname" class="col-form-label col-form-label-sm">ชื่อ</label>
                                    <input type="text" name="firstname" id="firstname" class="form-control form-control-sm" value="">
                                </div>
                                <div class="col">
                                    <label for="lastname" class="col-form-label col-form-label-sm">นามสกุล</label>
                                    <input type="text" name="lastname" id="lastname" class="form-control form-control-sm" value="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label for="id_card" class="col-form-label col-form-label-sm">เลขประจำตัวประชาชน</label>
                                    <input type="text" name="id_card" id="id_card" class="form-control form-control-sm">
                                </div>
                            </div>
                            <p class="form-title">ข้อมูลผู้รับ</p>
                            <div class="row">
                                <div class="col">
                                    <label for="r_fname" class="col-form-label col-form-label-sm">ชื่อ</label>
                                    <input type="text" name="r_fname" id="r_fname" class="form-control form-control-sm" value="">
                                </div>
                                <div class="col">
                                    <label for="r_lname" class="col-form-label col-form-label-sm">นามสกุล</label>
                                    <input type="text" name="r_lname" id="r_lname" class="form-control form-control-sm" value="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label for="phone_number" class="col-form-label col-form-label-sm">เบอร์โทร</label>
                                    <input type="text" name="phone_number" id="phone_number" class="form-control form-control-sm" value="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="address" class="col-form-label col-form-label-sm">ที่อยู่</label>
                                    <input type="text" name="address" id="address" class="form-control form-control-sm">
                                </div>
                                <div class="col">
                                    <label for="district" class="col-form-label col-form-label-sm">เขต</label>
                                    <input type="text" name="district" id="district" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="area" class="col-form-label col-form-label-sm">แขวง</label>
                                    <input type="text" name="area" id="area" class="form-control form-control-sm">
                                </div>
                                <div class="col">
                                    <label for="province" class="col-form-label col-form-label-sm">จังหวัด</label>
                                    <input type="text" name="province" id="province" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="province" class="col-form-label col-form-label-sm">รหัสไปรษณีย์</label>
                                    <input type="text" name="province" id="province" class="form-control form-control-sm">
                                </div>
                                <div class="col">
                                    <label for="shipping_type" class="col-form-label col-form-label-sm">ประเภทการส่ง</label>
                                    <select name="shipping_type[]" id="shipping_type" class="form-control form-control-sm">
                                        <option value="normal" selected>ส่งแบบธรรมดา</option>
                                        <option value="cod">ส่งแบบธรรมดา แบบเก็บเงินปลายทาง</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="weight" class="col-form-label col-form-label-sm">น้ำหนัก (กรัม)</label>
                                    <input type="text" name="weight" id="weight" class="form-control form-control-sm" value="">
                                </div>
                                <div class="col">
                                    <label for="price" class="col-form-label col-form-label-sm">ราคา</label>
                                    <input type="text" name="price" id="price" class="form-control form-control-sm" value="">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                        <button type="button" class="btn btn-success">บันทึก</button>
                    </div>
                </div> -->
            </div>
        </div>
    </section>
</body>
</html>