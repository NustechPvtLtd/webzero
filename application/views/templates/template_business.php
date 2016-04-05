<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php
            if (isset($pageTitle)) {
                echo $pageTitle;
            } else {
                echo $this->lang->line('alternative_page_title');
            }
            ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Loading Bootstrap -->
        <link href="<?php echo base_url('assets/sites'); ?>/bootstrap/css/bootstrap.css" rel="stylesheet">

        <!-- Loading Flat UI -->
        <link href="<?php echo base_url('assets/sites'); ?>/css/flat-ui.css" rel="stylesheet">

        <link href="<?php echo base_url('assets/sites'); ?>/css/style.css" rel="stylesheet">
        <link href="<?php echo base_url('assets/sites'); ?>/css/builder.css" rel="stylesheet">

        <link href="<?php echo base_url('assets/sites'); ?>/css/spectrum.css" rel="stylesheet">
        <link href="<?php echo base_url('assets/sites'); ?>/css/chosen.css" rel="stylesheet">
        <link href="<?php echo base_url('assets/sites'); ?>/css/custom-skin-green.css" rel="stylesheet">

        <link rel="shortcut icon" type="image/vnd.microsoft.icon" href="<?php echo base_url(); ?>assets/img/favicon.ico">

        <!-- Font Awesome -->
        <link href="<?php echo base_url('assets/sites'); ?>/css/font-awesome.css" rel="stylesheet">
        <link href="<?php echo base_url('assets/sites'); ?>/css/iconfont-style.css" rel="stylesheet">

        <link href="<?php echo base_url('assets/sites'); ?>/js/redactor/redactor.css" rel="stylesheet">

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
        <!--[if lt IE 9]>
          <script src="<?php echo base_url('assets/sites'); ?>/js/html5shiv.js"></script>
          <script src="<?php echo base_url('assets/sites'); ?>/js/respond.min.js"></script>
        <![endif]-->

        <link href="<?php echo base_url('assets'); ?>/css/adminlte.css" rel="stylesheet">

        <!-- Elements CSS -->

        <!-- Loading Elements Styles -->   
        <link href="<?php echo base_url('elements/css/style.css'); ?>" rel="stylesheet">

        <!-- Loading Magnific-Popup Styles --> 
        <link href="<?php echo base_url('elements/css/magnific-popup.css') ?>" rel="stylesheet"> 

        <!-- Loading Font Styles -->
        <link href="<?php echo base_url('elements/css/iconfont-style.css') ?>" rel="stylesheet">

        <!-- WOW Animate-->
        <link href="<?php echo base_url('elements/scripts/animations/animate.css') ?>" rel="stylesheet"/>

        <!-- Datepicker Styles -->   
        <link href="<?php echo base_url('elements/css/bootstrap-datepicker3.min.css'); ?>" rel="stylesheet">

        <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/blitzer/jquery-ui.css">

        <link href="<?php echo base_url('assets/sites'); ?>/css/new_builder.css" rel="stylesheet">
        <!--CUSTOM-JS-->

    </head>
    <body>
        <div class="header skin-green">
            <a href="<?php echo site_url(); ?>" class="logo icon">
                <img  class="img-responsive" src="<?php echo base_url(); ?>assets/img/logo.png" alt="Customer area" />
            </a>

            <nav class="navbar navbar-static-top" role="navigation">  
                <ul class="nav navbar-nav">
                    <li><a href="<?php echo site_url('sites/templates') ?>" id="backButton"><span class="fui-arrow-left"></span> <?php echo 'Back to Templates'; /* $this->lang->line( $t ) */ ?></a></li>
                </ul>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span><?php echo ($fullName = ucwords(userdata('username'))) ? $fullName : 'Welcome'; ?> <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="user-header bg-light-blue">
                                    <img src="<?php echo (userdata('avatar')) ? base_url('elements') . '/images/uploads/' . userdata('user_id') . '/' . userdata('avatar') . '?' . time() : base_url('assets') . '/sites/images/dude.png?' . time(); ?>" class="img-circle"/>
                                    <p>
                                        <?php echo ($fullName = ucwords(userdata('username'))) ? $fullName : 'Welcome'; ?>
                                    </p>
                                </li>
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="<?php echo site_url('user/profile') ?>" class="btn btn-default btn-flat"><?php echo 'My Profile'; ?></a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="<?php echo site_url('logout'); ?>" class="btn btn-default btn-flat"><?php echo 'Logout'; ?></a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="container">
            <header class="clearfix" data-spy="affix" data-offset-top="40" >
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-4">
                                <div class="modes">
                                    <b>Building mode:</b>
                                    <label class="radio primary first">
                                        <input type="radio" name="mode" id="modeBlock" value="block" data-toggle="radio" disabled="" checked="">
                                        Blocks
                                    </label>
                                    <label class="radio primary first">
                                        <input type="radio" name="mode" id="modeContent" value="content" data-toggle="radio" disabled="">
                                        Edit
                                    </label>
                                    <label class="radio primary first">
                                        <input type="radio" name="mode" id="modeStyle" value="styling" data-toggle="radio" disabled="">
                                        Styles
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-8 float-right">                               
                                <a href="#" id="saveAs" class=" btn btn-primary disabled actionButtons tempSavecls" data-toggle="modal" data-target="#myModal_temp"><span class="fui-check"></span> <span class="bLabel">Nothing to save</span></a>
                                <!--<span class="fui-check"></span> <span class="bLabel">Nothing new to save</span> -->                                

                                <a href="#previewModal" id="preview" data-toggle="modal" class="btn btn-primary disabled actionButtons" ><span class="fui-window"></span> Preview</a>
                                <a href="#" id="clearScreen" class="btn btn-danger disabled actionButtons"><span class="fui-trash"></span> Empty Page</a>

                            </div>
                        </div>
                    </div>
                </div>
            </header>
        </div><!-- /.container -->
        <div class="">
            <aside class="left-side sidebar-offcanvas" id="mn" data-spy="affix" data-offset-top="40">
                <div class="menu" id="menu" >
                    <a id="menu_bar" class="toggle"><span class="list-icon"><i></i><i></i><i></i></span></a>

                    <div class="main scrollbar-inner" id="main">
                        <h3>HTMLS</h3>

                        <ul id="htmltemplates">

                        </ul>
                        <hr>
                        <h3>Blocks</h3>

                        <ul id="elements">
                            <li><a href="#" id="all">All Blocks</a></li>
                        </ul>

                        <hr>

                        <h3>Pages</h3>

                        <ul id="pages">
                            <li style="display: none;" id="newPageLI">
                                <input type="text" value="index" name="page">
                                <span class="pageButtons">
                                    <a href="" class="fileEdit"><span class="fui-new"></span></a>
                                    <a href="" class="fileDel"><span class="fui-cross"></span></a>
                                    <a href="" class="fileCopy"><span class="fa fa-clipboard"></span></a>
                                    <a class="btn btn-xs btn-primary fileSave" href="#"><span class="fui-check"></span></a>
                                </span>
                            </li>                          
                            <li class="active">
                                <a href="#page1">index</a>
                                <span class="pageButtons">
                                    <a href="" class="fileCopy"><span class="fa fa-clipboard"></span></a>
                                </span>
                            </li>
                        </ul>
                        

                        <div class="sideButtons clearfix">
                            <!-- <a href="#" class="btn btn-success btn-sm btn-left" id="addPage">Add</a>-->
                        </div> 
                    </div><!-- /.main -->

                    <div class="second scrollbar-inner" id="second">

                        <ul id="elements">

                        </ul>
                        <ul id="htmltemplates">

                        </ul>
                    </div><!-- /.secondSide -->

                </div><!-- /.menu -->
            </aside>
            <aside class="right-side" id="scr">
                <?php echo $body; ?>
                <!-- Builder Body -->
            </aside>

        </div><!-- Wrapper -->
        <div id="styleEditor" class="styleEditor scrollbar-inner" >

            <a href="#" class="close"><span class="fui-cross-inverted"></span></a>

            <h3><span class="fui-new"></span> Detail Editor</h3>

            <ul class="breadcrumb">
                <li>Editing:</li>
                <li class="active" id="editingElement">p</li>
            </ul>
            <div class="alert alert-success" style="display: none;" id="detailsAppliedMessage">
                <button class="close fui-cross" type="button" id="detailsAppliedMessageHide"></button>
                The changes were applied successfully!
            </div>

            <div class="margin-bottom-5">
                <button type="button" class="btn btn-primary  btn-sm btn-block" id="saveStyling"><span class="fui-check-inverted"></span> Apply Changes</button>
            </div>

            <div class="sideButtons clearfix">
                <button type="button" class="btn btn-inverse  btn-xs" id="cloneElementButton"><span class="fui-windows"></span> Clone</button>
                <button type="button" class="btn btn-warning  btn-xs" id="resetStyleButton"><i class="fa fa-refresh"></i> Reset</button>
                <button type="button" class="btn btn-danger  btn-xs" id="removeElementButton"><span class="fui-cross-inverted"></span> Remove</button>
            </div>

            <ul class="nav nav-tabs" id="detailTabs">
                <li class="active"><a href="#tab1"><span class="fui-new"></span> Style</a></li>
                <li style="display: none;"><a href="#link_Tab" id="link_Link"><span class="fui-clip"></span> Link</a></li>
                <li style="display: none;"><a href="#image_Tab" id="img_Link"><span class="fui-image"></span> Image</a></li>
                <li style="display: none;"><a href="#icon_Tab" id="icon_Link"><span class="fa fa-flag"></span> Icons</a></li>
                <li style="display: none;"><a href="#video_Tab" id="video_Link"><span class="fa fa-youtube-play"></span> Video</a></li>
                <li style="display: none;"><a href="#map_Tab" id="map_Link"><span class="fa fa-map"></span> Map</a></li>
            </ul><!-- /tabs -->

            <div class="tab-content">

                <div class="tab-pane active" id="tab1">

                    <form class="" role="form" id="stylingForm">

                        <div id="styleElements">

                            <div class="form-group clearfix" style="display: none;" id="styleElTemplate">
                                <label for="" class="control-label"></label>
                                <input type="text" class="form-control input-sm" id="" placeholder="">
                            </div>

                        </div>

                    </form>

                </div>

                <!-- /tabs -->
                <div class="tab-pane link_Tab" id="link_Tab">

                    <select id="internalLinksDropdown">
                        <option value="#">Choose a page</option>
                        <option value="index.html">index</option>                        
                    </select>

                    <p class="text-center or">
                        <span>OR</span>
                    </p>

                    <select id="pageLinksDropdown">
                        <option value="#">Choose a block (one page sites)</option>
                    </select>

                    <p class="text-center or">
                        <span>OR</span>
                    </p>

                    <input type="text" class="form-control" id="internalLinksCustom" placeholder="http://somewhere.com/somepage" value="">

                </div>

                <!-- /tabs -->
                <div class="tab-pane imageFileTab" id="image_Tab">

                    <label><?php echo $this->lang->line('enter_image_path') ?>:</label>

                    <input type="text" class="form-control" id="imageURL" placeholder="Enter an image URL" value="">

                    <p class="text-center or">
                        <span>OR</span>
                    </p>

                    <a href="#imageModal" data-toggle="modal" type="button" class="btn btn-default btn-embossed btn-block margin-bottom-20"><span class="fui-image"></span> <?php echo $this->lang->line('modal_imagelibrary') ?></a>

                </div><!-- /.tab-pane -->

                <!-- /tabs -->
                <div class="tab-pane iconTab" id="icon_Tab">

                    <label>Choose an icon below: </label>
                    <?php $this->load->view("partials/icon_dropdown.php"); ?>
                </div><!-- /.tab-pane -->

                <!-- /tabs -->
                <div class="tab-pane videoTab" id="video_Tab">

                    <label>Youtube video ID:</label>

                    <input type="text" class="form-control margin-bottom-20" id="youtubeID" placeholder="Enter a Youtube video ID" value="">

                    <p class="text-center or">
                        <span>OR</span>
                    </p>

                    <label>Vimeo video ID:</label>

                    <input type="text" class="form-control margin-bottom-20" id="vimeoID" placeholder="Enter a Vimeo video ID" value="">

                    <p class="text-center or">
                        <span>OR</span>
                    </p>
                    <input type="hidden" class="form-control" id="videoURL" placeholder="Enter an video URL" value="">
                    <a href="#videoModal" data-toggle="modal" type="button" class="btn btn-default btn-embossed btn-block margin-bottom-20"><span class="fui-video"></span> <?php echo $this->lang->line('modal_videolibrary') ?></a>

                </div><!-- /.tab-pane -->

                <div class="tab-pane " id="map_Tab">

                    <label>Enter Address:</label>

                    <input type="text" class="form-control margin-bottom-20" id="address" placeholder="Enter your address" value="">

                </div><!-- /.tab-pane -->

            </div> <!-- /tab-content -->

        </div><!-- /.styleEditor -->

        <div id="hidden">
            <iframe src="<?php echo base_url(); ?>elements/skeleton.html" id="skeleton"></iframe>
        </div>

        <!-- modals -->



        <!-- preview HTML popup -->
        <div class="modal fade" id="previewModal" tabindex="-1" role="dialog" aria-hidden="true">

            <form action="<?php echo site_url('sites/preview'); ?>" target="_blank" id="markupPreviewForm" method="post" class="form-horizontal">

                <input type="hidden" name="markup" value="" id="markupField">

                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title" id="myModalLabel"><span class="fui-window"></span> Preview Page</h4>
                        </div>
                        <div class="modal-body">

                            <p>
                                <b>Please note:</b> you can only preview a single page; links to other pages won't work. When you make changes to your page, reloading the preview won't work, instead you'll have to use the "Preview" button again.
                            </p>

                        </div><!-- /.modal-body -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default " data-dismiss="modal" id="previewCancel">Cancel & Close</button>
                            <button type="submit" class="btn btn-primary " id="showPreview">Show Preview</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->

            </form>

        </div><!-- /.modal -->

        <!-- delete single block popup -->
        <div class="modal fade small-modal" id="deleteBlock" tabindex="-1" role="dialog" aria-hidden="true">

            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">

                        Are you sure you want to delete this block?

                    </div><!-- /.modal-body -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default " data-dismiss="modal">Cancel & Close</button>
                        <button type="button" class="btn btn-primary " id="deleteBlockConfirm">Delete</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->

        </div><!-- /.modal -->

        <!-- reset block popup -->
        <div class="modal fade small-modal" id="resetBlock" tabindex="-1" role="dialog" aria-hidden="true">

            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">

                        <p>
                            Are you sure you want to reset this block?
                        </p>
                        <p>
                            All changes made to the content will be destroyed.
                        </p>

                    </div><!-- /.modal-body -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default " data-dismiss="modal">Cancel & Close</button>
                        <button type="button" class="btn btn-primary " id="resetBlockConfirm">Reset</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->

        </div><!-- /.modal -->


        <!-- delete all blocks popup -->
        <div class="modal fade small-modal" id="deleteAll" tabindex="-1" role="dialog" aria-hidden="true">

            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">

                        Are you sure you want to remove this page?

                    </div><!-- /.modal-body -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default " data-dismiss="modal">Cancel & Close</button>
                        <button type="button" class="btn btn-primary " id="deleteAllConfirm">Delete</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->

        </div><!-- /.modal -->

        <!-- delete page popup -->
        <div class="modal fade small-modal" id="deletePage" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">

                        Are you sure you want to delete this entire page?

                    </div><!-- /.modal-body -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default " data-dismiss="modal" id="deletePageCancel"  onclick="$('#deletePage').modal('hide');">Cancel & Close</button>
                        <button type="button" class="btn btn-primary " id="deletePageConfirm">Delete</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->

        </div><!-- /.modal -->

        <!-- delete elemnent popup -->
        <div class="modal fade small-modal" id="deleteElement" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">

                        Are you sure you want to delete this element? Once deleted, it can not be restored.

                    </div><!-- /.modal-body -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default " data-dismiss="modal" id="deletePageCancel">Cancel & Close</button>
                        <button type="button" class="btn btn-primary " id="deleteElementConfirm">Delete</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->

        </div><!-- /.modal -->

        <!-- edit content popup -->
        <div class="modal fade" id="editContentModal" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">

                        <textarea id="contentToEdit"></textarea>

                    </div><!-- /.modal-body -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel & Close</button>
                        <button type="button" class="btn btn-primary" id="updateContentInFrameSubmit">Save Content</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->

        </div><!-- /.modal -->

        <!-- massage dialog popup -->
        <div class="modal fade" id="massageDialog" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">

                    </div><!-- /.modal-body -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->

        </div><!-- /.modal -->        

        <?php $this->load->view("shared/modal_imagegallery.php"); ?>

        <!-- Video Gallery Modal -->
        <div class="modal fade " id="videoModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo $this->lang->line('modal_close') ?></span></button>
                        <h4 class="modal-title" id="myModalLabel"><span class="fui-upload"></span> <?php echo $this->lang->line('modal_videolibrary_heading') ?></h4>
                    </div>
                    <div class="modal-body">

                        <div class="loader" style="display: none;">
                            <img src="<?php echo base_url(); ?>assets/sites/images/loading.gif" alt="Loading...">
                            <?php echo $this->lang->line('modal_videolibrary_loadertext'); ?>
                        </div>

                        <div class="modal-alerts">

                        </div>

                        <div class="modal-body-content">

                            <ul class="nav nav-tabs nav-append-content">
                                <li class="active"><a href="#myVideosTab"><?php echo $this->lang->line('modal_videolibrary_tab_myvideos') ?></a></li>
                                <li id="uploadTabLI"><a href="#uploadVideoTab"><?php echo $this->lang->line('modal_videolibrary_tab_uploadvideo') ?></a></li>
                            </ul> <!-- /tabs -->

                            <div class="tab-content">

                                <div class="tab-pane active" id="myVideosTab">

                                    <?php if ($userVideos): ?>

                                        <?php $this->load->view("partials/myvideos.php", array('userVideos' => $userVideos, 'bucket' => $bucket)); ?>

                                    <?php else: ?>

                                        <!-- Alert Info -->
                                        <div class="alert alert-info">
                                            <button type="button" class="close fui-cross" data-dismiss="alert"></button>
                                            <?php echo $this->lang->line('modal_videolibrary_message_novideos'); ?>
                                        </div>

                                    <?php endif; ?>

                                </div><!-- /.tab-pane -->

                                <div class="tab-pane" id="uploadVideoTab">

                                    <form id="videoUploadForm" action="<?php echo site_url('sites/amazon_services/videoUploadAjax/'); ?>">

                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div id="videoinput-preview" class="fileinput-preview thumbnail" data-trigger="fileinput"></div>
                                            <div>
                                                <span class="btn btn-primary btn-embossed btn-file">
                                                    <span class="fileinput-new new"><span class="fui-video"></span>&nbsp;&nbsp;<?php echo $this->lang->line('modal_videolibrary_button_selectvideo') ?></span>
                                                    <span class="fileinput-exists exists"><span class="fui-gear"></span>&nbsp;&nbsp;<?php echo $this->lang->line('modal_videolibrary_button_change') ?></span>
                                                    <input type="file" name="videoFile" id="videoFile" >
                                                </span>
                                                <a href="#" class="btn btn-primary btn-embossed fileinput-exists exists" data-dismiss="fileinput"><span class="fui-trash"></span>&nbsp;&nbsp;<?php echo $this->lang->line('modal_videolibrary_button_remove') ?></a>
                                            </div>
                                        </div>

                                    </form>

                                    <hr>

                                    <button type="button" class="btn btn-primary btn-embossed btn-wide upload btn-block disabled" id="uploadVideoButton"><span class="fui-upload"></span> <?php echo $this->lang->line('modal_videolibrary_button_upload') ?></button>
                                    <button type="button" class="btn btn-primary btn-embossed btn-wide upload btn-block disabled" id="uploadVideoButtonDrop"><span class="fui-upload"></span> <?php echo $this->lang->line('modal_videolibrary_button_upload') ?></button>

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

        <div class="modal fade" id="confirm-save-temp" tabindex="-1" role="dialog" aria-labelledby="Recommendation" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="warning">Save Templates</h4>
                    </div>
                    <div class="modal-body">
                        Please make sure you have finalized your template before save. You can not edit your template after save operation. 
                        <br>
                        <br>
                        Press <b>"OK"</b> to save your template!
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <a href="#" class="btn btn-primary btn-save-temp" data-toggle="modal" data-target="#myModal_temp" data-dismiss="modal">OK</a>
                    </div>
                </div>
            </div>
        </div>
        <div id="loader">
            <span>
                <img src="<?php echo base_url('assets/sites'); ?>/images/loading.gif" alt="Loading...">
                Jadooweb builder...
            </span>
        </div>

        <div class="sandboxes" id="sandboxes" style="display: none"></div>

        <!-- Load JS here for greater good =============================-->
        <script src="<?php echo base_url('elements/scripts/jquery-1.11.2.min.js'); ?>"></script> 
        <script src="<?php echo base_url('assets/sites'); ?>/js/jquery-ui.min.js"></script>
        <script src="<?php echo base_url('assets/sites'); ?>/js/jquery.ui.touch-punch.min.js"></script>
        <script src="<?php echo base_url('assets/sites'); ?>/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url('assets/sites'); ?>/js/bootstrap-select.js"></script>
        <script src="<?php echo base_url('assets/sites'); ?>/js/flatui-checkbox.js"></script>
        <script src="<?php echo base_url('assets/sites'); ?>/js/flatui-radio.js"></script>
        <script src="<?php echo base_url('assets/sites'); ?>/js/jquery.tagsinput.js"></script>
        <script src="<?php echo base_url('assets/sites'); ?>/js/flatui-fileinput.js"></script>
        <script src="<?php echo base_url('assets/sites'); ?>/js/jquery.placeholder.js"></script>
        <script src="<?php echo base_url('assets/sites'); ?>/js/jquery.zoomer.js"></script>
        <script src="<?php echo base_url('assets/sites'); ?>/js/application.js"></script>
        <script src="<?php echo base_url('assets/sites'); ?>/js/sites.js"></script>
        <script src="<?php echo base_url('assets/sites'); ?>/js/spectrum.js"></script>
        <script src="<?php echo base_url('assets/sites'); ?>/js/chosen.jquery.min.js"></script>
        <script src="<?php echo base_url('assets/sites'); ?>/js/redactor/redactor.js"></script>
        <script src="<?php echo base_url('assets/sites'); ?>/js/redactor/table.js"></script>
        <script src="<?php echo base_url('assets/sites'); ?>/js/redactor/bufferButtons.js"></script>
        <script src="<?php echo base_url('assets/sites'); ?>/js/redactor/video.js"></script>
        <script src="<?php echo base_url('assets/sites'); ?>/js/src-min-noconflict/ace.js"></script>
        <script src="<?php echo base_url(); ?>elements.json"></script>
        <script src="<?php echo base_url('assets/sites'); ?>/js/builder.js"></script>
        <script src="<?php echo base_url('assets/sites'); ?>/js/jquery.form.min.js"></script>
        <script src="<?php echo base_url('assets/sites'); ?>/js/scrollbar/jquery.nicescroll.min.js"></script>
        <script src="<?php echo base_url('assets/sites/js/bootstrap-switch.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/adminlte.js'); ?>"></script>
        <script src="<?php echo base_url('elements/scripts/html5gallery.js'); ?>" type="text/javascript" ></script>

        <!-- Loading Elements JS -->
