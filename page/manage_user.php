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
    <title>Manage User</title>

    <link rel="stylesheet" href="../lib/bootstrap-4.5.3-dist/css/bootstrap.min.css">
    <link href="../lib/fontawesome-free-5.15.1-web/css/all.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.gstatic.com"> 
    <link href="https://fonts.googleapis.com/css2?family=Prompt:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <script src="../lib/jQuery/jquery-3.5.1.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="../lib/bootstrap-4.5.3-dist/js/bootstrap.bundle.min.js" type="text/javascript" charset="utf-8"></script>
</head>
<body>
    <?php include('menu_layout.php'); ?>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-12 mt-3 mb-5">
                    <div class="row">
                        <div class="col-9">
                            <h1>จัดการรายชื่อพนักงาน</h1>
                        </div>
                        <div class="col-3 d-flex align-items-center justify-content-end">
                            <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#addData">เพิ่มบัญชีผู้ใช้ <i class="fas fa-plus"></i></button>
                        </div>
                    </div>
                    <table class="table table-sm table-hover">
                        <thead>
                            <tr>
                                <th>ลำดับ</th>
                                <th>ชื่อ - นามสกุล</th>
                                <th>ตำแหน่ง</th>
                                <th width="120px">แก้ไข / ลบ</th>
                            </tr>
                        </thead>
                        <tbody id="show_data_from_db">
                            <tr>
                                <td>1</td>
                                <td>ชื่อ</td>
                                <td>admin</td>
                                <td>
                                    <button class="btn btn-sm btn-warning mr-2" data-toggle="modal" data-id="'+val.id+'" data-target="#editData"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-sm btn-danger" data-id="'+val.id+'"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="modal fade" id="addData" tabindex="-1" aria-labelledby="addDataLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addDataLabel">เพิ่มข้อมูลพนักงาน</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="fas fa-times"></i></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post">
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
                                    <label for="username" class="col-form-label col-form-label-sm">Username</label>
                                    <input type="text" name="username" id="username" class="form-control form-control-sm" value="">
                                </div>
                                <div class="col-6">
                                    <label for="password" class="col-form-label col-form-label-sm">Password</label>
                                    <input type="password" name="password" id="password" class="form-control form-control-sm" value="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label for="member_type" class="col-form-label col-form-label-sm">ตำแหน่ง</label>
                                    <select name="member_type" id="member_type" class="form-control form-control-sm">
                                        <option value="" selected>กรุณาเลือกตำแหน่ง</option>
                                        <option value="admin">Admin</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                        <button type="button" class="btn btn-success">เพิ่ม</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="editData" tabindex="-1" aria-labelledby="editDataLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editDataLabel">แก้ไขข้อมูลพนักงาน</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="fas fa-times"></i></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post">
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
                                    <label for="username" class="col-form-label col-form-label-sm">Username</label>
                                    <input type="text" name="username" id="username" class="form-control form-control-sm" value="">
                                </div>
                                <div class="col-6">
                                    <label for="password" class="col-form-label col-form-label-sm">Password</label>
                                    <input type="password" name="password" id="password" class="form-control form-control-sm" value="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label for="member_type" class="col-form-label col-form-label-sm">ตำแหน่ง</label>
                                    <select name="member_type" id="member_type" class="form-control form-control-sm">
                                        <option value="admin">Admin</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                        <button type="button" class="btn btn-warning">แก้ไข</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>