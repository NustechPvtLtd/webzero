<div class="screen" id="screen">

    <div class="toolbar">

        <div class="title" id="pageTitle">
            <span><span>index</span>.html</span>
        </div>

    </div>

    <div id="frameWrapper" class="frameWrapper empty">
        <div id="pageList">
            
            <ul style="display: block;" id="page1"></ul>
            
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
                    <input class="form-control" type="text" name="template_name" id="template_name" required/>
                    <span class="help-block" id="temp_error"></span>
                </p>
                <p>
                    <lable>Category Name</lable>                    
                    <?php 
                        echo "<select name='cate_select' class='form-control' id='cate_select'>";
                        echo"<option value=''>Select</option>";
                        foreach($template_category as $category_data){
                            echo "<option name='category_name' value='$category_data->category_id'>$category_data->category_name</option>";
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



