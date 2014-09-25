<?PHP


$op .= <<<CWS

<div class="wrapper">
<h2>Help &nbsp; &middot; &nbsp; <a href="{$_SERVER['PHP_SELF']}">Home</a> &raquo;</h2>




<div class="preferenceheading">
<b>"Help me please!"</b> or "I spotted a bug!" or "I'd like to send feedback"...
</div>
<div class="preferencefield">
Please use the <b><a href="{$_SERVER['PHP_SELF']}?act=feedback">Feedback Module</a></b> or e-mail to <script type="text/javascript">document.write('dev'+'@c'+'odes'+'atori.c'+'om');</script> if you can't find your answers here. 
</div>

<hr />



<div class="preferenceheading">
<b>What is diCrunch?</b> What can I use it for?
</div>
<div class="preferencefield">
<b>diCrunch is a conversion tool for most Indic diacritic systems and several Indic scripts</b>, listed below in more detail. You can use diCrunch to convert transliterated Sanskrit, Pali, Bengali, Hindi, etc. into Indic script, to convert text between different transliteration schemes, to convert one Indic script to another, and to convert Indic script to a romanized transliteration scheme of your choice.
</div>

<hr />

<a name="donate"></a>
<div class="preferenceheading">
"<b>I love this tool</b>, I use it every day! Can I give a donation?"
</div>
<div class="preferencefield">
<b>Yes please</b>, the gesture would be appreciated. Heaps of time and brainpower have gone into the development of this free open-source utility. 

<script type="text/javascript">document.write('<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&amp;business=dev'+'%40codesatori' + '%2' + 'eco' + 'm' + '&amp;item_name=diCrunch&amp;item_number=109&amp;no_shipping=2&amp;no_note=1&amp;tax=0&amp;' + 'currency_code=EUR&amp;bn=PP%2dDonationsBF&amp;charset=UTF%2d8" target="_blank">');</script><b>Click to donate with PayPal!</b></a>

</div>

<hr />


<div class="preferenceheading">
<b>License, downloading, installation, changelog.</b>
</div>
<div class="preferencefield">
<b>diCrunch is open-source and licensed</b> under GNU General Public License. You can read the license <a href="{$_SERVER['PHP_SELF']}?act=license">here</a>. 

<ul>
	<li><b>To download the tool</b>: <a href="http://www.codewallah.com/diCrunch/diCrunch.zip">diCrunch.zip</a> ({$download_size} KB)</li>
	<li><b>To read the changelog</b>: <a href="{$_SERVER['PHP_SELF']}?act=changelog">Click here</a></li>
</ul>

<b>If you want to install the application</b> for yourself, just upload it to any webserver with PHP support and point your browser to it. If you intend to put diCrunch to heavy regular use, please install your own copy instead of stressing our servers.

</div>

<hr />

<div class="preferenceheading">
<b>What fonts should I use</b> with diCrunch to display everything properly?
</div>
<div class="preferencefield">
<b>The default font</b> for the diCrunch text processing field is <a href="http://www.code2000.net/" target="_blank">CODE2000</a>, a shareware Unicode font containing all IAST diacritics and main Indic scripts in a single file. There are a number of Unicode fonts that support the diacritics necessary for Sanskrit transliteration &mdash; there's a <a href="http://www.pratyatosa.com/SanskritDiacriticTextConversion.htm" target="_blank">good list here</a>, and <a href="http://www.google.com/search?q=sanskrit+diacritics+unicode" target="_blank">Google helps</a> with the rest.
</div>

<hr />

<div class="preferenceheading">
<b>What are all these conversion options?</b> Read on about Devanagari transliteration and available transliteration schemes and Indic scripts.
</div>

<div class="preferencefield">
<b>Important Note</b>: Roman text will only be accurately converted if the appropriate diacritic marks are included. Read up on <a href="http://en.wikipedia.org/wiki/Devanagari_transliteration" target="_blank">Devanagari Transliteration</a>. Where in doubt, check in with someone who can read the script before tattooing it across your forehead to avoid embarrasments.

<hr />


CWS;

foreach ($convs as $key => $value) {
	$op .= "<b>{$value}</b>: {$legends[$key]}<br />\n";
}

$op .= <<<CWS

</div>

<hr />

<div class="preferenceheading">
<b>What file types</b> can I upload for conversion? Are they stored somewhere?
</div>
<div class="preferencefield">
<b>The following file extensions</b> are permitted for uploaded files: <b>{$exts}</b>. Uploaded files are <b>not stored</b> on our server &ndash; they are uploaded into a temporary folder and purged as the conversion completes.
</div>

<hr />

<div class="preferenceheading">
<b>Preferences</b> don't seem to get saved.
</div>
<div class="preferencefield">
Preferences are stored using <a href="http://en.wikipedia.org/wiki/HTTP_cookie" target="_blank">cookies</a> &mdash; make sure your browser's privacy settings allow websites to set cookies.
</div>






</div>

CWS;


?>