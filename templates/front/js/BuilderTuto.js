document.addEventListener('DOMContentLoaded',function(){
	$(".left-bar").removeClass("bar-open");
	$(".left-bar").addClass("bar-close");
	$("#main").css({
		"margin":"50px 0 0 0px",
	})

	var commandButtons = document.querySelectorAll(".editor-commands button");
	for (var i = 0; i < commandButtons.length; i++) {
	    commandButtons[i].addEventListener("mouseup", function (e) {
	        e.preventDefault();
	        var commandName = e.target.getAttribute("data-command");
	        if (commandName === "html") {
	            var commandArgument = e.target.getAttribute("data-command-argument");
	            document.execCommand('formatBlock', false, commandArgument);
	        } else {
	            document.execCommand(commandName, false);
	            if (commandName === "img") {
	        		activP = document.querySelector("div[activ]");
	        		if (activP) {
	        			ajoutImg(activP);
	        		}
	        	}
	        }
	    }); 
	}

	modale = $('#modale-selectFile');
	innerModale = modale.html();
	modale.remove();
	function ajoutImg(activP){
		modale = $('<div />').attr('id','modale-selectFile').addClass('open');
		$(modale).appendTo('#main').hide().fadeIn(300);
		modale.append(innerModale);

		$('.retour1').click(function(){
			modale.fadeOut(300,function(){
				this.remove();
			});
		});

		$('[name=oneImg_tuto]').on('change',function(){
			if(this.files[0] !== undefined){
				go = true;
				if(this.files[0].type != 'image/jpeg' && this.files[0].type != 'image/png'){
					const error = '<span class="mt10 alerte txt12 bold">- Veuillez choisir un fichier .jpg ou .png</span>';
					errorImg(error);
					go = false;
				}
				if(this.files[0].size > 2000000){
					const error = '<span class="mt10 alerte txt12 bold">- Veuillez choisir un fichier .jpg ou .png</span>';
					errorImg(error);
					go = false;
				}
				function errorImg(msg){
					const ta = $('[name=oneImg_tuto]').parent();
					$(msg).appendTo(ta).hide().fadeIn(300);
				}
				const idTuto = $(this).parents('[data]').attr('data');
				var formData = new FormData();
				formData.append("id_tuto", idTuto);
				formData.append("oneImg", this.files[0]);

				if(go){
					$.ajax({
						type:'post',
						url: 'ajout-img-tuto',
						data: formData,
						cache:false,
						processData: false,
			    		contentType: false,
						success: function(datas){
							tab = JSON.parse(datas);
							
							if(tab['img'] != undefined && tab['id_tuto'] != undefined && tab['id_chaine'] != undefined){
								const img = $("<img>").addClass('oneImgTuto').attr('src','medias/chaine/id-'+tab['id_chaine']+'/tuto-'+tab['id_tuto']+'/'+tab["img"]);
								img.appendTo(activP).hide().fadeIn(300);
								modale.fadeOut(300,function(){
									this.remove();
								});
							}

							if(tab['flash'] != undefined){
								$('.body').prepend(tab['flash']);
							}
							if($(document).find('.feedback')){
								$(".feedback").css({"top":"-70px",});
								setTimeout(function(){
									$(".feedback").css({"top":"-20px",});
								},400)
								$(".feedback").click(function(){
									$(".feedback").css({"top":"-70px",});
									setTimeout(function(){
										$(".feedback").remove();
									},350)
								})
								if($(document).find('.feedback.timeout')){
									setTimeout(function(){
										$(".feedback.timeout").css({"top":"-70px",});
										setTimeout(function(){
											$(".feedback.timeout").remove();
										},350)
									},5000)
								}
							}

						}
					});
				}
			}

		});
	}

	touche = [];
	$(document).keydown(function(event){
		if (event.keyCode == 83 && event.ctrlKey) {
	      event.preventDefault();
	   }
		touche.push(event.originalEvent.key);
		if(touche.join(',') == 'Control,s' || touche.join(',') == 'Control,Shift,S'){
			const alert = $('<span class="msgBottom"><p class="mb0">Piment-Créa <span class="cWhite">auto sauvegarde</span> le tutoriel  <span class="txt16">😉</span></p></span>'); 
			$(alert).appendTo('.buildertuto').fadeIn(150,function(){
				var al = $(this);
				setTimeout(function(){
					al.fadeOut(300,function(){
						al.remove();
					});
				},3000);
			});
				
		}
   });
   $(document).keyup(function(event){
		touche = [];
   });

   $(document).on('mouseup','.editor-commands button', function() {
		html = getHTMLOfSelection();
		addActivButton(html);
   });

	$(document).on('selectstart','[contenteditable]', function () {
        $(document).one('mouseup', function() {
			html = getHTMLOfSelection();
			addActivButton(html);
        });
    });
    function getHTMLOfSelection(){
	  var range;
	  if (document.selection && document.selection.createRange) {
	    range = document.selection.createRange();
	    return range.htmlText;
	  }
	  else if (window.getSelection) {
	    var selection = window.getSelection();
	    if (selection.rangeCount > 0) {
	     	range = selection.getRangeAt(0);
	     	var clonedParent = range.commonAncestorContainer;
	     	if(clonedParent.nodeName == "#text"){
	     		clonedParent = clonedParent.parentNode;
	     	}

	     	tableau = [];
	     	newtableau = getOutterElements(clonedParent,tableau);
	     	clonedParent = document.createElement(clonedParent.nodeName);

		    for(const parent of newtableau){
     			clonedParent.appendChild(document.createElement(parent.nodeName));
	     	}
	     	
	     	var clonedSelection = range.cloneContents();
	    	clonedParent.appendChild(clonedSelection);
	     	return clonedParent.outerHTML;
	    }
	    else {
	      return '';
	    }
	  }
	  else {
	    return '';
	  }
	}
    function addActivButton(html){
    	$('.editor-commands button').removeClass('activ');
    	if(html != undefined){
    		if(html.includes('<b>')){
    			$('.ECli3 button').addClass('activ');
    		}
    		if(html.includes('<i>')){
    			$('.ECli4 button').addClass('activ');
    		}
    		if(html.includes('<u>')){
    			$('.ECli5 button').addClass('activ');
    		}
    		if(html.includes('<strike>')){
    			$('.ECli6 button').addClass('activ');
    		}
    		if(html.includes('<h2>')){
    			$('.ECli8 button').addClass('activ');
    		}
    		if(html.includes('<h3>')){
    			$('.ECli9 button').addClass('activ');
    		}
    		if(html.includes('<ul>')){
    			$('.ECli11 button').addClass('activ');
    		}
    		if(html.includes('<ol>')){
    			$('.ECli12 button').addClass('activ');
    		}
    		if(html.includes('<img')){
    			$('.ECli13 button').addClass('activ');
    		}
    	}
    }

    function getOutterElements(last,tableau){
    	if(last == null){
    		return tableau;
    	}
		if(last.nodeName != '#text'){
			if(last.hasAttribute('class','buildertuto')){
				return tableau;
			}
			if(last.hasAttribute('contenteditable')){
				return tableau;
			}
			lastParent = last.parentNode;
			tableau.push(lastParent);
			getOutterElements(lastParent,tableau);
			return tableau;
		}
	}

	$(document).on('click', '.moreCol' , function(){
		let pEdit 				= $('<div />').attr('contenteditable','true').attr('spellcheck','false');
		let removeColElement 	= $('<div />').addClass('removeCol');
		let intoCol				= $('<div />').addClass('intoCol').append(pEdit).append(removeColElement);
		let colElement 			= $('<div style="flex-grow:0"></div>').addClass('col').append(intoCol);
		const row 				= $(this).parent();

		$(this).addClass("click");
		setTimeout(function(){
			$('.moreCol').removeClass("click");
		},700)

		colElement.appendTo(row).animate({
			"flex-grow":1,
		},500, function(){
			pEdit.focus().attr('data-text','Éditer\u0020du\u0020texte');
		});
		verifNbCol(row);
	});


	let clicks = 0;
	let timer = null;
    $(document).on("click",".removeCol", function(e){
    	let col 		= $(this).parent().parent();
    	let row 		= $(this).parent().parent().parent();
    	let pInner 		= $(this).parent().children('div[contenteditable]');
    	let rmCol 		= $(this);

        clicks++;
        timer = setTimeout(function() {
	        if(clicks === 1) {
	        	let msgOnElement 	= $('<p />').addClass('msgOnElement').text('Double\u0020click\u0020pour\u0020supprimer');

				msgOnElement.appendTo(col).hide().fadeIn(100, function(){
					setTimeout(function(){
						msgOnElement.fadeOut(500,function(){
							msgOnElement.remove();
						});
					},1500)
				})
				clicks = 0;
	        }else{
				if(col.find('.msgOnElement')){
					$('.msgOnElement').remove();
	        	}
	        	let timer = 0;
	        	if(pInner[0].innerHTML.length > 0){
	        		let timer = 300;
	        		col.height(col.height());
	        		pInner.contents().wrap('<div />').fadeOut(200, function(){
	        			this.remove();
	        			pInner.animate({
		        			'height':20,
		        		},300);
	        		});
	        	}
	        	setTimeout(function(){
	        		pInner.removeAttr('data-text');
	        		pInner.animate({
	        			'padding':'20 0',
	        		},100,function(){
	        			col.animate({
							"flex-grow":0,
						},500,function(){
							rowHeight = row.height();
							col.remove();
							verifNbCol(row,rowHeight);
						});
	        		});
        			 
	        	},timer)
	            clicks = 0;
	        }
        }, 200);
    })
    $(document).on("dblclick",".removeCol", function(e){
        e.preventDefault();  //cancel system double-click event
    });

	$(document).on('click', '#moreRow', function(){
		let pEdit 			= $('<div />').attr('contenteditable','true').attr('spellcheck','false').attr('data-text','Éditer\u0020du\u0020texte');
		let removeColElement = $('<div />').addClass('removeCol');
		let intoCol			= $('<div />').addClass('intoCol').append(pEdit).append(removeColElement);
		let colElement 		= $('<div />').addClass('col').append(intoCol);
		let moreColElement 	= $('<div />').addClass("moreCol").html('<svg class="plus" version="1.1" viewBox="0 0 32 32" xml:space="preserve"><g><g><rect x="8.5" y="14" class="st0" width="15" height="2.1"/><rect x="8.5" y="9" transform="matrix(1.061078e-10 1 -1 1.061078e-10 26 -1)" class="st0" width="15" height="2.1"/></g></g></svg>');
		let row 			= $('<div style="display:none" />').addClass('row').append(colElement);

		$(row).appendTo('#zoneMore').slideDown(500,function(){
			$(moreColElement).appendTo(this).hide().fadeIn(500);
			pEdit.focus();
		});
	});

	$(document).on('click', 'div[contenteditable]', function(){
		$('div[contenteditable]').removeAttr('activ');
		$(this).focus().attr('activ',true);
	});

	$(document).on("paste",'div[contenteditable]',function(e) {
      let paste = e.originalEvent.clipboardData.getData('text/plain');
      paste = paste.replace(/\r?\n/g,'');

      const selection = window.getSelection();
		if (!selection.rangeCount) return false;
		selection.deleteFromDocument();
		selection.getRangeAt(0).insertNode(document.createTextNode(paste));
		event.preventDefault();
		elemReplace($(this));
   });
   $(document).on('click keydown','div[contenteditable=true]',function(){
		elemReplace($(this));
	});

	function elemReplace(Cedit){
		if($(Cedit).children().length == 0){
			const txt = this.childNodes;
			$(txt).wrap('<p />');
		}

		let editable = $(Cedit);
		const text = editable.contents().filter(function() {
			return this.nodeType === 3;
		}).wrap( "<p></p>" ).end().filter( "br" ).remove();

		const div = editable.find('div');
		const span = editable.find('span');
		elements = [div,span];
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
	}

	function verifNbCol(thisRow,rowHeight=null){
		if(thisRow.find('.col').length == 0){
			thisRow.height(rowHeight);
            thisRow.slideUp(300, function() { 
                $(this).remove(); 
            });
		}
		if(thisRow.find('.col').length >= 4){
			$(thisRow.children('.moreCol')).fadeOut(300, function(){
				$(thisRow.children('.moreCol')).remove();
			})
		}
		if(thisRow.find('.col').length <= 3 && thisRow.find('.moreCol').length == 0){
			let moreColElement 	= $('<div />').addClass("moreCol").html('<svg class="plus" version="1.1" viewBox="0 0 32 32" xml:space="preserve"><g><g><rect x="8.5" y="14" class="st0" width="15" height="2.1"/><rect x="8.5" y="9" transform="matrix(1.061078e-10 1 -1 1.061078e-10 26 -1)" class="st0" width="15" height="2.1"/></g></g></svg>');
			moreColElement.appendTo(thisRow).hide().fadeIn(300);
		}
	}



})