$(document).ready(function() {
	getDataFromDB();

	$(document).on('click', '.btn_edit', function(event) {
		var product_id = $(this).data('id');
		var tracking_code = $(this).data('trackingcode');
		getDescription(product_id, tracking_code);
	});
});

function getDataFromDB(page = 1){
	$.ajax({
		url: '../api/function/manage_product.php',
		method: 'post',
		data: {
			command: 'get_product',
			page: page
		},
		success: function(data) {
			var data = JSON.parse(data)
			console.log("result: ",data);

			if(data.status == 200){
				var html = "";
				var num = 1;
				$.each(data.data.data, function(index, val) {
					html +=
					'<tr>'+
						'<td>'+val.create_date+'</td>'+
						'<td>'+val.tracking_code+'</td>'+
						'<td>name</td>'+
						'<td>'+val.status+'</td>'+
						'<td>'+
						'<button class="btn_edit btn btn-sm btn-warning mr-2" data-toggle="modal" data-id="'+val.id+'" data-trackingcode="'+val.tracking_code+'" data-target="#editData"><i class="fas fa-edit"></i></button>'+
						'<button class="btn btn-sm btn-danger" data-id="'+val.id+'"><i class="fas fa-trash"></i></button>'+
						'</td>'+
					'</tr>';
					num++;
				});
				pagination(page,data.data.total_pages);
			}

			$('#show_data_from_db').append(html);
		},
		error: function() {
			console.log("error");
		}
	});
};

function getDescription(product_id, tracking_code){
	html_mock = '';

	html_mock += '<div class="modal-content">';
    html_mock += '	<div class="modal-header">';
    html_mock += '		<h5 class="modal-title" id="editDataLabel">แก้ไขข้อมูลพัสดุ '+tracking_code+'</h5>';
    html_mock += '		<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
    html_mock += '			<span aria-hidden="true"><i class="fas fa-times"></i></span>';
    html_mock += '		</button>';
    html_mock += '	</div>';
    html_mock += '	<div class="modal-body">';
    html_mock += '	</div">';
    html_mock += '</div">';

    $('.modal-dialog').html(html_mock);
    $('.modal-body').html('<div align="center" class="wrap_loading_box"><div><i class="fas fa-spinner fa-spin loading_box_icon"></i></span></div></div>');

	$.ajax({
		url: '../api/function/manage_product.php',
		method: 'post',
		data: {
			command: 'get_product',
			product_id: product_id
		},
		success: function(data) {
			var data = JSON.parse(data)
			console.log("result: ",data);

			if(data.status == 200){
				var get_body_html = generateHtml(data);
				$('.modal-body').html(get_body_html);

				$("#shipping_type").val(data.data.data[0].payment_type).change();
			}

		},
		error: function() {
			console.log("error");
		}
	});
	
}