<!--        <script src="<?php // echo base_url('elements/scripts/jquery-1.11.2.min.js');           ?>"></script> 
        <script src="<?php // echo base_url('elements/scripts/bootstrap.min.js');           ?>"></script> -->
        <script src="<?php echo base_url('elements/scripts/jquery.validate.min.js'); ?>"></script>
        <!--<script src="<?php echo base_url('elements/scripts/smoothscroll.js'); ?>"></script>--> 
        <script src="<?php echo base_url('elements/scripts/jquery.smooth-scroll.min.js'); ?>"></script> 
        <!--<script src="<?php echo base_url('elements/scripts/placeholders.jquery.min.js'); ?>"></script>--> 
        <script src="<?php echo base_url('elements/scripts/jquery.magnific-popup.min.js'); ?>"></script>
        <script src="<?php echo base_url('elements/scripts/jquery.counterup.min.js'); ?>"></script>
        <script src="<?php echo base_url('elements/scripts/waypoints.min.js'); ?>"></script>
        <script src="<?php echo base_url('elements/scripts/video.js'); ?>"></script>
        <script src="<?php echo base_url('elements/scripts/bigvideo.js'); ?>"></script>
        <script src="<?php echo base_url('elements/scripts/animations/wow.min.js'); ?>"></script>
        <script src="<?php echo base_url('elements/scripts/jquery.jCounter-0.1.4.js'); ?>"></script>
        <script src="<?php echo base_url('elements/scripts/bootstrap-datepicker.min.js'); ?>"></script>
        <script src="<?php echo base_url('elements/scripts/custom.js'); ?>"></script>
        <script src="<?php echo base_url('elements/scripts/autoNumeric.js'); ?>"></script>
        <script type="text/javascript" defer="defer" src="<?php echo base_url(); ?>assets/js/bootbox.min.js"></script>
        <?php if (isset($js)) echo implode("\n", $js) . "\n"; ?>
        <script>

            var baseUrl = "<?php echo base_url(); ?>";
            var siteUrl = "<?php echo site_url('/'); ?>";

            var display_ecom = '<?php echo (userdata('eccommerce') == 'inactive') ? 'no' : 'yes'; ?>';
