<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1" name="viewport">
        <link rel="shortcut icon" type="image/vnd.microsoft.icon" href="<?php echo base_url(); ?>assets/img/favicon.ico">
        <link href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href='http://fonts.googleapis.com/css?family=Raleway:600,100,400,200' rel='stylesheet' type='text/css'>
        <link href="<?php echo base_url(); ?>assets/home/css/bootstrap.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url(); ?>assets/home/css/style.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url(); ?>assets/home/css/animate.min.css" rel="stylesheet">
        <!--<link href="<?php // echo base_url();    ?>assets/home/css/font-awesome.min.css" rel="stylesheet">-->
        <script src="<?php echo base_url(); ?>assets/home/js/jquery-1.10.2.min.js" type="text/javascript" ></script>

        <title><?php echo $title; ?></title>
        <style>
            .container.privacy, .container.terms {
                margin-bottom: 25px;
                margin-top: 100px;
            }
        </style>
    </head>

    <body>
        <div class="navbar navbar-default navbar_white navbar-fixed-top" id="main_navbar">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="<?php echo site_url();?>"><span><img class="img-responsive" src="<?php echo base_url(); ?>assets/home/img/logo.png"></span></a>
                </div>
            </div>
        </div>

        <div class="main_class">
            <?php echo $body; ?>
        </div>
        <div class="section footer_section">
            <div class="container">
                <div class="row">
                    <div class="copyrite">
                        <div class="col-md-7">
                            <p>Copyright 2015 Jadooweb. All rights reserved.
                                <a href="<?php echo site_url('privacy')?>" >Privacy Policy</a>
                                <span>|</span><a href="<?php echo site_url('terms-and-condition')?>" >Terms of Service</a></p>
                        </div>

                        <div class="col-md-5 social">
                            <ul class="social_media">
                                <li class="f" ><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li class="g"><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li class="t"><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li class="y"><a href="#"><i class="fa fa-youtube"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="<?php echo base_url(); ?>assets/home/js/bootstrap.min.js" type="text/javascript" ></script> 
        <script src="<?php echo base_url(); ?>assets/home/js/jquery.waypoints.min.js" type="text/javascript" ></script> 
        <script src="<?php echo base_url(); ?>assets/home/js/smooth-scroll.min.js" type="text/javascript" >
        </script> 
        <script src="<?php echo base_url(); ?>assets/home/js/script.js" type="text/javascript" ></script>
        <script type="text/javascript" >
            smoothScroll.init();
        </script> 
    </body>
</html>