<!DOCTYPE html>
<html dir="ltr">
<head>
    <meta charset="utf-8">
    <title><?php echo $title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo $pageMetaDescription;?>">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
	<link rel="shortcut icon" type="image/vnd.microsoft.icon" href="<?php echo base_url();?>assets/img/favicon.ico" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/ionicons.min.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/adminlte.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/skin-green.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/common.css" />
	<?php if(isset($css)) echo implode("\n", $css) . "\n";?>
	<script src="<?php echo base_url();?>assets/sites/js/jquery-1.8.3.min.js"></script>
</head>
<body class="skin-green">
    <header class="header">
            <a href="<?php echo site_url();?>" class="logo icon">
                <img  class="img-responsive" src="<?php echo base_url();?>assets/img/logo.png" alt="Customer area" />            
			</a>
            <nav class="navbar navbar-static-top" role="navigation">
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span><?php echo ($fullName = ucwords(userdata( 'username' ))) ? $fullName : 'Welcome';?> <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="user-header bg-light-blue">
                                    <img src="<?php echo (userdata('avatar'))? base_url('elements').'/images/uploads/'.userdata( 'user_id' ).'/'.userdata( 'avatar' ).'?'.time(): base_url('assets').'/sites/images/dude.png?'.time();?>" class="img-circle"/>
                                    <p>
                                        <?php echo ($fullName = ucwords(userdata( 'username' ))) ? $fullName : 'Welcome';?>
                                    </p>
                                </li>
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="<?php echo site_url('user/profile')?>" class="btn btn-default btn-flat"><?php echo 'My Profile';?></a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="<?php echo site_url('logout');?>" class="btn btn-default btn-flat"><?php echo 'Logout';?></a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <aside class="left-side sidebar-offcanvas">
                <section class="sidebar">
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="<?php echo (userdata('avatar'))? base_url('elements').'/images/uploads/'.userdata( 'user_id' ).'/'.userdata( 'avatar' ).'?'.time(): base_url('assets').'/sites/images/dude.png?'.time();?>" class="img-circle" />
                        </div>
                        <div class="pull-left info">
                            <p><?php echo ($fullName = ucwords(userdata( 'username' ))) ? $fullName : 'Welcome';?></p>
                        </div>
                    </div>
                    <ul class="sidebar-menu">
                    <?php if ($this->ion_auth->in_group(array('individuals'))){
                        include_once 'user_menu.php';
                    } elseif ($this->ion_auth->in_group(array('comp-admin'))){
                        include_once 'user_menu.php';
//                        include_once 'customer_menu.php';
                    }else {
                        include_once 'admin_menu.php';
                    }?>
                    </ul>
                    <div class="timeinfo">
                        <div class="pull-left"><?php echo 'Local time';?></div>
                        <div class="pull-right"><?php echo unix_to_human(time()); ?></div>
                        <div class="clearfix"><!-- --></div>
                        <div class="pull-left"><?php echo 'System time';?></div>
                        <div class="pull-right"><?php echo date('Y-m-d H:i:s');?></div>
                        <div class="clearfix"><!-- --></div>
                    </div>                 
                </section>
            </aside>
            <aside class="right-side">
                <section class="content-header">
                    <h1><?php echo !empty($pageHeading) ? $pageHeading : '&nbsp;';?></h1>
                    <?php
						echo create_breadcrumb();
                    ?>
                </section>
                <section class="content">
                    <?php echo $body;?>
                </section>
            </aside>
        </div>
        <footer>
            <div class="clearfix"><!-- --></div>
        </footer>
		<script type="text/javascript" defer="defer" src="<?php echo base_url();?>assets/js/knockout-3.1.0.js"></script>
		<script type="text/javascript" defer="defer" src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
		<script type="text/javascript" defer="defer" src="<?php echo base_url();?>assets/js/notify.js"></script>
		<script type="text/javascript" defer="defer" src="<?php echo base_url();?>assets/js/adminlte.js"></script>	
		<!--<script type="text/javascript" src="<?php //echo base_url();?>customer/assets/js/app.js"></script>-->
		<script type="text/javascript" defer="defer" src="<?php echo base_url();?>assets/js/flot/jquery.flot.min.js"></script>
		<script type="text/javascript" defer="defer" src="<?php echo base_url();?>assets/js/flot/jquery.flot.resize.min.js"></script>
		<script type="text/javascript" defer="defer" src="<?php echo base_url();?>assets/js/flot/jquery.flot.categories.min.js"></script>
<!--        <script type="text/javascript" defer="defer" src="/support_apps/livechat/php/app.php?widget-init.js"></script>-->
        <?php if(isset($js)) echo implode("\n", $js) . "\n";?>
    </body>
</html>