var keyword = "";

$(document).ready(function() {
    getDataFromDB(1, keyword);

    $('#search').keyup(delay(function(e){
        keyword = $(this).val();
        filterAll(keyword);
    }, 300));
});

function filterAll(keyword) {
    $('#show_data_from_db').empty();
    getDataFromDB(1, keyword);
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
            command: 'get_transactionHistory',
            page: page,
            transaction_id: trans_id,
            keyword: keyword,
            receiver: 1
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
                    header +=        '<th>เลขพัสดุ</th>';
                    header +=        '<th>ชื่อผู้รับ</th>';
                    header +=        '<th width="120px">พิมพ์ใบปะหน้า</th>';
                    header +=    '</tr>';
                    header +='</thead>';
                    header +='<tbody id="show_data_from_db">';
                    header +='</tbody>';
                    $('.table').html(header);
                    $.each(data.data.data, function(index, val) {
                        var null_class = '';
                        var null_class_row = '';
                        if(val.active_status == 'F'){
                            null_class = 'cancel';
                            null_class_row = 'cancel_row';
                        }else{

                        }

                        html += '<tr class="'+null_class_row+'">'+
                        '<td>'+(index+1)+'</td>'+
                        '<td>'+val.tracking_code+'</td>'+
                        '<td>'+val.receiver_desc.firstname+' '+val.receiver_desc.lastname+'</td>'+
                        '<td align="center" class="'+null_class+'">';
                        if(val.active_status == 'F'){
                            html += 'ถูกยกเลิก&nbsp;<i class="fas fa-exclamation-circle"></i>';
                        }else{
                            html += '<a href="item_label.php?tracking_code='+val.tracking_code+'" target="_blank"><button class="btn_edit btn btn-sm btn-success mr-2"><i class="fas fa-print"></i></button></a>';
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