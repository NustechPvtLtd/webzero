<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>WebZero</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Loading Bootstrap -->
        <link href="<?php echo base_url('assets/sites'); ?>/bootstrap/css/bootstrap.css" rel="stylesheet">

        <!-- Loading Flat UI -->
        <link href="<?php echo base_url('assets/sites'); ?>/css/flat-ui.css" rel="stylesheet">

        <link href="<?php echo base_url('assets/sites'); ?>/css/student-site-style.css" rel="stylesheet">

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
        
        <!-- Student Resume CSS  -->
		
		<link href="<?php echo base_url('studentelements');?>/css/font-awesome.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('studentelements');?>/css/animsition.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('studentelements');?>/css/progress.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('studentelements');?>/css/student-style.css">			
		
        <!-- End Student Resume CSS  -->
		<script src="<?php echo base_url('elements/scripts/jquery-1.11.2.min.js'); ?>"></script> 
		<link rel="stylesheet" href="<?php echo base_url('assets'); ?>/jquery-ui/jquery-ui.min.css"/>
		<!--<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/blitzer/jquery-ui.css"/>-->
		
    </head>
    <body>
        <div class="menu affix-top" id="menu" data-spy="affix" data-offset-top="60" >
            <a href="#" class="toggle"><span class="list-icon"><i></i><i></i><i></i></span></a>

            <div class="main scrollbar-inner" id="main">

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

                    <?php if (count($siteData['pages']) == 0): ?>
                        <li class="active">
                            <a href="#page1">index</a>
                            <span class="pageButtons">
                                <a href="" class="fileCopy"><span class="fa fa-clipboard"></span></a>
                            </span>
                        </li>
                    <?php else: ?>

                        <?php $counter = 1; ?>

                        <?php foreach ($siteData['pages'] as $page => $frames): ?>
                            <li <?php if ($counter == 1): ?>class="active"<?php endif; ?>>
                                <a href="#page<?php echo $counter; ?>"><?php echo $page; ?></a>
                                <span class="pageButtons">
                                    <a href="" class="fileCopy"><span class="fa fa-clipboard"></span></a>
                                    <?php if ($page !== 'index'): ?>
                                    <a href="" class="fileEdit"><span class="fui-new"></span></a>
                                    <a href="" class="fileDel"><span class="fui-cross"></span></a>
                                    <a class="btn btn-xs btn-primary fileSave" href="#"><span class="fui-check"></span></a>
                                    <?php endif; ?>
                                </span>
                            </li>
                            <?php $counter++; ?>
                        <?php endforeach; ?>

                    <?php endif; ?>
                </ul>

                <div class="sideButtons clearfix">
                    <a href="#" class="btn btn-success btn-sm btn-left" id="addPage">Add</a>
                    <!--<a href="#exportModal" data-toggle="modal" class="btn btn-primary btn-sm disabled actionButtons btn-right">Export</a>-->
                </div>
                <!--<hr>-->
                <!--                <div class="expCenter">
                                    <a href="#projModal" id="expImp" class="btn btn-primary btn-block" data-toggle="modal">Project Exp/Imp</a>
                                </div>-->
                <!--<hr>-->
            </div><!-- /.main -->

            <div class="second scrollbar-inner" id="second">

                <ul id="elements">

                </ul>

            </div><!-- /.secondSide -->

        </div><!-- /.menu -->
        <div class="header skin-green">
            <a href="<?php echo site_url(); ?>" class="logo icon">
                <img  class="img-responsive" src="<?php echo base_url(); ?>assets/img/logo.png" alt="Customer area" />            
            </a>
            <nav class="navbar navbar-static-top" role="navigation">
                <?php if ($this->router->fetch_class() == 'sites'): ?>
                    <ul class="nav navbar-nav">
                        <?php if (isset($siteData) || ( isset($page) && $page == 'newPage' )): ?>

                            <?php if (isset($siteData)): ?>
                                <li class="active">
                                    <a><span class="fui-home"></span> <span id="siteTitle"><?php echo $siteData['site']->sites_name ?></span></a>
                                </li>
                            <?php endif; ?>
                            <?php if (isset($page) && $page == 'newPage'): ?>
                                <li class="active">
                                    <a><span class="fui-home"></span> <span id="siteTitle"><?php echo $this->lang->line('newsite_default_title') ?></span> </a>
                                </li>
                            <?php endif; ?>

                            <?php if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] != ''): ?>

                                <?php
                                //find out where we came from :)

                                $temp = explode("/", $_SERVER['HTTP_REFERER']);

                                if (array_pop($temp) == 'users') {
                                    $t = 'nav_goback_users';
                                    $to = site_url('users');
                                } else {
                                    $t = 'nav_goback_sites';
                                    $to = site_url('sites');
                                }
                                ?>

                                <li><a href="<?php echo site_url('services') ?>" id="backButton"><span class="fui-arrow-left"></span> <?php echo 'Back to services'; /* $this->lang->line( $t ) */ ?></a></li>

                            <?php else: ?>

                                <li><a href="<?php echo site_url('services') ?>" id="backButton"><span class="fui-arrow-left"></span> <?php echo 'Back to services'; /* $this->lang->line('nav_goback_sites') */ ?></a></li>

                            <?php endif; ?>

                        <?php else: ?>

                            <li <?php if (isset($page) && $page == "sites"): ?>class="active"<?php endif; ?>><a href="<?php echo site_url('sites') ?>"><span class="fui-windows"></span> <?php echo $this->lang->line('nav_sites') ?></a></li>
                            <li <?php if (isset($page) && $page == "images"): ?>class="active"<?php endif; ?>><a href="<?php echo site_url('sites/assets/images') ?>"><span class="fui-image"></span> <?php echo $this->lang->line('nav_imagelibrary') ?></a></li>

                        <?php endif; ?>
                    </ul>
                <?php endif; ?>
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
          <header class="clearfix" data-spy="affix" data-offset-top="60" data-offset-bottom="200">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
						
							<div class="col-lg-4">
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
							<div class="col-lg-8 float-right">
								<a href="#" id="savePage" class="btn btn-primary disabled actionButtons"><span class="fui-check"></span> <span class="bLabel">Nothing new to save</span></a>
								<a href="#" id="publishPage" class="btn btn-primary disabled actionButtons" data-siteid="<?php echo $siteData['site']->sites_id; ?>" <?php if ($siteData['site']->domain_ok == 0): ?>data-toggle="tooltip"<?php endif; ?> data-placement="bottom" title="You can not publish your site right now. Please update your url details from settings menu." ><span class="fui-export"></span> <?php echo $this->lang->line('actionbuttons_publish') ?> <span class="fui-alert text-danger" <?php if ($siteData['site']->domain_ok == 1): ?>style="display:none"<?php endif; ?>></span></a>
								<a href="#previewModal" id="preview" data-toggle="modal" class="btn btn-primary disabled actionButtons" ><span class="fui-window"></span> Preview</a>
								<a href="#" id="clearScreen" class="btn btn-danger disabled actionButtons"><span class="fui-trash"></span> Empty Page</a>
								
								<!--<a href="#publishModal" id="publishPage" data-toggle="modal" class="btn btn-primary pull-right disabled actionButtons" ><span class="fui-export"></span> <?php echo $this->lang->line('actionbuttons_publish') ?></a>-->
								
								<!--<a href="#exportModal" id="exportPage" data-toggle="modal" class="btn btn-primary pull-right disabled actionButtons"><span class="fui-export"></span> Export</a>-->
								
								<div class="btn-group actionButtons">           
									<button class="btn btn-default btn-embossed dropdown-toggle" data-toggle="dropdown">
										<span class="fui-gear"></span> Settings<span class="caret"></span>
									</button>
									<span class="dropdown-arrow dropdown-arrow-inverse"></span>
									<ul class="dropdown-menu dropdown-inverse">
										<li><a href="#profileShareSettings" id="shareSettingsButton" class="studShareProfModalButton" data-toggle="modal" data-siteid="<?php echo $siteData['site']->sites_id; ?>"><?php echo 'Share Profile'/* $this->lang->line('actionbuttons_pagesettings') */ ?></a></li>						
										<li><a href="#siteSettings" id="siteSettingsButton" class="siteSettingsModalButton" data-siteid="<?php echo $siteData['site']->sites_id; ?>"><?php echo 'URL Settings'/* $this->lang->line('actionbuttons_sitesettings') */ ?></a></li>
										<li><a href="#profilePasswordSetting" id="pwdSettingsButton" data-toggle="modal" data-siteid="<?php echo $siteData['site']->sites_id; ?>"><?php echo 'Site Password'/* $this->lang->line('actionbuttons_pagesettings') */ ?></a></li>						
										<li><a href="#resumeSettingModal" id="pageSettingsButton" data-toggle="modal" data-siteid="<?php echo $siteData['site']->sites_id; ?>"><?php echo 'Resume Settings'/* $this->lang->line('actionbuttons_pagesettings') */ ?></a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</header>

             <?php echo $body; ?>
            <!-- Builder Body -->

        </div><!-- /.container -->

        <div id="styleEditor" class="styleEditor scrollbar-inner" data-spy="affix" data-offset-top="205" >

            <a href="#" class="close"><span class="fui-cross-inverted"></span></a>

            <h3><span class="fui-new"></span> Detail Editor</h3>

            <ul class="breadcrumb">
                <li>Editing:</li>
                <li class="active" id="editingElement">p</li>
            </ul>
			
			<div class="margin-bottom-5">
                <button type="button" class="btn btn-primary  btn-sm btn-block" id="saveStyling"><span class="fui-check-inverted"></span> Apply Changes</button>
            </div>

            <div class="sideButtons clearfix">
                <button type="button" class="btn btn-inverse  btn-xs" id="cloneElementButton"><span class="fui-windows"></span> Clone</button>
                <button type="button" class="btn btn-warning  btn-xs" id="resetStyleButton"><i class="fa fa-refresh"></i> Reset</button>
                <button type="button" class="btn btn-danger  btn-xs" id="removeElementButton"><span class="fui-cross-inverted"></span> Remove</button>
            </div>

			<div class="alert alert-success" style="display: none;" id="detailsAppliedMessage">
                <button class="close fui-cross" type="button" id="detailsAppliedMessageHide"></button>
                The changes were applied successfully!
            </div>
			
            <hr>

            <ul class="nav nav-tabs" id="detailTabs">
                <li class="active"><a href="#tab1"><span class="fui-new"></span> Style</a></li>
                <li style="display: none;"><a href="#link_Tab" id="link_Link"><span class="fui-clip"></span> Link</a></li>
                <li style="display: none;"><a href="#image_Tab" id="img_Link"><span class="fui-image"></span> Image</a></li>
                <li style="display: none;"><a href="#icon_Tab" id="icon_Link"><span class="fa fa-flag"></span> Icons</a></li>
                <li style="display: none;"><a href="#video_Tab" id="video_Link"><span class="fa fa-youtube-play"></span> Video</a></li>
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
                        <?php
                        if (isset($siteData['pages'])) {
                            foreach ($siteData['pages'] as $page => $frames) {
                                if ($page != 'index') {
                                    echo '<option value="' . $page . '.html">' . $page . '</option>';
                                }
                            }
                        }
                        ?>
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

                    <label>Enter image path:</label>

                    <input type="text" class="form-control" id="imageURL" placeholder="Enter an image URL" value="">

                    <p class="text-center or">
                        <span>OR</span>
                    </p>

					<a href="#imageModal" data-toggle="modal" type="button" class="btn btn-default btn-embossed btn-block margin-bottom-20"><span class="fui-image"></span> Use Image Library</a>
					
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

            </div> <!-- /tab-content -->

           

        <!--<p class="text-center or">
            <span>OR</span>
        </p>
        
        <button type="button" class="btn btn-default  btn-block btn-sm" id="closeStyling"><span class="fui-cross-inverted"></span> Close Editor</button>-->

        </div><!-- /.styleEditor -->

        <div id="hidden">
            <iframe src="<?php echo base_url(); ?>studentelements/studskeleton.html" id="skeleton"></iframe>
        </div>

        <!-- modals -->

        <!-- Site setting popup-->
        <?php $this->load->view("shared/modal_sitesettings.php"); ?>
		
        <!-- Resume Password setting popup-->
        <?php $this->load->view("shared/modal_shareprofile.php"); ?>		

        <!-- export Project popup -->
        <div class="modal fade in" id="projModal" tabindex="-1" role="dialog" aria-hidden="true">

            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="ModalLabel">Export/Import project</h4>
                    </div>
                    <div class="modal-body">

                        <div class="row text-center">
                            <div class="col-sm-6" style="padding:70px 0" >

                                <form action="<?php echo base_url(); ?>expImp.php" target="_blank" id="markFormExp" class="form-horizontal" method="post">

                                    <p><strong>Export Project</strong></p>
                                    <div>
                                        <a href="#" id="saveprojPage" class="btn btn-primary btn-lg disabled">
                                            <span class="fa fa-download"></span>
                                            <span class="bLabel">&nbsp;Save</span>
                                        </a>
                                    </div>
                                    <input id="dataProject" type="hidden" name="JSONProject" value=""/>
                                    <input id="statusExp" type="hidden" name="status" value="exp"/>
                                </form>

                            </div>
                            <div class="col-sm-6" style="padding:70px 0; border-left:1px solid #eee;">

                                <form action="<?php echo base_url(); ?>expImp.php" id="markFormImp" class="form-horizontal" method="post" enctype="multipart/form-data">
                                    <p><strong>Import Project</strong></p>
                                    <div>

                                        <!-- <label for="fileinput" class="fileinput"></label>
                                         <div class="hidden-input">
                                             <input type="file" id="fileinput" name="projectImp">
                                         </div>
                                        
                                         <a href="#deleteAllPages" id="loadprojPage" class="btn btn-primary" data-toggle="modal" data-dismiss="modal">
                                             <span class="fa fa-upload"></span>
                                             <span class="bLabel">Import</span>
                                         </a>-->



                                        <span class="file-input btn btn-primary btn-file btn-lg">
                                            <span class="fa fa-upload"></span> &nbsp;Browse&hellip; <input type="file" id="fileinput" name="projectImp" multiple>
                                        </span>



                                    </div>
                                    <input id="statusImp" type="hidden" name="status" value="imp"/>
                                </form>

                            </div>
                        </div>

                    </div><!-- /.modal-body -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal" id="exportCancel">Cancel &amp; Close</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->


        </div>

        <!-- export HTML popup -->
        <div class="modal fade" id="exportModal" tabindex="-1" role="dialog" aria-hidden="true">

            <!-- 
            
            NOTE: 
            The export PHP files can be hosted on any server supporting PHP, so these files can be hosted on a different location as the BUILDER (this might be easier for your end customers, so they won't have to worry about hosting PHP files)
            
            -->

            <form action="<?php echo base_url(); ?>save.php" target="_blank" id="markupForm" method="post" class="form-horizontal">

                <input type="hidden" name="markup" value="" id="markupField">

                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title" id="myModalLabel"><span class="fui-export"></span> Export Your Markup</h4>
                        </div>
                        <div class="modal-body">

                            <div class="form-group" style="margin-top:20px;">
                                <label for="title" class="col-sm-12 control-label">Page Title</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="title" id="title" placeholder="Title" value="Title">
                                </div>
                                <label for="meta-description" class="col-sm-12 control-label">Page Meta Description</label>
                                <div class="col-sm-12">
                                    <textarea class="form-control" name="meta-description" id="meta-description" placeholder="meta-description"></textarea>
                                </div>
                                <label for="meta-keywords" class="col-sm-12 control-label">Page Meta Keywords</label>
                                <div class="col-sm-12">
                                    <textarea class="form-control" name="meta-keywords" id="meta-keywords" placeholder="meta-keywords"></textarea>
                                </div>
                                <label for="js-include" class="col-sm-12 control-label">Page js include</label>
                                <div class="col-sm-12">
                                    <textarea class="form-control" name="js-include" id="js-include" placeholder="js-include"></textarea>
                                </div>
                                <label for="switch-04" class="col-sm-2 control-label">Preloader</label>
                                <div class="col-sm-10 checkbox-middle">
                                    <input type="checkbox" checked data-toggle="switch" name="preloader" data-on-color="info" id="switch-04" />
                                </div>
                            </div>

                        </div><!-- /.modal-body -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default " data-dismiss="modal" id="exportCancel">Cancel & Close</button>
                            <button type="submit" class="btn btn-primary " id="exportSubmit">Export Now</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->

            </form>

        </div><!-- /.modal -->


        <!-- preview HTML popup -->
        <div class="modal fade" id="previewModal" tabindex="-1" role="dialog" aria-hidden="true">

            <form action="<?php echo site_url('sites/preview_student'); ?>" target="_blank" id="markupPreviewForm" method="post" class="form-horizontal">

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

        <!-- delete all blocks before import project-->
        <div class="modal fade" id="deleteAllPages" tabindex="-1" role="dialog" aria-hidden="true">

            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <h4>Important!</h4>
                        <br>
                        After the import process all the current landing pages will be deleted!<br>
                        <strong>Are you sure you want to remove this pages?</strong><br><br>

                    </div><!-- /.modal-body -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default " data-dismiss="modal">Cancel & Close</button>
                        <button type="button" class="btn btn-primary " id="deleteAPForImport">Remove & Import</button>
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
                        <button type="button" class="btn btn-default " data-dismiss="modal" id="deletePageCancel">Cancel & Close</button>
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

		<div class="modal fade profilePasswordSetting" id="profilePasswordSetting" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

			<div class="modal-dialog modal-lg">

				<div class="modal-content">

					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo $this->lang->line('modal_close') ?></span></button>
						<h4 class="modal-title" id="myModalLabel"><span class="fui-gear"></span> <?php echo 'Password Settings' /* $this->lang->line('modal_pagesettings_header') */ ?> <span class="text-primary pName">index.html</span></h4>
					</div>

					<div class="modal-body">

						<div class="loader" style="display: none;">
							<img src="<?php echo base_url(); ?>assets/sites/images/loading.gif" alt="Loading...">
							<?php echo $this->lang->line('modal_pagesettings_loadertext') ?>
						</div>

						<div class="modal-alerts"></div>

						<?php
						if (isset($pagesData)) {
							echo $this->load->view('partials/profilepwd.php', array('pagesData' => $pagesData, 'siteData' => $siteData['site']));
						} else {
							echo $this->load->view('partials/profilepwd.php', array('siteData' => $siteData['site']));
						}
						?>

					</div><!-- /.modal-body -->

					<div class="modal-footer">
						<button type="button" class="btn btn-default btn-embossed" data-dismiss="modal"><span class="fui-cross"></span> <?php echo $this->lang->line('modal_cancelclose') ?></button>
						<button type="button" class="btn btn-primary btn-embossed" id="updateSitePassword"><span class="fui-check"></span> <?php echo $this->lang->line('sitesettings_button_savesettings') ?></button>
					</div>

				</div><!-- /.modal-content -->

			</div><!-- /.modal-dialog -->

		</div><!-- /.modal -->

        <!-- Seo Settings popup -->
        <div class="modal fade" id="resumeSettingModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

            <div class="modal-dialog modal-lg resumesettings">

                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo $this->lang->line('modal_close') ?></span></button>
                        <h4 class="modal-title" id="myModalLabel"><span class="fui-gear"></span> <?php echo 'Resume Settings' /* $this->lang->line('modal_pagesettings_header') */ ?> <span class="text-primary pName">index.html</span></h4>
                    </div>

                    <div class="modal-body">

                        <div class="loader" style="display: none;">
                            <img src="<?php echo base_url(); ?>assets/sites/images/loading.gif" alt="Loading...">
                            <?php echo $this->lang->line('modal_pagesettings_loadertext') ?>
                        </div>

                        <div class="modal-alerts"></div>

                        <?php
                        if (isset($pagesData)) {
                            echo $this->load->view('partials/searchsettings.php', array('pagesData' => $pagesData, 'siteData' => $siteData['site'],'resumeData'=>$resumeData));
                        } else {
                            echo $this->load->view('partials/searchsettings.php', array('siteData' => $siteData['site'],'resumeData'=>array()));
                        }
                        ?>

                    </div><!-- /.modal-body -->

				</div><!-- /.modal-content -->

            </div><!-- /.modal-dialog -->

        </div><!-- /.modal -->

        <!-- publish popup -->
        <div class="modal fade" id="publishModal" tabindex="-1" role="dialog" aria-hidden="true">

            <form action="<?php echo site_url('sites/publish_student') ?>" target="_blank" id="publishForm" method="post" class="form-horizontal">

                <input type="hidden" name="siteID" value="<?php echo $siteData['site']->sites_id; ?>">

                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo $this->lang->line('modal_close') ?></span></button>
                            <h4 class="modal-title" id="myModalLabel"><span class="fui-upload"></span> <?php echo $this->lang->line('modalpublish_publishyoursite') ?></h4>
                        </div>
                        <div class="modal-body">

                            <div class="loader" style="display: none;">
                                <img src="<?php echo base_url(); ?>assets/sites/images/loading.gif" alt="Loading...">
                                <?php echo $this->lang->line('loading_saving_data') ?> ...
                            </div>

                            <div class="alert alert-success">
                                <h4><?php echo $this->lang->line('modalpublish_success_heading') ?></h4>
                                <?php echo $this->lang->line('modalpublish_success_message') ?>
                            </div>

                            <div class="modal-alerts">

                            </div>

                            <div class="alert alert-info" style="display: none;" id="publishPendingChangesMessage">
                                <h4><?php echo $this->lang->line('modalpublish_pendingchanges_heading') ?></h4>
                                <p>
                                    <?php echo $this->lang->line('modalpublish_pendingchanges_message') ?>
                                </p>
                                <button type="button" class="btn btn-info btn-wide save"><?php echo $this->lang->line('modalpublish_pendingchanges_button_savechanges') ?></button>
                            </div>

                            <div class="modal-body-content">

                                <div class="optionPane export">

                                    <h6><?php echo $this->lang->line('modalpublish_sitepages') ?></h6>

                                    <div class="table-responsive" id="publishModal_pages">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" style="width: 30px;">
                                                        <label class="checkbox no-label toggle-all" for="checkbox-table-1">
                                                            <input type="checkbox" value="" id="checkbox-table-1" data-toggle="checkbox" class="toggleAll">
                                                        </label>
                                                    </th>
                                                    <th><?php echo $this->lang->line('modalpublish_page') ?></th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div><!-- /.table-responsive -->

                                </div><!-- /.optionPane -->
                            </div>

                        </div><!-- /.modal-body -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default btn-embossed" data-dismiss="modal" id="publishCancel"><?php echo $this->lang->line('modal_cancelclose') ?></button>
                            <button type="button" class="btn btn-primary btn-embossed disabled" id="publishSubmit"><?php echo $this->lang->line('modalpublish_publish_now') ?></button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->

            </form>

        </div><!-- /.modal -->
        
		<!-- Image Gallery Modal -->
		<?php $this->load->view("shared/modal_imagegallery.php", array('site' => $siteData['site'])); ?>
		
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
                            <?php echo $this->lang->line('modal_videolibrary_loadertext') ?>
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

                                    <?php if (isset($userVideos)): ?>

                                        <?php $this->load->view("partials/myvideos.php", array('userVideos' => $userVideos, 'bucket'=>$bucket)); ?>

                                    <?php else: ?>

                                        <!-- Alert Info -->
                                        <div class="alert alert-info">
                                            <button type="button" class="close fui-cross" data-dismiss="alert"></button>
                                            <?php echo $this->lang->line('modal_videolibrary_message_novideos'); ?>
                                        </div>

                                    <?php endif; ?>

                                </div><!-- /.tab-pane -->

                                <div class="tab-pane" id="uploadVideoTab">

                                    <form id="videoUploadForm" action="<?php echo site_url('sites/amazon_services/videoUploadAjax/' . $siteData['site']->sites_id); ?>">

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
        <div id="loader">
            <span>
                <img src="<?php echo base_url('assets/sites'); ?>/images/loading.gif" alt="Loading...">
                Loading builder elements...
            </span>
        </div>

        <div class="sandboxes" id="sandboxes" style="display: none"></div>

        <!-- Load JS here for greater good =============================-->
        <script src="<?php echo base_url('assets/sites'); ?>/js/jquery-ui.min.js"></script>
        <script src="<?php echo base_url('assets/sites'); ?>/js/jquery.ui.touch-punch.min.js"></script>
        <script src="<?php echo base_url('assets/sites'); ?>/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url('assets/sites'); ?>/js/bootstrap-select.js"></script>
        <!--<script src="<?php // echo base_url('assets/sites'); ?>/js/bootstrap-switch.js"></script>-->
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
        <script src="<?php echo base_url(); ?>resumeelements.json"></script>
        <script src="<?php echo base_url('assets/sites'); ?>/js/resumebuilder.js"></script>
        <script src="<?php echo base_url('assets/sites'); ?>/js/jquery.form.min.js"></script>
        <script src="<?php echo base_url('assets/sites'); ?>/js/scrollbar/jquery.nicescroll.min.js"></script>
        <script src="<?php echo base_url('assets/sites/js/bootstrap-switch.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/adminlte.js'); ?>"></script>
        <script src="<?php echo base_url('elements/scripts/jquery.validate.min.js'); ?>"></script>
        <!-- Loading Elements JS -->

		<!-- Student Resume JS -->
		<script src="<?php echo base_url('assets/plugin'); ?>/tag-it/js/tag-it.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url('studentelements');?>/scripts/jquery.animsition.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url('studentelements');?>/scripts/jquery-asPieProgress.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url('studentelements');?>/scripts/jquery.waypoints.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url('studentelements');?>/scripts/isotope.pkgd.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url('elements/scripts/html5gallery.js');?>"></script>	
		<script type="text/javascript" src="<?php echo base_url('studentelements');?>/scripts/student-scripts.js"></script>	
		
		<!-- End Student Resume JS -->
        
        <script>
            var baseUrl = "<?php echo base_url(); ?>";
            var siteUrl = "<?php echo site_url('/'); ?>";

            <?php if (isset($siteData)): ?>
                            var siteID = <?php echo $siteData['site']->sites_id; ?>;
            <?php else: ?>
                            var siteID = 0;
            <?php endif; ?>

            <?php if (isset($pagesData)): ?>
                            var pagesData = <?php echo json_encode($pagesData); ?>
            <?php endif; ?>
			
			var userImageLoaded = false;
			
            $(function() {

                var ua = window.navigator.userAgent;
                var msie = ua.indexOf("MSIE ");

                /*if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)) {
                 
                 $('.modes #modeContent').parent().hide();
                 
                 } else {
                 
                 $('.modes #modeContent').parent().show();
                 
                 }*/

                <?php if (isset($siteData)): ?>

                    //make sortable

//                    $('#pageList > ul').each(function() {
//
//                        makeSortable($(this));
//
//                    });

                    $('#pageList li > section').each(function() {

                        theHeight = $(this).attr('data-height') ;
                        //add height to frames array
                        $(this).css('height', theHeight + "px");

//                        $(this).css('background', '#ffffff url(<?php echo base_url('assets/sites/images/loading.gif');?>) 50% 50% no-repeat');
                        $(this).css('padding', '0px');
                        $(this).css('z-index', '0');
//                        $(this).load(function() {
                            heightAdjustment($(this).attr('id'), true);
//                        });

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
		<!-- SITE PASSWORD SETTINGS FOR STUDENT RESUME PAGE -->
		<script>
			$(function() {
				$("input[name='my-checkbox']").bootstrapSwitch();
				<?PHP if(is_array($siteData) && $siteData['site']->has_password!=1){ ?>
				$("#pagePassword").attr("disabled", "disabled");
				<?PHP  }?>
				$('input[name="my-checkbox"]').on('switchChange.bootstrapSwitch', function(event, state) {
					if(state==true) {
						$("#pagePassword").removeAttr("disabled"); 
					}else{
						$("#pagePassword").attr("disabled", "disabled");
					}
				});
			});
		</script>		
        <script>
            <?php $this->load->view("shared/js_sitesettings.php"); ?>
            <?php $this->load->view("shared/js_resumesettings.php"); ?>
			<?php $this->load->view("shared/js_imagegallery.php"); ?>
        </script>
		<script>

			(function() {

			 // file drag hover
			 function FileDragHover(e) {
			  e.stopPropagation();
			  e.preventDefault();
			  e.target.className = (e.type == "dragover" ? "hover fileinput-preview thumbnail" : "fileinput-preview thumbnail");
			 }


			 // file selection
			 function FileSelectHandler(e) {

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
					//console.log("file to server");
					var form = $('form#imageUploadForm');
					var imgmodel = $(".imageModal");
					var formAction = form.attr('action');
			   
				   var extraData ={}; //Extra Data.
				   $.ajax({
					url: formAction,
					type: "POST",
					contentType:false,
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
								$('#myImagesTab > *').remove();
								$('#myImagesTab').append($(ret.myImages));

								$('#imageModal .modal-alerts').append($(ret.responseHTML));
															
								$("#myImagesTabLI a").click();
								setTimeout(function() {
									$('#imageModal .modal-alerts > *').fadeOut(500);
								}, 3000);
								$('#uploadTab').find('a.fileinput-exists').click();
							}

						});
			 
			   
			   $("#fileinput-preview").html('<img src="" />');
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
							$("#fileinput-preview").html('<img src="' + e.target.result + '" />');
							//$('#imageFile').prop("files", e.originalEvent.dataTransfer.files);
						};
						
						$('button#uploadImageButtonDrop').removeClass('disabled');
			   
						reader.readAsDataURL(file);
					}		
			}


			 // initialize
			 function Init() {

			  var fileselect = document.getElementById("imageFile");
			  var filedrag = document.getElementById("fileinput-preview");

				// file select
				//  fileselect.addEventListener("change", FileSelectHandler, true);

			  // is XHR2 available?
			  var xhr = new XMLHttpRequest();
			  if (xhr.upload) {

			   // file drop
			   filedrag.addEventListener("dragover", FileDragHover, false);
			   filedrag.addEventListener("dragleave", FileDragHover, false);
			   filedrag.addEventListener("drop", FileSelectHandler, false);
			   //filedrag.style.display = "block";
			   
			  }

			 }

			 // call initialization file
			 if (window.File && window.FileList && window.FileReader) {
			  Init();
			 }


			})();
			 
			 $(".exists").click(function(){
			  $(".new").css("display", "inline");
			  $(".exists").css("display", "none");
			  $("#uploadImageButtonDrop").css("display", "none");
			  $("#uploadImageButton").show();
			 });
			 
			 $("#imageFile").click(function(){	
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
			for (var i=0; i<imgDefer.length; i++) {
				if(imgDefer[i].getAttribute('data-src')) {
					imgDefer[i].setAttribute('src',imgDefer[i].getAttribute('data-src'));
				} 
			} 
		}
		window.onload = init;
		</script> 		
        <style>
            button#uploadVideoButtonDrop{
                position: relative;
                display: none;
            }
        </style>
    </body>
</html>
