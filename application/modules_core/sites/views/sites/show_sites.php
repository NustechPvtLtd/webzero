<div class="">
    <div class="box box-primary no-top-border">	
        <div class="box-header">
            <h4>My Sites: </h4>
        </div>
        <div class="box-body">
            <div class="row">
                <?php foreach ($sites as $templates) { ?>          
                    <div class="col-md-2 col-sm-4">
                        <div class="template-item">
                            <iframe  src="<?php echo site_url('sites/preview_profile/'. $this->encrypt->encode($templates['siteData']->sites_id)); ?>" class="embed-responsive-item" scrolling="no"/></iframe>
                            <span class="name_temp">
                                <img border="0" src="http://chart.apis.google.com/chart?chs=150x150&amp;cht=qr&amp;chld=M|10&amp;chl=<?php echo (isset($templates['siteData']->remote_url) && !empty($templates['siteData']->remote_url)) ? urlencode($templates['siteData']->remote_url) : urlencode(site_url()) ?>" title="<?php echo (isset($templates['siteData']->sites_name) && !empty($templates['siteData']->sites_name)) ? ucfirst($templates['siteData']->sites_name) : "My New Site"; ?>">
                            </span>
                        </div> 
                        <?php echo anchor(site_url('sites/' . $templates['siteData']->sites_id), 'Edit', 'class="pull-right prev_btn btn btn-sm btn-primary "'); ?>
                        <?php echo anchor(site_url('sites/preview_profile/' . $this->encrypt->encode($templates['siteData']->sites_id)), 'Preview', 'class="prev_btn btn btn-sm btn-primary " target="_blank"'); ?>
                    </div>
                <?php } ?>       
            </div>
        </div>
        <div class="box-footer">
            <div class="pull-right ">                
                <?php
                $site_limit = userdata('sites_limit');
                $created_site = count($sites);
                if ($created_site < $site_limit) {
                    echo anchor(site_url('sites/create'), 'Create New site', 'class="btn btn-primary"');
                }
                ?>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

</div>

<style>
    .name_temp {
        position: absolute;
        top: 0;
        left: 0;
        margin: 0;
        height: 98%;
        width: 100%;
        text-align: center;
        padding-top: 45%;
        display: block; 
        background: rgba(0,0,0,0.5);
    }
    .template-item {       
        height: auto; 
        position: relative;
    }
    .template-item iframe {
        width: 100%;
        height: 305px;
    }
    .prev_btn{
        width:48%;
        margin-top: 0.5em;
        margin-bottom: 1.5em;
    }

</style>
