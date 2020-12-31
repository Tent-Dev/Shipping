<?php
include("auth_onpage.php");
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
    <link href="../css/main_custom.css" rel="stylesheet">

    <script src="../lib/jQuery/jquery-3.5.1.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="../lib/bootstrap-4.5.3-dist/js/bootstrap.bundle.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="../lib/sweetalert2/sweetalert2.all.min.js" type="text/javascript" charset="utf-8"></script>

    <script src="../js/common.js?v=<?php echo JS_VERSION ?>" type="text/javascript" charset="utf-8"></script>
    <script src="../js/sort_mail.js?v=<?php echo JS_VERSION ?>" type="text/javascript" charset="utf-8"></script>
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
                <div class="col-9">
                    <h1>คัดแยกพัสดุ</h1>
                </div>
            </div>
            <div class="overflow-auto">
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
                    <tbody id="show_data_from_db">
                    </tbody>
                </table>
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

        <div class="modal fade" id="editData" tabindex="-1" aria-labelledby="editDataLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            </div>
        </div>
    </section>
</body>
</html>