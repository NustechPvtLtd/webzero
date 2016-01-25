<!-- Image Gallery Modal -->
<div class="modal fade " id="imageModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo $this->lang->line('modal_close') ?></span></button>
                <h4 class="modal-title" id="myModalLabel"><span class="fui-upload"></span> <?php echo $this->lang->line('modal_imagelibrary_heading') ?></h4>
            </div>
            <div class="modal-body">

                <div class="modal-alerts">

                </div>

                <div class="modal-body-content">

                    <ul class="nav nav-tabs nav-append-content">
                        <li class="active"><a href="#myImagesTab"><?php echo $this->lang->line('modal_imagelibrary_tab_myimages') ?></a></li>
                        <li><a href="#adminImagesTab"><?php echo $this->lang->line('modal_imagelibrary_tab_otherimages') ?></a></li>
                        <li id="uploadTabLI"><a href="#uploadTab"><?php echo $this->lang->line('modal_imagelibrary_tab_uploadimage') ?></a></li>
                    </ul> <!-- /tabs -->

                    <div class="tab-content">
                        <div class="tab-pane active" id="myImagesTab">
                            <div class="loader">
                                <img src="<?php echo base_url(); ?>assets/sites/images/loading.gif" alt="Loading...">
                                <?php echo $this->lang->line('loading_site_data') ?>
                            </div>
                        </div><!-- /.tab-pane -->
                        <div class="tab-pane" id="adminImagesTab">
                            <div class="loader">
                                <img src="<?php echo base_url(); ?>assets/sites/images/loading.gif" alt="Loading...">
                                <?php echo $this->lang->line('loading_site_data') ?>
                            </div>
                        </div><!-- /.tab-pane -->
                        <div class="tab-pane" id="uploadTab">
								<form id="imageUploadForm" action="<?php echo site_url('sites/assets/imageUploadAjax/' . $site->sites_id); ?>">
									<input type="hidden" name="hidden_site_id" value="<?PHP echo $site->sites_id; ?>" class="hide"/>
									<div class="fileinput fileinput-new" data-provides="fileinput">
										<div id="fileinput-preview" class="fileinput-preview thumbnail" data-trigger="fileinput"></div>
										<div>
											<span class="btn btn-primary btn-embossed btn-file">
												<span class="fileinput-new new"><span class="fui-image"></span>&nbsp;&nbsp;<?php echo $this->lang->line('modal_imagelibrary_button_selectimage') ?></span>
												<span class="fileinput-exists exists"><span class="fui-gear"></span>&nbsp;&nbsp;<?php echo $this->lang->line('modal_imagelibrary_button_change') ?></span>
												<input type="file" name="imageFile" id="imageFile" >
											</span>
											<a href="#" class="btn btn-primary btn-embossed fileinput-exists exists" data-dismiss="fileinput"><span class="fui-trash"></span>&nbsp;&nbsp;<?php echo $this->lang->line('modal_imagelibrary_button_remove') ?></a>
										</div>
										<!--<span class="info">Image size should not exceed 1024*768px ... </span>-->
									</div>
									
								</form>
                            <hr>

                            <button type="button" class="btn btn-primary btn-embossed btn-wide upload btn-block disabled" id="uploadImageButton"><span class="fui-upload"></span> <?php echo $this->lang->line('modal_imagelibrary_button_upload') ?></button>
                            <button type="button" class="btn btn-primary btn-embossed btn-wide upload btn-block disabled" id="uploadImageButtonDrop"><span class="fui-upload"></span> <?php echo $this->lang->line('modal_imagelibrary_button_upload') ?></button>
                            <hr>
                            <p class="note"><strong>Note:-</strong> Max. 2MB of files are allowed.</p>
                        </div><!-- /.tab-pane -->
                    </div><!-- /.tab-pane -->
                </div> <!-- /tab-content -->

            </div>

        </div><!-- /.modal-body -->
        <div class="modal-footer">
            <button type="button" class="btn btn-default btn-embossed" data-dismiss="modal"><?php echo $this->lang->line('modal_cancelclose') ?></button>
        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->

</div><!-- /.modal -->
