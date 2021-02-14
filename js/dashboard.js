var startdate = '', enddate = '';
$(document).ready(function() {
	enddate = moment().format('YYYY-MM-DD');
	startdate = moment().format('YYYY-MM-DD');
	getAllData();
	//$('.detail').html('<i class="fas fa-spinner fa-spin loading_box_icon"></i></span>');
	$('input#filter_date').daterangepicker({
		autoUpdateInput: false,
		locale: {
			format: "YYYY-MM-DD",
			cancelLabel: 'Clear'
		}
	});

	$(document).on('change', 'select#filter_date_absoulte', function() {
		var value = $(this).children('option:selected').val();
		if(value == "custom_date") {
			$('.datepicker').show();

		} else if(value == "all"){
			$('.datepicker').hide();
			$('#filter_date').val('');
			startdate = "";
			enddate = "";
			getAllData();
		} else if(value == "last_7"){
			enddate = moment().format('YYYY-MM-DD');
			startdate = moment().subtract(7,'d').format('YYYY-MM-DD');
			getAllData();

		} else if(value == "last_30"){
			enddate = moment().format('YYYY-MM-DD');
			startdate = moment().subtract(30,'d').format('YYYY-MM-DD');
			getAllData();
		} else if(value == "all"){
			enddate = '';
			startdate = '';
			getAllData();
		} else if(value == "today"){
			enddate = moment().format('YYYY-MM-DD');
			startdate = moment().format('YYYY-MM-DD');
			getAllData();
		}
		else {
			$('.datepicker').hide();
			$('#filter_date').val('');
			getAllData();
		}
	});

	$('input#filter_date').on('apply.daterangepicker', function(ev, picker) {
		startdate = picker.startDate.format('YYYY-MM-DD');
		enddate = picker.endDate.format('YYYY-MM-DD');
		$(this).val(startdate + ' - ' + enddate);
		var status = $('#filter_status option:selected').val();
		getAllData();
	});

	$('#filter_date').on('cancel.daterangepicker', function(ev, picker) {
		$('#filter_date').val('');
		startdate = "";
		enddate = "";
		getAllData();
	});

	$('.btn_export').click(function(event) {
		ExportSummary();
	});
});

function getAllData(){
	$('.detail').html('<i class="fas fa-spinner fa-spin loading_box_icon"></i></span>');
	getProduct();
	getTransaction();
}


function getProduct(page = 1, mode = ''){

	if(mode !== 'delete'){
		$('.table_wrap_loading_box').show();
		$('.table').html('');
	}
	$.ajax({
		url: '../api/function/manage_product.php',
		method: 'post',
		data: {
			command: 'get_product_dashboard',
			page: page,
			startdate: startdate,
			enddate: enddate,
			ignore_pagination: true
		},
		success: function(data) {
			var data = JSON.parse(data);
			console.log("result: ",data);
			
			if(data.status == 200){
				if(data.data.data.length > 0){
					var items_waiting = 0;
					var items_sending = 0;
					var items_cod_price = 0;
					$('.summary_items_in_system').html('<span class="">'+data.data.data.length+'</span> ชิ้น');

					$.each(data.data.data, function(index, val) {
						if (val.status == 'waiting'){
							items_waiting++;
						}
						if (val.status == 'sending'){
							items_sending++;
						}
						if(val.cod_price >0){
							items_cod_price = items_cod_price+parseFloat(val.cod_price);
						}
					});
					$('.summary_items_in_system').html('<span class="">'+data.data.data.length+'</span> ชิ้น');
					$('.summary_items_waiting').html('<span class="">'+NumberFormat(items_waiting.toString(),0)+'</span> ชิ้น');
					$('.summary_items_sending').html('<span class="">'+NumberFormat(items_sending.toString(),0)+'</span> ชิ้น');
					$('.summary_items_cod_price').html('<span class="">'+NumberFormat(items_cod_price)+'</span> ฿');
				}else{
					$('.summary_items_in_system').html('<span class="">0</span> ชิ้น');
					$('.summary_items_sending').html('<span class="">0</span> ชิ้น');
					$('.summary_items_waiting').html('<span class="">0</span> ชิ้น');
					$('.summary_items_cod_price').html('<span class="">0</span> ฿');
				}
			}
			else if(data.status == 404){
				$('.summary_items_in_system').html('<span class="">0</span> ชิ้น');
				$('.summary_items_sending').html('<span class="">0</span> ชิ้น');
				$('.summary_items_waiting').html('<span class="">0</span> ชิ้น');
				$('.summary_items_cod_price').html('<span class="">0</span> ฿');
			}
			else{
				$('.summary_items_in_system, .summary_items_sending, .summary_items_waiting, .summary_items_cod_price').html('<span class="">เกิดข้อผิดพลาด</span>');
			}

		},
		error: function() {
			console.log("error");
			$('.summary_items_in_system').html('<span class="">เกิดข้อผิดพลาด</span>');
		}
	});
};