function generateHtml(data){
	html = '';
	html += '		<form action="" method="post">';
    html += '			<p class="form-title">ข้อมูลผู้ทำรายการ</p>';
    html += '			<div class="row">';
    html += '				<div class="col">';
    html += '					<label for="firstname" class="col-form-label col-form-label-sm">ชื่อ</label>';
    html += '					<input type="text" name="firstname" id="firstname" class="form-control form-control-sm" value="">';
    html += '				</div>';
    html += '				<div class="col">';
    html += '					<label for="lastname" class="col-form-label col-form-label-sm">นามสกุล</label>';
    html += '					<input type="text" name="lastname" id="lastname" class="form-control form-control-sm" value="">';
    html += '				</div>';
    html += '			</div>';
    html += '			<div class="row">';
    html += '				<div class="col-6">';
    html += '					<label for="id_card" class="col-form-label col-form-label-sm">เลขประจำตัวประชาชน</label>';
    html += '					<input type="text" name="id_card" id="id_card" class="form-control form-control-sm">';
    html += '				</div>';
    html += '			</div>';
    html += '			<p class="form-title">ข้อมูลผู้รับ</p>';
    html += '				<div class="row">';
    html += '					<div class="col">';
    html += '						<label for="r_fname" class="col-form-label col-form-label-sm">ชื่อ</label>';
    html += '						<input type="text" name="r_fname" id="r_fname" class="form-control form-control-sm" value="'+data.data.data[0].receiver_desc.firstname+'">';
    html += '					</div>';
    html += '					<div class="col">';
    html += '						<label for="r_lname" class="col-form-label col-form-label-sm">นามสกุล</label>';
    html += '						<input type="text" name="r_lname" id="r_lname" class="form-control form-control-sm" value="'+data.data.data[0].receiver_desc.lastname+'">';
    html += '					</div>';
    html += '				</div>';
    html += '				<div class="row">';
    html += '					<div class="col-6">';
    html += '						<label for="phone_number" class="col-form-label col-form-label-sm">เบอร์โทร</label>';
    html += '						<input type="text" name="phone_number" id="phone_number" class="form-control form-control-sm" value="'+data.data.data[0].receiver_desc.phone_number+'">';
    html += '					</div>';
    html += '				</div>';
    html += '				<div class="row">';
    html += '					<div class="col">';
    html += '						<label for="address" class="col-form-label col-form-label-sm">ที่อยู่</label>';
    html += '						<input type="text" name="address" id="address" class="form-control form-control-sm" value="'+data.data.data[0].receiver_desc.address+'">';
    html += '					</div>';
    html += '					<div class="col">';
    html += '						<label for="district" class="col-form-label col-form-label-sm">เขต</label>';
    html += '						<input type="text" name="district" id="district" class="form-control form-control-sm" value="'+data.data.data[0].receiver_desc.district+'">';
    html += '					</div>';
    html += '				</div>';
    html += '				<div class="row">';
    html += '					<div class="col">';
    html += '						<label for="area" class="col-form-label col-form-label-sm">แขวง</label>';
    html += '						<input type="text" name="area" id="area" class="form-control form-control-sm" value="'+data.data.data[0].receiver_desc.area+'">';
    html += '					</div>'
    html += '					<div class="col">'
    html += '						<label for="province" class="col-form-label col-form-label-sm">จังหวัด</label>'
    html += '						<input type="text" name="province" id="province" class="form-control form-control-sm" value="'+data.data.data[0].receiver_desc.province+'">'
    html += '					</div>';
    html += '				</div>';
    html += '				<div class="row">';
    html += '					<div class="col">';
    html += '						<label for="postal_code" class="col-form-label col-form-label-sm">รหัสไปรษณีย์</label>';
    html += '						<input type="text" name="postal_code" id="postal_code" class="form-control form-control-sm" value="'+data.data.data[0].receiver_desc.postal+'">';
    html += '					</div>';
    html += '					<div class="col">';
    html += '						<label for="shipping_type" class="col-form-label col-form-label-sm">ประเภทการส่ง</label>';
    html += '						<select name="shipping_type[]" id="shipping_type" class="form-control form-control-sm">';
    html += '							<option value="normal" selected>ส่งแบบธรรมดา</option>';
    html += '							<option value="cod">ส่งแบบธรรมดา แบบเก็บเงินปลายทาง</option>';
    html += '						</select>';
    html += '					</div>';
    html += '				</div>';
    html += '				<div class="row">';
    html += '					<div class="col">';
    html += '						<label for="weight" class="col-form-label col-form-label-sm">น้ำหนัก (กรัม)</label>';
    html += '						<input type="text" name="weight" id="weight" class="form-control form-control-sm" value="'+data.data.data[0].weight+'">';
    html += '					</div>';
    html += '				<div class="col">';
    html += '					<label for="price" class="col-form-label col-form-label-sm">ราคา</label>';
    html += '					<input type="text" name="price" id="price" class="form-control form-control-sm" value="'+data.data.data[0].price+'">';
    html += '				</div>';
    html += '			</div>';
    html += '		</form>';

    return html;
}

// function generateModal(){
// 	html = '';
	
