$(function(){
	$('.studShareProfModalButton').click( function(e){
		e.preventDefault();
		$('#profileShareSettings').modal('show');
		//destroy all alerts
		$('#profileShareSettings .alert').fadeOut(500, function(){
			$(this).remove();
		})
		
		//set the siteID
		$('input#siteID').val( $(this).attr('data-siteid') );
		
		//destroy current forms
		$('#profileShareSettings .modal-body-content > *').each(function(){
			$(this).remove();
		})
		
		//show loader, hide rest
		//$('#siteSettingsWrapper > *:not(.loader)').hide();
		$('#profileShareSettings .loader').show();
		
		//load site data using ajax
		
		$.ajax({
			url: '<?php echo site_url('sites/shareprofile')?>/'+$(this).attr('data-siteid'),
			type: 'post',
			dataType: 'json'
		}).done(function(ret){    			
			if( ret.responseCode == 0 ) {//error
				//hide loader, show error message
				$('#profileShareSettings .loader').fadeOut(500, function(){
					$('#profileShareSettings .modal-alerts').append( $(ret.responseHTML) )
				})
				
				//disable submit button
				$('#shareMyProfile').addClass('disabled');
			} else if( ret.responseCode == 1 ) {//all well :)
				//hide loader, show data
				$('#profileShareSettings .loader').fadeOut(500, function(){
					$('#profileShareSettings .modal-body-content').append( $(ret.responseHTML) )
				})
				
				//enable submit button
				$('#shareMyProfile').removeClass('disabled');
			}
		});
	});
	/*
		share profile ajax call_user_func
	*/
	
	/* Save Basic details */
	$("#profileShareSettings").on("click","#shareMyProfile",function(){
		btn = $(this);
		btn.prop('disabled', true);
		$.ajax({
			method:"POST",
			url:'shareMyResume',
			dataType: 'json',
			data:$('form#profileShare').serialize(), 
			success:function(data){
				$("#profileShareSettings .modal-alerts").html(data.responseHTML);
				btn.prop('disabled', false);
				$("#shareProfile").val("");
				
				// Remove the tagit 
				$(".tagit li").each(function(){
					if($(this).hasClass("tagit-choice")){
						$(this).remove();
					}
				})
			}
		});
	});		
});