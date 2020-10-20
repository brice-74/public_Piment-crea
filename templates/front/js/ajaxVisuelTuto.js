$(function(){
	$('[ajax=tuto] input[name=visuel_tuto]').change(function(){
		$('.errorTuto').fadeOut(250,function(){
			$(this).remove();
		});
		const idTuto = $(this).parents('[ajax=tuto]').attr('data');
		var formData = new FormData();
		formData.append("id_tuto", idTuto);
		formData.append("file", this.files[0]);

		let go = true;
		if(this.files[0] !== undefined){
			if(this.files[0].type != 'image/jpeg' && this.files[0].type != 'image/png'){
				const error = '<span class="txt12 bold">- Veuillez choisir un fichier .jpg ou .png</span>';
				errorImg(error);
				go = false;
			}
			if(this.files[0].size > 2000000){
				const error = '<span class="txt12 bold">- Veuillez choisir un fichier inférieur à 2Mo</span>';
				errorImg(error);
				go = false;
			}
		}

		function errorImg(msg){
			const div = $('<div />').addClass('errorTuto').append(msg);
			const ta = $('[name=visuel_tuto]').parent();
			$(div).appendTo(ta).hide().fadeIn(300);
		}
		

		if(go){
			$.ajax({
				type:'post',
				url: 'update-tvc-tuto',
				data: formData,
				cache:false,
				processData: false,
	    		contentType: false,
				success: function(datas){
					var tab = JSON.parse(datas);

					if(tab['visu'] != undefined && tab['id_tuto'] != undefined && tab['id_chaine'] != undefined){

						let img = $('.imgVisuTuto');
						if(img.length == 0){
							image = $('<img class="mAuto imgVisuTuto">');
							div = $('<div class="flex pt40"></div>').append(image);
							$('.image-tuto').append(div);
							image.attr('src','medias/chaine/id-'+tab['id_chaine']+'/tuto-'+tab['id_tuto']+'/'+tab["visu"]);
							image.fadeIn(500);
						}else{
							img.fadeOut(500,function(){
								image = $(this);
								image.attr('src','medias/chaine/id-'+tab['id_chaine']+'/tuto-'+tab['id_tuto']+'/'+tab["visu"]);
								setTimeout(function(){
									image.fadeIn(500);
								},200);
								
							});
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
		}
	});
});