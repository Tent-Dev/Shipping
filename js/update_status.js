$(document).ready(function() {
	getDataFromDB();
	//getShipperList();

	$(document).on('click', '.btn_edit', function(event) {
		var product_id = $(this).data('id');
		var tracking_code = $(this).data('trackingcode');
		getDescription(product_id, tracking_code);
	});

	$(document).on('click', '.btn_save', function(event) {
		var product_id = $(this).data('id');
		saveData(product_id);
	});

	$(document).on('change', 'select#status', function() {
		var value = $(this).children('option:selected').val();
		if(value == "success") {
			$('.signature').show();
			$('.signature').addClass('success');
			$('.btn_save').attr('disabled', true);

			$(document).on('jq.signature.changed', '.js-signature', function(event) {
				$('.btn_save').attr('disabled', false);
			});

		} else {
			$('.signature').hide();
			$('.signature.success').removeClass('success');
			$('.js-signature').jqSignature('clearCanvas');
			$('.btn_save').attr('disabled', false);
		}
	});

});

function getDataFromDB(page = 1){
	$.ajax({
		url: '../api/function/manage_product.php',
		method: 'post',
		data: {
			command: 'get_product',
			page: page
		},
		success: function(data) {
			var data = JSON.parse(data)
			console.log("result: ",data);

			if(data.status == 200){
				var html = "";
				$.each(data.data.data, function(index, val) {
					html +=
					'<tr class="_rowid-'+val.id+'">'+
					'<td>'+val.create_date+'</td>'+
					'<td>'+val.tracking_code+'</td>'+
					'<td>'+val.receiver_desc.firstname+'</td>'+
					'<td class="_td-status">'+val.status+'</td>'+
					'<td>'+val.shipper_name+'</td>'+
					'<td align="center">'+
					'<button class="btn_edit btn btn-sm btn-warning mr-2" data-toggle="modal" data-id="'+val.id+'" data-trackingcode="'+val.tracking_code+'" data-target="#editData"><i class="fas fa-edit"></i></button>'+
					'</td>'+
					'</tr>';
				});
				pagination(page,data.data.total_pages);
			}

			$('#show_data_from_db').append(html);
		},
		error: function() {
			console.log("error");
		}
	});
};

function getDescription(product_id, tracking_code){
	html_mock = '';

	html_mock += '<div class="modal-content">';
	html_mock += '	<div class="modal-header">';
	html_mock += '		<h5 class="modal-title" id="editDataLabel">อัพเดทสถานะพัสดุ '+tracking_code+'</h5>';
	html_mock += '		<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
	html_mock += '			<span aria-hidden="true"><i class="fas fa-times"></i></span>';
	html_mock += '		</button>';
	html_mock += '	</div>';
	html_mock += '	<div class="modal-body">';
	html_mock += '	</div>';
	html_mock += '	<div class="modal-footer">';
	html_mock += '		<button type="button" class="btn btn-secondary btn_cancel" data-dismiss="modal">ยกเลิก</button>';
	html_mock += '		<button type="button" class="btn btn-success btn_save" data-id="'+product_id+'">บันทึก</button>';
	html_mock += '	</div>';
	html_mock += '</div">';

	$('.modal-dialog').html(html_mock);
	$('.modal-body').html('<div align="center" class="wrap_loading_box"><div><i class="fas fa-spinner fa-spin loading_box_icon"></i></span></div></div>');

	$.ajax({
		url: '../api/function/manage_product.php',
		method: 'post',
		data: {
			command: 'get_product_desc',
			product_id: product_id
		},
		success: function(data) {
			var data = JSON.parse(data)
			console.log("result: ",data);

			if(data.status == 200){
				var get_body_html = generateHtml(data);
				$('.modal-body').html(get_body_html);
				$("#shipping_type").val(data.data.payment_type).change();
				$('.js-signature').jqSignature({
					autoFit: true,
					border: '0px solid red',
					height: 115,
					background: 'rgb(255,255,255,0)',
					lineColor: '#800000',
					lineWidth: 2
				});
				$('.signature').hide();
				if(data.data.shipper_id !== 0 && data.data.shipper_id !== null && data.data.shipper_id !== '0'){
					console.log(data.data.shipper_id);
					$("#sender").val(data.data.shipper_id).change();
				}
			}

		},
		error: function() {
			console.log("error");
		}
	});
}

