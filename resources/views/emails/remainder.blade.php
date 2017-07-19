<!DOCTYPE html>
<html lang=&quot;en-US&quot;>
<head>
<meta charset=&quot;utf-8&quot;>
<link href="https://fonts.googleapis.com/css?family=Oleo+Script|Quicksand" rel="stylesheet">
</head>
<body style="font-family:Quicksand !important">
<div style="background:#f9f9f9;color:#373737;font-size:17px;line-height:24px;max-width:100%;width:100%!important;margin:0 auto;padding:0">
<table style="border-collapse:collapse;line-height:24px;margin:0;padding:0;width:100%;font-size:17px;color:#373737;background:#f9f9f9" width="100%" cellspacing="0" cellpadding="0" border="0">
<tbody><tr>
<td style="border-collapse:collapse" valign="top">
<table style="border-collapse:collapse" width="100%" cellspacing="0" cellpadding="0" border="0"><tbody><tr>
<td style="border-collapse:collapse;padding:20px 16px 12px" valign="bottom">
<div style="text-align:center">
<a href="https://www.slack.com" style="color:#3f51b5;font-weight:bold;text-decoration:none;word-break:break-word" target="_blank" >
<img src="{{ url("assets/images/logo.png") }}" style="outline:none;text-decoration:none;border:none"  width="50" >
<br><label style="font-family:Oleo Script !important;font-size:35px"><?php echo site_name(); ?></label>
</a>
</div>
</td>
</tr>
</tbody></table></td></tr>
<tr>
<td style="border-collapse:collapse" valign="top">	
<table style="border-collapse:collapse;background:white;border-radius:0.5rem;margin-bottom:1rem" cellspacing="0" cellpadding="32" border="0" align="center"><tbody><tr><td style="border-collapse:collapse" width="546" valign="top">
	<div style="max-width:600px;margin:0 auto">
	<p style="font-size:17px;line-height:24px;margin:0 0 16px;text-align:center">
		<img src="{{ url("assets/images/emails/forgot-password.png") }}" style="outline:none;text-decoration:none;width:76px"  width="76" height="76"></p>
<h2 style="color:#3a3b3c;line-height:30px;margin-bottom:12px;margin:0 auto 0.75rem;font-size:1.8rem;text-align:center">
Reset Your Password</h2>
<p style="font-size:17px;line-height:24px;margin:0 0 16px">
<b>Hi {{ $name }},</b><br><br>
You recently requested to reset your password for your <?php echo site_name(); ?> account. Click the button below to reset it.
</p>
<center><a href="{{ $reset_url }}" role="button" style=" background-color: #3f51b5;
    color: #fff;
    padding: 10px;
	border-radius: 2px;
    border-width: 0;
    box-shadow: 0 1px 4px rgba(0, 0, 0, 0.6);
    outline: medium none;
    overflow: hidden;
    background-color: #3f51b5;
    border-color: currentcolor currentcolor #3160b6;
    border-width: 0 0 2px;
    cursor: pointer;
    font-size: 16px;
    letter-spacing: 1px;
    line-height: 20px;
    text-decoration:none;
    font-weight:bold;
    ">Reset Your Password</a></center>
<br><p style="font-size:17px;line-height:24px;margin:0 0 16px">
If you did not request a password reset, please ignore this email or reply to let us know. This password reset is only valid
 for the next 30 minutes.

</p>

<p style="font-size:17px;line-height:24px;margin:0 0 16px">
Thanks,<br>
<?php echo site_name(); ?> Team
</p>

	</div>
	</td>
	</tr></tbody></table><table style="border-collapse:collapse;background:white;border-radius:0.5rem;margin-bottom:1rem" cellspacing="0" cellpadding="32" border="0" align="center"><tbody><tr>
<td style="border-collapse:collapse" width="546" valign="top">
		<div style="max-width:600px;margin:0 auto">
<p style="font-size:17px;line-height:24px;margin:0 0 16px">
We also love hearing from you and helping you with any issues you have. Please reply to this email if you want to ask
a question or just say hi.
</p>

		</div>
		</td>
		</tr></tbody></table>
		<table style="border-collapse:collapse;background:white;border-radius:0.5rem;margin-bottom:1rem" cellspacing="0" cellpadding="32" border="0" align="center"><tbody><tr>
			<td style="border-collapse:collapse" width="546" valign="top">
	<div style="max-width:600px;margin:0 auto">
	<p style="font-size:17px;line-height:24px;margin:0 0 16px">
If you're having trouble clicking the password reset button, copy and paste the URL below into your browser.
<br>
<a href="{{ $reset_url }}">{{ $reset_url }}</a>
</p>

</div>
</td>
</tr></tbody></table></td>
</tr><tr><td style="border-collapse:collapse">
<table style="border-collapse:collapse;margin-top:1rem;background:white;color:#989ea6" width="100%" cellspacing="0" cellpadding="0" border="0" align="center"><tbody><tr>
	<td style="border-collapse:collapse;height:5px;background-image:url(' {{url("assets/images/emails/ll.png")}} ');background-repeat:repeat-x;background-size:auto 5px"></td>
</tr><tr><td style="border-collapse:collapse;padding:16px 8px 24px" valign="top" align="center">
<div style="max-width:600px;margin:0 auto">
<p style="font-size:12px;line-height:20px;margin:0 0 16px;margin-top:16px">	<span style="max-width:380px;display:block">
			This email is sent to Team Owners and Admins of active teams.
			</span>
</p>
<p style="font-size:12px;line-height:20px;margin:0 0 16px;margin-top:16px">

Made by <a href=" {{ url("/") }} " style="color:#439fe0;font-weight:bold;text-decoration:none;word-break:break-word" target="_blank" ><?php echo site_name(); ?></a>
&nbsp;•&nbsp;
</p>
</div>
</td>
</tr></tbody></table></td>
</tr></tbody></table></div><div class="yj6qo"></div><div class="adL">

</div></div></div>
</body>
</html>