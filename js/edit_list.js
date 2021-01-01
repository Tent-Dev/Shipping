var PRODUCT_ID = '';
$(document).ready(function() {
	PRODUCT_ID = window.location.search.slice(1).split('=')[1];
	getDescription();	
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