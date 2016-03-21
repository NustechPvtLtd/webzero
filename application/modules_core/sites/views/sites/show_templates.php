<div class="">
    <div class="box box-primary no-top-border">	
        <div class="box-header">
            <h4>My Templates: </h4>
        </div>
        <div class="box-body">
            <?php if (!empty($user_template)): ?>
                <div class="row">
                    <?php foreach ($user_template as $templates) { ?>
                        <div class="col-md-2 col-sm-4">
                            <div class="template-item">
                                <img src="<?php echo base_url() . $templates->preview; ?>"  alt="<?php echo $templates->template_name; ?>" width="100%"  class="img-thumbnail img-responsive" />
                                <span class="name_temp"><h4> <?php echo ucfirst($templates->template_name); ?></h4></span>
                            </div> 
                            <?php echo anchor('templates/preview/' .$templates->profile.'/'. $this->encrypt->encode($templates->template_id), 'Preview', 'class="prev_btn btn btn-primary pull-left" target="_blank"'); ?>
                            <?php echo anchor(site_url('sites/create_new_template/' .$templates->profile.'/'.$this->encrypt->encode($templates->template_id)) , 'Edit', 'class="prev_btn btn btn-primary pull-right"'); ?>
                        </div>
                    <?php } ?>
                </div>
            <?php else: ?>
                <div class="alert alert-info">There is no templates to show. Create your templates by using "Create New Template" button.</div>
            <?php endif; ?>
        </div>
        <div class="box-footer">
            <div class="pull-right ">                
                <?php echo anchor(NULL, 'Create New Template', 'class="btn btn-primary" data-target="#selectTemplate" data-toggle="modal"'); ?>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

</div>
<!-- Who Modal -->
<div id="selectTemplate" class="modal selectGroupModal" data-keyboard="false" >
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title"><span class='glyphicon glyphicon-exclamation-sign'></span> Please Tell What You Want To Create ?</h5>
            </div>
            <div class="modal-body">
                <div class="optionPane">
                    <div class="form-group col-sm-12">
                        <a href="<?php echo site_url('sites/create_new_template/student') ?>" class="col-sm-4">

                            <img width="100%" src="<?= base_url('assets/img/personal-icon.png'); ?>" alt="Student Template">
                            <h6><b>Student Template</b></h6>

                        </a>
                        <a href="<?php echo site_url('sites/create_new_template/ecommerce') ?>" class="col-sm-4">

                            <img width="100%" src="<?= base_url('assets/img/ecommerce-icon.png'); ?>" alt="Ecommerce Template">
                            <h6><b>Ecommerce Template</b></h6>

                        </a>
                        <a href="<?php echo site_url('sites/create_new_template/business') ?>" class="col-sm-4">

                            <img width="100%" src="<?= base_url('assets/img/business-icon.png'); ?>" alt="Business Template">
                            <h6><b>Business Template</b></h6>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .name_temp {
        position: absolute;
        top: 0;
        left: 0;
        margin: 0;
        height: 100%;
        width: 100%;
        text-align: center;
        border-radius:5px;
        display: none; /* comment this out for CSS hover */
        background: rgba(0,0,0,0.5);
    }
    .name_temp h4 {
        position: absolute;
        color: #fff;
        top: 45%;
        width: 100%;
        text-align: center;
    }
    .template-item {
        height: auto; 
        position: relative;
    }
    .template-item img {
        width: 100%;
    }
    .prev_btn{
        width:49%;
        margin-top: 0.5em;
        margin-bottom: 1.5em;
    }
    .col-md-2.col-sm-4 {
        min-height: 400px;
    }
    a h6{text-align: center;}
</style>
<script>
    $(document).ready(function() {
        $('.template-item').hover(function() {
            $(this).find('.name_temp').css('display', 'block');
            $(this).find('.name_temp').fadeIn(300);
        }, function() {
            $(this).find('.name_temp').fadeOut(100);
        });
    });

</script>