<?php if (isset($siteData)): ?>
                var siteID = <?php if(isset($siteData['site']->sites_id))echo $siteData['site']->sites_id; else echo"0"; ?>;
                var templateID = <?php if(isset($siteData['site']->template_id)) echo $siteData['site']->template_id; else echo"0"; ?>;

<?php else: ?>
                var siteID = 0;
                var templateID=0;
               
<?php endif; ?>

<?php if (isset($pagesData)): ?>
                var pagesData = <?php echo json_encode($pagesData); ?>;
<?php endif; ?>
            var _HtmlElements = <?php echo $all_templates_data; ?>;
            var userImageLoaded = false;
            $(function() {

                var ua = window.navigator.userAgent;
                var msie = ua.indexOf("MSIE ");

                /*if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)) {
                 
                 $('.modes #modeContent').parent().hide();
                 
                 } else {
                 
                 $('.modes #modeContent').parent().show();
                 
                 }*/

                 $('.btn-save-temp').on('click',function(){
                    $("#confirm-save-temp").modal('hide'); 
                 });
                 <?php if (isset($siteData)): ?>

                    //make sortable

                    $('#pageList > ul').each(function() {
                        makeSortable($(this));
                    });

                    $('#pageList li > section').each(function() {

                        theHeight = $(this).attr('data-height');
                        //add height to frames array
                        $(this).css('height', theHeight + "px");

                        $(this).css('padding', '0px');
                        $(this).css('z-index', '0');
                        heightAdjustment($(this).attr('id'), true);

                        //add a delete button
                        delButton = $('<button type="button" class="btn btn-danger deleteBlock"><span class="fui-trash"></span> remove</button>');
                        resetButton = $('<button type="button" class="btn btn-warning resetBlock"><i class="fa fa-refresh"></i> reset</button>');
                        htmlButton = $('<button type="button" class="btn btn-inverse htmlBlock"><i class="fa fa-code"></i> source</button>');

                        frameCover = $('<div class="frameCover"></div>');

                        frameCover.append(delButton);
                        frameCover.append(resetButton);
                        frameCover.append(htmlButton);

                        $(this).closest('li').append(frameCover);

                    });


                    allEmpty();

<?php endif; ?>

            });

        </script>

        <style>
            button#uploadImageButtonDrop{
                position: relative;
                display: none;
            }
            button#uploadVideoButtonDrop{
                position: relative;
                display: none;
            }
        </style>
        <script>
