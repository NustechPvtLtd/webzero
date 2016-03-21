<div class="screen" id="screen">

    <div class="toolbar">

        <div class="title" id="pageTitle">
            <span style="color: #16a085;font-size: 16px;font-weight: bold;"><?php echo (isset($siteData['site']->remote_url))? anchor($siteData['site']->remote_url, $siteData['site']->remote_url, 'target="_blank" style="color: #16a085;"'):'<span>index</span>.html';?></span>
        </div>

    </div>

    <div id="frameWrapper" class="frameWrapper empty">
        <div id="pageList">
            <?php if (count($siteData['pages']) == 0): ?>
                <ul style="display: block;" id="page1"></ul>
            <?php else: ?>

                <?php
                $counter = 1;
                $c = 1;
                ?>

                <?php foreach ($siteData['pages'] as $page => $frames): ?>
                    <ul id="page<?php echo $counter; ?>" class="ui-sortable" style="display: <?php if ($counter == 1): ?>block<?php else: ?>none<?php endif; ?>;" data-pagename="<?= $page; ?>" data-siteid="<?= $siteData['site']->sites_id; ?>">
                        <?php foreach ($frames as $frame): ?>
                            <li class="element ui-draggable ui-draggable-handle" style="display: list-item; height: <?php echo $frame->frames_height; ?>px;">

                                <section id="<?php echo "ui-id-" . ($c + 10000); ?>" frameborder="0" scrolling="0" src="<?php echo site_url('sites/getframe/' . $frame->frames_id) ?>" data-height="<?php echo $frame->frames_height; ?>" data-originalurl="<?php echo $frame->frames_original_url ?>"><div class="wrap"><?php echo $frame->frames_content; ?></div></section>
                            </li>
                            <?php $c++; ?>
                        <?php endforeach; ?>
                    </ul>
                    <?php $counter++; ?>
                <?php endforeach; ?>

            <?php endif; ?>
        </div>

        <div class="start" id="start" >
            <span><?php echo $this->lang->line('canvas_empty') ?></span>
        </div>
    </div>

</div><!-- /.screen -->

<!-- Confirm page publish popup -->
<div class="modal fade small-modal" id="confirmPublish" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-title">
                Confirm Publish
            </div>
            <div class="modal-body">
                <p>Do you wish to publish your web-site?</p>
                <p class="alert alert-warning" style="padding: 15px;"><small>Note:- Without publishing, the changes are not visible!</small></p>
            </div><!-- /.modal-body -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default " data-dismiss="modal" id="deletePageCancel">Cancel & Close</button>
                <button type="button" class="btn btn-primary " id="publishConfirm">Publish</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->

</div><!-- /.modal -->