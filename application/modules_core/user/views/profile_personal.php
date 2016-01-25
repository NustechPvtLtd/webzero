<style>
.select2-container .select2-choice {
    border-radius: 0px;
    height: 32px;
    line-height: 32px;
}
.select2-container {
    border:none;
    padding: 0;
}
.select2-container .select2-choice .select2-arrow {
    border-radius:0px;
}
</style>
<section class="content">
    <div id="notify-container">
        <?php echo $message; ?>
    </div>
    <div class="tabs-container">
        <?php echo form_open(uri_string()); ?>
        <div class="box box-primary no-top-border">
            <div class="box-body">
                <div class="form-group col-sm-2">
                    <div class="form-group">
                        <img class="img-thumbnail" src="<?php echo!empty($avatar) ? base_url('elements') . '/images/uploads/' . $user->id . '/' . $avatar . '?' . time() : base_url('assets') . '/sites/images/dude.png?' . time(); ?>">
                    </div>
                    <?php if (!$this->ion_auth->is_admin() || $user_id == $user->id): ?>
                        <div class="form-group center">
                            <button type="button" class="btn btn-primary" id="uploadImageButton"><?= ($avatar) ? 'Change Avatar' : 'Upload Avatar' ?></button>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form-group col-sm-5">
                    <div class="form-group">
                        <?php echo lang('edit_user_fname_label', 'first_name', 'required'); ?>
                        <?php echo form_input($first_name); ?>
                    </div>
                    <div class="form-group">
                        <?php echo lang('edit_user_lname_label', 'last_name', 'required'); ?>
                        <?php echo form_input($last_name); ?>
                    </div>
                    <div class="form-group">
                        <?php echo lang('edit_user_email_label', 'email', 'required'); ?>
                        <?php echo form_input($email); ?>
                    </div>
                    <div class="form-group">
                        <?php echo lang('edit_user_company_label', 'company'); ?>
                        <?php echo form_input($company); ?>
                    </div>
                    <div class="form-group">
                        <?php echo lang('edit_blng_country_label', 'blng_country', 'required');?>
                        <?php echo form_dropdown('blng_country', $country, $blng_country,'id="blng_country" class="form-control" onChange="get_state(this.value,this.id);"');?>
                    </div>
                    <div class="form-group">
                        <?php echo lang('edit_user_password_label', 'password'); ?>
                        <?php echo form_input($password); ?>
                    </div>
                    <?php if ($this->ion_auth->is_admin() && $user_id != $user->id): ?>
                        <div class="form-group">
                            <?php echo lang('edit_user_price_plan_label', 'price_plan_id', 'required'); ?>
                            <?php echo form_dropdown('price_plan_id', $plans, $price_plan_id, ' class="form-control"'); ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form-group col-sm-5">
                    <div class="form-group">
                        <?php echo lang('edit_blng_street_label', 'blng_street', 'required');?>
                        <?php echo form_input($blng_street);?>
                    </div>
                    <div class="form-group">
                        <?php echo lang('edit_blng_city_label', 'blng_city', 'required');?>
                        <?php echo form_input($blng_city);?>
                    </div>
                    <div class="form-group">
                        <?php echo lang('edit_blng_state_label', 'blng_state', 'required');?>
                        <?php echo form_dropdown('blng_state', $states, $blng_state, 'id="blng_state" class="form-control"');?>
                    </div>
                    <div class="form-group">
                        <?php echo lang('edit_blng_zipcode_label', 'blng_zipcode', 'required');?>
                        <?php echo form_input($blng_zipcode);?>
                    </div>
                    <div class="form-group">
                        <?php echo lang('edit_user_phone_label', 'phone', 'required'); ?>
                        <?php echo form_input($phone); ?>
                    </div>
                    <div class="form-group">
                        <?php echo lang('edit_user_password_confirm_label', 'password_confirm'); ?>
                        <?php echo form_input($password_confirm); ?>
                    </div>
                    <?php if ($this->ion_auth->is_admin() && $user_id != $user->id): ?>
                        <div class="form-group">
                            <label for="notes">Notes:(For User plan)</label>
                            <?php echo form_input($notes); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="clearfix"><!-- --></div>
            <div class="box-footer">
                <div class="pull-right">
                    <?php echo form_submit('submit', (!$this->ion_auth->is_admin() || $user_id == $user->id) ? "Update" : lang('edit_user_submit_btn'), "class='btn btn-primary btn-submit'"); ?>
                </div>
                <div class="clearfix"><!-- --></div>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</section>
<script>
<?php if (!$this->ion_auth->is_admin() || $user_id == $user->id): ?>
        $(function() {
            var btnUpload = $('#uploadImageButton');
            var status = $('#notify-container');
            var files = $('.img-thumbnail');
            new AjaxUpload(btnUpload, {
                contentType: "text/html",
                action: '<?php echo site_url('user/upload_avatar/'); ?>',
                name: 'uploadfile',
                cache: false,
                dataType: "json",
                onSubmit: function(file, ext) {
                    if (!(ext && /^(jpg|png|jpeg|gif)$/.test(ext))) {
                        status.text('Only JPG, PNG or GIF files are allowed');
                        return false;
                    }
                },
                onComplete: function(file, response) {
                    console.log(response);
                    var obj = JSON.parse(response);
                    status.text('Photo Uploaded Sucessfully!');
                    if (obj.status === "error") {
                        var messaget = status.html(obj.message).text();
                        status.html(messaget);
                    } else {
                        files.fadeOut('slow');
                        files.load();
                        files.fadeIn('slow');
                        files.attr('src', '<?php echo base_url(); ?>' + 'elements/images/uploads/' + '<?= userdata('user_id'); ?>' + '/' + obj.message + '?rand=' + new Date().getTime());
                        $('.img-circle').fadeOut('slow').load().fadeIn('slow');
                        $('.img-circle').attr('src', '<?php echo base_url(); ?>' + 'elements/images/uploads/' + '<?= userdata('user_id'); ?>' + '/' + obj.message + '?rand=' + new Date().getTime());
                        status.html('');
                    }

                }
            });
            $.mask.definitions['9'] = '';
            $.mask.definitions['d'] = '[0-9]';
            $('#phone').mask("+91 dd dd dddddd");
            $('#blng_zipcode').mask("ddd ddd");
            $(".city").bind("keyup", function(event) {
                var regex = /^[a-zA-Z\s]+$/;
                if (!regex.test($(this).val())) {
                    $(this).val('');
                } 
            });
            $('select').select2();
        });
<?php endif; ?>

    function get_state(value,id){
        if(value!==''){
            var post_url = "<?php echo site_url('account/get_state');?>/"+value;
            $.ajax({
                type: "GET",
                url: post_url,
                success: function(states)
                {
                    $('#blng_state').empty();
                    $.each(states,function(id,state)
                    {
                        var opt = $('<option />');
                        opt.val(id);
                        opt.text(state);
                        $('#blng_state').append(opt);
                    }); 
                }
            }); //end AJAX
        }
    }
</script>