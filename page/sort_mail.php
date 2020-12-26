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
    <title>คัดแยกพัสดุ</title>

    <link rel="stylesheet" href="../lib/bootstrap-4.5.3-dist/css/bootstrap.min.css">
    <link href="../lib/fontawesome-free-5.15.1-web/css/all.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.gstatic.com"> 
    <link href="https://fonts.googleapis.com/css2?family=Prompt:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <script src="../lib/jQuery/jquery-3.5.1.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="../lib/bootstrap-4.5.3-dist/js/bootstrap.bundle.min.js" type="text/javascript" charset="utf-8"></script>

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
            <table class="table table-sm table-hover">
                <thead>
                    <tr>
                        <th>วันที่นำเข้าพัสดุ</th>
                        <th>เลขพัสดุ</th>
                        <th>ชื่อผู้รับ</th>
                        <th>เขตจัดส่ง</th>
                        <th>สถานะ</th>
                        <th>คนนำจ่าย</th>
                        <th width="60px">แก้ไข</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>date</td>
                        <td>no.</td>
                        <td>name</td>
                        <td>เขต</td>
                        <td>waiting</td>
                        <td>person</td>
                        <td><button class="btn btn-sm btn-warning mr-2" data-toggle="modal" data-id="" data-target="#editData"><i class="fas fa-edit"></i></button></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="modal fade" id="editData" tabindex="-1" aria-labelledby="editDataLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editDataLabel">คนนำจ่ายพัสดุ No.xxxxx</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="fas fa-times"></i></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post">
                            <div class="row">
                                <div class="col">
                                    <label for="sender" class="col-form-label col-form-label-sm">คนนำจ่าย</label>
                                    <select name="sender" id="sender" class="form-control form-control-sm">
                                        <option value="" selected>กรุณาเลือกคนนำจ่ายพัสดุ</option>
                                    </select>
                                </div>
                            </div>
                            <p class="form-title">ข้อมูลผู้รับ</p>
                            <div class="row">
                                <div class="col">
                                    <label for="r_fname" class="col-form-label col-form-label-sm">ชื่อ</label>
                                    <input type="text" name="r_fname" id="r_fname" class="form-control form-control-sm" value="" readonly>
                                </div>
                                <div class="col">
                                    <label for="r_lname" class="col-form-label col-form-label-sm">นามสกุล</label>
                                    <input type="text" name="r_lname" id="r_lname" class="form-control form-control-sm" value="" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label for="phone_number" class="col-form-label col-form-label-sm">เบอร์โทร</label>
                                    <input type="text" name="phone_number" id="phone_number" class="form-control form-control-sm" value="" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="r_address" class="col-form-label col-form-label-sm">ที่อยู่</label>
                                    <input type="text" name="r_address" id="r_address" class="form-control form-control-sm" readonly>
                                </div>
                                <div class="col">
                                    <label for="r_district" class="col-form-label col-form-label-sm">เขต</label>
                                    <input type="text" name="r_district" id="r_district" class="form-control form-control-sm" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="r_area" class="col-form-label col-form-label-sm">แขวง</label>
                                    <input type="text" name="r_area" id="r_area" class="form-control form-control-sm" readonly>
                                </div>
                                <div class="col">
                                    <label for="r_province" class="col-form-label col-form-label-sm">จังหวัด</label>
                                    <input type="text" name="r_province" id="r_province" class="form-control form-control-sm" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="r_postcode" class="col-form-label col-form-label-sm">รหัสไปรษณีย์</label>
                                    <input type="text" name="r_postcode" id="r_postcode" class="form-control form-control-sm" readonly>
                                </div>
                                <div class="col">
                                    <label for="shipping_type" class="col-form-label col-form-label-sm">ประเภทการส่ง</label>
                                    <select name="shipping_type" id="shipping_type" class="form-control form-control-sm" disabled>
                                        <option value="normal" selected>ส่งแบบธรรมดา</option>
                                        <option value="cod">ส่งแบบธรรมดา แบบเก็บเงินปลายทาง</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="weight" class="col-form-label col-form-label-sm">น้ำหนัก (กรัม)</label>
                                    <input type="text" name="weight" id="weight" class="form-control form-control-sm" value="" readonly>
                                </div>
                                <div class="col">
                                    <label for="price" class="col-form-label col-form-label-sm">ราคา</label>
                                    <input type="text" name="price" id="price" class="form-control form-control-sm" value="" readonly>
                                </div>
                            </div>
                        </form>
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