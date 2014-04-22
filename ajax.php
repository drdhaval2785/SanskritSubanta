<?php 
//initialize varaibles
$sarvanama = array("sarva","viSva","uBa","uBaya","qatara","qatama","anya","anyatara","itara","tvat","tva","nema","sima","pUrva","para","avara","dakziRa","uttara","apara","aDara","sva","antara","tyad","tad","yad","etad","idam","adas","eka","dvi","yuzmad","asmad","Bavat","kim");
$html = '';

//post element
$word = $_POST['first'];
$last = substr($word, -1);    // returns "last word"
if($last === 'a'){
	if(in_array($word,$sarvanama)){
		$html .= '<input type="radio" value="1" name="cond1" > सर्वादयः सञ्ज्ञा के तौर पे प्रयुक्त हुए हैं ?';
		$html .= '<input type="radio" value="2" name="cond1" > सर्वादयः उपसर्जनीभूत हैं ?';
		$html .= '<input type="radio" value="3" name="cond1" > सर्वादयः तृतीया तत्पुरुष समास में प्रयुक्त हुए हैं ?';
		$html .= '<input type="radio" value="4" name="cond1" > सर्वादयः द्वन्द्व समास में प्रयुक्त हुए हैं ?';
		$html .= '<input type="radio" value="5" name="cond1" > सर्वादयः बहुव्रीहि समास में प्रयुक्त हुए हैं ?';
                $html .= '<input type="radio" value="6" name="cond1" > उपर से किसी में नहीं प्रयुक्त हुए हैं';
	}
}
if($last === 'A'){
		$html .= '<input type="radio" value="1" name="cond2" > क्या यह आकारान्त धातु है ?';
		$html .= '<input type="radio" value="2" name="cond2" > नहीं';
}


//display the output
echo $html;
exit;
?>