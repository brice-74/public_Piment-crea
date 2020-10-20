$(function(){
	$('.selectMultiple').on('click',function(e){
		$(this).attr('tabindex','1').focus().css({'outline':'none'});
	})
	$('.selectMultiple').on('blur',function(e){
		const idTuto = $(this).parents('[ajax=tuto]').attr('data');
		options = $(this).find('option');
		vals = [];
		options.each(function(){
			if($(this).prop('selected')){
				vals.push($(this).val()+'/selected');
			}else{
				vals.push($(this).val());
			}
		})
		vals = vals.join(',');

		$.ajax({
			type:'post',
			url: 'update-tvc-tuto',
			data: { cat:vals , id_tuto:idTuto },
			success: function(datas){
				tab = JSON.parse(datas);

				if(tab['flash'] != undefined){
					$('.body').prepend(tab['flash']);
				}	
				if($(document).find('.feedback')){
					let feed = $('.feedback');
					setTimeout(function(){
						$(feed).css({"top":"-20px",});
					},400)
					$(feed).click(function(){
						$(feed).css({"top":"-70px",});
						setTimeout(function(){
							$(feed).remove();
						},350)
					})
					if($(document).find('.feedback.timeout')){
						let feedTime = $(".feedback.timeout");
						setTimeout(function(){
							$(feedTime).css({"top":"-70px",});
							setTimeout(function(){
								$(feedTime).remove();
							},350)
						},5000)
					}
				}
				
			}
		})
	});
});