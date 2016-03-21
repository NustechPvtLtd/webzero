<section class="content">
    <div id="notify-container">
        <?php echo $message;?>
    </div>
    <div class="tabs-container">
        <ul id="yw0" class="nav nav-tabs">
            <li><a href="<?php echo site_url('account/plans') ?>"><span class="glyphicon glyphicon-list"></span> Plans & Features</a></li>
            <li><a href="<?php echo site_url('account/address_details') ?>"><span class="glyphicon glyphicon-home"></span> Address</a></li>
            <?php if($this->ion_auth->in_group('ecommerce')):?>
            <li class="active"><a href="<?php echo site_url('account/payment_gateways') ?>"><span class="glyphicon glyphicon-credit-card"></span> Payment Gateways</a></li>
            <?php endif;?>
        </ul>
        <?php echo form_open(uri_string());?>
            <div class="box box-primary no-top-border">
                <div class="box-body">
                    <div class="clearfix"><!-- --></div>
                    <div class="form-group col-lg-6">
                        <div class="form-group">
                            <?php echo lang('payment_gateway_heading');?>
                        </div>
                        <div class="form-group">
                            <?php echo lang('gateway_label', 'gateway', 'required');?>
                            <?php echo form_input($gateway);?>
                        </div>
                        <div class="form-group">
                            <?php echo lang('merchant_id_label', 'merchant_id', 'required');?>
                            <?php echo form_input($merchant_id);?>
                        </div>
                        <div class="form-group">
                            <?php echo lang('merchant_key_label', 'merchant_key', 'required');?>
                            <?php echo form_input($merchant_key);?>
                        </div>
                        <div class="form-group">
                            <?php echo lang('salt_label', 'salt', 'required');?>
                            <?php echo form_input($salt);?>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="box-footer">
                    <div class="pull-right">
                        <?php echo form_submit('submit', lang('submit_btn'),"class='btn btn-primary btn-submit'");?>
                    </div>
                    <div class="clearfix"><!-- --></div>
                </div>
            </div>
        <?php echo form_close();?>
    </div>
</section>
