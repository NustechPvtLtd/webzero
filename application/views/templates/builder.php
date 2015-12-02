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

        <!--CUSTOM-JS-->

    </head>
    <body>
        <div class="menu" id="menu" data-spy="affix" data-offset-top="60" >
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
                            <a class="btn btn-xs btn-primary fileSave" href="#"><span class="fui-check"></span></a>
                        </span>
                    </li>
                    <li class="active">
                        <a href="#page1">index</a>
                        <span class="pageButtons">
                            <a href="" class="fileEdit"><span class="fui-new"></span></a>
                            <a class="btn btn-xs btn-primary fileSave" href="#"><span class="fui-check"></span></a>
                        </span>
                    </li>
                </ul>

                <div class="sideButtons clearfix">
                    <a href="#" class="btn btn-success btn-sm btn-left" id="addPage">Add</a>
                </div>
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
                <div class="btn-group actionButtons" style="float: right;">           
                    <!--<button class="btn btn-default btn-embossed"></button>-->
                    <button class="btn btn-default btn-embossed dropdown-toggle" data-toggle="dropdown">
                        <span class="fui-gear"></span> Settings<span class="caret"></span>
                    </button>
                    <span class="dropdown-arrow dropdown-arrow-inverse"></span>
                    <ul class="dropdown-menu dropdown-inverse">
                        <li><a href="#siteSettings" id="siteSettingsButton" class="siteSettingsModalButton" data-siteid="<?php echo $siteData['site']->sites_id; ?>"><?php echo 'URL Settings'/* $this->lang->line('actionbuttons_sitesettings') */ ?></a></li>
                        <li><a href="#pageSettingsModal" id="pageSettingsButton" data-toggle="modal" data-siteid="<?php echo $siteData['site']->sites_id; ?>"><?php echo 'SEO Settings'/* $this->lang->line('actionbuttons_pagesettings') */ ?></a></li>
                    </ul>
                </div>
                <a href="#" id="clearScreen" class="btn btn-danger pull-right disabled actionButtons"><span class="fui-trash"></span> Empty Page</a>

                <a href="#previewModal" id="preview" data-toggle="modal" class="btn btn-primary pull-right disabled actionButtons" ><span class="fui-window"></span> Preview</a>

                <a href="#" id="publishPage" class="btn btn-primary pull-right disabled actionButtons" data-siteid="<?php echo $siteData['site']->sites_id; ?>" <?php if ($siteData['site']->domain_ok == 0): ?>data-toggle="tooltip"<?php endif; ?> data-placement="bottom" title="You can not publish your site right now. Please update your url details from settings menu." ><span class="fui-export"></span> <?php echo $this->lang->line('actionbuttons_publish') ?> <span class="fui-alert text-danger" <?php if ($siteData['site']->domain_ok == 1): ?>style="display:none"<?php endif; ?>></span></a>
                <a href="#" id="savePage" class="btn btn-primary pull-right disabled actionButtons"><span class="fui-check"></span> <span class="bLabel">Nothing new to save</span></a>

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

            </header>

            <?php echo $body; ?>
            <!-- Builder Body -->

        </div><!-- /.container -->

        <div id="styleEditor" class="styleEditor scrollbar-inner" >

            <a href="#" class="close"><span class="fui-cross-inverted"></span></a>

            <h3><span class="fui-new"></span> Detail Editor</h3>

            <ul class="breadcrumb">
                <li>Editing:</li>
                <li class="active" id="editingElement">p</li>
            </ul>

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

                    <select id="icons" data-placeholder="Your Favorite Types of Bear">
                        <option value="icon-user-female">&#xe106; icon-user-female</option>
                        <option value="icon-user-follow">&#xe064; icon-user-follow</option>
                        <option value="icon-user-following">&#xe065; icon-user-following</option>
                        <option value="icon-user-unfollow">&#xe066; icon-user-unfollow</option>	
                        <option value="icon-trophy">&#xe067; icon-trophy</option>	
                        <option value="icon-screen-smartphone">&#xe068; icon-screen-smartphone</option>	
                        <option value="icon-screen-desktop">&#xe069; icon-screen-desktop</option>
                        <option value="icon-plane">&#xe06a; icon-plane</option>	
                        <option value="icon-notebook">&#xe06b; icon-notebook</option>
                        <option value="icon-moustache">&#xe06c; icon-moustache</option>	
                        <option value="icon-mouse">&#xe06d; icon-mouse</option>	
                        <option value="icon-magnet">&#xe06e; icon-magnet</option>
                        <option value="icon-energy">&#xe06f; icon-energy</option>
                        <option value="icon-emoticon-smile">&#xe070; icon-emoticon-smile</option>
                        <option value="icon-disc">&#xe071; icon-disc</option>
                        <option value="icon-cursor-move">&#xe072; icon-cursor-move</option>
                        <option value="icon-crop">&#xe073; icon-crop</option>
                        <option value="icon-credit-card">&#xe074; icon-credit-card</option>
                        <option value="icon-chemistry">&#xe075; icon-chemistry</option>
                        <option value="icon-user">&#xe076; icon-user</option>	
                        <option value="icon-speedometer">&#xe077; icon-speedometer</option>	
                        <option value="icon-social-youtube">&#xe078; icon-social-youtube</option>
                        <option value="icon-social-twitter">&#xe079; icon-social-twitter</option>
                        <option value="icon-social-tumblr">&#xe07a; icon-social-tumblr</option>	
                        <option value="icon-social-facebook">&#xe07b; icon-social-facebook</option>	
                        <option value="icon-social-dropbox">&#xe07c; icon-social-dropbox</option>
                        <option value="icon-social-dribbble">&#xe07d; icon-social-dribbble</option>	
                        <option value="icon-shield">&#xe07e; icon-shield</option>	
                        <option value="icon-screen-tablet">&#xe07f; icon-screen-tablet</option>	
                        <option value="icon-magic-wand">&#xe080; icon-magic-wand</option>
                        <option value="icon-hourglass">&#xe081; icon-hourglass</option>
                        <option value="icon-graduation">&#xe082; icon-graduation</option>
                        <option value="icon-ghost">&#xe083; icon-ghost</option>
                        <option value="icon-game-controller">&#xe084; icon-game-controller</option>
                        <option value="icon-fire">&#xe085; icon-fire</option>	
                        <option value="icon-eyeglasses">&#xe086; icon-eyeglasses</option>	
                        <option value="icon-envelope-open">&#xe087; icon-envelope-open</option>	
                        <option value="icon-envelope-letter">&#xe088; icon-envelope-letter</option>
                        <option value="icon-bell">&#xe089; icon-bell</option>
                        <option value="icon-badge">&#xe08a; icon-badge</option>	
                        <option value="icon-anchor">&#xe08b; icon-anchor</option>
                        <option value="icon-wallet">&#xe08c; icon-wallet</option>
                        <option value="icon-vector">&#xe08d; icon-vector</option>	
                        <option value="icon-speech">&#xe08e; icon-speech</option>
                        <option value="icon-puzzle">&#xe08f; icon-puzzle</option>
                        <option value="icon-printer">&#xe090; icon-printer</option>	
                        <option value="icon-present">&#xe091; icon-present</option>	
                        <option value="icon-playlist">&#xe092; icon-playlist</option>
                        <option value="icon-pin">&#xe093; icon-pin</option>
                        <option value="icon-picture">&#xe094; icon-picture</option>
                        <option value="icon-map">&#xe095; icon-map</option>
                        <option value="icon-layers">&#xe096; icon-layers</option>	
                        <option value="icon-handbag">&#xe097; icon-handbag</option>
                        <option value="icon-globe-alt">&#xe098; icon-globe-alt</option>	
                        <option value="icon-globe">&#xe099; icon-globe</option>
                        <option value="icon-frame">&#xe09a; icon-frame</option>	
                        <option value="icon-folder-alt">&#xe09b; icon-folder-alt</option>
                        <option value="icon-film">&#xe09c; icon-film</option>	
                        <option value="icon-feed">&#xe09d; icon-feed</option>	
                        <option value="icon-earphones-alt">&#xe09e; icon-earphones-alt</option>
                        <option value="icon-earphones">&#xe09f; icon-earphones</option>
                        <option value="icon-drop">&#xe0a0; icon-drop</option>	
                        <option value="icon-drawer">&#xe0a1; icon-drawer</option>
                        <option value="icon-docs">&#xe0a2; icon-docs</option>	
                        <option value="icon-directions">&#xe0a3; icon-directions</option>
                        <option value="icon-direction">&#xe0a4; icon-direction</option>	
                        <option value="icon-diamond">&#xe0a5; icon-diamond</option>	
                        <option value="icon-cup">&#xe0a6; icon-cup</option>	
                        <option value="icon-compass">&#xe0a7; icon-compass</option>
                        <option value="icon-call-out">&#xe0a8; icon-call-out</option>
                        <option value="icon-call-in">&#xe0a9; icon-call-in</option>
                        <option value="icon-call-end">&#xe0aa; icon-call-end</option>
                        <option value="icon-calculator">&#xe0ab; icon-calculator</option>
                        <option value="icon-bubbles">&#xe0ac; icon-bubbles</option>
                        <option value="icon-briefcase">&#xe0ad; icon-briefcase</option>
                        <option value="icon-book-open">&#xe0ae; icon-book-open</option>
                        <option value="icon-basket-loaded">&#xe0af; icon-basket-loaded</option>
                        <option value="icon-basket">&#xe0b0; icon-basket</option>
                        <option value="icon-bag">&#xe0b1; icon-bag</option>
                        <option value="icon-action-undo">&#xe0b2; icon-action-undo</option>
                        <option value="icon-action-redo">&#xe0b3; icon-action-redo</option>
                        <option value="icon-wrench">&#xe0b4; icon-wrench</option>
                        <option value="icon-umbrella">&#xe0b5; icon-umbrella</option>
                        <option value="icon-trash">&#xe0b6; icon-trash</option>
                        <option value="icon-tag">&#xe0b7; icon-tag</option>
                        <option value="icon-support">&#xe0b8; icon-support</option>
                        <option value="icon-size-fullscreen">&#xe0b9; icon-size-fullscreen</option>
                        <option value="icon-size-actual">&#xe0ba; icon-size-actual</option>
                        <option value="icon-shuffle">&#xe0bb; icon-shuffle</option>
                        <option value="icon-share-alt">&#xe0bc; icon-share-alt</option>
                        <option value="icon-share">&#xe0bd; icon-share</option>
                        <option value="icon-rocket">&#xe0be; icon-rocket</option>
                        <option value="icon-question">&#xe0bf; icon-question</option>
                        <option value="icon-pie-chart">&#xe0c0; icon-pie-chart</option>
                        <option value="icon-pencil">&#xe0c1; icon-pencil</option>
                        <option value="icon-note">&#xe0c2; icon-note</option>
                        <option value="icon-music-tone-alt">&#xe0c3; icon-music-tone-alt</option>
                        <option value="icon-music-tone">&#xe0c4; icon-music-tone</option>
                        <option value="icon-microphone">&#xe0c5; icon-microphone</option>
                        <option value="icon-loop">&#xe0c6; icon-loop</option>
                        <option value="icon-logout">&#xe0c7; icon-logout</option>
                        <option value="icon-login">&#xe0c8; icon-login</option>
                        <option value="icon-list">&#xe0c9; icon-list</option>
                        <option value="icon-like">&#xe0ca; icon-like</option>
                        <option value="icon-home">&#xe0cb; icon-home</option>
                        <option value="icon-grid">&#xe0cc; icon-grid</option>
                        <option value="icon-graph">&#xe0cd; icon-graph</option>
                        <option value="icon-equalizer">&#xe0ce; icon-equalizer</option>
                        <option value="icon-dislike">&#xe0cf; icon-dislike</option>
                        <option value="icon-cursor">&#xe0d0; icon-cursor</option>
                        <option value="icon-control-start">&#xe0d1; icon-control-start</option>
                        <option value="icon-control-rewind">&#xe0d2; icon-control-rewind</option>
                        <option value="icon-control-play">&#xe0d3; icon-control-play</option>
                        <option value="icon-control-pause">&#xe0d4; icon-control-pause</option>
                        <option value="icon-control-forward">&#xe0d5; icon-control-forward</option>
                        <option value="icon-control-end">&#xe0d6; icon-control-end</option>
                        <option value="icon-calendar">&#xe0d7; icon-calendar</option>
                        <option value="icon-bulb">&#xe0d8; icon-bulb</option>
                        <option value="icon-bar-chart">&#xe0d9; icon-bar-chart</option>
                        <option value="icon-arrow-up">&#xe0da; icon-arrow-up</option>
                        <option value="icon-arrow-right">&#xe0db; icon-arrow-right</option>
                        <option value="icon-arrow-left">&#xe0dc; icon-arrow-left</option>
                        <option value="icon-arrow-down">&#xe0dd; icon-arrow-down</option>
                        <option value="icon-ban">&#xe0de; icon-ban</option>
                        <option value="icon-bubble">&#xe0df; icon-bubble</option>
                        <option value="icon-camcorder">&#xe0e0; icon-camcorder</option>
                        <option value="icon-camera">&#xe0e1; icon-camera</option>
                        <option value="icon-check">&#xe0e2; icon-check</option>
                        <option value="icon-clock">&#xe0e3; icon-clock</option>
                        <option value="icon-close">&#xe0e4; icon-close</option>
                        <option value="icon-cloud-download">&#xe0e5; icon-cloud-download</option>
                        <option value="icon-cloud-upload">&#xe0e6; icon-cloud-upload</option>
                        <option value="icon-doc">&#xe0e7; icon-doc</option>
                        <option value="icon-envelope">&#xe0e8; icon-envelope</option>
                        <option value="icon-eye">&#xe0e9; icon-eye</option>
                        <option value="icon-flag">&#xe0ea; icon-flag</option>
                        <option value="icon-folder">&#xe0eb; icon-folder</option>
                        <option value="icon-heart">&#xe0ec; icon-heart</option>
                        <option value="icon-info">&#xe0ed; icon-info</option>
                        <option value="icon-key">&#xe0ee; icon-key</option>
                        <option value="icon-link">&#xe0ef; icon-link</option>
                        <option value="icon-lock">&#xe0f0; icon-lock</option>
                        <option value="icon-lock-open">&#xe0f1; icon-lock-open</option>
                        <option value="icon-magnifier">&#xe0f2; icon-magnifier</option>
                        <option value="icon-magnifier-add">&#xe0f3; icon-magnifier-add</option>
                        <option value="icon-magnifier-remove">&#xe0f4; icon-magnifier-remove</option>
                        <option value="icon-paper-clip">&#xe0f5; icon-paper-clip</option>
                        <option value="icon-paper-plane">&#xe0f6; icon-paper-plane</option>
                        <option value="icon-plus">&#xe0f7; icon-plus</option>
                        <option value="icon-pointer">&#xe0f8; icon-pointer</option>
                        <option value="icon-power">&#xe0f9; icon-power</option>
                        <option value="icon-refresh">&#xe0fa; icon-refresh</option>
                        <option value="icon-reload">&#xe0fb; icon-reload</option>
                        <option value="icon-settings">&#xe0fc; icon-settings</option>
                        <option value="icon-star">&#xe0fd; icon-star</option>
                        <option value="icon-symbol-female">&#xe0fe; icon-symbol-female</option>
                        <option value="icon-symbol-male">&#xe0ff; icon-symbol-male</option>
                        <option value="icon-target">&#xe100; icon-target</option>
                        <option value="icon-volume-1">&#xe101; icon-volume-1</option>
                        <option value="icon-volume-2">&#xe102; icon-volume-2</option>
                        <option value="icon-volume-off">&#xe103; icon-volume-off</option>
                        <option value="icon-users">&#xe104; icon-users</option>
                        <option value="icon-mobile">&#xe000; icon-mobile</option>
                        <option value="icon-laptop">&#xe001; icon-laptop</option>
                        <option value="icon-desktop">&#xe002; icon-desktop</option>
                        <option value="icon-tablet">&#xe003; icon-tablet</option>
                        <option value="icon-phone">&#xe004; icon-phone</option>
                        <option value="icon-document">&#xe005; icon-document</option>
                        <option value="icon-documents">&#xe006; icon-documents</option>
                        <option value="icon-search">&#xe007; icon-search</option>
                        <option value="icon-clipboard">&#xe008; icon-clipboard</option>
                        <option value="icon-newspaper">&#xe009; icon-newspaper</option>
                        <option value="icon-notebook2">&#xe00a; icon-notebook2</option>
                        <option value="icon-book-open2">&#xe00b; icon-book-open2</option>
                        <option value="icon-browser">&#xe00c; icon-browser</option>
                        <option value="icon-calendar2">&#xe00d; icon-calendar2</option>
                        <option value="icon-presentation">&#xe00e; icon-presentation</option>
                        <option value="icon-picture2">&#xe00f; icon-picture2</option>
                        <option value="icon-pictures">&#xe010; icon-pictures</option>
                        <option value="icon-video">&#xe011; icon-video</option>
                        <option value="icon-camera2">&#xe012; icon-camera2</option>
                        <option value="icon-printer2">&#xe013; icon-printer2</option>
                        <option value="icon-toolbox">&#xe014; icon-toolbox</option>
                        <option value="icon-briefcase2">&#xe015; icon-briefcase2</option>
                        <option value="icon-wallet2">&#xe016; icon-wallet2</option>
                        <option value="icon-gift">&#xe017; icon-gift</option>
                        <option value="icon-bargraph">&#xe018; icon-bargraph</option>
                        <option value="icon-grid2">&#xe019; icon-grid2</option>
                        <option value="icon-expand">&#xe01a; icon-expand</option>
                        <option value="icon-focus">&#xe01b; icon-focus</option>
                        <option value="icon-edit">&#xe01c; icon-edit</option>
                        <option value="icon-adjustments">&#xe01d; icon-adjustments</option>
                        <option value="icon-ribbon">&#xe01e; icon-ribbon</option>
                        <option value="icon-hourglass2">&#xe01f; icon-hourglass2</option>
                        <option value="icon-lock2">&#xe020; icon-lock2</option>
                        <option value="icon-megaphone">&#xe021; icon-megaphone</option>
                        <option value="icon-shield2">&#xe022; icon-shield2</option>
                        <option value="icon-trophy2">&#xe023; icon-trophy2</option>
                        <option value="icon-flag2">&#xe024; icon-flag2</option>
                        <option value="icon-map2">&#xe025; icon-map2</option>
                        <option value="icon-puzzle2">&#xe026; icon-puzzle2</option>
                        <option value="icon-basket2">&#xe027; icon-basket2</option>
                        <option value="icon-envelope2">&#xe028; icon-envelope2</option>
                        <option value="icon-streetsign">&#xe029; icon-streetsign</option>
                        <option value="icon-telescope">&#xe02a; icon-telescope</option>
                        <option value="icon-gears">&#xe02b; icon-gears</option>
                        <option value="icon-key2">&#xe02c; icon-key2</option>
                        <option value="icon-paperclip">&#xe02d; icon-paperclip</option>
                        <option value="icon-attachment">&#xe02e; icon-attachment</option>
                        <option value="icon-pricetags">&#xe02f; icon-pricetags</option>
                        <option value="icon-lightbulb">&#xe030; icon-lightbulb</option>
                        <option value="icon-layers2">&#xe031; icon-layers2</option>
                        <option value="icon-pencil2">&#xe032; icon-pencil2</option>
                        <option value="icon-tools">&#xe033; icon-tools</option>
                        <option value="icon-tools-2">&#xe034; icon-tools-2</option>
                        <option value="icon-scissors">&#xe035; icon-scissors</option>
                        <option value="icon-paintbrush">&#xe036; icon-paintbrush</option>
                        <option value="icon-magnifying-glass">&#xe037; icon-magnifying-glass</option>
                        <option value="icon-circle-compass">&#xe038; icon-circle-compass</option>
                        <option value="icon-linegraph">&#xe039; icon-linegraph</option>
                        <option value="icon-mic">&#xe03a; icon-mic</option>
                        <option value="icon-strategy">&#xe03b; icon-strategy</option>
                        <option value="icon-beaker">&#xe03c; icon-beaker</option>
                        <option value="icon-caution">&#xe03d; icon-caution</option>
                        <option value="icon-recycle">&#xe03e; icon-recycle</option>
                        <option value="icon-anchor2">&#xe03f; icon-anchor2</option>
                        <option value="icon-profile-male">&#xe040; icon-profile-male</option>
                        <option value="icon-profile-female">&#xe041; icon-profile-female</option>
                        <option value="icon-bike">&#xe042; icon-bike</option>
                        <option value="icon-wine">&#xe043; icon-wine</option>
                        <option value="icon-hotairballoon">&#xe044; icon-hotairballoon</option>
                        <option value="icon-globe2">&#xe045; icon-globe2</option>
                        <option value="icon-genius">&#xe046; icon-genius</option>
                        <option value="icon-map-pin">&#xe047; icon-map-pin</option>
                        <option value="icon-dial">&#xe048; icon-dial</option>
                        <option value="icon-chat">&#xe049; icon-chat</option>
                        <option value="icon-heart2">&#xe04a; icon-heart2</option>
                        <option value="icon-cloud">&#xe04b; icon-cloud</option>
                        <option value="icon-upload">&#xe04c; icon-upload</option>
                        <option value="icon-download">&#xe04d; icon-download</option>
                        <option value="icon-target2">&#xe04e; icon-target2</option>
                        <option value="icon-hazardous">&#xe04f; icon-hazardous</option>
                        <option value="icon-piechart">&#xe050; icon-piechart</option>
                        <option value="icon-speedometer2">&#xe051; icon-speedometer2</option>
                        <option value="icon-global">&#xe052; icon-global</option>
                        <option value="icon-compass2">&#xe053; icon-compass2</option>
                        <option value="icon-lifesaver">&#xe054; icon-lifesaver</option>
                        <option value="icon-clock2">&#xe055; icon-clock2</option>
                        <option value="icon-aperture">&#xe056; icon-aperture</option>
                        <option value="icon-quote">&#xe057; icon-quote</option>
                        <option value="icon-scope">&#xe058; icon-scope</option>
                        <option value="icon-alarmclock">&#xe059; icon-alarmclock</option>
                        <option value="icon-refresh2">&#xe05a; icon-refresh2</option>
                        <option value="icon-happy">&#xe05b; icon-happy</option>
                        <option value="icon-sad">&#xe05c; icon-sad</option>
                        <option value="icon-facebook">&#xe05d; icon-facebook</option>
                        <option value="icon-twitter">&#xe05e; icon-twitter</option>
                        <option value="icon-googleplus">&#xe05f; icon-googleplus</option>
                        <option value="icon-rss">&#xe060; icon-rss</option>
                        <option value="icon-tumblr">&#xe061; icon-tumblr</option>
                        <option value="icon-linkedin">&#xe062; icon-linkedin</option>
                        <option value="icon-dribbble">&#xe063; icon-dribbble</option>
                        <option value="icon-linkedin2">&#xf0e1; icon-linkedin2</option>
                        <option value="icon-vk">&#xf189; icon-vk</option>
                        <option value="icon-behance">&#xf1b4; icon-behance</option>
                        <option value="icon-googleplus2">&#xe600; icon-googleplus2</option>
                        <option value="icon-google-drive">&#xe601; icon-google-drive</option>
                        <option value="icon-facebook2">&#xe602; icon-facebook2</option>
                        <option value="icon-instagram">&#xe603; icon-instagram</option>
                        <option value="icon-twitter2">&#xe604; icon-twitter2</option>
                        <option value="icon-feed2">&#xe605; icon-feed2</option>
                        <option value="icon-youtube">&#xe606; icon-youtube</option>
                        <option value="icon-vimeo">&#xe607; icon-vimeo</option>
                        <option value="icon-flickr">&#xe608; icon-flickr</option>
                        <option value="icon-picassa">&#xe609; icon-picassa</option>
                        <option value="icon-dribbble2">&#xe60a; icon-dribbble2</option>
                        <option value="icon-forrst">&#xe60b; icon-forrst</option>
                        <option value="icon-deviantart">&#xe60c; icon-deviantart</option>
                        <option value="icon-steam">&#xe60d; icon-steam</option>
                        <option value="icon-github">&#xe60e; icon-github</option>
                        <option value="icon-wordpress">&#xe60f; icon-wordpress</option>
                        <option value="icon-joomla">&#xe610; icon-joomla</option>
                        <option value="icon-blogger">&#xe611; icon-blogger</option>
                        <option value="icon-tumblr2">&#xe612; icon-tumblr2</option>
                        <option value="icon-yahoo">&#xe613; icon-yahoo</option>
                        <option value="icon-apple">&#xe614; icon-apple</option>
                        <option value="icon-android">&#xe615; icon-android</option>
                        <option value="icon-windows8">&#xe616; icon-windows8</option>
                        <option value="icon-soundcloud">&#xe617; icon-soundcloud</option>
                        <option value="icon-skype">&#xe618; icon-skype</option>
                        <option value="icon-reddit">&#xe619; icon-reddit</option>
                        <option value="icon-lastfm">&#xe61a; icon-lastfm</option>
                        <option value="icon-stumbleupon">&#xe61b; icon-stumbleupon</option>
                        <option value="icon-stackoverflow">&#xe61c; icon-stackoverflow</option>
                        <option value="icon-pinterest">&#xe61d; icon-pinterest</option>
                        <option value="icon-xing">&#xe61e; icon-xing</option>
                        <option value="icon-foursquare">&#xe61f; icon-foursquare</option>
                        <option value="icon-paypal">&#xe620; icon-paypal</option>
                        <option value="icon-html5">&#xe621; icon-html5</option>
                        <option value="icon-css3">&#xe622; icon-css3</option>				
                    </select>

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
                    <input type="text" class="form-control" id="videoURL" placeholder="Enter an video URL" value="">
                    <a href="#videoModal" data-toggle="modal" type="button" class="btn btn-default btn-embossed btn-block margin-bottom-20"><span class="fui-video"></span> <?php echo $this->lang->line('modal_videolibrary') ?></a>

                </div><!-- /.tab-pane -->

                <div class="tab-pane " id="map_Tab">

                    <label>Enter Address:</label>

                    <input type="text" class="form-control margin-bottom-20" id="address" placeholder="Enter your address" value="">

                </div><!-- /.tab-pane -->

            </div> <!-- /tab-content -->

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

        </div><!-- /.styleEditor -->

        <div id="hidden">
            <iframe src="<?php echo base_url(); ?>elements/skeleton.html" id="skeleton"></iframe>
        </div>

        <!-- modals -->

        <!-- Site setting popup-->
        <?php $this->load->view("shared/modal_sitesettings.php"); ?> 

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
        <div class="modal fade" id="editContentModal" tabindex="-1" role="dialog" aria-hidden="true">
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

        <!-- Seo Settings popup -->
        <div class="modal fade pageSettingsModal" id="pageSettingsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

            <div class="modal-dialog modal-lg">

                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo $this->lang->line('modal_close') ?></span></button>
                        <h4 class="modal-title" id="myModalLabel"><span class="fui-gear"></span> <?php echo 'SEO Settings' /* $this->lang->line('modal_pagesettings_header') */ ?> <span class="text-primary pName">index.html</span></h4>
                    </div>

                    <div class="modal-body">

                        <div class="loader" style="display: none;">
                            <img src="<?php echo base_url(); ?>assets/sites/images/loading.gif" alt="Loading...">
                            <?php echo $this->lang->line('modal_pagesettings_loadertext') ?>
                        </div>

                        <div class="modal-alerts"></div>

                        <?php
                        if (isset($pagesData)) {
                            echo $this->load->view('partials/pagedata.php', array('pagesData' => $pagesData, 'siteData' => $siteData['site']));
                        } else {
                            echo $this->load->view('partials/pagedata.php', array('siteData' => $siteData['site']));
                        }
                        ?>

                    </div><!-- /.modal-body -->

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-embossed" data-dismiss="modal"><span class="fui-cross"></span> <?php echo $this->lang->line('modal_cancelclose') ?></button>
                        <button type="button" class="btn btn-primary btn-embossed" id="pageSettingsSubmittButton"><span class="fui-check"></span> <?php echo $this->lang->line('sitesettings_button_savesettings') ?></button>
                    </div>

                </div><!-- /.modal-content -->

            </div><!-- /.modal-dialog -->

        </div><!-- /.modal -->

        <!-- publish popup -->
        <div class="modal fade" id="publishModal" tabindex="-1" role="dialog" aria-hidden="true">

            <form action="<?php echo site_url('sites/publish') ?>" target="_blank" id="publishForm" method="post" class="form-horizontal">

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
        <div class="modal fade " id="imageModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo $this->lang->line('modal_close') ?></span></button>
                        <h4 class="modal-title" id="myModalLabel"><span class="fui-upload"></span> <?php echo $this->lang->line('modal_imagelibrary_heading') ?></h4>
                    </div>
                    <div class="modal-body">

                        <div class="loader" style="display: none;">
                            <img src="<?php echo base_url(); ?>assets/sites/images/loading.gif" alt="Loading...">
                            <?php echo $this->lang->line('modal_imagelibrary_loadertext') ?>
                        </div>

                        <div class="modal-alerts">

                        </div>

                        <div class="modal-body-content">

                            <ul class="nav nav-tabs nav-append-content">
                                <li id="myImagesTabLI" class="active"><a href="#myImagesTab"><?php echo $this->lang->line('modal_imagelibrary_tab_myimages') ?></a></li>
                                <li id="uploadTabLI"><a href="#uploadTab"><?php echo $this->lang->line('modal_imagelibrary_tab_uploadimage') ?></a></li>
                            </ul> <!-- /tabs -->

                            <div class="tab-content">

                                <div class="tab-pane active" id="myImagesTab">

                                    <?php if (isset($userImages)): ?>

                                        <?php $this->load->view("partials/myimages.php", array('userImages' => $userImages)); ?>

                                    <?php else: ?>

                                        <!-- Alert Info -->
                                        <div class="alert alert-info">
                                            <button type="button" class="close fui-cross" data-dismiss="alert"></button>
                                            <?php echo $this->lang->line('modal_imagelibrary_message_noimages'); ?>
                                        </div>

                                    <?php endif; ?>

                                </div><!-- /.tab-pane -->

                                <div class="tab-pane" id="uploadTab">

                                    <form id="imageUploadForm" action="<?php echo site_url('sites/assets/imageUploadAjax/' . $siteData['site']->sites_id); ?>">

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
                                        </div>

                                    </form>

                                    <hr>

                                    <button type="button" class="btn btn-primary btn-embossed btn-wide upload btn-block disabled" id="uploadImageButton"><span class="fui-upload"></span> <?php echo $this->lang->line('modal_imagelibrary_button_upload') ?></button>
                                    <button type="button" class="btn btn-primary btn-embossed btn-wide upload btn-block disabled" id="uploadImageButtonDrop"><span class="fui-upload"></span> <?php echo $this->lang->line('modal_imagelibrary_button_upload') ?></button>

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
        
        <!-- Video Gallery Modal -->
        <div class="modal fade imageModal" id="videoModal" tabindex="-1" role="dialog" aria-hidden="true">
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
                JadooWeb builder...
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
        <script src="<?php echo base_url('assets/sites'); ?>/js/redactor/redactor.min.js"></script>
        <script src="<?php echo base_url('assets/sites'); ?>/js/redactor/table.js"></script>
        <script src="<?php echo base_url('assets/sites'); ?>/js/redactor/bufferButtons.js"></script>
        <script src="<?php echo base_url('assets/sites'); ?>/js/src-min-noconflict/ace.js"></script>
        <script src="<?php echo base_url(); ?>elements.json"></script>
        <script src="<?php echo base_url('assets/sites'); ?>/js/builder.js"></script>
        <script src="<?php echo base_url('assets/sites'); ?>/js/jquery.form.min.js"></script>
        <script src="<?php echo base_url('assets/sites'); ?>/js/scrollbar/jquery.nicescroll.min.js"></script>
        <script src="<?php echo base_url('assets/sites/js/bootstrap-switch.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/adminlte.js'); ?>"></script>