<?php $this->load->view("shared/js_imagegallery.php"); ?>
        </script>
        <script defer="defer">
            (function() {
                // file drag hover
                function FileDragHover(e) {
                    e.stopPropagation();
                    e.preventDefault();
                    e.target.className = (e.type == "dragover" ? "hover fileinput-preview thumbnail" : "fileinput-preview thumbnail");
                }

                // file selection
                function ImageSelectHandler(e) {

                    $("#uploadImageButton").hide();
                    $("#uploadImageButtonDrop").css("display", "block");
                    $(".exists").css("display", "inline");
                    $(".new").css("display", "none");

                    // cancel event and hover styling
                    FileDragHover(e);

                    // fetch FileList object
                    files = e.target.files || e.dataTransfer.files;

                    // process all File objects
                    for (var i = 0, f; f = files[i]; i++) {
                        ParseFile(f);
                    }

                }

                $('button#uploadImageButtonDrop').click(function() {

                    // START A LOADING SPINNER HERE

                    //remove old alerts
                    $('#imageModal .modal-alerts > *').remove();

                    //disable button
                    $('button#uploadImageButton').addClass('disable');

                    //show loader
                    $('#imageModal .loader').fadeIn(500);

                    // Create a formdata object and add the files

                    for (var i = 0; i < files.length; i++)
                    {
                        var form = $('form#imageUploadForm');

                        var formdata = false;

                        if (window.FormData) {
                            fd = new FormData(form[0]);
                        }

                        fd.append('imageFile', files[i]);

                        sendFileToServer(fd);

                    }
                });

                function sendFileToServer(formData)
                {
                    var form = $('form#imageUploadForm');

                    var formAction = form.attr('action');

                    var extraData = {}; //Extra Data.
                    $.ajax({
                        url: formAction,
                        type: "POST",
                        contentType: false,
                        processData: false,
                        cache: false,
                        dataType: "json",
                        data: formData ? formData : form.serialize(),
                    }).done(function(ret) {

                        //enable button
                        $('button#uploadImageButtonDrop').addClass('disable');

                        //hide loader
                        $('#imageModal .loader').fadeOut(500);

                        if (ret.responseCode == 0) {//error

                            $('#imageModal .modal-alerts').append($(ret.responseHTML));

                        } else if (ret.responseCode == 1) {//success

                            //append my images
                            $('#myImagesTab > #myImages').remove();
                            $('#myImagesTab').append($(ret.myImages));

                            $('#imageModal .modal-alerts').append($(ret.responseHTML));

                            setTimeout(function() {
                                $('#imageModal .modal-alerts > *').fadeOut(500);
                            }, 3000);

                            $('#uploadTab').find('a.fileinput-exists').click();
                        }

                    });


                    $("#fileinput-preview").html(
                            '<img src="" />'
                            );
                    $("#uploadImageButton").show();
                    $("#uploadImageButtonDrop").css("display", "none");
                    $(".new").css("display", "inline");
                    $(".exists").css("display", "none");
                }

                // output file information
                function ParseFile(file) {

                    // display an image
                    if (file.type.indexOf("image") == 0) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $("#fileinput-preview").html(
                                    '<img src="' + e.target.result + '" />'
                                    );
                        };

                        $('button#uploadImageButtonDrop').removeClass('disabled');

                        reader.readAsDataURL(file);
                    }
                }


                // initialize
                function Init() {
                    var imagedrag = document.getElementById("fileinput-preview");

                    // is XHR2 available?
                    var xhr = new XMLHttpRequest();
                    if (xhr.upload) {
                        // file drop
                        imagedrag.addEventListener("dragover", FileDragHover, false);
                        imagedrag.addEventListener("dragleave", FileDragHover, false);
                        imagedrag.addEventListener("drop", ImageSelectHandler, false);
                        //filedrag.style.display = "block";
                    }
                }

                // call initialization file
                if (window.File && window.FileList && window.FileReader) {
                    Init();
                }

            })();

            $(".exists").click(function() {
                $(".new").css("display", "inline");
                $(".exists").css("display", "none");
                $("#uploadImageButtonDrop").css("display", "none");
                $("#uploadImageButton").show();
            });

            $("#imageFile").click(function() {
                $('input#imageFile').change(function() {
                    if ($(this).val() != '') {
                        $(".new").css("display", "none");
                        $(".exists").css("display", "inline");
                        $("#uploadImageButtonDrop").css("display", "none");
                        $("#uploadImageButton").show();
                    }
                });
            });
        </script>
        <script>
            function init() {
                var imgDefer = document.getElementsByTagName('img');
                for (var i = 0; i < imgDefer.length; i++) {
                    if (imgDefer[i].getAttribute('data-src')) {
                        imgDefer[i].setAttribute('src', imgDefer[i].getAttribute('data-src'));
                    }
                }
            }
            window.onload = init;
        </script> 
        <script type="text/javascript">
            function capture() {
                $('#page1').html2canvas({
                    background: "#fff",
                    allowTaint: true,
                    logging: true,
                    taintTest: false,
                    // proxy: "https://raw.githubusercontent.com/brcontainer/html2canvas-php-proxy/master/html2canvasproxy.php",
                    onrendered: function(canvas) {

                        
                        //Set hidden field's value to image data (base-64 string)
                          var img = canvas.toDataURL("image/png");
                        
                        $('#img_val').val(img);
                        //document.getElementById("take_template").submit();
                        //return img;
                    }

                });

            }
            $(document).ready(function() {
                $('#myModal_temp').on('show.bs.modal', function() {

                    var body = $("body, html");
                    var top = body.scrollTop() // Get position of the body                    
                    if (top != 0) {
                        body.animate({
                            scrollTop: 0
                        }, 10);
                    }
                    $('#take_template').hide();
                    $('.footer_temp').hide();
                    $('#myModal_temp.loader').show();
                    $('#myModal_temp .loader').css('display', 'block');
                    setTimeout(capture, 3000);
                    setTimeout(function() {
                        $('#take_template').show();
                        $('.footer_temp').show();
                        $('#myModal_temp .loader').hide();
                    }, 12000);
                });
                $('#myModal_temp').on('hide.bs.modal', function() {
                    $(this).removeData('bs.modal');
                });
            });
        </script>
    </body>
</html>
