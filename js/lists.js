$(document).ready(function() {
	get_productlist();
});

function get_productlist(){
	$.ajax({
		url: '../api/function/manage_product.php',
		method: 'post',
		data: {
			command: 'get_product'
		},
		success: function(data) {
			var data = JSON.parse(data)
			console.log("result: ",data);

			if(data.status == 200){
				var html = "";
				var num = 1;
				$.each(data.data, function(index, val) {
					html += '<tr>'+
	                            '<td>'+num+'</td>'+
	                            '<td>'+val.create_date+'</td>'+
	                            '<td>'+val.tracking_code+'</td>'+
	                            '<td>name</td>'+
	                            '<td>'+val.status+'</td>'+
	                            '<td>'+
	                                '<button class="btn btn-sm btn-warning mr-2" data-toggle="modal" data-id="'+val.id+'" data-target="#editData"><i class="fas fa-edit"></i></button>'+
	                                '<button class="btn btn-sm btn-danger" data-id="'+val.id+'"><i class="fas fa-trash"></i></button>'+
	                            '</td>'+
	                        '</tr>';
	                num++;
				});
			}

			$('#query_product').append(html);
		},
		error: function() {
			console.log("error");
		}
	});
};