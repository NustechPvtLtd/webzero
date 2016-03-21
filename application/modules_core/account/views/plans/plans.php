<div class="box box-primary no-top-border">
    <div class="box-header">
        <h4><?php echo lang('plan_header'); ?></h4>
    </div>
    <div class="box-body">
        <div class="box-info">
            <?php echo $message; ?>
        </div>
        <table id="plans-dataTable" class="table table-striped table-bordered  no-wrap" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th><?php echo lang('plan_name'); ?></th>
                    <th><?php echo lang('plan_description'); ?></th>
                    <th><?php echo lang('plans_grp_name'); ?></th>
                    <th><?php echo lang('plan_price'); ?></th>
                    <th><?php echo lang('expiration'); ?></th>
                    <th><?php echo lang('plan_recommends'); ?></th>
                    <th><?php echo lang('plan_status'); ?></th>
                    <th><?php echo lang('visitor_count'); ?></th>
                    <th><?php echo lang('premium_domain'); ?></th>
                    <th><?php echo lang('plans_no_of_sites'); ?></th>
                    <th><?php echo lang('plan_date_added'); ?></th>
                    <th></th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th><?php echo lang('plan_name'); ?></th>
                    <th><?php echo lang('plan_description'); ?></th>
                    <th><?php echo lang('plans_grp_name'); ?></th>
                    <th><?php echo lang('plan_price'); ?></th>
                    <th><?php echo lang('expiration'); ?></th>
                    <th><?php echo lang('plan_recommends'); ?></th>
                    <th><?php echo lang('plan_status'); ?></th>
                    <th><?php echo lang('visitor_count'); ?></th>
                    <th><?php echo lang('premium_domain'); ?></th>
                    <th><?php echo lang('plans_no_of_sites'); ?></th>
                    <th><?php echo lang('plan_date_added'); ?></th>
                    <th></th>
                </tr>
            </tfoot>
            <tbody>
                <?php if (!empty($plans)): ?>
                    <?php foreach ($plans as $plan): ?>
                        <tr ig="<?php echo $plan->plan_id; ?>">
                            <td><?php echo htmlspecialchars($plan->plan_name, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><span class="plan_description"><?php echo $plan->plan_desc; ?></span></td>
                            <td><?php echo htmlspecialchars(ucfirst($plan->grp_name), ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php
                                if (abs($plan->discount)) {
                                    echo '<div style="color:rgb(17, 101, 0);border: 1px solid rgb(120, 243, 121);background-color: rgba(155, 248, 156, 0.7);padding: 1px;}"><i class="fa fa-inr"></i>';
                                    if ($plan->discount_type == 'percentage') {
                                        $promo_price = $plan->price - ($plan->price * $plan->discount / 100);
                                    } else {
                                        $promo_price = $plan->price - $plan->discount;
                                    }
                                    echo abs($promo_price) . '</div><br><del style="color:#C50000;border: 1px solid #F37878;background-color: rgba(248, 155, 155, 0.67);padding: 1px;}"><i class="fa fa-inr"></i>' . abs($plan->price) . '</del>';
                                } else {
                                    $promo_price = abs($plan->price);
                                    echo '<div style="color:rgb(17, 101, 0);border: 1px solid rgb(120, 243, 121);background-color: rgba(155, 248, 156, 0.7);padding: 1px;}">';
                                    echo ($promo_price) ? '<i class="fa fa-inr"></i>' . $promo_price : 'Free';
                                    echo '</div>';
                                }
                                ?></td>
                            <td><?php echo htmlspecialchars($plan->expiration . ' ' . $plan->expiration_type, ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?php echo anchor(NULL, ucfirst($plan->recommended), 'data-href="' . site_url("plans/recommended/" . $plan->plan_id . '/' . (($plan->recommended == 'yes') ? 'no' : 'yes')) . '" data-toggle="modal" data-target="#confirm-recom"'); ?></td>
                            <td><?php echo anchor("plans/status/" . $plan->plan_id . '/' . (($plan->status == 'active') ? 'inactive' : 'active'), ucfirst($plan->status)); ?></td>
                            <td><?php echo anchor("plans/visitor_count/" . $plan->plan_id . '/' . (($plan->visitor_count == 'active') ? 'inactive' : 'active'), ucfirst($plan->visitor_count)); ?></td>
                            <td><?php echo anchor("plans/premium_domain/" . $plan->plan_id . '/' . (($plan->premium_domain == 'active') ? 'inactive' : 'active'), ucfirst($plan->premium_domain)); ?></td>
                            <td><?php echo htmlspecialchars($plan->no_of_sites, ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?php echo date("jS M, Y", strtotime($plan->date_added)); ?></td>
                            <td><?php echo anchor('plans/update/' . $plan->plan_id, '<span class="glyphicon glyphicon-pencil"></span>'); ?><?php echo anchor('plans/delete/' . $plan->plan_id, '<span class="glyphicon glyphicon-remove"></span>') ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div class="box-footer">
        <?php echo anchor('plans/create', lang('plan_create'), array('class' => 'btn btn-primary')) ?> 
    </div>
</div>
<div class="modal fade" id="confirm-recom" tabindex="-1" role="dialog" aria-labelledby="Recommendation" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Change Recommendation</h4>
            </div>
            <div class="modal-body">
                If you change the recommendation of this plan, then previously recommended plan will not be recommended.
                <br>
                <br>
                Are you sure want to change this?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary btn-ok">Change</a>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $("#plans-dataTable").DataTable({
            ordering: true,
            "pageLength": 10,
            responsive: true
        });
        $('#confirm-recom').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
        });
    });
</script>
