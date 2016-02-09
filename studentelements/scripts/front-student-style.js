$(document).ready(function(){
	var checkpwdurl = $(".siteaccess").val();
	var pwd = $(".hiddenpassword").val();
	//console.log((atob($(".siteId").val())===atob($(".myid").val())));
	if(pwd==1 && !(atob($(".siteId").val())===atob($(".myid").val()))){
		$('#myModal').modal({
			backdrop: 'static',
			keyboard: false,
			show:true
			
		});
		$(".sitepwd").focus();
	}
	
	// check my session exists with you else show popup to mee.
	
	
	$(".loginpwdsite").click(function(){
		$.ajax({
			url:checkpwdurl,
			data:{'pwd':$(".sitepwd").val()},
			method: "POST",
			dataType: 'json',
			success:function(data){
				if(data.status=="success"){
					$('#myModal').modal('hide');
					$(".errorlogin").hide();
					$(".sitepwd").val("");
					
					// CALL POST AJAX TO SET THE SESSION VARIABLE 
					$.ajax({
					  url: data.data.remote_url,
					  method:"POST",
					  data:{sessid:data.data.sessid},
					  success: function(){
						//window.location.href = data.data.remote_url;
						//alert('Login Successfully');
					  },
					  error: function(){
						$('#myModal').modal('show');
						//alert('Something went wrong..');
					  }
					});
				}
				else{
					$('#myModal').modal('show');
					$(".errorlogin").show();
					$(".errormsg").html(data.message);
					$(".sitepwd").val("");
				}
				
			}
		});
	});
	$(".closebox").click(function(){
		$(this).parent().hide();
	});
	
	/*front page css thru jquery*/
	$('.navigation').parents('.student').nextAll('.student').children("div:first").css('margin-top','60px');
	$('ul.nav li').click(function(){
		
	   //$('ul.nav li').each(function(){
		//if($('ul.nav li').hasClass('active')) {
		console.log($(this));
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
	
	/*front page css thru jquery*/	
});
/* Loaded after DOM READY EVENT IS CALLED */
document.addEventListener('DOMContentLoaded', function() {
	// Load the video present inside pages.
	$(".videoGallery").html5gallery();
}, false);