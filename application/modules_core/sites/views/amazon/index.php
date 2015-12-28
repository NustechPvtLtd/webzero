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

    <div class="row">
        <?php foreach ($videos as $key => $value) { ?>
            <div class="col-lg-2">
                <div class="image">
                    <div class="imageWrap">
                        <div class="html5gallery" data-responsive="true" responsivefullscreen="true" data-html5player="true" data-src="http://<?php echo $bucket; ?>.s3.amazonaws.com/<?php echo $value['name']; ?>" style="display:none;"></div>
<!--                         <video width="320" height="240" controls>
                            <source src="http://<?php echo $bucket; ?>.s3.amazonaws.com/<?php echo $value['name']; ?>" type="video/mp4">
                          </video> -->
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

</div>