var startdate = '', enddate = '';
$(document).ready(function() {
	getProduct();
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
        //filterAll();
    });

    $('#filter_date').on('cancel.daterangepicker', function(ev, picker) {
        $('#filter_date').val('');
        startdate = "";
        enddate = "";
        //filterAll();
    });
});


function getProduct(page = 1, mode = ''){

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
            ignore_pagination: true
        },
        success: function(data) {
            var data = JSON.parse(data)
            console.log("result: ",data);

            if(data.status == 200){
                if(data.data.data.length > 0){
                   
                }else{
                   
                }
            }
            else if(data.status == 404){

            }
            else{

            }

        },
        error: function() {
            console.log("error");
        }
    });
};