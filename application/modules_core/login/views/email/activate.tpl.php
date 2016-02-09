<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $this->config->item('site_title', 'ion_auth') ?></title>
        <meta content="utf-8" name="charset">
    </head>
    <body>
        <div  style="border: 5px solid  #C7C7C7;width:1024px;">
            <table width=100%;>
                <tr>
                    <td width=50%; style="text-align:center">
                        <a href="<?php echo site_url() ?>"><img src="<?php echo base_url(); ?>assets/img/logo.png" height="35"></a>
                    </td>
                    <td width=50%; style="text-align:center">
                        <p><b>Create Digital Identity within Minutes</b></p>
                    </td>
                </tr>
            </table>
            <table width=100%; height=20px; style="background-color:#949494">
            </table>
            <table width=100%;  style="background-color:#EDEDED; margin-top:2px">
                <tr width=100%;>
                    <td style="padding:10px 50px">
                        <p>Thank you for creating your account on <a href="<?php echo site_url(); ?>">www.jadooweb.com</a>. Now you can see the status of all your profile in the "My Account" section of the site.</p>
                        <p><?php echo anchor('login/activate/' . $id . '/' . $activation, lang('email_activate_link')); ?> and start building your profile instantly.</p>
                        <br>
                        <br>
                        <br>
                        <p>Regards,<br><a href="<?php echo site_url(); ?>">jadooweb.com</a> Team</p>
                    </td>
                </tr>
            </table>
            <table width=100%; style="background-color:#EDEDED; margin-top:2px">
                <tr width=100%;>
                    <td width=50%; style="text-align:left;padding-left: 15%;">
                        <p><b>Quick Links</b></p>
                        <p style="margin:0px;"><a href="<?php echo site_url('support') ?>">Need Help</a></p>
                        <p style="margin:0px;"><a href="<?php echo site_url('privacy') ?>">Privacy Policy</a></p>
                        <p style="margin:0px;"><a href="<?php echo site_url('terms-and-condition') ?>">Terms & Conditions</a></p>
                    </td>
                    <td width=50%; style="text-align:center">
                        <p><b>Contact Info</b></p>
                        <p style="margin:0px;">For Assistance- Chat with our team</p>
                        <a href=""><img height="30" src="<?php echo base_url(); ?>assets/img/fb.png"></a>
                        <a href=""><img height="30" src="<?php echo base_url(); ?>assets/img/google_plus.png"></a>
                    </td>
                </tr>
            </table>
            <table width=100%;>
                <tr width=100%;>
                    <td width=50%;>
                    </td>
                    <td width=50%; style="text-align:center">
                        <p>&copy; 2016  <a href="<?php echo site_url(); ?>">www.jadooweb.com</a></p>
                    </td>
                </tr>
            </table>
        </div>	
    </body>
</html>
