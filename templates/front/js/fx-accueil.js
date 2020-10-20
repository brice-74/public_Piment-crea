
/*$(document).mousemove(function(e){
	var sourisX = e.clientX; 
	var sourisY = e.clientY;

	var bg1X = (sourisX*0.001) + 50;
	var bg1Y = (-sourisY*0.002) + 25;
	$(".vh2:nth-child(1)").css({
		"background-position": "top "+bg1Y+"vh right "+bg1X+"vw",
	})

	var bg2X = (-sourisX*0.001) + 50;
	var bg2Y = (-sourisY*0.002) + 5;
	$(".vh2:nth-child(2)").css({
		"background-position": "top "+bg2Y+"vh left "+bg2X+"vw",
	})

	var vh1_1X = sourisX*0.01;
	var vh1_1Y = sourisY*0.02;
	$(".img-left , .img-right").css({
		"transform": "translate("+vh1_1X+"px, "+vh1_1Y+"px)",
	})
    
})*/


document.addEventListener('DOMContentLoaded',function(){
	$(".col-3 , .col-6 , .col-8").addClass("translate1");
	$(".col-4 , .col-5 , .col-7").addClass("translate2");

  
	$(document).scroll(function(){
		var scrollPos = $(document).scrollTop();
		var HauteurEcran = $(window).height();
		if(scrollPos > (-50 + HauteurEcran - HauteurEcran / 2)){
			$(".col-1").addClass("translate1");
			$(".col-2").addClass("translate2");

			$(".col-3").removeClass("translate1");
			$(".col-4").removeClass("translate2");
		}else{
			$(".col-1").removeClass("translate1");
			$(".col-2").removeClass("translate2");

			$(".col-3").addClass("translate1");
			$(".col-4").addClass("translate2");
		}

		if(scrollPos > (-100 + HauteurEcran * 2 - HauteurEcran / 2)){
			$(".col-6").removeClass("translate1");
			$(".col-5").removeClass("translate2");

			$(".col-3").addClass("translate1");
			$(".col-4").addClass("translate2");
		}else{
			$(".col-6").addClass("translate1");
			$(".col-5").addClass("translate2");
		}

		if(scrollPos > (-150 + HauteurEcran * 3 - HauteurEcran / 2)){
			$(".col-8").removeClass("translate1");
			$(".col-7").removeClass("translate2");

			$(".col-6").addClass("translate1");
			$(".col-5").addClass("translate2");
		}else{
			$(".col-8").addClass("translate1");
			$(".col-7").addClass("translate2");
		}
	})
});