function getTransaction(page = 1, mode = ''){

	if(mode !== 'delete'){
		$('.table_wrap_loading_box').show();
		$('.table').html('');
	}
	$.ajax({
		url: '../api/function/manage_transaction.php',
		method: 'post',
		data: {
			command: 'get_transaction_dashboard',
			startdate: startdate,
			enddate: enddate,
		},
		success: function(data) {
			var data = JSON.parse(data)
			console.log("result: ",data);
			
			if(data.status == 200){
				if(data.data.data.length > 0){
					var total_income = 0;
					$.each(data.data.data, function(index, val) {
						if (val.price > 0){
							total_income = total_income+parseFloat(val.price);
						}
					});
					$('.summary_total_transaction').html('<span class="">'+NumberFormat(data.data.data.length.toString(), 0)+'</span> รายการ');
					$('.summary_total_price').html('<span class="">'+NumberFormat(total_income)+'</span> ฿');
				}else{
					$('.summary_total_transaction').html('<span class="">0</span> รายการ');
					$('.summary_total_price').html('<span class="">0</span> ฿');
				}
			}
			else if(data.status == 404){
				$('.summary_total_transaction').html('<span class="">0</span> รายการ');
				$('.summary_total_price').html('<span class="">0</span> ฿');
			}
			else{
				$('.summary_total_transaction, .summary_total_price').html('<span class="">เกิดข้อผิดพลาด</span>');
			}

		},
		error: function() {
			console.log("error");
			$('.summary_total_transaction, .summary_total_price').html('<span class="">เกิดข้อผิดพลาด</span>');
		}
	});
};

function ExportSummary(){
	$('.btn_export').attr('disabled', true);
	$('.btn_export').html('<i class="fas fa-spinner fa-spin"></i> ส่งออกข้อมูล');
	$.ajax({
		url: '../api/function/manage_export.php',
		method: 'post',
		data: {
			command: 'export_summary',
			startdate: startdate,
			enddate: enddate,
		},
		success: function(data) {
			$('.btn_export').attr('disabled', false);
			$('.btn_export').html('<i class="fas fa-file-export"></i> ส่งออกข้อมูล');
			var data = JSON.parse(data);
			console.log(data);
			if(data.status == 200){
				Swal.fire({
					title: 'ส่งออกข้อมูลสำเร็จ',
					text: 'ดาวน์โหลดข้อมูลของคุณด้านล่าง',
					icon: 'info',
					confirmButtonText: 'ดาวน์โหลด'
				}).then((result) =>{
					if (result.isConfirmed) {
						window.location.assign(data.url);
						Swal.fire('ดาวน์โหลดสำเร็จ', '', 'success');
					}
				});
			} else if(data.status == 404){
				Swal.fire({
					title: 'ไม่พบข้อมูล',
					text: 'ไม่พบข้อมูลตามช่วงเวลาที่เลือก',
					icon: 'warning',
					confirmButtonText: 'ตกลง'
				});
			}
			
		},
		error: function() {
			$('.btn_export').attr('disabled', false);
			$('.btn_export').html('<i class="fas fa-file-export"></i> ส่งออกข้อมูล');
			console.log("error");
			Swal.fire({
				title: 'พบข้อผิดพลาด',
				text: 'ไม่สามารถส่งออกข้อมูลได้',
				icon: 'error',
				confirmButtonText: 'ตกลง'
			});
		}
	});
}