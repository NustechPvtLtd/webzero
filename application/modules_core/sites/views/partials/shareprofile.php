<form class="form-horizontal" role="form" id="profileShare" action="<?php echo site_url('sites/updatePasswordData')?>">
	<input type="hidden" name="siteID" id="siteID" value="<?php echo $siteData->sites_id?>">
	<input type="hidden" name="pageID" id="pageID" value="<?php if( isset($pagesData['index']) ){ echo $pagesData['index']->pages_id; }?>">
	<input type="hidden" name="pageName" id="pageName" value="">
	
	<div class="optionPane">
		<div class="form-group mail">
			<div class="col-sm-12">
				<div class="col-sm-2">
					<label for="name" class="control-label"  style="text-align:left;"><?php echo $this->lang->line('modal_pagesettings_shareprofile')?>:</label>
				</div>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="shareProfile" name="shareEmail" placeholder="Email Id" value="">
					<label class="mulemails"><?php echo $this->lang->line('sites_shareProfile_multipleids')?></label>
				</div>
			</div>
		</div>		
		<div class="form-group mailEditor">
			<div class="col-sm-12 msgs">
				<div class="col-sm-2">
					<label for="name" class="control-label" style="text-align:left;"><?php echo $this->lang->line('modal_pagesettings_share_message')?>:</label>
				</div>
				<div class="col-sm-10 msg">
					<label style=" text-align:left;clear:both;padding:0px:margin:0px;line-height:1;color:red;font-size:12px" class="control-label" for="name">
					</label>
				</div>
			</div>
			<div class="col-sm-12">
				<textarea name="emailcontents" id="emailcontents" placeholder="Write Your Email Contents Here....." class="form-control">
					<?PHP $this->load->view('email/shareprofile_email',array('userdata'=>$userdata,'sitedata'=>$siteData)); ?>
				</textarea>
			</div>
		</div>
	</div><!-- /.optionPane -->
</form>
<script>
$(document).ready(function(){
	$("#emailcontents").redactor();
			
	// Tag It functions. 
	$("#shareProfile").tagit();
})
</script>