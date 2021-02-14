var timerInterval;
var html5QrcodeScanner;
var scanner_open = false;
var scan_timeout = 0;

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

	$(document).on('change', 'select#filter_status', function() {
		var value = $(this).children('option:selected').val();
		if(scanner_open){
			stopScanner();
		}
		if(value !== "") {
			startScanner();
		} else {
		}
	});
});

function startScanner() {
	var status = $('#filter_status option:selected').val();
	html5QrcodeScanner = new Html5Qrcode("reader");
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
							// Swal.fire({
							// 	title: 'สแกนสำเร็จ',
							// 	text: 'อัพเดทพัสดุเรียบร้อย',
							// 	icon: 'success',
							// 	confirmButtonText: 'ตกลง'
							// });

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