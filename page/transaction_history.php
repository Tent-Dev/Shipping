<?php
    include("auth_onpage.php");

    if(isset($_GET['transaction_id'])) {
        $trans_id = $_GET['transaction_id'];
    } else {
        $trans_id = '"-"';
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข้อมูลประวัติการทำรายการ</title>

    <link rel="stylesheet" href="../lib/bootstrap-4.5.3-dist/css/bootstrap.min.css">
    <link href="../lib/fontawesome-free-5.15.1-web/css/all.css" rel="stylesheet">
    <link href="../css/main_custom.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.gstatic.com"> 
    <link href="https://fonts.googleapis.com/css2?family=Prompt:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <script src="../lib/jQuery/jquery-3.5.1.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="../lib/bootstrap-4.5.3-dist/js/bootstrap.bundle.min.js" type="text/javascript" charset="utf-8"></script>

    <script src="../js/common.js?v=<?php echo JS_VERSION ?>" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript">
        var trans_id = '<?php echo $trans_id; ?>';
    </script>
    <script src="../js/transaction_history.js?v=<?php echo JS_VERSION ?>" type="text/javascript" charset="utf-8"></script>
    <script src="../js/logout.js?v=<?php echo JS_VERSION ?>" type="text/javascript" charset="utf-8"></script>

    <style>
        .btn-back, .btn-back:hover {
            color: #464646;
            text-decoration: none;
        }
        .cancel{
            color: red;
        }
        .cancel_row{
            background-color: #efefef;
            color: #909090;
        }
    </style>
</head>
<body>
    <?php include('menu_layout.php'); ?>
    
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mt-3 mb-2">
                    <a href="history.php" class="btn-back">ประวัติการทำรายการ</a> / <h2 class="d-inline">ข้อมูลประวัติการทำรายการ</h2>
                </div>
                <div class="col-lg-4 d-flex align-items-center justify-content-end">
                    <a href="slip.php?transaction_id=<?php echo $trans_id; ?>&mode='trans_id'" target="_blank" class="btn btn-sm btn-info mr-2">พิมพ์ใบเสร็จ</a>
                    <a href="item_label.php?transaction_id=<?php echo $trans_id; ?>&mode=all" target="_blank" class="btn btn-sm btn-info">พิมพ์ใบปะหน้าทั้งหมด</a>
                </div>
            </div>
            <div class="row mt-2 mb-4">
                <div class="col-lg-1">ค้นหา</div>
                <div class="col-lg-3"><input class="filter mt-2 mt-lg-0 mb-2 mb-lg-0" type="text" name="search" id="search" placeholder="ค้นหา"></div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="oveflow-auto">
                        <table class="table table-sm table-hover"></table>
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
    </section>
</body>
</html>