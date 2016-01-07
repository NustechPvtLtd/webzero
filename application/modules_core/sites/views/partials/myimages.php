<div class="images masonry-3" id="myImages">
<?php
    $key = 0;
?>
<?php foreach( $userImages as $img ):?>
<div class="image">
		    					
	<div class="imageWrap">
        <img class="img-thumbnail" src="http://<?php echo $bucket; ?>.s3.amazonaws.com/<?php echo $img['name']; ?>">
	</div>
		
	<div class="buttons clearfix">
		
		<?php
		
            $dataUrl = "http://{$bucket}.s3.amazonaws.com/{$img['name']}";
            $key++;
		?>
	
		<button type="button" class="btn btn-info btn-embossed btn-block btn-sm useImage" data-url="<?= $dataUrl;?>"><span class="fui-export"></span> <?php echo $this->lang->line('modal_imagelibrary_button_insertimage')?></button>
		<button type="button" class="btn btn-danger btn-embossed btn-block btn-sm deleteImage" data-url="<?php echo site_url('sites/amazon_services/imageDelete');?>" data-bucket="<?php echo $bucket; ?>" data-image="<?php echo $img['name']; ?>"><span class="fui-cross"></span> <?php echo $this->lang->line('modal_imagelibrary_button_deleteimage')?></button>
	</div>
	
</div><!-- /.image -->
<?php
    if(($key+1)%3==0){
        echo '<div class="clearfix"></div>';
    }
?>
<?php endforeach?>
	
</div><!-- /.images -->