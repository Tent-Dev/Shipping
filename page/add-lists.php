<?php
session_start();
include("../client_config/config.php");
if($_SESSION['SESSION_ID'] == ""){
    header("Location:../index.php");
    die();
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

    <link rel="preconnect" href="https://fonts.gstatic.com"> 
    <link href="https://fonts.googleapis.com/css2?family=Prompt:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <script src="../lib/jQuery/jquery-3.5.1.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="../lib/bootstrap-4.5.3-dist/js/bootstrap.bundle.min.js" type="text/javascript" charset="utf-8"></script>

    <!-- import My Script -->
    <script src="../js/create_order.js?v=<?php echo JS_VERSION ?>" type="text/javascript" charset="utf-8"></script>

    <style>
        .form-title {
            margin-top: 20px;
            margin-bottom: 5px;
            padding: 3px;
            text-align: center;
            border-radius: 10px;
            background-color: #d2e5ff;
        }
    </style>
</head>
<body>
    <?php include('menu_layout.php'); ?>
    
    <section>
    <div class="container">
        <div class="row">
            <div class="col-12 mt-3 mb-5">
                <h2>เพิ่มพัสดุ</h2>
                <form action="" method="post">
                    <div id="form-section">
                        <p class="form-title">ข้อมูลผู้ทำรายการ</p>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="id_card" class="col-form-label col-form-label-sm">เลขประจำตัวประชาชนผู้ทำรายการ</label>
                                <input type="text" name="id_card" id="id_card" class="form-control form-control-sm">
                            </div>
                            <div class="col-md-4">
                                <label for="firstname" class="col-form-label col-form-label-sm">ชื่อผู้ทำรายการ</label>
                                <input type="text" name="firstname" id="firstname" class="form-control form-control-sm">
                            </div>
                            <div class="col-md-4">
                                <label for="lastname" class="col-form-label col-form-label-sm">นามสกุลผู้ทำรายการ</label>
                                <input type="text" name="lastname" id="lastname" class="form-control form-control-sm">
                            </div>
                        </div>
                        
                        <div class="section">
                            <p class="form-title" style="background-color: #9ec6ff;">ข้อมูลผู้ส่ง</p>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="phone_number" class="col-form-label col-form-label-sm">เบอร์โทรผู้ส่ง</label>
                                    <input type="text" name="phone_number[]" id="phone_number" class="form-control form-control-sm">
                                </div>
                                <div class="col-md-4">
                                    <label for="r_fname" class="col-form-label col-form-label-sm">ชื่อผู้ส่ง</label>
                                    <input type="text" name="r_fname[]" id="r_fname" class="form-control form-control-sm">
                                </div>
                                <div class="col-md-4">
                                    <label for="r_lname" class="col-form-label col-form-label-sm">นามสกุลผู้ส่ง</label>
                                    <input type="text" name="r_lname[]" id="r_lname" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="address" class="col-form-label col-form-label-sm">ที่อยู่</label>
                                    <input type="text" name="address" id="address" class="form-control form-control-sm">
                                </div>
                                <div class="col-md-4">
                                    <label for="district" class="col-form-label col-form-label-sm">เขต</label>
                                    <input type="text" name="district" id="district" class="form-control form-control-sm">
                                </div>
                                <div class="col-md-4">
                                    <label for="area" class="col-form-label col-form-label-sm">แขวง</label>
                                    <input type="text" name="area" id="area" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="province" class="col-form-label col-form-label-sm">จังหวัด</label>
                                    <input type="text" name="province" id="province" class="form-control form-control-sm">
                                </div>
                                <div class="col-md-4">
                                    <label for="province" class="col-form-label col-form-label-sm">รหัสไปรษณีย์</label>
                                    <input type="text" name="province" id="province" class="form-control form-control-sm">
                                </div>
                            </div>
                            <p class="form-title">ข้อมูลผู้รับ</p>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="phone_number" class="col-form-label col-form-label-sm">เบอร์โทรผู้รับ</label>
                                    <input type="text" name="phone_number[]" id="phone_number" class="form-control form-control-sm">
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
                                    <label for="address" class="col-form-label col-form-label-sm">ที่อยู่</label>
                                    <input type="text" name="address" id="address" class="form-control form-control-sm">
                                </div>
                                <div class="col-md-4">
                                    <label for="district" class="col-form-label col-form-label-sm">เขต</label>
                                    <input type="text" name="district" id="district" class="form-control form-control-sm">
                                </div>
                                <div class="col-md-4">
                                    <label for="area" class="col-form-label col-form-label-sm">แขวง</label>
                                    <input type="text" name="area" id="area" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="province" class="col-form-label col-form-label-sm">จังหวัด</label>
                                    <input type="text" name="province" id="province" class="form-control form-control-sm">
                                </div>
                                <div class="col-md-4">
                                    <label for="province" class="col-form-label col-form-label-sm">รหัสไปรษณีย์</label>
                                    <input type="text" name="province" id="province" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="shipping_type" class="col-form-label col-form-label-sm">ประเภทการส่ง</label>
                                    <select name="shipping_type[]" id="shipping_type" class="form-control form-control-sm">
                                        <option value="normal" selected>ส่งแบบธรรมดา</option>
                                        <option value="cod">ส่งแบบธรรมดา แบบเก็บเงินปลาย</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="weight" class="col-form-label col-form-label-sm">น้ำหนัก (กิโลกรัม)</label>
                                    <input type="text" name="weight" id="weight" class="form-control form-control-sm" value="">
                                </div>
                                <div class="col-md-4">
                                    <label for="price" class="col-form-label col-form-label-sm">ราคา</label>
                                    <input type="text" name="price" id="price" class="form-control form-control-sm" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <hr>
                    <div class="row">
                        <div class="col-6">
                            <a href="#" class="addsection btn btn-sm btn-info">เพิ่มผู้รับ</a>
                        </div>
                        <div class="col-6 text-right">
                            <a href="" class="btn btn-sm btn-success">บันทึก</a>
                            <a href="" class="btn btn-sm btn-danger">ยกเลิก</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
    var form_clone = $('#form-section .section:first').clone();
    var sectionsCount = 1;

    $('body').on('click', '.addsection', function() {
        sectionsCount++;

        var section = form_clone.clone().find(':input').each(function(){
            var newId = this.id + sectionsCount;
            $(this).prev().attr('for', newId);
            this.id = newId;
        }).end().appendTo('#form-section');

        return false;
    });
</script>
</body>
</html>