<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $this->config->item('site_title', 'ion_auth') ?></title>
        <meta content="utf-8" name="charset">
    </head>
    <body>
        <div style="border: 5px solid  #79BE0B;">
            <div style="width:100%">
                <div style="width:49%;text-align:left;display:inline-block;height:35px;padding: 5px;"><a href="<?php echo site_url() ?>" style="height:100%"><img src="<?php echo base_url(); ?>assets/img/logo.png" height="100%" style="border:none;"></a></div>
                <div style="width:49%;text-align:right;display:inline-block;height:35px"><p><b>Create Digital Identity within Minutes</b></p></div>
            </div>
            <hr style="border: 10px solid  #79BE0B;margin:0;">
			<div style="padding: 10px 50px;">
				<p>Thank you for creating your account on <a href="<?php echo site_url(); ?>">www.jadooweb.com</a>. Now you can see the status of all your profile in the "My Account" section of the site.</p>
                <p>Use the following details to login at <a href="<?php echo site_url(); ?>">www.jadooweb.com</a></p>
                <ul>
                    <li style="list-style:none;">
                        <ul>
                            <li style="display:inline-block;list-style:none;">Username:</li>
                            <li style="display:inline-block;list-style:none;"><?php echo $username; ?></li>
                        </ul>
                    </li> 
                    <li style="list-style:none;">
                        <ul>
                            <li style="display:inline-block;list-style:none;">Password:</li>
                            <li style="display:inline-block;list-style:none;"><?php echo $password; ?></li>
                        </ul>
                    </li> 
                </ul>
				<br>
				<p>If you have any question, please email the system administrator to assist further at <a href="mailto:support@jadooweb.com">support@jadooweb.com</a></p>
				<br>
				<br>
				<p>Thank you and we look forward serving you.</p>
				<p>Sincerely,<br><a href="<?php echo site_url(); ?>">www.jadooweb.com</a></p>
			</div>
			<div style="border-top: 5px solid  #79BE0B; text-align: center;">
				<div style="display: inline-block; width: 49%;">
					<p><b>Quick Links</b></p>
					<p style="margin:0px;"><a href="">Need Help</a></p>
					<p style="margin:0px;"><a href="">Privacy Policy</a></p>
					<p style="margin:0px;"><a href="">Terms & Conditions</a></p>
				</div>
				<div style="display: inline-block; width: 49%; height:104px;">
					<p><b>Contact Info</b></p>
					<p style="margin:0px;">For Assistance- Chat with our team</p>
					<a href=""><img height="30" src="<?php echo base_url(); ?>assets/img/fb.png" style="border:none"></a>
					<a href=""><img height="30" src="<?php echo base_url(); ?>assets/img/google_plus.png" style="border:none"></a>
					
				</div>
				<div style="text-align: center;">
					<p>&copy; 2016  <a href="<?php echo site_url(); ?>">www.jadooweb.com</a></p>
				</div>
			</div>
        </div>	
    </body>
</html>
