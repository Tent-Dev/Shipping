var PRODUCT_ID = '';
$(document).ready(function() {
	PRODUCT_ID = window.location.search.slice(1).split('=')[1];
	getDescription();

	$(document).on('click', '.btn_save', function(event) {
		updateAccount();
	});
	$(document).on('click', '.btn_cancel', function(event) {
		window.location.replace("lists.php");
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
	// var id_card = $("#firstname").val();
	// var id_card = $("#lastname").val();

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
    r_postcode == '' || weight == '' || price == '' || shipping_type == '' ){
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