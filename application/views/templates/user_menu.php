<li class=""><a href="<?php echo site_url('services'); ?>"><i class="glyphicon glyphicon-dashboard"></i> <span>Services Home</span></a></li>
<li class=""><a href="<?php echo site_url('sites') ?>"><i class="glyphicon glyphicon-file"></i> <span><?php echo (!$this->ion_auth->in_group('students'))?'Landing Pages':'Build Resume'?></span></a></li>
<?php if ($this->ion_auth->in_group('designer')): ?>
    <li><a href="<?php echo site_url('sites/templates'); ?>"><i class="glyphicon glyphicon-list"></i> <span>My Templates</span></a></li>
<?php endif; ?>
<li><a <?php echo (userdata('plan_id') != 1) ? 'href="' . site_url('visitor') . '"' : 'data-href="' . site_url('account/plans') . '" data-toggle="modal" data-target="#confirm-acc-upgrad"'; ?>><i class="glyphicon glyphicon-list-alt"></i> <span><?php echo (!$this->ion_auth->in_group('students'))?'Report':'Recruiters View'?></span></a></li>
<?php if(!$this->ion_auth->in_group('students')):?>
<li><a <?php echo (userdata('plan_id') != 1) ? 'href="' . site_url('seo') . '"' : 'data-href="' . site_url('account/plans') . '" data-toggle="modal" data-target="#confirm-acc-upgrad"'; ?>><i class="glyphicon glyphicon-share"></i> <span>SEO</span></a></li>
<?php else:?>
<li><a <?php echo (userdata('plan_id') != 1) ? 'href="' . site_url('resume-settings') . '"' : 'data-href="' . site_url('account/plans') . '" data-toggle="modal" data-target="#confirm-acc-upgrad"'; ?>><i class="glyphicon glyphicon-share"></i> <span>Become Popular</span></a></li>
<?php endif;?>
<li><a href="<?php echo site_url('account/plans'); ?>"><i class="glyphicon glyphicon-briefcase"></i> <span>Account</span></a></li>
<li><a <?php echo (userdata('plan_id') != 1) ? 'href="' . site_url('domain') . '"' : 'data-href="' . site_url('account/plans') . '" data-toggle="modal" data-target="#confirm-acc-upgrad"'; ?>><i class="glyphicon glyphicon-globe"></i> <span>Premium Domain</span></a></li>
<li><a <?php echo (userdata('plan_id') != 1) ? 'href="' . site_url('services') . '"' : 'data-href="' . site_url('account/plans') . '" data-toggle="modal" data-target="#confirm-acc-upgrad"'; ?>><i class="glyphicon glyphicon-bullhorn"></i> <span>Support</span></a></li>
<?php if ($this->ion_auth->in_group('ecommerce') && userdata('eccommerce') != 'inactive'): ?>
    <li><a href="<?php echo site_url('ecomreport'); ?>"><i class="glyphicon glyphicon-briefcase"></i> <span>Ecommerce Report</span></a></li>
<?php endif; ?>