
$(document).ready(function(){
	//временная функция обработки ajax
	$('[name=button]').bind('click', function(){
		var params = $(this).parent('form').serialize();
		var url = $('form[name=user_login_form]').attr('action');
		ajax_form(params, url);
	});

	function call1(){
		alert('вызов прошел');
	};

	function ajax_form(params, url){
		params = params+'&json=true';
		$.ajax({
			type: 'post',
			url: url,
			json: true,
			data: params,
			success: function(data){
				alert(data); return;
				var j_data = jQuery.parseJSON(data);
				//alert(j_data.statusMessages.target);
				if(j_data.statusMessages.length>0){
					$(j_data.statusMessages).each(function(ind, statusMessage){
						if($('input[name='+statusMessage.target+']')){
							$('input[name='+statusMessage.target+']').after('<label class='+statusMessage.type+'>'+statusMessage.message+'</label>')
						}else{
							//иначе вызываем диалоговое окно и показываем сообщение
							alert(statusMessage.message);
						}
					});
				}
			},
			error: function(xhr, str){
				alert('Произошла ошибка:'+xhr.responseCode);
			} 
		})
		
		//var form_inputs = $(obj).serialize();
		
		/*$.ajax({

		});*/

	};
});


