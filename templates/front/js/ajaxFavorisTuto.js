$(function(){
	$(document).on('click','[ajax=favorisTuto]',function(){
		let target = $(this);
		let ptxt = $(this).children('[txt-fav]');
		const value = $(this).attr('datas');

		$.ajax({
			type:'POST',
			url: 'ajout-favoris-tuto',
			data:{ favorisPost:value },
			success: function(datas){
				tab = JSON.parse(datas);

				if(tab['PostFavoris'] != undefined){
					if(tab['PostFavoris'] == 'addFav'){
						$(target).addClass('favorited');
						$(target).attr('title','Retirer des favoris');
						$(ptxt).fadeOut(250,function(){
							$(ptxt).html('Retirer&nbspdes&nbspfavoris');
							$(ptxt).fadeIn(150);
						});
					}else{
						$(target).removeClass('favorited');
						$(target).attr('title','Ajouter aux favoris');
						$(ptxt).fadeOut(250,function(){
							$(ptxt).html('Ajouter&nbspaux&nbspfavoris');
							$(ptxt).fadeIn(150);
						});
						if(window.location.pathname == '/favoris'){
							target.parents('.container-bloc').animate({
								'width':'0',
								'opacity':'0'
							},500,function(){
								parent = $(this).parent();
								this.remove();
								console.log(parent);
								if($(parent).children().length == 0){
									pno = $('<p />').addClass('cGris mAuto').html('Aucun Favoris');
									pno.appendTo(parent).hide().fadeIn(300);
								}
							})
						}
					}
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