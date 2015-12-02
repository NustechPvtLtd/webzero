<style>
    .imageWrap {
        height: 160px;
    }
    .thumbnail {
        background-position: 100% 100%;
        height: 100%;
        width: 100%;
    }
    .col-lg-2 {
        padding-bottom: 15px;
        padding-top: 15px;
    }
</style>
<div class="container-fluid">	
<!--    <div class="row">
        <?php foreach ($thumbnails as $key => $value) { ?>
            <div class="col-lg-2">
                <div class="image">
                    <div class="imageWrap">
                        <img src="http://<?php echo $bucket; ?>.s3.amazonaws.com/<?php echo $value['name']; ?>" class="thumbnail"/>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>-->
    <div class="row">
        <?php foreach ($videos as $key => $value) { ?>
            <div class="col-lg-2">
                <div class="image">
                    <div class="imageWrap">
                        <!--<video width="100%" height="100%" src="http://<?php echo $bucket; ?>.s3.amazonaws.com/<?php echo $value['name']; ?>" controls="controls"></video>-->
                        <div class="html5gallery" data-responsive="true" responsivefullscreen="true" data-html5player="true" data-src="http://<?php echo $bucket; ?>.s3.amazonaws.com/<?php echo $value['name']; ?>" style="display:none;"></div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
<!--    <div class="row">
        <div class="col-lg-2">
            <div class="image">
                <div class="imageWrap">
                    <div class="html5gallery" data-responsive="true" responsivefullscreen="true" data-html5player="true" data-src="https://www.youtube.com/watch?v=AEIVhBS6baE" style="display:none;"></div>
                    <div class="html5gallery" data-responsive="true" responsivefullscreen="true" data-html5player="true" data-src="https://player.vimeo.com/video/146676581" style="display:none;"></div>
                </div>
            </div>
        </div>
    </div>-->
</div>