<div class="content-inner">
    
    <div class="col-lg-4 col-md-4">
        <div class="panel_new">
            <div class="login-wrapper">
                <a href="<?php echo site_url('sites');?>">
                    <div id="user-info">
                        <img class="cover img-responsive" src="<?php echo base_url();?>assets/customer/img/Landing_page.png" alt="Web Page">
                        <h4 class="headline">Marketing Page</h4>
                    </div>
                </a>
            </div>
        </div>
    </div>
    
    <?php if(userdata( 'visitor_count' )!='inactive'):?>
    <div class="col-lg-4 col-md-4">
        <div class="panel_new">
            <div class="login-wrapper">
                <a href="<?php echo site_url('visitor');?>">
                    <div id="user-info">
                        <img class="cover img-responsive" src="<?php echo base_url();?>assets/customer/img/report.png" alt="Report">
                        <h4 class="headline">Report</h4>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <?php endif;?>
    
    <div class="col-lg-4 col-md-4">
        <div class="panel_new">
            <div class="login-wrapper">
                <a href="<?php echo site_url('seo');?>">
                    <div id="user-info">
                        <img class="cover img-responsive" src="<?php echo base_url();?>assets/customer/img/SEO.png" alt="user-image">
                        <h4 class="headline">Become Popular</h4>
                    </div>
                </a>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4 col-md-4">
        <div class="panel_new">
            <div class="login-wrapper">
                <a href="<?php echo site_url('account/plans');?>">
                    <div id="user-info">
                        <img class="cover img-responsive" src="<?php echo base_url();?>assets/customer/img/account.png" alt="Account">
                        <h4 class="headline">Account</h4>
                    </div>
                </a>
            </div>
        </div>
    </div>
    
    <?php if(userdata( 'premium_domain' )!='inactive'):?>
    <div class="col-lg-4 col-md-4">
        <div class="panel_new">
            <div class="login-wrapper">
                <a href="<?php echo site_url('domain');?>">
                    <div id="user-info">
                        <img class="cover img-responsive" src="<?php echo base_url();?>assets/customer/img/premium_domain.png" alt="Premium Domain">
                        <h4 class="headline">Premium Domain</h4>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <?php endif;?>
    
    <div class="col-lg-4 col-md-4">
        <div class="panel_new">
            <div class="login-wrapper">
                <a href="<?php echo site_url('services');?>">
                    <div id="user-info">
                        <img class="cover img-responsive" src="<?php echo base_url();?>assets/customer/img/support.png" alt="support">
                        <h4 class="headline">Support</h4>
                    </div>
                </a>
            </div>
        </div>
    </div>
    
</div>