<?php
include("../client_config/config.php");

if(isset($_GET['transaction_id'])){
    $trans_id = $_GET['transaction_id'];
}else{
    $trans_id = '-';
}

if(isset($_GET['mode'])){
    $mode = $_GET['mode'];
}else{
    $mode = '-';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slip</title>

    <script src="../lib/jQuery/jquery-3.5.1.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="../lib/sweetalert2/sweetalert2.all.min.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript">
        var TRANSACTION_ID = <?php echo "'{$trans_id}'" ?>;
        var MODE = <?php echo "{$mode}" ?>;
    </script>

    <script src="../js/slip.js?v=<?php echo JS_VERSION ?>" type="text/javascript" charset="utf-8"></script>

    <style>
        * { box-sizing: border-box; }
        body {
            font-size: 14px;
            line-height: 16px;
            background-color: #d4d4d4;
        }
        p { margin: 0; }
        hr {
            border: none;
            border-bottom: 1px solid #000000;
        }
        .slip {
            width: 80mm;
            height: auto;
            margin: 1rem auto;
            padding: 10px;
            background-color: #ffffff;
        }
        .logo {
            width: 75%;
            margin: 1rem auto 0;
        }
        .logo img { width: 100%; }
        .center { text-align: center; }
        .details { padding: 2px 8px; }
        .footer {
            margin: 10px 0;
            text-align: center;
        }
        .footer p { margin: 4px 0; }

        @media print {
            @page {
                /* size: 80mm 160mm; */
                padding: 0;
                margin: 0;
            }
        }
    </style>
</head>
<body>
    <div class="slip">
        <div class="logo">
            <img src="https://fph.tu.ac.th/uploads/fph/DownloadLogo/2018_FPHHorz%20Logo%20%28EN%29.png" alt="logo">
        </div>
        <div class="center">
            <p><b>Shipping Express</b></p>
            <p>สาขา : xxxx</p>
            <p>Tel./Fax : 000000000 </p>
            <p>*..ขอบคุณที่มาใช้บริการ..*</p>
        </div>
        <div style="margin-top: 6px;">
            <p>วันที่ <span class="create_date">0000-00-00 00:00:00</span></p>
            <p>บิลเลขที่ : <span class="transaction_id">-</span></p>
            <p>แคชเชียร์ : <span class="employee_name">-</span></p>
        </div>
        <hr>
        <div class="wrap_detail">
            <div class="details">
                <p>เขต ### -</p>
                <p>เลขอ้างอิง -</p>
                <table width="100%">
                    <tr>
                        <td width="50%">- น้ำหนัก</td>
                        <td width="40%" align="right">0</td>
                        <td width="10%" align="center">กรัม</td>
                    </tr>
                    <tr>
                        <td width="50%">- ค่าธรรมเนียม</td>
                        <td width="40%" align="right">0</td>
                        <td width="10%"></td>
                    </tr>
                    <tr>
                        <td width="50%">- ค่าบริการ</td>
                        <td width="40%" align="right" style="border-bottom: 1px solid #000000;">0</td>
                        <td width="10%"></td>
                    </tr>
                    <tr>
                        <td width="50%">รวมเป็นเงิน</td>
                        <td width="40%" align="right" style="border-bottom: 1px solid #000000;">0</td>
                        <td width="10%"></td>
                    </tr>
                </table>
                <p>ผู้รับ : คุณ​ มาลีจ้า</p>
                <hr>
            </div>
        </div>

        <table width="100%">
            <tr>
                <td width="50%">ยอดเงิน</td>
                <td class="total" width="50%" align="right" style="font-size: 20px; font-weight: 700; border-bottom: 1px solid #000000;">0</td>
            </tr>
            <tr>
                <td width="50%">รับ :</td>
                <td width="50%" align="right" class="get_price">0</td>
            </tr>
            <tr>
                <td width="50%">ทอน :</td>
                <td width="50%" align="right" class="change_price" style="border-bottom: 1px solid #000000;">0</td>
            </tr>
        </table>
        <div class="footer">
            <p>เวลาเปิดทำการ จันทร์-อาทิตย์ เวลา 9.00-18.00 น.</p>
            <p>สามารถเช็คพัสดุของท่านได้ที่<br>https://cplus-express.com/check</p>
            <p>ขอบคุณที่ใช้บริการ โปรดเก็บใบเสร็จไว้เพื่อเป็นหลักฐานในการเคลมสินค้า</p>
            <p>ห้ามส่งพัสดุที่ผิดกฎหมายทุกชนิด ทางบริษัทจะไม่รับประกัน</p>
            <p>**เงื่อนไขในการรับประกันเป็นไปตามนโยบายที่ทางบริษัทกำหนด**</p>
        </div>
    </div>

    <script src="../lib/jQuery/jquery-3.5.1.min.js" type="text/javascript" charset="utf-8"></script>
    <script>
        var h = $('body').height();
        $('head').append('<style>@media print{ @page{size: 80mm '+(h+20)+'px;} }</style>');
    </script>
</body>
</html>