$(document).ready(function() {
	getData();
});

function getData(){
	if(TRANSACTION_ID){
		console.log('TRANSACTION_ID: ',TRANSACTION_ID);
		console.log('MODE: ',MODE);
		var ajax_data = {};
		if(MODE && MODE == 'id'){
			ajax_data.command = 'get_transactionById';
			ajax_data.id = TRANSACTION_ID;
		}
		else if(MODE && MODE == 'trans_id'){
			ajax_data.command = 'get_transactionDesc';
			ajax_data.transaction_id = TRANSACTION_ID;
		}

		$.ajax({
			url: '../api/function/manage_transaction.php',
			method: 'post',
			data: ajax_data,
			success: function(data) {
				var data = JSON.parse(data);
				console.log("result: ",data);
				if(data.status == 200){
					$('.wrap_detail').html('');
					$('.transaction_id').html(data.data.transaction_id);
					$('.create_date').html(data.data.transaction_create_date);
					$('.employee_name').html(data.data.employee_fname+' (EMID: '+data.data.employee_id+')');
					$('.get_price').html(data.data.get_price);
					$('.change_price').html(data.data.change_price);

					// var total = 0;
					
					// $.each(data.data.data, function(index, val) {
					// 	total = total + val.price;
					// 	GenerateItemList(val);
					// });

					$('.total').html(data.data.total_price);

					window.print();

				}else{
					Swal.fire({
						title: 'พบข้อผิดพลาด',
						text: 'ไม่สามารถดึงข้อมูลได้',
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
		Swal.fire({
			title: 'พบข้อผิดพลาด',
			text: 'ไม่สามารถดึงข้อมูลได้',
			icon: 'error',
			confirmButtonText: 'ตกลง'
		});
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