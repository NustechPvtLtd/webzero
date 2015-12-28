<div class="screen" id="screen">

    <div class="toolbar">

        <div class="buttons clearfix">
            <span class="left"></span>
            <span class="left"></span>
            <span class="left"></span>
        </div>

        <div class="title" id="pageTitle">
            <span><span>index</span>.html</span>
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
                                <!--<iframe id="<?php echo "ui-id-" . ($c + 10000); ?>" frameborder="0" scrolling="0" src="<?php echo site_url('sites/getframe/' . $frame->frames_id) ?>" data-height="<?php echo $frame->frames_height; ?>" data-originalurl="<?php echo $frame->frames_original_url ?>"></iframe>-->
                                <section id="<?php echo "ui-id-" . ($c + 10000); ?>" frameborder="0" scrolling="0" src="<?php echo site_url('sites/getframe/' . $frame->frames_id) ?>" data-height="<?php echo $frame->frames_height; ?>" data-originalurl="<?php echo $frame->frames_original_url ?>"><?php echo $frame->frames_content; ?></section>
                            </li>
                            <?php $c++; ?>
                        <?php endforeach; ?>
                    </ul>
                    <?php $counter++; ?>
                <?php endforeach; ?>

            <?php endif; ?>
        </div>

        <div class="start" id="start" <?php if (isset($siteData['pages']) && count($siteData['pages']) > 0): ?>style="display:none"<?php endif; ?>>
            <span><?php echo $this->lang->line('canvas_empty') ?></span>
        </div>
    </div>

</div><!-- /.screen -->