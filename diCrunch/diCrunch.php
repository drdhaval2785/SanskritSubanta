<?PHP

/*
#####################################################################
## diCrunch - Indic language diacritic and script converter
 ## Copyright (C) 2006-2008 Ananda Loponen
## Online at http://wiki.gaudiyakutir.com/gkWiki:DiCrunch 
 ## Send bug reports and inquiries to ananda[DOT]loponen[AT]gmail[DOT]com
########################################################################

The gkWiki:diCrunch engine is released under GNU General Public License. This document contains a human-readable summary of the full GPL text along with the full GPL text.

A summary of the license is also available online at http://creativecommons.org/licenses/GPL/2.0/. The full GPL text is available online at http://www.gnu.org/copyleft/gpl.html.

Please read the diCrunch_license.txt file for the full texts.

*/



include "./diCrunch/diCrunch_config.php";
include "./diCrunch/diCrunch_functions.php";


$version = "v2.0.1";
$download_size = 35;


/* Permitted file list */


$exts = implode(", ", $permitted_files);
$exts = strtoupper($exts);




/* Some preference and option variables */

$more = "none";
$checked = " checked=\"checked\"";


/* Get user preferences */

if (!empty($_COOKIE['diCrunch_config'])) {
	$pref = explode("|||", $_COOKIE['diCrunch_config']);
	
	$textarea = "";
	if (!empty($pref[3])) {
		$textarea .= "font-family: {$pref[3]};";
	}
	if (!empty($pref[11])) {
		$textarea .= "font-size: {$pref[11]};";
	}
	if (!empty($pref[4])) {
		$textarea .= "width: {$pref[4]}; ";
	}
	if (!empty($pref[5])) {
		$textarea .= "height: {$pref[5]};";
	}
}
else {
	$pref[0] = "unicode";
	$pref[1] = "devanagari";
	$pref[2] = "";
	$pref[3] = "";
	$pref[4] = "";
	$pref[5] = "";
	$pref[6] = "";
	$pref[7] = "";
	$pref[8] = "";
	$pref[9] = "";
	$pref[10] = "";
	$pref[11] = "";
	$pref[12] = "";
	$pref[13] = "";
	$pref[14] = "";
	$textarea = "";
}
if (empty($pref[0])) {
	$pref[0] = "hk";
}
if (empty($pref[1])) {
	$pref[1] = "unicode";
}

/* Some more preference settings for checkboxes */

$fileoutput_sel = "";
$vtob_sel = "";
$removedot_sel = "";
$swapy_sel = "";
$splitbox_sel = "";
$mstyle_sel = "";


if (!empty($_POST['fileoutput']) || (empty($_POST['convert']) && empty($_POST['fileoutput']) && $pref[6] == 1)) {
	$fileoutput_sel = $checked;
}

if (!empty($_POST['vtob']) || (empty($_POST['convert']) && empty($_POST['vtob']) && $pref[7] == 1)) {
	$vtob_sel = $checked;
	$more = "block";
}

if (!empty($_POST['removedot']) || (empty($_POST['convert']) && empty($_POST['removedot']) && $pref[8] == 1)) {
	$removedot_sel = $checked;
	$more = "block";
}

if (!empty($_POST['swapy']) || (empty($_POST['convert']) && empty($_POST['swapy']) && $pref[9] == 1)) {
	$swapy_sel = $checked;
	$more = "block";
}

if (!empty($_POST['splitbox']) || (empty($_POST['convert']) && empty($_POST['splitbox']) && $pref[10] == 1)) {
	$splitbox_sel = $checked;
	//$more = "block";
}

if (!empty($_POST['mstyle']) || (empty($_POST['convert']) && empty($_POST['mstyle']) && $pref[14] == 1)) {
	$mstyle_sel = $checked;
	$more = "block";
}

$search_c_display = "none";

if (isset($_POST['c_search'])) {
	$pref[12] = $_POST['c_search'];
}

