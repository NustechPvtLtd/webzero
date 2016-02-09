<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $this->config->item('site_title', 'ion_auth') ?></title>
        <meta content="utf-8" name="charset">
    </head>
    <body>
        <div  style="border: 5px solid  #79BE0B;width:1024px;">
            <table width=100%;>
                <tr width=100%;>
                    <td width=50%; style="text-align:left">
                        <a href="<?php echo site_url() ?>"><img src="<?php echo base_url(); ?>assets/img/logo.png" height="35" style="border:none"></a>
                    </td>
                </tr>
            </table>
            <table width=100%; height=20px; style="background-color:#8CC73D">
                <tr><td>&nbsp;</td></tr>
            </table>
            <table width=100%;  style="margin-top:2px">
                <tr width=100%;>
                    <td style="padding:10px 50px">
                        <p><b>Greetings from <a href="<?php echo site_url(); ?>">www.jadooweb.com</a> team !</b></p>
                        <br>
                        <p>We have invited you to be among the selected users of our platform <a href="<?php echo site_url(); ?>">www.jadooweb.com</a> before release.</p>
                        <p>Please note, when you login for the first time you will be given 3 options to choose, either to create an <b><u>Interactive Personal Profile</u></b> or <b><u>Create a Website</u></b> or an <b><u>Ecommerce Website</u></b>.</p>
                        <p>Please make sure that you select the best and most suitable option, this action cannot be recalled once you have selected.</p>
                        <p>Use the details to access your account at <a href="<?php echo site_url(); ?>">JADOOWEB</a></p>
                        <table>
                            <tr><td>Link:</td><td><a href="<?php echo site_url(); ?>">Click here to Log-in</a></td></tr>
                            <tr><td>Username:</td><td><?php echo $username; ?></td></tr>
                            <tr><td>Password:</td><td><?php echo $password; ?></td></tr>
                        </table>
                        <br>
                        <p>If you have any question, please email the system administrator to assist further at <a href="mailto:support@jadooweb.com">support@jadooweb.com</a></p>
                        <br>
                        <br>
                        <p>Thank you and we look forward serving you.</p>
                        <p>Sincerely,<br><a href="<?php echo site_url(); ?>">JADOOWEB</a></p>
                    </td>
                </tr>
            </table>
            <hr style="border: 2px solid  #79BE0B;">
            <table width=100%; style="margin-top:2px">
                <tr width=100%;>
                    <td width=50%; style="text-align:left;padding-left: 15%;">
                        <p><b>Quick Links</b></p>
                        <p style="margin:0px;"><a href="">Need Help</a></p>
                        <p style="margin:0px;"><a href="">Privacy Policy</a></p>
                        <p style="margin:0px;"><a href="">Terms & Conditions</a></p>
                    </td>
                    <td width=50%; style="text-align:center">
                        <p><b>Contact Info</b></p>
                        <p style="margin:0px;">For Assistance- Chat with our team</p>
                        <a href=""><img height="30" src="<?php echo base_url(); ?>assets/img/fb.png" style="border:none"></a>
                        <a href=""><img height="30" src="<?php echo base_url(); ?>assets/img/google_plus.png" style="border:none"></a>
                    </td>
                </tr>
            </table>
            <table width=100%;>
                <tr width=100%;>
                    <td width=100%; style="text-align:center">
                        <p>&copy; 2016  <a href="<?php echo site_url(); ?>">www.jadooweb.com</a></p>
                    </td>
                </tr>
            </table>
        </div>	
    </body>
</html>
