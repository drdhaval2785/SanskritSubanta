<?PHP



if (!empty($_POST['Message'])) {

	$head = "{$_POST['Version']} feedback module output: \n\n========================\n\n";
	
	$msg = "";
	
	unset($_POST['source'], $_POST['src'], $_POST['tgt']);

	
	foreach ($_POST as $key => $value) {
		$value = stripslashes($value);
		$msg .= "{$key}: {$value}\r\n";
	}

	/* spam_killer.php */
	
	foreach ($_POST as $key => $value) {

		if (preg_match("#(multipart|Content-|bcc:|==)#i", $value)) {
		
			echo <<<CWS
	<div style="font: 12px Verdana; color: red;"><h1>Failed hacking attempt.</h1> Your message has elements characteristic to a hacking attempt. Your IP-address {$_SERVER['REMOTE_ADDR']} has been logged. Repeated attempts will lead to action. If you feel you have received this message in error, please contact the developer by e-mail.
	
	<b>Your message is duplicated below:</b>
	<br /><br />
	{$msg}
	</div>
CWS;
			exit;
		}


			if (preg_match("#(href|url=|http://)#i", $value)) {
		
			echo <<<CWS
	<div style="font: 12px Verdana; color: red;"><h1>Failed spamming attempt.</h1> Please do not send links to us over the contact form. Your IP-address {$_SERVER['REMOTE_ADDR']} has been logged. Repeated attempts will lead to action. If you feel you have received this message in error, please contact the developer by e-mail.
	
	<br /><br />
	<b>Your message is duplicated below:</b>
	<br /><br />
	{$msg}
	</div>
CWS;
	

			exit;
		}

	}
	
	/* Back to routine */

	

	
	$foot = "\n========================\n\nThe message was sent by a user with the IP-address {$_SERVER['REMOTE_ADDR']}\n";
	
	$headers  = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/plain; charset=utf-8\r\n";
	$headers .= "From: diCrunch <dev@codesatori.com>\r\n";
	$headers .= "Reply-to: {$_POST['Name']} <{$_POST['Email']}>\r\n";
	$headers .= "Bcc: ragadesign@gmail.com\r\n";

	if (mail("dev@codesatori.com", "diCrunch feedback module - {$_POST['Subject']}", $head . $msg . $foot, $headers)) {
		$mail_message = "<h2>Message successfully sent!</h2>\n";
		$mail_message .= "<div class=\"preferencefield\">\n";
		$mail_message .= "<div class=\"options\">" . nl2br($head . $msg . $foot) . "</div>\n</div>";
	}
	else {
		$mail_message = "<h2>Error in sending the message!</h2>\n";
		$mail_message .= "<div class=\"preferencefield\">Please copy your message from below and send it to dicrunch[AT]bhasa[DOT]net.<br /><br />\n";
		$mail_message .= "<div class=\"options\">" . nl2br($head . $msg . $foot) . "</div>\n</div>";
	}
	
		$op .= <<<CWS
<div class="wrapper">
	{$mail_message}
</div>
CWS;
	
}





$op .= <<<CWS

<div class="wrapper">
<h2>Feedback Module &nbsp; &middot; &nbsp; <a href="{$_SERVER['PHP_SELF']}">Home</a> &raquo;</h2>


<div class="preferenceheading">
<b>Contacting the Developers</b>
</div>

<div class="preferencefield">
<b>Use the feedback module</b> for sending appreciations, bug reports, feedback or questions or to the developers.
</div>

<div class="textareabg">

<b>Fill in all applicable fields.</b> To get a reply, fill in your e-mail address. With bug reports, please <i>be specific</i>.

<hr />

<form action="{$_SERVER['PHP_SELF']}?act=feedback" method="post">

<span class="formarea">Name</span> <input name="Name" size="30" />
<br /><br />

<span class="formarea">E-mail</span> <input name="Email" size="40" />
<br /><br />


<span class="formarea">Subject</span> <select name="Subject">
	<option value="General" style="background-color: #ccc; border-bottom: 1px solid #aaa;">&nbsp;&nbsp; Mail topic</option>
	<option value="Bug report">&raquo; Bug report</option>
	<option value="Donating">&raquo; Donating</option>
	<option value="Feedback">&raquo; Feedback</option>
	<option value="Question">&raquo; Question</option>
</select>

<br /><br />

<span class="formarea">Version</span> <input name="Version" readonly="readonly" size="20" style="background-color: #f5f5f5;" value="diCrunch {$version}" />

<input name="Location" type="hidden" value="{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}" />

<br /><br />

<span class="formarea">Message</span> <textarea name="Message" style="width: 90%; height: 100px; font-family: Tahoma, Verdana, sans-serif; font-size: 11px; vertical-align: top;"></textarea>

<br /><br />

<span class="formarea">&nbsp;</span> <input type="submit" value="send away" class="button" style="width: 120px;" />

</form>

</div>



CWS;


?>