<div class="content-inner">

    <div class="col-lg-4 col-md-4">
        <div class="panel_new">
            <div class="login-wrapper">
                <a href="<?php echo site_url('sites'); ?>">
                    <div id="user-info">
                        <img class="cover img-responsive" src="<?php echo base_url(); ?>assets/customer/img/Landing_page.png" alt="Web Page">
                        <h4 class="headline">Marketing Page</h4>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <?php if (userdata('visitor_count') != 'inactive'): ?>
        <div class="col-lg-4 col-md-4">
            <div class="panel_new">
                <div class="login-wrapper">
                    <a href="<?php echo site_url('visitor'); ?>">
                        <div id="user-info">
                            <img class="cover img-responsive" src="<?php echo base_url(); ?>assets/customer/img/report.png" alt="Report">
                            <h4 class="headline">Report</h4>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="col-lg-4 col-md-4">
        <div class="panel_new">
            <div class="login-wrapper">
                <a href="<?php echo site_url('seo'); ?>">
                    <div id="user-info">
                        <img class="cover img-responsive" src="<?php echo base_url(); ?>assets/customer/img/SEO.png" alt="user-image">
                        <h4 class="headline">Become Popular</h4>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-4">
        <div class="panel_new">
            <div class="login-wrapper">
                <a href="<?php echo site_url('account/plans'); ?>">
                    <div id="user-info">
                        <img class="cover img-responsive" src="<?php echo base_url(); ?>assets/customer/img/account.png" alt="Account">
                        <h4 class="headline">Account</h4>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <?php if (userdata('premium_domain') != 'inactive'): ?>
        <div class="col-lg-4 col-md-4">
            <div class="panel_new">
                <div class="login-wrapper">
                    <a href="<?php echo site_url('domain'); ?>">
                        <div id="user-info">
                            <img class="cover img-responsive" src="<?php echo base_url(); ?>assets/customer/img/premium_domain.png" alt="Premium Domain">
                            <h4 class="headline">Premium Domain</h4>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="col-lg-4 col-md-4">
        <div class="panel_new">
            <div class="login-wrapper">
                <a href="<?php echo site_url('services'); ?>">
                    <div id="user-info">
                        <img class="cover img-responsive" src="<?php echo base_url(); ?>assets/customer/img/support.png" alt="support">
                        <h4 class="headline">Support</h4>
                    </div>
                </a>
            </div>
        </div>
    </div>

</div>
<!-- Who Modal -->
<div id="myModal" class="modal selectGroupModal" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title"><span class='glyphicon glyphicon-exclamation-sign'></span> Please Tell What You Want To Create ?</h3>
            </div>
            <div class="modal-body">
                <?php echo form_open(site_url('services'),array('id'=>'update_group_form'));?>
                    <div class="optionPane">
                        <div class="form-group col-sm-12">
                            <?php 
                            $n = count($group);
                            $l = floor(12/$n);
                            foreach ($group as $key => $value) {
                            ?>
                            <label class="<?= 'col-sm-'.$l;?> group-label">
                                <input type="radio" name="group" value="<?= $key;?>" />
                                <?php
                                    $img_url = '';
                                    $lbl = '';
                                    if($value=='students'){
                                        $img_url = base_url('assets/img/personal-icon.png');
                                        $lbl = 'Personal Profile';
                                    }  elseif ($value=='individuals') {
                                        $img_url = base_url('assets/img/business-icon.png');
                                        $lbl = 'Business Website';
                                    } elseif ($value=='ecommerce') {
                                        $img_url = base_url('assets/img/ecommerce-icon.png');
                                        $lbl = 'Ecommerce Website';
                                    }
                                ?>
                                <img src="<?= $img_url;?>" alt="<?= $lbl;?>">
                                <h4><b><?= $lbl;?></b></h4>
                            </label>
                            <?php
                            }
                            ?>
                            <?php  echo form_input(array('name' => 'group', 'type'=>'hidden', 'id' =>'group'));?>
                        </div>
                    </div>
                <?php echo form_close();?>
            </div>
<!--            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-embossed" id="Submit" >Submit</button>
            </div>-->
        </div>

    </div>
</div>