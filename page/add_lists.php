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
    <title>Add Lists</title>

    <link rel="stylesheet" href="../lib/bootstrap-4.5.3-dist/css/bootstrap.min.css">
    <link href="../lib/fontawesome-free-5.15.1-web/css/all.css" rel="stylesheet">
    <link href="../css/main_custom.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.gstatic.com"> 
    <link href="https://fonts.googleapis.com/css2?family=Prompt:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <script src="../lib/jQuery/jquery-3.5.1.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="../lib/sweetalert2/sweetalert2.all.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="../lib/bootstrap-4.5.3-dist/js/bootstrap.bundle.min.js" type="text/javascript" charset="utf-8"></script>

    <!-- import My Script -->
    <script src="../js/create_order.js?v=<?php echo JS_VERSION ?>" type="text/javascript" charset="utf-8"></script>

    <style>
        .btn-back {
            color: #464646;
        }
        .btn-back:hover {
            color: #464646;
            text-decoration: none;
        }
        [class*='form-title-'] {
            margin: 20px -15px 5px;
            padding: 3px;
            text-align: center;
            background-color: #d2e5ff;
        }
        .form-title-1 {
            margin-left: 0px;
            margin-right: 0px;
            border-radius: 10px;
        }
        .form-title-2 { border-radius: 10px 10px 0 0; }
        .form-title-3 { border-radius: 0; }
        .section {
            padding: 0 15px 15px;
            box-shadow: 0 0 10px -3px #adadad;
            border-radius: 10px;
        }
        .form-suggest {
            position: relative;
        }
        .box-suggest {
            position: absolute;
            z-index: 9;
            top: 100%;
            width: 90%;
            height: auto;
            max-height: 200px;
            overflow-y: auto;
            background-color: #ffffff;
            box-shadow: 0 3px 8px rgba(94, 94, 94, 0.5);
            font-size: 14px;
            opacity: 0;
            visibility: hidden;
            transition: all 0.2s linear;
        }
        .box-suggest.active {
            opacity: 1;
            visibility: visible;
        }
        .suggest-detail {
            padding: 8px 16px;
            border-bottom: 1px solid #000000;
            cursor: pointer;
        }
        .suggest-detail:hover {
            background-color: #f7f7f7;
        }
        .suggest-detail:last-child {
            border: none;
        }
        .suggest-detail p {
            margin-bottom: 0;
        }
        .suggest-detail p:first-child {
            color: #1560bd;
        }
        .checklist_print{
            margin-right: 10px;
            color: #ddd;
        }
        .textlist_print{
            margin-right: 10px;
        }
        .wrap_checklist{
            align-items: center;
            justify-content: center;
        }
        .icon_add_success{
            font-size: 5em;
            color: #28a745;
            margin-top: 20px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <?php include('menu_layout.php'); ?>
    
    <section>
        <div class="container">
            <div class="row">
                <div class="col-12 mt-3 mb-5">
                    <a href="lists.php" class="btn-back">รายการพัสดุ</a> / <h2 class="d-inline">เพิ่มพัสดุ</h2>
                    <!-- <form action="" method="post"> -->
                        <div class="form_add">
                            <div id="form-section">
                                <p class="form-title-1">ข้อมูลผู้ทำรายการ</p>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="customer_phone_number" class="col-form-label col-form-label-sm">เบอร์โทรผู้ทำรายการ</label>
                                        <input type="text" name="customer_phone_number" id="customer_phone_number" class="form-control form-control-sm form-suggest" autocomplete="off">
                                        <div class="box-suggest customer-suggest">
                                            <div class="suggest-detail"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="id_card" class="col-form-label col-form-label-sm">เลขประจำตัวประชาชนผู้ทำรายการ</label>
                                        <input type="text" name="id_card" id="id_card" class="form-control form-control-sm">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="firstname" class="col-form-label col-form-label-sm">ชื่อผู้ทำรายการ</label>
                                        <input type="text" name="firstname" id="firstname" class="form-control form-control-sm">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="lastname" class="col-form-label col-form-label-sm">นามสกุลผู้ทำรายการ</label>
                                        <input type="text" name="lastname" id="lastname" class="form-control form-control-sm">
                                    </div>
                                </div>

                                <div class="section" data-index="1">
                                    <p class="form-title-2" style="background-color: #9ec6ff;">ข้อมูลผู้ส่ง</p>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="sender_phone" class="col-form-label col-form-label-sm">เบอร์โทรผู้ส่ง</label>
                                            <input type="text" name="sender_phone[]" id="sender_phone" class="form-control form-control-sm form-suggest sender_phone" autocomplete="off">
                                            <div class="box-suggest sender-suggest">
                                                <div class="suggest-detail">
                                                    <!-- <p>เบอร์โทรผู้ส่ง</p>
                                                    <p>ชื่อ</p>
                                                    <p>ที่อยู่</p>
                                                    <p>เขต แขวง จังหวัด รหัสไปรษณีย์</p> -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="s_fname" class="col-form-label col-form-label-sm">ชื่อผู้ส่ง</label>
                                            <input type="text" name="s_fname[]" id="s_fname" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="s_lname" class="col-form-label col-form-label-sm">นามสกุลผู้ส่ง</label>
                                            <input type="text" name="s_lname[]" id="s_lname" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="s_address" class="col-form-label col-form-label-sm">ที่อยู่</label>
                                            <input type="text" name="s_address[]" id="s_address" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="s_district" class="col-form-label col-form-label-sm">เขต</label>
                                            <input type="text" name="s_district[]" id="s_district" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="s_area" class="col-form-label col-form-label-sm">แขวง</label>
                                            <input type="text" name="s_area[]" id="s_area" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="s_province" class="col-form-label col-form-label-sm">จังหวัด</label>
                                            <input type="text" name="s_province[]" id="s_province" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="s_postcode" class="col-form-label col-form-label-sm">รหัสไปรษณีย์</label>
                                            <input type="text" name="s_postcode[]" id="s_postcode" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                    <!-- receive -->
                                    <p class="form-title-3">ข้อมูลผู้รับ</p>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="phone_number" class="col-form-label col-form-label-sm">เบอร์โทรผู้รับ</label>
                                            <input type="text" name="phone_number[]" id="phone_number" class="form-control form-control-sm form-suggest phone_number" autocomplete="off">
                                            <div class="box-suggest receiver-suggest">
                                                <div class="suggest-detail">
                                                    <!-- <p>เบอร์โทรผู้ส่ง</p>
                                                    <p>ชื่อ</p>
                                                    <p>ที่อยู่</p>
                                                    <p>เขต แขวง จังหวัด รหัสไปรษณีย์</p> -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="r_fname" class="col-form-label col-form-label-sm">ชื่อผู้รับ</label>
                                            <input type="text" name="r_fname[]" id="r_fname" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="r_lname" class="col-form-label col-form-label-sm">นามสกุลผู้รับ</label>
                                            <input type="text" name="r_lname[]" id="r_lname" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="r_address" class="col-form-label col-form-label-sm">ที่อยู่</label>
                                            <input type="text" name="r_address[]" id="r_address" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="r_district" class="col-form-label col-form-label-sm">เขต</label>
                                            <input type="text" name="r_district[]" id="r_district" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="r_area" class="col-form-label col-form-label-sm">แขวง</label>
                                            <input type="text" name="r_area[]" id="r_area" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="r_province" class="col-form-label col-form-label-sm">จังหวัด</label>
                                            <input type="text" name="r_province[]" id="r_province" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="r_postcode" class="col-form-label col-form-label-sm">รหัสไปรษณีย์</label>
                                            <input type="text" name="r_postcode[]" id="r_postcode" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="shipping_type" class="col-form-label col-form-label-sm">ประเภทการส่ง</label>
                                            <select name="shipping_type[]" id="shipping_type" class="form-control form-control-sm">
                                                <option value="normal" selected>ส่งแบบธรรมดา</option>
                                                <option value="cod">ส่งแบบธรรมดา แบบเก็บเงินปลายทาง</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="weight" class="col-form-label col-form-label-sm">น้ำหนัก (กรัม)</label>
                                            <input type="text" name="weight[]" id="weight" class="form-control form-control-sm" value="">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="price" class="col-form-label col-form-label-sm">ราคา</label>
                                            <input type="text" name="price[]" id="price" class="form-control form-control-sm" value="">
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <button type="button" class="btn btn-sm btn-danger remove mt-3"><i class="fas fa-trash"></i></button>
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <div class="row">
                                <div class="col-6">
                                    <a href="#" class="addsection btn btn-sm btn-info"><i class="fas fa-plus"></i> เพิ่มผู้รับ</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 text-center">
                                    <button class="btn btn-sm btn-success btn_save">บันทึก <i class="far fa-save"></i></button>
                                    <button class="btn btn-sm btn-danger">ยกเลิก <i class="fas fa-times"></i></button>
                                </div>
                            </div>
                            <!-- </form> -->
                        </div>
                        <div class="form_print" style="display: none;">
                            <div align="center" style="margin-bottom: 10px;">
                                <div class="col-12">
                                    <i class="far fa-check-circle icon_add_success"></i>
                                </div>
                                <b style="font-size: 20px">นำพัสดุเข้าสู่ระบบเรียบร้อยแล้ว</b>
                            </div>
                            <div align="center" style="margin-bottom: 10px;">
                                ขั้นตอนสุดท้าย: พิมพ์ใบปะหน้าพัสดุ และใบเสร็จรับเงิน
                            </div>
                            <div align="center" style="margin-bottom: 30px;">
                                <div class="row wrap_checklist">
                                    <div class="checklist_print"><i class="far fa-check-circle"></i></div>
                                    <div class="textlist_print">ใบปะหน้าพัสดุ</div>
                                    <div>
                                        <a class="label_link" href="" target="_blank"><button type="button" class="btn btn-sm btn-success">
                                            <i class="fas fa-print"></i>
                                        </button></a>
                                    </div>
                                </div>
                                <div style="margin-bottom: 10px;"></div>
                                <div class="row wrap_checklist">
                                    <div class="checklist_print"><i class="far fa-check-circle"></i></div>
                                    <div class="textlist_print">ใบเสร็จรับเงิน</div>
                                    <div>
                                        <a class="slip_link" href="" target="_blank"><button type="button" class="btn btn-sm btn-success">
                                            <i class="fas fa-print"></i>
                                        </button></a>
                                    </div>
                                </div>
                            </div>
                            <div align="center" style="margin-bottom: 10px;">
                                หมายเหตุ: ท่านสามารถพิมพ์ใบปะหน้าและใบเสร็จรับเงินภายหลังได้
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <script>
            $('body').delegate('.form-suggest', 'focus', function() {
                $(this).parent().find('.box-suggest').addClass('active');
            });
            $('body').delegate('.form-suggest', 'focusout', function() {
                $(this).parent().find('.box-suggest.active').removeClass('active');
            });
        </script>
    </body>
    </html>