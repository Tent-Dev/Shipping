
$(document).ready(function() {
	
    var form_clone = $('#form-section .section:first').clone();
    var sectionsCount = 1;

    $('body').on('click', '.addsection', function() {
        sectionsCount++;

        var section = form_clone.clone().find(':input').each(function(){
            var newId = this.id + sectionsCount;
            $(this).prev().attr('for', newId);
            this.id = newId;
            $(this).closest('.section').attr('data-index', sectionsCount);
        }).end().appendTo('#form-section');

        return false;
    });

    $('#form-section').on('click', '.remove', function() {
        $(this).parent().fadeOut(300, function(){
            $(this).parent().remove();
            return false;
        });
        return false;
    });

    $('.btn_save').click(function(event) {
        getAllData();
    });

});

function getAllData(){
    var checkvalue = true;
    var data_obj = {};
    var data_items = [];

    $('.section').each(function (index, ele) {
        var pointer_index = $(this).closest('.section').data('index');
        var item_obj = {};
        var receiver_obj = {};
        var sender_obj = {};
        if(pointer_index == 1){
            pointer_index = ''
        }

        var s_phone = $(ele).find('#sender_phone'+pointer_index).val();
        var s_fname = $(ele).find('#s_fname'+pointer_index).val();
        var s_lname = $(ele).find('#s_lname'+pointer_index).val();
        var s_address = $(ele).find('#s_address'+pointer_index).val();
        var s_district = $(ele).find('#s_district'+pointer_index).val();
        var s_area = $(ele).find('#s_area'+pointer_index).val();
        var s_province = $(ele).find('#s_province'+pointer_index).val();
        var s_postcode = $(ele).find('#s_postcode'+pointer_index).val();

        var r_phone = $(ele).find('#phone_number'+pointer_index).val();
        var r_fname = $(ele).find('#r_fname'+pointer_index).val();
        var r_lname = $(ele).find('#r_lname'+pointer_index).val();
        var r_address = $(ele).find('#r_address'+pointer_index).val();
        var r_district = $(ele).find('#r_district'+pointer_index).val();
        var r_area = $(ele).find('#r_area'+pointer_index).val();
        var r_province = $(ele).find('#r_province'+pointer_index).val();
        var r_postcode = $(ele).find('#r_postcode'+pointer_index).val();

        var weight = $(ele).find('#weight'+pointer_index).val();
        var price = $(ele).find('#price'+pointer_index).val();
        var shipping_type = $(ele).find('#shipping_type'+pointer_index).val();

        console.log('--------------------data['+index+']-----------------------');
        console.log('ele sen-->', s_phone, s_fname, s_lname,s_address, s_district, s_area, s_province, s_postcode);
        console.log('ele recev-->', r_phone, r_fname, r_lname, r_address, r_district, r_area, r_province, r_postcode);
        console.log('ele etc-->', weight, price, shipping_type);
        console.log('-------------------------------------------');

        if(!validateCreate(pointer_index)){
            checkvalue = false;
        }else{
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

            item_obj.weight = weight;
            item_obj.price = price;
            item_obj.shipping_type = 'normal';
            item_obj.payment_type  = shipping_type;

            item_obj.receiver_desc = receiver_obj;
            item_obj.sender_desc = sender_obj;

            data_items.push(item_obj);
        }
    });

    if(checkvalue){
        var id_card = $("#id_card").val();
        var c_fname = $("#firstname").val();
        var c_lname = $("#lastname").val();
        var c_phone_number = $("#customer_phone_number").val();

        data_obj.firstname = c_fname;
        data_obj.lastname = c_lname;
        data_obj.id_card = id_card;
        data_obj.customer_phone_number = c_phone_number;
        data_obj.item = data_items;

        console.log('Data:: ',data_obj);

    }
}

function validateCreate(pointer_index){
    var result = true;
    var id_card = $("#id_card").val();
    var firstname = $("#firstname").val();
    var lastname = $("#lastname").val();
    var c_phone_number = $("#customer_phone_number").val();

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
            //$("#shipping_type").attr("placeholder", "โปรดกรอกรหัสผ่าน");
        }else{
            $('#shipping_type'+pointer_index).removeClass('custom_has_err');
            //$("#shipping_type").attr("placeholder", "");
        }

    }else{
        $(':input').removeClass('custom_has_err');
    }

    return result;
}