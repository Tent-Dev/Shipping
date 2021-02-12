let timerInterval;
$(document).ready(function() {
	let html5QrcodeScanner = new Html5QrcodeScanner(
		"reader", { fps: 10, qrbox: 250 }, /* verbose= */ true);
	html5QrcodeScanner.render(onScanSuccess, onScanFailure);
});

function onScanSuccess(qrMessage) {
	// handle the scanned code as you like
	console.log(`QR matched = ${qrMessage}`);

	Swal.fire({
		title: 'สแกนสำเร็จ',
		html: 'หมายเลขพัสดุ '+ qrMessage,
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
}

function onScanFailure(error) {
	// handle scan failure, usually better to ignore and keep scanning
	console.warn(`QR error = ${error}`);
	Swal.fire({
		title: 'พบข้อผิดพลาด',
		text: 'ไม่สามารถสแกนได้',
		icon: 'error',
		confirmButtonText: 'ตกลง'
	});
}