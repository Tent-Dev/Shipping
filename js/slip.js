$(document).ready(function() {
	getData();
});

function getData(){
	if(TRANSACTION_ID){
		console.log('TRANSACTION_ID: ',TRANSACTION_ID);

		$.ajax({
				url: '../api/function/manage_transaction.php',
				method: 'post',
				data: {
					command: 'get_transactionById',
					id: TRANSACTION_ID,
				},
				success: function(data) {
					var data = JSON.parse(data);
					console.log("result: ",data);
					if(data.status == 200){

						console.log(data.data);

						$('.transaction_id').html(data.data.transaction_id);

					}else{
						Swal.fire({
							title: 'พบข้อผิดพลาด',
							text: 'ชื่อบัญชีผู้ใช้ หรือรหัสผ่านไม่ถูกต้อง',
							icon: 'error',
							confirmButtonText: 'ตกลง'
						});
					}
				},
				error: function() {
				}
			});

	}else{
		console.log('TRANSACTION_ID : not found');
	}
}