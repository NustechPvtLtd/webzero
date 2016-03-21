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
        <?php if (isset($css)) echo implode("\n", $css) . "\n"; ?>
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
                    <button class="navbar-toggle" data-target="#navbar-ex-collapse"
                            data-toggle="collapse" type="button"><span class=
                                                               "sr-only">Toggle navigation</span> <span class=
                                                               "icon-bar"></span> <span class="icon-bar"></span> <span class=
                                                               "icon-bar"></span></button> <a class="navbar-brand" href=
                                                   "<?php echo site_url(); ?>"><span><img class="img-responsive" src="<?php echo base_url(); ?>assets/home/img/logo.png"></span></a>
                </div>
                <div class="collapse navbar-collapse" id="navbar-ex-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="propClone">
                            <a data-scroll="" href="<?php echo site_url('#carousel-example'); ?>">Home</a>
                        </li>

                        <li class="propClone">
                            <a data-scroll="" href="<?php echo site_url('#features'); ?>">Features</a>
                        </li>

                        <li class="propClone">
                            <a data-scroll="" href="<?php echo site_url('#video_img'); ?>">Demo</a>
                        </li>

                        <li class="propClone">
                            <a data-scroll="" href="<?php echo site_url('#browse_templates'); ?>">Example
                                Website</a>
                        </li>

                        <li class="propClone">
                            <a data-scroll="" href="<?php echo site_url('#get_started'); ?>" id="register">Get Started</a>
                        </li>

                        <li class="propClone">
                            <a data-scroll="" href="<?php echo site_url('#login_register'); ?>" id="login">Login</a>
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
                    <div class="copyrite">
                        <div class="col-md-7">
                            <p>Copyright 2015 Jadooweb. All rights reserved.
                                <a href="<?php echo site_url('privacy') ?>" >Privacy Policy</a>
                                <span>|</span><a href="<?php echo site_url('terms-and-condition') ?>" >Terms of Service</a></p>
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
        <script src="<?php echo base_url(); ?>assets/home/js/smooth-scroll.min.js" type="text/javascript" ></script> 
        <script src="<?php echo base_url(); ?>assets/home/js/script.js" type="text/javascript" ></script>
        <script>
            // Our countdown plugin takes a callback, a duration, and an optional message
            $.fn.countdown = function(callback, duration, message) {
                // If no message is provided, we use an empty string
                message = message || "";
                // Get reference to container, and set initial content
                var container = $(this[0]).html(duration + message);
                // Get reference to the interval doing the countdown
                var countdown = setInterval(function() {
                    // If seconds remain
                    if (--duration) {
                        // Update our container's message
                        container.html(duration + message);
                        // Otherwise
                    } else {
                        // Clear the countdown interval
                        clearInterval(countdown);
                        // And fire the callback passing our container as `this`
                        callback.call(container);
                    }
                    // Run interval every 1000ms (1 second)
                }, 1000);

            };

            // Function to be called after 5 seconds
            function redirect() {
                this.html("Done counting, redirecting.");
                window.location = "<?php echo site_url(); ?>";
            }
        </script>
        <?php if (isset($js)) echo implode("\n", $js) . "\n"; ?>
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jstimezonedetect/1.0.4/jstz.min.js">
        </script>
        <script type="text/javascript">
            $(document).ready(function() {
                var tz = jstz.determine(); // Determines the time zone of the browser client
                var timezone = tz.name(); //'Asia/Kolhata' for Indian Time.
                $.post("<?php echo site_url(); ?>", {tz: timezone}, function(data) {
                    //Preocess the timezone in the controller function and get
                    //the confirmation value here. On success, refresh the page.
                });
            });
        </script>
    </body>
</html>