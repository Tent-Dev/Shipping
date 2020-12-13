<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Hello Shipping</title>

	<!-- import Lib -->
	<link rel="stylesheet" href="lib/bootstrap-4.5.3-dist/css/bootstrap.min.css">
	<link href="lib/fontawesome-free-5.15.1-web/css/all.css" rel="stylesheet">
	<link href="lib/sweetalert2/sweetalert2.min.css" rel="stylesheet">
	<link href="css/main_custom.css" rel="stylesheet">
	
	<!-- <link rel="preconnect" href="https://fonts.gstatic.com"> 
    <link href="https://fonts.googleapis.com/css2?family=Prompt:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet"> -->

	<script src="lib/jQuery/jquery-3.5.1.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="lib/bootstrap-4.5.3-dist/js/bootstrap.bundle.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="lib/sweetalert2/sweetalert2.all.min.js" type="text/javascript" charset="utf-8"></script>

	<!-- import My Script -->
	<script src="js/index.js" type="text/javascript" charset="utf-8"></script>

</head>
<body>
	<style>
		.login-box {
			position: absolute;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
		}
	</style>

	<div class="login-box">
		<div class="card shadow p-3 mb-5 bg-white rounded">
			<div class="card-body">
				<h1>Shipping System</h1>
				<div class="form-group">
					<div class="input-group mt-3">
						<div class="input-group-prepend">
							<div class="input-group-text"><i class="fas fa-user"></i></div>
						</div>
						<input id="username" class="form-control" type="text" name="" value="" placeholder="">
					</div>
					<div class="input-group mt-3">
						<div class="input-group-prepend">
							<div class="input-group-text"><i class="fas fa-key"></i></div>
						</div>
						<input id="password" class="form-control" type="password" name="" value="" placeholder="" required>
					</div>
					<button class="btn btn-primary mt-3" type="button" id="login">เข้าสู่ระบบ</button>
				</div>
			</div>
		</div>
		<p align="center">Copyright 2020 Shipping System by <a href="#">Dev-Team</a></p>
	</div>
</body>
</html>

<script type="text/javascript">
	//hardcode script here
</script>