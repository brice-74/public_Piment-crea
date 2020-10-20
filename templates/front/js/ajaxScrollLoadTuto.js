var $offset = 1;
var eventStop = false;

$(document).scroll(function(e){
	let defilement = $(window).scrollTop();
	let fenetre = $(window).height();
	let doc = $(document).height()-150;
	if(eventStop == false){
		if(defilement + fenetre >= doc){
			eventStop = true;
			let zone = $("#myapp");

			let loader = $('<div />').addClass('LoaderBalls').append($('<div />'));
			for (var i = 0; i < 3; i++) {
				loader.children('div').append($('<div />').addClass('LoaderBalls__item'));
			}
			loader.appendTo(zone).hide().fadeIn(500);

			let formData = new FormData();
		   formData.append('offset', $offset);

		   arr = [];
	   	const finder = $('select[multiple]').find('[selected]');
	   	if(finder.length > 0){
	   		finder.each(function(){
		   		arr.push($(this).val());
		   	})
	   	}

			formData.append('select', arr);	   
		   

			$.ajax({
				type:'post', 
				url: 'next-actifs-tuto',
				data: formData,
				processData: false,
		    	contentType: false,
				success: function(datas){/*$('body').append(datas);console.log(datas);*/
					tab = JSON.parse(datas);/*$('body').append(tab);console.log(tab);*/
					if($.isArray(tab['tuto'])){
						let nb = 0;
						const url = window.location.origin+"/";

						$(tab['tuto']).each(function(){
							var correspondance = false;

							$(document).find('[ajax=favorisTuto]').each(function(){
								if($(this).attr('datas').replace(/[-a-z]+/,'') == tab['tuto'][nb][0]){
									correspondance = true;
								}
							})

							if(correspondance == false){
								const idTuto = tab['tuto'][nb][0];
								const titreTuto = tab['tuto'][nb][1];
								const visuTuto = tab['tuto'][nb][2];
								const dateTuto = tab['tuto'][nb][5];

								const idChaine = tab['tuto'][nb]['id_chaine'];
								const nomChaine = tab['tuto'][nb]['nom_chaine'];
								var avatarChaine = tab['tuto'][nb]['avatar_chaine'];
								if(avatarChaine == null){
									avatarChaine = 'templates/front/img/piment.jpg';
								}else{
									avatarChaine = 'medias/chaine/id-'+idChaine+'/avatars/'+avatarChaine;
								}

								fav = '';
								titleFav = 'Ajouter&nbspaux&nbspfavoris';

								if(tab['note'][nb] != null){
									note = `<div class="mAuto flex">
												<p class="mAuto ml10 txt14 cBleu bold">${tab['note'][nb][0]}</p>
												<p class="cGris txt12 mAuto">/10</p>			
											</div>`;
								}else{
									note = '';
								}

								if(tab['user'] != null){
									const user = tab['user'];
									
									if(tab['favoris'][nb] != null){
										const favIdUser = tab['favoris'][nb][1];
										if(user == favIdUser){
											fav = 'favorited';
											titleFav = 'Retirer&nbspdes&nbspfavoris';
										}
									}
									
								}
								visu = $('<div />').addClass('container-bloc p10 dpIB').html(`
									<div class="container-visuels posR">
									 	<a class="p0" href="${url}tuto-${idTuto}-${titreTuto}"
									 		style="background-image:url(medias/chaine/id-${idChaine}/tuto-${idTuto}/min-${visuTuto}" 
									 	>
											<img class="img-visuel" src="medias/chaine/id-${idChaine}/tuto-${idTuto}/min-${visuTuto}">
										</a>
										<a href="${url}tuto-${idTuto}-${titreTuto}" class="titreTuto bgDeg">
											<div class="flex pl10 pr10 pt20 mb10 cutBox2">
												<p class="mb0 cWhite">${titreTuto}</p>
											</div>
										</a>
									</div>
									<div class="flex pb5 pt5">
											<a href="chaine-${idChaine}-${nomChaine}/tutos" class="p0 container-avatar-min posR t0 l0"
													style="background-image:url(${avatarChaine});"
											>
												<img class="img-visuel mb5" src="${avatarChaine}"alt="Image de chaine">
											</a>
										<div class="mAuto0 ml10 cutBox1">
											<p class="mb0 bold">${nomChaine}</p>
											<p class="txt12 cGris mb0">${dateTuto}</p>
										</div>
										<div class="mt5 mlAuto">
											${note}
										</div>
										<div class="posR">
											<button class="point3">
												<svg version="1.1" viewBox="0 0 3 25" xml:space="preserve">
													<g>
														<circle class="st0" cx="2.5" cy="2.5" r="2.5"/>
														<circle class="st0" cx="2.5" cy="11.5" r="2.5"/>
														<circle class="st0" cx="2.5" cy="20.6" r="2.5"/>
													</g>
												</svg>
											</button>
											<div class="optionPost">
											<button class="fav flex ${fav}" title="${titleFav}"
												ajax="favoris" datas="${idTuto}"
											>
												<svg class="ml5" version="1.1" viewBox="0 0 25 25" xml:space="preserve">
													<g>
														<g>
															<g>
																<path class="st0" d="M5.6,24.5c-0.3,0-0.5-0.1-0.7-0.2c-0.4-0.3-0.6-0.7-0.5-1.2l1.2-7l-5.1-5C0.1,10.7,0,10.2,0.2,9.8
																	C0.3,9.3,0.7,9,1.2,9l7.1-1l3.2-6.4c0.2-0.4,0.6-0.7,1.1-0.7c0.5,0,0.9,0.3,1.1,0.7l3.2,6.4l7.1,1c0.5,0.1,0.8,0.4,1,0.8
																	c0.1,0.4,0,0.9-0.3,1.3l-5.1,5l1.2,7c0.1,0.5-0.1,0.9-0.5,1.2c-0.4,0.3-0.9,0.3-1.3,0.1l-6.3-3.3l-6.3,3.3
																	C6,24.5,5.8,24.5,5.6,24.5z M12.5,18.4c0.2,0,0.4,0,0.6,0.1l4.7,2.5l-0.9-5.2c-0.1-0.4,0.1-0.8,0.4-1.1L21,11l-5.2-0.8
																	c-0.4-0.1-0.7-0.3-0.9-0.7l-2.3-4.8l-2.3,4.8C10,10,9.6,10.2,9.2,10.3L4,11l3.8,3.7c0.3,0.3,0.4,0.7,0.4,1.1l-0.9,5.2l4.7-2.5
																	C12.1,18.5,12.3,18.4,12.5,18.4z"/>
															</g>
														</g>
													</g>
												</svg>
												<p txt-fav class="cWhite txt12 ml10 mr10 mbAuto mtAuto">${titleFav}</p>
											</button>
											<button class="sig flex" title="signaler un abus" modale="btn-signal" datas="visuel-${idTuto}">
												<svg class="ml5" version="1.1" viewBox="0 0 25 25" xml:space="preserve">
													<g>
														<g>
															<path class="st0" d="M7,23c-0.7,0-1.3-0.6-1.3-1.3V3.9c0-0.7,0.6-1.3,1.3-1.3s1.3,0.6,1.3,1.3v17.8C8.3,22.4,7.7,23,7,23z"/>
														</g>
														<g>
															<path class="st0" d="M18.8,16c-1,0-2.4-0.2-4-1c-1.4-0.7-3.7-0.2-4.4,0.1c-0.7,0.2-1.4-0.1-1.7-0.8c-0.2-0.7,0.1-1.4,0.8-1.7
																c0.4-0.1,3.9-1.4,6.5,0.1c0.8,0.5,1.7,0.6,2.3,0.7v-6c-0.9-0.1-2.2-0.3-3.5-1c-1.4-0.7-3.7-0.2-4.4,0.1C9.8,6.7,9,6.3,8.8,5.7
																C8.5,5,8.9,4.3,9.5,4c0.4-0.1,3.9-1.4,6.5,0.1c1.7,0.9,3.3,0.7,3.3,0.7c0.4-0.1,0.8,0,1.1,0.3c0.3,0.2,0.5,0.6,0.5,1v8.6
																c0,0.6-0.4,1.1-1,1.3C19.8,15.9,19.4,16,18.8,16z"/>
														</g>
													</g>
												</svg>
												<p class="cWhite txt12 ml10 mr5 mbAuto mtAuto">Signaler&nbsple&nbspvisuel</p>
											</button>
											</div>
										</div>
									</div>
								`);

								eventStop = false;
								visu.appendTo(zone).hide().fadeIn(200);
								heightVisuel();
							}
							loader.remove();
							
							nb++;
						});
					}else{

						setTimeout(function(){
							loader.slideUp(300,function(){
								$(this).remove();
							})
						},3000);
						eventStop = true;
					}
				}
			});
			$offset+=1;
		}
	}
});

function heightVisuel(){
	var width = $('.container-visuels').width();
	var height = width / 1.8;
	$('.container-visuels').css({
		"height":height
	})
}
