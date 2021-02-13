let timerInterval;
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
		if(value !== "") {
			startScanner();
		} else {
		}
	});
});

function startScanner() {
	let html5QrcodeScanner = new Html5QrcodeScanner(
		"reader", { fps: 2, qrbox: 250 }, /* verbose= */ true);
	html5QrcodeScanner.render(onScanSuccess, onScanFailure);
}

function onScanSuccess(qrMessage) {
	// handle the scanned code as you like
	saveData(qrMessage);
}

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

					console.log(`QR matched = ${product_id}`);

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
							}, 100)
						},
						willClose: () => {
							clearInterval(timerInterval)
						}
					}).then((result) => {
						/* Read more about handling dismissals below */
						if (result.dismiss === Swal.DismissReason.timer) {
							console.log('I was closed by the timer')
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
	//}
}