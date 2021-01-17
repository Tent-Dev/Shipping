$(document).ready(function() {
	getData();
});

function getData(){
	if(TRACKING_CODE){
		console.log('TRACKING_CODE: ',TRACKING_CODE);
		//console.log('MODE: ',MODE);
		var ajax_data = {};
		// if(MODE && MODE == 'id'){
		// 	ajax_data.command = 'get_transactionById';
		// 	ajax_data.id = TRANSACTION_ID;
		// }
		// else if(MODE && MODE == 'trans_id'){
		// 	ajax_data.command = 'get_transactionDesc';
		// 	ajax_data.transaction_id = TRANSACTION_ID;
		// }

		ajax_data.command = 'get_product';
		ajax_data.tracking_code = TRACKING_CODE;

		$.ajax({
			url: '../api/function/manage_product.php',
			method: 'post',
			data: ajax_data,
			success: function(data) {
				var data = JSON.parse(data);
				console.log("result: ",data);
				if(data.status == 200){
					var r_postal_html = '';
					$('.r_name').html(data.data.data[0].receiver_desc.firstname +' '+data.data.data[0].receiver_desc.lastname );
					$('.r_address').html(data.data.data[0].receiver_desc.address);
					$('.r_area').html(data.data.data[0].receiver_desc.area);
					$('.r_district').html(data.data.data[0].receiver_desc.district);
					$('.r_province').html(data.data.data[0].receiver_desc.province);
					$('.r_phone').html(data.data.data[0].receiver_desc.phone_number);

					$('.s_name').html(data.data.data[0].sender_desc.firstname +' '+data.data.data[0].sender_desc.lastname );
					$('.s_address').html(data.data.data[0].sender_desc.address);
					$('.s_area').html(data.data.data[0].sender_desc.area);
					$('.s_district').html(data.data.data[0].sender_desc.district);
					$('.s_province').html(data.data.data[0].sender_desc.province);

					for (var i = 0; i < data.data.data[0].sender_desc.postal.length; i++) {
						r_postal_html += '<span class="postcode_arr">'+data.data.data[0].sender_desc.postal[i]+'</span>';
					}

					$('.postcode').html(r_postal_html);


					$('.barcode').attr('jsbarcode-value',data.data.data[0].tracking_code);
					JsBarcode(".barcode").init();
					// $('.s_phone').html(data.data.data[0].sender_desc.phone_number);

					// $('.wrap_detail').html('');
					// $('.transaction_id').html(data.data.transaction_id);

					// var total = 0;
					
					// $.each(data.data.data, function(index, val) {
					// 	total = total + val.price;
					// 	 GenerateItemList(val);
					// });

					// $('.total').html(total);

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
				Swal.fire({
					title: 'พบข้อผิดพลาด',
					text: 'ไม่สามารถดึงข้อมูลได้',
					icon: 'error',
					confirmButtonText: 'ตกลง'
				});
			}
		});

	}else{
		console.log('TRACKING_CODE : not found');
		Swal.fire({
			title: 'พบข้อผิดพลาด',
			text: 'ไม่สามารถดึงข้อมูลได้',
			icon: 'error',
			confirmButtonText: 'ตกลง'
		});
	}
}