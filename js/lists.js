var startdate = "", enddate = "", status = "", keyword = "";

$(document).ready(function() {
	getDataFromDB();

	$(document).on('click', '.btn_edit', function(event) {
		var product_id = $(this).data('id');
		var tracking_code = $(this).data('trackingcode');
		getDescription(product_id, tracking_code);
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
        var status = $('#filter_status option:selected').val();
        filterAll();
    });

    $('#filter_date').on('cancel.daterangepicker', function(ev, picker) {
        $('#filter_date').val('');
        startdate = "";
        enddate = "";
        filterAll();
    });

    $('#search').keyup(delay(function(e){
        var status = $('#filter_status option:selected').val();
        keyword = $(this).val();
        filterAll();
    }, 300));

    $('#filter_status').change(function(event) {
        status = $('#filter_status option:selected').val();
        /* Act on the event */
        filterAll();
    });

    $(document).on('click', '.btn_delete', function(event) {
        var product_id = $(this).data('id');
        console.log('DELETE ITEM ID: ', product_id);
        Swal.fire({
          title: 'คุณต้องการลบพัสดุนี้?',
          showCancelButton: true,
          confirmButtonColor: '#dc3545',
          confirmButtonText: `ยืนยัน`,
          cancelButtonText: 'ยกเลิก',
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            deleteProduct(product_id);
        } 
    })
  });
});

function filterStatus(status) {
    $('#show_data_from_db').empty();
    getDataFromDB(1);
}

