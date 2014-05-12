<?php 
include "function.php";
include "slp-dev.php";
include "dev-slp.php";

//post element
$word = $_POST['first'];
$tran = $_POST['tran'];

// IAST and devanagari handling
// Code for converting from IAST to SLP
$iast = array("a","ā","i","ī","u","ū","ṛ","ṝ","ḷ","ḹ","e","ai","o","au","ṃ","ḥ","kh","ch","ṭh","th","ph","gh","jh","ḍh","dh","bh","ṅ","ñ","ṇ","k","c","ṭ","t","p","g","j","ḍ","d","b","n","m","y","r","l","v","s","h","ś","ṣ",);
$slp = array("a","A","i","I","u","U","f","F","x","X","e","E", "o","O", "M","H","K", "C",  "W", "T", "P","G", "J",  "Q", "D","B", "N","Y","R","k","c","w","t","p","g","j","q","d","b","n","m","y","r","l","v","s","h","S","z",);
  if (preg_match('/[āĀīĪūŪṛṚṝṜḷḶḹḸṃṂḥḤṭṬḍḌṅṄñÑṇṆśŚṣṢV]/',$word))
{
    $word = str_replace($iast,$slp,$word);
}
if ($tran === "IAST")
{
     $word = str_replace($iast,$slp,$word);
}
// Devanagari handling. This is innocuous. Therefore even running without the selection in dropdown menu. 
$word = json_encode($word);
$word = str_replace("\u200d","",$word);
$word = str_replace("\u200c","",$word);
$word = json_decode($word);
$word = convert1($word);

// usable variables
$arrWord[] = $word;
$last = substr($word, -1);    // returns "last word"
$last_4 = substr($word, -4);    // returns "last 4 word"
$html = '';

if($last === 'a' && $_POST['first']!=="anyatama")
{
	if(ends($arrWord,$sarvanama,1)){
		
		if($_POST['step'] === '1'){
			$html .= '<div id="step11">';
			$html .= '<input type="radio" value="1" name="cond1_1_1" > सर्वादयः सञ्ज्ञा के तौर पे प्रयुक्त हुए हैं ?';
			$html .= '<input type="radio" value="2" name="cond1_1_1" > सर्वादयः उपसर्जनीभूत हैं ?';
			$html .= '<input type="radio" value="3" name="cond1_1_1" > सर्वादयः तृतीया तत्पुरुष समास में प्रयुक्त हुए हैं ?';
			$html .= '<input type="radio" value="4" name="cond1_1_1" > सर्वादयः द्वन्द्व समास में प्रयुक्त हुए हैं ?';
			$html .= '<input type="radio" value="5" name="cond1_1_1" > सर्वादयः बहुव्रीहि समास में प्रयुक्त हुए हैं ?';
			$html .= '<input type="radio" value="6" name="cond1_1_1" > उपर से किसी में नहीं प्रयुक्त हुए हैं';
			$html .= '</div>';
		}
		
		if($_POST['step'] === '1_1_1_5'){
			$html .= '<div id="step22">';
			$html .= '<input type="radio" value="1" name="cond1_1_1_5" > दिक्समास है';
			$html .= '<input type="radio" value="2" name="cond1_1_1_5" > दिक्समास नहीं है';
			$html .= '</div>';
		}
		if($_POST['step'] === '1_1_1_6'){
			$purva = array("pUrva","para","avara","dakziRa","uttara","apara","aDara");
			$sva = array("sva");
			$antara = array("antara");
			$datara = array("atara", "atama");
			$sama = array("sama");
			$anyatama = array("anyatama");
			
			if(ends($arrWord,$purva,1)){
				$html .= '<div id="step22">';
				$html .= '<input type="radio" value="1" name="cond1_1_1_6_1" > सञ्ज्ञा है या व्यवस्था के अर्थ में नहीं है';
				$html .= '<input type="radio" value="2" name="cond1_1_1_6_1" > सञ्ज्ञा नहीं है और व्यवस्था के अर्थ में प्रयुक्त हुए हैं ।';
				$html .= '</div>';
			}elseif(ends($arrWord,$sva,1)){
				$html .= '<div id="step22">';
				$html .= '<input type="radio" value="1" name="cond1_1_1_6_2" > ज्ञाति या धन के अर्थ में प्रयुक्त हुआ है ';
				$html .= '<input type="radio" value="2" name="cond1_1_1_6_2" > ज्ञाति या धन के अर्थ में प्रयुक्त नहीं हुआ है';
				$html .= '</div>';
			}elseif(ends($arrWord,$antara,1)){
				$html .= '<div id="step22">';
				$html .= '<input type="radio" value="1" name="cond1_1_1_6_3" > बहिर्योग या उपसंव्यान के अर्थ में प्रयुक्त हुआ है';
				$html .= '<input type="radio" value="2" name="cond1_1_1_6_3" > बहिर्योग या उपसंव्यान के अर्थ में प्रयुक्त नहीं हुआ है';
				$html .= '</div>';
			}elseif(ends($arrWord,$datara,1) && !ends($arrWord,$anyatama,1)){
				$html .= '<div id="step22">';
				$html .= '<input type="radio" value="1" name="cond1_1_1_6_4" > डतर / डतम प्रत्यय से शब्द की सिद्धि हुई है ';
				$html .= '<input type="radio" value="2" name="cond1_1_1_6_4" > नहीं';
				$html .= '</div>';
			}elseif(ends($arrWord,$sama,1)){
				$html .= '<div id="step22">';
				$html .= '<input type="radio" value="1" name="cond1_1_1_6_5" > सम शब्द सर्व के पर्याय में प्रयुक्त हुआ है';
				$html .= '<input type="radio" value="2" name="cond1_1_1_6_5" > सम शब्द तुल्य के पर्याय में प्रयुक्त हुआ है';
				$html .= '</div>';
			}
			
		}
		if($_POST['step'] === '1_1_1_6_3_1'){
				$html .= '<div id="step33">';
				$html .= '<input type="radio" value="1" name="cond1_1_1_6_3_1" > उसके बाद का शब्द पुरि है ?';
				$html .= '<input type="radio" value="2" name="cond1_1_1_6_3_1" > नहीं';
				$html .= '</div>';
		}
		
	}
}
elseif($last === 'A' && $_POST['step'] !== '1_2')
{		
    $html .= '<div class="step11">';
    $html .= '<input type="radio" value="1" name="cond1_2" > क्या यह आकारान्त धातु है ?';
    $html .= '<input type="radio" value="2" name="cond1_2" > नहीं';
    $html .= '</div>';
}
elseif($last_4 === 'saKi')
{
    $html .= '<div class="step11">';
    $html .= '<input type="radio" value="1" name="cond1_3" >प्राधान्य – जैसे कि सुसखा';
    $html .= '<input type="radio" value="2" name="cond1_3" >उपसर्जनीभूत – जैसे कि परमसखा';
    $html .= '<input type="radio" value="3" name="cond1_3" >लाक्षणिक – जैसे कि अतिसखिः (सखीमतिक्रान्तः)';
    $html .= '</div>';
}


//display the output
echo $html;
exit;
?>