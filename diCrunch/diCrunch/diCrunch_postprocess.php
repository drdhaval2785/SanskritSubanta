<?PHP



/* Exceptions postprocessing */

if (!empty($_POST['src'])) {

	/* Evading the ~n to .s (Bal) or .t (CSX) problem by temporary renaming */
	
	if ($_POST['src'] == "balaram" || $_POST['src'] == "csx") {
		$text = str_replace("--j--", $ch[$_POST['tgt']]['ex']['7'], $text);
	}
	
	
	/* ITRANS: Evading double replacements
		- the long vowel issue with R^I and L^I
		- the _D XIAST extension */
	
	if ($_POST['src'] == "itrans") {
		$se = array("L^{$ch[$_POST['tgt']]['2']}", "R^{$ch[$_POST['tgt']]['2']}", ".{$ch[$_POST['tgt']]['9']}");
		$re = array($ch[$_POST['tgt']]['16'], $ch[$_POST['tgt']]['5'], $ch[$_POST['tgt']]['20']);
		$text = str_replace($se, $re, $text);
	}	
	
	
	/* Shakti variants */
	
	if ($_POST['src'] == "shakti") {
		
		$se = array("Ã", "", "Ô", "Õ", "Ò", "Ó");
		$re = array($ch[$_POST['tgt']][10], $ch[$_POST['tgt']][11], "‘", "’", "“", "”");
		$text = str_replace($se, $re, $text);
	}	

}

$text = str_replace("\n ", "\n", $text);



/* Preference postprocess */

if (!empty($_POST['mstyle'])) {
	$text = str_replace("ṁ", "ṃ", $text);
}



/* Process escape character */

function conv_back($char) {
	global $ch;
	$id = array_search($char, $ch[$_POST['tgt']]);
	if ($id > 0) {
		$char = $ch[$_POST['src']][$id];
	}
	return $char;
}

$text = preg_replace("@#(.)@ue", "conv_back('\\1')", $text);





?>