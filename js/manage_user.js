$(document).ready(function() {
	getDataFromDB();

    $.each(MEMBER_TYPE, function(index, val) {
        html ='<option value="'+val+'">'+val+'</option>';
        $('#member_type').append(html);
    });

	$(document).on('click', '.btn_edit', function(event) {
		var account_id = $(this).data('id');
		getDescription(account_id);
	});
});

function getDataFromDB(page = 1){
	$.ajax({
		url: '../api/function/manage_account.php',
		method: 'post',
		data: {
			command: 'get_account',
			page: page
		},
		success: function(data) {
			var data = JSON.parse(data)
			console.log("result: ",data);

			if(data.status == 200){
				var html = "";
				$.each(data.data.data, function(index, val) {
					html +=
					'<tr>'+
						'<td>'+val.username+'</td>'+
						'<td>'+val.firstname+' '+val.lastname+'</td>'+
						'<td>'+val.member_type+'</td>'+
						'<td>'+
						'<button class="btn_edit btn btn-sm btn-warning mr-2" data-toggle="modal" data-id="'+val.id+'" data-target="#editData"><i class="fas fa-edit"></i></button>'+
						'<button class="btn btn-sm btn-danger" data-id="'+val.id+'"><i class="fas fa-trash"></i></button>'+
						'</td>'+
					'</tr>';
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

function getDescription(account_id){
	html_mock = '';

	html_mock += '<div class="modal-content">';
    html_mock += '	<div class="modal-header">';
    html_mock += '		<h5 class="modal-title" id="editDataLabel">แก้ไขข้อมูลพนักงาน</h5>';
    html_mock += '		<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
    html_mock += '			<span aria-hidden="true"><i class="fas fa-times"></i></span>';
    html_mock += '		</button>';
    html_mock += '	</div>';
    html_mock += '	<div class="modal-body modal-edit-body">';
    html_mock += '	</div>';
    html_mock += '   <div class="modal-footer">';
    html_mock += '		<button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>';
    html_mock += '		<button type="button" class="btn btn-success">บันทึก</button>';
    html_mock += '	</div>';
    html_mock += '</div">';

    $('.modal-edit').html(html_mock);
    $('.modal-edit-body').html('<div align="center" class="wrap_loading_box"><div><i class="fas fa-spinner fa-spin loading_box_icon"></i></div></div>');

	$.ajax({
		url: '../api/function/manage_account.php',
		method: 'post',
		data: {
			command: 'get_account_desc',
			account_id: account_id
		},
		success: function(data) {
			var data = JSON.parse(data);
			console.log("result: ",data);

			if(data.status == 200){
				var get_body_html = generateHtml(data.data);
				$('.modal-edit-body').html(get_body_html);
                $("#member_type_edit").val(data.data.member_type).change();
			}

		},
		error: function() {
			console.log("error");
		}
	});
	
}

function generateHtml(data){
	html = '';
	html +='<form action="" method="post">';
    html +='    <div class="row">';
    html +='        <div class="col">';
    html +='            <label for="firstname" class="col-form-label col-form-label-sm">ชื่อ</label>';
    html +='            <input type="text" name="firstname" id="firstname" class="form-control form-control-sm" value="'+data.firstname+'">';
    html +='        </div>';
    html +='        <div class="col">';
    html +='            <label for="lastname" class="col-form-label col-form-label-sm">นามสกุล</label>';
    html +='            <input type="text" name="lastname" id="lastname" class="form-control form-control-sm" value="'+data.lastname+'">';
    html +='        </div>';
    html +='    </div>';
    html +='    <div class="row">';
    html +='        <div class="col-6">';
    html +='            <label for="username" class="col-form-label col-form-label-sm">Username</label>';
    html +='            <input type="text" name="username" id="username" class="form-control form-control-sm" value="'+data.username+'" readonly>';
    html +='        </div>';
    html +='        <div class="col-6">';
    html +='            <label for="password" class="col-form-label col-form-label-sm">Password</label>';
    html +='            <input type="password" name="password" id="password" class="form-control form-control-sm" value="">';
    html +='        </div>';
    html +='    </div>';
    html +='    <div class="row">';
    html +='        <div class="col-6">';
    html +='            <label for="member_type" class="col-form-label col-form-label-sm">ตำแหน่ง</label>';
    html +='            <select name="member_type" id="member_type_edit" class="form-control form-control-sm">';
    //html +='                <option value="" selected>กรุณาเลือกตำแหน่ง</option>';
    $.each(MEMBER_TYPE, function(index, val) {
        var selected = '';
        if(data.member_type == val){
            selected = 'selected'
        }
        html +='<option value="'+val+'" '+selected+'>'+val+'</option>';
    });
    html +='            </select>';
    html +='        </div>';
    html +='    </div>';
    html +='</form>';
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