<style>
    .content {
        margin-bottom: 3px;
        margin-top: 80px;
    }
    .box .box-header {
        border-bottom: 1px solid #3c8dbc;
    }
</style>
<div class="container">
    <div class="content">
        <div class="box box-primary no-top-border">
            <form action="<?php echo $action; ?>" method="post" name="payuForm">
                <div class="box-header">
                    <h4><?php echo 'Please note down your transaction ID: ' . $txnid.' for selected plan '.$plan_name; ?></h4>
                </div>
                <div class="box-body">
                    <input type="hidden" name="key" value="<?php echo $key ?>" />
                    <input type="hidden" name="hash" value="<?php echo $hash ?>"/>
                    <input type="hidden" name="txnid" value="<?php echo $txnid ?>" />
                    <input type="hidden" name="surl" value="<?php echo $surl ?>" />
                    <input type="hidden" name="furl" value="<?php echo $furl ?>" />
                    <input type="hidden" name="curl" value="<?php echo $curl ?>" />
                    <input type="hidden" name="udf1" value="<?php echo $udf1 ?>" />
                    <input type="hidden" name="udf2" value="<?php echo $udf2 ?>" />
                    <input type="hidden" name="udf3" value="<?php echo $udf3 ?>" />
                    <input type="hidden" name="productinfo" value="<?php echo htmlspecialchars($productinfo); ?>" />
                    <input type="hidden" name="service_provider" value="<?php echo $service_provider ?>" />
                    <div class="clearfix"><!-- --></div>
                    <div class="form-group col-lg-6">
                        <label for="firstname" >First Name</label>
                        <input type="text" name="firstname" id="firstname" value="<?= ($firstname)?$firstname:'';?>" required="" class="form-control"/>
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="lastname" >Last Name</label>
                        <input type="text" name="lastname" id="lastname" value="<?= ($lastname)?$lastname:'';?>" required="" class="form-control"/>
                    </div>
                    <div class="clearfix"><!-- --></div>
                    <div class="form-group col-lg-4">
                        <label for="email" >Email</label>
                        <input type="email" required="" name="email" id="email" value="<?= ($email)?$email:'';?>"  class="form-control"/>
                    </div>
                    <div class="form-group col-lg-4">
                        <label for="phone" >Phone</label>
                        <input name="phone" value="" required="" class="form-control" pattern="[0-9]{7,10}" title="phone no. must be 7 to 10 characters long and only numbers are allowed" />
                    </div>
                    <div class="form-group col-lg-4">
                        <label for="amount" >Amount Payable(<i class="fa fa-inr"></i>)</label>
                        <input type="text" name="amount" value="<?php echo (empty($amount)) ? '' : $amount ?>" onkeypress="isNumberKey()" required="" class="form-control" readonly=""/>
                    </div>
                    <div class="clearfix"><!-- --></div>

                </div>
                <div class="clearfix"><!-- --></div>
                <div class="box-footer">
                    <div class="pull-left">
                        <?php echo anchor(site_url('choose-plan/' . $this->encrypt->encode($user_id)), 'Back to plan list', array('class' => 'btn btn-primary btn-submit')); ?>
                    </div>
                    <div class="pull-right">
                        <?php echo form_submit('submit', 'Submit', "class='btn btn-primary btn-submit'"); ?>
                    </div>
                    <div class="clearfix"><!-- --></div>
                </div>
            </form>
        </div>
    </div>
    <script>
        function isNumberKey(evt) {
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode != 46 && (charCode < 48 || charCode > 57)))
                return false;
            return true;
        }
    </script>
</div>