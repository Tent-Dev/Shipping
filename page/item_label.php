<?php
include("../client_config/config.php");
if(isset($_GET['tracking_code'])){
    $tracking_code = $_GET['tracking_code'];
}else{
    $tracking_code = '-';
}

if(isset($_GET['mode'])){
    $mode = $_GET['mode'];
}else{
    $mode = '';
}

if(isset($_GET['transaction_id'])){
    $transaction_id = $_GET['transaction_id'];
}else{
    $transaction_id = '';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ใบปะหน้า</title>

    <script src="../lib/jQuery/jquery-3.5.1.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="../lib/Barcode/qrcode_generate.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.3/dist/JsBarcode.all.min.js"></script>
    <script src="../lib/sweetalert2/sweetalert2.all.min.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript">
        var TRACKING_CODE = <?php echo "'{$tracking_code}'" ?>;
        var MODE = <?php echo "'{$mode}'" ?>;
        var TRANSACTION_ID = <?php echo "'{$transaction_id}'" ?>;
    </script>

    <script src="../js/item_label.js?v=<?php echo JS_VERSION ?>" type="text/javascript" charset="utf-8"></script>

    <style>
        * {
            box-sizing: border-box;
        }
        .page {
            width: 21cm;
            height: 29.7cm;
            margin: 1rem auto;
        }
        .box {
            width: 100mm;
            height: 75mm;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ababab;
        }
        .address1 {
            float: left;
            width: 60%;
            height: 110px;
            padding: 10px 20px 5px 0;
            font-size: 12px;
            line-height: 16px;
            margin-bottom: 10px;
        }
        .address1 b {
            font-size: 12px;
        }
        .address-right {
            position: relative;
            float: left;
            width: 40%;
            text-align: right;
        }
        .address-right .logo {
            width: 100%;
        }
        .address-right svg {
            position: absolute;
            width: 100%;
            top: 10px;
            left: 0;
        }
        .address2 {
            position: relative;
            clear: both;
            width: 80%;
            margin: 0 auto;
            font-size: 14px;
            line-height: 18px;
        }
        .address2 b {
            font-size: 12px;
        }
        p {
            margin-top: 2px;
            margin-bottom: 2px;
        }
        .postcode {
            margin-top: 10px;
        }
        .postcode span {
            padding: 2px 4px;
            border: 1px solid #000000;
        }
        .postcode_arr{
            margin-right: 3px;
        }
        .date {
            font-size: 10px;
            text-align: right;
        }

        .qr_gen{
            position: absolute;
            left: 15px;
            text-align: -webkit-center;
        }

        .wrap_barcode {
            width: 145px;
            display: flex;
            position: absolute;
            right: 25px;
            bottom: -45px;
        }

        @media print {
            header, footer {
                display: none !important;
            }
        }
    </style>
</head>
<body>
    <div class="page">
        <div class="boxs">
            <!-- <div class="box">
                <div class="address1">
                    <b>ชื่อที่อยู่ผู้ส่ง</b>
                    <p class="s_name">ชื่อ</p>
                    <p class="s_address">ที่อยู่ </p><p>เขต <span class="s_area"></span> แขวง <span class="s_district"></span> <span class="s_province"></span></p>
                </div>
                <div class="address-right">
                    <img src="https://fph.tu.ac.th/uploads/fph/DownloadLogo/2018_FPHHorz%20Logo%20%28EN%29.png" alt="logo" class="logo">
                    <svg class="barcode" jsbarcode-value="SH00000000000" jsbarcode-margin="0" jsbarcode-fontsize="40" jsbarcode-fontoptions="bold"></svg>
                </div>
                <div class="address2">
                    <b>ชื่อที่อยู่ผู้รับ</b>
                    <p class="r_name">ชื่อ</p>
                    <p class="r_address">ที่อยู่ </p><p>เขต <span class="r_area"></span> แขวง <span class="r_district"></span> <span class="r_province"></span></p>
                    <p>โทร. <span class="r_phone"></span></p>
                    <div class="postcode">
                        <span>0</span>
                        <span>0</span>
                        <span>0</span>
                        <span>0</span>
                        <span>0</span>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
    <script>
        JsBarcode(".barcode").init();
    </script>
</body>
</html>