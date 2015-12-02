<!--<style>
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
</style>-->
<div class="images masonry-3" id="myVideos">

    <?php foreach ($userVideos as $video): ?>
        <div class="image">

            <div class="imageWrap">
                <div class="videoGallery" data-responsive="true" responsivefullscreen="true" data-html5player="true" data-src="http://<?php echo $bucket; ?>.s3.amazonaws.com/<?php echo $video['name']; ?>" data-showtitle="false" style="display:none;"></div>
            </div>

            <div class="buttons clearfix">
                <button type="button" class="btn btn-info btn-embossed btn-block btn-sm useVideo" data-url="http://<?php echo $bucket; ?>.s3.amazonaws.com/<?php echo $video['name']; ?>"><span class="fui-export"></span> <?php echo $this->lang->line('modal_videolibrary_button_insertvideo') ?></button>
                <button type="button" class="btn btn-danger btn-embossed btn-block btn-sm deleteVideo" data-url="http://<?php echo $bucket; ?>.s3.amazonaws.com/<?php echo $video['name']; ?>"><span class="fui-cross"></span> <?php echo $this->lang->line('modal_videolibrary_button_deletevideo') ?></button>
            </div>

        </div><!-- /.video -->
    <?php endforeach ?>

</div><!-- /.video -->