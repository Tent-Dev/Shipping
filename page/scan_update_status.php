<?php
include("auth_onpage.php");
// if($_SESSION['TYPE'] != 'admin' && $_SESSION['TYPE'] != 'staff'){
//     header("Location: javascript://history.go(-1)");
//     exit;
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <link rel="stylesheet" href="../lib/bootstrap-4.5.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
    <link href="../css/main_custom.css" rel="stylesheet">
    <link href="../css/dashboard.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <link rel="stylesheet" href="https://earthchie.github.io/jquery.Thailand.js/jquery.Thailand.js/dist/jquery.Thailand.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com"> 
    <link href="https://fonts.googleapis.com/css2?family=Prompt:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <script src="../lib/jQuery/jquery-3.5.1.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="../lib/bootstrap-4.5.3-dist/js/bootstrap.bundle.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="../lib/sweetalert2/sweetalert2.all.min.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="../lib/Barcode/html5-qrcode.min.js" type="text/javascript" charset="utf-8"></script>

    <script src="../js/common.js?v=<?php echo JS_VERSION ?>" type="text/javascript" charset="utf-8"></script>
    <script src="../js/scan_update_status.js?v=<?php echo JS_VERSION ?>" type="text/javascript" charset="utf-8"></script>
    <script src="../js/logout.js?v=<?php echo JS_VERSION ?>" type="text/javascript" charset="utf-8"></script>
</head>
<body>
    <?php include('menu_layout.php'); ?>

    <!-- <section>
        <div class="container" style="margin-bottom: 20px">
            <div align="center" class="col-12">
                <div id="reader" style="width: 300px; height: 300px;">
                </div>
            </div>

        </div>
    </section> -->

    <section>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- <div class="row"> -->
                        <a href="update_status.php" class="btn-back">อัพเดทสถานะพัสดุ</a> / <h2 class="d-inline">สแกนอัพเดท</h2>
                    <!-- </div> -->
                    <div class="container" style="margin-bottom: 20px; margin-top: 20px">
                        <div align="center" class="col-12">
                            <div id="reader" style="width: 100%; height: 100%;">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>