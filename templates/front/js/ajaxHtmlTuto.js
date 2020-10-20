$(function(){
	time = 6000;
	$(document).on('blur','div[contenteditable]',function(){
		time = 0;
		timer(time);
	});
	function timer(time){
		setTimeout(function(){
			const html = $('#zoneMore').html();
			const id_tuto = $('#zoneMore').attr('data');

			$.ajax({
				type:'post', 
				url: 'update-html-tuto',
				data: { id_tuto:id_tuto , html:html },
				success: function(datas){
					tab = JSON.parse(datas);		
					//$('.body').append(datas);

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
			time = 6000;
			timer(time);
		}, time);
	}
	timer(6000);
	
});