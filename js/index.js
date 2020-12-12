$(document).ready(function() {

	$('#login').click(function(event) {
		event.preventDefault();
		var username = $('#username').val();
		var password = $('#password').val();
		if(validate()){
			$('#login').html('<i class="fas fa-spinner fa-spin"></i></span>');
			$.ajax({
				url: 'api/function/system_sign.php',
				method: 'post',
				data: {
					command: 'login',
					username: username,
					password: password
				},
				success: function(data) {
					var data = JSON.parse(data);
					console.log("result: ",data);
					if(data.status == 200){
						location.href = 'page/lists.php';
					}else{
						console.log("result: ",data);
						$('#login').html('เข้าสู่ระบบ');
					console.log("error");
					Swal.fire({
						title: 'พบข้อผิดพลาด',
						text: 'ชื่อบัญชีผู้ใช้ หรือรหัสผ่านไม่ถูกต้อง',
						icon: 'error',
						confirmButtonText: 'ตกลง'
					});
					}
				},
				error: function() {
					$('#login').html('เข้าสู่ระบบ');
				}
			});
		}
	});
});

function validate(){
	var result = true;
	var username = $('#username').val();
	var password = $('#password').val();

	if(username == '' || password == ''){
		result = false;
	}

	return result;
}