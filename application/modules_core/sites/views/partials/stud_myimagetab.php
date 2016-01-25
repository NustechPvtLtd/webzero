<?php if (isset($userImages) && $userImages): ?>

    <?php $this->load->view("partials/stud_myimages.php", array('userImages' => $userImages)); ?>

<?php else: ?>

    <!-- Alert Info -->
    <div class="alert alert-info">
        <button type="button" class="close fui-cross" data-dismiss="alert"></button>
        <?php echo $this->lang->line('modal_imagelibrary_message_noimages'); ?>
    </div>

<?php endif; ?>

