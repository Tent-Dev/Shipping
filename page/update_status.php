<?php
include("auth_onpage.php");
if(isset($_SESSION['TYPE']) && isset($_SESSION['ID']) && $_SESSION['TYPE'] == 'shipper') {
        $employee_id = $_SESSION['ID'];
    } else {
        $employee_id = '';
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Status</title>

    <link rel="stylesheet" href="../lib/bootstrap-4.5.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <link rel="preconnect" href="https://fonts.gstatic.com"> 
    <link href="https://fonts.googleapis.com/css2?family=Prompt:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="../css/main_custom.css" rel="stylesheet">

    <script type="text/javascript">
        var SHIPPER_ID = '<?php echo $employee_id; ?>';
    </script>

    <script src="../lib/jQuery/jquery-3.5.1.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="../lib/bootstrap-4.5.3-dist/js/bootstrap.bundle.min.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="../lib/sweetalert2/sweetalert2.all.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="../lib/Signature/jq-signature.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="../js/common.js?v=<?php echo JS_VERSION ?>" type="text/javascript" charset="utf-8"></script>
    <script src="../js/logout.js?v=<?php echo JS_VERSION ?>" type="text/javascript" charset="utf-8"></script>
    <script src="../js/update_status.js?v=<?php echo JS_VERSION ?>" type="text/javascript" charset="utf-8"></script>

    <style>
        .signature {
            height: 0;
            opacity: 0;
            visibility: hidden;
            transition: all 0.2s linear;
        }
        .signature.success {
            height: auto;
            opacity: 1;
            visibility: visible;
        } 
        .signature.success .signature-box {
            height: 120px;
            border-radius: 10px;
            border: 1px solid #a6a6a6;
            text-align: center;
        }
        .clear-sign {
            font-size: 12px;
            color: #ed5f5f;
            border: none;
            background: none;
        }
        .clear-sign:hover {
            color: #ff0000;
        }
        .shipper_null{
            color: red;
        }
        canvas{
            width: calc(100% - 0vw) !important
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
                        <div class="col-9">
                            <h1>อัพเดทสถานะพัสดุ</h1>
                        </div>
                        <div class="col-lg-3 d-flex align-items-center justify-content-end">
                            <a href="scan_update_status.php">
                                <button type="button" class="btn btn-sm btn-success"><i class="fas fa-qrcode"></i> อัพเดทด้วยเครื่องสแกน</button>
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
                            <select class="filter mt-2 mt-lg-0 mb-2 mb-lg-0" name="filter_status" id="filter_status" onchange="filterStatus(this.value)">
                                <option value="" selected>ทั้งหมด</option>
                                <option value="waiting">พัสดุถูกนำเข้าสู่ระบบ</option>
                                <option value="sending">พัสดุกำลังถูกนำส่งไปยังผู้รับ</option>
                                <option value="success">พัสดุถูกนำส่งถึงมือผู้รับเรียบร้อยแล้ว</option>
                                <option value="return_distribution_center">พัสดุถูกตีกลับสู่ศูนย์กระจายสินค้า</option>
                            </select>
                        </div>
                        <div class="col-lg-2">คนนำจ่าย</div>
                        <div class="col-lg-3">
                            <select class="filter mt-2 mt-lg-0" name="filter_shipper" id="filter_shipper" onchange="filterShipper(this.value)">
                                <option value="" selected>ทั้งหมด</option>
                            </select>
                        </div>
                    </div>
                    <div class="overflow-auto">
                        <table class="table table-sm table-hover">
                            <div class="table_wrap_loading_box">
                                <div>
                                    <i class="fas fa-spinner fa-spin"></i>
                                </div>
                            </div>
                        </table>
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

        <div class="modal fade" id="editData" tabindex="-1" aria-labelledby="editDataLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editDataLabel">อัพเดทสถานะพัสดุ No.xxxxx</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="fas fa-times"></i></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- <form action="" method="post">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="status" class="col-form-label col-form-label-sm">สถานะพัสดุ</label>
                                    <select name="status" id="status" class="form-control form-control-sm">
                                        <option value="waiting">พัสดุถูกนำเข้าสู่ระบบ</option>
                                        <option value="sending">พัสดุกำลังถูกนำส่งไปยังผู้รับ</option>
                                        <option value="success">พัสดุถูกนำส่งถึงมือผู้รับเรียบร้อยแล้ว</option>
                                        <option value="return_distribution_center">พัสดุถูกตีกลับสู่ศูนย์กระจายสินค้า</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="phone_number" class="col-form-label col-form-label-sm">เบอร์โทรผู้รับ</label>
                                    <div>099-9999999</div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="shipper" class="col-form-label col-form-label-sm">คนนำจ่าย</label>
                                    <div>ใครนำจ่าย</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="r_fname" class="col-form-label col-form-label-sm">ชื่อผู้รับ</label>
                                    <div>ชื่อผู้รับ</div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="r_lname" class="col-form-label col-form-label-sm">นามสกุลผู้รับ</label>
                                    <div>นามสกุลผู้รับ</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col signature">
                                    <label for="signature" class="col-form-label col-form-label-sm">ลายเซ็น</label>
                                    <div class="signature-box"></div>
                                </div>
                            </div>
                        </form> -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                        <button type="button" class="btn btn-success">บันทึก</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>