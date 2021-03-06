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
    </head>
    <body class="skin-green">
        <header class="header">
            <a href="<?php echo site_url(); ?>" class="logo icon">
                <img class="img-responsive" src="<?php echo base_url(); ?>assets/img/logo.png"  />            
            </a>
            <nav class="navbar navbar-static-top" role="navigation"></nav>
        </header>
        <div class="wrapper">
            <div class="row" style="height: 50px;"><!-- --></div>
            <div class="col-lg-4"></div>
            <div class="col-lg-4">
                <?php echo $body; ?>
            </div>
            <div class="col-lg-4"></div>
            <div class="clearfix"><!-- --></div>
        </div>
        <footer>
            <?php //$hooks->doAction('layout_footer_html', $this);?>
            <div class="clearfix"><!-- --></div>
        </footer>
        <script src="<?php echo base_url(); ?>assets/sites/js/jquery-1.8.3.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/knockout-3.1.0.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/notify.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/adminlte.js"></script>
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