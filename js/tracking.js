$(document).ready(function() {
	$('#test_connect').click(function(event) {
		$.ajax({
			url: '../api/function/query_description.php',
			method: 'post',
			data: {
				command: 'tracking',
				tracking_code: '1102002841486'
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