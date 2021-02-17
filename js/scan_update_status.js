var timerInterval;
var html5QrcodeScanner;
var scanner_open = false;
var scan_timeout = 0;
var statusUpdate = '';
var OLD_PRODUCT = '';
var OLD_STATUS = '';
var DISABLE_OTHERPOPUP = false;
$(document).ready(function() {
	header = '';
	header +='<div class="table_wrap_empty">';
	header +='  <div class="text-center">';
	header +='      <div>โปรดเลือกสถานะที่จะอัพเดท</div>';
	header +='      <div><i class="fas fa-exclamation-triangle"></i></div>';
	header +='  </div>';
	header +='</div>';

	$('#reader').html(header);
	// let html5QrcodeScanner = new Html5QrcodeScanner(
	// 	"reader", { fps: 2, qrbox: 250 }, /* verbose= */ true);
	// html5QrcodeScanner.render(onScanSuccess, onScanFailure);
	$(document).on('click', '.btn_save', function(event) {
		var product_id = $(this).data('id');
		saveDataSuccess(product_id);
	});

	$(document).on('jq.signature.changed', '.js-signature', function(event) {
		$('.btn_save').attr('disabled', false);
	});

	$(document).on('change', 'select#filter_status', function() {
		var value = $(this).children('option:selected').val();
		statusUpdate = value;
		if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)){
			if(scanner_open){
				stopScanner();
			}
			if(value !== "") {
				startScanner();
			} else {
			}
		}else{
			web_header = '';
			web_header +='<div class="table_wrap_empty">';
			web_header +='  <div class="text-center">';
			web_header +='      <div>ระบบสแกนQR CODE รองรับบนมือถือเท่านั้น</div>';
			web_header +='      <div><i class="fas fa-exclamation-triangle"></i></div>';
			web_header +='  </div>';
			web_header +='</div>';
			getDescription(7);
			$('#reader').html(web_header);
		}
	});
});

function startScanner() {
	var status = $('#filter_status option:selected').val();
	try{
		html5QrcodeScanner = new Html5Qrcode("reader");
	}catch(e){
		console.log('xxxxx');
	}
	
	const qrCodeSuccessCallback = message => { 
		var get_message = message;

		scan_timeout = setTimeout(function() {
			saveData(get_message);
		}, 100);
		html5QrcodeScanner.clear();

	}
	const config = { fps: 2, qrbox: 250 };

	try{
		html5QrcodeScanner.start({ facingMode: "environment" }, config, qrCodeSuccessCallback);
	}catch(e){
		console.log('Cannot open');
	}
	
	// html5QrcodeScanner = new Html5QrcodeScanner(
	// 	"reader", { fps: 2, qrbox: 250 }, /* verbose= */ true);
	// html5QrcodeScanner.render(onScanSuccess, onScanFailure);		
	scanner_open = true;
}

function stopScanner() {
	html5QrcodeScanner.stop().then(ignore => {
	  // QR Code scanning is stopped.
	}).catch(err => {
	  // Stop failed, handle it.
	});
	scanner_open = false;
}

// function onScanSuccess(qrMessage) {
// 	// handle the scanned code as you like
// 	scan_timeout = setTimeout(function() {
// 		saveData(qrMessage);
// 	}, 1000);
// }

function onScanFailure(error) {
	// handle scan failure, usually better to ignore and keep scanning
	console.warn(`QR error = ${error}`);
	// Swal.fire({
	// 	title: 'พบข้อผิดพลาด',
	// 	text: 'ไม่สามารถสแกนได้',
	// 	icon: 'error',
	// 	confirmButtonText: 'ตกลง'
	// });
}

async function saveData(product_id){

	var status = $('#filter_status option:selected').val();
	//var note = $('#note').val();
	var image_signature = '';
	var data_ajax = new FormData();

	data_ajax.append('command', 'create_transport');
	data_ajax.append('product_id', product_id);
	data_ajax.append('status', status);
	if(SHIPPER_ID !== ''){
		data_ajax.append('shipper_id', SHIPPER_ID);
	}
	//data_ajax.append('note', note);

	// if(status == 'success'){
	// 	image_signature = $('.js-signature').jqSignature('getDataURL');
	// 	data_ajax.append('image_signature', image_signature);
	// }

	//if(validate()){
		if(OLD_PRODUCT == product_id && OLD_STATUS == status){
			if(!DISABLE_OTHERPOPUP){
				Swal.fire({
					title: 'พบข้อผิดพลาด',
					text: 'พัสดุนี้ถูกสแกนไปก่อนหน้านี้แล้ว',
					icon: 'error',
					confirmButtonText: 'ตกลง'
				});
			}
			html5QrcodeScanner.clear();
		}else{
			OLD_PRODUCT = product_id;
			OLD_STATUS = status;
			if(!isNaN(product_id)){

				if(statusUpdate !== 'success'){
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

							if(data.status == 200){
								DISABLE_OTHERPOPUP = true;
								Swal.fire({
									title: 'สแกนสำเร็จ',
									html: 'หมายเลขพัสดุ '+ product_id,
									timer: 1500,
									icon: 'success',
									timerProgressBar: true,
									didOpen: () => {
										Swal.showLoading()
										timerInterval = setInterval(() => {
											const content = Swal.getContent()
											if (content) {
												const b = content.querySelector('b')
												if (b) {
													b.textContent = Swal.getTimerLeft()
												}
											}
										}, 300)
									},
									willClose: () => {
										clearInterval(timerInterval);
									//clearTimeout(scan_timeout);
								}
							}).then((result) => {
								/* Read more about handling dismissals below */
								if (result.dismiss === Swal.DismissReason.timer) {
									console.log('I was closed by the timer')
									DISABLE_OTHERPOPUP = false;
								}
							})
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
						Swal.fire({
							title: 'พบข้อผิดพลาด',
							text: 'ไม่สามารถอัพเดทข้อมูลได้',
							icon: 'error',
							confirmButtonText: 'ตกลง'
						});
					}
				});
				}else{
					getDescription(product_id);
				}
			}else{
				Swal.fire({
					title: 'พบข้อผิดพลาด',
					text: 'สแกนข้อมูลไม่ถูกต้อง',
					icon: 'error',
					confirmButtonText: 'ตกลง'
				});
				html5QrcodeScanner.clear();
			}
		}
	//}
}