function generateHtml(data){
	var html = '';
	
	html += '<form action="" method="post">';
	html += '                            <div class="row">';
	html += '                                <div class="col">';
	html += '                                    <label for="status" class="col-form-label col-form-label-sm">สถานะพัสดุ</label>';
	html += '                                    <select name="status" id="status" class="form-control form-control-sm">';
	html += '                                        <option value="waiting">พัสดุถูกนำเข้าสู่ระบบ</option>';
	html += '                                        <option value="sending">พัสดุกำลังถูกนำส่งไปยังผู้รับ</option>';
	html += '                                        <option value="success">พัสดุถูกนำส่งถึงมือผู้รับเรียบร้อยแล้ว</option>';
	html += '                                        <option value="return_distribution_center">พัสดุถูกตีกลับสู่ศูนย์กระจายสินค้า</option>';
	html += '                                    </select>';
	html += '                                </div>';
	html += '                            </div>';
	html += '                            <div class="row">';
	html += '                                <div class="col-sm-6">';
	html += '                                    <label for="phone_number" class="col-form-label col-form-label-sm">เบอร์โทรผู้รับ</label>';
	html += '                                    <div>'+data.data.receiver_desc.phone_number+'</div>';
	html += '                                </div>';
	html += '                                <div class="col-sm-6">';
	html += '                                    <label for="shipper" class="col-form-label col-form-label-sm">คนนำจ่าย</label>';
	html += '                                    <div>'+data.data.shipper_name+'</div>';
	html += '                                </div>';
	html += '                            </div>';
	html += '                            <div class="row">';
	html += '                                <div class="col-sm-6">';
	html += '                                    <label for="r_fname" class="col-form-label col-form-label-sm">ชื่อผู้รับ</label>';
	html += '                                    <div>'+data.data.receiver_desc.firstname+'</div>';
	html += '                                </div>';
	html += '                                <div class="col-sm-6">';
	html += '                                    <label for="r_lname" class="col-form-label col-form-label-sm">นามสกุลผู้รับ</label>';
	html += '                                    <div>'+data.data.receiver_desc.lastname+'</div>';
	html += '                                </div>';
	html += '                            </div>';
	html += '                            <div class="row">';
	html += '                                <div class="col signature">';
	html += '                                    <label for="signature" class="col-form-label col-form-label-sm">ลายเซ็น</label>';
	html += '                                    <button type="button" class="clear-sign" onclick="clearCanvas()">(ล้าง)</button>';
	html += '                                    <div class="signature-box js-signature"></div>';
	html += '                                </div>';
	html += '                            </div>';
	html += '                            <div class="row">';
	html += '                                <div class="col note">';
	html += '                                    <label for="note" class="col-form-label col-form-label-sm">หมายเหตุ</label>';
	html += '                                    <div class="note_wrap">';
	html += '								 	 	<textarea class="form-control form-control-sm" id="note"></textarea>';
	html += '                                    </div>';
	html += '                                </div>';
	html += '                            </div>';
	html += '                        </form>';
	
	return html;
}


async function saveData(product_id){
	var status = $('#status').val();
	var note = $('#note').val();
	var image_signature = '';
	var data_ajax = new FormData();

	data_ajax.append('command', 'create_transport');
	data_ajax.append('product_id', product_id);
	data_ajax.append('status', status);
	data_ajax.append('note', note);

	if(status == 'success'){
		image_signature = $('.js-signature').jqSignature('getDataURL');
		data_ajax.append('image_signature', image_signature);
	}

	if(validate()){
		$('.btn_save').html('<i class="fas fa-spinner fa-spin"></i></span>');
		$('.btn_save, .btn_cancel').attr('disabled', true);
		$.ajax({
			url: '../api/function/manage_transport.php',
			method: 'post',
			contentType:false,
		    processData:false,
		    cache:false,
			data: data_ajax,
			success: function(data) {
				var data = JSON.parse(data)
				console.log("result: ",data);
				$('.btn_save').html('บันทึก');
				$('.btn_save, .btn_cancel').attr('disabled', false);
				if(data.status == 200){
					$('._rowid-'+product_id+'').find('._td-status').html(status);
					$("#editData").modal('hide');
				}else{
					Swal.fire({
						title: 'พบข้อผิดพลาด',
						text: 'ไม่สามารถอัพเดทข้อมูลได้',
						icon: 'error',
						confirmButtonText: 'ตกลง'
					});
				}
			},
			error: function() {
				console.log("error");
				$('.btn_save').html('บันทึก');
				$('.btn_save, .btn_cancel').attr('disabled', false);
				Swal.fire({
					title: 'พบข้อผิดพลาด',
					text: 'ไม่สามารถอัพเดทข้อมูลได้',
					icon: 'error',
					confirmButtonText: 'ตกลง'
				});
			}
		});
	}
}

function validate(){
	var result = true;
	// var shipper_id = $('#sender').val();

	// if(shipper_id == ''){
	// 	result = false;

	// 	if(shipper_id == ''){
	// 		$('#sender').addClass('custom_has_err');
	// 	}else{
	// 		$('#sender').removeClass('custom_has_err');
	// 	}
	// }
	// else{
	// 	$('#sender').removeClass('custom_has_err');
	// }

	return result;
}

function clearCanvas() {
	$('.js-signature').jqSignature('clearCanvas');
	$('.btn_save').attr('disabled', true);
}