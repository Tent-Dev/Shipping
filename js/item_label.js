$(document).ready(function() {
	getData();
});

function getData(){
	if(TRACKING_CODE || TRANSACTION_ID){
		console.log('[TRACKING_CODE | TRANS_ID]: ',TRACKING_CODE, TRANSACTION_ID);
		console.log('MODE: ',MODE);
		var ajax_data = {};
		var url = '';
		if(MODE && MODE == 'all' && TRANSACTION_ID && TRANSACTION_ID !== ''){
			ajax_data.command = 'get_transactionHistory';
			ajax_data.transaction_id = TRANSACTION_ID;
			ajax_data.mode = 'all';
			url = '../api/function/manage_transaction.php';
		}
		else{
			ajax_data.command = 'get_product';
			ajax_data.tracking_code = TRACKING_CODE;
			url = '../api/function/manage_product.php';

		}

		// ajax_data.command = 'get_product';
		// ajax_data.tracking_code = TRACKING_CODE;

		$.ajax({
			url: url,
			method: 'post',
			data: ajax_data,
			success: function(data) {
				var data = JSON.parse(data);
				console.log("result: ",data);
				if(data.status == 200){

					$.each(data.data.data, function(index, val) {
						/* iterate through array or object */
						var html = generateLabel(val);

						$('.boxs').append(html);
						// var r_postal_html = '';
						// $('.r_name').html(val.receiver_desc.firstname +' '+val.receiver_desc.lastname );
						// $('.r_address').html(val.receiver_desc.address);
						// $('.r_area').html(val.receiver_desc.area);
						// $('.r_district').html(val.receiver_desc.district);
						// $('.r_province').html(val.receiver_desc.province);
						// $('.r_phone').html(val.receiver_desc.phone_number);

						// $('.s_name').html(val.sender_desc.firstname +' '+val.sender_desc.lastname );
						// $('.s_address').html(val.sender_desc.address);
						// $('.s_area').html(val.sender_desc.area);
						// $('.s_district').html(val.sender_desc.district);
						// $('.s_province').html(val.sender_desc.province);

						// for (var i = 0; i < val.sender_desc.postal.length; i++) {
						// 	r_postal_html += '<span class="postcode_arr">'+val.sender_desc.postal[i]+'</span>';
						// }

						// $('.postcode').html(r_postal_html);


						// $('.barcode').attr('jsbarcode-value',val.tracking_code);
						JsBarcode(".barcode").init();
					});

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

function generateLabel(val){
	var date = val.create_date.split(" ");
	var html = '';
	html += '<div class="box">'+
				'<div class="address1">'+
					'<b>ชื่อที่อยู่ผู้ส่ง</b>'+
					'<p class="s_name">'+val.sender_desc.firstname +' '+val.sender_desc.lastname+'</p>'+
					'<p class="s_address">'+val.sender_desc.address+' </p><p>เขต <span class="s_area">'+val.sender_desc.area+'</span> แขวง <span class="s_district">'+val.sender_desc.district+'</span> <span class="s_province">'+val.sender_desc.province+'</span></p>'+
				'</div>'+
				'<div class="address-right">'+
					'<img src="https://fph.tu.ac.th/uploads/fph/DownloadLogo/2018_FPHHorz%20Logo%20%28EN%29.png" alt="logo" class="logo">'+
					'<svg class="barcode" jsbarcode-value="'+val.tracking_code+'" jsbarcode-margin="0" jsbarcode-fontsize="40" jsbarcode-fontoptions="bold"></svg>'+
				'</div>'+
				'<div class="address2">'+
					'<b>ชื่อที่อยู่ผู้รับ</b>'+
					'<p class="r_name">'+val.receiver_desc.firstname +' '+val.receiver_desc.lastname+'</p>'+
					'<p class="r_address">'+val.receiver_desc.address+' </p><p>เขต <span class="r_area">'+val.receiver_desc.area+'</span> แขวง <span class="r_district">'+val.receiver_desc.district+'</span> <span class="r_province">'+val.receiver_desc.province+'</span></p>'+
					'<p>โทร. <span class="r_phone">'+val.receiver_desc.phone_number+'</span></p>'+
					'<div class="postcode">';
						for (var i = 0; i < val.sender_desc.postal.length; i++) {
							html += '<span class="postcode_arr">'+val.sender_desc.postal[i]+'</span>';
						}
					html +='</div>'+
				'</div>'+
				'<div class="date">'+date[0]+'</div>'+
			'</div>';
	return html;
}