// 	html += '<div class="modal-content">';
//     html += '	<div class="modal-header">';
//     html += '		<h5 class="modal-title" id="editDataLabel">แก้ไขข้อมูลพัสดุ No.xxxxx</h5>';
//     html += '		<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
//     html += '			<span aria-hidden="true"><i class="fas fa-times"></i></span>';
//     html += '		</button>';
//     html += '	</div>';
//     html += '	<div class="modal-body">';
//     html += '		<form action="" method="post">';
//     html += '			<p class="form-title">ข้อมูลผู้ทำรายการ</p>';
//     html += '			<div class="row">';
//     html += '				<div class="col">';
//     html += '					<label for="firstname" class="col-form-label col-form-label-sm">ชื่อ</label>';
//     html += '					<input type="text" name="firstname" id="firstname" class="form-control form-control-sm" value="">';
//     html += '				</div>';
//     html += '				<div class="col">';
//     html += '					<label for="lastname" class="col-form-label col-form-label-sm">นามสกุล</label>';
//     html += '					<input type="text" name="lastname" id="lastname" class="form-control form-control-sm" value="">';
//     html += '				</div>';
//     html += '			</div>';
//     html += '			<div class="row">';
//     html += '				<div class="col-6">';
//     html += '					<label for="id_card" class="col-form-label col-form-label-sm">เลขประจำตัวประชาชน</label>';
//     html += '					<input type="text" name="id_card" id="id_card" class="form-control form-control-sm">';
//     html += '				</div>';
//     html += '			</div>';
//     html += '			<p class="form-title">ข้อมูลผู้รับ</p>';
//     html += '				<div class="row">';
//     html += '					<div class="col">';
//     html += '						<label for="r_fname" class="col-form-label col-form-label-sm">ชื่อ</label>';
//     html += '						<input type="text" name="r_fname" id="r_fname" class="form-control form-control-sm" value="">';
//     html += '					</div>';
//     html += '					<div class="col">';
//     html += '						<label for="r_lname" class="col-form-label col-form-label-sm">นามสกุล</label>';
//     html += '						<input type="text" name="r_lname" id="r_lname" class="form-control form-control-sm" value="">';
//     html += '					</div>';
//     html += '				</div>';
//     html += '				<div class="row">';
//     html += '					<div class="col-6">';
//     html += '						<label for="phone_number" class="col-form-label col-form-label-sm">เบอร์โทร</label>';
//     html += '						<input type="text" name="phone_number" id="phone_number" class="form-control form-control-sm" value="">';
//     html += '					</div>';
//     html += '				</div>';
//     html += '				<div class="row">';
//     html += '					<div class="col">';
//     html += '						<label for="address" class="col-form-label col-form-label-sm">ที่อยู่</label>';
//     html += '						<input type="text" name="address" id="address" class="form-control form-control-sm">';
//     html += '					</div>';
//     html += '					<div class="col">';
//     html += '						<label for="district" class="col-form-label col-form-label-sm">เขต</label>';
//     html += '						<input type="text" name="district" id="district" class="form-control form-control-sm">';
//     html += '					</div>';
//     html += '				</div>';
//     html += '				<div class="row">';
//     html += '					<div class="col">';
//     html += '						<label for="area" class="col-form-label col-form-label-sm">แขวง</label>';
//     html += '						<input type="text" name="area" id="area" class="form-control form-control-sm">';
//     html += '					</div>'
//     html += '					<div class="col">'
//     html += '						<label for="province" class="col-form-label col-form-label-sm">จังหวัด</label>'
//     html += '						<input type="text" name="province" id="province" class="form-control form-control-sm">'
//     html += '					</div>';
//     html += '				</div>';
//     html += '				<div class="row">';
//     html += '					<div class="col">';
//     html += '						<label for="province" class="col-form-label col-form-label-sm">รหัสไปรษณีย์</label>';
//     html += '						<input type="text" name="province" id="province" class="form-control form-control-sm">';
//     html += '					</div>';
//     html += '					<div class="col">';
//     html += '						<label for="shipping_type" class="col-form-label col-form-label-sm">ประเภทการส่ง</label>';
//     html += '						<select name="shipping_type[]" id="shipping_type" class="form-control form-control-sm">';
//     html += '							<option value="normal" selected>ส่งแบบธรรมดา</option>';
//     html += '							<option value="cod">ส่งแบบธรรมดา แบบเก็บเงินปลายทาง</option>';
//     html += '						</select>';
//     html += '					</div>';
//     html += '				</div>';
//     html += '				<div class="row">';
//     html += '					<div class="col">';
//     html += '						<label for="weight" class="col-form-label col-form-label-sm">น้ำหนัก (กรัม)</label>';
//     html += '						<input type="text" name="weight" id="weight" class="form-control form-control-sm" value="">';
//     html += '					</div>';
//     html += '				<div class="col">';
//     html += '					<label for="price" class="col-form-label col-form-label-sm">ราคา</label>';
//     html += '					<input type="text" name="price" id="price" class="form-control form-control-sm" value="">';
//     html += '				</div>';
//     html += '			</div>';
//     html += '		</form>';
//     html += '	</div>';
//     html += '	<div class="modal-footer">';
//     html += '		<button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>';
//     html += '		<button type="button" class="btn btn-success">บันทึก</button>';
//     html += '	</div>';
//     html += '</div>';

//     return html;
// }