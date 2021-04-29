<?php
include("auth_onpage.php");
if($_SESSION['TYPE'] != 'admin'){
    header("Location: javascript://history.go(-1)");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage User</title>

    <link rel="stylesheet" href="../lib/bootstrap-4.5.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />

    <link rel="preconnect" href="https://fonts.gstatic.com"> 
    <link href="https://fonts.googleapis.com/css2?family=Prompt:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="../css/main_custom.css" rel="stylesheet">

    <script src="../lib/jQuery/jquery-3.5.1.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="../lib/bootstrap-4.5.3-dist/js/bootstrap.bundle.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="../lib/sweetalert2/sweetalert2.all.min.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript">
        var MEMBER_TYPE = <?php echo MEMBER_TYPE; ?>;
        var BRANCH_LIST = <?php echo BRANCH_LIST; ?>;
    </script>
    <script src="../js/common.js?v=<?php echo JS_VERSION ?>" type="text/javascript" charset="utf-8"></script>
    <script src="../js/manage_user.js?v=<?php echo JS_VERSION ?>" type="text/javascript" charset="utf-8"></script>
    <script src="../js/logout.js?v=<?php echo JS_VERSION ?>" type="text/javascript" charset="utf-8"></script>

</head>
<body>
    <?php include('menu_layout.php'); ?>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-12 mt-3 mb-5">
                    <div class="row">
                        <div class="col-lg-9">
                            <h1>จัดการรายชื่อพนักงาน</h1>
                        </div>
                        <div class="col-lg-3 d-flex align-items-center justify-content-end mb-4 mb-lg-0">
                            <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#addData">เพิ่มบัญชีผู้ใช้ <i class="fas fa-plus"></i></button>
                        </div>
                    </div>
                    <div class="row mt-2 mb-4">
                        <div class="col-lg-1">ค้นหา</div>
                        <div class="col-lg-3"><input class="filter mt-2 mt-lg-0 mb-2 mb-lg-0" type="text" name="search" id="search" placeholder="ค้นหา"></div>
                        <div class="col-lg-1">ตำแหน่ง</div>
                        <div class="col-lg-3">
                            <select class="filter mt-2 mt-lg-0" name="filter_member_type" id="filter_member_type">
                                <option value="" selected>ทั้งหมด</option>
                                <?php foreach ($member_type as $value) { ?>
                                    <option value="<?php echo $value ?>"><?php echo ucfirst($value) ?></option>
                                <?php } ?>
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
                <div class="col-12 my-3" style="display: flex;">
                    <nav aria-label="Page navigation">
                        <ul class="pagination pagination-sm justify-content-center">
                            <div class="main_pagination"></div>
                        </ul>
                    </nav>
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
                                <div class="col-12">
                                    <label for="branch_select" class="col-form-label col-form-label-sm">ประจำสาขา</label>
                                    <select name="branch_select" id="branch_select" class="form-control form-control-sm">
                                        <option value="" selected>กรุณาเลือกสาขา</option>
                                    </select>
                                </div>
                            </div>
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
                                    <label for="member_type" class="col-form-label col-form-label-sm">ตำแหน่ง</label>
                                    <select name="member_type" id="member_type" class="form-control form-control-sm">
                                        <option value="" selected>กรุณาเลือกตำแหน่ง</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label for="password" class="col-form-label col-form-label-sm">Password</label>
                                    <input type="password" name="password" id="password" class="form-control form-control-sm" value="">
                                </div>
                                <div class="col-6">
                                    <label for="confirm_password" class="col-form-label col-form-label-sm">Confirm Password</label>
                                    <input type="password" name="confirm_password" id="confirm_password" class="form-control form-control-sm" value="">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn_cancel" data-dismiss="modal">ยกเลิก</button>
                        <button type="button" class="btn btn-success btn_add">เพิ่ม</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="editData" tabindex="-1" aria-labelledby="editDataLabel" aria-hidden="true">
            <div class="modal-dialog modal-edit modal-dialog-centered modal-dialog-scrollable"></div>
        </div>
    </section>
</body>
</html>