if (isset($_POST['c_replace'])) {
	$pref[13] = $_POST['c_replace'];

}

if (strlen($pref[12]) > 0) {
	$search_c_display = "block";
	$more = "block";
}


/* DECIDE INPUT */

//print_r($_FILES);

/* If file input */

if (!empty($_FILES['fileinput']['name'])) {
	$ext = explode(".", $_FILES['fileinput']['name']);
	$ext = array_pop($ext);
	
	if (in_array($ext, $permitted_files)) {
		$text = utf8_encode(file_get_contents($_FILES['fileinput']['tmp_name']));
	}
	else {
		$text = "this file type ({$ext}) is not permitted - permitted file extensions are: ";
		foreach ($permitted_files as $val) {
			$text .= "{$val}";
			if (next($permitted_files)) {
				$text .= ", ";
			}
		}
		$_POST['fileoutput'] = 0;
	}
}

/* If form input */

elseif (!empty($_POST['source'])) {
	$text = $_POST['source'];
}

/* Or else */

else {
	$text = "";
	$_POST['source'] = "";
}


$op = ""; // Echo output is buffered into this variable



if (empty($_POST['src'])) {
	$_POST['src'] = $pref[0];
}
if (empty($_POST['tgt'])) {
	$_POST['tgt'] = $pref[1];
}

include "./diCrunch/diCrunch_charsets.php";
include "./diCrunch/diCrunch_preprocess.php";


$text = stripslashes($text);

if (!empty($text)) {
	$text = str_replace($ch[$_POST['src']], $ch[$_POST['tgt']], $text);
	unset($intro_text);
}
else {
	$_POST['source'] = $intro_text;
	$text = $intro_text;
}

include "./diCrunch/diCrunch_postprocess.php";



/* Script cruncher */


$_POST['src'] = clean_for_path($_POST['src']);
$_POST['tgt'] = clean_for_path($_POST['tgt']);


if (in_array($_POST['src'], $indic_scripts) && empty($intro_text)) {
	include "./diCrunch/diCrunch_{$_POST['src']}.php";
	include "./diCrunch/diCrunch_indic_source.php";
	$text = str_replace($ch['hk'], $ch[$_POST['tgt']], $text);
}

if (in_array($_POST['tgt'], $indic_scripts) && empty($intro_text)) {
	include "./diCrunch/diCrunch_{$_POST['tgt']}.php";
	include "./diCrunch/diCrunch_indic_target.php";
}




/* Grab custom preferences */

if (!empty($pref[2])) {
	$stylesheet = $pref[2];
}
else {
	$stylesheet = "diCrunch/diCrunch.css";
}


$op .= <<<CWS
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html>
<head>
	<title>diCrunch {$version} - Diacritic and Indic Script Conversion</title>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	
	<meta name="description" content="diCrunch is a conversion tool for converting Indic transliteration and scripts (Devanagari etc.). Convert transliteration to script, convert between transliterations, convert one script to another, or convert script to romanized transliteration." />
	
<link rel="stylesheet" href="{$stylesheet}" type="text/css" />


<script language="javascript" type="text/javascript">

function changeView(section) {
	if (document.getElementById(section).style.display == "block") {
		document.getElementById(section).style.display = "none";
	}
	else {
		document.getElementById(section).style.display = "block";
	}
	return;
}

</script>

</head>

<body>

<div class="container">

CWS;





/* PREFERENCE EDITOR */

if (!empty($_GET['act']) && $_GET['act'] == "config") {
	include "./diCrunch/diCrunch_preferences.php";
}

if (!empty($_GET['act']) && $_GET['act'] == "help") {
	include "./diCrunch/diCrunch_help.php";
}
if (!empty($_GET['act']) && $_GET['act'] == "license") {
	include "./diCrunch/diCrunch_license.php";
}
if (!empty($_GET['act']) && $_GET['act'] == "changelog") {
	include "./diCrunch/diCrunch_changelog.php";
}
if (!empty($_GET['act']) && $_GET['act'] == "tools") {
	include "./diCrunch/diCrunch_tools.php";
}

