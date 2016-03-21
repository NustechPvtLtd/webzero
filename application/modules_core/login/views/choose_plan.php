<div class="container">

    <div class="row plan">
        <?php
        if (!empty($plans)) {
            foreach ($plans as $plan) {
                ?>
                <div class="col-xs-12 col-md-3 <?php echo ($plan->recommended=='yes')?'recommended':''?>">
                    <div class="panel panel-primary">
                        <?php if (abs($plan->discount)) { ?>
                            <div class="cnrflash">
                                <div class="cnrflash-inner">
                                    <span class="cnrflash-label">Offer
                                        <br>
                                        <?php
                                        if ($plan->discount_type == 'percentage') {
                                            echo htmlspecialchars(($plan->discount) ? abs($plan->discount) . '%' : '', ENT_QUOTES, 'UTF-8') . ' Off';
                                        } else {
                                            echo 'Flat <i class="fa fa-inr"></i>' . htmlspecialchars(($plan->discount) ? abs($plan->discount) : '', ENT_QUOTES, 'UTF-8') . ' Off';
                                        }
                                        ?></span>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="panel-heading">
                            <h3 class="panel-title"><?php echo $plan->plan_name; ?></h3>
                        </div>
                        <div class="panel-body">
                            <table class="table">
                                <tbody>
                                    <tr class="the-price">
                                        <td>
                                            <?php
                                            if (abs($plan->discount)) {
                                                echo '<i class="fa fa-inr"></i> ';
                                                if ($plan->discount_type == 'percentage') {
                                                    $promo_price = $plan->price - ($plan->price * $plan->discount / 100);
                                                } else {
                                                    $promo_price = $plan->price - $plan->discount;
                                                }
                                                echo abs($promo_price) . ' <del style="color:#C50000;border: 1px solid #F37878;background-color: rgba(248, 155, 155, 0.67);padding: 5px;}"><i class="fa fa-inr"></i> ' . abs($plan->price) . '</del>';
                                            } else {
                                                $promo_price = abs($plan->price);
                                                echo ($promo_price)? '<i class="fa fa-inr"></i>'.$promo_price:'Free';
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <tr class="active">
                                        <td>
                                            <?php echo $plan->plan_desc; ?>
                                        </td>
                                    </tr>
                                    <tr class="active">
                                        <td>
                                            <?php echo lang('visitor_count') . ': ' . (($plan->visitor_count=='active')?'Yes':'No'); ?>
                                        </td>
                                    </tr>
                                    <?php if($plan->plan_id!=1):?>
                                                <tr class="active">
                                                    <td>
        <?php echo lang('premium_domain') . ': ' . (($plan->premium_domain=='active')?'Yes':'No'); ?>
                                                    </td>
                                                </tr>
                                                <?php endif;?>
                                    <tr class="active">
                                        <td>
                                            Validity: <?php echo $plan->expiration . ' ' . $plan->expiration_type; ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="hide_form">
                                <form action="<?php echo site_url('update-plan'); ?>" id="upgrade_plan_<?php echo $plan->plan_name; ?>" method="POST">
                                    <input name="plan_name" value="<?php echo $plan->plan_name; ?>" type="hidden" />
                                    <input name="plan_id" value="<?php echo $plan->plan_id; ?>" type="hidden" />
                                    <input name="plan_price" value="<?php echo ($promo_price) ? abs($promo_price) : abs($plan->price); ?>" type="hidden" />
                                    <input name="plan_discount" value="<?php echo ($plan->discount_type == 'percentage') ? abs($plan->price * $plan->discount / 100) : abs($plan->discount); ?>" type="hidden" />
                                    <input name="plan_ammount" value="<?php echo abs($plan->price); ?>" type="hidden" />
                                    <input name="user_id" value="<?php echo $user->user_id; ?>" type="hidden" />
                                </form>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <?php if ($user->price_plan_id === $plan->plan_id) { ?>
                                <a role="button" class="btn btn-primary" href="javascript:void(0)" onclick="javascript:upgrade('<?= $plan->plan_name; ?>')">Continue with This Plan</a>
                            <?php } else { ?>
                                <a role="button" class="btn btn-primary" onclick="javascript:upgrade('<?= $plan->plan_name; ?>')" href="javascript:void(0)" style="cursor: default;">Upgrade to <?= $plan->plan_name; ?></a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php
            }
        } else {
            ?>
            <div id="notify-container" style="margin-left: 15px;">There is no plans to view!</div>
<?php } ?>

    </div>
</div>
<script>
    function upgrade(plan_name) {
        $("#upgrade_plan_" + plan_name).submit();
    }
</script>