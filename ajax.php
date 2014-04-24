<?php 
include "function.php";
//initialize varaibles
//$sarvanama = array("sarva","viSva","uBa","uBaya","pUrva","para","avara","dakziRa","uttara","apara","aDara","atara","atama","sva","antara","anya","anyatara","itara","tvat","tva","nema","sama","sima","sva","antara","tyad","tad","yad","etad","idam","adas","eka","dvi","yuzmad","asmad","Bavat","kim");
$html = '';


//post element
$word = $_POST['first'];
$arrWord[] = $_POST['first'];
$last = substr($word, -1);    // returns "last word"
$last_4 = substr($word, -4);    // returns "last 4 word"
        ;
if($last == 'a'){
	if(ends($arrWord,$sarvanama,1)){
		
		if($_POST['step'] == 1){
			$html .= '<div id="step1">';
			$html .= '<input type="radio" value="1" name="cond1" > सर्वादयः सञ्ज्ञा के तौर पे प्रयुक्त हुए हैं ?';
			$html .= '<input type="radio" value="2" name="cond1" > सर्वादयः उपसर्जनीभूत हैं ?';
			$html .= '<input type="radio" value="3" name="cond1" > सर्वादयः तृतीया तत्पुरुष समास में प्रयुक्त हुए हैं ?';
			$html .= '<input type="radio" value="4" name="cond1" > सर्वादयः द्वन्द्व समास में प्रयुक्त हुए हैं ?';
			$html .= '<input type="radio" value="5" name="cond1" > सर्वादयः बहुव्रीहि समास में प्रयुक्त हुए हैं ?';
			$html .= '<input type="radio" value="6" name="cond1" > उपर से किसी में नहीं प्रयुक्त हुए हैं';
			$html .= '</div>';
		}
		
		if($_POST['step'] == 25){
			$html .= '<div id="step2">';
			$html .= '<input type="radio" value="1" name="cond25" > दिक्समास है';
			$html .= '<input type="radio" value="2" name="cond25" > दिक्समास नहीं है';
			$html .= '</div>';
		}
		if($_POST['step'] == 26){
			$purva = array("pUrva","para","avara","dakziRa","uttara","apara","aDara");
			$sva = array("sva");
			$antara = array("antara");
			$datara = array("atara", "atama");
			$sama = array("sama");
			$anyatama = array("anyatama");
			
			if(ends($arrWord,$purva,1)){
				$html .= '<div id="step2">';
				$html .= '<input type="radio" value="1" name="cond26" > सञ्ज्ञा है या व्यवस्था के अर्थ में नहीं है';
				$html .= '<input type="radio" value="2" name="cond26" > सञ्ज्ञा नहीं है और व्यवस्था के अर्थ में प्रयुक्त हुए हैं ।';
				$html .= '</div>';
			}elseif(ends($arrWord,$sva,1)){
				$html .= '<div id="step2">';
				$html .= '<input type="radio" value="1" name="cond26" > ज्ञाति या धन के अर्थ में प्रयुक्त हुआ है ';
				$html .= '<input type="radio" value="2" name="cond26" > ज्ञाति या धन के अर्थ में प्रयुक्त नहीं हुआ है';
				$html .= '</div>';
			}elseif(ends($arrWord,$antara,1)){
				$html .= '<div id="step2">';
				$html .= '<input type="radio" value="1" name="cond26" > बहिर्योग या उपसंव्यान के अर्थ में प्रयुक्त हुआ है';
				$html .= '<input type="radio" value="2" name="cond26" > बहिर्योग या उपसंव्यान के अर्थ में प्रयुक्त नहीं हुआ है';
				$html .= '</div>';
			}elseif(ends($arrWord,$datara,1) && !ends($arrWord,$anyatama,1)){
				$html .= '<div id="step2">';
				$html .= '<input type="radio" value="1" name="cond26" > डतर / डतम प्रत्यय से शब्द की सिद्धि हुई है ';
				$html .= '<input type="radio" value="2" name="cond26" > नहीं';
				$html .= '</div>';
			}elseif(ends($arrWord,$sama,1)){
				$html .= '<div id="step2">';
				$html .= '<input type="radio" value="1" name="cond26" > सम शब्द सर्व के पर्याय में प्रयुक्त हुआ है';
				$html .= '<input type="radio" value="2" name="cond26" > सम शब्द तुल्य के पर्याय में प्रयुक्त हुआ है';
				$html .= '</div>';
			}
			
		}
		if($_POST['step'] == 261){
				$html .= '<div id="step3">';
				$html .= '<input type="radio" value="1" name="cond261" > उसके बाद का शब्द पुरि है ?';
				$html .= '<input type="radio" value="2" name="cond261" > नहीं';
				$html .= '</div>';
		}
		
	}
}elseif($last == 'A'){
		
		$html .= '<div class="step1">';
		$html .= '<input type="radio" value="1" name="cond1" > क्या यह आकारान्त धातु है ?';
		$html .= '<input type="radio" value="2" name="cond1" > नहीं';
		$html .= '</div>';
		
}elseif($last_4 == 'saKi'){
		
		$html .= '<div class="step1">';
		$html .= '<input type="radio" value="1" name="cond1" > उपसर्जनीभूत है ?';
		$html .= '<input type="radio" value="2" name="cond1" > नहीं';
		$html .= '</div>';
		
}


//display the output
echo $html;
exit;
?>