$(function(){
	$('[ajax=tuto] input[name=titre_tuto]').blur(function(){
		const titre = $(this).val();
		const idTuto = $(this).parents('[ajax=tuto]').attr('data');

		$.ajax({
			type:'post', 
			url: 'update-tvc-tuto',
			data: 'titre='+titre +'&id_tuto='+ idTuto,
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
		});
	});
});