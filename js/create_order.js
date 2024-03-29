var check_sender_history_timeout = 0;
var sender_history_set = [];

var check_receiver_history_timeout = 0;
var receiver_history_set = [];

var check_customer_history_timeout = 0;
var customer_history_set = [];

var TRANSACTION_GENERATE = '';

$(document).ready(function() {
    var random_a = makeid('2',0);
    var random_b = makeid('2',1);
    TRANSACTION_GENERATE = moment().format('x')+random_a+random_b;

    console.log(TRANSACTION_GENERATE);
    var form_clone = $('#form-section .section:first').clone();
    var sectionsCount = 1;

    $(document).on('click', '.btn_checkprice', function(){ 
        $('.sync_price').addClass('fa-spin');
        sumPrice();
        setTimeout(function(){
            $('.sync_price').removeClass('fa-spin');
        }, 1000);
        $('#m_received, #change').val('');
    });

    $(document).on('click', '.btn_clearall', function(){ 

        Swal.fire({
          title: 'คุณต้องการยกเลิกการทำรายการนี้?',
          showCancelButton: true,
          confirmButtonColor: '#dc3545',
          confirmButtonText: `ยืนยัน`,
          cancelButtonText: 'ปิด',
      }).then((result) => {
        if (result.isConfirmed) {
            location.reload();
        } 
    })
  });


    $('body').on('click', '.addsection', function() {

        if(validateCreate('')){

            getAllData();

        }
        return false;
    });

    $('#form-section').on('click', '.remove', function() {
        $(this).parent().fadeOut(300, function(){
            $(this).parent().remove();
            sumPrice();

            if($('.section').length == 0){
                $('.btn_save').attr('disabled', true);
            }
            return false;
        });
        return false;
    });

    $('.btn_save').click(function(event) {
        saveData();
    });

    $.Thailand({ 
        autocomplete_size: 5,
            database: '../lib/jquery.Thailand.js/database/db.json', // path หรือ url ไปยัง database
            $district: $('#r_district'), // input ของตำบล
            $amphoe: $('#r_area'), // input ของอำเภอ
            $province: $('#r_province'), // input ของจังหวัด
            $zipcode: $('#r_postcode'), // input ของรหัสไปรษณีย์
        });

    $.Thailand({ 
        autocomplete_size: 5,
            database: '../lib/jquery.Thailand.js/database/db.json', // path หรือ url ไปยัง database
            $district: $('#s_district'), // input ของตำบล
            $amphoe: $('#s_area'), // input ของอำเภอ
            $province: $('#s_province'), // input ของจังหวัด
            $zipcode: $('#s_postcode'), // input ของรหัสไปรษณีย์
        });


    $(document).on('keyup', '.phone_number', function(event) {
        var pointer_index = $(this).closest('.section').attr('data-index');
        clearTimeout(check_receiver_history_timeout);
        check_receiver_history_timeout = setTimeout(function() {
            getHistory('receiver', pointer_index);
        }, 1000);
    });

    $(document).on('keyup', '.sender_phone', function(event) {
        var pointer_index = $(this).closest('.section').attr('data-index');
        clearTimeout(check_sender_history_timeout);
        check_sender_history_timeout = setTimeout(function() {
            getHistory('sender', pointer_index);
        }, 1000);
    });


    $("#customer_phone_number").keyup(function(event) {
        clearTimeout(check_customer_history_timeout);
        check_customer_history_timeout = setTimeout(function() {
            getHistory('customer');
        }, 1000);
    });

    $(document).on('click', '.sender_history', function(event) {
        var sender_history = $(this).data('index');
        var pointer_index = $(this).closest('.section').attr('data-index');

        pointer_index = pointer_index == 1 ? '' : pointer_index;
        $("#sender_phone"+pointer_index).val(sender_history_set[sender_history].phone_number);
        $("#s_fname"+pointer_index).val(sender_history_set[sender_history].firstname+' '+sender_history_set[sender_history].lastname);
        // $("#s_lname"+pointer_index).val(sender_history_set[sender_history].lastname);
        $("#s_address"+pointer_index).val(sender_history_set[sender_history].address.address);
        $("#s_district"+pointer_index).val(sender_history_set[sender_history].address.district);
        $("#s_area"+pointer_index).val(sender_history_set[sender_history].address.area);
        $("#s_province"+pointer_index).val(sender_history_set[sender_history].address.province);
        $("#s_postcode"+pointer_index).val(sender_history_set[sender_history].address.postal);
    });

    $(document).on('click', '.receiver_history', function(event) {
        var receiver_history = $(this).data('index');
        var pointer_index = $(this).closest('.section').attr('data-index');

        pointer_index = pointer_index == 1 ? '' : pointer_index;
        $("#phone_number"+pointer_index).val(receiver_history_set[receiver_history].phone_number);
        $("#r_fname"+pointer_index).val(receiver_history_set[receiver_history].firstname+' '+receiver_history_set[receiver_history].lastname);
        // $("#r_lname"+pointer_index).val(receiver_history_set[receiver_history].lastname);
        $("#r_address"+pointer_index).val(receiver_history_set[receiver_history].address.address);
        $("#r_district"+pointer_index).val(receiver_history_set[receiver_history].address.district);
        $("#r_area"+pointer_index).val(receiver_history_set[receiver_history].address.area);
        $("#r_province"+pointer_index).val(receiver_history_set[receiver_history].address.province);
        $("#r_postcode"+pointer_index).val(receiver_history_set[receiver_history].address.postal);
    });

    $(document).on('click', '.customer_history', function(event) {
        var customer_history = $(this).data('index');
        $("#customer_phone_number").val(customer_history_set[customer_history].phone_number);
        $("#firstname").val(customer_history_set[customer_history].firstname+' '+customer_history_set[customer_history].lastname);
        // $("#lastname").val(customer_history_set[customer_history].lastname);
        $("#id_card").val(customer_history_set[customer_history].id_card);
    });

    $(document).on('click', '.btn_delete', function(event) {
        var product_id = $(this).data('id');
        deleteProductFromDb(product_id);
    });

    $(document).on('focus', '.form-suggest', function() {
        $(this).parent().find('.box-suggest').addClass('active');
    });
    $(document).on('focusout', '.form-suggest', function() {
        $(this).parent().find('.box-suggest.active').removeClass('active');
    });

    $(document).on('change', '.shipping_type', function() {
        var pointer_index = $(this).closest('.section').attr('data-index');
        pointer_index = pointer_index == 1 ? '' : pointer_index;

        if($('#shipping_type'+pointer_index+' option:selected').val() == 'cod') {
            $('#money_cod'+pointer_index).parent().removeClass('d-none');
        } else {
            $('#money_cod'+pointer_index).parent().addClass('d-none');
        }
        getPrice(pointer_index);
    });

    $(document).on('keyup', '.weight', function() {
        var pointer_index = $(this).closest('.section').attr('data-index');
        pointer_index = pointer_index == 1 ? '' : pointer_index;

        if($('#price_type'+pointer_index).is(":checked") == true) {
            getPrice(pointer_index);
        }
    });

    $(document).on('keyup', '#m_received', function() {
        var get_price = $(this).val();
        var total_price = sumPrice();
        var sum = get_price-total_price;

        $('#change').val(sum.toFixed(2));
    });

    // $(document).on('change', '.price, .weight', function() {
    //     sumPrice();
    // });

    $(document).on('click', '.price_type', function() {
        var pointer_index = $(this).closest('.section').attr('data-index');
        pointer_index = pointer_index == 1 ? '' : pointer_index;

        if($('#price_type'+pointer_index).is(":checked") == true) {
            getPrice(pointer_index);
        }
    });

    $(document).on('change', '.price_type', function(event) {
        var pointer_index = $(this).closest('.section').attr('data-index');
        pointer_index = pointer_index == 1 ? '' : pointer_index;
        if($(this).is(':checked')){
            $('#price'+pointer_index).attr('disabled', true);
            getPrice(pointer_index);
            //sumPrice();
        }else{
            $('#price'+pointer_index).attr('disabled', false);
        }
    });

});

