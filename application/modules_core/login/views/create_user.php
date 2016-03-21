<?php echo form_open("create-user");?>
	<div class="box box-primary">
		<div class="box-header">
			<h3 class="box-title"><?php echo lang('create_user_subheading');?></h3>
		</div>
		<div class="box-body">
			<div class="form-group col-lg-6">
				<?php echo lang('create_user_fname_label', 'first_name', 'required');?>
				<?php echo form_input($first_name);?>                              
			</div>
			<div class="form-group col-lg-6">
				<?php echo lang('create_user_lname_label', 'last_name');?>
				<?php echo form_input($last_name);?>
			</div>
			<div class="clearfix"><!-- --></div>
			<div class="form-group col-lg-6">
				<?php echo lang('create_user_email_label', 'email', 'required');?>
				<?php echo form_input($email);?>                            
			</div>
			<div class="form-group col-lg-6">
				<?php echo lang('create_user_phone_label', 'phone');?>
				<?php echo form_input($phone);?>
			</div>
			<div class="clearfix"><!-- --></div>
			<div class="form-group col-lg-6">
				<?php echo lang('create_user_password_label', 'password', 'required');?>
				<?php echo form_input($password);?>
			</div>
			<div class="form-group col-lg-6">
				<?php echo lang('create_user_password_confirm_label', 'password_confirm', 'required');?>
				<?php echo form_input($password_confirm);?>
			</div>
			<div class="clearfix"><!-- --></div>
			<div class="form-group col-lg-6">
				<?php echo lang('create_user_company_label', 'company');?>
				<?php echo form_input($company);?>
			</div>
            <div class="form-group col-lg-6">
            <?php echo lang('create_user_group_label', 'group', 'required');?>
            <?php echo form_dropdown('group', $group, '', 'class="form-control" ');?>
			</div>
			<div class="clearfix"><!-- --></div>
		</div>
		<div class="box-footer">
			<div class="pull-right">
				<button data-loading-text="Please wait, processing..." class="btn btn-primary btn-submit" type="submit"><?php echo lang('create_user_submit_btn')?></button>
			</div>
			<div class="clearfix"><!-- --></div>
		</div>
	</div>
<?php echo form_close();?>
<script>
$(function(){
    $.mask.definitions['9'] = '';
    $.mask.definitions['d'] = '[0-9]';
    $('#phone').mask("+91 dd dd dddddd");
});
</script>
