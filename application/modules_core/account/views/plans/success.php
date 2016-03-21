<div class="box box-primary no-top-border">
    <div class="box-header">
        <h4>Payment Summary</h4>
    </div>
    <div class="box-body">
        <p>Dear <?= $name; ?></p>
        <?php if (!isset($error)) { ?>
            <p>Thank you for paying to upgrading your account. Your payment has been successfully processed. Your account account will soon be upgraded.</p>
            <table width="50%" cellspacing="0" cellpadding="0" border="0">
                <tbody>
                    <tr>
                        <td bgcolor="#ececec" height="1" colspan="6"></td>
                    </tr>
                    <tr>
                        <td valign="middle" height="31" >Your Payment Status: <?php echo $status; ?></td>
                    </tr>
                    <tr>
                        <td bgcolor="#e9e9e9" height="1" colspan="7"></td>
                    </tr>
                    <tr>
                        <td valign="middle" height="31" >Transaction ID: <strong style="color:#000000;font-weight:normal"><?php echo $txnid; ?></strong></td>
                    </tr>                            
                    <tr>
                        <td bgcolor="#e9e9e9" height="1" colspan="7"></td>
                    </tr>
                    <tr>
                        <td valign="middle" height="31" >Amount: <strong style="color:#000000;font-weight:normal"><i class="fa fa-inr"></i><?= $amount ?></strong></td>
                    </tr>
                    <tr>
                        <td bgcolor="#ececec" height="1" colspan="6"></td>
                    </tr>
                    <tr>
                        <td valign="middle" height="31" ><strong style="color:#000000;font-weight:bold"><p>This Page Will Redirect with in <span class="countdown"></span></p></strong></td>
                    </tr>
                    <tr>
                        <td bgcolor="#ececec" height="1" colspan="6"></td>
                    </tr>
                </tbody></table>
            <?php
//            $this->ion_auth->logout();
        } else {
            echo $error;
        }
        ?>
    </div>
    <div class="box-footer">
        <table width="100%" cellspacing="0" cellpadding="0" border="0">
            <tbody>
                <tr>
                    <td valign="middle" height="31" >Thank You,</td>
                </tr>
                <tr>
                    <td valign="middle" height="31" >Administration Team,</td>
                </tr>
                <tr>
                    <td valign="middle" height="31" ><a href="mailto:info@jadooweb.com">info@jadooweb.com</a></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>