function saveData(){
    var get_price = $('#m_received').val();
    var change_price = $('#change').val();
    var total_price = sumPrice();

    data_obj = {};
    data_obj.get_price = get_price;
    data_obj.change_price = change_price;
    data_obj.total_price = total_price;
    data_obj.transaction_generate = TRANSACTION_GENERATE;

    $.ajax({
        url: '../api/function/manage_product.php',
        method: 'post',
        data: {
            command: 'create_order',
            get_price : get_price,
            change_price : change_price,
            total_price : total_price,
            transaction_generate : TRANSACTION_GENERATE
        },
        success: function(data) {
            $('.btn_save').html('บันทึก');
            $('.btn_save, .btn_cancel').attr('disabled', false);
            var data = JSON.parse(data);
            console.log("result: ",data);

            if(data.status == 200){
                    //window.location.replace("lists.php");
                    $('.slip_link').attr('href', 'slip.php?transaction_id='+TRANSACTION_GENERATE+'&mode=\'trans_id\'');
                    $('.label_link').attr('href', 'item_label.php?transaction_id='+TRANSACTION_GENERATE+'&mode=all');
                    $('.form_add, .form-section, .item_detail').hide();
                    $('.form_print').show();
                }
                else{
                    Swal.fire({
                        title: 'พบข้อผิดพลาด',
                        text: 'ไม่สามารถสร้างรายการได้',
                        icon: 'error',
                        confirmButtonText: 'ตกลง'
                    });
                }
            },error: function() {
                $('.btn_save').html('บันทึก');
                $('.btn_save, .btn_cancel').attr('disabled', false);
                Swal.fire({
                    title: 'พบข้อผิดพลาด',
                    text: 'ไม่สามารถสร้างรายการได้',
                    icon: 'error',
                    confirmButtonText: 'ตกลง'
                });
            }
        });
}

