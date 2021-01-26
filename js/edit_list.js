var PRODUCT_ID = '';
var check_sender_history_timeout = 0;
var sender_history_set = [];

var check_receiver_history_timeout = 0;
var receiver_history_set = [];

var check_customer_history_timeout = 0;
var customer_history_set = [];

$(document).ready(function() {
	PRODUCT_ID = window.location.search.slice(1).split('=')[1];
	getDescription();

	$(document).on('click', '.btn_save', function(event) {
		updateAccount();
	});
	$(document).on('click', '.btn_cancel', function(event) {
		window.location.replace("lists.php");
	});
	
	$("#sender_phone").keyup(function(event) {
		clearTimeout(check_sender_history_timeout);
		check_sender_history_timeout = setTimeout(function() {
			getHistory('sender');
		}, 1000);
	});

	$("#phone_number").keyup(function(event) {
		clearTimeout(check_receiver_history_timeout);
		check_receiver_history_timeout = setTimeout(function() {
			getHistory('receiver');
		}, 1000);
	});

	$("#customer_phone_number").keyup(function(event) {
		clearTimeout(check_customer_history_timeout);
		check_customer_history_timeout = setTimeout(function() {
			getHistory('customer');
		}, 1000);
	});

	$(document).on('change', '#shipping_type', function() {

        if($('#shipping_type option:selected').val() == 'cod') {
            $('#money_cod').parent().removeClass('d-none');
        } else {
            $('#money_cod').parent().addClass('d-none');
        }
        //getPrice(pointer_index);
    });

	$(document).on('click', '.sender_history', function(event) {
		var sender_history = $(this).data('index');
		$("#sender_phone").val(sender_history_set[sender_history].phone_number);
		$("#s_fname").val(sender_history_set[sender_history].firstname);
		$("#s_lname").val(sender_history_set[sender_history].lastname);
		$("#s_address").val(sender_history_set[sender_history].address.address);
		$("#s_district").val(sender_history_set[sender_history].address.district);
		$("#s_area").val(sender_history_set[sender_history].address.area);
		$("#s_province").val(sender_history_set[sender_history].address.province);
		$("#s_postcode").val(sender_history_set[sender_history].address.postal);
	});

	$(document).on('click', '.receiver_history', function(event) {
		var receiver_history = $(this).data('index');
		$("#phone_number").val(receiver_history_set[receiver_history].phone_number);
		$("#r_fname").val(receiver_history_set[receiver_history].firstname);
		$("#r_lname").val(receiver_history_set[receiver_history].lastname);
		$("#r_address").val(receiver_history_set[receiver_history].address.address);
		$("#r_district").val(receiver_history_set[receiver_history].address.district);
		$("#r_area").val(receiver_history_set[receiver_history].address.area);
		$("#r_province").val(receiver_history_set[receiver_history].address.province);
		$("#r_postcode").val(receiver_history_set[receiver_history].address.postal);
	});

	$(document).on('click', '.customer_history', function(event) {
		var customer_history = $(this).data('index');
		$("#customer_phone_number").val(customer_history_set[customer_history].phone_number);
		$("#firstname").val(customer_history_set[customer_history].firstname);
		$("#lastname").val(customer_history_set[customer_history].lastname);
		$("#id_card").val(customer_history_set[customer_history].id_card);
	});

	$.Thailand({ 
        autocomplete_size: 5,
        database: '../lib/jquery.Thailand.js/database/db.json', // path หรือ url ไปยัง database
        $district: $('#s_district'), // input ของตำบล
        $amphoe: $('#s_area'), // input ของอำเภอ
        $province: $('#s_province'), // input ของจังหวัด
        $zipcode: $('#s_postcode'), // input ของรหัสไปรษณีย์
    });

    $.Thailand({ 
        autocomplete_size: 5,
        database: '../lib/jquery.Thailand.js/database/db.json', // path หรือ url ไปยัง database
        $district: $('#r_district'), // input ของตำบล
        $amphoe: $('#r_area'), // input ของอำเภอ
        $province: $('#r_province'), // input ของจังหวัด
        $zipcode: $('#r_postcode'), // input ของรหัสไปรษณีย์
    });

});

