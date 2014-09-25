<?PHP

if (!empty($_POST['preferences'])) {

	if (!stristr($_POST['textwidth'], "%") && !stristr($_POST['textwidth'], "px") && strlen ($_POST['textwidth']) > 0) {
		$_POST['textwidth'] .= "px";
	}
	if (!stristr($_POST['textheight'], "%") && !stristr($_POST['textheight'], "px") && strlen ($_POST['textheight']) > 0) {
		$_POST['textheight'] .= "px";
	}
	
	$empties = array("fileoutput", "vtob", "removedot", "swapy", "splitbox", "mstyle");
	
	foreach ($empties as $val) {
		if (empty($_POST[$val])) {
			$_POST[$val] = 0;
		}
	}
	
	setcookie("diCrunch_config", "{$_POST['src']}|||{$_POST['tgt']}|||{$_POST['stylesheet']}|||{$_POST['textfont']}|||{$_POST['textwidth']}|||{$_POST['textheight']}|||{$_POST['fileoutput']}|||{$_POST['vtob']}|||{$_POST['removedot']}|||{$_POST['swapy']}|||{$_POST['splitbox']}|||{$_POST['fontsize']}|||{$_POST['c_search']}|||{$_POST['c_replace']}|||{$_POST['mstyle']}", (time() + 315360000));
	
	$pref[0] = $_POST['src'];
	$pref[1] = $_POST['tgt'];
	$pref[2] = $_POST['stylesheet'];
	$pref[3] = $_POST['textfont'];
	$pref[4] = $_POST['textwidth'];
	$pref[5] = $_POST['textheight'];
	$pref[6] = $_POST['fileoutput'];
	$pref[7] = $_POST['vtob'];
	$pref[8] = $_POST['removedot'];
	$pref[9] = $_POST['swapy'];
	$pref[10] = $_POST['splitbox'];
	$pref[11] = $_POST['fontsize'];
	$pref[12] = $_POST['c_search'];
	$pref[13] = $_POST['c_replace'];
	$pref[14] = $_POST['mstyle'];
	
	$op .= <<<CWS
<div class="wrapper" style="padding-bottom: 0px; margin-bottom: -5px;">
	<div class="preferenceheading">
	<b>&middot; Preferences saved!</b>
	</div>
</div>
CWS;
}


$fileoutput_sel = "";
$vtob_sel = "";
$removedot_sel = "";
$swapy_sel = "";
$splitbox_sel = "";
$mstyle_sel = "";


if ($pref[6] == 1) { $fileoutput_sel = $checked; }
if ($pref[7] == 1) { $vtob_sel = $checked; }
if ($pref[8] == 1) { $removedot_sel = $checked; }
if ($pref[9] == 1) { $swapy_sel = $checked; }
if ($pref[10] == 1) { $splitbox_sel = $checked; }
if ($pref[14] == 1) { $mstyle_sel = $checked; }





	$op .= <<<CWS
	
<div class="wrapper">
<h2>Tool Preferences &nbsp; &middot; &nbsp; <a href="{$_SERVER['PHP_SELF']}">Home</a> &raquo;</h2>

<form name="preferences" action="{$_SERVER['PHP_SELF']}?act=config" method="post">


<div class="preferenceheading">
<b>Specify the default text encodings</b> you wish to use when you access this tool.
</div>
<div class="preferencefield">

Source: 
<select name="src">
<option value=""></option>

CWS;
foreach ($convs as $key => $value) {
	$op .= "<option value=\"$key\"";
	if ($pref[0] == $key) {
		$op .= " selected=\"selected\"";
	}
	$op .= ">&raquo; {$value}</option>\n";
}

$op .= <<<CWS
</select>
&nbsp; &nbsp;
Target: 
<select name="tgt">
<option value=""></option>
CWS;

foreach ($convs as $key => $value) {
	$op .= "<option value=\"$key\"";
	if ($pref[1] == $key) {
		$op .= " selected=\"selected\"";
	}
	$op .= ">&raquo; {$value}</option>\n";
}

$op .= <<<CWS
</select>

</div>



<div class="preferenceheading">
<b>Apply custom styling</b> to the tool. Save the diCrunch <a href="diCrunch/diCrunch.css" target="_blank">stylesheet</a>, modify and upload. Then copy the full URL below.
</div>
<div class="preferencefield">
<input name="stylesheet" value="{$pref[2]}" size="70" />

</div>




<div class="preferenceheading">
<b>Redefine the size and font of the text box</b> to suit your needs. Give size values as pixels or percentage.
</div>
<div class="preferencefield">

Font: <input name="textfont" size="20" value="{$pref[3]}" />
	&nbsp; 
Font size: <input name="fontsize" size="3" value="{$pref[11]}" />
	&nbsp; 
Width: <input name="textwidth" size="5" value="{$pref[4]}" />
	&nbsp; 
Height: <input name="textheight" size="5" value="{$pref[5]}" />

</div>


<div class="preferenceheading">
<b>Miscellaneous default options</b> for the tool.
</div>
<div class="preferencefield">

<acronym title="You'll be prompted to download the file in TXT format.">Output to file</acronym> <input type="checkbox" name="fileoutput" {$fileoutput_sel} value="1" style="vertical-align: middle;" />

	<b>&nbsp; &middot; &nbsp;</b>

<acronym title="When converting to Bengali script, if V was used in transliteration.">V to B</acronym> <input type="checkbox" name="vtob"{$vtob_sel} value="1" style="vertical-align: middle;" /> 
	
	<b>&nbsp; &middot; &nbsp;</b>
	
<acronym title="If you used periods for breaking compound words and are converting to Indic script.">Remove period</acronym> <input type="checkbox" name="removedot"{$removedot_sel} value="1" style="vertical-align: bottom;" />

	
	<b>&nbsp; &middot; &nbsp;</b>
	
	<acronym title="If you want to use .y instead of y in Bengali transliteration.">Swap Y</acronym> <input type="checkbox" name="swapy"{$swapy_sel} value="1" style="vertical-align: bottom;" />

 &nbsp; <b>&middot;</b> &nbsp;

<acronym title="Convert to ṃ instead of ṁ.">Use ṃ</acronym> <input type="checkbox" name="mstyle"{$mstyle_sel} value="1" style="vertical-align: bottom;" />

 &nbsp; <b>&middot;</b> &nbsp;

<acronym title="Remove separate input and output text areas.">Single box</acronym> <input type="checkbox" name="splitbox"{$splitbox_sel} value="1" style="vertical-align: bottom;" />



<hr />

<acronym title="Custom search and replace. Separate multiple characters by colon ;">Search-replace</acronym> <input name="c_search" value="{$pref[12]}" size="35" /> &raquo; <input name="c_replace" value="{$pref[13]}" size="35" />

</div>

<div class="textareabg">
<input type="submit" name="preferences" value="save preferences" accesskey="s" class="button" />
</div>

</form>


</div>
	
CWS;


?>