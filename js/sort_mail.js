var SHIPPER_LIST = [];
var startdate = "", enddate = "", status = "", keyword = "", shipper = "";

$(document).ready(function() {
	getDataFromDB();
	getShipperList();

	$(document).on('click', '.btn_edit', function(event) {
		var product_id = $(this).data('id');
		var tracking_code = $(this).data('trackingcode');
		getDescription(product_id, tracking_code);
	});

	$(document).on('click', '.btn_save', function(event) {
		var product_id = $(this).data('id');
		saveData(product_id);
	});

	$('input#filter_date').daterangepicker({
		autoUpdateInput: false,
		locale: {
			format: "YYYY-MM-DD",
			cancelLabel: 'Clear'
		}
	});

	$('input#filter_date').on('apply.daterangepicker', function(ev, picker) {
		startdate = picker.startDate.format('YYYY-MM-DD');
		enddate = picker.endDate.format('YYYY-MM-DD');
		$(this).val(startdate + ' - ' + enddate);
		status = $('#filter_status option:selected').val();
		shipper = $('#filter_shipper option:selected').val();
		filterAll();
	});

	$('#filter_date').on('cancel.daterangepicker', function(ev, picker) {
		$('#filter_date').val('');
		startdate = "";
		enddate = "";
		filterAll();
	});

	$('#search').keyup(delay(function(e){
		status = $('#filter_status option:selected').val();
		shipper = $('#filter_shipper option:selected').val();
		keyword = $(this).val();
		filterAll();
	}, 300));
});

function filterStatus(value) {
	$('#show_data_from_db').empty();
	status = value;
	getDataFromDB(1);
}

function filterShipper(value) {
	$('#show_data_from_db').empty();
	shipper = value;
	getDataFromDB(1);
}

function filterAll(startdate, enddate, status, keyword, shipper) {
	$('#show_data_from_db').empty();
	getDataFromDB(1);
}

function delay(callback, ms) {
	var timer = 0;
	return function() {
		var context = this, args = arguments;
		clearTimeout(timer);
		timer = setTimeout(function () {
			callback.apply(context, args);
		}, ms || 0);
	};
}

function getDataFromDB(page = 1){
	$('.table_wrap_loading_box').show();
	$('.table').html('');
	$.ajax({
		url: '../api/function/manage_product.php',
		method: 'post',
		data: {
			command: 'get_product',
			page: page,
			startdate: startdate,
			enddate: enddate,
			status: status,
			keyword: keyword,
			shipper: shipper
		},
		success: function(data) {
			var data = JSON.parse(data)
			console.log("result: ",data);

			if(data.status == 200){
				var header = '';
				var html = "";
				if(data.data.data.length > 0){
					header +='<thead>';
					header +=    '<tr>';
					header +=        '<th>วันที่นำเข้าพัสดุ</th>';
					header +=        '<th>เลขพัสดุ</th>';
					header +=        '<th>ชื่อผู้รับ</th>';
					header +=        '<th>เขตจัดส่ง</th>';
					header +=        '<th>สถานะ</th>';
					header +=        '<th>คนนำจ่าย</th>';
					header +=        '<th width="120px">เลือกคนนำจ่าย</th>';
					header +=    '</tr>';
					header +='</thead>';
					header +='<tbody id="show_data_from_db">';
					header +='</tbody>';
					$('.table').html(header);
					$.each(data.data.data, function(index, val) {
						var null_class = '';
						var shipper_name = '';

						if(val.shipper_name == null){
							shipper_name = 'ไม่มีคนนำจ่าย&nbsp;<i class="fas fa-exclamation-circle"></i>';
							null_class = 'shipper_null';
						}else{
							shipper_name = val.shipper_name;
						}

						html +=
						'<tr class="_rowid-'+val.id+'">'+
						'<td >'+val.create_date+'</td>'+
						'<td>'+val.tracking_code+'</td>'+
						'<td>'+val.receiver_desc.firstname+'</td>'+
						'<td>'+val.receiver_desc.area+'</td>'+
						'<td>'+val.status+'</td>'+
						'<td class="_td-shippername '+null_class+'">'+shipper_name+'</td>'+
						'<td>'+
						// '<button class="btn_edit btn btn-sm btn-warning mr-2" data-toggle="modal" data-id="'+val.id+'" data-trackingcode="'+val.tracking_code+'" data-target="#editData"><i class="fas fa-edit"></i></button>'+
						'<button class="btn btn-sm btn-warning mr-2 btn_edit" data-toggle="modal" data-id="'+val.id+'" data-trackingcode="'+val.tracking_code+'" data-target="#editData"><i class="fas fa-edit"></i></button>'+
						'</td>'+
						'</tr>';
					});
					pagination(page,data.data.total_pages);
				}else{
					header +='<div class="table_wrap_empty">';
					header +='  <div class="text-center">';
					header +='      <div>ไม่พบข้อมูล</div>';
					header +='      <div><i class="far fa-clipboard"></i></div>';
					header +='  </div>';
					header +='</div>';
					$('.table').html(header);
				}
			}
			else if(data.status == 404){
				showErrorAjax('ไม่พบข้อมูล');
			}
			else{
				showErrorAjax();
			}
			$('.table_wrap_loading_box').hide();
			$('.table').show();
			$('#show_data_from_db').append(html);
		},
		error: function() {
			console.log("error");
			showErrorAjax();
		}
	});
};

