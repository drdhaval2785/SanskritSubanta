<?PHP

function clean_for_path($filename)
{

	$filename = preg_replace('/[^(\x20-\x7F)]*/','', $filename);	

	$s = array("..", "%", "*", "/", "\\");
	$r = array("");
	
	$filename = str_replace($s, $r, $filename); // double check never hurts!
	
	return $filename;
}

?>