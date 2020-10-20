var loadingDiv = document.createElement('div');
$(loadingDiv).addClass("loadingDiv");
$("body").append(loadingDiv);
$(function(){
	if($(document).find('#noJs')){
		$("#blocNoJs").remove();
		$("body").removeAttr('id', 'noJs');
	};

	if(sessionStorage.getItem('noPass') != undefined){
		sessionStorage.removeItem('noPass');

		const feedback = $('<div />').addClass('feedback normal timeout').append($('<p />').text('Fonctionnalité inaccessible sur téléphone et tablette'));
		$('body').append(feedback);
	}

	/*if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
		const regex = [
			/\/Piment-Crea\/site\/poster-visuel$/i,
			/\/Piment-Crea\/site\/brouillons$/i,
			/\/Piment-Crea\/site\/creation-tuto-[0-9]+$/i
		];

		test = false;
		$(regex).each(function(){
			if(this.test(document.location)){
				test = true;
			}
		});

		if(test){
			window.location.assign(document.location.origin+"/Piment-Crea/site/index");
			sessionStorage.setItem('noPass', '');
		}	
	}*/

	$('input[type="password"]').attr('eyepass','true');
	let eye = $('<div />').attr('eyecss','closeeye').append('<div />');
	$('input[eyepass="true"]').parent().append(eye);

	$(document).on('click','[eyecss]',function(){
		if($(this).attr('eyecss') == 'openeye'){
			$(this).attr('eyecss','closeeye');
			$('[eyepass]').attr('type','password');
		}else{
			$(this).attr('eyecss','openeye');
			$('[eyepass]').attr('type','text');
		}
	})

	$('#filtrage').click(function(){
		$('#trieSelect').toggleClass('open');
	});

	$(document).on("click",'button', function(){
		let btnId = $(this).children().attr('id');

		if(btnId != null){
			openModale(this,btnId);
		}else{
			openModale(this);
		}
	});
	$('.retour1 , .annul').click(function(){
		$('[id^=modale-').fadeOut(300,function(){
			$(this).removeClass('open');
			$('[action]')[0].reset();
			$('[id^=modale-').find('.alerte').remove();
		});
	});
	findAlerte();

	if($(document).find('.retour3')){

		$('.visuel-container').on('mousemove',function(){
			$('.retour3').css({'opacity':1,'display':'inline-flex'});
			clearInterval(inte);
			setInt();
		});
		function setInt(){
			inte = setInterval(function(){
				$('.retour3').fadeOut(1000);
			},3000);
		}
		setInt();
	}


	function openModale(cible,btnId=null){
		if($(cible).attr('modale')){
			var attr = $(cible).attr('modale');
			let regex = /^btn-[a-zA-Z0-9]+$/i;
			if(regex.test(attr)){
				attr = attr.split('-');
				attr[0] = "modale";
				attr = attr.join("-");
				let modale = $('#'+attr);
				$(modale).fadeIn(300).addClass('open');
				if(btnId != null){
					modale.find('a').attr('href',window.origin+'/'+btnId);
				}
			}
		}
	}
	function findAlerte(){
		if($(document).find('[id^=modale-')){
			$('[id^=modale-').each(function(){
				if($(this).find('.alerte').length > 0){
					$(this).fadeIn(300).addClass("open");
				}
			});
		}
	}
	

	$(document).on('click','.point3',function(e){
		$(this).addClass("openP");
	});
	$(document).on('blur','.point3',function(e){
		timer = 0;
		p3 = $(this);
		if($(e.relatedTarget).hasClass('fav')){
			timer = 1000;
		}else if($(e.relatedTarget).hasClass('sig')){
			timer = 1000;
		}
		setTimeout(function(){
			p3.removeClass("openP");
		},timer);
			
	});

	


	$('input[type="file"]').change(function(e){
		var file = e.target.files[0];
		if(file !== undefined){
			var fileName = file.name;
			$(this).addClass("complete");
			$('.fileName').remove();
			$('button[type="submit"][name="go"]').after("<p class=\"fileName mb0\">"+fileName+"</p>");
			$('button[type="submit"][name="go"]').parent().css({
				"margin-bottom":"22px",
			})
			$(".uploadIcone").addClass("complete");
		}
	    
	});


	pushMain = function(){
		$("#main").css({
			"margin":"50px 0 0 220px",
		})
		$(".editor-commands").css({
			"margin":"0 0 0 220px",
			"width":"calc(100vw - 220px)",
		})
	}
	noPushMain = function(){
		$("#main").css({
			"margin":"50px 0 0 0px",
		})
		$(".editor-commands").css({
			"margin":"0 0 0 0px",
			"width":"100vw",
		})
	}
	ouvreMenu = function(){
		$(".left-bar").removeClass("bar-close");
		$(".left-bar").addClass("bar-open");
		$(".img-bandeau").addClass("open");
	}
	fermeMenu = function(){
		$(".left-bar").removeClass("bar-open");
		$(".left-bar").addClass("bar-close");
		$(".img-bandeau").removeClass("open");
	}

	ouvreProfil = function(){
		$(".account").removeClass("close-profil");
		$(".account").addClass("open-profil");
	}
	fermeProfil = function(){
		$(".account").removeClass("open-profil");
		$(".account").addClass("close-profil");
	}

	if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ){
		fermeMenu();
		noPushMain();
	}
	$(".burger > button").click(function(){
		if($(window).width() <= 1024){
			if($(".left-bar").hasClass("bar-close")){
				ouvreMenu();
				fermeProfil();
			}else{
				fermeMenu();
				noPushMain();
			}
		}else{
			if($(".left-bar").hasClass("bar-close")){
				ouvreMenu();
				pushMain();
			}else{
				fermeMenu();
				noPushMain();
			}
		}
	})
	$(window).resize(function(){
		if($(window).width() <= 1024){
			noPushMain();
			fermeMenu();
		}
	})

	$(".img-avatar > button").click(function(){
		if($(window).width() <= 1024){
			if($(".account").hasClass("close-profil")){
				fermeMenu();
			}
		}
		if($(".account").hasClass("close-profil")){
			ouvreProfil();
		}else{
			fermeProfil();
		}
	})

	if($(document).find('.container-visuels')){
		heightVisuel();
		$(window).resize(function(){
			heightVisuel();
		})
		$(".burger > button").click(function(){
			setTimeout(function(){
				heightVisuel();
			},250)
		})
		function heightVisuel(){
			var width = $('.container-visuels').width();
			var height = width / 1.8;
			$('.container-visuels').css({
				"height":height
			})
		}
	}
	if($(document).find('.visuel-container')){
		heightVisuel();
		$(window).resize(function(){
			heightVisuel();
		})
		$(".burger > button").click(function(){
			setTimeout(function(){
				heightVisuel();
			},250)
		})
		function heightVisuel(){
			var width = $('.visuel-container').width();
			var height = width / 1.8;
			$('.visuel-container').css({
				"height":height
			})
		}
	}

	$(".goTop").css({
	  "right": "0",
	  "opacity":"0"
	})
	$(document).scroll(function(){
		var scrollPos = $(document).scrollTop();
		if(scrollPos <= 0){
			$(".goTop").css({
				"right": "0",
				"opacity":"0"
			})
		}else{
			$(".goTop").css({
				"right": "5px",
				"opacity":"100"
			})
		}
	})

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

	$(document).ready(function(){
		$(loadingDiv).fadeOut(400);
		setTimeout(function(){
			$(loadingDiv).remove();	
		},400)
	})
	$('#togglePropT').click(function(){
		$(this).toggleClass('closed');
		$('[noactifPropT]').animate({
		   height: "toggle",
		   'padding': "toggle",
		   'margin-bottom': "toggle",
		   opacity: "toggle"
		}, 300);
	})
	$('#togglePropV').click(function(){
		$(this).toggleClass('closed');
		$('[noactifPropV]').animate({
		   height: "toggle",
		   'padding': "toggle",
		   'margin-bottom': "toggle",
		   opacity: "toggle"
		}, 300);
	})
	$('#toggleSign').click(function(){
		$(this).toggleClass('closed');
		$('[noactif]').animate({
		   height: "toggle",
		   'padding': "toggle",
		   'margin-bottom': "toggle",
		   opacity: "toggle"
		}, 300);
	})
	$('#toggleTuto').click(function(){
		$(this).toggleClass('closed');
		/*$('#slideTuto').slideToggle(300);
		$('#slideTuto').fadeToggle(150);*/
		$('#slideTuto').animate({
		   height: "toggle",
		   'padding': "toggle",
		   'margin-bottom': "toggle",
		   opacity: "toggle"
		}, 300);
	})
	$('#toggleChaine').click(function(){
		$(this).toggleClass('closed');
		/*$('#slideChaine').slideToggle(300);
		$('#slideChaine').fadeToggle(150);*/
		$('#slideChaine').animate({
		   height: "toggle",
		   'padding': "toggle",
		   'margin-bottom': "toggle",
		   opacity: "toggle"
		}, 500);
	})

	$('#search').attr('autocomplete','off').attr('spellcheck','false');
	$(document).on('mousedown',function(e){
		if((e.target.className != 'field') && (e.target.className != 'completePropInner') && (e.target.className != 'completeProp')){
			$('.autocomplete').remove();
		}
	})
	$(document).on('click','.completeProp',function(){
		$('#search').focus();
		$('#search').val($(this).text());
	});
	$(document).on('keyup click','#search',function(){
		let val = $(this).val();
		if($(this).val().length > 0){
			$.ajax({
				type:'POST',
				url:'https://instinct-crea.fr/traitement-search',
				data:{ value:val },
				success: function(datas){
					tab = JSON.parse(datas);
					$('.autocomplete').remove();
					let autocomplete = $('<div />').addClass('autocomplete');
					$('#search').parents('form').append(autocomplete);

					if(tab['chaines'] != undefined){
						$.each(tab['chaines'],function(index,val){
							autocomplete.append('<div class="completeProp"><p class="completePropInner">'+val+'</p></div>');
						});
					}
					if(tab['tutos'] != undefined){
						$.each(tab['tutos'],function(index,val){
							autocomplete.append('<div class="completeProp"><p class="completePropInner">'+val+'</p></div>');
						});
					}

					if(tab['no'] != undefined){
						autocomplete.append('<div class="noRes"><p class="completePropInner">'+tab['no']+'</p></div>');
					}	
				}
			})
		}
		
	})
})

