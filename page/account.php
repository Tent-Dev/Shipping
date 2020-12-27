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
    <title>ข้อมูลส่วนตัว</title>

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
                <div class="col-12">
                    <h1>แก้ไขข้อมูลส่วนตัว</h1>
                </div>
                <div class="col-12">
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
                                <select name="member_type" id="member_type" class="form-control form-control-sm" disabled>
                                    <option value="" selected>กรุณาเลือกตำแหน่ง</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12 text-center">
                                <button type="button" class="btn btn-success">บันทึก</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>
</html>