function getDescription(){
	$.ajax({
		url: '../api/function/manage_product.php',
		method: 'post',
		data: {
			command: 'get_product_desc',
			product_id: PRODUCT_ID
		},
		success: function(data) {
			var data = JSON.parse(data)
			console.log("result: ",data);
			$('.full_wrap_loading_box').hide();
			if(data.status == 200){

				$("#id_card").val(data.data.customer_desc.id_card);
				$("#firstname").val(data.data.customer_desc.firstname);
				$("#lastname").val(data.data.customer_desc.lastname);
				$("#customer_phone_number").val(data.data.customer_desc.customer_phone_number);

				$("#sender_phone").val(data.data.sender_desc.phone_number);
				$("#s_fname").val(data.data.sender_desc.firstname);
				$("#s_lname").val(data.data.sender_desc.lastname);
				$("#s_address").val(data.data.sender_desc.address);
				$("#s_district").val(data.data.sender_desc.district);
				$("#s_area").val(data.data.sender_desc.area);
				$("#s_province").val(data.data.sender_desc.province);
				$("#s_postcode").val(data.data.sender_desc.postal);

				$("#phone_number").val(data.data.receiver_desc.phone_number);
				$("#r_fname").val(data.data.receiver_desc.firstname);
				$("#r_lname").val(data.data.receiver_desc.lastname);
				$("#r_address").val(data.data.receiver_desc.address);
				$("#r_district").val(data.data.receiver_desc.district);
				$("#r_area").val(data.data.receiver_desc.area);
				$("#r_province").val(data.data.receiver_desc.province);
				$("#r_postcode").val(data.data.receiver_desc.postal);

				$("#weight").val(data.data.weight);
				$("#price").val(data.data.price);
				$("#shipping_type").val(data.data.payment_type).change();
				$("#money_cod").val(data.data.cod_price);

				getHistory('customer');
				getHistory('sender');
				getHistory('receiver');
			}else if(data.status == 404){
				Swal.fire({
					title: 'พบข้อผิดพลาด',
					text: 'ไม่พบพัสดุนี้ในระบบ',
					icon: 'error',
					confirmButtonText: 'ตกลง'
				});
			}

		},
		error: function() {
			console.log("error");
			$('.full_wrap_loading_box').hide();
			Swal.fire({
				title: 'พบข้อผิดพลาด',
				text: 'ไม่สามารถดึงข้อมูลได้',
				icon: 'error',
				confirmButtonText: 'ตกลง'
			});
		}
	});
}

function updateAccount(){
	var id_card = $("#id_card").val();
	var c_fname = $("#firstname").val();
	var c_lname = $("#lastname").val();
	var c_phone_number = $("#customer_phone_number").val();

	var sender_phone = $("#sender_phone").val();
	var s_fname = $("#s_fname").val();
	var s_lname = $("#s_lname").val();
	var s_address = $("#s_address").val();
	var s_district = $("#s_district").val();
	var s_area = $("#s_area").val();
	var s_province = $("#s_province").val();
	var s_postcode = $("#s_postcode").val();

	var phone_number = $("#phone_number").val();
	var r_fname = $("#r_fname").val();
	var r_lname = $("#r_lname").val();
	var r_address = $("#r_address").val();
	var r_district = $("#r_district").val();
	var r_area = $("#r_area").val();
	var r_province = $("#r_province").val();
	var r_postcode = $("#r_postcode").val();

	var weight = $("#weight").val();
	var price = $("#price").val();
	var shipping_type = $("#shipping_type").val();
	var cod_price = $("#money_cod").val();

	if(validateEdit()){
		$('.btn_save').html('<i class="fas fa-spinner fa-spin"></i></span>');
		$('.btn_save, .btn_cancel').attr('disabled', true);

		$.ajax({
			url: '../api/function/manage_product.php',
			method: 'post',
			data: {
				command: 'update_product',
				product_id: PRODUCT_ID,
				price: price,
				weight: weight,
				customer_idcard : id_card,
				customer_firstname: c_fname,
				customer_lastname: c_lname,
				customer_phone_number: c_phone_number,
				receiver_firstname: r_fname,
				receiver_lastname: r_lname,
				receiver_address: r_address,
				receiver_district: r_district,
				receiver_area: r_area,
				receiver_province: r_province,
				receiver_postal: r_postcode,
				receiver_phone_number: phone_number,
				sender_firstname: s_fname,
				sender_lastname: s_lname,
				sender_address: s_address,
				sender_district: s_district,
				sender_area: s_area,
				sender_province: s_province,
				sender_postal: s_postcode,
				sender_phone_number: sender_phone,
				payment_type: shipping_type,
				cod_price: cod_price

			},
			success: function(data) {
				$('.btn_save').html('บันทึก');
				$('.btn_save, .btn_cancel').attr('disabled', false);
				var data = JSON.parse(data);
				console.log("result: ",data);

				if(data.status == 200){
					window.location.replace("lists.php");
				}
				else if(data.status == 500){
					Swal.fire({
						title: 'พบข้อผิดพลาด',
						text: 'ไม่สามารถอัพเดทข้อมูลได้',
						icon: 'error',
						confirmButtonText: 'ตกลง'
					});
				}
			},error: function() {
				$('.btn_save').html('บันทึก');
				$('.btn_save, .btn_cancel').attr('disabled', false);
				console.log("error");
			}
		});
	} 
}

