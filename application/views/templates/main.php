<!DOCTYPE html>
<html dir="ltr">
    <head>
        <meta charset="utf-8">
        <title><?php echo $title; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="<?php echo $pageMetaDescription; ?>">
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        <link rel="shortcut icon" type="image/vnd.microsoft.icon" href="<?php echo base_url(); ?>assets/img/favicon.ico" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/ionicons.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/adminlte.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/skin-green.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/common.css" />
        <?php if (isset($css)) echo implode("\n", $css) . "\n"; ?>
        <script src="<?php echo base_url(); ?>assets/sites/js/jquery-1.8.3.min.js"></script>
        <style>
            .modal-backdrop {
                z-index: 1030;
                background-color: #243342;
            }
            .modal-backdrop.in {
                opacity: 0.95;
                filter: alpha(opacity=95);
            }
            .modal {
                z-index: 1040;
                overflow-y: auto;
            }
            .modal-dialog {
                z-index: 1050;
                top: 15%;
            }
            .modal-content {
                background-color: #f9fafb;
                border: 2px solid #ebedef;
                border-radius: 4px 4px 0 0;
                -webkit-background-clip: border-box;
                -moz-background-clip: border-box;
                background-clip: border-box;
            }
            @media (max-width: 767px) {
                .modal-content {
                    width: auto;
                }
            }
            @media (max-width: 480px) {
                .modal-content {
                    -webkit-box-shadow: none;
                    box-shadow: none;
                }
            }
            .modal-header {
                padding: 17px 19px 15px 24px;
                border-bottom: 1px solid #ebedef;
            }
            .modal-header .close {
                margin: 5px 0 0;
                padding: 0;
                font-size: 18px;
                line-height: 1;
                color: #34495e;
            }
            .modal-title {
                margin: 0;
                font-size: 24px;
                line-height: 30px;
            }
            .modal-body {
                padding: 15px;
            }
            .modal-footer {
                padding: 19px 22px 20px;
                margin-top: 0;
                background-color: #ebedef;
                border-top: none;
                border-radius: 0 0 7px 7px;
            }
            @media (max-width: 480px) {
                .modal-footer .btn {
                    display: block;
                    min-width: auto;
                }
                .modal-footer .btn:last-child {
                    margin-bottom: 0;
                }
                .modal-footer .btn + .btn {
                    margin-left: 0;
                }
            }
            .optionPane {
                background: #eee;
                border: 2px dashed #ddd;
                padding: 30px 20px;
                overflow: auto;
            }
            .selectGroupModal .form-group {
                margin-bottom: 0px;
            }
            label.group-label > input{ /* HIDE RADIO */
                visibility: hidden; /* Makes input not-clickable */
                position: absolute; /* Remove input from document flow */
            }
            label.group-label > img{ /* HIDE RADIO */
                margin: 0 25%;
            }
            label.group-label > h4{ /* HIDE RADIO */
                margin-bottom: 0;
                margin-top: 0;
            }
            label.group-label{ /* HIDE RADIO */
                text-align: center;
            }
            label.group-label > input + img { /* IMAGE STYLES */
                cursor:pointer;
                border:2px solid transparent;
                width: 30%;
            }
            label.group-label > input:checked + img { /* (RADIO CHECKED) IMAGE STYLES */
                border:2px solid #f00;
            }
        </style>
    </head>
    <body class="skin-green">
        <header class="header">
            <a href="<?php echo site_url(); ?>" class="logo icon">
                <img  class="img-responsive" src="<?php echo base_url(); ?>assets/img/logo.png" alt="Customer area" />            
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
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <aside class="left-side sidebar-offcanvas">
                <section class="sidebar">
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="<?php echo (userdata('avatar')) ? base_url('elements') . '/images/uploads/' . userdata('user_id') . '/' . userdata('avatar') . '?' . time() : base_url('assets') . '/sites/images/dude.png?' . time(); ?>" class="img-circle" />
                        </div>
                        <div class="pull-left info">
                            <p><?php echo ($fullName = ucwords(userdata('username'))) ? $fullName : 'Welcome'; ?></p>
                        </div>
                    </div>
                    <ul class="sidebar-menu">
                        <?php
                        if ($this->ion_auth->in_group(array('individuals', 'students'))) {
                            include_once 'user_menu.php';
                        } elseif ($this->ion_auth->in_group(array('employer'))) {
                            include_once 'recruiter_menu.php';
                        }else {
                            include_once 'admin_menu.php';
                        }
                        ?>
                    </ul>
                    <div class="timeinfo">
                        <div class="pull-left"><?php echo 'Local time'; ?></div>
                        <div class="pull-right"><?php echo unix_to_human(time()); ?></div>
                        <div class="clearfix"><!-- --></div>
                        <div class="pull-left"><?php echo 'System time'; ?></div>
                        <div class="pull-right"><?php echo date('Y-m-d H:i:s'); ?></div>
                        <div class="clearfix"><!-- --></div>
                    </div>                 
                </section>
            </aside>
            <aside class="right-side">
                <section class="content-header">
                    <h1><?php echo!empty($pageHeading) ? $pageHeading : '&nbsp;'; ?></h1>
                    <?php
                    echo create_breadcrumb();
                    ?>
                </section>
                <section class="content">
                    <?php echo $body; ?>
                </section>
            </aside>
        </div>
        <footer>
            <div class="clearfix"><!-- --></div>
        </footer>
        <script type="text/javascript" defer="defer" src="<?php echo base_url(); ?>assets/js/knockout-3.1.0.js"></script>
        <script type="text/javascript" defer="defer" src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
        <script type="text/javascript" defer="defer" src="<?php echo base_url(); ?>assets/js/notify.js"></script>
        <script type="text/javascript" defer="defer" src="<?php echo base_url(); ?>assets/js/adminlte.js"></script>	
        <!--<script type="text/javascript" src="<?php //echo base_url();      ?>customer/assets/js/app.js"></script>-->
        <script type="text/javascript" defer="defer" src="<?php echo base_url(); ?>assets/js/flot/jquery.flot.min.js"></script>
        <script type="text/javascript" defer="defer" src="<?php echo base_url(); ?>assets/js/flot/jquery.flot.resize.min.js"></script>
        <script type="text/javascript" defer="defer" src="<?php echo base_url(); ?>assets/js/flot/jquery.flot.categories.min.js"></script>
<!--        <script type="text/javascript" defer="defer" src="/support_apps/livechat/php/app.php?widget-init.js"></script>-->
        <?php if (isset($js)) echo implode("\n", $js) . "\n"; ?>
        <?php if ($this->ion_auth->in_group('nogroup')): ?>
            <script type="text/javascript">
                $(document).ready(function() {
                    $('#myModal').on('show.bs.modal', function() {
                        $('.selectGroupModal .group-label input').on('click', function() {
                            $('#group').val($(this).val());
                            $('#update_group_form').submit();
                        });
                    });
                    $('#myModal').modal({show: true});
                });
                var dis = document.getElementById("myModal");
                dis.onmousedown = disableclick;
                status = "Right Click Disabled";
                function disableclick(event)
                {
                    if (event.button == 2)
                    {
                        alert(status);
                        return false;
                    } else {
                        return true;
                    }
                }
            </script>
        <?php endif; ?>
    </body>
</html>