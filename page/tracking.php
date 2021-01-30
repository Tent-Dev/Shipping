<?php
include("../client_config/config.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Tracking</title>

	<!-- import Lib -->
	<link rel="stylesheet" href="../lib/bootstrap-4.5.3-dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
	<script src="../lib/jQuery/jquery-3.5.1.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="../lib/bootstrap-4.5.3-dist/js/bootstrap.bundle.min.js" type="text/javascript" charset="utf-8"></script>

	<link rel="preconnect" href="https://fonts.gstatic.com"> 
    <link href="https://fonts.googleapis.com/css2?family=Prompt:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="../css/tracking.css">

	<!-- import My Script -->
	<script src="../js/tracking.js?v=<?php echo JS_VERSION ?>" type="text/javascript" charset="utf-8"></script>
</head>
<body>
	<nav>
		<div class="nav-logo">
			<img src="https://fph.tu.ac.th/uploads/fph/DownloadLogo/2018_FPHHorz%20Logo%20%28EN%29.png" alt="">
		</div>
		<div class="nav-right">
			ติดต่อ <a href="tel:099-999999" class="tel">099-999999</a>
		</div>
	</nav>

	<div class="box">
		<div class="card">
			<div class="card-body">
				<h1>เช็คสถานะพัสดุ</h1>
				<div class="form-group">
					<div class="input-group mt-3">
						<div class="input-group-prepend">
							<div class="input-group-text"><i class="fas fa-barcode"></i></div>
						</div>
						<input id="tracking_code" class="form-control" type="text" name="" value="" placeholder="">
					</div>
				</div>
				<div class="text-right">
					<button class="btn btn-primary mt-3 check_tracking" type="" id="check_tracking">ตรวจสอบสถานะ</button>
				</div>
			</div>
		</div>
		<div class="wrapper">
			<ul class="StepProgress" id="transport_history">
				<!-- <li class="StepProgress-item is-done"><strong>Post a contest</strong></li>
				<li class="StepProgress-item is-done"><strong>Award an entry</strong>
					Got more entries that you love? Buy more entries anytime! Just hover on your favorite entry and click the Buy button
				</li>
				<li class="StepProgress-item current"><strong>Post a contest</strong></li>
				<li class="StepProgress-item"><strong>Handover</strong></li>
				<li class="StepProgress-item"><strong>Provide feedback</strong></li> -->
			</ul>
		</div>
	</div>
	<div class="overlay"></div>

	<!-- <div class="container">
		<div class="row">
			<div align="center" class="row">
				<div class="col-12" align="left">
					<h1>เช็คสถานะพัสดุ</h1>
				</div>
				<div class="col-10">
					<div class="form-group">
						<div class="input-group mt-3">
							<div class="input-group-prepend">
								<div class="input-group-text"><i class="fas fa-barcode"></i></div>
							</div>
							<input class="form-control" type="text" name="" value="" placeholder="">
						</div>
					</div>
				</div>
				<div class="col-2">
					<button class="btn btn-primary mt-3" type="" id="test_connect">ตรวจสอบสถานะ</button>
				</div>
				
			</div>
			<p align="center">Copyright 2020 Shipping System by <a href="#">Dev-Team</a></p>
		</div>
	</div> -->

</body>
</html>

<script type="text/javascript">
	//hardcode script here
</script>