function validateEdit(){
	var result = true;
	var id_card = $("#id_card").val();
	var firstname = $("#firstname").val();
	var lastname = $("#lastname").val();
	var c_phone_number = $("#customer_phone_number").val();

	var sender_phone = $("#sender_phone").val();
	var s_fname = $("#s_fname").val();
	var s_lname = $("#s_lname").val();
	var s_address = $("#s_address").val();
	var s_district = $("#s_district").val();
	var s_area = $("#s_area").val();
	var s_province = $("#s_province").val();
	var s_postcode = $("#s_postcode").val();

	var phone_number = $("#phone_number").val();
	var r_fname = $("#r_fname").val();
	var r_lname = $("#r_lname").val();
	var r_address = $("#r_address").val();
	var r_district = $("#r_district").val();
	var r_area = $("#r_area").val();
	var r_province = $("#r_province").val();
	var r_postcode = $("#r_postcode").val();

	var weight = $("#weight").val();
	var price = $("#price").val();
	var shipping_type = $("#shipping_type").val();

	if(id_card == '' ||  firstname == '' || lastname == '' || sender_phone == '' || s_fname == '' || s_lname == '' || s_address == '' || s_district == '' || s_area == '' || 
		s_province == '' || s_postcode == '' || phone_number == '' || r_fname == '' || r_lname == '' || r_address == '' || r_district == '' || r_area == '' || r_province == '' || 
		r_postcode == '' || weight == '' || price == '' || shipping_type == '' || c_phone_number == '' ){
		result = false;

	if(id_card == ''){
		$('#id_card').addClass('custom_has_err');
		$("#id_card").attr("placeholder", "โปรดกรอกเลขบัตรประชาชนผู้ทำรายการ");
	}else{
		$('#id_card').removeClass('custom_has_err');
		$("#id_card").attr("placeholder", "");
	}

	if(firstname == ''){
		$('#firstname').addClass('custom_has_err');
		$("#firstname").attr("placeholder", "โปรดกรอกชื่อผู้ทำรายการ");
	}else{
		$('#firstname').removeClass('custom_has_err');
		$("#firstname").attr("placeholder", "");
	}

	if(lastname == ''){
		$('#lastname').addClass('custom_has_err');
		$("#lastname").attr("placeholder", "โปรดกรอกนามสกุลผู้ทำรายการ");
	}else{
		$('#lastname').removeClass('custom_has_err');
		$("#lastname").attr("placeholder", "");
	}

	if(c_phone_number == ''){
		$('#customer_phone_number').addClass('custom_has_err');
		$("#customer_phone_number").attr("placeholder", "โปรดกรอกเบอร์โทรผู้ทำรายการ");
	}else{
		$('#customer_phone_number').removeClass('custom_has_err');
		$("#customer_phone_number").attr("placeholder", "");
	}

	if(sender_phone == ''){
		$('#sender_phone').addClass('custom_has_err');
		$("#sender_phone").attr("placeholder", "โปรดกรอกเบอร์โทรผู้ส่ง");
	}else{
		$('#sender_phone').removeClass('custom_has_err');
		$("#sender_phone").attr("placeholder", "");
	}

	if(s_fname == ''){
		$('#s_fname').addClass('custom_has_err');
		$("#s_fname").attr("placeholder", "โปรดกรอกชื่อผู้ส่ง");
	}else{
		$('#s_fname').removeClass('custom_has_err');
		$("#s_fname").attr("placeholder", "");
	}

	if(s_lname == ''){
		$('#s_lname').addClass('custom_has_err');
		$("#s_lname").attr("placeholder", "โปรดกรอกนามสกุลผู้ส่ง");
	}else{
		$('#s_lname').removeClass('custom_has_err');
		$("#s_lname").attr("placeholder", "");
	}

	if(s_address == ''){
		$('#s_address').addClass('custom_has_err');
		$("#s_address").attr("placeholder", "โปรดกรอกที่อยู่ผู้ส่ง");
	}else{
		$('#s_address').removeClass('custom_has_err');
		$("#s_address").attr("placeholder", "");
	}

	if(s_district == ''){
		$('#s_district').addClass('custom_has_err');
		$("#s_district").attr("placeholder", "โปรดกรอกแขวง/ตำบลผู้ส่ง");
	}else{
		$('#s_district').removeClass('custom_has_err');
		$("#s_district").attr("placeholder", "");
	}

	if(s_area == ''){
		$('#s_area').addClass('custom_has_err');
		$("#s_area").attr("placeholder", "โปรดกรอกเขต/อำเภอผู้ส่ง");
	}else{
		$('#s_area').removeClass('custom_has_err');
		$("#s_area").attr("placeholder", "");
	}

	if(s_province == ''){
		$('#s_province').addClass('custom_has_err');
		$("#s_province").attr("placeholder", "โปรดกรอกจังหวัดผู้ส่ง");
	}else{
		$('#s_province').removeClass('custom_has_err');
		$("#s_province").attr("placeholder", "");
	}

	if(s_postcode == ''){
		$('#s_postcode').addClass('custom_has_err');
		$("#s_postcode").attr("placeholder", "โปรดกรอกรหัสไปรษณีย์ผู้ส่ง");
	}else{
		$('#s_postcode').removeClass('custom_has_err');
		$("#s_postcode").attr("placeholder", "");
	}

	if(phone_number == ''){
		$('#phone_number').addClass('custom_has_err');
		$("#phone_number").attr("placeholder", "โปรดกรอกเบอร์โทรผู้รับ");
	}else{
		$('#phone_number').removeClass('custom_has_err');
		$("#phone_number").attr("placeholder", "");
	}

	if(r_fname == ''){
		$('#r_fname').addClass('custom_has_err');
		$("#r_fname").attr("placeholder", "โปรดกรอกชื่อผู้รับ");
	}else{
		$('#r_fname').removeClass('custom_has_err');
		$("#r_fname").attr("placeholder", "");
	}

	if(r_lname == ''){
		$('#r_lname').addClass('custom_has_err');
		$("#r_lname").attr("placeholder", "โปรดกรอกนามสกุลผู้รับ");
	}else{
		$('#r_lname').removeClass('custom_has_err');
		$("#r_lname").attr("placeholder", "");
	}

	if(r_address == ''){
		$('#r_address').addClass('custom_has_err');
		$("#r_address").attr("placeholder", "โปรดกรอกที่อยู่ผู้รับ");
	}else{
		$('#r_address').removeClass('custom_has_err');
		$("#r_address").attr("placeholder", "");
	}

	if(r_district == ''){
		$('#r_district').addClass('custom_has_err');
		$("#r_district").attr("placeholder", "โปรดกรอกแขวง/ตำบลผู้รับ");
	}else{
		$('#r_district').removeClass('custom_has_err');
		$("#r_district").attr("placeholder", "");
	}

	if(r_area == ''){
		$('#r_area').addClass('custom_has_err');
		$("#r_area").attr("placeholder", "โปรดกรอกเขต/อำเภอผู้รับ");
	}else{
		$('#s_area').removeClass('custom_has_err');
		$("#s_area").attr("placeholder", "");
	}

	if(r_province == ''){
		$('#r_province').addClass('custom_has_err');
		$("#r_province").attr("placeholder", "โปรดกรอกจังหวัดผู้รับ");
	}else{
		$('#r_province').removeClass('custom_has_err');
		$("#r_province").attr("placeholder", "");
	}

	if(r_postcode == ''){
		$('#r_postcode').addClass('custom_has_err');
		$("#r_postcode").attr("placeholder", "โปรดกรอกรหัสไปรษณีย์ผู้รับ");
	}else{
		$('#r_postcode').removeClass('custom_has_err');
		$("#r_postcode").attr("placeholder", "");
	}

	if(weight == ''){
		$('#weight').addClass('custom_has_err');
		$("#weight").attr("placeholder", "โปรดกรอกน้ำหนักพัสดุ");
	}else{
		$('#weight').removeClass('custom_has_err');
		$("#weight").attr("placeholder", "");
	}

	if(price == ''){
		$('#price').addClass('custom_has_err');
		$("#price").attr("placeholder", "โปรดกรอกราคา");
	}else{
		$('#price').removeClass('custom_has_err');
		$("#price").attr("placeholder", "");
	}

	if(shipping_type == ''){
		$('#shipping_type').addClass('custom_has_err');
            //$("#shipping_type").attr("placeholder", "โปรดกรอกรหัสผ่าน");
        }else{
        	$('#shipping_type').removeClass('custom_has_err');
            //$("#shipping_type").attr("placeholder", "");
        }

    }else{
    	$(':input').removeClass('custom_has_err');
    }

    return result;
}

