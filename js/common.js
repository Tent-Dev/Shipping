var thispage_is;
function pagination(page, total_pages){

	if(thispage_is == undefined){
		thispage_is = 1;
	}

	html = '';

	html += 
	'<nav aria-label="Page navigation">'+
		'<ul class="pagination pagination-sm justify-content-center">';
		if(page !=1){
			html +=		'<li class="page-item">'+
				'<a class="page-link pre_value" href="#" aria-label="Previous">'+
					'<span aria-hidden="true">&laquo;</span>'+
				'</a>'+
			'</li>';
		}
			for (var i = 1; i <= total_pages; i++) {
				active = '';
				if(page == i){
					active = ' active';
				}
				html += '<li class="page-item'+active+'"><a class="to_page page-link" href="#" data-page="'+i+'">'+i+'</a></li>';
			}
			if(page != total_pages){
				html +=		'<a class="page-link next_value" href="#" aria-label="Next">'+
								'<span aria-hidden="true">&raquo;</span>'+
							'</a>';
			}
	html +=		'</li>'+
		'</ul>'+
	'</nav>';

	$('.main_pagination').html(html);

	$('.to_page').click(function(e){
		e.preventDefault();
		var current_page = $(this).data('page');
		thispage_is = $(this).data('page');
		$('#show_data_from_db').empty();
		getDataFromDB(current_page);
	});

	$('.next_value').click(function(e){
		e.preventDefault();
		var num_next_page = thispage_is;
		++num_next_page;
		if(total_pages>=(num_next_page)) {
			$('#show_data_from_db').empty();
			getDataFromDB(++thispage_is);
		}
	});

	$('.pre_value').click(function(e){
  		e.preventDefault();
  		var num_preveious_page = thispage_is;
  		--num_preveious_page;
  		if(num_preveious_page != 0) {
			$('#show_data_from_db').empty();
			getDataFromDB(--thispage_is);
		}
	});
}

function showErrorAjax(text = ''){
	if(text == ''){
		text = 'ไม่สามารถเชื่อมต่อฐานข้อมูลได้';
	}
    var header = '';
    header +='<div class="table_wrap_empty">';
    header +='  <div class="text-center">';
    header +='      <div>'+text+'</div>';
    header +='      <div><i class="fas fa-times"></i></div>';
    header +='  </div>';
    header +='</div>';
    $('.main_pagination').html('');
    $('.table').html(header);
    $('.table_wrap_loading_box').hide();
    $('.table').show();
}