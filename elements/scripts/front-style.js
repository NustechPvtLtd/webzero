$(document).ready(function(){

	/*front page css thru jquery*/
	$('nav.navbar').next().css('margin-top','60px');
	$('ul.nav li').click(function(){
		
	   //$('ul.nav li').each(function(){
		//if($('ul.nav li').hasClass('active')) {
		//console.log($(this));
		var idx = $(this).find('a').attr('href');
		//console.log(idx);
		if(idx!=undefined && idx.length>3) {
			var idx = idx.slice(1);
			//console.log(idx);
			
			$('html, body').animate({
				scrollTop: $("#"+idx).offset().top-60
			}, 500);			
			/*
			$('div.student').each(function(){
				$(this).children("div:first").css('padding-top','0px');
			});
			$("#"+idx).children("div:first").css('padding-top', '60px');
			*/
		}
		else {
			/*
			$('div.student').each(function(){
				$(this).children("div:first").css('padding-top','0px');
			});
			$('.navigation').parents('.student').nextAll('.student').children("div:first").css('padding-top','60px');
			*/
		}
	});
});