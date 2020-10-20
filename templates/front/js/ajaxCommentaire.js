$(function(){
		$('div[contenteditable]').on('keyup',function(event){
			
		if($(this).children().length == 0){
			$(this).wrapInner('<p />');
		}else{
			$(this.innerText).wrap('<p />');
		}

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



	let clicks = 0;
    $(document).on("click",'.suppC', function(e){
        	let ParentCom = $(this).parents('[id*="commentaire-"]');

        clicks++;
        setTimeout(function() {
	        if(clicks === 1) {
	        	let msgOnElement 	= $('<p />').addClass('msgOnElement').text('Double\u0020click\u0020pour\u0020supprimer');

				msgOnElement.appendTo(ParentCom).hide().fadeIn(100, function(){
					setTimeout(function(){
						msgOnElement.fadeOut(500,function(){
							msgOnElement.remove();
						});
					},1500)
				})
				clicks = 0;
	        }else{
				if(ParentCom.find('.msgOnElement')){
					$('.msgOnElement').remove();
	        	}
	         clicks = 0;
	        }
        }, 200);
    })
    $(document).on("dblclick",".suppC", function(e){
    	  let IdCom = $(this).parents('[id*="commentaire-"]').attr("id").replace('commentaire-','');

     	   $.ajax({
				type:'POST',
				url: 'traitement-commentaire',
				data:{ id_com:IdCom },
				success: function(datas){
					tab = JSON.parse(datas);

					if(tab['count_com'] != undefined){
						if(tab['count_com']['nb_com'] > 1){
							var countTxt = tab['count_com']['nb_com']+' commentaires';
						}else{
							var countTxt = tab['count_com']['nb_com']+' commentaire';
						}
						$('p[count-com]').html(countTxt);
					}

					if(tab['RemoveCom'] != undefined){
						let com = $('[id='+tab['RemoveCom']+']');
						let newDiv = $('<div />').attr('tempoDiv',true);
						com.wrap(newDiv);
						const tmpDiv = $('[tempoDiv]');

						tmpDiv.height(tmpDiv.height());
						com.css({'padding-left':'30px'});
						com.animate({
							'opacity':0,
						},750,function(){
							$(this).remove();
							tmpDiv.animate({
								'height':0,
							},750,function(){
								$(this).remove();
							});
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
    });



	let pEdit = $('[editCom]');
	$('[annulCom]').click(function(){
		pEdit.children().fadeOut(100,function(){
			$(this).remove();
		})
	});

	let click = 0;
	$('[postCom]').click(function(){
		let postCom = $(this);
		click++;

		let value = pEdit.html();
		let id = postCom.parents('[ajax=commentaire]').attr('datas');		

		if(click == 1){
			$.ajax({
				type:'POST',
				url: 'traitement-commentaire',
				data:{ contenu:value , visuel:id },
				success: function(datas){
					tab = JSON.parse(datas);

					pEdit.children().remove();

					if(tab['count_com'] != undefined){
						if(tab['count_com']['nb_com'] > 1){
							var countTxt = tab['count_com']['nb_com']+' commentaires';
						}else{
							var countTxt = tab['count_com']['nb_com']+' commentaire';
						}
						$('p[count-com]').html(countTxt);
					}

					if(tab['commentaire'] != undefined){
						const div1_1 = $('<div />').addClass('signalCom').append($('<button />').addClass('suppC s2 mAuto0 ml10').attr('title','supprimer le commentaire').append('<svg version="1.1" viewBox="0 0 25 25" xml:space="preserve"><g><path class="st0" d="M21.8,4.8h-4.1V3.5c0-1.1-0.9-1.9-1.9-1.9H9.3c-1.1,0-1.9,0.9-1.9,1.9v1.4H3.2c-0.8,0-1.4,0.6-1.4,1.4c0,0.8,0.6,1.4,1.4,1.4H4l1.3,14.6c0.1,1,1,1.8,1.9,1.8h10.5c1,0,1.8-0.8,1.9-1.8L21,7.6h0.8c0.8,0,1.4-0.6,1.4-1.4C23.1,5.4,22.5,4.8,21.8,4.8z M10.1,4.8V4.2h4.8v0.6H10.1z M18.2,7.6L17,21.2H8L6.8,7.6H18.2z"/></svg>'));
						const div1_2 = $('<div />').addClass('flex mb5').append($('<div />').addClass('p0 container-avatar-min2 mr10').attr('style','background-image:url('+tab['commentaire']['avatar_user']+')')).append($('<div />').append($('<p />').addClass('txt12 bold').html(tab['commentaire']['nom_user']+' '+tab['commentaire']['prenom_user'])).append($('<p />').addClass('txt12 cGris').html('À l\'instant')));
						const div1_3 = $('<div />').addClass('ml42 pr55').append($('<p />').html(tab['commentaire']['contenu_commentaire']));
						const div1 = $('<div />').attr('id','commentaire-'+tab['commentaire']['id_commentaire']).append(div1_1).append(div1_2).append(div1_3).hide();
						$('.commentList').prepend(div1.fadeIn(300));
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
		}
		click = 0;
	});

});