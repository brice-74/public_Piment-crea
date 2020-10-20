$(function(){
	$(document).on('click','[ajax=like]',function(){
		let target = $(this);
		let counter = $(this).children('[count-like]');
		const value = $(this).attr('datas');
		$.ajax({
			type:'POST',
			url:'post-like',
			data:{ likePost:value },
			success: function(datas){
				tab = JSON.parse(datas);

				
				if(tab['PostLike'] != undefined){
					if(tab['PostLike'] == 'addPost'){
						$(target).addClass('liked');
					}else{
						$(target).removeClass('liked');
					}
				}
				if(tab['CountLike'] != undefined){
					$(counter).fadeOut(250, function(){
						$(counter).html(tab['CountLike']);
						$(counter).fadeIn(150);
					});
				}

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