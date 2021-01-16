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
					$('.wrap_detail').html('');
					$('.transaction_id').html(data.data.transaction_id);

					var total = 0;
					
					$.each(data.data.items, function(index, val) {
						total = total + val.price;
						 GenerateItemList(val);
					});

					$('.total').html(total);

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

function GenerateItemList(val){
	var html = '';

	html += '<div class="details">'+
	'                <p>เขต '+val.receiver_desc.area+' '+val.receiver_desc.postal+'</p>'+
	'                <p>เลขพัสดุ '+val.tracking_code+'</p>'+
	'                <table width="100%">'+
	'                    <tr>'+
	'                        <td width="50%">- น้ำหนัก</td>'+
	'                        <td width="40%" align="right">'+val.weight+'</td>'+
	'                        <td width="10%" align="center">กรัม</td>'+
	'                    </tr>'+
	'                    <tr>'+
	'                        <td width="50%">- ค่าธรรมเนียม</td>'+
	'                        <td width="40%" align="right">0</td>'+
	'                        <td width="10%"></td>'+
	'                    </tr>'+
	'                    <tr>'+
	'                        <td width="50%">- ค่าบริการ</td>'+
	'                        <td width="40%" align="right" style="border-bottom: 1px solid #000000;">'+val.price+'</td>'+
	'                        <td width="10%"></td>'+
	'                    </tr>'+
	'                    <tr>'+
	'                        <td width="50%">รวมเป็นเงิน</td>'+
	'                        <td width="40%" align="right" style="border-bottom: 1px solid #000000;">'+val.price+'</td>'+
	'                        <td width="10%"></td>'+
	'                    </tr>'+
	'                </table>'+
	'                <p>ผู้รับ : '+val.receiver_desc.firstname+'</p>'+
	'                <hr>'+
	'            </div>';
	
	$('.wrap_detail').append(html);
}