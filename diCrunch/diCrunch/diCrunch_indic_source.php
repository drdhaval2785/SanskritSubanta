<?PHP

	/* If an Indic script is the source */
	
	
	/* Create half-consonants */
	
	$half['tra'] = array();
	$half['scr'] = array();
	
	foreach ($main['tra'] as $key => $val) {
		$half['tra'][$key] = str_replace("a", "", $val);
	}
	foreach ($main['scr'] as $key => $val) {
		$half['scr'][$key] = $val . $v;
	}
	
	
	/* Crunch the half vowels into place */
	
	foreach ($yukta['tra'] as $key => $val) {
		foreach ($half['tra'] as $hkey => $hval) {
			$obj = str_replace("{$v}", "", $half['scr'][$hkey]);
			$text = str_replace("{$obj}{$yukta['scr'][$key]}", "{$hval}{$val}",  $text);
		}
	}
	

	$text = str_replace ($half['scr'], $half['tra'], $text);
	$text = str_replace ($main['scr'], $main['tra'], $text);
	$text = str_replace ($vow['scr'], $vow['tra'], $text);
	$text = str_replace ($num['scr'], $num['tra'], $text);
	
	$text = str_replace("a{$half['tra'][154]}", "{$half['tra'][154]}", $text); // Fix nuktas
	
	
	/* Crunch remaining full vowels, e.g. ha_uk  and sei */
	
	$text = str_replace("a" . str_replace(" ", "", $vow['scr'][253]), "a_i",  $text);
	$text = str_replace("a" . str_replace(" ", "", $vow['scr'][255]), "a_u",  $text);

	foreach ($vow['scr'] as $key => $val) {
		$objscr = str_replace(" ", "", $val);
		$objtra = str_replace(" ", "", $vow['tra'][$key]);
		$text = str_replace("{$objscr}", "{$objtra}",  $text);
	}



	$tidys = array("\n ");
	$tidyr = array("\n");
	
	$text = trim(str_replace($tidys, $tidyr, $text));

?>