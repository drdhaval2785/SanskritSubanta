<?PHP


include "./diCrunch/diCrunch_macro_templates.php";


$fileoutput_sel = "";
$omit_quotes_sel = "";

if (!empty($_POST['fileoutput'])) {
	$fileoutput_sel = $checked;
}
if (!empty($_POST['omit_quotes'])) {
	$omit_quotes_sel = $checked;
}

if (!empty($_POST['program']) && $_POST['program'] == "custom") {
	$_GET['custom'] = 1;
	
	$templates['custom']['name'] = "di_{$_POST['src']}_{$_POST['tgt']}";
	$templates['custom']['start'] = $_POST['start'];
	$templates['custom']['repeat'] = $_POST['repeat'];
	$templates['custom']['character_mark'] = $_POST['character_mark'];
	$templates['custom']['omit_quotes'] = $_POST['omit_quotes'];
	$templates['custom']['end'] = $_POST['end'];
	$templates['custom']['bad_characters'] = array();
	$templates['custom']['help'] = "A custom macro produced by diCrunch {$version} on {$date}";
	
	$templates['msword'] = $templates['custom'];
}



if (!empty($_POST['program'])) {

	$op .= <<<CWS
<div class="wrapper" style="padding-bottom: 0px; margin-bottom: -5px;">
	<div class="preferenceheading">
	<b>&middot; Macro produced!</b> &nbsp; &middot;&nbsp; To continue working with macros, <acronym onclick="changeView('macro_display'); changeView('macro_tool_heading'); changeView('install_area');" style="cursor: pointer;">click here</acronym>. 

	</div>

<h2>Macro Tool &nbsp; &middot; &nbsp; <a href="{$_SERVER['PHP_SELF']}">Home</a> &raquo;</h2>
</div>


CWS;

$macro_display = "none";

}

else {
	$macro_display = "block";
}


$op .= <<<CWS

<div id="macro_display" style="display: {$macro_display};">

<div class="wrapper">
<h2 id="macro_tool_heading" style="display: block;">Macro Tool &nbsp; &middot; &nbsp; <a href="{$_SERVER['PHP_SELF']}">Home</a> &raquo;</h2>


	<div class="preferenceheading">
	<b>Create conversion macros</b> from the diCrunch character sets for use with your word processor.
	</div>
	
	<div class="preferencefield">

This tool takes advantage of the character arrays of the main tool and crunches them into macros you can use with your word processor. Select one of the predefined macro templates or create a <a href="{$_SERVER['PHP_SELF']}?act=macro&amp;custom=1">custom macro</a>.


<form name="macrotool" action="{$_SERVER['PHP_SELF']}?act=macro" method="post">

CWS;

if (empty($_GET['custom'])) {
	$op .= <<<CWS
	

</div>

<div class="preferenceheading">
<b>Select program &nbsp; &middot; &nbsp; <a href="{$_SERVER['PHP_SELF']}?act=macro&amp;custom=1">Or customize</a> &raquo;</b>
</div>

<div class="preferencefield">

Program: 
<select name="program">

CWS;

	foreach ($programs as $key => $value) {
		$op .= "<option value=\"$key\">&raquo; {$value}</option>\n";
	}

$op .= <<<CWS
</select> 

</div>

CWS;
}

else {

$op .= <<<CWS

</div>

<div class="preferenceheading">
<b>Custom macro &nbsp; &middot; &nbsp; <a href="{$_SERVER['PHP_SELF']}?act=macro">Or select a program</a> &raquo;</b>
</div>

<div class="preferencefield">

<b>To create a custom macro</b>, fill in the templates below. A MS Word macro has been given as an example. 

<hr />

<input name="program" type="hidden" value="custom" />

<b>Macro start</b><br />
<textarea name="start" rows="5" cols="60" class="macrotextarea" style="height: 130px;">{$templates['msword']['start']}</textarea>

<hr />

<b>Macro character mark</b> &nbsp;&middot;&nbsp; If needed for characters outside ASCII range, use the {{CHAR}} token. Leave blank if not required.<br />
<input name="character_mark" size="40" class="macroinput" style="width: 200px;" value="{$templates['msword']['character_mark']}" />

&nbsp;
<input name="omit_quotes" type=checkbox class="macroinput" value="1" style="vertical-align: bottom;"{$omit_quotes_sel} /> When used, omit surrounding quotes 


<hr />

<b>Macro repeating action</b> &nbsp;&middot;&nbsp; Use {{SEARCH}} and {{REPLACE}} tokens.<br />
<textarea name="repeat" rows="5" cols="60" class="macrotextarea">{$templates['msword']['repeat']}</textarea>

<hr />

<b>Macro end</b><br />
<textarea name="end" rows="5" cols="60" class="macrotextarea" style="height: 50px;">{$templates['msword']['end']}</textarea>

</div>



CWS;

}

