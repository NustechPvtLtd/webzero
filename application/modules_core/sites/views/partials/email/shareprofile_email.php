<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body bgcolor="#8d8e90">
<h5><strong>Hi,</strong></h5>
<?PHP if(isset($sitedata->remote_url)) {?>
<p style="">
		Please find my profile from this URL: <a href="<?PHP echo $sitedata->remote_url; ?>" target="_blank"><b><?PHP echo $sitedata->remote_url; ?></b></a>
</p>
<?PHP  } ?>
<?PHP if($sitedata->has_password=="1") {?> 
<p style="">
		To open please use the password
	<b>:<?PHP echo isset($sitedata->site_password)?$sitedata->site_password:"";?></b>
</p>
<?PHP  } ?>
<p style="">
		Looking forward to your reply.
</p>
<p style="">
	Thank you
</p>
<p style="margin-top: 25px;">
		Best Regards,
	<br/>
		<?PHP if(isset($userdata->first_name) && !empty($userdata->first_name) || isset($userdata->last_name) && !empty($userdata->last_name) ) { ?>
		<?PHP echo $userdata->first_name." ".$userdata->last_name; ?>
		<?PHP } ?>
	<br/><b>
	<?PHP if(isset($userdata->email) && !empty($userdata->email)) { ?>
		E: 
	<a href="mailto:<?PHP echo $userdata->email;?>" target="_blank"><?PHP echo $userdata->email;?></a>
	<?PHP } ?>
	<br>
	<?PHP if(isset($userdata->phone) && !empty($userdata->phone)) { ?>
		Tel: 
	<a href="tel:<?PHP echo $userdata->phone;?>" target="_blank"><?PHP echo $userdata->phone;?></a>
	<?PHP } ?>
	</b>
</p>
<!--
<p style="font-size: 12px; color: red;">
		Note: This password is valid for 48 hrs from the time time you receive this email.
</p>

<table style="margin:0px !important" align="center" bgcolor="#FFFFFF" border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody>
<tr>
	<td style="border: medium none;padding: 0 !important; vertical-align: inherit;">
		<img style="display:block;width:100%" alt="" rel="display:block;width:100%" src="http://resume.dev/assets/email/images/PROMO-GREEN2_07.jpg" border="0" height="7">
	</td>