function filterAll(startdate, enddate, status, keyword) {
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

function getDataFromDB(page = 1, mode = ''){

    if(mode !== 'delete'){
        $('.table_wrap_loading_box').show();
        $('.table').html('');
    }
    $.ajax({
        url: '../api/function/manage_product.php',
        method: 'post',
        data: {
            command: 'get_product',
            page: page,
            startdate: startdate,
            enddate: enddate,
            status: status,
            keyword: keyword
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
                    header +=        '<th>สถานะ</th>';
                    header +=        '<th width="120px">แก้ไข / ลบ</th>';
                    header +=    '</tr>';
                    header +='</thead>';
                    header +='<tbody id="show_data_from_db">';
                    header +='</tbody>';
                    $('.table').html(header);
                    $.each(data.data.data, function(index, val) {
                        var status_convert = '';

                        if(val.status == 'waiting'){
                            status_convert = 'นำเข้าระบบแล้ว';
                        } else if(val.status == 'sending'){
                            status_convert = 'กำลังจัดส่ง';
                        } else if(val.status == 'success'){
                            status_convert = 'ส่งถึงมือผู้รับแล้ว';
                        } else if(val.status == 'return_distribution_center'){
                            status_convert = 'ถูกตีกลับ';
                        }
                        html +=
                        '<tr>'+
                        '<td>'+val.create_date+'</td>'+
                        '<td>'+val.tracking_code+'</td>'+
                        '<td>'+val.receiver_desc.firstname+'</td>'+
                        '<td>'+status_convert+'</td>'+
                        '<td>';

                        if(val.status == 'waiting'){
                            html += '<a href="edit_lists.php?product_id='+val.id+'"><button class="btn_edit btn btn-sm btn-warning mr-2" data-id="'+val.id+'" data-trackingcode="'+val.tracking_code+'"><i class="fas fa-edit"></i></button></a>'+
                            '<button class="btn_delete btn btn-sm btn-danger" data-id="'+val.id+'"><i class="fas fa-trash"></i></button>';
                        }

                        html += '</td>'+
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
    html_mock += '		<h5 class="modal-title" id="editDataLabel">แก้ไขข้อมูลพัสดุ '+tracking_code+'</h5>';
    html_mock += '		<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
    html_mock += '			<span aria-hidden="true"><i class="fas fa-times"></i></span>';
    html_mock += '		</button>';
    html_mock += '	</div>';
    html_mock += '	<div class="modal-body">';
    html_mock += '	</div>';
    html_mock += '	<div class="modal-footer">';
    html_mock += '		<button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>';
    html_mock += '		<button type="button" class="btn btn-success">บันทึก</button>';
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
            }
        },
        error: function() {
            console.log("error");
        }
    });
}

function deleteProduct(product_id){
    $.ajax({
        url: '../api/function/manage_product.php',
        method: 'post',
        data: {
            command: 'delete_product',
            product_id: product_id
        },
        success: function(data) {
            var data = JSON.parse(data)
            console.log("result: ",data);

            if(data.status == 200){
                Swal.fire({
                  icon: 'success',
                  title: 'ลบพัสดุสำเร็จ',
                  showConfirmButton: false,
                  timer: 1500
              });
                getDataFromDB(thispage_is, 'delete');
            }else{
                Swal.fire({
                  icon: 'error',
                  title: 'ไม่สามารถลบพัสดุได้',
                  showConfirmButton: false,
                  timer: 1500
              });
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
    html += '					<input type="text" name="firstname" id="firstname" class="form-control form-control-sm" value="'+data.data.customer_desc.firstname+'">';
    html += '				</div>';
    html += '				<div class="col">';
    html += '					<label for="lastname" class="col-form-label col-form-label-sm">นามสกุล</label>';
    html += '					<input type="text" name="lastname" id="lastname" class="form-control form-control-sm" value="'+data.data.customer_desc.lastname+'">';
    html += '				</div>';
    html += '			</div>';
    html += '			<div class="row">';
    html += '				<div class="col-6">';
    html += '					<label for="id_card" class="col-form-label col-form-label-sm">เลขประจำตัวประชาชน</label>';
    html += '					<input type="text" name="id_card" id="id_card" class="form-control form-control-sm" value="'+data.data.customer_desc.id_card+'">';
    html += '				</div>';
    html += '			</div>';
    html += '			<p class="form-title">ข้อมูลผู้รับ</p>';
    html += '				<div class="row">';
    html += '					<div class="col">';
    html += '						<label for="r_fname" class="col-form-label col-form-label-sm">ชื่อ</label>';
    html += '						<input type="text" name="r_fname" id="r_fname" class="form-control form-control-sm" value="'+data.data.receiver_desc.firstname+'">';
    html += '					</div>';
    html += '					<div class="col">';
    html += '						<label for="r_lname" class="col-form-label col-form-label-sm">นามสกุล</label>';
    html += '						<input type="text" name="r_lname" id="r_lname" class="form-control form-control-sm" value="'+data.data.receiver_desc.lastname+'">';
    html += '					</div>';
    html += '				</div>';
    html += '				<div class="row">';
    html += '					<div class="col-6">';
    html += '						<label for="phone_number" class="col-form-label col-form-label-sm">เบอร์โทร</label>';
    html += '						<input type="text" name="phone_number" id="phone_number" class="form-control form-control-sm" value="'+data.data.receiver_desc.phone_number+'">';
    html += '					</div>';
    html += '				</div>';
    html += '				<div class="row">';
    html += '					<div class="col">';
    html += '						<label for="address" class="col-form-label col-form-label-sm">ที่อยู่</label>';
    html += '						<input type="text" name="address" id="address" class="form-control form-control-sm" value="'+data.data.receiver_desc.address+'">';
    html += '					</div>';
    html += '					<div class="col">';
    html += '						<label for="district" class="col-form-label col-form-label-sm">เขต</label>';
    html += '						<input type="text" name="district" id="district" class="form-control form-control-sm" value="'+data.data.receiver_desc.district+'">';
    html += '					</div>';
    html += '				</div>';
    html += '				<div class="row">';
    html += '					<div class="col">';
    html += '						<label for="area" class="col-form-label col-form-label-sm">แขวง</label>';
    html += '						<input type="text" name="area" id="area" class="form-control form-control-sm" value="'+data.data.receiver_desc.area+'">';
    html += '					</div>'
    html += '					<div class="col">'
    html += '						<label for="province" class="col-form-label col-form-label-sm">จังหวัด</label>'
    html += '						<input type="text" name="province" id="province" class="form-control form-control-sm" value="'+data.data.receiver_desc.province+'">'
    html += '					</div>';
    html += '				</div>';
    html += '				<div class="row">';
    html += '					<div class="col">';
    html += '						<label for="postal_code" class="col-form-label col-form-label-sm">รหัสไปรษณีย์</label>';
    html += '						<input type="text" name="postal_code" id="postal_code" class="form-control form-control-sm" value="'+data.data.receiver_desc.postal+'">';
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
    html += '						<input type="text" name="weight" id="weight" class="form-control form-control-sm" value="'+data.data.weight+'">';
    html += '					</div>';
    html += '				<div class="col">';
    html += '					<label for="price" class="col-form-label col-form-label-sm">ราคา</label>';
    html += '					<input type="text" name="price" id="price" class="form-control form-control-sm" value="'+data.data.price+'">';
    html += '				</div>';
    html += '			</div>';
    html += '		</form>';
    return html;
}