function getDescription(product_id, tracking_code){
	html_mock = '';

	html_mock += '<div class="modal-content">';
	html_mock += '	<div class="modal-header">';
	html_mock += '		<h5 class="modal-title" id="editDataLabel">คนนำจ่ายพัสดุ '+tracking_code+'</h5>';
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
	html += '                        <form action="" method="post">';
	html += '                            <div class="row">';
	html += '                                <div class="col">';
	html += '                                    <label for="sender" class="col-form-label col-form-label-sm">คนนำจ่าย</label>';
	html += '                                    <select name="sender" id="sender" class="form-control form-control-sm">';
	html += '                                        <option value="" selected>กรุณาเลือกคนนำจ่ายพัสดุ</option>';
	$.each(SHIPPER_LIST, function(index, val) {
		html += '<option value="'+val.id+'">'+val.firstname+' '+val.lastname+'</option>';
	});
	html += '                                    </select>';
	html += '                                </div>';
	html += '                            </div>';
	html += '                            <p class="form-title">ข้อมูลผู้รับ</p>';
	html += '                            <div class="row">';
	html += '                                <div class="col">';
	html += '                                    <label for="r_fname" class="col-form-label col-form-label-sm">ชื่อ</label>';
	html += '                                    <input type="text" name="r_fname" id="r_fname" class="form-control form-control-sm" value="'+data.data.receiver_desc.firstname+'" readonly>';
	html += '                                </div>';
	html += '                                <div class="col">';
	html += '                                    <label for="r_lname" class="col-form-label col-form-label-sm">นามสกุล</label>';
	html += '                                    <input type="text" name="r_lname" id="r_lname" class="form-control form-control-sm" value="'+data.data.receiver_desc.lastname+'" readonly>';
	html += '                                </div>';
	html += '                            </div>';
	html += '                            <div class="row">';
	html += '                                <div class="col-6">';
	html += '                                    <label for="phone_number" class="col-form-label col-form-label-sm">เบอร์โทร</label>';
	html += '                                    <input type="text" name="phone_number" id="phone_number" class="form-control form-control-sm" value="'+data.data.receiver_desc.phone_number+'" readonly>';
	html += '                                </div>';
	html += '                            </div>';
	html += '                            <div class="row">';
	html += '                                <div class="col">';
	html += '                                    <label for="r_address" class="col-form-label col-form-label-sm">ที่อยู่</label>';
	html += '                                    <input type="text" name="r_address" id="r_address" class="form-control form-control-sm" value="'+data.data.receiver_desc.address+'" readonly>';
	html += '                                </div>';
	html += '                                <div class="col">';
	html += '                                    <label for="r_district" class="col-form-label col-form-label-sm">เขต</label>';
	html += '                                    <input type="text" name="r_district" id="r_district" class="form-control form-control-sm" value="'+data.data.receiver_desc.area+'" readonly>';
	html += '                                </div>';
	html += '                            </div>';
	html += '                            <div class="row">';
	html += '                                <div class="col">';
	html += '                                    <label for="r_area" class="col-form-label col-form-label-sm">แขวง</label>';
	html += '                                    <input type="text" name="r_area" id="r_area" class="form-control form-control-sm" value="'+data.data.receiver_desc.district+'" readonly>';
	html += '                                </div>';
	html += '                                <div class="col">';
	html += '                                    <label for="r_province" class="col-form-label col-form-label-sm">จังหวัด</label>';
	html += '                                    <input type="text" name="r_province" id="r_province" class="form-control form-control-sm" value="'+data.data.receiver_desc.province+'" readonly>';
	html += '                                </div>';
	html += '                            </div>';
	html += '                            <div class="row">';
	html += '                                <div class="col">';
	html += '                                    <label for="r_postcode" class="col-form-label col-form-label-sm">รหัสไปรษณีย์</label>';
	html += '                                    <input type="text" name="r_postcode" id="r_postcode" class="form-control form-control-sm" value="'+data.data.receiver_desc.postal+'" readonly>';
	html += '                                </div>';
	html += '                                <div class="col">';
	html += '                                    <label for="shipping_type" class="col-form-label col-form-label-sm">ประเภทการส่ง</label>';
	html += '                                    <select name="shipping_type" id="shipping_type" class="form-control form-control-sm" disabled>';
	html += '                                        <option value="normal" selected>ส่งแบบธรรมดา</option>';
	html += '                                        <option value="cod">ส่งแบบธรรมดา แบบเก็บเงินปลายทาง</option>';
	html += '                                    </select>';
	html += '                                </div>';
	html += '                            </div>';
	html += '                            <div class="row">';
	html += '                                <div class="col">';
	html += '                                    <label for="weight" class="col-form-label col-form-label-sm">น้ำหนัก (กรัม)</label>';
	html += '                                    <input type="text" name="weight" id="weight" class="form-control form-control-sm" value="'+data.data.weight+'" readonly>';
	html += '                                </div>';
	html += '                                <div class="col">';
	html += '                                    <label for="price" class="col-form-label col-form-label-sm">ราคา</label>';
	html += '                                    <input type="text" name="price" id="price" class="form-control form-control-sm" value="'+data.data.price+'" readonly>';
	html += '                                </div>';
	html += '                            </div>';
	html += '                        </form>';
	return html;
}

