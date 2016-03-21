<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-Equiv="Cache-Control" Content="cache">
        <meta http-Equiv="Pragma" Content="cache">
        <meta http-Equiv="Expires" Content="1000">

        <!--META-DESCRIPTION-->
        <!--META-KEYWORDS-->

        <title><?php echo $pageTitle;?></title>

        <!--pageMeta-->

        <!-- Loading Bootstrap -->
        <link href="<?php echo base_url('studentelements/css/bootstrap.css')?>" rel="stylesheet">

        <!-- Loading Elements Styles -->   
        <link href="<?php echo base_url('studentelements/css/style.css')?>" rel="stylesheet">

        <!-- Loading Magnific-Popup Styles --> 
        <link href="<?php echo base_url('studentelements/css/magnific-popup.css')?>" rel="stylesheet">

        <!-- Loading Font Styles -->
        <link href="<?php echo base_url('studentelements/css/iconfont-style.css')?>" rel="stylesheet">

        <!-- WOW Animate-->
        <link href="<?php echo base_url('studentelements/scripts/animations/animate.css')?>" rel="stylesheet"/>

        <!-- Datepicker Styles -->   
        <link href="<?php echo base_url('studentelements/css/bootstrap-datepicker3.min.css')?>" rel="stylesheet">

        <!-- student profile css needed. -->

        <link href="<?php echo base_url('studentelements/css/font-awesome.css')?>" rel="stylesheet">
        <link href="<?php echo base_url('studentelements/css/animsition.min.css')?>" rel="stylesheet">
        <link href="<?php echo base_url('studentelements/css/progress.css')?>" rel="stylesheet">
        <link href="<?php echo base_url('studentelements/css/student-style.css')?>" rel="stylesheet">	
        <link href="<?php echo base_url('studentelements/css/front-student-style.css')?>" rel="stylesheet">	

        <!-- end student profile css needed -->		

        <!-- Font Awesome -->
        <link href="<?php echo base_url('studentelements/css/font-awesome.css')?>" rel="stylesheet">

        <script src="<?php echo base_url('studentelements/scripts/jquery-1.11.2.min.js')?>"></script>
        <script src="<?php echo base_url('studentelements/scripts/front-student-style.js')?>"></script>

        <!-- Favicons -->
        <link rel="icon" href="<?php echo base_url('elements/images/favicons/favicon.png')?>">

        <!--CUSTOM-JS-->

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
        <!--[if lt IE 9]>
          <script src="scripts/html5shiv.js"></script>
          <script src="scripts/respond.min.js"></script>
        <![endif]-->

        <!--headerIncludes-->

        <style>
            @media(max-width:767px){
                .getdirnb{margin-top:20px;}
            }
        </style>

    </head>
    <body data-spy="scroll" data-target=".navMenuCollapse">

        <!--PRELOADER-->
        <div class="wrap">
            <?php echo $body; ?>
        </div><!-- /.wrap -->

        <!-- MODALS BEGIN-->
        <div class="modal fade" id="modalMessage" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 class="modal-title">&nbsp;</h3>
                </div>
            </div>
        </div>
        <!-- MODALS END-->

        <?php echo $contact_url;?>
        <?php echo $counter_url;?>
        <?php echo $site_url;?>
        <?php echo $page_id;?>
        <?php echo $page_url;?>
        <?php echo $siteurl;?>
        <?php echo $siteId;?>

        <!-- Load JS here for greater good =============================-->

        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Enter Password To Access Profile</h4>
                        <div class="alert alert-danger fade in errorlogin" style="display:none">
                            <span class="closebox" href="#">×</span>
                            <strong>Error!</strong> <span class="errormsg"></span>
                        </div>
                    </div>
                    <div class="modal-body">
                        <input type="password" name="sitepassword" class="sitepwd"/>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary loginpwdsite">Click To View</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- JavaScript --> 
        <script src="<?php echo base_url('studentelements/scripts/jquery-1.11.2.min.js')?>"></script> 
        <script src="<?php echo base_url('studentelements/scripts/bootstrap.min.js')?>"></script> 
        <script src="<?php echo base_url('studentelements/scripts/jquery.validate.min.js')?>"></script>
        <script src="<?php echo base_url('studentelements/scripts/smoothscroll.js')?>"></script> 
        <script src="<?php echo base_url('studentelements/scripts/jquery.smooth-scroll.min.js')?>"></script> 
        <script src="<?php echo base_url('studentelements/scripts/placeholders.jquery.min.js')?>"></script> 
        <script src="<?php echo base_url('studentelements/scripts/jquery.magnific-popup.min.js')?>"></script>
        <script src="<?php echo base_url('studentelements/scripts/jquery.counterup.min.js')?>"></script>
        <script src="<?php echo base_url('studentelements/scripts/waypoints.min.js')?>"></script>
        <script src="<?php echo base_url('studentelements/scripts/video.js')?>"></script>
        <script src="<?php echo base_url('studentelements/scripts/bigvideo.js')?>"></script>
        <script src="<?php echo base_url('studentelements/scripts/animations/wow.min.js')?>"></script>
        <script src="<?php echo base_url('studentelements/scripts/jquery.jCounter-0.1.4.js')?>"></script>
        <script src="<?php echo base_url('studentelements/scripts/bootstrap-datepicker.min.js')?>"></script>
        <script src="<?php echo base_url('studentelements/scripts/custom.js')?>"></script>

        <!-- student js required -->
        <script src="<?php echo base_url('studentelements/scripts/jquery.animsition.min.js')?>"></script>
        <script src="<?php echo base_url('studentelements/scripts/jquery-asPieProgress.min.js')?>"></script>
        <script src="<?php echo base_url('studentelements/scripts/jquery.waypoints.min.js')?>"></script>
        <script src="<?php echo base_url('studentelements/scripts/isotope.pkgd.min.js')?>"></script>
        <script src="<?php echo base_url('elements/scripts/html5gallery.js')?>"></script>		
        <script src="<?php echo base_url('studentelements/scripts/student-svg.js')?>"></script>
        <!-- end student js needed -->		
    </body>
</html>