if (!empty($_GET['act']) && $_GET['act'] == "macro") {
	include "./diCrunch/diCrunch_macro.php";
}

if (!empty($_GET['act']) && $_GET['act'] == "feedback") {
	include "./diCrunch/diCrunch_feedback.php";
}

/* DEFAULT SCREEN */


if (empty($_GET['act'])){

	$op .= <<<CWS


<form name="conform" enctype="multipart/form-data" action="{$_SERVER['PHP_SELF']}" method="post">


<div class="wrapper">

<h2>Diacritic and Indic Script Conversion &middot; diCrunch {$version}</h2>

	<div class="options">

	<div style="float:right; padding-right: 10px; padding-top: 2px;">
		<b>
		<a href="{$_SERVER['PHP_SELF']}?act=config">Preferences</a>
			&nbsp; &middot; &nbsp;
		<a href="{$_SERVER['PHP_SELF']}?act=tools">Tools</a>
			&nbsp; &middot; &nbsp;
		<a href="{$_SERVER['PHP_SELF']}?act=help">Help</a>
		</b>
	</div>
	
Source: <select name="src">
CWS;
foreach ($convs as $key => $value) {
	$op .= "<option value=\"$key\"";
	if ($_POST['src'] == $key) {
		$op .= " selected=\"selected\"";
	}
	$op .= ">&raquo; {$value}</option>\n";
}

$op .= <<<CWS
</select>
&nbsp; &nbsp;
Target: <select name="tgt">
CWS;

foreach ($convs as $key => $value) {
	$op .= "<option value=\"$key\"";
	if ($_POST['tgt'] == $key) {
		$op .= " selected=\"selected\"";
	}
	$op .= ">&raquo; {$value}</option>\n";
}


$op .= <<<CWS
</select>
&nbsp; &nbsp;

		<input type="button" class="button" onclick="changeView('moreoptions');" value="Options" />
		
	</div>
	
</div>



<div class="wrapper" id="moreoptions" style="padding-top: 0px; display: {$more};">


	<div class="preferencefield" style="border-top: 0px; margin-bottom: 0px;">
	
	
<acronym title="When converting to Bengali script, if V was used in transliteration.">V to B</acronym> <input type="checkbox" name="vtob"{$vtob_sel} value="1" style="vertical-align: middle;" /> 

 &nbsp; <b>&middot;</b> &nbsp;

<acronym title="If you used periods for breaking compound words and are converting to Indic script.">Remove period</acronym> <input type="checkbox" name="removedot"{$removedot_sel} value="1" style="vertical-align: bottom;" />

 &nbsp; <b>&middot;</b> &nbsp;

<acronym title="If you want to use .y instead of y in Bengali transliteration.">Swap Y</acronym> <input type="checkbox" name="swapy"{$swapy_sel} value="1" style="vertical-align: bottom;" />

 &nbsp; <b>&middot;</b> &nbsp;
 
 <acronym title="Convert to ṃ instead of ṁ.">Use ṃ</acronym> <input type="checkbox" name="mstyle"{$mstyle_sel} value="1" style="vertical-align: bottom;" />

 &nbsp; <b>&middot;</b> &nbsp;
 
<acronym title="Remove separate input and output text areas.">Single box</acronym> <input type="checkbox" name="splitbox"{$splitbox_sel} value="1" style="vertical-align: bottom;" />

 &nbsp; <b>&middot;</b> &nbsp;
 
<acronym title="Custom search and replace preceding the conversion." style="cursor: pointer;" onclick="changeView('searchreplace');">Search - Replace</acronym> &raquo;

<div id="searchreplace" style="display: {$search_c_display};">
<hr />

<acronym title="Separate multiple characters by colon ;">Search &raquo; Replace</acronym> <input name="c_search" value="{$pref[12]}" size="35" /> &raquo; <input name="c_replace" value="{$pref[13]}" size="35" />

</div>

	</div>

</div>




<div class="wrapper">

	<div class="textareabg">

CWS;


if (empty($splitbox_sel)) 
{
	$op .= <<<CWS
	<textarea id="source" cols="60" rows="10" style="{$textarea}" name="source">{$_POST['source']}</textarea>
	<br />
CWS;

	if (!empty($intro_text)) $text = ""; // null lower panel on default pageload
	
	$op .= <<<CWS
	<textarea id="target" cols="60" rows="10" style="{$textarea}" name="target">{$text}</textarea>
CWS;
}

else 
{
	$op .= <<<CWS
	<textarea id="source" cols="60" rows="10" style="{$textarea}" name="source">{$text}</textarea>
CWS;
}


$op .= <<<CWS
	<br />
	
	<input type="submit" name="convert" value="click to convert / alt+c" accesskey="c" class="button" />
		
	&nbsp; &middot; &nbsp; 

	<acronym title="Click to access options for file input and output" style="cursor: pointer;" onclick="changeView('fileoptions');">File options</acronym>
	

	</div>
	
</div>

CWS;


	

if (!empty($fileoutput_sel)) {
	$fileoutput_display = "block";
}
else {
	$fileoutput_display = "none";
}

$op .= <<<CWS

<div class="wrapper" id="fileoptions" style="padding-top: 0px; margin-top: -6px; display: {$fileoutput_display};">

	<div class="options">

	<acronym title="Input from a text file ({$exts})">Input from file</acronym> <input name="fileinput" type="file" size="30" /> 

	<b>&nbsp; &middot; &nbsp;</b>

	<acronym title="You'll be prompted to download the file in TXT format.">Output to file</acronym> <input type="checkbox" name="fileoutput"{$fileoutput_sel} value="1" style="" />
	
	</div>

</div>



</form>
CWS;

}