function getAllData(){
    var checkvalue = true;
    var data_obj = {};
    var map_payment = {};
    var data_items = [];

    var item_obj = {};
    var receiver_obj = {};
    var sender_obj = {};

    var s_phone = $('#sender_phone').val();
    var s_fname =  $("#s_fname").val().split(' ')[0];
    var s_lname = $("#s_fname").val().split(' ')[1] || '';
    var s_address = $('#s_address').val();
    var s_district = $('#s_district').val();
    var s_area = $('#s_area').val();
    var s_province = $('#s_province').val();
    var s_postcode = $('#s_postcode').val();

    var r_phone = $('#phone_number').val();
    var r_fname = $("#r_fname").val().split(' ')[0];
    var r_lname = $("#r_fname").val().split(' ')[1] || '';
    var r_address = $('#r_address').val();
    var r_district = $('#r_district').val();
    var r_area = $('#r_area').val();
    var r_province = $('#r_province').val();
    var r_postcode = $('#r_postcode').val();

    var product_type = $('#product_type').val();
    var weight = $('#weight').val();
    var price = $('#price').val();
    var shipping_type = $('#shipping_type').val();
    var cod_price = $('#money_cod').val();

    if(!validateCreate('')){
        checkvalue = false;
    }else{
        $('.addsection').attr('disabled', true);
        receiver_obj.firstname = r_fname;
        receiver_obj.lastname = r_lname;
        receiver_obj.address = r_address;
        receiver_obj.district = r_district;
        receiver_obj.area = r_area;
        receiver_obj.province = r_province;
        receiver_obj.postal = r_postcode;
        receiver_obj.phone_number = r_phone;

        sender_obj.firstname = s_fname;
        sender_obj.lastname = s_lname;
        sender_obj.address = s_address;
        sender_obj.district = s_district;
        sender_obj.area = s_area;
        sender_obj.province = s_province;
        sender_obj.postal = s_postcode;
        sender_obj.phone_number = s_phone;

        item_obj.product_type = product_type;
        item_obj.weight = weight;
        item_obj.price = price;
        item_obj.shipping_type = 'normal';
        item_obj.payment_type  = shipping_type;
        item_obj.cod_price = cod_price;

        item_obj.receiver_desc = receiver_obj;
        item_obj.sender_desc = sender_obj;

        data_items.push(item_obj);
    }

    if(checkvalue){
        $('.btn_save, .btn_clearall').attr('disabled', true);

        var id_card = $("#id_card").val();
        // var c_fname = $("#firstname").val();
        // var c_lname = $("#lastname").val();
        var c_fname = $("#firstname").val().split(' ')[0];
        var c_lname = $("#firstname").val().split(' ')[1] || '';
        var c_phone_number = $("#customer_phone_number").val();

        var get_price = $('#m_received').val();
        var change_price = $('#change').val();

        data_obj.firstname = c_fname;
        data_obj.lastname = c_lname;
        data_obj.id_card = id_card;
        data_obj.customer_phone_number = c_phone_number;
        data_obj.item = data_items;
        data_obj.payment = map_payment;
        data_obj.transaction_generate = TRANSACTION_GENERATE;

        console.log('Data:: ',data_obj);

        $.ajax({
            url: '../api/function/manage_product.php',
            method: 'post',
            data: {
                command: 'create_product',
                create_data: JSON.stringify(data_obj),
            },
            success: function(data) {
                $('.btn_save').html('บันทึก <i class="far fa-save"></i>');
                $('.btn_save, .btn_clearall').attr('disabled', false);
                var data = JSON.parse(data);
                console.log("result: ",data);

                if(data.status == 200){
                    //window.location.replace("lists.php");
                    console.log('Transaction id: ', data.last_id);
                    // $('.slip_link').attr('href', 'slip.php?transaction_id='+data.last_id+'&mode=\'id\'');
                    // $('.label_link').attr('href', 'item_label.php?transaction_id='+data.transaction_id+'&mode=all');
                    // $('.form_add').hide();
                    // $('.form_print').show();
                    html = '';
                    html += '<tr class="_list_pd_id-'+data.last_id+'">';
                    html +=
                    '<td>'+data.tracking_code+'</td>'+
                    '<td>'+r_fname+' '+r_lname+'</td>'+
                    '<td>'+r_phone+'</td>'+
                    '<td>'+r_address+'</td>'+
                    '<td>'+r_postcode+'</td>'+
                    '<td>'+weight+'</td>'+
                    '<td class="price">'+price+'</td>'+
                    '<td>'+cod_price+'</td>'+
                    '<td><button class="btn_delete btn btn-sm btn-danger" data-id="'+data.last_id+'"><i class="fas fa-trash"></i></button></td>';
                    html += '</tr>';

                    $('#order_list').append(html);

                    // $("#sender_phone").val('');
                    // $("#s_fname").val('');
                    // $("#s_lname").val('');
                    // $("#s_address").val('');
                    // $("#s_district").val('');
                    // $("#s_area").val('');
                    // $("#s_province").val('');
                    // $("#s_postcode").val('');

                    $("#phone_number").val('');
                    $("#r_fname").val('');
                    $("#r_lname").val('');
                    $("#r_address").val('');
                    $("#r_district").val('');
                    $("#r_area").val('');
                    $("#r_province").val('');
                    $("#r_postcode").val('');
                    $('#money_cod').val('');

                    $("#weight").val('');
                    $("#price").val('');
                    $("#shipping_type").val();
                    sumPrice();
                    setTimeout(function(){
                        window.open('item_label.php?tracking_code='+data.tracking_code,'_blank');
                    }, 2000);
                    
                }
                else{
                    Swal.fire({
                        title: 'พบข้อผิดพลาด',
                        text: 'ไม่สามารถสร้างรายการได้',
                        icon: 'error',
                        confirmButtonText: 'ตกลง'
                    });
                }
                $('.addsection').attr('disabled', false);
            },error: function() {
                $('.btn_save, .btn_clearall').attr('disabled', false);
                Swal.fire({
                    title: 'พบข้อผิดพลาด',
                    text: 'ไม่สามารถสร้างรายการได้',
                    icon: 'error',
                    confirmButtonText: 'ตกลง'
                });
                $('.addsection').attr('disabled', false);
            }
        });

    }
}