<<<<<<< HEAD
		<script src="<?php echo base_url('elements/scripts/html5gallery.js'); ?>" type="text/javascript" ></script>
=======
        <script src="<?php echo base_url('elements/scripts/html5gallery.js'); ?>" type="text/javascript" ></script>
>>>>>>> ec8bee2b971cee371497ff15616ef4daf85c3f5d

        <!-- Loading Elements JS -->
<!--        <script src="<?php // echo base_url('elements/scripts/jquery-1.11.2.min.js');    ?>"></script> 
        <script src="<?php // echo base_url('elements/scripts/bootstrap.min.js');    ?>"></script> -->
        <script src="<?php echo base_url('elements/scripts/jquery.validate.min.js'); ?>"></script>
        <script src="<?php echo base_url('elements/scripts/smoothscroll.js'); ?>"></script> 
        <script src="<?php echo base_url('elements/scripts/jquery.smooth-scroll.min.js'); ?>"></script> 
        <script src="<?php echo base_url('elements/scripts/placeholders.jquery.min.js'); ?>"></script> 
        <script src="<?php echo base_url('elements/scripts/jquery.magnific-popup.min.js'); ?>"></script>
        <script src="<?php echo base_url('elements/scripts/jquery.counterup.min.js'); ?>"></script>
        <script src="<?php echo base_url('elements/scripts/waypoints.min.js'); ?>"></script>
        <script src="<?php echo base_url('elements/scripts/video.js'); ?>"></script>
        <script src="<?php echo base_url('elements/scripts/bigvideo.js'); ?>"></script>
        <script src="<?php echo base_url('elements/scripts/animations/wow.min.js'); ?>"></script>
        <script src="<?php echo base_url('elements/scripts/jquery.jCounter-0.1.4.js'); ?>"></script>
        <script src="<?php echo base_url('elements/scripts/bootstrap-datepicker.min.js'); ?>"></script>
        <script src="<?php echo base_url('elements/scripts/custom.js'); ?>"></script>

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
                function VideoSelectHandler(e) {

                    $("#uploadVideoButton").hide();
                    $("#uploadVideoButtonDrop").css("display", "block");
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
                
                $('button#uploadVideoButtonDrop').click(function() {

                    // START A LOADING SPINNER HERE

                    //remove old alerts
                    $('#videoModal .modal-alerts > *').remove();

                    //disable button
                    $('button#uploadVideoButton').addClass('disable');

                    //show loader
                    $('#videoModal .loader').fadeIn(500);

                    // Create a formdata object and add the files

                    for (var i = 0; i < files.length; i++)
                    {
                        var form = $('form#videoUploadForm');

                        var formdata = false;

                        if (window.FormData) {
                            fd = new FormData(form[0]);
                        }

                        fd.append('videoFile', files[i]);

                        sendVideoToServer(fd);

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
                            $('#myImagesTab > *').remove();
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

                function sendVideoToServer(formData)
                {
                    var form = $('form#videoUploadForm');

                    var formAction = form.attr('action');

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
                        $('button#uploadVideoButtonDrop').addClass('disable');

                        //hide loader
                        $('#videoModal .loader').fadeOut(500);

                        if (ret.responseCode == 0) {//error

                            $('#videoModal .modal-alerts').append($(ret.responseHTML));

                        } else if (ret.responseCode == 1) {//success

                            //append my images
                            $('#myVideosTab > *').remove();
                            $('#myVideosTab').append($(ret.myVideos));

                            $('#videoModal .modal-alerts').append($(ret.responseHTML));

                            setTimeout(function() {
                                $('#videoModal .modal-alerts > *').fadeOut(500);
                            }, 3000);

                            $('#uploadVideoTab').find('a.fileinput-exists').click();
                        }

                    });


                    $("#fileinput-preview").html(
                            ''
                            );
                    $("#uploadVideoButton").show();
                    $("#uploadVideoButtonDrop").css("display", "none");
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
                            //$('#imageFile').prop("files", e.originalEvent.dataTransfer.files);
                        };

                        $('button#uploadImageButtonDrop').removeClass('disabled');

                        reader.readAsDataURL(file);
                    }
                    if (file.type.indexOf("video") == 0) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $("#videoinput-preview").html(
                                    '<div class="videoGallery" data-responsive="true" responsivefullscreen="true" data-html5player="true" data-src="' + e.target.result + '" data-showtitle="false" style="display:none;"></div>'
                            );
                        };
                        $(".videoGallery").html5gallery();
                        $('button#uploadVideoButtonDrop').removeClass('disabled');

                        reader.readAsDataURL(file);
                    }
                }


                // initialize
                function Init() {

//                    var imageselect = document.getElementById("imageFile");
                    var imagedrag = document.getElementById("fileinput-preview");
                    var videodrag = document.getElementById("videoinput-preview");

                    // file select
//  fileselect.addEventListener("change", FileSelectHandler, true);

                    // is XHR2 available?
                    var xhr = new XMLHttpRequest();
                    if (xhr.upload) {

                        // file drop
                        imagedrag.addEventListener("dragover", FileDragHover, false);
                        imagedrag.addEventListener("dragleave", FileDragHover, false);
                        imagedrag.addEventListener("drop", ImageSelectHandler, false);
                        
                        videodrag.addEventListener("dragover", FileDragHover, false);
                        videodrag.addEventListener("dragleave", FileDragHover, false);
                        videodrag.addEventListener("drop", VideoSelectHandler, false);
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
                $("#uploadVideoButtonDrop").css("display", "none");
                $("#uploadVideoButton").show();
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
            
            $("#videoFile").click(function() {
                $('input#videoFile').change(function() {

                    if ($(this).val() != '') {
                        $(".new").css("display", "none");
                        $(".exists").css("display", "inline");
                        $("#uploadVideoButtonDrop").css("display", "none");
                        $("#uploadVideoButton").show();
                    }
                });
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
<?php $this->load->view("shared/js_sitesettings.php"); ?>
        </script>
    </body>
</html>
