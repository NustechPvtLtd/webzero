<section class="content">
    <div class="container">
        <?php echo form_open_multipart(); ?>
        <div class="form-group">
            <?php echo $message;?>
        </div>
        <div class="form-group ">
            <div class="col-sm-12">
                <div class="col-sm-2">
                    <label for="name" class="control-label"  style="text-align:left;">Email Addresses:</label>
                </div>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inviteMails" name="emails" placeholder="Email Ids" value="">
                    <label class="mulemails"><?php echo $this->lang->line('sites_shareProfile_multipleids') ?></label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-12"><?php echo form_submit('submit','Invite Users','class="btn btn-primary"');?></div>
        </div>
        <?php echo form_close(); ?>
    </div>
</section>
