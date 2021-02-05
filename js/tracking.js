$(document).ready(function() {
	$('#check_tracking').click(function(event) {
		$('#transport_history').html('<div class="wrap_loading_box"><div> <i class="fas fa-spinner fa-spin"></i></div></div>');
		var tracking_code = $('#tracking_code').val();
		$.ajax({
			url: '../api/function/manage_tracking.php',
			method: 'post',
			data: {
				command: 'tracking',
				tracking_code: tracking_code
			},
			success: function(data) {
				var data = JSON.parse(data)
				var html = '';
				var status_convert = '';
				var status_class = '';
				if(data.status == 200){
					console.log("result: ",data);
					$.each(data.data.transport_history, function(index, val) {
						if(index == data.data.transport_history.length-1 && val.status !== 'success'){
							status_class = 'current';
						}else{
							status_class = 'is-done';
						}

						if(val.status == 'waiting'){
							status_convert = 'พัสดุถูกนำเข้าสู่ระบบ';
						}
						else if(val.status == 'sending'){
							status_convert = 'พัสดุกำลังถูกนำส่งไปยังผู้รับ';
						}
						else if(val.status == 'success'){
							status_convert = 'พัสดุถูกนำส่งถึงมือผู้รับเรียบร้อยแล้ว';
						}
						else if(val.status == 'return_distribution_center'){
							status_convert = 'พัสดุถูกตีกลับสู่ศูนย์กระจายสินค้า';
						}

						html +='<li class="StepProgress-item '+status_class+'">';
						html +='	<strong>'+val.status+'</strong>';
						html +='	<div>'+status_convert+'</div>';
						if(val.note !== '' && val.note !== null){
							html +='	<div>หมายเหตุ: '+val.note+'</div>';
						}
						html +='	<div class="time_stamp">เมื่อ: '+val.timestamp+'</div>';
						if(val.status == 'success') {
							html += '<div class="sign_title">ดูลายเซ็น</div>';
							html += '<div class="signature"><img src="../assets/signature/'+val.signature+'"></div>';
						}
						html +='</li>';

						// html +='<div class="row warp_status" align="center">';
						// html +='	<div class="col-2">';
						// html +='		<li class="StepProgress-item is-done"></li>';
						// html +='	</div>';
						// html +='	<div class="col-10" align="left">';
						// html +='		<div><b>'+val.status+'</b></div>';
						// html +='		<div>'+status_convert+'</div>';
						// html +='		<div>เมื่อ: '+val.timestamp+'</div>';
						// html +='	</div>';
						// html +='</div>';

					});

					$('#transport_history').html(html);
				}else{
					console.log("result: ",data);
					showErrorAjaxPage('ไม่พบข้อมูล');
				}
			},
			error: function() {
				console.log("error");
				showErrorAjaxPage();
			}
		});
	});

	$('body').delegate('.sign_title', 'click', function() {
		$('.signature').toggleClass('open');
	});
});

function showErrorAjaxPage(text = ''){
	if(text == ''){
		text = 'ไม่สามารถเชื่อมต่อฐานข้อมูลได้';
	}
    var header = '';
    header +='<div class="wrap_empty">';
    header +='  <div class="text-center">';
    header +='      <div>'+text+'</div>';
    header +='      <div><i class="fas fa-times"></i></div>';
    header +='  </div>';
    header +='</div>';
    $('#transport_history').html(header);
}