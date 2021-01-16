<?php
    include("../client_config/config.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ใบปะหน้า</title>

    <style>
        * {
            box-sizing: border-box;
        }
        .page {
            width: 21cm;
            height: 29.7cm;
            margin: 1rem auto;
        }
        .boxs {
            display: flex;
            flex-wrap: wrap;
        }
        .box {
            width: 100mm;
            height: 75mm;
            padding: 10px;
            border: 1px solid #ababab;
        }
        .address1 {
            float: left;
            width: 60%;
            height: 110px;
            padding: 10px 20px 5px 0;
            font-size: 12px;
            line-height: 16px;
        }
        .address1 b {
            font-size: 14px;
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
            clear: both;
            width: 60%;
            margin: 0 auto;
            font-size: 12px;
            line-height: 18px;
        }
        .address2 b {
            font-size: 16px;
        }
        p {
            margin-top: 2px;
            margin-bottom: 4px;
        }
        .postcode span {
            padding: 2px 4px;
            border: 1px solid #000000;
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
            <div class="box">
                <div class="address1">
                    <b>ชื่อที่อยู่ผู้ฝากส่ง</b>
                    <p>ชื่อ</p>
                    <p>ที่อยู่ <br>ที่อยู่ <br>ที่อยู่</p>
                </div>
                <div class="address-right">
                    <img src="https://fph.tu.ac.th/uploads/fph/DownloadLogo/2018_FPHHorz%20Logo%20%28EN%29.png" alt="logo" class="logo">
                    <svg class="barcode" jsbarcode-value="AnyValueYouWish" jsbarcode-margin="0"></svg>
                </div>
                <div class="address2">
                    <b>ชื่อที่อยู่ผู้รับ</b>
                    <p>ชื่อ</p>
                    <p>ที่อยู่ <br>ที่อยู่ <br>ที่อยู่</p>
                    <p>โทร.</p>
                    <div class="postcode">
                        <span>1</span>
                        <span>0</span>
                        <span>1</span>
                        <span>5</span>
                        <span>0</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.3/dist/JsBarcode.all.min.js"></script>
    <script>
        JsBarcode(".barcode").init();
    </script>
</body>
</html>