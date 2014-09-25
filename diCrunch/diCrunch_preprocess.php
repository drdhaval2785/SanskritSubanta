<?PHP

/* More options */

if (!empty($_POST['vtob'])) {
	$text = str_replace("v", "b", $text);
}
if (!empty($_POST['removedot'])) {
	$text = str_replace(".", "", $text);
}

if (!empty($_POST['swapy'])) {
	$text = str_replace("y", "*y*", $text);
	$text = str_replace("Y", "y", $text);
	$text = str_replace("*y*", "Y", $text);
}

if (!empty($_POST['c_search'])) {
	$se = explode(";", $_POST['c_search']);
	$re = explode(";", $_POST['c_replace']);
	$text = str_replace($se, $re, $text);
}

if ($_POST['src'] == "unicode") // support both Ms in input by standardizing
{
	$text = str_replace("ṃ", "ṁ", $text);
}


/* First character of line as full vowel in scripts */

$text = str_replace("\n", "\n ", $text);





/* Exceptions */

if (!empty($_POST['src'])) {

	/* Evading the ~n to .s (Bal) and .t (CSX) problem by temporary renaming */
	
	if ($_POST['src'] == "balaram" || $_POST['src'] == "csx") {
		$ch[$_POST['tgt']]['ex']['7'] = $ch[$_POST['tgt']]['7'];
		$ch[$_POST['tgt']]['7'] = "--j--";
	}
	
	
	/* ITRANS alternative normalizing */
	
	if ($_POST['src'] == "itrans") {
		$se = array("AUM", "aa", "ii", "uu", "RRi", "RRI","LLi", "LLI", "N^", "ssh", "GY", "dny", "JN", "x", ".m", ".n");
		$re = array("oM", "A", "I", "U", "R^i", "R^I", "L^i", "L^I", "~N", "Sh", "j~n", "j~n", "j~n","kS", "M", "M");
		$text = str_replace($se, $re, $text);
	}

	
}

?>