function deleteProductFromDb(product_id){
     $.ajax({
            url: '../api/function/manage_product.php',
            method: 'post',
            data: {
                command: 'delete_product_from_db',
                product_id: product_id,
            },
            success: function(data) {
                var data = JSON.parse(data);
                console.log("result: ",data);

                if(data.status == 200){
                    $('._list_pd_id-'+product_id+'').remove();
                    sumPrice();
                    $('#m_received, #change').val('');
                }
                else{
                    Swal.fire({
                        title: 'พบข้อผิดพลาด',
                        text: 'ไม่สามารถลบรายการได้',
                        icon: 'error',
                        confirmButtonText: 'ตกลง'
                    });
                }
                $('.addsection').attr('disabled', false);
            },error: function() {
                Swal.fire({
                    title: 'พบข้อผิดพลาด',
                    text: 'ไม่สามารถลบรายการได้',
                    icon: 'error',
                    confirmButtonText: 'ตกลง'
                });
            }
        });
}

function validateCreate(pointer_index){
    var result = true;
    var id_card = $("#id_card").val();
    // var firstname = $("#firstname").val();
    // var lastname = $("#lastname").val();
    var firstname = $("#firstname").val();
    //var lastname = $("#firstname").val();
    var c_phone_number = $("#customer_phone_number").val();

    var get_price = $('#m_received').val();

    var sender_phone = $("#sender_phone"+pointer_index).val();
    var s_fname = $("#s_fname"+pointer_index).val();
    var s_lname = $("#s_lname"+pointer_index).val();
    var s_address = $("#s_address"+pointer_index).val();
    var s_district = $("#s_district"+pointer_index).val();
    var s_area = $("#s_area"+pointer_index).val();
    var s_province = $("#s_province"+pointer_index).val();
    var s_postcode = $("#s_postcode"+pointer_index).val();

    var phone_number = $("#phone_number"+pointer_index).val();
    var r_fname = $("#r_fname"+pointer_index).val();
    var r_lname = $("#r_lname"+pointer_index).val();
    var r_address = $("#r_address"+pointer_index).val();
    var r_district = $("#r_district"+pointer_index).val();
    var r_area = $("#r_area"+pointer_index).val();
    var r_province = $("#r_province"+pointer_index).val();
    var r_postcode = $("#r_postcode"+pointer_index).val();

    var weight = $("#weight"+pointer_index).val();
    var price = $("#price"+pointer_index).val();
    var shipping_type = $("#shipping_type"+pointer_index).val();
    var cod_money = $('#money_cod').val();

    // if(id_card == '' ||  firstname == '' || lastname == '' || sender_phone == '' || s_fname == '' || s_lname == '' || s_address == '' || s_district == '' || s_area == '' || 
    //     s_province == '' || s_postcode == '' || phone_number == '' || r_fname == '' || r_lname == '' || r_address == '' || r_district == '' || r_area == '' || r_province == '' || 
    //     r_postcode == '' || weight == '' || price == '' || shipping_type == '' || c_phone_number == '' || get_price == '' ){
    if(id_card == '' ||  firstname == '' || sender_phone == '' || s_fname == '' || s_lname == '' || s_address == '' || s_district == '' || s_area == '' || 
        s_province == '' || s_postcode == '' || phone_number == '' || r_fname == '' || r_lname == '' || r_address == '' || r_district == '' || r_area == '' || r_province == '' || 
        r_postcode == '' || weight == '' || price == '' || shipping_type == '' || c_phone_number == '' || (shipping_type == 'cod' && cod_money == '') ){
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


        if(c_phone_number == ''){
            $('#customer_phone_number'+pointer_index).addClass('custom_has_err');
            $("#customer_phone_number"+pointer_index).attr("placeholder", "โปรดกรอกเบอร์โทรผู้ทำรายการ");
        }else{
            $('#customer_phone_number'+pointer_index).removeClass('custom_has_err');
            $("#customer_phone_number"+pointer_index).attr("placeholder", "");
        }


        if(sender_phone == ''){
            $('#sender_phone'+pointer_index).addClass('custom_has_err');
            $("#sender_phone"+pointer_index).attr("placeholder", "โปรดกรอกเบอร์โทรผู้ส่ง");
        }else{
            $('#sender_phone'+pointer_index).removeClass('custom_has_err');
            $("#sender_phone"+pointer_index).attr("placeholder", "");
        }

        if(s_fname == ''){
            $('#s_fname'+pointer_index).addClass('custom_has_err');
            $("#s_fname"+pointer_index).attr("placeholder", "โปรดกรอกชื่อผู้ส่ง");
        }else{
            $('#s_fname'+pointer_index).removeClass('custom_has_err');
            $("#s_fname"+pointer_index).attr("placeholder", "");
        }

        if(s_lname == ''){
            $('#s_lname'+pointer_index).addClass('custom_has_err');
            $("#s_lname"+pointer_index).attr("placeholder", "โปรดกรอกนามสกุลผู้ส่ง");
        }else{
            $('#s_lname'+pointer_index).removeClass('custom_has_err');
            $("#s_lname"+pointer_index).attr("placeholder", "");
        }

        if(s_address == ''){
            $('#s_address'+pointer_index).addClass('custom_has_err');
            $("#s_address"+pointer_index).attr("placeholder", "โปรดกรอกที่อยู่ผู้ส่ง");
        }else{
            $('#s_address'+pointer_index).removeClass('custom_has_err');
            $("#s_address"+pointer_index).attr("placeholder", "");
        }

        if(s_district == ''){
            $('#s_district'+pointer_index).addClass('custom_has_err');
            $("#s_district"+pointer_index).attr("placeholder", "โปรดกรอกแขวง/ตำบลผู้ส่ง");
        }else{
            $('#s_district'+pointer_index).removeClass('custom_has_err');
            $("#s_district"+pointer_index).attr("placeholder", "");
        }

        if(s_area == ''){
            $('#s_area'+pointer_index).addClass('custom_has_err');
            $("#s_area"+pointer_index).attr("placeholder", "โปรดกรอกเขต/อำเภอผู้ส่ง");
        }else{
            $('#s_area'+pointer_index).removeClass('custom_has_err');
            $("#s_area"+pointer_index).attr("placeholder", "");
        }

        if(s_province == ''){
            $('#s_province'+pointer_index).addClass('custom_has_err');
            $("#s_province"+pointer_index).attr("placeholder", "โปรดกรอกจังหวัดผู้ส่ง");
        }else{
            $('#s_province'+pointer_index).removeClass('custom_has_err');
            $("#s_province"+pointer_index).attr("placeholder", "");
        }

        if(s_postcode == ''){
            $('#s_postcode'+pointer_index).addClass('custom_has_err');
            $("#s_postcode"+pointer_index).attr("placeholder", "โปรดกรอกรหัสไปรษณีย์ผู้ส่ง");
        }else{
            $('#s_postcode'+pointer_index).removeClass('custom_has_err');
            $("#s_postcode"+pointer_index).attr("placeholder", "");
        }

        if(phone_number == ''){
            $('#phone_number'+pointer_index).addClass('custom_has_err');
            $("#phone_number"+pointer_index).attr("placeholder", "โปรดกรอกเบอร์โทรผู้รับ");
        }else{
            $('#phone_number'+pointer_index).removeClass('custom_has_err');
            $("#phone_number"+pointer_index).attr("placeholder", "");
        }

        if(r_fname == ''){
            $('#r_fname'+pointer_index).addClass('custom_has_err');
            $("#r_fname"+pointer_index).attr("placeholder", "โปรดกรอกชื่อผู้รับ");
        }else{
            $('#r_fname'+pointer_index).removeClass('custom_has_err');
            $("#r_fname"+pointer_index).attr("placeholder", "");
        }

        if(r_lname == ''){
            $('#r_lname'+pointer_index).addClass('custom_has_err');
            $("#r_lname"+pointer_index).attr("placeholder", "โปรดกรอกนามสกุลผู้รับ");
        }else{
            $('#r_lname'+pointer_index).removeClass('custom_has_err');
            $("#r_lname"+pointer_index).attr("placeholder", "");
        }

        if(r_address == ''){
            $('#r_address'+pointer_index).addClass('custom_has_err');
            $("#r_address"+pointer_index).attr("placeholder", "โปรดกรอกที่อยู่ผู้รับ");
        }else{
            $('#r_address'+pointer_index).removeClass('custom_has_err');
            $("#r_address"+pointer_index).attr("placeholder", "");
        }

        if(r_district == ''){
            $('#r_district'+pointer_index).addClass('custom_has_err');
            $("#r_district"+pointer_index).attr("placeholder", "โปรดกรอกแขวง/ตำบลผู้รับ");
        }else{
            $('#r_district'+pointer_index).removeClass('custom_has_err');
            $("#r_district"+pointer_index).attr("placeholder", "");
        }

        if(r_area == ''){
            $('#r_area'+pointer_index).addClass('custom_has_err');
            $("#r_area"+pointer_index).attr("placeholder", "โปรดกรอกเขต/อำเภอผู้รับ");
        }else{
            $('#s_area'+pointer_index).removeClass('custom_has_err');
            $("#s_area"+pointer_index).attr("placeholder", "");
        }

        if(r_province == ''){
            $('#r_province'+pointer_index).addClass('custom_has_err');
            $("#r_province"+pointer_index).attr("placeholder", "โปรดกรอกจังหวัดผู้รับ");
        }else{
            $('#r_province'+pointer_index).removeClass('custom_has_err');
            $("#r_province"+pointer_index).attr("placeholder", "");
        }

        if(r_postcode == ''){
            $('#r_postcode'+pointer_index).addClass('custom_has_err');
            $("#r_postcode"+pointer_index).attr("placeholder", "โปรดกรอกรหัสไปรษณีย์ผู้รับ");
        }else{
            $('#r_postcode'+pointer_index).removeClass('custom_has_err');
            $("#r_postcode"+pointer_index).attr("placeholder", "");
        }

        if(weight == ''){
            $('#weight'+pointer_index).addClass('custom_has_err');
            $("#weight"+pointer_index).attr("placeholder", "โปรดกรอกน้ำหนักพัสดุ");
        }else{
            $('#weight'+pointer_index).removeClass('custom_has_err');
            $("#weight"+pointer_index).attr("placeholder", "");
        }

        if(price == ''){
            $('#price'+pointer_index).addClass('custom_has_err');
            $("#price"+pointer_index).attr("placeholder", "โปรดกรอกราคา");
        }else{
            $('#price'+pointer_index).removeClass('custom_has_err');
            $("#price"+pointer_index).attr("placeholder", "");
        }

        if(shipping_type == ''){
            $('#shipping_type'+pointer_index).addClass('custom_has_err');
        }else{
            $('#shipping_type'+pointer_index).removeClass('custom_has_err');
        }

        if(cod_money == '' && shipping_type == 'cod'){
            $('#money_cod').addClass('custom_has_err');
            $('#money_cod').attr("placeholder", "โปรดกรอกจำนวนเงินที่เก็บ");
        }else{
            $('#money_cod').removeClass('custom_has_err');
            $('#money_cod').attr("placeholder", "");
        }

    }


    else{
        $(':input').removeClass('custom_has_err');
        $(':input').attr("placeholder", "");
    }

    return result;
}

