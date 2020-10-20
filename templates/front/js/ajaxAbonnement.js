$(function(){
	$('[ajax=abonnement]').on('click',function(){
		const id_chaine = $(this).attr("datas");
		$.ajax({
			type:'POST',
			url: 'traitement-abonnement',
			data:{ idChaine:id_chaine },
			success: function(datas){
				tab = JSON.parse(datas);

				if(tab['addAbo'] != undefined){
					$('[ajax=abonnement]').fadeOut(100,function(){
						$(this).addClass('btnNo').removeClass('btnO').attr('title','Se désabonner à la chaine '+tab['addAbo'][1]);
						$(this).children('p').text('Abonné');
						$(this).fadeIn(100);
					});
				}

				if(tab['removeAbo'] != undefined){
					$('[ajax=abonnement]').fadeOut(100,function(){
						$(this).addClass('btnO').removeClass('btnNo').attr('title','S\'abonner à la chaine '+tab['removeAbo'][1]);
						$(this).children('p').text('S\'Abonné');
						$(this).fadeIn(1000);
					});
				}

				if(tab['nbAbo'] != undefined){
					if(tab['nbAbo']['nbAbo'] > 1){
						$('.nbAbo').text(tab['nbAbo']['nbAbo']+' abonnés / ');
					}else{
						$('.nbAbo').text(tab['nbAbo']['nbAbo']+' abonné / ');
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