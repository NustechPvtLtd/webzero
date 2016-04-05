
<div class="screen" id="screen">

    <div class="toolbar">

        <div class="title" id="pageTitle">
            <span><span>index</span>.html</span>
        </div>

    </div>

    <div id="frameWrapper" class="frameWrapper empty">
        <div id="pageList">
           
             <?php  if (empty($siteData)): ?>
                        <ul style="display: block;" id="page1"></ul>
            <?php else: ?>

                <?php
                $counter = 1;
                $c = 1;
                ?>

                <?php if(isset($siteData['pages'])) : 
                    foreach ($siteData['pages'] as $page => $frames): ?>
                    <ul id="page<?php echo $counter; ?>" class="ui-sortable" style="display: <?php if ($counter == 1): ?>block<?php else: ?>none<?php endif; ?>;" data-pagename="<?= $page; ?>" data-siteid="<?= $siteData['site']->template_id; ?>">
                        <?php foreach ($frames as $frame): ?>
                            <li class="element ui-draggable ui-draggable-handle" style="display: list-item; height: auto;">

                                <section id="<?php echo "ui-id-" . ($c + 10000); ?>" frameborder="0" scrolling="0" src="<?php echo site_url('sites/getframe/' . $frame->template_element_id) ?>"  data-originalurl="<?php echo $frame->template_element_id ?>"><div class="wrap"><?php echo $frame->content; ?></div></section>
                            </li>
                            <?php $c++; ?>
                        <?php endforeach; ?>
                    </ul>
                    <?php $counter++; ?>
                <?php endforeach; ?>

            <?php endif;
            endif;
              ?>
        </div>

        <div class="start" id="start" >
            <span><?php echo $this->lang->line('canvas_empty') ?></span>
        </div>
    </div>

</div><!-- /.screen -->

<!-- modal --->
<div id="myModal_temp" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Save This Template</h4>
        
      </div>
      <div class="modal-body">       
        <div class="loader" style="display: none;">
            <img src="<?php echo base_url(); ?>assets/sites/images/loading.gif" alt="Loading...">
        </div>
        <div id="myform_template_category">
            <form id="take_template" name="take_template" method="post" action="site/save_template">               
             
                <p>
                    <lable>Template Name</lable>
                    <input class="form-control" type="text" name="template_name" id="template_name" value="<?php  if(!empty($siteData)) echo $siteData['site']->template_name;?>"  <?php  if(!empty($siteData)):?> readonly="readonly" <?php endif; ?>required/>
                    <span class="help-block" id="temp_error"></span>
                </p>
                <p>
                    <lable>Category Name</lable>                    
                    <?php 
                        if(!empty($siteData)):
                            echo "<select name='cate_select' class='form-control' id='cate_select' disabled='true'>";                       
                        else:
                            echo "<select name='cate_select' class='form-control' id='cate_select'>";                       
                        endif;                        
                        echo"<option value=''>Select</option>";
                        
                        foreach($template_category as $category_data){
                            if(!empty($siteData)){
                                if($category_data->category_id==$siteData['site']->category_id)
                                    echo "<option name='category_name' selected='selected' value='$category_data->category_id'>$category_data->category_name</option>";
                                
                            }
                            else{
                                echo "<option name='category_name' value='$category_data->category_id'>$category_data->category_name</option>";
                            } 
                        }
                        echo "</select>";                          
                    ?>
                </p>
		<input type="hidden" name="img_val" id="img_val" value="" />
                <!--<input type="button" id="savetemplate"  class="btn btn-md btn-primary"  value="Save As Template"> -->
                
            </form>
        </div>
      </div>
      <div class="modal-footer" >     
          <input type="button" id="savetemplate"  class="footer_temp btn btn-md btn-primary"  value="Save Template"  >
          <button type="button" class="footer_temp btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>



