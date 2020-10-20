var $offset = 24;
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
				url: 'next-actifs-visu',
				data: formData,
				processData: false,
		    	contentType: false,
				success: function(datas){
					tab = JSON.parse(datas);
					if($.isArray(tab['visu'])){
						let nb = 0;
						const url = window.location.origin+"/";
						$(tab['visu']).each(function(){
							var correspondance = false;

							$(document).find('[ajax=favoris]').each(function(){
								if($(this).attr('datas').replace(/[-a-z]+/,'') == tab['visu'][nb][0]){
									correspondance = true;
								}
							})

							if(correspondance == false){
								const idVisu = tab['visu'][nb][0];
								const visuVisu = tab['visu'][nb][1];
								const dateVisu = tab['visu'][nb][3];

								const idChaine = tab['visu'][nb]['id_chaine'];
								const nomChaine = tab['visu'][nb]['nom_chaine'];
								var avatarChaine = tab['visu'][nb]['avatar_chaine'];
								if(avatarChaine == null){
									avatarChaine = 'templates/front/img/piment.jpg';
								}else{
									avatarChaine = 'medias/chaine/id-'+idChaine+'/avatars/'+avatarChaine;
								}

								var countLike = tab['countLikes'][nb]['sommeLikes'];
								if(countLike == null){
									countLike = 0;
								}

								like = '';
								fav = '';
								titleFav = 'Ajouter&nbspaux&nbspfavoris';
								if(tab['user'] != null){
									const user = tab['user'];

									if(tab['likes'][nb] != null){
										const likePost = tab['likes'][nb][1];
										const likeIdUser = tab['likes'][nb][3];
										if(user == likeIdUser){
											like = 'liked';
										}
									}
									
									if(tab['favoris'][nb] != null){
										const favIdUser = tab['favoris'][nb][1];
										if(user == favIdUser){
											fav = 'favorited';
											titleFav = 'Retirer&nbspdes&nbspfavoris';
										}
									}
									
								}
								visu = $('<div />').addClass('container-bloc p10 dpIB').html(`
									<div class="container-visuels">
									 	<a class="p0" href="${url}visuel-${idVisu}-${visuVisu.replace(/.jpg$|.jpeg$|.png$/,'')}"
									 		style="background-image:url(medias/chaine/id-${idChaine}/visuel/min-${visuVisu})" >
											<img class="img-visuel" src="medias/chaine/id-${idChaine}/visuel/min-${visuVisu}">
										</a>
									</div>
									<div class="flex pb5 pt5">
										<a href="chaine-${idChaine}-${nomChaine}/visuels" class="p0 container-avatar-min posR t0 l0"
											style="background-image:url(${avatarChaine});"
										>
											<img class="img-visuel mb5" 
												src="${avatarChaine}"
											alt="Image de chaine">
										</a>
										<div class="mAuto0 ml10 cutBox1">
											<p class="mb0 bold">${nomChaine}</p>
											<p class="txt12 cGris mb0">${dateVisu}</p>
										</div>
										<div class="mt5 mlAuto">
											<button class="like-min mlAuto mAuto0 flex p0 ${like}" ajax="like" datas="${idVisu}">
												<p class="cGris bold mtAuto mb0 mr10" count-like>${countLike}</p>
												<svg version="1.1" viewBox="0 0 35 35" xml:space="preserve">
													<g>
														<g>
															<path class="st0" d="M2.3,31.1c-0.7,0-1.3-0.6-1.3-1.3V13.1c0-0.7,0.6-1.3,1.3-1.3s1.3,0.6,1.3,1.3v16.7C3.6,30.5,3,31.1,2.3,31.1
																z"/>
														</g>
														<path class="st0" d="M26.9,11.9H16.6c0.8-5.4,0.2-8.8-1.7-10.4c-1.2-1.1-2.7-0.9-3.4-0.7c-0.4,0.1-0.7,0.4-0.8,0.8L6.8,12.7
															c0,0.1-0.1,0.3-0.1,0.4v16.9c0,0.1,0,0.1,0,0.2c0,0.7,0.6,1.3,1.3,1.3H8h11.2h0.1c3,0,5.5-1,7.4-2.9c3.6-3.6,4.1-9.6,4-12.9
															C30.8,13.6,29,11.9,26.9,11.9z M24.9,26.9c-1.3,1.3-3.1,2-5.2,2.1H9.3V13.4l3.6-10.2c0.1,0,0.3,0.1,0.4,0.2
															c0.4,0.4,1.8,2.2,0.5,9.5c-0.1,0.4,0,0.8,0.3,1.1c0.2,0.3,0.6,0.5,1,0.5h11.8c0.7,0,1.3,0.6,1.3,1.3C28.2,18.7,27.8,24,24.9,26.9z"
															/>
													</g>
												</svg>
											</button>
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
												ajax="favoris" datas="${idVisu}"
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
											<button class="sig flex" title="signaler un abus" modale="btn-signal" datas="visuel-${idVisu}">
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
			$offset+=24;
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
