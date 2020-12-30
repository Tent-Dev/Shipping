$(document).ready(function() {
	getAccountDescription();

	$(document).on('click', '.btn_save', function(event) {
		updateAccount();
	});
});

function getAccountDescription(){
	$.ajax({
		url: '../api/function/manage_account.php',
		method: 'post',
		data: {
			command: 'get_account_desc',
			account_id: MEMBER_ID,
		},
		success: function(data) {
			var data = JSON.parse(data);
			console.log("result: ",data);

			if(data.status == 200){
                //getDataFromDB();

                $('#firstname').val(data.data.firstname);
                $('#lastname').val(data.data.lastname);
                $('#username').val(data.data.username);
                $('#member_type').val(data.data.member_type);
            }
            else if(data.status == 500){
            }
        },
        error: function() {
        	console.log("error");
        }
    });
}

function updateAccount(){
	var firstname = $('#firstname').val();
	var lastname = $('#lastname').val();
	var username = $('#username').val();
	var old_password = $('#old_password').val();
	var new_password = $('#new_password').val();
	var confirm_password = $('#confirm_password').val();
	var member_type = $('#member_type').val();

	if(validate()){
		$('.btn_save').html('<i class="fas fa-spinner fa-spin"></i></span>');
		$('.btn_save').attr('disabled', true);
		$.ajax({
			url: '../api/function/manage_account.php',
			method: 'post',
			data: {
				command: 'update_account',
				member_id: MEMBER_ID,
				firstname: firstname,
				lastname: lastname,
				old_password: old_password,
				new_password: new_password,
				confirm_password: confirm_password
			},
			success: function(data) {
				var data = JSON.parse(data);
				console.log("result: ",data);
				$('.btn_save').html('บันทึก');
				$('.btn_save').attr('disabled', false);

				if(data.status == 200){
					Swal.fire({
						title: 'สำเร็จ',
						text: 'อัพเดทข้อมูลแล้ว',
						icon: 'success',
						confirmButtonText: 'ตกลง'
					});

					$('#old_password, #new_password, #confirm_password').val('');
				}
				else if(data.status == 998){
					Swal.fire({
						title: 'พบข้อผิดพลาด',
						text: 'ไม่สามารถตรวจสอบข้อมูลได้',
						icon: 'error',
						confirmButtonText: 'ตกลง'
					});
				}
				else if(data.status == 999){
					Swal.fire({
						title: 'พบข้อผิดพลาด',
						text: 'ยืนยันรหัสผ่านไม่ตรงกัน',
						icon: 'error',
						confirmButtonText: 'ตกลง'
					});
				}
				else if(data.status == 1000){
					Swal.fire({
						title: 'พบข้อผิดพลาด',
						text: 'รหัสผ่านเก่าไม่ถูกต้อง',
						icon: 'error',
						confirmButtonText: 'ตกลง'
					});
				}

			},
			error: function() {
				$('.btn_save').html('บันทึก');
				$('.btn_save').attr('disabled', false);
				console.log("error");
			}
		});
	}
}

function validate(){
	var result = true;
	var firstname = $('#firstname').val();
	var lastname = $('#lastname').val();
	var username = $('#username').val();
	var old_password = $('#old_password').val();
	var new_password = $('#new_password').val();
	var confirm_password = $('#confirm_password').val();
	var member_type = $('#member_type').val();

	if(username == '' || firstname == '' || lastname == '' || member_type == '' ){
		result = false;

		if(username == ''){
			$('#username').addClass('custom_has_err');
			$("#username").attr("placeholder", "โปรดกรอกบัญชีผู้ใช้");
		}else{
			$('#username').removeClass('custom_has_err');
			$("#username").attr("placeholder", "");
		}

		if(firstname == ''){
			$('#firstname').addClass('custom_has_err');
			$("#firstname").attr("placeholder", "โปรดกรอกชื่อ");
		}else{
			$('#firstname').removeClass('custom_has_err');
			$("#firstname").attr("placeholder", "");
		}

		if(lastname == ''){
			$('#lastname').addClass('custom_has_err');
			$("#lastname").attr("placeholder", "โปรดกรอกนามสกุล");
		}else{
			$('#lastname').removeClass('custom_has_err');
			$("#lastname").attr("placeholder", "");
		}

		if(member_type == ''){
			$('#member_type').addClass('custom_has_err');
            //$("#member_type").attr("placeholder", "โปรดกรอกรหัสผ่าน");
        }else{
        	$('#member_type').removeClass('custom_has_err');
            //$("#member_type").attr("placeholder", "");
        }
    }
    else{
        $('#username, #firstname, #lastname, #member_type').removeClass('custom_has_err');
    }

    if((new_password !== '' || confirm_password !== '') && (old_password == '' || confirm_password == '') ){
    	result = false;

    	if(old_password == ''){
			$('#old_password').addClass('custom_has_err');
			$("#old_password").attr("placeholder", "โปรดกรอกรหัสผ่านเก่า");
		}else{
			$('#old_password').removeClass('custom_has_err');
			$("#old_password").attr("placeholder", "");
		}

		if(confirm_password == ''){
			$('#confirm_password').addClass('custom_has_err');
			$("#confirm_password").attr("placeholder", "โปรดกรอกยืนรหัสผ่านใหม่");
		}else{
			$('#confirm_password').removeClass('custom_has_err');
			$("#confirm_password").attr("placeholder", "");
		}

		if(new_password == ''){
			$('#new_password').addClass('custom_has_err');
			$("#new_password").attr("placeholder", "โปรดกรอกรหัสผ่านใหม่");
		}else{
			$('#new_password').removeClass('custom_has_err');
			$("#new_password").attr("placeholder", "");
		}
    }
    else{
        $('#confirm_password, #new_password, #old_password').removeClass('custom_has_err');
        $("#new_password, #old_password, #confirm_password").attr("placeholder", "");
    }

    return result;
}