$y = date("Y");

$op .= <<<CWS

<!-- You may not remove this footer with copyright notice from the code. Thank you. -->

<div class="copyright">[ 
 &nbsp; 
 &nbsp; 
diCrunch {$version} &copy; 2006-{$y} <a href="http://www.codesatori.com/" target="_blank">CodeSatori</a> 
<b>&nbsp;&middot;&nbsp;</b> 
Download <a href="http://www.codewallah.com/diCrunch/diCrunch.zip">diCrunch.zip</a> ({$download_size} KB)
<b>&nbsp;&middot;&nbsp;</b>
A <a href="http://www.granthamandira.com/" target="_blank">Grantha Mandira Resource</a>
<b>&nbsp;&middot;&nbsp;</b>
<a href="http://www.wiccle.com/" target="_blank">Wiccle CMS Software</a> with Indic script support

 &nbsp; 
 &nbsp; 
]
</div>

</div>

</body>

</html>

CWS;


/* If output as a file */

if (!empty($_POST['fileoutput']) && !empty($_POST['convert'])) {
	header("Content-type: application/force-download");
	header("Content-Disposition: attachment; filename=diCrunch_" . time() . "_{$_POST['src']}-{$_POST['tgt']}.txt");
	echo $text;
	exit;
}

/* The same for macros */

if (!empty($_POST['fileoutput']) && !empty($_POST['domacro'])) {
	header("Content-type: application/force-download");
	header("Content-Disposition: attachment; filename=diCrunch_{$_POST['src']}_{$_POST['tgt']}.txt");
	echo "{$installing}\n";
	echo html_entity_decode(strip_tags($templates[$_POST['program']]['help'])) . "\n\n\n----------\n\n\n";
	echo $macro;
	exit;

	
}

/* Otherwise, regular output */
else {
	echo $op; // Blurt out the output buffer
}


?>