$(document).ready(function() {
	$('#check_tracking').click(function(event) {
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
							html +='	<div>เนื่องจาก: '+val.note+'</div>';
						}
						html +='	<div class="time_stamp">เมื่อ: '+val.timestamp+'</div>';
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
				}
			},
			error: function() {
				console.log("error");
			}
		});
	});
});