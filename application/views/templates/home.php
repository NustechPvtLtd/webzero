<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1" name="viewport">
        <link rel="shortcut icon" type="image/vnd.microsoft.icon" href="<?php echo base_url(); ?>assets/img/favicon.ico">
        <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href='http://fonts.googleapis.com/css?family=Raleway:600,100,400,200' rel='stylesheet' type='text/css'>
        <link href="<?php echo base_url(); ?>assets/home/css/bootstrap.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url(); ?>assets/home/css/style.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url(); ?>assets/home/css/animate.min.css" rel="stylesheet">
        <!--<link href="<?php // echo base_url();  ?>assets/home/css/font-awesome.min.css" rel="stylesheet">-->
        <script src="<?php echo base_url(); ?>assets/home/js/jquery-1.10.2.min.js" type="text/javascript" ></script>

        <title><?php echo $title; ?></title>
    </head>

    <body>
        <div class="navbar navbar-default navbar_white navbar-fixed-top" id="main_navbar">
            <div class="container">
                <div class="navbar-header">
                    <button class="navbar-toggle" data-target="#navbar-ex-collapse"
                            data-toggle="collapse" type="button"><span class=
                                                               "sr-only">Toggle navigation</span> <span class=
                                                               "icon-bar"></span> <span class="icon-bar"></span> <span class=
                                                               "icon-bar"></span></button> <a class="navbar-brand" href=
                                                   "#"><span><img class="img-responsive" src="<?php echo base_url(); ?>assets/home/img/logo.png"></span></a>
                </div>

                <div class="collapse navbar-collapse" id="navbar-ex-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="active propClone">
                            <a data-scroll="" href="#carousel-example">Home</a>
                        </li>

                        <li class="propClone">
                            <a data-scroll="" href="#features">Features</a>
                        </li>

                        <li class="propClone">
                            <a data-scroll="" href="#video_img">Demo</a>
                        </li>

                        <li class="propClone">
                            <a data-scroll="" href="#browse_templates">Example
                                Website</a>
                        </li>

                        <li class="propClone">
                            <a data-scroll="" href="#login_register" id="register">Get Started</a>
                        </li>

                        <li class="propClone">
                            <a data-scroll="" href="#login_register" id="login">Login</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="main_class">
            <?php echo $body; ?>
        </div>
        <div class="section footer_section">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="col-md-3 col-sm-3">
                            <ul>
                                <li>
                                    <a href="#">Learn More</a>
                                </li>

                                <li>
                                    <a href="#">Features</a>
                                </li>

                                <li>
                                    <a href="#">Demo Video</a>
                                </li>

                                <li>
                                    <a href="#">Pricing</a>
                                </li>
                            </ul>
                        </div>

                        <div class="col-md-3 col-sm-3">
                            <ul>
                                <li>
                                    <a href="#">Company</a>
                                </li>

                                <li>
                                    <a href="#">About Us</a>
                                </li>

                                <li>
                                    <a href="#">Career</a>
                                </li>

                                <li>
                                    <a href="#">Partner With US</a>
                                </li>

                                <li>
                                    <a href="#">Contact Us</a>
                                </li>
                            </ul>
                        </div>

                        <div class="col-md-3 col-sm-3">
                            <ul>
                                <li>
                                    <a href="#">Support</a>
                                </li>

                                <li>
                                    <a href="#">Help</a>
                                </li>

                                <li>
                                    <a href="#">Contact Support</a>
                                </li>

                                <li>
                                    <a href="#">Privacy Policy</a>
                                </li>
                            </ul>
                        </div>

                        <div class="col-md-3 col-sm-3">
                            <ul>
                                <li>
                                    <a href="#">Community</a>
                                </li>

                                <li>
                                    <a href="#">Blogs</a>
                                </li>

                                <li>
                                    <a href="#">Forum</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="footer_box col-md-4">
                        <div class="section_heading">
                            <h2>Have a Quoestion? <span class=
                                                        "white_colored_text"><br/><a href="#">Get Help
                                        Now&gt;&gt;</a></span></h2>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                    <hr>

                    <div class="copyrite">
                        <div class="col-md-7">
                            <p>Copyright 2015 Webzero. All rights reserved.
                                <a href="#">Privacy Policy</a>
                                <span>|</span><a href="#">Terms of Service</a></p>
                        </div>

                        <div class="col-md-5 social">
                            <ul class="social_media">
                                <li class="f" ><a href="#"><i class="fa fa-facebook-f"></i></a></li>
                                <li class="g"><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li class="t"><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li class="y"><a href="#"><i class="fa fa-youtube"></i></a></li>
                            </ul>


                        </div>,
                    </div>
                </div>
            </div>
        </div>
        <script src="<?php echo base_url(); ?>assets/home/js/bootstrap.min.js" type="text/javascript" ></script> 
        <script src="<?php echo base_url(); ?>assets/home/js/jquery.waypoints.min.js" type="text/javascript" ></script> 
        <script src="<?php echo base_url(); ?>assets/home/js/smooth-scroll.min.js" type="text/javascript" >
        </script> 
        <script src="<?php echo base_url(); ?>assets/home/js/script.js" type="text/javascript" ></script>
        <script src="http://cdn.jsdelivr.net/jquery.validation/1.14.0/jquery.validate.js" type="text/javascript" ></script>
        <script type="text/javascript" >
            $(document).ready(function() {
                $('#embed-responsive-item').hide();
                $('#vd_img').click(function() {
                    $('#embed-responsive-item').show();
                    $(this).hide()
                            ;
                })
                        ;
            });
        </script> 
        <script type="text/javascript" >
            $('body').scrollspy({target: '#main_navbar'});
        </script> 
        <script type="text/javascript" >
            smoothScroll.init();
        </script> 
        <script type="text/javascript">
            $(document).ready(function() {

                $("#register").click(function() {
                    $(".login_form_container ").hide();
                    $(".register_form").show();
                });

                $("#login").click(function() {
                    $(".login_form_container ").show();
                    $(".register_form").hide();
                });

                $("#register_now").click(function() {
                    $(".login_form_container ").hide();
                    $(".register_form").show();
                });
                $("#back_toLogin").click(function() {
                    $(".login_form_container ").show();
                    $(".register_form").hide();
                });


            });
        </script>
        <!--<script type="text/javascript" src="/support_apps/livechat/php/app.php?widget-init.js" defer="defer"></script>-->
    </body>
</html>