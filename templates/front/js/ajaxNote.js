$(function(){
	$('[ajax=note] > button').click(function(){
		$('[ajax=note] > button').removeAttr('clicked');
		$(this).attr('clicked','');
		const note = $(this).attr('val');
		const idTuto = $('[ajax=note]').attr('datas');

		$.ajax({
			type:'post',
			url: 'ajout-note',
			data: { tuto:idTuto , note:note },
			success: function(datas){
				tab = JSON.parse(datas);

				if(tab['val_note'] != undefined){

					if(tab['moy'] != undefined){
						if($('[moynote]').children('p').text() == 'Aucune note'){
							const p1 = $('<p />').addClass('cGris txt12 mAuto').text('Note');
							const p2 = $('<p />').addClass('mAuto ml10 txt14 cBleu bold').text(tab['moy']);
							const p3 = $('<p />').addClass('cGris txt12 mAuto').text('/10');
							const div = $('<div />').addClass('mAuto flex');
							$('[moynote]').fadeOut(300,function(){
								$(this).children('p').remove();
								$(this).append(div.append(p1).append(p2).append(p3));
								$(this).fadeIn(300);
							});
						}else{
							$('[moynote] p:nth-child(2)').fadeOut(300,function(){
								$(this).text(tab['moy']).fadeIn(300);
							});
							
						}
					}
					
					if($('[txtnote]').children('p').text() != 'Tutoriel noté'){
						$('[txtnote]').children('p').fadeOut(300,function(){
							const parent = $(this).parent('[txtnote]');
							$(this).remove();
							const newp = $('<p />').addClass('alignCenter cGris mb10').text('Tutoriel noté');
							newp.appendTo(parent).hide().fadeIn(300);
						})
					}
					setTimeout(function(){
						$('[val]').removeAttr('selected');
						$('[ajax=note]').find('[val='+tab['val_note']+']').attr('selected','');
					},300)
				
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
	});
});