</tr>
<tr>
	<td style="border: medium none;padding: 0 !important; vertical-align: inherit;">
		<br>
		<table style="margin:0px !important" border="0" cellpadding="0" cellspacing="0" width="100%">
		<tbody>
		<tr>
			<td style="border: medium none;vertical-align: inherit;" align="center" width="5%">
			</td>
			<td style="border: medium none;vertical-align: inherit;" align="center" width="14%">
				<span rel="font-family:'Myriad Pro', Helvetica, Arial, sans-serif; color:#010203; font-size:9px; text-transform:uppercase" style="font-family:'Myriad Pro', Helvetica, Arial, sans-serif; color:#010203; font-size:9px; text-transform:uppercase"><a href="http://yourlink"><strong>UNSUBSCRIBE </strong></a></span>
			</td>
			<td style="border: medium none;vertical-align: inherit;" align="center" width="2%">
				<span rel="font-family:'Myriad Pro', Helvetica, Arial, sans-serif; color:#010203; font-size:9px; text-transform:uppercase" style="font-family:'Myriad Pro', Helvetica, Arial, sans-serif; color:#010203; font-size:9px; text-transform:uppercase"><strong>|</strong></span>
			</td>
			<td style="border: medium none;vertical-align: inherit;" align="center" width="9%">
				<span rel="font-family:'Myriad Pro', Helvetica, Arial, sans-serif; color:#010203; font-size:9px; text-transform:uppercase" style="font-family:'Myriad Pro', Helvetica, Arial, sans-serif; color:#010203; font-size:9px; text-transform:uppercase"><a href="http://yourlink"><strong>ABOUT </strong></a></span>
			</td>
			<td style="border: medium none;vertical-align: inherit;" align="center" width="2%">
				<span rel="font-family:'Myriad Pro', Helvetica, Arial, sans-serif; color:#010203; font-size:9px; text-transform:uppercase" style="font-family:'Myriad Pro', Helvetica, Arial, sans-serif; color:#010203; font-size:9px; text-transform:uppercase"><strong>|</strong></span>
			</td>
			<td style="border: medium none;vertical-align: inherit;" align="center" width="10%">
				<span rel="font-family:'Myriad Pro', Helvetica, Arial, sans-serif; color:#010203; font-size:9px; text-transform:uppercase" style="font-family:'Myriad Pro', Helvetica, Arial, sans-serif; color:#010203; font-size:9px; text-transform:uppercase"><a href="http://yourlink"><strong>PRESS </strong></a></span>
			</td>
			<td style="border: medium none;vertical-align: inherit;" align="center" width="2%">
				<span rel="font-family:'Myriad Pro', Helvetica, Arial, sans-serif; color:#010203; font-size:9px; text-transform:uppercase" style="font-family:'Myriad Pro', Helvetica, Arial, sans-serif; color:#010203; font-size:9px; text-transform:uppercase"><strong>|</strong></span>
			</td>
			<td style="border: medium none;vertical-align: inherit;" align="center" width="11%">
				<span rel="font-family:'Myriad Pro', Helvetica, Arial, sans-serif; color:#010203; font-size:9px; text-transform:uppercase" style="font-family:'Myriad Pro', Helvetica, Arial, sans-serif; color:#010203; font-size:9px; text-transform:uppercase"><a href="http://yourlink"><strong>CONTACT </strong></a></span>
			</td>
			<td style="border: medium none;vertical-align: inherit;" align="center" width="2%">
				<span rel="font-family:'Myriad Pro', Helvetica, Arial, sans-serif; color:#010203; font-size:9px; text-transform:uppercase" style="font-family:'Myriad Pro', Helvetica, Arial, sans-serif; color:#010203; font-size:9px; text-transform:uppercase"><strong>|</strong></span>
			</td>
			<td style="border: medium none;vertical-align: inherit;" align="right" width="4%">
				<a target="_blank" href="https://www.facebook.com/"><img alt="facebook" src="http://resume.dev/assets/email/images/PROMO-GREEN2_09_01.jpg" border="0" height="19" width="22"></a>
			</td>
			<td style="border: medium none;vertical-align: inherit;" align="center" width="4%">
				<a target="_blank" href="https://twitter.com/"><img alt="twitter" src="http://resume.dev/assets/email/images/PROMO-GREEN2_09_02.jpg" border="0" height="19" width="23"></a>
			</td>
			<td style="border: medium none;vertical-align: inherit;" align="left" width="4%">
				<a target="_blank" href="http://www.linkedin.com/"><img alt="linkedin" src="http://resume.dev/assets/email/images/PROMO-GREEN2_09_03.jpg" border="0" height="19" width="20"></a>
			</td>
			<td style="border: medium none;vertical-align: inherit;" width="5%">
			</td>
		</tr>
		</tbody>
		</table>
	</td>
</tr>
<tr>
	<td style="border: medium none;padding: 0 !important; vertical-align: inherit;" align="center">
		<span rel="font-family:'Myriad Pro', Helvetica, Arial, sans-serif; color:#231f20; font-size:8px" style="font-family:'Myriad Pro', Helvetica, Arial, sans-serif; color:#231f20; font-size:8px"><strong>Head Office &amp; Registered Office | Company name Ltd, Adress Line, Company Street, City, State, Zip Code | Tel: 123 555 555 <br>
		<a href="http://yourlink">customercare@company.com</a></strong></span>
	</td>
</tr>
<tr>
	<td style="border: medium none;padding: 0 !important; vertical-align: inherit;">
	</td>
</tr>
</tbody>
</table>
!-->
</table>
</body>
</html>