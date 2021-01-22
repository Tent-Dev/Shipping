var startdate = "", enddate = "", keyword = "";

$(document).ready(function() {
    getDataFromDB();

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
        filterAll();
    });

    $('#filter_date').on('cancel.daterangepicker', function(ev, picker) {
        $('#filter_date').val('');
        startdate = "";
        enddate = "";
        filterAll();
    });

    $('#search').keyup(delay(function(e){
        keyword = $(this).val();
        filterAll();
    }, 300));
});

function filterAll(startdate, enddate, keyword) {
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

function getDataFromDB(page = 1) {
    $('.table_wrap_loading_box').show();
    $('.table').html('');
    $.ajax({
        url: '../api/function/manage_transaction.php',
        method: 'post',
        data: {
            command: 'get_transaction',
            page: page,
            startdate: startdate,
            enddate: enddate,
            keyword: keyword,
            group: 1
        },
        success: function(data) {
            var data = JSON.parse(data);
            console.log("result: ",data);

            if(data.status == 200){
                var header = '';
                var html = "";
                if(data.data.data.length > 0){
                    header +='<thead>';
                    header +=    '<tr>';
                    header +=        '<th>No.</th>';
                    header +=        '<th>รหัสทำรายการ</th>';
                    header +=        '<th>ชื่อผู้ทำรายการ</th>';
                    header +=        '<th>พนง.ทำรายการ</th>';
                    header +=        '<th width="120px">ดูข้อมูลรายการ</th>';
                    header +=    '</tr>';
                    header +='</thead>';
                    header +='<tbody id="show_data_from_db">';
                    header +='</tbody>';
                    $('.table').html(header);
                    $.each(data.data.data, function(index, val) {
                        html += '<tr>'+
                                '<td>'+(index+1)+'</td>'+
                                '<td>'+val.transaction_id+'</td>'+
                                '<td>'+val.customer_firstname+' '+val.customer_lastname+'</td>'+
                                '<td>'+val.employee_fname+' '+val.employee_lname+'</td>'+
                                '<td align="center">'+
                                '<a href="transaction_history.php?transaction_id='+val.transaction_id+'"><button class="btn_edit btn btn-sm btn-success mr-2"><i class="fas fa-search"></i></button></a>'+
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