$op .= <<<CWS


<div class="preferenceheading">
	<b>Select macro task</b>
</div>

<div class="preferencefield">

Source encoding: <select name="src">
CWS;
foreach ($convs as $key => $value) {
	if (!in_array($key, $indic_scripts)) {
		$op .= "<option value=\"$key\"";
		if ($_POST['src'] == $key) {
			$op .= " selected=\"selected\"";
		}
		$op .= ">&raquo; {$value}</option>\n";
	}
}

$op .= <<<CWS
</select>
&nbsp; &nbsp;
Target encoding: <select name="tgt">
CWS;

foreach ($convs as $key => $value) {
	if (!in_array($key, $indic_scripts)) {
		$op .= "<option value=\"$key\"";
		if ($_POST['tgt'] == $key) {
			$op .= " selected=\"selected\"";
		}
		$op .= ">&raquo; {$value}</option>\n";
	}
}


$op .= <<<CWS
</select>

&nbsp; &nbsp;


	<acronym title="You'll be prompted to download the macro in TXT format.">Output to file</acronym>: <input type="checkbox" name="fileoutput"{$fileoutput_sel} value="1" style="vertical-align: bottom;" />

	</div>

	<div class="textareabg">
		<input type="submit" name="domacro" value="click to produce the macro" accesskey="c" class="button" />
	</div>


</form>

</div>



</div>

CWS;


function uniord($u) {
   $k = mb_convert_encoding($u, 'UCS-2LE', 'UTF-8');
   $k1 = ord(substr($k, 0, 1));
   $k2 = ord(substr($k, 1, 1));
   return $k2 * 256 + $k1;
}


if (!empty($_POST['domacro'])) {

	$macro = "";

	$macro .= $templates[$_POST['program']]['start'];


	foreach ($ch[$_POST['src']] as $key => $val) {
	
		if (!in_array($ch[$_POST['src']][$key], $templates[$_POST['program']]['bad_characters']) && !in_array($ch[$_POST['tgt']][$key], $templates[$_POST['program']]['bad_characters'])) {
				
			$se = array("se" => "{{SEARCH}}", "re" => "{{REPLACE}}");
			
			if (!empty($templates[$_POST['program']]['character_mark']) && uniord($ch[$_POST['src']][$key]) > 255) {
				$ch[$_POST['src']][$key] = str_replace("{{CHAR}}", uniord($ch[$_POST['src']][$key]), $templates[$_POST['program']]['character_mark']);
					if (!empty($templates[$_POST['program']]['omit_quotes'])) {
						$se['se'] = "\"{{SEARCH}}\"";
					}
			}
			
			if (!empty($templates[$_POST['program']]['character_mark']) && uniord($ch[$_POST['tgt']][$key]) > 255) {
				$ch[$_POST['tgt']][$key] = str_replace("{{CHAR}}", uniord($ch[$_POST['tgt']][$key]), $templates[$_POST['program']]['character_mark']);
				if (!empty($templates[$_POST['program']]['omit_quotes'])) {
					$se['re'] = "\"{{REPLACE}}\"";
				}
			}
			
			$re = array(
				$ch[$_POST['src']][$key],
				$ch[$_POST['tgt']][$key]
			);

			
			$macro .= str_replace($se, $re, $templates[$_POST['program']]['repeat']);
		}
		
	}
	
	/* Some postprocess quirks */
	
	/*if (
	
	
	}*/
	

	$macro .= $templates[$_POST['program']]['end'];


	$installing = "Installing macro: {$templates[$_POST['program']]['name']}";

	$op .= <<<CWS

<div id="install_area" style="display:block;">

	<a name="installing"></a>


	<div class="wrapper">
	
	<hr />
	
		<h2>{$installing}</h2>
		<div class="preferenceheading">
			{$templates[$_POST['program']]['help']}
		</div>
		
		<div class="textareabg">
		<b>Macro name</b> &nbsp; <input style="font-family: Courier New, monospace; font-size: 13px; background-color: #f0f0f0; width: 200px;" value="{$templates[$_POST['program']]['name']}" /><br /><br style="line-height: 4px;" />
		
		<textarea id="source" cols="60" rows="10" style="{$textarea}; font-family: Courier New, monospace; font-size: 13px; background-color: #f0f0f0;">{$macro}</textarea>
		
		</div>
		
	</div>

</div>
CWS;

}



?>