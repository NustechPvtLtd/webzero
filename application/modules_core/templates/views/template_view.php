<div class="box box-primary no-top-border">
    <div class="box-header">
        <h4><?php echo lang('plan_header');?></h4>
    </div>
    <div class="box-body">
            <div class="box-info">
                <?php echo $message;?>
            </div>
        <table id="templates-dataTable" class="table table-striped table-bordered  no-wrap" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Name</th>  
                    <th>Template</th>
                    <th>Category</th>
                    <th>Visibility Mode</th>                    
                    <th>Created Time</th>
                    <th>Preview</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Name</th>                                  
                    <th>Template</th>
                    <th>Category</th>
                    <th>Visibility Mode</th>                  
                    <th>Created Time</th>
                    <th>Preview</th>
                </tr>
            </tfoot>
            <tbody>
                <?php if (!empty($templates)):?>
                <?php foreach ($templates as $template):?>
                    <tr ig="<?php echo $template->template_id;?>">
                        <td><?php echo htmlspecialchars($template->name,ENT_QUOTES,'UTF-8');?></td>                        
                        <td><?php echo $template->template_name;?></td>
                        <td><?php echo htmlspecialchars($template->category_name,ENT_QUOTES,'UTF-8');?></td>
                        <td><?php echo anchor("templates/change_visibility/".$template->template_id.'/'.(($template->visibility=='1')?'hide':'show'), ($template->visibility==0) ? "No":  "Yes"  , "class = 'template_visbility'") ;?>
                        </td>      
                       
                        <td><?php echo date('jS M, Y, g:i a',strtotime($template->created_time));?></td>
                        <td><?php echo anchor("templates/preview/".$template->profile.'/'.$this->encrypt->encode($template->template_id),"Preview","class='btn btn-xs btn-default ', target='_blank'");?></td>
                    </tr>
                <?php endforeach;?>
                <?php endif;?>
            </tbody>
        </table>
    </div>
    <div class="box-footer">
       <?php //echo anchor('plans/create', lang('plan_create'), array('class' => 'btn btn-primary'))?> 
    </div>
</div>
<script>
    $(document).ready( function () {
        $("#templates-dataTable").DataTable({
            ordering: true,
            "pageLength": 10,
            responsive: true,
            "aoColumnDefs": [
          { 'bSortable': false, 'aTargets': [ 3, 5] }
       ]
        });
    } );
</script>
