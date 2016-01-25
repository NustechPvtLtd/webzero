<div class="images masonry-3" id="myImages">

<?php foreach( $userImages as $key => $img ):?>
<div class="image">
		    					
	<div class="imageWrap">
        <img class="img-thumbnail" src="<?php echo base_url().$this->config->item('s_images_uploadDir');?>/<?php echo userdata('user_id');?>/<?php echo $img;?>">
	</div>
		
	<div class="buttons clearfix">
		<?php $dataUrl = base_url().$this->config->item('s_images_uploadDir');	?>
		<div class="col-sm-12">
			<div class="col-sm-6">
				<button type="button" class="btn btn-info btn-embossed btn-block btn-sm useImage" data-url="<?php echo $dataUrl;?>/<?php echo userdata('user_id');?>/<?php echo $img;?>"><span class="fui-export"></span> <?php echo $this->lang->line('modal_imagelibrary_button_insertimage')?></button>
			</div>
			<div class="col-sm-6">
				<button type="button" class="btn btn-danger btn-embossed btn-block btn-sm deleteImage" del-url="<?php echo site_url('sites/assets/studentImageDeleteAjax/'); ?>" data-url="<?php echo userdata('user_id');?>/<?php echo $img;?>"><span class="fui-cross"></span> <?php echo $this->lang->line('modal_imagelibrary_button_deleteimage')?></button>
			</div>
		</div>
	</div>
	
</div><!-- /.image -->
<?php
    if(($key+1)%3==0){
        echo '<div class="clearfix"></div>';
    }
?>
<?php endforeach?>
	
</div><!-- /.images -->