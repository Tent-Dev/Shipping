<?php
include("auth_onpage.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Status</title>

    <link rel="stylesheet" href="../lib/bootstrap-4.5.3-dist/css/bootstrap.min.css">
    <link href="../lib/fontawesome-free-5.15.1-web/css/all.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.gstatic.com"> 
    <link href="https://fonts.googleapis.com/css2?family=Prompt:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <script src="../lib/jQuery/jquery-3.5.1.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="../lib/bootstrap-4.5.3-dist/js/bootstrap.bundle.min.js" type="text/javascript" charset="utf-8"></script>

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
                    </div>
                    <div class="overflow-auto">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th>วันที่นำเข้าพัสดุ</th>
                                    <th>เลขพัสดุ</th>
                                    <th>ชื่อผู้รับ</th>
                                    <th>สถานะ</th>
                                    <th>คนนำจ่าย</th>
                                    <th width="100px">แก้ไขสถานะ</th>
                                </tr>
                            </thead>
                            <tbody id="show_data_from_db">
                                <tr>
                                    <td>+val.create_date+</td>
                                    <td>+val.tracking_code+</td>
                                    <td>name</td>
                                    <td>+val.status+</td>
                                    <td>+val.person+</td>
                                    <td align="center">
                                        <button class="btn_edit btn btn-sm btn-warning mr-2" data-toggle="modal" data-id="'+val.id+'" data-trackingcode="'+val.tracking_code+'" data-target="#editData"><i class="fas fa-edit"></i></button>
                                    </td>
                                </tr>
                            </tbody>
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
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editDataLabel">อัพเดทสถานะพัสดุ No.xxxxx</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="fas fa-times"></i></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post">
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
                                    <input type="text" name="phone_number" id="phone_number" class="form-control-plaintext" value="099-9999999" readonly>
                                </div>
                                <div class="col-sm-6">
                                    <label for="shipper" class="col-form-label col-form-label-sm">คนนำจ่าย</label>
                                    <input type="text" name="shipper" id="shipper" class="form-control-plaintext" value="ใครนำจ่าย" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="r_fname" class="col-form-label col-form-label-sm">ชื่อผู้รับ</label>
                                    <input type="text" name="r_fname" id="r_fname" class="form-control-plaintext" value="ชื่อผู้รับ" readonly>
                                </div>
                                <div class="col-sm-6">
                                    <label for="r_lname" class="col-form-label col-form-label-sm">นามสกุลผู้รับ</label>
                                    <input type="text" name="r_lname" id="r_lname" class="form-control-plaintext" value="นามสกุลผู้รับ" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col signature">
                                    <label for="signature" class="col-form-label col-form-label-sm">ลายเซ็น</label>
                                    <div class="signature-box"></div>
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

    <script>
        $('select#status').on('change', function() {
            var value = $(this).children('option:selected').val();
            if(value == "success") {
                $('.signature').addClass('success');
            } else {
                $('.signature.success').removeClass('success');
            }
        });
    </script>
</body>
</html>