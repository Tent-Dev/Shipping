<!DOCTYPE html>
<html>
<head>
	<title>Hello Shipping</title>
	<script src="js/jquery-3.5.1.min.js" type="text/javascript" charset="utf-8"></script>
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->

</head>
<body>
	<div>
		<p>test</p>	
		<button type="" id="test_connect">test</button>
	</div>

</body>
</html>

<script type="text/javascript">
	$(document).ready(function() {
		$('#test_connect').click(function(event) {
			$.ajax({
				url: 'api/function/system_sign.php',
				method: 'post',
				data: {
					command: 'login',
					user: 'admin',
					pass: '1234'
				},
				success: function(data) {
					//var data = JSON.parse(data)
					console.log("result: ",data);
				},
				error: function() {
					console.log("error");
				}
			});
		});
	});
</script>