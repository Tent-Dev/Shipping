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

    $(document).on('click', '.btn_add', function(event) {
        insertAccount();
    });

    $(document).on('click', '.btn_save', function(event) {
        updateAccount();
    });

    $('#addData').on('hidden.bs.modal', function (e) {
      $(this).find("input,select").val('').end();
      $(this).find(':input').removeAttr('placeholder');
      $(this).find(':input').removeClass('custom_has_err');
  });

});

function getDataFromDB(page = 1){
    $('.table_wrap_loading_box').show();
    $('.table').html('');
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
            var header = '';
            var html = "";
            if(data.data.data.length > 0){
               header +='<thead>';
               header +=    '<tr>';
               header +=        '<th>ชื่อบัญชีผู้ใช้</th>';
               header +=        '<th>ชื่อ - นามสกุล</th>';
               header +=        '<th>ตำแหน่ง</th>';
               header +=        '<th width="120px">แก้ไข / ลบ</th>';
               header +=    '</tr>';
               header +='</thead>';
               header +='<tbody id="show_data_from_db">';
               header +='</tbody>';
               $('.table').html(header);
               $.each(data.data.data, function(index, val) {
                 html +=
                 '<tr class="_rowid-'+val.id+'">'+
                 '<td class="_td-username">'+val.username+'</td>'+
                 '<td class="_td-name">'+val.firstname+' '+val.lastname+'</td>'+
                 '<td class="_td-type">'+val.member_type+'</td>'+
                 '<td>'+
                 '<button class="btn_edit btn btn-sm btn-warning mr-2" data-toggle="modal" data-id="'+val.id+'" data-target="#editData"><i class="fas fa-edit"></i></button>'+
                 '<button class="btn btn-sm btn-danger" data-id="'+val.id+'"><i class="fas fa-trash"></i></button>'+
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
    }else{
        showErrorAjax();
    }
    $('.table_wrap_loading_box').hide();
    $('.table').show();
    $('#show_data_from_db').html(html);
},
error: function() {
   console.log("error");
   showErrorAjax();
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
    html_mock += '		<button type="button" class="btn btn-success btn_save">บันทึก</button>';
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
    html +='            <input type="text" name="firstname" id="firstname_edit" class="form-control form-control-sm" value="'+data.firstname+'">';
    html +='        </div>';
    html +='        <div class="col">';
    html +='            <label for="lastname" class="col-form-label col-form-label-sm">นามสกุล</label>';
    html +='            <input type="text" name="lastname" id="lastname_edit" class="form-control form-control-sm" value="'+data.lastname+'">';
    html +='        </div>';
    html +='    </div>';
    html +='    <div class="row">';
    html +='        <div class="col-6">';
    html +='            <label for="username" class="col-form-label col-form-label-sm">Username</label>';
    html +='            <input type="text" name="username" id="username_edit" class="form-control form-control-sm" value="'+data.username+'" data-id="'+data.id+'" readonly>';
    html +='        </div>';
    html +='        <div class="col-6">';
    html +='            <label for="member_type" class="col-form-label col-form-label-sm">ตำแหน่ง</label>';
    html +='            <select name="member_type" id="member_type_edit" class="form-control form-control-sm">';
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

function insertAccount(){
    var firstname = $('#firstname').val();
    var lastname = $('#lastname').val();
    var username = $('#username').val();
    var password = $('#password').val();
    var member_type = $('#member_type').val();
    var confirm_password = $('#confirm_password').val();

    if(validate()){
        $('.btn_add').html('<i class="fas fa-spinner fa-spin"></i></span>');
        $('.btn_add, .btn_cancel').attr('disabled', true);

        $.ajax({
            url: '../api/function/manage_account.php',
            method: 'post',
            data: {
                command: 'create_account',
                firstname: firstname,
                lastname: lastname,
                username: username,
                password: password,
                member_type: member_type,
                confirm_password: confirm_password
            },
            success: function(data) {
                $('.btn_add').html('เพิ่ม');
                $('.btn_add, .btn_cancel').attr('disabled', false);
                var data = JSON.parse(data);
                console.log("result: ",data);

                if(data.status == 200){
                    getDataFromDB();
                    $("#addData").modal('hide');
                }
                else if(data.status == 400){
                    Swal.fire({
                        title: 'พบข้อผิดพลาด',
                        text: 'ชื่อบัญชีนี้มีอยู่ในระบบแล้ว',
                        icon: 'error',
                        confirmButtonText: 'ตกลง'
                    });
                }
                else if(data.status == 999){
                    Swal.fire({
                        title: 'พบข้อผิดพลาด',
                        text: 'ยืนยันรหัสผ่านไม่ตรงกัน',
                        icon: 'error',
                        confirmButtonText: 'ตกลง'
                    });
                }

            },
            error: function() {
                $('.btn_add').html('เพิ่ม');
                $('.btn_add, .btn_cancel').attr('disabled', false);
                console.log("error");
            }
        });
    }
}

function updateAccount(){
    var firstname = $('#firstname_edit').val();
    var lastname = $('#lastname_edit').val();
    var member_id = $('#username_edit').data('id');
    var username = $('#username_edit').val();
    var member_type = $('#member_type_edit').val();

    if(validateEdit()){
        $('.btn_save').html('<i class="fas fa-spinner fa-spin"></i></span>');
        $('.btn_save, .btn_cancel').attr('disabled', true);

        $.ajax({
            url: '../api/function/manage_account.php',
            method: 'post',
            data: {
                command: 'update_account',
                member_id: member_id,
                firstname: firstname,
                lastname: lastname,
                username: username,
                member_type: member_type
            },
            success: function(data) {
                $('.btn_save').html('บันทึก');
                $('.btn_save, .btn_cancel').attr('disabled', false);
                var data = JSON.parse(data);
                console.log("result: ",data);

                if(data.status == 200){
                    //getDataFromDB();
                    $('._rowid-'+member_id+'').find('._td-name').html(firstname+' '+lastname);
                    $('._rowid-'+member_id+'').find('._td-type').html(member_type);
                    $("#editData").modal('hide');
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

function validate(){
    var result = true;
    var firstname = $('#firstname').val();
    var lastname = $('#lastname').val();
    var username = $('#username').val();
    var password = $('#password').val();
    var member_type = $('#member_type').val();
    var confirm_password = $('#confirm_password').val();

    if(username == '' || password == '' || confirm_password == '' || firstname == '' || lastname == '' || member_type == '' ){
        result = false;

        if(username == ''){
            $('#username').addClass('custom_has_err');
            $("#username").attr("placeholder", "โปรดกรอกบัญชีผู้ใช้");
        }else{
            $('#username').removeClass('custom_has_err');
            $("#username").attr("placeholder", "");
        }

        if(password == ''){
            $('#password').addClass('custom_has_err');
            $("#password").attr("placeholder", "โปรดกรอกรหัสผ่าน");
        }else{
            $('#password').removeClass('custom_has_err');
            $("#password").attr("placeholder", "");
        }

        if(confirm_password == ''){
            $('#confirm_password').addClass('custom_has_err');
            $("#confirm_password").attr("placeholder", "โปรดกรอกรหัสผ่านยืนยัน");
        }else{
            $('#confirm_password').removeClass('custom_has_err');
            $("#confirm_password").attr("placeholder", "");
        }

        if(firstname == ''){
            $('#firstname').addClass('custom_has_err');
            $("#firstname").attr("placeholder", "โปรดกรอกชื่อ");
        }else{
            $('#firstname').removeClass('custom_has_err');
            $("#firstname").attr("placeholder", "");
        }

        if(lastname == ''){
            $('#lastname').addClass('custom_has_err');
            $("#lastname").attr("placeholder", "โปรดกรอกนามสกุล");
        }else{
            $('#lastname').removeClass('custom_has_err');
            $("#lastname").attr("placeholder", "");
        }

        if(member_type == ''){
            $('#member_type').addClass('custom_has_err');
            //$("#member_type").attr("placeholder", "โปรดกรอกรหัสผ่าน");
        }else{
            $('#member_type').removeClass('custom_has_err');
            //$("#member_type").attr("placeholder", "");
        }
    }else{
        if(password !== confirm_password){
            Swal.fire({
                title: 'พบข้อผิดพลาด',
                text: 'ยืนยันรหัสผ่านไม่ตรงกัน',
                icon: 'error',
                confirmButtonText: 'ตกลง'
            });
        }
        $('#username, #password, #confirm_password, #firstname, #lastname, #member_type').removeClass('custom_has_err');
    }

    return result;
}

function validateEdit(){
    var result = true;
    var firstname = $('#firstname_edit').val();
    var lastname = $('#lastname_edit').val();
    var username = $('#username_edit').val();
    var member_type = $('#member_type_edit').val();

    if(username == '' ||  firstname == '' || lastname == '' || member_type == '' ){
        result = false;

        if(username == ''){
            $('#username_edit').addClass('custom_has_err');
            $("#username_edit").attr("placeholder", "โปรดกรอกบัญชีผู้ใช้");
        }else{
            $('#username_edit').removeClass('custom_has_err');
            $("#username_edit").attr("placeholder", "");
        }

        if(firstname == ''){
            $('#firstname_edit').addClass('custom_has_err');
            $("#firstname_edit").attr("placeholder", "โปรดกรอกชื่อ");
        }else{
            $('#firstname_edit').removeClass('custom_has_err');
            $("#firstname_edit").attr("placeholder", "");
        }

        if(lastname == ''){
            $('#lastname_edit').addClass('custom_has_err');
            $("#lastname_edit").attr("placeholder", "โปรดกรอกนามสกุล");
        }else{
            $('#lastname_edit').removeClass('custom_has_err');
            $("#lastname_edit").attr("placeholder", "");
        }

        if(member_type == ''){
            $('#member_type_edit').addClass('custom_has_err');
            //$("#member_type").attr("placeholder", "โปรดกรอกรหัสผ่าน");
        }else{
            $('#member_type_edit').removeClass('custom_has_err');
            //$("#member_type").attr("placeholder", "");
        }
    }else{
        $('#username_edit, #firstname_edit, #lastname_edit, #member_type_edit').removeClass('custom_has_err');
    }

    return result;
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