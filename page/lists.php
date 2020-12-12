<?php
session_start();
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
    <title>Lists</title>

    <link rel="stylesheet" href="../lib/bootstrap-4.5.3-dist/css/bootstrap.min.css">
    <link href="../lib/fontawesome-free-5.15.1-web/css/all.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.gstatic.com"> 
    <link href="https://fonts.googleapis.com/css2?family=Prompt:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <script src="../lib/jQuery/jquery-3.5.1.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="../lib/bootstrap-4.5.3-dist/js/bootstrap.bundle.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="../js/lists.js" type="text/javascript" charset="utf-8"></script>
    <script src="../js/logout.js" type="text/javascript" charset="utf-8"></script>

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
                        <div class="col-9">
                            <h1>รายการพัสดุ</h1>
                        </div>
                        <div class="col-3 d-flex align-items-center justify-content-end">
                            <a href="">
                                <a href="add-lists.php">
                                    <button type="button" class="btn btn-sm btn-success">Add <i class="fas fa-plus"></i></button>
                                </a>
                            </a>
                        </div>
                    </div>
                    <table class="table table-sm table-striped">
                        <thead>
                            <tr>
                                <th width="50px">No.</th>
                                <th>วันที่นำเข้าพัสดุ</th>
                                <th>เลขพัสดุ</th>
                                <th>ชื่อผู้รับ</th>
                                <th>สถานะ</th>
                                <th width="120px">แก้ไข / ลบ</th>
                            </tr>
                        </thead>
                        <tbody id="query_product">
                            <!-- <tr>
                                <td>1</td>
                                <td>date</td>
                                <td>code</td>
                                <td>name</td>
                                <td>status</td>
                                <td>
                                    <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editData"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr> -->
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col-12 my-3">
                    <nav aria-label="Page navigation">
                        <ul class="pagination pagination-sm justify-content-center">
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

        <div class="modal fade" id="editData" tabindex="-1" aria-labelledby="editDataLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
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
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="weight" class="col-form-label col-form-label-sm">น้ำหนัก (กิโลกรัม)</label>
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
                </div>
            </div>
        </div>
    </section>
</body>
</html>