function getHistory(type = null, pointer_index = null){

    var phone_number = '';
    var command = '';
    var class_name = '';
    var sub_class_name = '';
    var url = '';
    if(type == 'sender'){
        $('.section[data-index="'+pointer_index+'"]').find('.sender-suggest').html('');
        phone_number = $('.section[data-index="'+pointer_index+'"]').find(".sender_phone").val();
        command = 'get_sender';
        class_name = $('.section[data-index="'+pointer_index+'"]').find('.sender-suggest');
        sub_class_name = 'sender_history';
        url = 'manage_sender.php';
    }
    else if(type == 'receiver'){
        $('.section[data-index="'+pointer_index+'"]').find('.receiver-suggest').html('');
        phone_number = $('.section[data-index="'+pointer_index+'"]').find(".phone_number").val();
        command = 'get_receiver';
        class_name = $('.section[data-index="'+pointer_index+'"]').find('.receiver-suggest');
        sub_class_name = 'receiver_history';
        url = 'manage_receiver.php';
    }
    else if(type == 'customer'){
        $('.customer-suggest').html('');
        phone_number = $("#customer_phone_number").val();
        command = 'get_customer';
        class_name = $('.customer-suggest');
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
                

                class_name.html(html);
            }
        },
        error: function() {
            console.log("error");
        }
    });
}

function getPrice(pointer_index) {
    var price = "", weight = "";
    if($('#shipping_type'+pointer_index+' option:selected').val() == 'normal') {
        weight = $('#weight'+pointer_index).val();
        price = weight * 10;
    } else if($('#shipping_type'+pointer_index+' option:selected').val() == 'cod') {
        weight = $('#weight'+pointer_index).val();
        price = weight * 10;
    }
    $('#price'+pointer_index).val(price.toFixed(2));
}

function sumPrice(mode = '') {
 var total = 0;
 console.log('Start', total);
 $('#order_list tr').each(function(){
    $(this).find('.price').each(function(){
        var this_price = Number(parseFloat($(this).html()).toFixed(2));
        total = total+this_price;
    })
})
 $('#sum_price').html(NumberFormat(total));

 return total.toFixed(2);
}

function makeid(length, type) {
 var result           = '';
 var characters       = ['0123456789', 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'];
 var charactersLength = characters[type].length;
 for ( var i = 0; i < length; i++ ) {
  result += characters[type].charAt(Math.floor(Math.random() * charactersLength));
}
return result;
}
