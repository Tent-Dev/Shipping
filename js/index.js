$(document).ready(function() {
	$('#test_connect').click(function(event) {
		$.ajax({
			url: 'api/function/system_sign.php',
			method: 'post',
			data: {
				command: 'login',
				username: 'admin',
				password: '1234'
			},
			success: function(data) {
				var data = JSON.parse(data)
				console.log("result: ",data);
			},
			error: function() {
				console.log("error");
			}
		});
	});
});