$(document).ready(function() {

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