function getHistory(type = null){
	var phone_number = '';
	var command = '';
	var class_name = '';
	var sub_class_name = '';
	var url = '';
	if(type == 'sender'){
		$('.sender-suggest').html('');
		phone_number = $("#sender_phone").val();
		command = 'get_sender';
		class_name = '.sender-suggest';
		sub_class_name = 'sender_history';
		url = 'manage_sender.php';
	}
	else if(type == 'receiver'){
		$('.receiver-suggest').html('');
		phone_number = $("#phone_number").val();
		command = 'get_receiver';
		class_name = '.receiver-suggest';
		sub_class_name = 'receiver_history';
		url = 'manage_receiver.php';
	}
	else if(type == 'customer'){
		$('.customer-suggest').html('');
		phone_number = $("#customer_phone_number").val();
		command = 'get_customer';
		class_name = '.customer-suggest';
		sub_class_name = 'customer_history';
		url = 'manage_customer.php';
	}
	
	$.ajax({
		url: '../api/function/'+url,
		method: 'post',
		data: {
			command: command,
			phone_number: phone_number,
		},
		success: function(data) {
			var data = JSON.parse(data);
			console.log("result: ",data);

			if(data.status == 200){
				var html = '';
				if(type == 'sender'){
					sender_history_set = data.data.items;
				}
				else if(type == 'receiver'){
					receiver_history_set = data.data.items;
				}
				else if(type == 'customer'){
					customer_history_set = data.data.items;
				}

				if(type == 'customer'){
					$.each(data.data.items, function(index, val) {
						html += '<div class="suggest-detail '+sub_class_name+'" data-index='+index+'>';
						html +=    '<p>'+val.phone_number+'</p>';
						html +=    '<p>'+val.firstname+' '+val.lastname+'</p>';
						html +=    '<p>เลขบัตรประชาขน '+val.id_card+'</p>';
						html += '</div>';
					});
				}else{
					$.each(data.data.items, function(index, val) {
						html += '<div class="suggest-detail '+sub_class_name+'" data-index='+index+'>';
						html +=    '<p>'+val.phone_number+'</p>';
						html +=    '<p>'+val.firstname+' '+val.lastname+'</p>';
						html +=    '<p>'+val.address.address+'</p>';
						html +=    '<p>เขต '+val.address.area+' แขวง '+val.address.district+' '+val.address.province+' '+val.address.postal+'</p>';
						html += '</div>';
					});
				}
				

				$(class_name).html(html);
			}
		},
		error: function() {
			console.log("error");
		}
	});
}