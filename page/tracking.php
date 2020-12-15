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
	<link href="../lib/fontawesome-free-5.15.1-web/css/all.css" rel="stylesheet">
	<script src="../lib/jQuery/jquery-3.5.1.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="../lib/bootstrap-4.5.3-dist/js/bootstrap.bundle.min.js" type="text/javascript" charset="utf-8"></script>

	<!-- import My Script -->
	<script src="../js/tracking.js?v=<?php echo JS_VERSION ?>" type="text/javascript" charset="utf-8"></script>

</head>
<body>
	<style>
		body {
			
		}
		.box {
			width: 50%;
			position: absolute;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
		}
	</style>

	<div class="box">
		<div class="card shadow p-3 mb-5 bg-white rounded">
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
					<button class="btn btn-primary mt-3" type="" id="check_tracking">ตรวจสอบสถานะ</button>
				</div>
			</div>
		</div>
	</div>
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