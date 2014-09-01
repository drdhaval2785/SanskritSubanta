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
$last_5 = substr($word, -5);
$html = '';

if($last === 'a' && $_POST['first']!=="anyatama")
{$sarvanama1 = array("sarva","viSva","uBa","uBaya","atara","atama","anya","anyatara","itara","tvat","tva","nema","sima","tyad","tad","yad","etad","idam","adas","eka","dvi","yuzmad","asmad","Bavat","kim","idakam","etara","pUrva","para","avara","dakziRa","uttara","apara","aDara","sva","antara","sama");

	if(ends($arrWord,$sarvanama1,1)){
		
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
		
		if($_POST['step'] === '1_1_1_5' && ends($arrWord,array("pUrva","paScima","uttara","dakziNa"),1) ){
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
elseif($last === 'A' && $_POST['step'] !== '1_2' && $_POST['gender']==='m')
{		
    $html .= '<div class="step11">';
    $html .= '<input type="radio" value="1" name="cond1_2" > क्या यह आकारान्त धातु है ?';
    $html .= '<input type="radio" value="2" name="cond1_2" > नहीं';
    $html .= '</div>';
}
elseif($last === 'i' )
{
    if ($last_4 === 'saKi')
    {
        $html .= '<div class="step11">';
        $html .= '<input type="radio" value="1" name="cond1_3_1" >प्राधान्य – जैसे कि सुसखा';
        $html .= '<input type="radio" value="2" name="cond1_3_1" >उपसर्जनीभूत – जैसे कि परमसखा';
        $html .= '<input type="radio" value="3" name="cond1_3_1" >लाक्षणिक – जैसे कि अतिसखिः (सखीमतिक्रान्तः)';
        $html .= '</div>';
    }
    if (ends($arrWord,array("dvi"),1))
    {
        $html .= '<div class="step11">';
        $html .= '<input type="radio" value="1" name="cond1_3_2" >सञ्ज्ञा है या उपसर्जनीभूत है ';
        $html .= '<input type="radio" value="2" name="cond1_3_2" >सञ्ज्ञा नहीं है और उपसर्जनीभूत नहीं है';
        $html .= '</div>';        
    }    
}
elseif($last === 'I' )
{
    if($_POST['step'] === '1')
    {
        $html .= '<div id="step11">';
        $html .= '<input type="radio" value="1" name="cond1_4" > अनदीसञ्ज्ञकः अधातुः';
        $html .= '<input type="radio" value="2" name="cond1_4" > नदीसञ्ज्ञकः अधातुः';
        $html .= '<input type="radio" value="3" name="cond1_4" > अनदीसञ्ज्ञकः धातुः (असंयोगपूर्वकः इवर्णः, अनेकाच् अङ्गम्)';
        $html .= '<input type="radio" value="4" name="cond1_4" > नदीसञ्ज्ञकः धातुः (असंयोगपूर्वकः इवर्णः, अनेकाच् अङ्गम्)';
        $html .= '<input type="radio" value="5" name="cond1_4" > अनदीसञ्ज्ञकः धातुः (संयोगपूर्वकः इवर्णः / एकाच् अङ्गम् / गतिकारकेतरपूर्वकः) या सुधीशब्दः';
        $html .= '<input type="radio" value="6" name="cond1_4" > नदीसञ्ज्ञकः धातुः (संयोगपूर्वकः इवर्णः / एकाच् अङ्गम् / गतिकारकेतरपूर्वकः )';
        $html .= '</div>';
    }
        if($_POST['step'] === '1_4_2')
        {
            $html .= '<div id="step22">';
            $html .= '<input type="radio" value="1" name="cond1_4_2" > ङ्‍यन्त';
            $html .= '<input type="radio" value="2" name="cond1_4_2" > अङ्‍यन्त';
            $html .= '</div>';
        }
        if($_POST['step'] === '1_4_3')
        {
            $html .= '<div id="step22">';
            $html .= '<input type="radio" value="1" name="cond1_4_3" > नीधात्वन्त';
            $html .= '<input type="radio" value="2" name="cond1_4_3" > सखा – (सखायमिच्छति)';
            $html .= '<input type="radio" value="3" name="cond1_4_3" > सखीः, सुखीः, सुतीः, लूनीः, प्रस्तीमीः इत्यादि';
            $html .= '<input type="radio" value="4" name="cond1_4_3" > अन्य';
            $html .= '</div>';
        }
        if($_POST['step'] === '1_4_4')
        {
            $html .= '<div id="step22">';
            $html .= '<input type="radio" value="1" name="cond1_4_4" > ङ्‍यन्त';
            $html .= '<input type="radio" value="2" name="cond1_4_4" > अङ्‍यन्त';
            $html .= '</div>';
        }
        if($_POST['step'] === '1_4_6')
        {
            $html .= '<div id="step22">';
            $html .= '<input type="radio" value="1" name="cond1_4_6" > ङ्‍यन्त';
            $html .= '<input type="radio" value="2" name="cond1_4_6" > अङ्‍यन्त';
            $html .= '</div>';
        }
}
elseif ($last==="U")
{
    if($_POST['step'] === '1')
    {
        $html .= '<div id="step11">';
        $html .= '<input type="radio" value="1" name="cond1_5" > अनदीसञ्ज्ञकः अधातुः';
        $html .= '<input type="radio" value="2" name="cond1_5" > नदीसञ्ज्ञकः अधातुः';
        $html .= '<input type="radio" value="3" name="cond1_5" > धातुः (असंयोगपूर्वकः ऊवर्णः, अनेकाच् अङ्गम्, गतिकारकपूर्वकः)';
        $html .= '<input type="radio" value="4" name="cond1_5" > धातुः (संयोगपूर्वकः ऊवर्णः / एकाच् अङ्गम् / गतिकारकेतरपूर्वकः)';
        $html .= '</div>';
    }        
}

if ( ends($arrWord,array("catur"),0) && $_POST['step']==='1')
{
            $html .= '<div id="step11">';
            $html .= '<input type="radio" value="1" name="cond1_6_1" > चतुर्‌ उपसर्जनीभूत है ?';                    
            $html .= '<input type="radio" value="2" name="cond1_6_1" > चतुर्‌ प्रधान है ।';                    
            $html .= '</div>';    
}
if ( ($word==="idam" || $word==="idakam") && $_POST['step']==='1')
{
            $html .= '<div id="step11">';
            $html .= '<input type="radio" value="1" name="cond1_7" > अन्वादेश है';                    
            $html .= '<input type="radio" value="2" name="cond1_7" > अन्वादेश नहीं';                    
            $html .= '</div>';    
}
elseif ( $last==="m" && $_POST['step']==='1')
{
            $html .= '<div id="step11">';
            $html .= '<input type="radio" value="1" name="cond1_16" > धातु';                    
            $html .= '<input type="radio" value="2" name="cond1_16" > अधातु';                    
            $html .= '</div>';    
}
$pancan=array("paYcan","saptan","zwan","navan","daSan");
if ( ends($arrWord,$pancan,0) && $_POST['step']==='1')
{
            $html .= '<div id="step11">';
            $html .= '<input type="radio" value="1" name="cond1_8" > उपसर्जनीभूत';                    
            $html .= '<input type="radio" value="2" name="cond1_8" > प्रधान';                    
            $html .= '</div>';    
}
if ( ends($arrWord,array("BrAj"),1) && $_POST['step']==='1')
{
            $html .= '<div id="step11">';
            $html .= '<input type="radio" value="1" name="cond1_9_3" > भ्राज्‌ धातु फणादि है';                    
            $html .= '<input type="radio" value="2" name="cond1_9_3" > नहीं';                    
            $html .= '</div>';    
}
elseif ( $last==="j" && $_POST['step']==='1')
{
            $html .= '<div id="step11">';
            $html .= '<input type="radio" value="1" name="cond1_9" > क्विन्‌ प्रत्ययान्त है';                    
            $html .= '<input type="radio" value="2" name="cond1_9" > नहीं';                    
            $html .= '</div>';    
}
if ( ends($arrWord,array("tyad","tad","yad","etad","idam","adas","eka","dvi","idakam",),1) && $_POST['step']==='1' )
{
            $html .= '<div id="step11">';
            $html .= '<input type="radio" value="1" name="cond1_10" > त्यदादि सञ्ज्ञा या उपसर्जनीभूत के तौर पर प्रयुक्त हुए हैं ';                    
            $html .= '<input type="radio" value="2" name="cond1_10" > नहीं';                    
            $html .= '</div>';    
}
if ( ends($arrWord,array("etad","idam","idakam",),1) && $_POST['step']==='1_10_2' )
{
            $html .= '<div id="step22">';
            $html .= '<input type="radio" value="1" name="cond1_10_2" > अन्वादेश ';                    
            $html .= '<input type="radio" value="2" name="cond1_10_2" > नहीं';                    
            $html .= '</div>';    
}
if ( ends($arrWord,array("asmad","Asmad","yuzmad"),0) && $_POST['step']==='1' )
{
            $html .= '<div id="step11">';
            $html .= '<input type="radio" value="1" name="cond1_11" > अस्मद् / युष्मद् एकत्ववाची है ';                    
            $html .= '<input type="radio" value="2" name="cond1_11" > अस्मद् / युष्मद् द्वित्ववाची है';                    
            $html .= '<input type="radio" value="3" name="cond1_11" > अस्मद् / युष्मद् बहुत्ववाची है';                    
            $html .= '</div>';    
}
if ( ends($arrWord,array("asmad","Asmad","yuzmad"),1) && $_POST['step']==='1' )
{
            $html .= '<div id="step11">';
            $html .= '<input type="radio" value="1" name="cond1_12" > अस्मद् / युष्मद् का प्रयोग पद के बाद में नहीं हुआ है । ';                    
            $html .= '<input type="radio" value="2" name="cond1_12" > अस्मद् / युष्मद् का प्रयोग पाद के प्रारम्भ में हुआ है । ';                    
            $html .= '<input type="radio" value="3" name="cond1_12" > अस्मद्/ युष्मद् का च, वा, हा, अह या एव से साक्षात् योग है । ';                    
            $html .= '<input type="radio" value="4" name="cond1_12" > अस्मद्/ युष्मद् का अचाक्षुष ज्ञानार्थ धातु से योग है । ';                    
            $html .= '<input type="radio" value="5" name="cond1_12" > उपर में से कोई नहीं ';                    
            $html .= '</div>';    
}
if ( $_POST['step']==='1_12_5' )
{
            $html .= '<div id="step22">';
            $html .= '<input type="radio" value="1" name="cond1_12_5" > अन्वादेश है ';                    
            $html .= '<input type="radio" value="2" name="cond1_12_5" > अन्वादेश नहीं है ';                    
            $html .= '</div>';    
}
if ( $_POST['step']==='1_12_5_1' )
{
            $html .= '<div id="step33">';
            $html .= '<input type="radio" value="1" name="cond1_12_5_1" > अस्मद् / युष्मद् विद्यमानपूर्व प्रथमान्त शब्द के परे हैं ';                    
            $html .= '<input type="radio" value="2" name="cond1_12_5_1" > अस्मद् / युष्मद्‌ विद्यमानपूर्व प्रथमान्त शब्द के परे नहीं हैं ';                    
            $html .= '</div>';    
}
if ( $_POST['step']==='1_12_5_1_1' )
{
            $html .= '<div id="step44">';
            $html .= '<input type="radio" value="1" name="cond1_12_5_1_1" > आमन्त्रित से परे हैं ';                    
            $html .= '<input type="radio" value="2" name="cond1_12_5_1_1" > आमन्त्रित से परे नहीं है ';                    
            $html .= '</div>';    
}
if ( $_POST['step']==='1_12_5_1_1_1' )
{
            $html .= '<div id="step55">';
            $html .= '<input type="radio" value="1" name="cond1_12_5_1_1_1" > विशेष्य से परे समानाधिकरण विशेषण है ';                    
            $html .= '<input type="radio" value="2" name="cond1_12_5_1_1_1" > विशेष्य से परे समानाधिकरण विशेषण नहीं है ';                    
            $html .= '</div>';    
}
if ( $_POST['step']==='1_12_5_1_1_1_1' )
{
            $html .= '<div id="step66">';
            $html .= '<input type="radio" value="1" name="cond1_12_5_1_1_1_1" > बहुवचन है ';                    
            $html .= '<input type="radio" value="2" name="cond1_12_5_1_1_1_1" > बहुवचन नहीं है ';                    
            $html .= '</div>';    
}
if ( $_POST['step']==='1' && ends($arrWord,array("aYc","AYc","anc","Anc"),1) )
{
            $html .= '<div id="step11">';
            $html .= '<input type="radio" value="1" name="cond1_13" > क्विन्‌ प्रत्ययान्त है ';                    
            $html .= '<input type="radio" value="2" name="cond1_13" > क्विन्‌ प्रत्ययान्त नहीं है ';                    
            $html .= '</div>';    
}
if ( $_POST['step']==='1_13_1' && ends($arrWord,array("aYc","AYc","anc","Anc"),1) )
{
            $html .= '<div id="step22">';
            $html .= '<input type="radio" value="1" name="cond1_13_1" > पूजा के अर्थ में प्रयुक्त है ';                    
            $html .= '<input type="radio" value="2" name="cond1_13_1" > पूजा के अर्थ में नहीं है ';                    
            $html .= '</div>';    
}
if ( $_POST['step']==='1' && ends($arrWord,array("at"),0) && !ends($arrWord,array("Bavat"),1) )
{
            $html .= '<div id="step11">';
            $html .= '<input type="radio" value="1" name="cond1_17" > अत्वन्त है ';                    
            $html .= '<input type="radio" value="2" name="cond1_17" > अत्वन्त नहीं है ';                    
            $html .= '</div>';    
}
if ( $_POST['step']==='1_17_2' )
{
            $html .= '<div id="step22">';
            $html .= '<input type="radio" value="1" name="cond1_17_2" > अभ्यस्त है ';                    
            $html .= '<input type="radio" value="2" name="cond1_17_2" > अभ्यस्त नहीं है ';                    
            $html .= '</div>';    
}
if ( $_POST['step']==='1' && ends($arrWord,array("Bavat"),1) )
{
            $html .= '<div id="step11">';
            $html .= '<input type="radio" value="1" name="cond1_14" > भातेर्डवतुः ';                    
            $html .= '<input type="radio" value="2" name="cond1_14" > भूधातोः शतृप्रत्ययः ';                    
            $html .= '</div>';    
}




// strIliGga
if ($last==="A" && $_POST['step'] === '2')
{
        $html .= '<div id="step11">';
        $html .= '<input type="radio" value="1" name="cond2_1" > शब्द आबन्त नहीं है';
        $html .= '<input type="radio" value="2" name="cond2_1" > शब्द आबन्त है';
        $html .= '</div>';
}
        $sarvanamastri = array("sarvA","viSvA","uBA","uBayA","atarA","atamA","anyA","anyatarA","itarA","tvA","nemA","simA","pUrvA","parA","avarA","dakziRA","uttarA","aparA","aDarA","svA","antarA","ekA","dvA",);
        $diksamAsa = array('uttarapUrvA','dakziRapUrvA','uttarapaScimA','dakziRapaScimA');
    if($_POST['step'] === '2_1_2' && ends($arrWord,$sarvanamastri,1) )
    {
        $html .= '<div id="step11">';
        $html .= '<input type="radio" value="1" name="cond2_1_2_1" > सर्वादयः सञ्ज्ञा के तौर पे प्रयुक्त हुए हैं ?';
        $html .= '<input type="radio" value="2" name="cond2_1_2_1" > सर्वादयः उपसर्जनीभूत हैं';
        $html .= '<input type="radio" value="3" name="cond2_1_2_1" > सर्वादयः तृतीया तत्पुरुष समास में प्रयुक्त हुए हैं ?';
        $html .= '<input type="radio" value="4" name="cond2_1_2_1" > सर्वादयः द्वन्द्व समास में प्रयुक्त हुए हैं ?';
        $html .= '<input type="radio" value="5" name="cond2_1_2_1" > सर्वादयः बहुव्रीहि समास में प्रयुक्त हुए हैं ?';
        $html .= '<input type="radio" value="6" name="cond2_1_2_1" > उपर से किसी में नहीं प्रयुक्त हुए हैं';
        $html .= '</div>';
    }   
		if($_POST['step'] === '2_1_2_1_5'){
			$html .= '<div id="step22">';
			$html .= '<input type="radio" value="1" name="cond2_1_2_1_5" > दिक्समास है';
			$html .= '<input type="radio" value="2" name="cond2_1_2_1_5" > दिक्समास नहीं है';
			$html .= '</div>';
		}
		if($_POST['step'] === '2_1_2_1_6'){
			$purva = array("pUrvA","parA","avarA","dakziRA","uttarA","aparA","aDarA");
			$sva = array("svA");
			$antara = array("antarA");
			$datara = array("atarA", "atamA");
			$sama = array("samA");
			$anyatama = array("anyatamA");
			
			if(ends($arrWord,$purva,1)){
				$html .= '<div id="step22">';
				$html .= '<input type="radio" value="1" name="cond2_1_2_1_6_1" > सञ्ज्ञा है या व्यवस्था के अर्थ में नहीं है';
				$html .= '<input type="radio" value="2" name="cond2_1_2_1_6_1" > सञ्ज्ञा नहीं है और व्यवस्था के अर्थ में प्रयुक्त हुए हैं ।';
				$html .= '</div>';
			}elseif(ends($arrWord,$sva,1)){
				$html .= '<div id="step22">';
				$html .= '<input type="radio" value="1" name="cond2_1_2_1_6_2" > ज्ञाति या धन के अर्थ में प्रयुक्त हुआ है ';
				$html .= '<input type="radio" value="2" name="cond2_1_2_1_6_2" > ज्ञाति या धन के अर्थ में प्रयुक्त नहीं हुआ है';
				$html .= '</div>';
			}elseif(ends($arrWord,$antara,1)){
				$html .= '<div id="step22">';
				$html .= '<input type="radio" value="1" name="cond2_1_2_1_6_3" > बहिर्योग या उपसंव्यान के अर्थ में प्रयुक्त हुआ है';
				$html .= '<input type="radio" value="2" name="cond2_1_2_1_6_3" > बहिर्योग या उपसंव्यान के अर्थ में प्रयुक्त नहीं हुआ है';
				$html .= '</div>';
			}elseif(ends($arrWord,$datara,1) && !ends($arrWord,$anyatama,1)){
				$html .= '<div id="step22">';
				$html .= '<input type="radio" value="1" name="cond2_1_2_1_6_4" > डतर / डतम प्रत्यय से शब्द की सिद्धि हुई है ';
				$html .= '<input type="radio" value="2" name="cond2_1_2_1_6_4" > नहीं';
				$html .= '</div>';
			}elseif(ends($arrWord,$sama,1)){
				$html .= '<div id="step22">';
				$html .= '<input type="radio" value="1" name="cond2_1_2_1_6_5" > सम शब्द सर्व के पर्याय में प्रयुक्त हुआ है';
				$html .= '<input type="radio" value="2" name="cond2_1_2_1_6_5" > सम शब्द तुल्य के पर्याय में प्रयुक्त हुआ है';
				$html .= '</div>';
			}
                }
                                    if($_POST['step'] === '2_1_2_1_6_3_1'){
                                    $html .= '<div id="step33">';
                                    $html .= '<input type="radio" value="1" name="cond2_1_2_1_6_3_1" > उसके बाद का शब्द पुरि है ?';
                                    $html .= '<input type="radio" value="2" name="cond2_1_2_1_6_3_1" > नहीं';
                                    $html .= '</div>';
                                    }

if ($last==="i" && ends($arrWord,array("tri"),1) && !ends($arrWord,array("stri"),1) )
{
            $html .= '<div id="step11">';
            $html .= '<input type="radio" value="1" name="cond2_2_1" > त्रिशब्द स्त्रीलिङ्ग में है ।';
            $html .= '<input type="radio" value="2" name="cond2_2_1" > त्रिशब्द स्त्रीलिङ्ग में नहीं है ।';
            $html .= '</div>';    
}
if ($last==="I" && $_POST['step']==='2')
{
            $html .= '<div id="step11">';
            if (ends($arrWord,array("praDI"),1))
            {
            $html .= '<input type="radio" value="1" name="cond2_3_5" > प्रध्यायतीति प्रधी';                    
            $html .= '<input type="radio" value="2" name="cond2_3_5" > प्रकृष्टा धीः';                    
            }
            elseif (ends($arrWord,array("suDI"),1))
            {
            $html .= '<input type="radio" value="1" name="cond2_3_6" > सुष्ठु धीः यस्याः सा / सुष्ठु ध्यायतीति';                    
            $html .= '<input type="radio" value="2" name="cond2_3_6" > सुष्ठु धीः';                                    
            }
            elseif (ends($arrWord,array("grAmaRI"),1))
            {
            }
            else
            {
            $html .= '<input type="radio" value="1" name="cond2_3" > ङ्‍यन्त, नदीसञ्ज्ञक (गौरी)';
            $html .= '<input type="radio" value="2" name="cond2_3" > अङ्‍यन्त, नदीसञ्ज्ञक (लक्ष्मी)';
            $html .= '<input type="radio" value="3" name="cond2_3" > ङ्‍यन्त, इयङ्स्थानिक (स्त्री)';
            $html .= '<input type="radio" value="4" name="cond2_3" > अङ्‍यन्त, इयङ्स्थानिक (श्री)';                
            }
            $html .= '</div>';    
}
if ($last==="U" && $_POST['step']==='2')
{
            $html .= '<div id="step11">';
            if (ends($arrWord,array("punarBU","dfnBU","karaBU","kAraBU"),1) )
            {
            $html .= '<input type="radio" value="1" name="cond2_4_4_1" > समास है ।';                    
            $html .= '<input type="radio" value="2" name="cond2_4_4_1" > समास नहीं है ।';                    
            }
            elseif (ends($arrWord,array("varzABU","svayamBU"),1) )
            {
            }
            else
            {
            $html .= '<input type="radio" value="1" name="cond2_4" > नदीसञ्ज्ञक (वधूः)';
            $html .= '<input type="radio" value="2" name="cond2_4" > इयङ्स्थानिक (भ्रूः)';
            $html .= '<input type="radio" value="3" name="cond2_4" > न नदीसञ्ज्ञक (खलपूः)';
            }
            $html .= '</div>';    
}

/* napuMsakaliGga */
if (in_array($last,array("i","I","u","U","f","F","x","X")) && $_POST['step']==='3')
{
            $html .= '<div id="step11">';
            $html .= '<input type="radio" value="1" name="cond3" > भाषितपुंस्क है';                    
            $html .= '<input type="radio" value="2" name="cond3" > नहीं';                    
            $html .= '</div>';    
}

//display the output
echo $html;
exit;
?>