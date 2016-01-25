<div class="images masonry-3" id="adminImages">
    <?php if (isset($adminImages)): ?>

        <?php foreach ($adminImages as $key => $img): ?>
            <div class="image">

                <div class="imageWrap">
                    <img class="img-thumbnail" src="<?php echo base_url() . $this->config->item('s_images_dir'); ?>/<?php echo $img; ?>">
                </div>

                <?php
                $dataUrl = base_url($this->config->item('s_images_dir')) . '/' . $img;
                ?>

                <div class="buttons clearfix">
                    <button type="button" class="btn btn-info btn-embossed btn-block btn-sm useImage" data-url="<?php echo $dataUrl; ?>"><span class="fui-export"></span> <?php echo $this->lang->line('modal_imagelibrary_button_insert') ?></button>
                </div>

            </div><!-- /.image -->
            <?php
                if(($key+1)%3==0){
                    echo '<div class="clearfix"></div>';
                }
            ?>
        <?php endforeach; ?>
    <?php endif; ?>

</div><!-- /.adminImages -->