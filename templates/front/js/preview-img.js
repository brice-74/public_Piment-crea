document.addEventListener('DOMContentLoaded',function(){

	$('input[type="file"]').change(function(e){
		var file = e.target.files[0];
	   handleFiles(file);
	});

	function handleFiles(file) {
		var imageType = /^image\//;

		if(file !== undefined){
			if(imageType.test(file.type)){
				if($(document).find(".img-preview")){
					$(".img-preview").fadeOut(300);
				}
				var img = document.createElement("img");
				var p = document.createElement("p");
				img.classList.add("img-preview","dpNone");
				p.classList.add("cGris","alignCenter","mb20","dpNone");
				p.innerHTML = "Aperçu de l'image";

				if (typeof a == 'undefined') {
					$(".preview").append(p);
					$(p).fadeIn(300, function(){
						$(this).removeClass("dpNone");
					});
					a = 1;
				}
				
				img.file = file; 
				$(".preview").append(img); 
				var reader = new FileReader();
				reader.onload = ( function(aImg) {
					return function(e) { 
						aImg.src = e.target.result;
					}
				})(img);
				reader.readAsDataURL(file);
				setTimeout(function(){
               $(img).fadeIn(300, function(){
						$(this).removeClass("dpNone");
					});
            },300);
			}
		}else{
			$(".img-preview").innerHTML = '';
		}
	}
})