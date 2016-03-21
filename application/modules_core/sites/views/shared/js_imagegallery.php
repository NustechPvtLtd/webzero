$(function(){
    $('#imageModal').on('show.bs.modal', function(e) {
        //destroy all alerts
        $('#imageModal .alert').fadeOut(500, function(){
            $(this).remove();
        });
        
        if(userImageLoaded){return;}
        $.ajax({
            url:'<?php echo site_url('sites/getUserImage');?>',
            type:'GET',
            dataType:'json'
        }).done(function(res){
            $('#myImagesTab .loader').fadeOut(500, function(){
                $('#myImagesTab').append($(res.responseHTML));
            });
            userImageLoaded = true;
        });
    });
    
    $('#imageModal .nav-tabs a').one('click', function(){
        if($(this).attr('href') == '#adminImagesTab'){
            $.ajax({
                url:'<?php echo site_url('sites/getAdminImage');?>',
                type:'GET',
                dataType:'json'
            }).done(function(res){
                $('#adminImagesTab .loader').fadeOut(500, function(){
                    $('#adminImagesTab').append($(res.responseHTML));
                });
            });
        }
    });
    
});
