<div class="box box-primary no-top-border">
    <div class="box-header">
        <h4><?php echo lang('plan_header');?></h4>
    </div>
    <div class="box-body">
            <div class="box-info">
                <?php echo $message;?>
            </div>
        <table id="planreport-dataTable" class="table table-striped table-bordered  no-wrap" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Name</th>  
                    <th>Current Plan Name</th>
                    <th>Total Amount</th>
                    <th>Status</th>                    
                    <th>Last Updated ON</th>                    
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Name</th>  
                    <th>Current Plan Name</th>
                    <th>Total Amount</th>
                    <th>Status</th>                    
                    <th>Last Updated ON</th>                    
                </tr>
            </tfoot>
            <tbody>
                <?php if (!empty($plan_report)):?>
                <?php foreach ($plan_report as $report):?>
                    <tr ig="<?php echo $report->order_id;?>">
                        <td><?php echo $report->name;?></td>                        
                        <td><?php echo $report->plan_name;?></td>
                        <td><i class="fa fa-inr"></i> <?php echo round($report->total,2);?></td>    
                        <td><?php echo $report->status;?></td>   
                        <td><?php echo date('jS M, Y, g:i a',strtotime($report->last_updated));?></td>                        
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
        $("#planreport-dataTable").DataTable();
    } );
</script>


