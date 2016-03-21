<?php if (!empty($block_content)) { ?>
    <div class="mydiv">
        <h6>Note: You can copy your saved content from here.</h6>
        <ul class="content-block">
            <?php
            foreach ($block_content as $key => $content) {
                if ($key % 2 == 0) {
                    $class = "even";
                } else {
                    $class = "odd";
                }
                echo "<p class='datedata'>TIME: ".date('jS M, Y, g:i a',strtotime($content->timestamp))."</p>";
                echo "<li class='$class'><p class='blockbody'>" . $content->content . "</p>";
                echo '<a href="#" class="insertCtext btn btn-primary pull-right btn-xs" onClick="insertctext(this);">Insert</a>';
                echo '<a href="#" class="deleCtext btn btn-danger pull-right btn-xs" onClick="deletectext('.$content->content_id.')" >Delete</a>';
                echo "<span class='clearfix'></span>";
                echo "</li>";
            }
            ?>
        </ul>
    </div>
<?php } else{?>
<div class="mydiv alert alert-info">There is no saved content to show.</div>
<?php } ?>


<style>
    .mydiv{
        margin-left: 5px;
        margin-right: 5px;
        padding-left: 10px;
    }
    .content-block{
        padding-left: 0px;
    }
    .content-block li{
        margin-bottom: 5px;
        margin-top: 5px;
        padding:0 10px;
        list-style-type: none;
        
    }
    .blockbody{
        margin-bottom: 5px;
    }
    .odd{
        background-color: #E6EAEC;
    }
    .even{
        background-color: #f1f1f1;
    }
    .datedata{
        margin-bottom: 0px;
    }
    .mydiv .btn{
        margin:5px;
    }
</style>
