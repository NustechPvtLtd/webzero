<div class="images masonry-3" id="myImages">

<?php foreach( $userImages as $img ):?>
<div class="image">
		    					
	<div class="imageWrap">
		<img src="<?php echo base_url().$this->config->item('images_uploadDir');?>/<?php echo userdata('user_id');?>/<?php echo $img;?>">
	</div>
		
	<div class="buttons clearfix">
		
		<?php
		
			$dataUrl = base_url().$this->config->item('images_uploadDir');
		
		?>
	
		<button type="button" class="btn btn-info btn-embossed btn-block btn-sm useImage" data-url="<?php echo $dataUrl;?>/<?php echo userdata('user_id');?>/<?php echo $img;?>"><span class="fui-export"></span> <?php echo $this->lang->line('modal_imagelibrary_button_insertimage')?></button>
	</div>
	
</div><!-- /.image -->
<?php endforeach?>
	
</div><!-- /.images -->