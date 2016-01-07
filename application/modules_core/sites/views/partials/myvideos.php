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
<div class="videos masonry-3" id="myVideos">

    <?php foreach ($userVideos as $video): ?>
        <div class="video">
            <div class="videoWrap">
                <div class="videoGallery" data-responsive="true" responsivefullscreen="true" data-width="160" data-height="88" data-html5player="true" data-src="https://<?php echo $bucket; ?>.s3.amazonaws.com/<?php echo $video['name']; ?>" data-showtitle="false" style="display:none; width:170px;height:100px"></div>
            </div>

            <div class="buttons clearfix">
                <button type="button" class="btn btn-info btn-embossed btn-block btn-sm useVideo" data-url="https://<?php echo $bucket; ?>.s3.amazonaws.com/<?php echo $video['name']; ?>"><span class="fui-export"></span> <?php echo $this->lang->line('modal_videolibrary_button_insertvideo') ?></button>
                <button type="button" class="btn btn-danger btn-embossed btn-block btn-sm deleteVideo" data-url="<?php echo site_url('sites/amazon_services/videoDelete');?>" data-bucket="<?php echo $bucket; ?>" data-video="<?php echo $video['name']; ?>"><span class="fui-cross"></span> <?php echo $this->lang->line('modal_videolibrary_button_deletevideo') ?></button>
            </div>

        </div><!-- /.video -->
    <?php endforeach ?>

</div><!-- /.video -->