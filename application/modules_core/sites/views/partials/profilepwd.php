<form class="form-horizontal" role="form" id="profilePasswordSetting" action="<?php echo site_url('sites/updatePasswordData')?>">
	<input type="hidden" name="siteID" id="siteID" value="<?php echo $siteData->sites_id?>">
	<input type="hidden" name="pageID" id="pageID" value="<?php if( isset($pagesData['index']) ){ echo $pagesData['index']->pages_id; }?>">
	<input type="hidden" name="pageName" id="pageName" value="">
	
	<div class="optionPane">
		<div class="form-group">
			<label for="name" class="col-sm-3 control-label"><?php echo $this->lang->line('modal_pagesettings_setyesno')?>:</label>
			<div class="col-sm-9">
				<input type="checkbox" id="toggle-event" name="my-checkbox" value="1" <?PHP echo ($siteData->has_password==1)?" checked":" unchecked";?>>
			</div>
		</div>	
		<div class="form-group">
			<label for="name" class="col-sm-3 control-label"><?php echo $this->lang->line('modal_pagesettings_setpassword')?>:</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" id="pagePassword" name="pagePassword" placeholder="Site Password" value="<?php if( isset($pagesData['index']) ){ echo $siteData->site_password; }?>">
			</div>
		</div>
	</div><!-- /.optionPane -->
</form>