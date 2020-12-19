<?php
    include("../client_config/config.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slip</title>

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
            <p><b>Cplus Express</b></p>
            <p>สาขา : xxxx</p>
            <p>Tel./Fax : 000000000 </p>
            <p>*..ขอบคุณที่มาใช้บริการ..*</p>
        </div>
        <div style="margin-top: 6px;">
            <p>วันที่ 2020-12-12 08:10:42</p>
            <p>บิลเลขที่ : 3456i</p>
            <p>แคชเชียร์ : มาลี</p>
        </div>
        <hr>
        <div class="details">
            <p>1 เขต 10150</p>
            <p>เลขอ้างอิง ded34353646gt</p>
            <table width="100%">
                <tr>
                    <td width="50%">- น้ำหนัก</td>
                    <td width="40%" align="right">777</td>
                    <td width="10%" align="center">กรัม</td>
                </tr>
                <tr>
                    <td width="50%">- ค่าธรรมเนียม</td>
                    <td width="40%" align="right">110.00</td>
                    <td width="10%"></td>
                </tr>
                <tr>
                    <td width="50%">- ค่าบริการ</td>
                    <td width="40%" align="right" style="border-bottom: 1px solid #000000;">0.00</td>
                    <td width="10%"></td>
                </tr>
                <tr>
                    <td width="50%">รวมเป็นเงิน</td>
                    <td width="40%" align="right" style="border-bottom: 1px solid #000000;">110.00</td>
                    <td width="10%"></td>
                </tr>
            </table>
            <p>ผู้รับ : คุณ​ มาลีจ้า</p>
            <hr>
        </div>

        <table width="100%">
            <tr>
                <td width="50%">ยอดเงิน</td>
                <td width="50%" align="right" style="font-size: 20px; font-weight: 700; border-bottom: 1px solid #000000;">110.00</td>
            </tr>
            <tr>
                <td width="50%">รับ :</td>
                <td width="50%" align="right">120.00</td>
            </tr>
            <tr>
                <td width="50%">ทอน :</td>
                <td width="50%" align="right" style="border-bottom: 1px solid #000000;">10.00</td>
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