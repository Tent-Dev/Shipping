$(document).ready(function() {
	$('#check_tracking').click(function(event) {
		var tracking_code = $('#tracking_code').val();
		$.ajax({
			url: '../api/function/manage_tracking.php',
			method: 'post',
			data: {
				command: 'tracking',
				tracking_code: tracking_code
			},
			success: function(data) {
				var data = JSON.parse(data)
				if(data.status == 200){
					console.log("result: ",data);
				}else{
					console.log("result: ",data);
				}
			},
			error: function() {
				console.log("error");
			}
		});
	});
});