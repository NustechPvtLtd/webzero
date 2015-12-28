<?php if (!empty($userImages)): ?>

    <?php $this->load->view("partials/myimages.php", array('userImages' => $userImages, 'bucket'=>$bucket)); ?>

<?php else: ?>

    <!-- Alert Info -->
    <div class="alert alert-info">
        <button type="button" class="close fui-cross" data-dismiss="alert"></button>
        <?php echo $this->lang->line('modal_imagelibrary_message_noimages'); ?>
    </div>

<?php endif; ?>

