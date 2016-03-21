<div class="box box-primary no-top-border">
    <?php echo form_open(uri_string());?>
        <div class="box-header">
            <h4><?php echo 'Create Plan';?></h4>
        </div>
        <div class="box-body">
            <div class="box-info">
                <?php echo $message;?>
            </div>
            <div class="clearfix"><!-- --></div>
            <div class="form-group col-lg-3">
                <?php echo lang('plan_name', 'plan_name', 'required');?>
                <?php echo form_input($plan_name);?>
            </div>
            <div class="form-group col-lg-3">
                <?php echo lang('plan_price', 'plan_price', 'required');?>
                <?php echo form_input($plan_price);?>
            </div>
            <div class="form-group col-lg-3">
                <?php echo lang('plans_grp_name', 'plan_grps', 'required');?>
                <?php echo form_dropdown('plan_grps', $group, $plan_grps, ' class="form-control"');?>
            </div>
            <div class="form-group col-lg-3">
                <?php echo lang('plans_no_of_sites', 'plan_websites', 'required');?>
                <?php echo form_input($plan_websites);?>
            </div>
            <div class="clearfix"><!-- --></div>
            <div class="form-group col-lg-3">
                <?php echo lang('plan_recommends', 'plan_recommends', 'required');?>
                <?php echo form_dropdown('plan_recommends', array('yes'=>'Yes','no'=>'No'), $plan_recommends, ' class="form-control"');?>
            </div>
            <div class="form-group col-lg-3">
                <?php echo lang('plan_status', 'plan_status', 'required');?>
                <?php echo form_dropdown('plan_status',array('active'=>'Active','inactive'=>'Inactive'), $plan_status,'class="form-control"');?>
            </div>
            <div class="form-group col-lg-3">
                <?php echo lang('expiration_type', 'expiration_type', 'required');?>
                <?php echo form_dropdown('expiration_type', array('days'=>'Days','months'=>'Months','years'=>'Years'), $expiration_type, 'class="form-control"');?>
            </div>
            <div class="form-group col-lg-3">
                <?php echo lang('expiration', 'expiration', 'required');?>
                <?php echo form_input($expiration);?>
            </div>
            <div class="clearfix"><!-- --></div>
            <div class="form-group col-lg-12">
                <?php echo lang('plan_description', 'plan_description');?>
                <?php echo form_textarea($plan_description);?>
            </div>
            <div class="clearfix"><!-- --></div>
            <div class="form-group col-lg-3">
                <?php echo lang('discount_type', 'discount_type');?>
                <?php echo form_dropdown('discount_type', array('percentage'=>'Percentage(%)','ammount'=>'Fixed ammount'), $discount_type, 'class="form-control"');?>
            </div>
            <div class="form-group col-lg-3">
                <?php echo lang('discount', 'discount');?>
                <?php echo form_input($discount);?>
            </div>
            <div class="form-group col-lg-3">
                <?php echo lang('visitor_count', 'visitor_count');?>
                <?php echo form_dropdown('visitor_count', array('active'=>'Active','inactive'=>'Inactive'), $visitor_count, 'class="form-control"');?>
            </div>
<!--            <div class="form-group col-lg-3">
                <?php // echo lang('eccommerce', 'eccommerce');?>
                <?php // echo form_dropdown('eccommerce', array('active'=>'Active','inactive'=>'Inactive'), $eccommerce, 'class="form-control"');?>
            </div>-->
            <div class="form-group col-lg-3">
                <?php echo lang('premium_domain', 'premium_domain');?>
                <?php echo form_dropdown('premium_domain', array('active'=>'Active','inactive'=>'Inactive'), $premium_domain, 'class="form-control"');?>
            </div>
        </div>
        <div class="clearfix"><!-- --></div>
        <div class="box-footer">
            <div class="pull-left">
                <?php echo anchor(site_url('plans'), 'Back to plan list', array('class'=>'btn btn-primary btn-submit')) ;?>
            </div>
            <div class="pull-right">
                <?php echo form_submit('submit', 'Submit',"class='btn btn-primary btn-submit'");?>
            </div>
            <div class="clearfix"><!-- --></div>
        </div>
    <?php echo form_close();?>
</div>
<div class="modal fade" id="confirm-recom" tabindex="-1" role="dialog" aria-labelledby="Recommendation" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Change Recommendation</h4>
            </div>
            <div class="modal-body">
                If you change the recommendation of this plan, then previously recommended plan will not be recommended.
                <br>
                <br>
                Are you sure want to change this?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary btn-ok" href="javascript:void(0);">Change</a>
            </div>
        </div>
    </div>
</div>
<script>
    function isNumberKey(evt){
        var charCode = (evt.which) ? evt.which : evt.keyCode
        if (charCode > 31 && (charCode != 46 &&(charCode < 48 || charCode > 57)))
            return false;
        return true;
    }
    $(document).ready(function(){
       $('#plan_description').redactor({
           buttons:['html', 'formatting', 'bold', 'italic', 'deleted',
'unorderedlist', 'orderedlist', 'outdent', 'indent',
'image', 'link', 'alignment', 'horizontalrule'],
           focus: true,
       });
       
        $( "select[name='plan_recommends']" ).change(function () {
            if($( "select[name='plan_recommends'] option:selected" ).val()=='yes'){
                $('#confirm-recom').modal('show');
            }
            $( "select[name='plan_recommends'] option" ).removeAttr('selected');
            $( "select[name='plan_recommends'] option[value='no']" ).attr('selected','selected');
        });
        $('#confirm-recom').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').on('click',function(){
                $( "select[name='plan_recommends'] option" ).removeAttr('selected');
                $( "select[name='plan_recommends'] option[value='yes']" ).attr('selected','selected');
                $('#confirm-recom').modal('hide');
            });
        });
    });
</script>