function getShipperList(){
	$.ajax({
		url: '../api/function/manage_account.php',
		method: 'post',
		data: {
			command: 'get_shipper'
		},
		success: function(data) {
			var data = JSON.parse(data)
			console.log("result: ",data);
			if(data.status == 200){
				SHIPPER_LIST = data.data;
				SHIPPER_LIST.forEach(element => {
					$('#filter_shipper').append('<option value="'+element.id+'">'+element.firstname+' '+element.lastname+'</option>');
				});
			}
		},
		error: function() {
			console.log("error");
		}
	});
}

function saveData(product_id){
	var shipper_id = $('#sender').val();

	if(validate()){
		$('.btn_save').html('<i class="fas fa-spinner fa-spin"></i></span>');
		$('.btn_save, .btn_cancel').attr('disabled', true);
		$.ajax({
			url: '../api/function/manage_product.php',
			method: 'post',
			data: {
				command: 'update_product',
				product_id: product_id,
				shipper_id: shipper_id
			},
			success: function(data) {
				var data = JSON.parse(data)
				console.log("result: ",data);
				$('.btn_save').html('บันทึก');
				$('.btn_save, .btn_cancel').attr('disabled', false);
				if(data.status == 200){
					$('._rowid-'+product_id+'').find('._td-shippername').html($('#sender > option:selected').html());
					$('._rowid-'+product_id+'').find('._td-shippername').removeClass('shipper_null');
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
	var shipper_id = $('#sender').val();

	if(shipper_id == ''){
		result = false;

		if(shipper_id == ''){
			$('#sender').addClass('custom_has_err');
		}else{
			$('#sender').removeClass('custom_has_err');
		}
	}
	else{
		$('#sender').removeClass('custom_has_err');
	}

	return result;
}