function getDescription(product_id){
	$('.modal').modal('show');
	html_mock = '';

	html_mock += '<div class="modal-content">';
	html_mock += '	<div class="modal-header">';
	html_mock += '		<h5 class="modal-title" id="editDataLabel">อัพเดทสถานะพัสดุ <span class="tracking_code_update"></span></h5>';
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
	$('.btn_save').attr('disabled', true);
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
				DISABLE_OTHERPOPUP = true;
				var get_body_html = generateHtml(data);
				$('.modal-body').html(get_body_html);
				$('.tracking_code_update').html(data.data.tracking_code);
				$("#shipping_type").val(data.data.payment_type).change();
				
				if(data.data.shipper_id !== 0 && data.data.shipper_id !== null && data.data.shipper_id !== '0'){
					console.log(data.data.shipper_id);
					$("#sender").val(data.data.shipper_id).change();
				}
				$('.js-signature').jqSignature({
					autoFit: true,
					border: '0px solid red',
					height: 115,
					width: 100,
					background: 'rgb(255,255,255,0)',
					lineColor: '#800000',
					lineWidth: 2
				});
				//$('.signature').hide();
				$('.signature').show();
				$('.signature').addClass('success');
			}else{
				Swal.fire({
					title: 'พบข้อผิดพลาด',
					text: 'ไม่พบข้อมูลพัสดุนี้',
					icon: 'error',
					confirmButtonText: 'ตกลง'
				});
			}
			
		},
		error: function() {
			console.log("error");
		}
	});
}

function generateHtml(data){
	var html = '';
	var payment_type = '';
	if(data.data.payment_type == 'normal'){
		payment_type = 'ชำระเงินแล้ว';
	} else if(data.data.payment_type == 'cod'){
		payment_type = 'เก็บเงินปลายทาง';
	}
	html += '<form action="" method="post">';
	html += '                            <div class="row">';
	html += '                                <div class="col">';
	html += '                                    <label for="status" class="col-form-label col-form-label-sm">สถานะพัสดุ</label>';
	html += '                                    <select name="status" id="status" class="form-control form-control-sm">';
	// html += '                                        <option value="waiting">พัสดุถูกนำเข้าสู่ระบบ</option>';
	// html += '                                        <option value="sending">พัสดุกำลังถูกนำส่งไปยังผู้รับ</option>';
	html += '                                        <option value="success">พัสดุถูกนำส่งถึงมือผู้รับเรียบร้อยแล้ว</option>';
	// html += '                                        <option value="return_distribution_center">พัสดุถูกตีกลับสู่ศูนย์กระจายสินค้า</option>';
	html += '                                    </select>';
	html += '                                </div>';
	html += '                            </div>';
	html += '                            <div class="row">';
	html += '                                <div class="col-sm-6">';
	html += '                                    <label for="phone_number" class="col-form-label col-form-label-sm"><b>เบอร์โทรผู้รับ</b></label>';
	html += '                                    <div>'+data.data.receiver_desc.phone_number+'</div>';
	html += '                                </div>';
	html += '                                <div class="col-sm-6">';
	html += '                                    <label for="shipper" class="col-form-label col-form-label-sm"><b>คนนำจ่าย</b></label>';
	html += '                                    <div>'+data.data.shipper_name+'</div>';
	html += '                                </div>';
	html += '                            </div>';
	html += '                            <div class="row">';
	html += '                                <div class="col-sm-6">';
	html += '                                    <label for="r_fname" class="col-form-label col-form-label-sm"><b>ชื่อผู้รับ</b></label>';
	html += '                                    <div>'+data.data.receiver_desc.firstname+'</div>';
	html += '                                </div>';
	html += '                                <div class="col-sm-6">';
	html += '                                    <label for="r_lname" class="col-form-label col-form-label-sm"><b>นามสกุลผู้รับ</b></label>';
	html += '                                    <div>'+data.data.receiver_desc.lastname+'</div>';
	html += '                                </div>';
	html += '                            </div>';
	html += '                            <div class="row">';
	html += '                                <div class="col-sm-6">';
	html += '                                    <label for="payment_type" class="col-form-label col-form-label-sm"><b>ประเภทการชำระเงิน</b></label>';
	html += '                                    <div>'+payment_type+'</div>';
	html += '                                </div>';
	if(data.data.payment_type == 'cod'){
		html += '                                <div class="col-sm-6">';
		html += '                                    <label for="payment_type" class="col-form-label col-form-label-sm"><b>จำนวนเงินที่ต้องชำระ</b></label>';
		html += '                                    <div>'+NumberFormat(data.data.cod_price)+' บาท</div>';
		html += '                                </div>';
	}
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

async function saveDataSuccess(product_id){
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

					if(status == 'success'){
						$('._rowid-'+product_id+'').find('.btn_tools').html('');
					}
					$("#editData").modal('hide');
					DISABLE_OTHERPOPUP = false;
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