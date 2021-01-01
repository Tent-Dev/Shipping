$(document).ready(function() {

	$('.logout').click(function(event) {
		event.preventDefault();
		console.log('logout');
		$.ajax({
			url: '../api/function/system_sign.php',
			method: 'post',
			data: {
				command: 'logout'
			},
			success: function(data) {
				// var data = JSON.parse(data);
				// console.log("result: ",data);

				location.href = '../index.php';
			},
			error: function() {
				console.log("error");
			}
		});
	});
});