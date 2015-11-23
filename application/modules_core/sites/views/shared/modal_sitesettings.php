<link href="<?php echo base_url('assets/sites/css/bootstrap-switch.min.css'); ?>" rel="stylesheet">
<div class="modal fade siteSettingsModal" id="siteSettings" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	
	<div class="modal-dialog modal-lg">
    	
    	<div class="modal-content">
      		
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo $this->lang->line('modal_close')?></span></button>
        		<h4 class="modal-title" id="myModalLabel"><span class="fui-gear"></span> <?php echo 'URL Settings' /*$this->lang->line('sitesettings_sitesettings')*/?></h4>
      		</div>
      		      	
      		<div class="modal-body">
      		
      			<div class="loader">
      				<img src="<?php echo base_url();?>assets/sites/images/loading.gif" alt="Loading...">
      				<?php echo $this->lang->line('loading_site_data')?>
      			</div>
      			
      			<div class="modal-alerts"></div>
      				      		
      			<div class="modal-body-content"></div>

      		</div><!-- /.modal-body -->
      		
      		<div class="modal-footer">
        		<button type="button" class="btn btn-default btn-embossed" data-dismiss="modal"><span class="fui-cross"></span> <?php echo $this->lang->line('modal_cancelclose')?></button>
      		</div>
      		
    	</div><!-- /.modal-content -->
    	
  	</div><!-- /.modal-dialog -->
  	
</div><!-- /.modal -->
