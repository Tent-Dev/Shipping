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
            flex: 0 0 25%;
            height: 130px;
            padding-top: 10px;
            text-align: center;
            border: 1px solid #ababab;
        }
        .barcode {
            width: 90%;
        }
        p {
            margin: 0;
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
            <?php
                for($i=0; $i<9; $i++) {
            ?>
                    <div class="box">
                        <img src="http://barcodes4.me/barcode/c128b/AnyValueYouWish.gif" alt="barcode" class="barcode">
                        <p>AnyValueYouWish</p>
                    </div>
            <?php
                }
            ?>
        </div>
    </div>
</body>
</html>