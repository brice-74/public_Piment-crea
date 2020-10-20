$(function(){
	$('[editSig]').on('keyup',function(event){
		setTimeout(function(){
			$(this.innerText).wrap('<p />');
		},100)
		

		/*if($(this).children().length == 0){
			const txt = this.childNodes;
			$(txt).wrap('<p />');
		}*/

		let editable = $(this);
		const div = editable.find('div');
		elements = [div];
		replaceHtml($(elements));
		function replaceHtml(elements){
			elements.each(function(){
				if(this.length > 0){
					this.each(function(){
						const inner = $(this).html();
						const newp = $('<p />').append(inner);
						$(this).wrap(newp);
						$(this).remove();
					});
				}
			});
		}
	});

	$(document).on('click','[modale="btn-signal"]',function(){
		let datas = $(this).attr('datas');
		$('#modale-signal').attr('datas',datas);
	});

	$(document).on('click','#modale-signal .retour1',function(){
		$('#modale-signal').attr('datas','no');
		$('[editSig]').html('');
	});

	$(document).on('click','[subSig]',function(){
		let datas = $(this).parents('#modale-signal').attr('datas');
		let comment = $(this).parents('#modale-signal').find('[editSig]').html();

	 	$.ajax({
			type:'POST',
			url: window.origin+'/traitement-signal',
			data:{ datas:datas , comment:comment},
			success: function(datas){
				tab = JSON.parse(datas);
				//$('body').append(datas);

				if(tab['success'] != undefined){
					$('#modale-signal').fadeOut(300,function(){
						$(this).removeClass('open');
						$(this).attr('datas','no');
						$('[editSig]').html('');
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
		});
	})

});