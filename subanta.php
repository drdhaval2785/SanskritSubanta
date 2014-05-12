<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="mystyle.css">
</link>
</meta>
</head>
<body>
<?php
 header('Content-type: text/html; charset=utf-8');
 
 /* This code is developed by Dr. Dhaval Patel (drdhaval2785@gmail.com) of www.sanskritworld.in and Ms. Sivakumari Katuri.
  * Layout assistance by Mr Marcis Gasuns.
  * Available under GNU licence.
  * Version 1.2 date 5/12/2013
  * The latest source code is available at https://github.com/drdhaval2785/sanskrit
  * For setup, copy and paste sandhi.html, sandhi.php, function.php, mystyle.css, slp-dev.php and dev-slp.php to your localhost and server and run sandhi.html.
  * sandhi.html is the frontend for the code.
  * function.php stores the frequently used functions in this code (The description on how to use the code is there in function.php.
  * slp-dev.php is for converting SLP1 data to Devanagari. dev-slp.php is for converting Devanagari data to SLP1.
  * Mystyle.css is stylesheet where you can change your preferences.
  */
 
// Including arrays and functions 
include "function.php";
include "slp-dev.php";
include "dev-slp.php";
// set execution time to an hour
ini_set('max_execution_time', 36000);
// set memory limit to 1000 MB
ini_set("memory_limit","1000M");
// Reading from the HTML input.
$first = $_GET["first"];
$second = $_GET['second'];
$tran = $_GET['tran'];
$pada = "pratyaya";
$nadi = 0;
$GI = 0;
$Ap = 0;
$taddhita = 0;
$dhatu = 0;
$eranekaca = 0; // Not clear how to differentiate between iyaG and yaN
$tri = "m";
$nityastri = 0;
$ekajuttarapada = 0;
$bhashitapumska = 0;
$anvadesha = 0;
$samasa = 0; // nalopaH supsvara... 8.2.2
$pradhana = 0;
$Jit = 0; // ho hanterJNinneSu 7.3.54
$Nit = 0;
$kvin = 0;
$kvip = 0;
$bhyas = 4; // 4 for caturthI, 5 for paJcamI. Default 4.
$asmadpada = 2; // 0 for niSedha, 1 for nitya, 2 for vibhASA. Default 2. 
$bhavat = 0; // 0 for bhAterDavatu, 1 for bhU+zatR.
$abhyasta = 0; // 0 for not abhyasta, 1 for abhyasta.
$shatR = 0; // 0 for not shatR, 1 for shatR.
$Nyanta = 0; // 0 for aNyanta, 1 for Nyanta.
$san = 0; // 0 for non san, 1 for san.
$vasu = 0; // 0 for no vasvanta, 1 for vasvanta.
$shap = 0; 
$shyan = 0;
$R = array();
$num = array();
$it = array();
$itprakriti = array();
$itpratyaya = array();
$samp = array();
if ($_GET['sambuddhi'] === "a")
{
$sambuddhi = 1;    
}
else
{
$sambuddhi = 0;
}
$gender = $_GET['gender'];
// Code for converting from IAST to SLP
$iast = array("a","ā","i","ī","u","ū","ṛ","ṝ","ḷ","ḹ","e","ai","o","au","ṃ","ḥ","kh","ch","ṭh","th","ph","gh","jh","ḍh","dh","bh","ṅ","ñ","ṇ","k","c","ṭ","t","p","g","j","ḍ","d","b","n","m","y","r","l","v","s","h","ś","ṣ",);
$slp = array("a","A","i","I","u","U","f","F","x","X","e","E", "o","O", "M","H","K", "C",  "W", "T", "P","G", "J",  "Q", "D","B", "N","Y","R","k","c","w","t","p","g","j","q","d","b","n","m","y","r","l","v","s","h","S","z",);
  if (preg_match('/[āĀīĪūŪṛṚṝṜḷḶḹḸṃṂḥḤṭṬḍḌṅṄñÑṇṆśŚṣṢV]/',$first) || preg_match('/[āĀīĪūŪṛṚṝṜḷḶḹḸṃṂḥḤṭṬḍḌṅṄñÑṇṆśŚṣṢV]/',$second))
{
    $first = str_replace($iast,$slp,$first);
    $second = str_replace($iast,$slp,$second);
}
if ($tran === "IAST")
{
     $first = str_replace($iast,$slp,$first);
    $second = str_replace($iast,$slp,$second);
}
// Devanagari handling. This is innocuous. Therefore even running without the selection in dropdown menu. 
$first = json_encode($first);
$first = str_replace("\u200d","",$first);
$first = str_replace("\u200c","",$first);
$first = json_decode($first);
$second = json_encode($second);
$second = str_replace("\u200d","",$second);
$second = str_replace("\u200c","",$second);
$second = json_decode($second);
$first = convert1($first);
$second = convert1($second);

$fo = $first;
$so = $second; ;
// displaying the data back to the user
echo "<p class = red >You entered: ".convert($fo)." + ".convert($so)." <a href = subanta.html>Go Back</a></p>";
echo "</br>";

/* preprocessing for the sup pratyayas. */
// Datara / Datama are pratyayas. Pending . apuri vaktavyam pending.

// Joining the two input words 
if ($second === "")
{
    $input = $input = ltrim(chop($first));
}
elseif ($first === "")
{
    $input = ltrim(chop($second));
}
else
{
$input = ltrim(chop($first."+".$second));    
}
 /* main coding part starts from here. Based on Siddhantakaumudi text. */
    
// Defining an array $text    
$text = array();
// Defining first member of the array as $input (combined words first and second)
$text[] = $input;

/* displaying general information about the sup vibhaktis */
/* arthavadadhAturapratyayaH prAtipadikam (1.2.45), kRttaddhitasamAsAzca (1.2.46), pratyayaH (3.1.1), parazca (3.1.2), GyAppradipadikAt (4.1.1), svaujasamauTCaSTAbhyAmbhisGebhyAmbhyasGasibhyAmbhyasGasosAmGyossup (4.1.2), vibhaktizca (1.4.104), supaH (1.4.103) */
if (in_array($so,$sup) && $pada==="pratyaya")
{
    echo "<p class = pa >arthavadadhAturapratyayaH prAtipadikam (1.2.45), kRttaddhitasamAsAzca (1.2.46), pratyayaH (3.1.1), parazca (3.1.2), GyAppradipadikAt (4.1.1), svaujasamauTCaSTAbhyAmbhisGebhyAmbhyasGasibhyAmbhyasGasosAmGyossup (4.1.2), vibhaktizca (1.4.104) and supaH (1.4.103) :</p>";
    echo "<p class = pa >अर्थवदधातुरप्रत्ययः प्रातिपदिकम्‌ (१.२.४५), कृत्तद्धितसमासाश्च (१.२.४६), प्रत्ययः (३.१.१), परश्च (३.१.२), ङ्‍याप्प्रातिपदिकात्‌ (४.१.१), स्वौजसमौट्छष्टाभ्याम्भिस्ङेभ्याम्भ्यस्ङसिभ्याम्भ्यस्ङसोसाम्ङ्‍योस्सुप्‌ (४.१.२), विभक्तिश्च (१.४.१०४) तथा सुपः (१.४.१०३) :</p>";
    display(0);
}
/* dvyekayordvivacanaikavacane (1.4.22) */
if ( (in_array($so,$eksup)||in_array($so,$dvisup) ) && $pada==="pratyaya")
{
    echo "<p class = pa >dvyekayordvivacanaikavacane (1.4.22) :</p>";
    echo "<p class = pa >द्व्येकयोर्द्विवचनैकवचने (१.४.२२) :</p>";
    display(0);
}
/* bahuSu bahuvacanam (1.4.21) */
if (in_array($so,$bahusup) && $pada==="pratyaya")
{
    echo "<p class = pa >bahuSu bahuvacanam (1.4.21) :</p>";
    echo "<p class = pa >बहुषु बहुवचनम्‌ (१.४.२१) :</p>";
    display(0);
}
/* sarUpANAmekazeSa ekavibhaktau (1.2.64) */
if ( (in_array($so,$bahusup)||in_array($so,$dvisup) ) && $pada==="pratyaya")
{
    echo "<p class = pa >sarUpANAmekazeSa ekavibhaktau (1.2.64) :</p>";
    echo "<p class = pa >सरूपाणामेकशेष एकविभक्तौ (१.२.६४) :</p>";
    display(0);
}
/* ekavacanaM sambuddhiH (2.3.49) */
if ( $sambuddhi === 1 && $so==="su!" && $pada==="pratyaya")
{
    echo "<p class = pa >ekavacanaM sambuddhiH (2.3.49) :</p>";
    echo "<p class = pa >एकवचनं सम्बुद्धिः (२.३.४९) :</p>";
    display(0);
}
/* nityabahuvacanAnta special messages */
$nityabahuvacana = array("kati","tri","catur","paYcan","saptan","azwan","navan","daSan","ap");
if (in_array($fo,$nityabahuvacana) && !in_array($so,$bahusup) && in_array($so,$sup))
{
    echo "<p class = red >the word you entered is a nitya bahuvacanAnta word. Please check again.</p>";
    echo "<p class = red >आपने जो शब्द दिया है, वह नित्य बहुवचनान्त है । कृपया जाँच कीजिए ।</p>";
    display(0);
}
/* nityadvivacanAnta special messages */
$nityadvivacana = array("dvi");
if (in_array($fo,$nityadvivacana) && !in_array($so,$dvisup) && in_array($so,$sup))
{
    echo "<p class = red >the word you entered is a nitya dvivacanAnta word. Please check again.</p>";
    echo "<p class = red >आपने जो शब्द दिया है, वह नित्य द्विवचनान्त है । कृपया जाँच कीजिए ।</p>";
    display(0);
}
/* nityadvivacanAnta special messages */
if (in_array($fo,$tyadadi) && $so==="su!" && $sambuddhi===1)
{
    echo "<p class = red >tyadAdi don't have sambodhana.</p>";
    echo "<p class = red >त्यदादि का संबोधन नहीं होता है ।</p>";
    display(0);
}
/* defining sarvanama status */
// 1 for obligatory. 2 for optional. 0 for no sarvanamasaJjJA.
/* vibhASAprakaraNe tIyasya GitsUpasaMkhyAnam (vA 242) */ 
if (in_array($fo,array("dvitIyA","tftIyA")) && in_array($so,array("Ne","Nasi!","Nas","Ni")))
{
    $sarvafinal = 2;
    echo "<p class = sa >By vibhASA dvitIyAtRtIyAbhyAm (7.3.115) :</p>";
    echo "<p class = hn >According to siddhAntakaumudI, this sUtra can be done away with. </p>";
    echo "<p class = sa >विभाषा द्वितीयातृतीयाभ्याम्‌ (७.३.११५) :</p>";  
    echo "<p class = hn >कौमुदी के मत में यह सूत्र त्याग करना शक्य है, तीयस्य ङित्सूपसङ्ख्यानात्‌  । </p>";  
    display(0);
}
elseif (in_array($fo,array("dvitIya","tftIya")) && in_array($so,array("Ne","Nasi!","Nas","Ni")))
{
    $sarvafinal = 2;
    echo "<p class = pa >By vibhASAprakaraNe tIyasya GitsUpasaMkhyAnam (vA 242) :</p>";
    echo "<p class = pa >विभाषाप्रकरणे तीयस्य ङित्सूपसङ्ख्यानम्‌ (वा २४२) :</p>";        
    display(0);
}
elseif (ends(array($fo),$diksamAsa,1) && in_array($so,array("Ne","Nasi!","Nas","Ni")))
{
    $sarvafinal = 2;
}
elseif ( in_array($_GET['cond1_1_1'],array("1","2")) )
{
    $sarvafinal = 0;
    echo "<p class = pa >saJjJopasarjanIbhUtAstu na sarvAdayaH (vA 225) :</p>";
    echo "<p class = pa >सञ्ज्ञोपसर्जनीभूतास्तु न सर्वादयः (वा २२५) :</p>";   
    display(0);
}
elseif ( $_GET['cond1_1_1']==="3")
{
    $sarvafinal = 0;
    echo "<p class = pa >tRtIyAsamAse (1.1.30) :</p>";
    echo "<p class = pa >तृतीयासमासे (१.१.३०) :</p>";        
    display(0);
}
elseif ( $_GET['cond1_1_1']==="4")
{
    $sarvafinal = 0;
    echo "<p class = pa >dvandve ca (1.1.31) :</p>";
    echo "<p class = pa >द्वन्द्वे च (१.१.३१) :</p>";        
    display(0); $dvandveca=1;
}
elseif ( $_GET['cond1_1_1_5']==="1" )
{
    $sarvafinal = 2;
    echo "<p class = pa >vibhASA diksamAse bahuvrIhau (1.1.28) :</p>";
    echo "<p class = pa >विभाषा दिक्समासे बहुव्रीहौ (१.१.२८) :</p>";            
    display(0);
}
elseif ( $_GET['cond1_1_1_5']==="2" )
{
    $sarvafinal = 0;
    echo "<p class = pa >na bahuvrIhau (1.1.29) :</p>";
    echo "<p class = pa >न बहुव्रीहौ (१.१.२९) :</p>";            
    display(0);
}
elseif ( $_GET['cond1_1_1_6_1']==="2" )
{
    $sarvafinal = 1;
    echo "<p class = pa >pUrvaparAvaradakSiNottarAparAdharANi vyavasthAyAmasaJjJAyAm (ga sU 1) :</p>";
    echo "<p class = pa >पूर्वपरावरदक्षिणोत्तरापराधराणि व्यवस्थायामसञ्ज्ञायाम्‌ (ग सू १) :</p>"; $vyavastha=1;           
    display(0); $purvapara=1;
    $sarvanama=array_merge($sarvanama,array("pUrva","para","avara","dakziRa","uttara","apara","aDara"));
}
elseif ( $_GET['cond1_1_1_6_1']==="1" )
{
    $sarvafinal = 0;
    $vyavastha=0;            
}
elseif ( $_GET['cond1_1_1_6_2']==="2" )
{
    $sarvafinal = 1;
    echo "<p class = pa >svamajJAtidhanAkhyAyAm (ga sU 2) :</p>";
    echo "<p class = pa >स्वमज्ञातिधनाख्यायाम्‌ (ग सू २) :</p>"; $sva=1;           
    display(0);
    $sarvanama=array_merge($sarvanama,array("sva"));
}
elseif ( $_GET['cond1_1_1_6_2']==="1" )
{
    $sarvafinal = 0;
    $sva=0;           
}
elseif ( $_GET['cond1_1_1_6_3_1']==="1" )
{
    $sarvafinal = 0;
    echo "<p class = pa >'antaraM bahiryogopasaMvyanayoH' (ga sU 3) iti gaNasUtre 'apuri' iti vaktavyam (vA 240) :</p>";
    echo "<p class = pa >'अन्तरं बहिर्योगोपसंव्यानयोः' (ग सू ३) इति गणसूत्रे 'अपुरि' इति वक्तव्यम्‌ (वा २४०) :</p>"; $antara=0;           
    display(0);
}
elseif ( $_GET['cond1_1_1_6_3_1']==="2" )
{
    $sarvafinal = 1;
    echo "<p class = pa >antaraM bahiryogopasaMvyAnayoH (ga sU 3) :</p>";
    echo "<p class = pa >अन्तरं बहिर्योगोपसंव्यानयोः (ग सू ३) :</p>"; $antara=1;           
    $antara=1;     
    display(0);
    $sarvanama=array_merge($sarvanama,array("antara"));
}
elseif ( $_GET['cond1_1_1_6_3']==="2" )
{
    $sarvafinal = 0;
    $antara=0;           
}
elseif ( $_GET['cond1_1_1_6_4']==="1" )
{
    $sarvafinal = 1;
}
elseif ( $_GET['cond1_1_1_6_4']==="2" && $fo!=="anyatara")
{
    $sarvafinal = 0; 
    $sarvanama=array_diff($sarvanama,array("atara","atama")); echo "hi";
}
elseif (ends(array($fo),array("anyatama"),1))
{
    $sarvafinal = 0;
    echo "<p class = pa >As anyatama is not enumerated in sarvAdi and anyatara is specifically enumerated, anyatama doesn't have sarvanAma saJjJA. </p>";
    echo "<p class = pa >सर्वादिगण में अन्यतर का गणन हुआ है और अन्यतम का नहीं है, इसलिए अन्यतम की सर्वनाम सञ्ज्ञा नहीं है ।</p>";        
    display(0);   $sarvanama=array_diff($sarvanama,array("atama"));
}
elseif ( $_GET['cond1_1_1_6_5']==="1" )
{
    $sarvafinal = 1;
    echo "<p class = pa >samaH sarvaparyAyaH.</p>";
    echo "<p class = pa >समः सर्वपर्यायः ।</p>";        
    display(0);   
    $sarvanama=array_merge($sarvanama,array("sama"));
}
elseif ( $_GET['cond1_1_1_6_5']==="2" )
{
    $sarvafinal = 0;
    echo "<p class = pa >tulyaparyAyastu neha gRhyate.</p>";
    echo "<p class = pa >तुल्यपर्यायस्तु नेह गृह्यते ।</p>";        
    display(0);   
}
elseif ( $_GET['cond1_1_1']==="6" )
{
    $sarvafinal = 1;
    display(0);   
}
else
{
    $sarvafinal = 0;
}
/* sarvAdIni sarvanAmAni (1.1.27) */
if ($sarvafinal !==0)
{
    if (in_array($fo,$sarvanama)||in_array($fo,$sarvanamastri))
    {
        echo "<p class = pa >sarvAdIni sarvanAmAni (1.1.27) :</p>";
        echo "<p class = pa >सर्वादीनि सर्वनामानि (१.१.२७) :</p>";
        display(0);
    }
    /* tadantasyApIyaM saJjJA | dvandve ca iti jJApakAt */
    if ( ends(array($fo),$sarvanama,0)||ends(array($fo),$sarvanamastri,0))
    {
        echo "<p class = pa >sarvAdIni sarvanAmAni (1.1.27) and tadantasyApIyaM saJjJA. dvandve ca iti jJApakAt :</p>";
        echo "<p class = pa >सर्वादीनि सर्वनामानि (१.१.२७) तथा तदन्तस्यापीयं सञ्ज्ञा । द्वन्द्वे च इति ज्ञापकात्‌ :</p>";
        display(0); 
    }
}
/* defininig eranekAca */
if ($_GET['cond1_4'] === "1")
{
    $nadi = 0;
    $eranekaca=0;
}
elseif ($_GET['cond1_4_2'] === "1")
{
    $eranekaca=0;
    $nadi=1;
    $GI=1;
}
elseif ($_GET['cond1_4_2'] === "2")
{
    $eranekaca=0;
    $nadi=1;
    $GI=0;
}
elseif ($_GET['cond1_4_3'] === "1")
{
    $eranekaca=1;
    $nadi=0;
    $nI=1;
    $dhatu=1;
}
elseif ($_GET['cond1_4_3'] === "2")
{
    $eranekaca=1;
    $nadi=0;
    $dhatu=1;
    // anaGNitva, uttvam extra.
}
elseif ($_GET['cond1_4_3'] === "3")
{
    $eranekaca=1;
    $nadi=0;
    $dhatu=1;
    // khyatyAtparasya extra.
}
elseif ($_GET['cond1_4_3'] === "4")
{
    $eranekaca=1;
    $nadi=0;
    $dhatu=1;
}
elseif ($_GET['cond1_4_4'] === "1")
{
    $eranekaca=1;
    $nadi=1;
    $GI=1;
    $dhatu=1;
}
elseif ($_GET['cond1_4_4'] === "2")
{
    $eranekaca=1;
    $nadi=1;
    $GI=0;
    $dhatu=1;
}
elseif ($_GET['cond1_4_5'] === "1")
{
    $eranekaca=0;
    $nadi=0;
    $nI=1;
    $dhatu=1;
}
elseif ($_GET['cond1_4_5'] === "2")
{
    $eranekaca=0;
    $nadi=0;
    $nI=0;
    $dhatu=1;
    $GI=0;
}
elseif ($_GET['cond1_4'] === "5")
{
    $eranekaca=0;
    $nadi=0;
    $dhatu=1;
    $GI=0;
}
elseif ($_GET['cond1_4'] === "6")
{
    $eranekaca=0;
    $nadi=1;
    $dhatu=1;
}

/* defining kRt pratyayas */
/* kRdatiG (3.1.93) */
if ($pada === "pratyaya" && !in_array($so,$tiG) && $dhatu===1)
{
    echo "<p class = pa >By kRdatiG (3.1.93) :</p>";
    echo "<p class = pa >कृदतिङ्‌ (३.१.९३) :</p>";
    display(0);    
}
/* Defining pada and bham */
/* suDanapuMsakasya (1.1.43) */ 
if ($gender !== "n" && in_array($so,$sarvanamasthana))
{
    echo "<p class = pa >By suDanapuMsakasya (1.1.43) :</p>";
    echo "<p class = pa >सुडनपुंसकस्य (१.१.४३) :</p>";
    display(0);    
}
/* bahuguNavatuDati saGkhyA (1.1.28) */
/* Dati ca (1.1.25) */
if (in_array($fo,array("bahu","guRa")))
{
    $sankhya = 1;
    echo "<p class = pa >By bahuguNavatuDati saGkhyA (1.1.28) :</p>";
    echo "<p class = pa >बहुगुणवतुडति सङ्ख्या (१.१.२८) :</p>";
    display(0);
}
else 
{
    $sankhya = 0;
}
if (in_array($fo,array("kati")))
{
    $sankhya = 1;
    $shat = 1;
    echo "<p class = pa >By bahuguNavatuDati saGkhyA (1.1.28) and Dati ca (1.1.25) :</p>";
    echo "<p class = pa >बहुगुणवतुडति सङ्ख्या (१.१.२८) तथा डति च (१.१.२५) :</p>";
    display(0);
}
else 
{
    $sankhya = 0;
    $shat = 0;
}
/* SNAntA Sat (1.1.24) */
if (arr($text,'/[zn][+]/') && ($sankhya===1 || ends(array($fo),array("paYcan","zaz","saptan","zwan","navan","daSan"),1)) && ($samasa===0 || $samasa===1 && $pradhana===1))
{
    $shat = 1;
    echo "<p class = pa >By SNAntA Sat (1.1.24) :</p>";
    echo "<p class = pa >ष्णान्ता षट्‌ (१.१.२४) :</p>";
    display(0);
}
/* same in all lingas - special messages */
$samaliGga = array("asmad","asmat","yuzmad","yuzmat");
if (in_array($fo,$samaliGga) || $shat===1)
{
    echo "<p class = pa >asmad, yuSmad and words having ShaT saJjJA have same forms in all three genders.</p>";
    echo "<p class = pa >अस्मद्युष्मद्‍षट्सञ्ज्ञकाः त्रिषु सरूपाः ।</p>";
    display(0);
}
/* checking for presence of aJcu verb. */
if (sub(array("aYcu!","AYcu!","ancu!","Ancu!"),blank(0),blank(0),0))
{
    $ancu=1;
}
else
{
    $ancu=0;
}
/* zatRvat finder */
if(sub(array("pfzad","bfhat","mahat","jagat"),blank(0),blank(0),0))
{
    $shatru = 1;
    $it = array_merge($it,array("S","f"));
    $itprakriti = array_merge($itprakriti,array("S","f"));
}
else
{
    $shatru = 0;
}
/* atvanta finder */
if(sub(array("atu!+"),blank(0),blank(0),0) || ( $bhavat===0 && sub(array("Bavat"),blank(0),blank(0),0)) )
{
    $atu = 1;
    if (sub(array("atu!+"),blank(0),blank(0),0)|| ( $bhavat===0 && sub(array("Bavat"),blank(0),blank(0),0)))
    {
    $it = array_merge($it,array("u"));        
    $itprakriti = array_merge($itprakriti,array("u"));
    }
}
else
{
    $atu = 0;
}
/* na ShaTsvasrAdibhyaH (4.1.10) */
// bracketed because deals with strIpratyayas.
/*if ($shat===1 || in_array($fo,$svasrAdi))
{
    echo "<p class = sa >na ShaTsvasrAdibhyaH (4.1.10) :</p>";
    echo "<p class = sa >न षट्स्वस्रादिभ्यः (४.१.१०) :</p>";
    display(0); $Ap === 0; $GI === 0;
}*/

/* dRnkarapunaHpUrvasya bhuvo yaN vaktavyaH (vA 4118) */ 
if ($dhatu===1 && in_array($fo,array("dfnBU","karaBU","kAraBU","punarBU")) && in_array($so,$sup))
{
 $dRnkar=1;
} else {$dRnkar=0; } 
/* yU stryAkhyau nadI (1.4.3) and prathamaliGgagrahaNaJca (vA 1036) */
// the vArtika is not coded perfectly. Also stryAkhyo is pending.
if ($gender === "f" && !in_array($fo,array("stri","strI")) && (arr($text,'/[iu][+][N]/') || (arr($text,'/[IU][+][N]/') && $nityastri===1) )&& in_array($so,array("Ne","Nasi!","Nas","Ni")) && $dRnkar===0)
{   
    echo "<p class = pa >By Giti hrasvazca (1.4.6) :</p>";
    echo "<p class = pa >ङिति ह्रस्वश्च (१.४.६) :</p>";
    display(0);
    $nadi = 2; // Giti vA.
}
elseif ( $gender==="f" && !in_array($fo,array("stri","strI")) && $dhatu===1 && arr($text,'/[IU][+][A][m]$/') && $dRnkar===0)
{
    echo "<p class = pa >By vA'mi (1.4.5) :</p>";
    echo "<p class = pa >वाऽऽमि (१.४.५) :</p>";
    display(0);
    $nadi = 2;
}
elseif ( $gender==="f" && !in_array($fo,array("stri","strI")) && $dhatu===1 && arr($text,'/[IU][+]/') && !in_array($fo,array("BrU")) && $dRnkar===0 )
{
    echo "<p class = pa >By neyaGuvaGsthAnAvastrI (1.4.4) :</p>";
    echo "<p class = pa >नेयङुवङ्स्थानावस्त्री (१.४.४) :</p>";
    display(0);
    $nadi = 0;
}
elseif ( $nadi===1)
{
    $nadi = 1;
}
elseif ( (( arr($text,'/[IU][+]/') && $nityastri===1) || in_array($fo,array("bahuSreyasI","aticamU"))))
{
    if (in_array($fo,array("bahuSreyasI","aticamU")))
    {
    echo "<p class = pa >By yU stryAkhyau nadI (1.4.3) and prathamaliGgagrahaNaJca (vA 1036) :</p>";
    echo "<p class = pa >यू स्त्र्याख्यौ नदी (१.४.३) तथा प्रथमलिङ्गग्रहणञ्च (वा १०३६) :</p>";
    display(0);
    }
    else
    {
    echo "<p class = pa >By yU stryAkhyau nadI (1.4.3) :</p>";
    echo "<p class = pa >यू स्त्र्याख्यौ नदी (१.४.३) :</p>";
    display(0);
    }
    $nadi = 1;
}
else
{
    $nadi = 0;
}
/* jakSityAdayaH SaT (6.1.6) */
if (sub(array("jakzat","jAgrat","daridrat","SAsat","cakAsat","dIDyat","vevyat"),blank(0),blank(0),0))
{
    $abhyasta=1; $jaksat=1;
    echo "<p class = pa >By jakSityAdayaH SaT (6.1.6) :</p>";
    echo "<p class = pa >जक्षित्यादयः षट्‍ (६.१.६) :</p>";
    display(0);
} else { $jaksat=0; }
/* ubhe abhyastam (6.1.5) */
if ($abhyasta===1 && $jaksat===0)
{
    echo "<p class = pa >By ubhe abhyastam (6.1.5) :</p>";
    echo "<p class = pa >उभे अभ्यस्तम्‌ (६.१.५) :</p>";
    display(0);
}
/* tyadAdiSu dRSo'nAlocane kaJca (3.2.60) */
if ( sub($tyadadi,array("dfS"),blank(0),0) )
{
    echo "<p class = pa >By tyadAdiSu dRSo'nAlocane kaJca (3.2.60) :</p>";
    echo "<p class = pa >त्यदादिषु दृशोऽनालोचने कञ्च (३.२.६०) :</p>";
    display(0); $kvin=1;
}
/* kvin pratyaya from asRj */
if ( $fo==="asfj"  && in_array($so,$sup) )
{
    echo "<p class = pa >asRj has kutva at padAnta, because of mandate of kvin pratyaya after sRj. </p>";
    echo "<p class = pa >असृजः पदान्ते कुत्वम्‌, सृजेः क्विनो विधानात्‌ ।</p>";
    display(0); $kvin=1;
}
/* no kvin pratyaya from viSvasRj */
if ( $fo==="viSvasfj"  && in_array($so,$sup) )
{
    echo "<p class = pa >'rajjusRDbhyAm' usage in bhASya under 'sRjidRSoH' sUtra mandates that there will be no kutva here.</p>";
    echo "<p class = pa >विश्वसृड्‌ इत्यादौ तु कुत्वं न । 'सृजिदृशोः' इति सूत्रे 'रज्जुसृड्भ्याम्‌' इति भाष्यप्रयोगात्‌ ।</p>";
    display(0); $kvin=0;
}
/* spRSo'nudake kvin (3.2.58) */
if ( sub(array("spfS"),array("+"),blank(0),0) )
{
    echo "<p class = pa >By spRSo'nudake kvin (3.2.58) :</p>";
    echo "<p class = pa >स्पृशोऽनुदके क्विन्‌ (३.२.५८) :</p>";
    display(0); $kvin=1;
}
/* Defining $vasu */
if ( sub(array("vidvas","sedivas","uzivas","Suzruvas","upeyivas","anASvas"),array("+"),blank(0),0) )
{
    $text = two(array("vidvas","sedivas","uzivas","Suzruvas","upeyivas","anASvas"),array("+"),array("vidvasu!","sedivasu!","uzivasu!","Suzruvasu!","upeyivasu!","anASvasu!"),array("+"),0);
    echo "<p class = pa >This is a vasvanta word.</p>";
    echo "<p class = pa >यह एक वस्वन्त शब्द है ।</p>";
    display(0); $vasu=1;
}
/* Defining ugit */
if ( sub(array("DvaMs","sraMs"),array("+"),blank(0),0) )
{
    $text = two(array("DvaMs","sraMs"),array("+"),array("DvaMsu!","sraMsu!"),array("+"),0);
    echo "<p class = pa >This is an udit word.</p>";
    echo "<p class = pa >यह एक उदित्‌ शब्द है ।</p>";
    display(0);
}
/* dRnkarapunaHpUrvasya bhuvo yaN vaktavyaH (vA 4118) */ 
if ($dhatu===1 && in_array($fo,array("dfnBU","karaBU","kAraBU","punarBU")) && in_array($so,$sup))
{
    echo "<p class = hn >By dRnkarapunaHpUrvasya bhuvo yaN vaktavyaH (vA 4118), yaN bars application of iyaG,uvaG. Therefore, nadIkAryas will happen. :</p>";
    echo "<p class = hn >दृन्करपुनःपूर्वस्य भुवो यण्‌ वक्तव्यः (वा ४११८) द्वारा प्राप्त यण्‌ - इयङ्‌/उवङ्‌ का बाधन करता है । अतः नदीकार्य होंगे ।</p>";
    display(0); $nadi=1;
}
/* adDDatarAdibhyaH paJcabhyaH (7.1.25) and ekatarAtpratiSedho vaktavyaH (vA 4287) */
elseif (sub(array("ekatara"),array("+"),array("su!","am"),0) && $gender==="n")
{
    echo "<p class = pa >ekatarAtpratiSedho vaktavyaH (vA 4287) :</p>";
    echo "<p class = pa >एकतरात्प्रतिषेधो वक्तव्यः (वा ४२८७) :</p>";        
    display(0); $ekatara=1;
} else {$ekatara=0; }
if (sub(array("atara","atama","anya","anyatara","itara"),array("+"),array("su!","am"),0) && $gender==="n" && $ekatara===0)
{
    $text = two(array("a+",),array("su!","am"),array("a+"),array("adq","adq"),0);
    echo "<p class = sa >By adDDatarAdibhyaH paJcabhyaH (7.1.25) :</p>";
    echo "<p class = sa >अद्ड्डतरादिभ्यः पञ्चभ्यः (७.१.२५) :</p>";
    display(3); $Dit = 1; $adD=1;
} else {$adD = 0; $Dit =0;}
/* maghavA bahulam (6.4.128) */
if (sub(array("maGavan"),array("+"),blank(0),0) && in_array($so,$sup))
{
    $text = two(array("maGavan"),array("+"),array("maGavatf!"),array("+"),1);
    echo "<p class = sa >By maghavA bahulam (6.4.128) :</p>";
    echo "<p class = sa >मघवा बहुलम्‌ (६.४.१२८) :</p>";
    display(3); $Rit=1;
} else {$Rit=0;}
/* arvaNastrasAvanaJa (6.4.127) */
if (sub(array("arvan"),array("+"),blank(0),0) && in_array($so,$sup) && $fo!=="anarvan" && $so!=="su!")
{
    $text = two(array("arvan"),array("+"),array("arvatf!"),array("+"),0);
    echo "<p class = sa >By arvaNastrasAvanaJa (6.4.127) :</p>";
    echo "<p class = sa >अर्वणस्त्रसावनञः (६.४.१२७) :</p>";
    display(3); $Rit1=1;
} else {$Rit1=0;}
if (sub(array("arvan"),array("+"),blank(0),0) && in_array($so,$sup) && ($fo=="anarvan" || $so!=="su!"))
{
    echo "<p class = pa >'tR' Adeza of arvaNastrasAvanaJa (6.4.127) doesnt apply here. </p>";
    echo "<p class = pa >अर्वणस्त्रसावनञः (६.४.१२७) का 'तृ' आदेश यहाँ नहीं होता है ।</p>";
    display(0); 
}
/* RtvigdadhRksragdiguSNigaJcuyujikruJcAM ca (3.2.59) */
if (sub(array("ftvij","daDfz","sfj","diS","zNih","aYcu","yuj","kruYc","ancu"),array("+"),blank(0),0) && $kvin===1 )
{
    echo "<p class = sa >By RtvigdadhRksragdiguSNigaJcuyujikruJcAM ca (3.2.59) :</p>";
    echo "<p class = sa >ऋत्विग्दधृक्स्रग्दिगुष्णिगञ्चुयुजिक्रुञ्चां च (३.२.५९) :</p>";
    display(3);
}
/* rAyo hali (7.2.85) */
if (sub(array("rE"),array("+"),$hlsup,0) && in_array($so,$hlsup))
{
    $text = two(array("rE"),array("+"),array("rA"),array("+"),0);
    echo "<p class = sa >By rAyo hali (7.2.85) :</p>";
    echo "<p class = sa >रायो हलि (७.२.८५) :</p>";
    display(3); $rayo=1;
} else {$rayo = 0; }
/* hrasvo napuMsake prAtipadikasya (1.2.47) */
$achrasva= array("a","a","i","i","u","u","f","f","x","x","i","u","i","u",);
if (sub($ac,array("+"),blank(0),0) && $gender==="n" && in_array($so,$sup)  && $rayo===0)
{
    if (sub(array("e","o","E","O"),array("+"),blank(0),0))
    {
    $text = two($ac,array("+"),$achrasva,array("+"),0);        
    echo "<p class = sa >By hrasvo napuMsake prAtipadikasya (1.2.47) :</p>";
    echo "<p class = pa >By eca igghrasvAdeze (1.1.47) :</p>";
    echo "<p class = sa >ह्रस्वो नपुंसके प्रातिपदिकस्य (१.२.४७) :</p>";
    echo "<p class = pa >एच इग्घ्रस्वादेशे (१.२.४७) :</p>";
    $bhashitapumska=0;
    display(0);       
    echo "<p class = pa >This word is not bhASitapuMska. </p>";
    echo "<p class = pa >यह शब्द भाषितपुंस्क नहीं है ।</p>";
    display(0);       
    }
    else
    {
    $text = two($ac,array("+"),$achrasva,array("+"),0);        
    echo "<p class = sa >By hrasvo napuMsake prAtipadikasya (1.2.47) :</p>";
    echo "<p class = sa >ह्रस्वो नपुंसके प्रातिपदिकस्य (१.२.४७) :</p>";
    display(0);         
    }
}
/* ato'm (7.1.24) */
if (sub(array("a"),array("+"),array("su!","am"),0) && $gender==="n" && $adD ===0)
{
    $text = two(array("a+",),array("su!","am"),array("a+"),array("am","am"),0);
    echo "<p class = sa >By ato'm (7.1.24) :</p>";
    echo "<p class = sa >अतोऽम्‌ (७.१.२४) :</p>";
    display(3); $atom=1;
} else { $atom =0; }
/* defining whether the first word is asmad / yuzmad */
// tvamatikrAntaH, yuvAmatikrAntaH, yuSmAnatikrAntaH are pending. Very confusing.
if (sub(array("asmad","yuzmad"),array("+"),blank(0),0) && in_array($so,$sup))
{
    $asmad=1;
}
else
{
    $asmad=0;
}
/* Whole replacements for asmad / yuSmad */
/* yuSmadasmadoH SaSThIcaturthIdvitIyAsthayorvAMnAvau (8.1.20) */
if (sub(array("asmad","yuzmad"),array("+"),blank(0),0) && in_array($so,array("Ow","ByAm","os")) && $asmadpada>0 )
{
    if($asmadpada===2)
    {
    $text = two(array("asmad+","yuzmad+"),array("Ow","ByAm","os"),array("nO","vAm"),array("","",""),1);        
    }
    else
    {
    $text = two(array("asmad+","yuzmad+"),array("Ow","ByAm","os"),array("nO","vAm"),array("","",""),0);        
    }
    echo "<p class = sa >By yuSmadasmadoH SaSThIcaturthIdvitIyAsthayorvAMnAvau (8.1.20) :</p>";
    echo "<p class = sa >युष्मदस्मदोः षष्ठीचतुर्थीद्वितीयास्थयोर्वांनावौ (८.१.२०) :</p>";
    display(7);
}
/* bahuvacanasya vasnasau (8.1.21) */
if (sub(array("asmad","yuzmad"),array("+"),blank(0),0) && (in_array($so,array("Sas","Am")) || (in_array($so,array("Byas")) && $bhyas===4)) && $asmadpada>0 )
{
    if ($asmadpada===2)
    {
    $text = two(array("asmad+","yuzmad+"),array("Sas","Byas","Am"),array("nas","vas"),array("","",""),1);        
    }
    else
    {
    $text = two(array("asmad+","yuzmad+"),array("Sas","Byas","Am"),array("nas","vas"),array("","",""),0);        
    }
    echo "<p class = sa >By bahuvacanasya vasnasau (8.1.21) :</p>";
    echo "<p class = sa >बहुवचनस्य वस्नसौ (८.१.२१) :</p>";
    display(7);
}
/* temayAvekavacanasya (8.1.22) */
if (sub(array("asmad","yuzmad"),array("+"),blank(0),0) && in_array($so,array("Ne","Nas")) && $asmadpada>0 )
{
    if ($asmadpada===2)
    {
    $text = two(array("asmad+","yuzmad+"),array("Ne","Nas"),array("me","te"),array("",""),1);        
    }
    else
    {
    $text = two(array("asmad+","yuzmad+"),array("Ne","Nas"),array("me","te"),array("",""),0);        
    }
    echo "<p class = sa >By temayAvekavacanasya (8.1.22) :</p>";
    echo "<p class = sa >तेमयावेकवचनस्य (८.१.२२) :</p>";
    display(7);
}
/* tvAmau dvitIyAyAH (8.1.23) */
if (sub(array("asmad","yuzmad"),array("+"),blank(0),0) && in_array($so,array("am")) && $asmadpada>0 )
{
    if ($asmadpada===2)
    {
    $text = two(array("asmad+","yuzmad+"),array("am"),array("mA","tvA"),array(""),1);        
    }
    else
    {
    $text = two(array("asmad+","yuzmad+"),array("am"),array("mA","tvA"),array(""),0);        
    }
    echo "<p class = sa >By tvAmau dvitIyAyAH (8.1.23) :</p>";
    echo "<p class = sa >त्वामौ द्वितीयायाः (८.१.२३) :</p>";
    display(7);
}
/* pratyaya Adeza for yuSmad / asmad */
/* yuSmadasmadbhyAM Gaso'z (7.1.27) */
if (sub(array("asmad","yuzmad"),array("+"),blank(0),0) && in_array($so,array("Nas")))
{
    $text = two(array("+"),array("Nas"),array("+"),array("a"),0);
    echo "<p class = sa >By yuSmadasmadbhyAM Gaso'z (7.1.27) :</p>";
    echo "<p class = sa >युष्मदस्मद्भ्यां ङसोऽश्‍ (७.१.२७) :</p>";
    display(3);
}
/* Geprathamayoram (7.1.28) */
if (sub(array("asmad","yuzmad"),array("+"),blank(0),0) && in_array($so,array("Ne","su!","Ow","O","jas","am")))
{
    $text = two(array("+"),array("Ne","su!","Ow","O","jas","am"),array("+"),array("am","am","am","am","am","am"),0);
    echo "<p class = sa >By Geprathamayoram (7.1.28) :</p>";
    echo "<p class = sa >ङेप्रथमयोरम्‌ (७.१.२८) :</p>";
    display(3);
}
/* zaso na (7.1.29) */
if (sub(array("asmad","yuzmad"),array("+"),blank(0),0) && in_array($so,array("Sas")))
{
    $text = two(array("+"),array("Sas"),array("+"),array("ns"),0);
    echo "<p class = sa >By zaso na (7.1.29) :</p>";
    echo "<p class = hn >This sUtra prevents application of Geprathamayoram. Also the Adeza is of the first letter by AdeH parasya.</p>";
    echo "<p class = sa >शसो न (७.१.२९) :</p>";
    echo "<p class = hn >यह सूत्र ङेप्रथमयोरम्‌ का बाध करता है । आदेश आदेः परस्य सूत्र से अकार का है ।</p>";
    display(3);
}
/* bhyaso bhyam (7.1.30) */
if (sub(array("asmad","yuzmad"),array("+"),blank(0),0) && in_array($so,array("Byas")) && $bhyas===4)
{
    $text = two(array("+"),array("Byas"),array("+"),array("aByam"),0);
    echo "<p class = sa >By bhyaso bhyam (7.1.30) :</p>";
    echo "<p class = sa >भ्यसो भ्यम्‌ (७.१.३०) :</p>";
    display(3);
}
/* paJcamyA at (7.1.32) */
if (sub(array("asmad","yuzmad"),array("+"),blank(0),0) && in_array($so,array("Byas")) && $bhyas===5)
{
    $text = two(array("+"),array("Byas"),array("+"),array("at"),0);
    echo "<p class = sa >By paJcamyA at (7.1.32) :</p>";
    echo "<p class = sa >पञ्चम्या अत्‌ (७.१.३२) :</p>";
    display(3);
}
/* ekavacanasya ca (7.1.32) */
if (sub(array("asmad","yuzmad"),array("+"),blank(0),0) && in_array($so,array("Nasi!")))
{
    $text = two(array("+"),array("Nasi!"),array("+"),array("at"),0);
    echo "<p class = sa >By ekavacanasya ca (7.1.32) :</p>";
    echo "<p class = sa >एकवचनस्य च (७.१.३२) :</p>";
    display(3);
}
/* prakRti Adezas for asmad / yuSmad */
/* yo'ci (7.2.89) */
if (sub(array("asmad","yuzmad",),array("+"),blank(0),0) && in_array($so,array("wA","Ni","os")) )
{
    $text = two(array("asmad","yuzmad",),array("+"),array("asmay","yuzmay",),array("+"),0);
    echo "<p class = sa >By yo'ci (7.2.89) :</p>";
    echo "<p class = sa >योऽचि (७.२.८९) :</p>";
    display(3);    
}
/* yuSmadasmadoranAdeze (7.2.86) */
if (sub(array("asmad","yuzmad"),array("+"),$tRtIyAdi,0) && in_array($so,array("ByAm","Bis","sup")) )
{
    $text = two(array("asmad","yuzmad",),array("+"),array("asmaA","yuzmaA"),array("+"),0);
    echo "<p class = sa >By yuSmadasmadoranAdeze (7.2.86) :</p>";
    echo "<p class = sa >युष्मदस्मदोरनादेशे (७.२.८६) :</p>";
    display(3);    
}
/* dvitIyAyAJca (7.2.87) */
if (sub(array("asmad","yuzmad"),array("+"),blank(0),0) && in_array($so,array("am","Ow","Sas")))
{
    $text = two(array("asmad","yuzmad",),array("+"),array("asmaA","yuzmaA"),array("+"),0);
    echo "<p class = sa >By dvitIyAyAJca (7.2.87) :</p>";
    echo "<p class = pa >maparyantasya (7.2.91) :</p>";
    echo "<p class = sa >द्वितीयायाञ्च (७.२.८७) :</p>";
    display(3);
}
/* prathamAyAzca dvivacane bhASAyAm (7.2.88) */
if (sub(array("asmad","yuzmad"),array("+"),blank(0),0) && in_array($so,array("O")))
{
    $text = two(array("asmad","yuzmad"),array("+"),array("asmaA","yuzmaA"),array("+"),0);
    echo "<p class = sa >By prathamAyAzca dvivacane bhASAyAm (7.2.88) :</p>";
    echo "<p class = sa >प्रथमायाश्च द्विवचने भाषायाम्‌ (७.२.९१) :</p>";
    display(3);
}
/* zeSe lopaH (7.2.90) */
// strIliGga of asmad and yuSmad still pending to be clarified.
if (sub(array("asmad","yuzmad"),array("+"),blank(0),0) && in_array($so,array("su!","jas","Ne","Byas","Nasi!","Nas","Am")))
{
    $text = two(array("asmad","yuzmad"),array("+"),array("asma","yuzma"),array("+"),0);  
    echo "<p class = sa >By zeSe lopaH (7.2.90) :</p>";
    echo "<p class = sa >शेषे लोपः (७.२.९०) :</p>";
    display(3);
}
/* maparyantasya Adezas for asmad / yuSmad */
/* yuvAvau dvivacane (7.2.92) */
if (sub(array("asm","yuzm"),array(""),blank(0),0) && $asmad===1 && in_array($so,$dvisup))
{
    $text = one(array("asm","yuzm"),array("Ava","yuva"),0);
    echo "<p class = sa >By yuvAvau dvivacane (7.2.92) :</p>";
    echo "<p class = pa >maparyantasya (7.2.91) :</p>";
    echo "<p class = sa >युवावौ द्विवचने (७.२.९२) :</p>";
    echo "<p class = pa >मपर्यन्तस्य (७.२.९१) :</p>";
    display(3);
}
/* yUyavayau jasi (7.2.93) */
if (sub(array("asm","yuzm"),array(""),blank(0),0) && $asmad===1 && in_array($so,array("jas")))
{
    $text = one(array("asm","yuzm"),array("vaya","yUya"),0);
    echo "<p class = sa >By yUyavayau jasi (7.2.93) :</p>";
    echo "<p class = pa >maparyantasya (7.2.91) :</p>";
    echo "<p class = sa >यूयवयौ जसि (७.२.९३) :</p>";
    echo "<p class = pa >मपर्यन्तस्य (७.२.९१) :</p>";
    display(3);
}
/* tvAhau sau (7.2.94) */
if (sub(array("asm","yuzm"),array(""),blank(0),0) && $asmad===1 && in_array($so,array("su!")))
{
    $text = one(array("asm","yuzm"),array("aha","tva"),0);
    echo "<p class = sa >By tvAhau sau (7.2.94) :</p>";
    echo "<p class = pa >maparyantasya (7.2.91) :</p>";
    echo "<p class = sa >त्वाहौ सौ (७.२.९४) :</p>";
    echo "<p class = pa >मपर्यन्तस्य (७.२.९१) :</p>";
    display(3);
}
/* tubhyamahyau Gayi (7.2.95) */
if (sub(array("asm","yuzm"),array(""),blank(0),0) && $asmad===1 && in_array($so,array("Ne")))
{
    $text = one(array("asm","yuzm"),array("mahya","tuBya"),0);
    echo "<p class = sa >By tubhyamahyau Gayi (7.2.95) :</p>";
    echo "<p class = pa >maparyantasya (7.2.91) :</p>";
    echo "<p class = sa >तुभ्यमह्यौ ङयि (७.२०९५) :</p>";
    echo "<p class = pa >मपर्यन्तस्य (७.२.९१) :</p>";
    display(3);
}
/* tavamamau Gasi (7.2.96) */
if (sub(array("asm","yuzm"),array(""),blank(0),0) && $asmad===1 && in_array($so,array("Nas")))
{
    $text = one(array("asm","yuzm"),array("mama","tava"),0);
    echo "<p class = sa >By tavamamau Gasi (7.2.96) :</p>";
    echo "<p class = pa >maparyantasya (7.2.91) :</p>";
    echo "<p class = sa >तवममौ ङसि (७.२.९६) :</p>";
    echo "<p class = pa >मपर्यन्तस्य (७.२.९१) :</p>";
    display(3);
}
/* tvamAvekavacane (7.2.97) */
if (sub(array("asm","yuzm"),array(""),blank(0),0) && $asmad===1 && in_array($so,array("am","wA","Nasi!","Ni")))
{
    $text = one(array("asm","yuzm"),array("ma","tva"),0);
    echo "<p class = sa >By tvamAvekavacane (7.2.97) :</p>";
    echo "<p class = pa >maparyantasya (7.2.91) :</p>";
    echo "<p class = sa >त्वमावेकवचने (७.२.९७) :</p>";
    echo "<p class = pa >मपर्यन्तस्य (७.२.९१) :</p>";
    display(3);
}
/* ato guNe patch */
if ($asmad===1 && sub(array("aa","a+aByam","a+at"),blank(0),blank(0),0))
{
    $text = one(array("aa",),array("a"),0);
    $text = two(array("asma+aByam","yuzma+aByam"),array(""),array("asm+aByam","yuzm+aByam"),array(""),0);
    $text = two(array("asma+at","yuzma+at"),array(""),array("asm+at","yuzm+at"),array(""),0);
    echo "<p class = sa >By ato guNe (6.1.96) :</p>";
    echo "<p class = sa >अतो गुणे (६.१.९६) :</p>";
    display(3);    
}
/* aGgakArye kRte punarnAGgakAryam (pa 93) */
if (sub(array("vaya","yUya"),array("+"),array("am"),0) && $so==="jas" )
{
    echo "<p class = pa >aGgakArye kRte punarnAGgakAryam (pa 93) prevents application of jasaH zI.</p>";
    echo "<p class = pa >अङ्गकार्ये कृते पुनर्नाङ्गकार्यम्‌ (प ९३) से जसः शी का प्रतिषेध होता है ।</p>";
    display(0); $nojas=1;   
} else { $nojas=0; }
/* idamo maH (7.2.108) */
if (sub(array("idam","idakam"),array("+"),blank(0),0) && $so==="su!")
{
    echo "<p class = sa >By idamo maH (7.2.108) :</p>";
    echo "<p class = sa >इदमो मः (७.२.१०८) :</p>";
    display(3); $idamoma=1;
} else { $idamoma=0; }
/* yaH sau (7.2.110) */
if (sub(array("idam","idakam"),array("+"),blank(0),0) && $so==="su!" && $gender==="m")
{
    $text = two(array("idam"),array("+"),array("iyam"),array("+"),0);
    echo "<p class = sa >By yaH sau (7.2.110) :</p>";
    echo "<p class = sa >यः सौ (७.२.११०) :</p>";
    display(3);
}
/* ido'y puMsi (7.2.111) */
if (sub(array("idam","idakam"),array("+"),blank(0),0) && $so==="su!" && $gender==="m")
{
    $text = two(array("idam","idakam"),array("+"),array("ayam","ayakam"),array("+"),0);
    echo "<p class = sa >By ido'y puMsi (7.2.111) :</p>";
    echo "<p class = sa >इदोऽय्‌ पुंसि (७.२.१११) :</p>";
    display(3); $idamoma1=1;
} else { $idamoma1=0; }
/* anvAdeze napuMsake enadvaktavyaH (vA 1569) */
if ($gender==="n" && sub(array("idam+","etad+","idakam+",),blank(0),blank(0),0) && in_array($fo,array("idam","etad","idakam")) && $anvadesha===1 && in_array($so,array("am")))
{
    $text = one(array("idam+","etad+","idakam+",),array("enad+","enad+","enad",),0);
    echo "<p class = sa >By anvAdeze napuMsake enadvaktavyaH (vA 1569) :</p>";
    echo "<p class = sa >अन्वादेशे नपुंसके एनद्वक्तव्यः (वा १५६९) :</p>";
    display(0);
}
/* svamornapuMsakAt (7.1.23) */
if ( $gender==="n" && in_array($so,array("su!","am")) && $atom===0 && $adD ===0 )
{
    $text = two(array("+"),array("su!","am"),array("+"),array("",""),0);
    echo "<p class = sa >By svamornapuMsakAt (7.1.23) :</p>";
    echo "<p class = sa >स्वमोर्नपुंसकात्‌ (७.१.२३) :</p>";
    display(3); $svamo = 1;
} else { $svamo = 0; }
/* kimaH kaH (7.2.103) */
if (sub(array("kim","kaka"),array("+"),blank(0),0) && !arr($text,'/[k][i][m][+]$/') && in_array($so,$sup))
{
    $text = two(array("kim","kaka"),array("+"),array("ka","ka"),array("+"),0);
    echo "<p class = sa >By kimaH kaH (7.2.103) :</p>";
    echo "<p class = sa >किमः कः (७.२.१०३) :</p>";
    display(3);
}
if (sub(array("kim","kaka"),array("+"),blank(0),0) && arr($text,'/[k][i][m][+]$/') && in_array($so,$sup))
{
    echo "<p class = pa >na lumatA'Ggasya prevents application of kimaH kaH (7.2.103) :</p>";
    echo "<p class = pa >न लुमताऽङ्गस्य से किमः कः (७.२.१०३) का बाध होता है ।</p>";
    display(0);
}

/* Rnnebhyo GIp (4.1.5) */
// Pending, because it deals with two pratyayas. Right now, if user wants he can write the Gyanta itself and check.

/* aSTana A vibhaktau (7.2.84) */
if ( sub(array("zwan"),$hlsup,blank(0),0) && ($samasa===0 || ($samasa===1 && $pradhana===0)))
{
    $text = two(array("zwan"),$hlsup,array("zwaA"),$hlsup,1);
    echo "<p class = sa >By aSTana A vibhaktau (7.2.84) :</p>";
    echo "<p class = hn >Atva of aSTana A vibhaktau is optional, as shown by 'aSTano dIrghAt'.</p>";
    echo "<p class = sa >अष्टन आ विभक्तौ (७.२.८४)</p>";
    echo "<p class = hn >अष्टन आ विभक्तौ से हुआ आत्व वैकल्पिक है । अष्टनो दीर्घात्‌ इस सूत्र में दीर्घग्रहण के ज्ञापक से । </p>";    
    display(3); $astana=1;
} else { $astana=0; }
/* aSTAbhya auz (7.1.21) */
if ( sub(array("azwaA"),array("jas","Sas"),blank(0),0) && ( ($samasa ===1 && $pradhana===1) || $samasa===0 ))
{
    $text = two(array("azwaA"),array("jas","Sas"),array("azwaA"),array("O","O"),0);
    echo "<p class = sa >By aSTAbhya auz (7.1.21) :</p>";
    echo "<p class = sa >अष्टाभ्य औश्‌ (७.१.२१) :</p>";
    display(3);
}
/* nopadhAyAH (6.4.7) */ 
if ( arr($text,'/[n][+]/') && $so === "Am" && !in_array($fo,$sarvanama) && ($samasa===0 || ($samasa===1 && $pradhana===1)))
{
    $text = three($ac,array("n"),array("+nAm"),$acdir,array("n"),array("+nAm"),0);
    echo "<p class = sa >By nopadhAyAH (6.4.7) :</p>";
    echo "<p class = sa >नोपधायाः (६.४.७) :</p>";
    display(3); $nopadha=1;
} else { $nopadha=0; }

/* pratyayasya lukzlulupaH (1.1.61) */
/* SaDbhyo luk (7.1.22) */
if ( $shat === 1 && in_array($so,array("jas","Sas")) && ( ($samasa ===1 && $pradhana===1) || $samasa===0 ))
{
    $text = two(array("+"),array("jas","Sas"),array("+"),blank(2),0);
    echo "<p class = sa >By SaDbhyo luk (7.1.22) :</p>";
    echo "<p class = sa >षड्भ्यो लुक्‌ (७.१.२२) :</p>";
    echo "<p class = pa >pratyayasya lukzlulupaH (1.1.61) </p>";
    echo "<p class = pa >प्रत्ययस्य लुक्श्लुलुपः (१.१.६१) </p>";
    display(3); $luk = 1;
} else { $luk = 0; }
/* pratyayalope pratyayalakSaNam (1.1.62) and na lumatAGgasya (1.1.63) */
if ($luk === 1 )
{
    echo "<p class = hn >pratyayalope pratyayalakSaNam (1.1.62) is overridden by na lumatAGgasya (1.1.63) :</p>";
    echo "<p class = hn >प्रत्ययलोपे प्रत्ययलक्षणम्‌ (१.१.६२) का न लुमताङ्गस्य (१.१.६३) से बाध हुआ है । :</p>";
    display(0);
}
if ($svamo===1 && $gender==="n" && $so==="su!" && $sambuddhi===1)
{
    echo "<p class = hn >pratyayalope pratyayalakSaNam (1.1.62) is overridden by na lumatAGgasya (1.1.63) optionally.</p>";
    echo "<p class = hn >प्रत्ययलोपे प्रत्ययलक्षणम्‌ (१.१.६२) का न लुमताङ्गस्य (१.१.६३) से बाध हुआ है । यह बाध अनित्य है । :</p>";
    display(0);
}
/* vA'mzasoH (6.4.80) */
if (ends(array($fo),array("strI","stri"),1) && in_array($so,array("am","Sas")))
{
    $text = one(array("strI+","stri+"),array("striy+","striy+"),1);
    echo "<p class = sa >By vA'mzasoH (6.4.80) :</p>";
    echo "<p class = sa >वाऽम्शसोः (६.४.८०) :</p>";
    display(0);
}
/* jazzasoH ziH (7.1.20) */
if ($gender === "n" && $pada=== "pratyaya" && in_array($so,array("jas","Sas")) && $luk===0)
{
    $text = last(array("jas","Sas"),array("Si","Si"),0);
    echo "<p class = sa >By jazzasoH ziH (7.1.20) :</p>";
    echo "<p class = sa >जश्शसोः शिः (७.१.२०) :</p>";
    echo "<p class = hn >N.B. anekAlzitsarvasya mandates sarvAdeza :</p>";
    echo "<p class = hn >अनेकाल्शित्सर्वस्य से सर्वादेश होता है । :</p>";
    display(3); $shi = 1;
} else { $shi = 0; }
/* zi sarvanAmasthAnam (1.1.42) */
if ($shi===1 )
{
    echo "<p class = pa >zi sarvanAmasthAnam (1.1.42) :</p>";
    echo "<p class = pa >शि सर्वनामस्थानम्‌ (१.१.४२) :</p>";
    display(0);
}
/* declaring sarvanamasthana1 variable */
if ( ( in_array($so,$sarvanamasthana) && $gender!=="n") || $shi===1)
{
    $sarvanamasthana1 = 1; 
}
else
{
    $sarvanamasthana1 = 0;
}
/* svAdiSvasarvanAmasthAne (1.4.17) */
if ($sarvanamasthana1===0 && in_array($so,$sup))
{
    $pada="pada";
    echo "<p class = pa >By svAdiSvasarvanAmasthAne (1.4.17) :</p>";
    echo "<p class = pa >स्वादिष्वसर्वनामस्थाने (१.४.१७) :</p>";
    display(0);    
}
/* am sambuddhau (7.1.99) */
if ($so==="su!" && sub(array("catur","anaquh"),blank(0),blank(0),0) && $sambuddhi===1)
{
    $text = one(array("catur+","anaquh+"),array("catuar+","anaquah+"),0);
    echo "<p class = sa >By am sambuddhau (7.1.99) :</p>";
    echo "<p class = sa >अम्‌ सम्बुद्धौ (७.१.९९) :</p>";
    display(3);        
}
/* puMso'suG (7.1.89) */
if ($sarvanamasthana1===1 && sub(array("puMs"),blank(0),blank(0),0))
{
    $text = one(array("puMs+"),array("pumas+"),0);
    echo "<p class = sa >By puMso'suG (7.1.89) :</p>";
    echo "<p class = sa >पुंसोऽसुङ्‌ (७.१.८९) :</p>";
    display(3); $it=array_merge($it,array("u")); $itprakriti=array_merge($itprakriti,array("u"));       
}
/* yujerasamAse (7.1.71) */
// Some issue regarding yuji and yuja is pending. I cant differentiate them right now.
if ( sub(array("yuj"),$sup,blank(0),0) && $fo==="yuj" && $sarvanamasthana1===1 && $samasa===0)
{
    $text = one(array("yuj",),array("yunj"),0);
    echo "<p class = sa >By yujerasamAse (7.1.71) :</p>";
    echo "<p class = sa >युजेरसमासे (७.१.७१) :</p>";
    display(3);        
}
/* A sarvanAmnaH (6.3.91) */
if ( sub($sarvanama,array("dfg","dfS","avatu"),blank(0),0) )
{
    $text = two($tyadadi,array("dfS"),antya($tyadadi,"A"),array("dfS"),0);
    echo "<p class = sa >By AsarvanAmnaH (6.3.91) :</p>";
    echo "<p class = sa >आ सर्वनाम्नः (६.३.९१) :</p>";
    display(0);  $Asarva=1;     
} else { $Asarva=0; }
/* tricaturoH striyAM tisRcatasR (7.2.99) */
if ($tri === "f" && ends(array($fo),array("tri","catur"),1) && !ends(array($fo),array("stri"),1) && ends($text,$sup,1))
{
    $text = one(array("tri+","catur+"),array("tisf+","catasf+"),0);
    echo "<p class = sa >By tricaturoH striyAM tisRcatasR (7.2.99) :</p>";
    echo "<p class = sa >त्रिचतुरोः स्त्रियां तिसृचतस्रू (७.२.९९) :</p>";
    display(3);
}
if ($tri === "f" && ends(array($fo),array("tri","catur"),1) && !ends(array($fo),array("stri"),1) && $svamo===1)
{
    $text = one(array("tri+","catur+"),array("tisf+","catasf+"),1);
    echo "<p class = sa >By tricaturoH striyAM tisRcatasR (7.2.99) and the optional nature of prohibition of 'na lumatA...'  :</p>";
    echo "<p class = sa >त्रिचतुरोः स्त्रियां तिसृचतस्रू (७.२.९९) तथा 'न लुमता..' इत्यस्य निषेधस्य अनित्यत्वम्‌ :</p>";
    display(3);
} 
/* caturanaDuhorAmudAttaH (7.1.98) */
if ($sarvanamasthana1 === 1 && sub(array("catur","anaquh"),blank(0),blank(0),0))
{
    $text = one(array("catur+","anaquh+"),array("catuAr+","anaquAh+"),0);
    echo "<p class = sa >By caturanaDuhorAmudAttaH (7.1.98) :</p>";
    echo "<p class = sa >चतुरनडुहोरामुदात्तः (७.१.९८) :</p>";
    display(3);        
}
/* sAvanaDuhaH (7.1.82) */
if (sub(array("anaquAh+","anaquah+"),array("su!"),blank(0),0))
{
    $text = one(array("anaquAh+","anaquah+"),array("anaquAnh+","anaquanh+"),0);
    echo "<p class = sa >By sAvanaDuhaH (7.1.82) :</p>";
    echo "<p class = sa >सावनडुहः (७.१.८२) :</p>";
    display(3);        
}
/* jarAyA jarasanyatarasyAm (7.2.101) */
if (arr($text,'/(jar)([aA])[+][a][m]/') && $pada=== "pratyaya"  && $so==="su!" && $gender === "n" )
    {
    echo "<p class = pa >sannipAtaparibhASA prevents application of jarAyA jarasanyatarasyAm.</p>";
    echo "<p class = pa >सन्निपातपरिभाषा से जराया जरसन्यतरस्याम्‌ (७.२.१०१) का बाध होता है ।</p>";
    display(3);
    }
if (arr($text,'/(jar)([aA])[+]/') && in_array($so,$acsup) )
    {
    $text = one(array("jara+","jarA+"),array("jaras+","jaras+"),1);
    echo "<p class = sa >By jarAyA jarasanyatarasyAm (7.2.101) :</p>";
    echo "<p class = hn >By padAGgAdhikAre tasya ca tadantasya ca (pa 30) and anekAltvAtsarvAdeze prApte nirdizyamAnasyAdezA bhavanti (pa 13) :</p>";
    echo "<p class = sa >जराया जरसन्यतरस्याम्‌ (७.२.१०१) :</p>";
    echo "<p class = hn >पदाङ्गाधिकारे तस्य च तदन्तस्य च (प ३०) तथा अनेकाल्त्वात्सर्वादेशे प्राप्ते निर्दिश्यमानस्यादेशा भवन्ति (प १३) :</p>";
    display(3);
    }
/* paddannomAshRnnizasanyUSandoSanyakaJChakannudannAsaJChasprabhRtiSu (6.1.63) */
// The random examples given under vibhASA GizyoH on page 147 are pending. Will do them after understanding fully. 
    // kakuddoSaNI etc are pending. 
$paddanno = array("pAda","danta","nAsikA","mAsa","hfdaya","niSA","asfj","yUza","doz","yakft","Sakft","udaka","Asya");
$paddanno1 = array("pad","dat","nas","mAs","hfd","niS","asan","yUzan","dozan","yakan","Sakan","udan","Asan");
if (sub($paddanno,array("+"),blank(0),0) && in_array($so,$zasadi))
{
    $text = two($paddanno,array("+"),$paddanno1,array("+"),1);
    echo "<p class = sa >By paddannomAshRnnizasanyUSandoSanyakaJChakannudannAsaJChasprabhRtiSu (6.1.63) :</p>";
    echo "<p class = hn >prabhRtigrahaNaM prakArArtham. tena 'padaGghrIcaraNo'striyAm', 'svAntaM hRnmAnasaM manaH' etc are valid.</p>";
    echo "<p class = sa >पद्दन्नोमास्‍हृन्निशसन्यूषन्दोषन्यकञ्छकन्नुदन्नासञ्छस्प्रभृतिषु (६.१.६३) :</p>";
    echo "<p class = hn >प्रभृतिग्रहणं प्रकारार्थम्‌ । तेन 'पदङ्घ्रिचरणोऽस्त्रियाम्‌', 'स्वान्तं हृन्मानसं मनः' इत्यादि च सङ्गच्छते ।</p>";
    display(0);
}
/* mAMsapRtanAsAnUnAM mAMspRtsnavo vAcyAH SasAdau vA (vA 3416) */
$mAMsa = array("mAMsa","pftanA","sAnu");
$mAMsa1 = array("mAMs","pft","snu");
if (sub($mAMsa,array("+"),$zasadi,0) && in_array($so,$zasadi))
{
    $text = two($mAMsa,$zasadi,$mAMsa1,$zasadi,1);
    echo "<p class = sa >By mAMsapRtanAsAnUnAM mAMspRtsnavo vAcyAH SasAdau vA (vA 3416) :</p>";
    echo "<p class = sa >मांसपृतनासानूनां मांस्पृत्स्नवो वाच्याः शसादौ वा (वा ३४९६) :</p>";
    display(0);
}
/* asthidadhisakthyakSNAmanaGudAttaH (7.1.75) */
$asthi = array("asTi","daDi","sakTi","akzi");
$asthi1 = array("asTan","daDan","sakTan","akzan");
if (sub($asthi,array("+"),$tRtIyAdiSvaci,0) && in_array($so,$tRtIyAdiSvaci))
{
    $text = two($asthi,$tRtIyAdiSvaci,$asthi1,$tRtIyAdiSvaci,0);
    echo "<p class = sa >By asthidadhisakthyakSNAmanaGudAttaH (7.1.75) :</p>";
    echo "<p class = sa >अस्थिदधिसक्थ्यक्ष्णामनङुदात्तः (७.१.७५) :</p>";
    display(0);
}
/* saGkhyAvisAyapUrvasyAhnasyAhannanyatarasyAM Gau (6.3.110) */
$sankhyahan = array("ekAhna","dvyahna","tryahna","caturahna","paJcAhna","zaDAhna","saptAhna","azwAhna","navAhna","daSAhna","vyahna","sAyAhna");
if (sub($sankhyahan,array("+"),array("Ni"),0) && $so==="Ni")
{
    $text = two(array("hna"),array("+"),array("han"),array("+"),1);
    echo "<p class = sa >By saGkhyAvisAyapUrvasyAhnasyAhannanyatarasyAM Gau (6.3.110) :</p>";
    echo "<p class = sa >सङ्ख्याविसायपूर्वस्याह्नस्याहन्नन्यतरस्याम्‌ (६.३.११०) :</p>";
    display(0);
}
/* sakhyurasambuddhau (7.1.92) */
if (sub(array("saKi","saKI"),$sarvanamasthana,blank(0),0) && $sambuddhi===0 && $gender==="f")
{
    echo "<p class = pa >vibhaktau liGgaviziSTasyAgrahaNam (pa) overrules prAtipadikagrahaNe liGgaviziSTasyApi grahaNam.  :</p>";
    echo "<p class = hn >This bars application of sakhyurasambuddhau. </p>";
    echo "<p class = pa >विभक्तौ लिङ्गविशिष्टस्याग्रहणम्‌ (प) से प्रातिपदिकग्रहणे लिङ्गविशिष्टस्यापि ग्रहणम्‌ का निषेध होता है ।</p>";
    echo "<p class = hn >इस से सख्युरसम्बुद्धौ का प्रतिषेध होता है ।</p>";
    display(3);
}            
if (sub(array("saKi","saKI"),$sarvanamasthana,blank(0),0) && $_GET['cond1_4_3']!=="3" && $sambuddhi===0 && $_GET['cond1_3_1'] !== "3" && $gender!=="f")
{   $Nidvat = 1; 
    echo "<p class = pa >By sakhyurasambuddhau (7.1.92) :</p>";
    echo "<p class = pa >सख्युरसम्बुद्धौ (७.१.९२) :</p>";
    if (!in_array($fo,array("saKi","saKI")))
    {
    echo "<p class = hn >anaG and NidvadbhAva are done because of aGga. Therefore, they apply also with tadanta words. </p>";
    echo "<p class = hn >अनङ्णिद्वद्भावयोराङ्गत्वात्तदन्तेऽपि प्रवृत्तिः । </p>";    
    }
    display(3);
} else {$Nidvat=0; }
/* anaG sau (7.1.93) and Gicca (1.1.53) */
if (sub(array("saKi","saKI"),array("+"),array("su!"),0) && $so==="su!" && $sambuddhi===0 && $gender==="f")
{
    echo "<p class = pa >vibhaktau liGgaviziSTasyAgrahaNam (pa) overrules prAtipadikagrahaNe liGgaviziSTasyApi grahaNam.  :</p>";
    echo "<p class = hn >This bars application of anaG sau. </p>";
    echo "<p class = pa >विभक्तौ लिङ्गविशिष्टस्याग्रहणम्‌ (प) से प्रातिपदिकग्रहणे लिङ्गविशिष्टस्यापि ग्रहणम्‌ का निषेध होता है ।</p>";
    echo "<p class = hn >इस से अनङ्‌ सौ का प्रतिषेध होता है ।</p>";
    display(3);
}            
if (sub(array("saKi","saKI"),array("+"),array("su!"),0) && $_GET['cond1_4_3']!=="3" && $so==="su!" && $_GET['cond1_3_1'] !== "3" && $sambuddhi===0 && $gender!=="f")
{
    $text = two(array("saKi","saKI"),array("+"),array("saKan","saKan"),array("+"),0);
    echo "<p class = sa >By anaG sau (7.1.93) and Gicca (1.1.53)  :</p>";
    echo "<p class = sa >अनङ्‌ सौ (७.१.९३) तथा ङिच्च (१.१.५३) :</p>";
    if (!in_array($fo,array("saKi","saKI")))
    {
    echo "<p class = hn >anaG and NidvadbhAva are done because of aGga. Therefore, they apply also with tadanta words. </p>";
    echo "<p class = hn >अनङ्णिद्वद्भावयोराङ्गत्वात्तदन्तेऽपि प्रवृत्तिः । </p>";    
    }
    display(3);
}
/* alo'ntyAtpUrva upadhA (1.1.65) */ 
// saJjJA sUtra. Nothing to code here.
/* diva aut (7.1.84) */
if (sub(array("div+"),array("su!"),blank(0),0))
{
    $text = one(array("div+"),array("diO+"),0);
    echo "<p class = sa >By diva aut (7.1.84) :</p>";
    echo "<p class = sa >दिव औत्‌ (७.१.८४) :</p>";
    display(3);        
    echo "<p class = pa >Because it is alvidhi, sthAnivadbhAva doesn't happen and 'halGyAp..' doesn't apply. </p>";
    echo "<p class = pa >अल्विधि होने के कारण स्थानिवद्भाव नहीं है । अतः हल्ङ्‍याप्‌.. की प्रवृत्ति नहीं है ।</p>";
    display(0);        
}
/* diva ut (6.1.131) */
// uttarapadatve cApadAdividhau pratiSedhaH (vA) pending.
// dadhisecau example is also pending.
if (sub(array("div+"),$hlsup,blank(0),0) || arr($text,'/[d][i][v][+]$/') )
{
    $text = one(array("div+"),array("diu+"),0);
    echo "<p class = sa >By diva ut (6.1.131) :</p>";
    echo "<p class = sa >दिव उत्‌ (६.१.१३१) :</p>";
    display(0);        
}
/* zeSo ghyasakhi (1.4.7) */
if ($nadi!==1 && arr($text,'/[iu][+]/') && $fo!=="saKi" && !arr($text,'/[iu][+]$/'))
{
    if (arr(array($fo),'/[p][a][t][i]$/') && $fo==='pati')
    {
        $ghi = 0;
        echo "<p class = pa >By patiH samAsa eva (1.4.8), the ghi saJjJA is not ascribed. </p>";
        echo "<p class = pa >पतिः समास एव (१.४.८) से घिसञ्ज्ञा नहीं है । </p>";
        display(0);        
    }
    else
    {
    $ghi = 1;
    echo "<p class = pa >By zeSo ghyasakhi (1.4.7) :</p>";
    echo "<p class = pa >शेषो घ्यसखि (१.४.७) :</p>";
    display(0);        
    }
}
else
{
    $ghi = 0;
}
/* na mu ne (8.2.3) */ 
//adas + wA -> nAbhAva has to happen. Special case.
if ( $fo==="adas" && $so==="wA" && $gender!=="f")
{
    $text = one(array("adas"),array("amu"),0);
    echo "<p class = sa >By adaso'serdAdu do maH (8.2.80) :</p>";
    echo "<p class = sa >अदसोऽसेर्दादु दो मः (८.२.८०) :</p>";
    display(0);
    echo "<p class = pa >By na mu ne (8.2.3) :</p>";
    echo "<p class = pa >न मु ने (८.२.३) :</p>";
    $ghi=1;
    display(0);
}

/* yaci bham (1.4.14) and A kaDArAdekA saJjJA (1.4.1) */
// Not coded perfectly. Only for sup pratyayas.
if ($sarvanamasthana1 === 0 && (in_array($so,$yacibham) || ($gender==="n" && in_array($so,array("O","Ow"))) ) && $luk===0 )
{
    echo "<p class = pa >By yaci bham (1.4.14) and A kaDArAdekA saJjJA (1.4.1) :</p>";
    echo "<p class = pa >यचि भम्‌ (१.४.१४) तथा आ कडारादेका सञ्ज्ञा (१.४.१) :</p>";
    display(0); $bham=1; $pada="pratyaya";
} else {$bham = 0; }  
/* SaTcaturbhyazca (7.1.55) */ 
if ( ($shat===1 || arr(array($fo),'/[c][a][t][u][r]$/')) && $so === "Am" && !in_array($fo,$sarvanama) && ($samasa===0 || $samasa===1 && $pradhana===1))
{
    $text = one(array("+Am"),array("+nAm"),0);
    echo "<p class = sa >By SaTcaturbhyazca (7.1.55) :</p>";
    echo "<p class = sa >षट्चतुर्भ्यश्च (७.१.५५) :</p>";
    display(3); $Satcatur=1; $pada="pada";
} else { $Satcatur=0; }
/* pAdaH pat (6.4.130) */
if (sub(array("pAd"),array("+"),$sup,0) && $bham===1)
{
    $text = two(array("pAd"),$sup,array("pad"),$sup,0);
    echo "<p class = sa >By pAdaH pat (6.4.130) :</p>";
    echo "<p class = sa >पादः पत्‌ (६.४.१३०):</p>";
    display(3);
}    
/* bhasya TerlopaH (7.1.88) */
if (sub(array("paTin","maTin","fBukzin"),blank(0),blank(0),0) && $bham===1 )
{
    $text = one(array("paTin","maTin","fBukzin"),array("paT","maT","fBukz"),0);
    echo "<p class = sa >By bhasya TerlopaH (7.1.88) :</p>";
    echo "<p class = sa >भस्य टेर्लोपः (७.१.८८) :</p>";
    display(3); 
}
/* pathimathyRbhukSAmAt (7.1.85) */
if (sub(array("paTin","maTin","fBukzin"),array("+"),blank(0),0) && $so==="su!" && $gender==="m")
{
    $text = two(array("paTin","maTin","fBukzin"),array("+"),array("paTiA","maTiA","fBukziA"),array("+"),0);
    echo "<p class = sa >By pathimathyRbhukSAmAt (7.1.85) :</p>";
    echo "<p class = sa >पथिमथ्यृभुक्षामात्‌ (७.१.८५) :</p>";
    display(3); $pathi=1;
} else {$pathi=0; } 
/* ito'tsarvanAmasthAne (7.1.85) */
if (sub(array("paTi","maTi","fBukzi"),blank(0),blank(0),0) && $sarvanamasthana1===1 )
{
    $text = one(array("paTi","maTi","fBukzi"),array("paTa","maTa","fBukza"),0);
    echo "<p class = sa >By ito'tsarvanAmasthAne (7.1.85) :</p>";
    echo "<p class = sa >इतोऽत्सर्वनामस्थाने (७.१.८५) :</p>";
    display(3); $pathi1=1;
} else {$pathi=0;}
/* tho'nthaH (7.1.87) */
if (sub(array("paTa","maTa"),blank(0),blank(0),0) && ($pathi===1 || $pathi1===1))
{
    $text = one(array("paTa","maTa",),array("panTa","manTa",),0);
    echo "<p class = sa >By tho'nthaH (7.1.87) :</p>";
    echo "<p class = sa >थोऽन्थः (७.१.८७) :</p>";
    display(3);
}
/* sambuddhau napuMsakAnAM nalopo vA vAcyaH (vA) */
// Pending. Not clear to me.
/* sau ca (6.4.13) */
$noin=array("ahan","Ahan");
$acdir = array("A","A","I","I","U","U","F","F","F","F","e","o","E","O",);
if (sub(array("in","han","pUzan","aryaman"),array("+"),array("su!"),0) && !sub(array("ahan","Ahan"),array("+"),array("su!"),0) && in_array($so,array("su!")) && $sambuddhi===0)
{
    $text = two($ac,array("n+"),$acdir,array("n+"),0);
    echo "<p class = sa >By sau ca (6.4.13) :</p>";
    echo "<p class = sa >सौ च (६.४.१३) :</p>";        
    if (sub(array("vIn+"),blank(0),blank(0),0))
    {
    echo "<p class = pa >By 'aninasmangrahaNAni arthavatA cAnarthakena ca tadantavidhiM prayojayanti' (pa) :</p>";
    echo "<p class = pa >अनिनस्मन्ग्रहणानि अर्थवता चानर्थकेन च तदन्तविधिं प्रयोजयन्ति (प) :</p>";                
    }
    display(3); $inhan=1;
} else {$inhan=0; }
/* inhanpUSAryamNAM zau (6.4.12) */
if (sub(array("in","han","pUzan","aryaman"),array("+"),$sarvanamasthana,0) && !sub(array("ahan","Ahan"),array("+"),array("su!"),0) && $sambuddhi===0 && $inhan===0 && $fo!=="ahan")
{
    $text = two(array("in","han","pUzan","aryaman"),array("Si"),array("In","hAn","pUzAn","aryamAn"),array("Si"),0);
    echo "<p class = sa >By inhanpUSAryamNAM zau (6.4.12) :</p>";
    echo "<p class = sa >इन्हन्पूषार्यम्णां शौ (६.४.१२) :</p>";        
    if (sub(array("vin+"),blank(0),blank(0),0))
    {
    echo "<p class = pa >By 'aninasmangrahaNAni arthavatA cAnarthakena ca tadantavidhiM prayojayanti' (pa) :</p>";
    echo "<p class = pa >अनिनस्मन्ग्रहणानि अर्थवता चानर्थकेन च तदन्तविधिं प्रयोजयन्ति (प) :</p>";                
    }
    display(3); $inhan1=1;
} else { $inhan1=0; }
/* sarvanAmasthAne cAsambuddhau (6.4.8) */ 
if ( arr($text,'/['.flat($ac).'][n][+]/')  && !arr($text,'/['.flat($ac).'][n][+]$/') && !sub(array("Ahan"),blank(0),blank(0),0) && $sarvanamasthana1===1 && $sambuddhi===0 && $inhan===0 && $inhan1===0  )
{
    $text = two($ac,array("n+"),$acdir,array("n+"),0);
    echo "<p class = sa >By sarvanAmasthAne cAsambuddhau (6.4.8) :</p>";
    echo "<p class = sa >सर्वनामस्थाने चासम्बुद्धौ (६.४.८) :</p>";
    echo "<p class = pa >alo'ntyAtpUrva upadhA (1.1.65) </p>";
    echo "<p class = pa >अलोऽन्त्यात्पूर्व उपधा (१.१.६५) </p>";   
    display(3);
}
/* tRjvatkroSTuH (7.1.95), vibhASA tRtIyAdiSvaci (7.1.97) and numaciratRjvadbhAvebhyo nuT pUrvavipratiSedhena (vA 4374) */
if ((sub(array("krozwu"),array("+"),$sarvanamasthana,0)||sub(array("krozwu"),array("+"),$tRtIyAdiSvaci,0) ) && $pada==="pratyaya" && $sambuddhi===0)
{
    if (sub(array("krozwu"),array("+"),$sarvanamasthana,0))
    {
    $text = two(array("krozwu"),array("+"),array("krozwf"),array("+"),0);
    echo "<p class = sa >By tRjvatkroSTuH (7.1.95) :</p>";
    echo "<p class = sa >तृज्वत्क्रोष्टुः (७.१.९५) :</p>";
    display(3);        
    }
    if (sub(array("krozwu"),array("+"),$tRtIyAdiSvaci,0) && $so!=="Am")
    {
    $text = two(array("krozwu"),array("+"),array("krozwf"),array("+"),1);
    echo "<p class = sa >vibhASA tRtIyAdiSvaci (7.1.97) :</p>";
    echo "<p class = sa >विभाषा तृतीयादिष्वचि (७.१.९७) :</p>";
    display(3);        
    }
    $tRcvat=1;
} 
else
{
    $tRcvat=0;
}
if (sub(array("krozwu",),array("+"),array("Am"),0) && $so==="Am")
{ 
    $text = two(array("krozwu"),array("+Am"),array("krozwu"),array("+nAm"),0);
    echo "<p class = sa >numaciratRjvadbhAvebhyo nuT pUrvavipratiSedhena (vA 4374) :</p>";
    echo "<p class = hn >This vArttika mandates a 'nuT' Agama. :</p>";
    echo "<p class = sa >नुमचिरतृज्वद्भावेभ्यो नुट्‌ पूर्वविप्रतिषेधेन (वा ४३७४) :</p>";
    echo "<p class = hn >यह वार्तिक नुट्‌ आगम का विधान करता है ।</p>";
    display(0);  $numacira=1;       
} else { $numacira = 0;}
// atisakhi is pending to code. page 158. Understand and then code.
/* AGo nA'striyAm (7.3.120) */ 
if ($ghi===1 && $so==="wA" && $gender !== "f" && arr($text,'/[iu][+]/') )
{
    if ($bhashitapumska===0)
    {
        $text = two(array("i+","u+"),array("wA"),array("i+","u+"),array("nA"),0);    
    }
    else
    {
        $text = two(array("i+","u+"),array("wA"),array("i+","u+"),array("nA"),1);        
    }
    echo "<p class = sa >By AGo nA'striyAm (7.3.120) :</p>";
    echo "<p class = sa >आङो नाऽस्त्रियाम्‌ (७.३.१२०) :</p>";
    display(3); $AGo = 1;
} else {$AGo = 0; }
/* tRtIyAdiSu bhASitapuMskaM puMvadgAlavasya (7.1.74) */
$ik = array("i","I","u","U","f","F","x","X"); 
$ikyan = array("y","y","v","v","ar","Ar","ar","Ar"); 
$acsup = array_merge($acsup,array("SI","Si"));
/* iko'ci vibhaktau (7.1.73) */
if ( $gender==="n" && arr($text,'/['.flat($ik).'][+]/') && in_array($so,$acsup))
{
    if ($ghi===1 && in_array($so,array("Ne","Nasi!","Nas","Ni")))
    {
    echo "<p class = pa >guNa of gherGiti is overruled by 'num' by vRddhyauttvatRjvadbhAvaguNebhyo num pUrvavipratiSedhena (vA 4373). </p>";
    echo "<p class = pa >घेर्ङिति से प्राप्त गुण का वृद्ध्यौत्त्वतृज्वद्भावगुणेभ्यो नुम्‌ पूर्वविप्रतिषेधेन (वा ४३७३) से बाध होता है ।</p>";        
    display(0); $noghe=1;
    } else {$noghe=0; }
    if (in_array($so,array("Am")))
    {
    echo "<p class = pa >'num' of 'iko'ci vibhaktau' is barred by 'nut' because of 'numaciratRjvadbhAvebhyo nuT pURvavipratiSedhena (vA 4374). </p>";
    echo "<p class = pa >इकोऽचि विभक्तौ से प्राप्त नुमागम का 'नुमचिरतृज्वद्भावेभ्यो नुट्‌ पूर्वविप्रतिषेधेन (वा ४३७४) से बाध होता है ।</p>";        
    display(0);
    }
    elseif ($ghi===1 && $AGo===1)
    {
    echo "<p class = pa >AGo nA'striyAm has barred application of iko'ci vibhaktau. </p>";
    echo "<p class = pa >आङो नाऽस्त्रियाम्‌ से इकोऽचि विभक्तौ का बाध हुआ है ।</p>"; 
    display(0);
    }
    else
    {
        if ($bhashitapumska===1 && in_array($so,$tRtIyAdiSvaci))
        {
            $text = three(array("i","u","f","x"),array("+"),$acsup,array("i","u","f","x"),array("n+"),$acsup,1);    
        }
        else 
        {
            $text = three($ik,array("+"),$acsup,$ik,array("n+"),$acsup,0);            
        }
    echo "<p class = sa >By iko'ci vibhaktau (7.1.73) :</p>";
    echo "<p class = sa >इकोऽचि विभक्तौ (७.१.७३) :</p>";
    display(3);        
    }
 $ikoci=1;
} else { $ikoci = 0; $noghe=0;}

/* lomno'patyeSu bahuSvakAro vaktavyaH (vA 2560) */
// Pending, because it is for taddhita derivation. Right now made a patch.
$bahusup = array("jas","Sas","Bis","Byas","Am","sup");
if (sub(array("Oqulomi"),array("+"),$bahusup,0) && in_array($so,$bahusup))
{
    $text = two(array("Oqulomi"),$bahusup,array("uquloma"),$bahusup,0);
    echo "<p class = sa >By lomno'patyeSu bahuSvakAro vaktavyaH (vA 2560) :</p>";
    echo "<p class = sa >लोम्नोऽपत्येषु बहुष्वकारो वक्तव्यः (वा २५६०) :</p>";
    display(0);
}
/* striyAM ca (7.1.96) */
if ($gender === "f" && sub(array("krozwu"),array("+"),blank(0),0))
{
    $text = two(array("krozwu"),array("+"),array("krozwf"),array("+"),0);
    echo "<p class = sa >striyAM ca (7.1.96) :</p>";
    echo "<p class = sa >स्त्रियां च (७.१.९७) :</p>";        
    display(3);
}

/* aci ra RtaH (7.2.100) */
if (sub(array("tisf","catasf"),array("+"),$acsup,0))
{
    if ($so==="Am" )
    {
    $text = two(array("tisf","catasf"),array("+Am"),array("tisf","catasf"),array("+nAm"),0);
    echo "<p class = sa >numaciratRjvadbhAvebhyo nuT pUrvavipratiSedhena (vA 4374) :</p>";
    echo "<p class = hn >This vArttika mandates a 'nuT' Agama. :</p>";
    echo "<p class = sa >नुमचिरतृज्वद्भावेभ्यो नुट्‌ पूर्वविप्रतिषेधेन (वा ४३७४) :</p>";
    echo "<p class = hn >यह वार्तिक नुट्‌ आगम का विधान करता है ।</p>";        
    }
    else
    {
    $text = two(array("tisf","catasf"),$acsup,array("tisr","catasr"),$acsup,0);
    echo "<p class = sa >By aci ra RtaH (7.2.100) :</p>";
    echo "<p class = sa >अचि र ऋतः (७.२.१००) :</p>";        
    }
    display(0);
}
/* RduzanaspurudaMso&nehasAM ca (7.1.94) */
// displaying the output for dhAtR napuMsaka
if (arr($text,'/[fx][+]$/') && $svamo===1)
{
    echo "<p class = pa >By na lumatAGgasya, anaG is prevented.</p>";
    echo "<p class = pa >न लुमताङ्गस्य से अनङ्‌ का प्रतिषेध होता है ।</p>";
    display(0);     
}
if ( (arr($text,'/[fx][+]/')|| $fo==="uSanas"|| $fo==="purudaMsas" || $fo==="anehas" ) &&  $so==="su!" && $pada==="pratyaya" && $sambuddhi===0 && $svamo===0)
{
    $text = two(array("f","x","uSanas","purudaMsas","anehas"),array("+"),array("an","an","uSanan","purudaMsan","anehan"),array("+"),0);
    echo "<p class = sa >By RduzanaspurudaMso&nehasAM ca (7.1.94) :</p>";
    echo "<p class = sa >ऋदुशनस्पुरुदंसोऽनेहसां च (७.१.९४) :</p>";
    display(3); $Rduza=1; 
} else { $Rduza=0; }
if (  $fo==="uSanas" &&  $so==="su!" && $sambuddhi===1)
{
    $text = two(array("uSanas"),array("+"),array("uSanan"),array("+"),1);
    $text = two(array("uSanas"),array("+"),array("uSana"),array("+"),1);
    echo "<p class = sa >By asa sambuddhau vA'naG nalopazca vA vAcyaH (vA 5037) :</p>";
    echo "<p class = sa >अस्य सम्बुद्धौ वाऽनङ्‌ नलोपश्च वा वाच्यः (वा ५०३७) :</p>";
    display(3); $Rduza=1; 
}
/* Rto GitsarvanAmasthAnayoH (7.3.110) */
if (arr($text,'/[fx][+]/') && ( $sarvanamasthana1===1 || $so==="Ni") && $pada==="pratyaya" && $sambuddhi===0 && $svamo===0)
{
    $text = two(array("f","x"),array("+"),array("ar","al"),array("+"),0);
    echo "<p class = sa >By Rto GisarvanAmasthAnayoH (7.3.110) and uraNraparaH (1.1.51) :</p>";
    echo "<p class = sa >ऋतो ङिसर्वनामस्थानयोः (७.३.११०) तथा उरण्रपरः (१.१.५१) :</p>";
    display(3);
}
/* aptRntRcsvasRnaptRneSTRtvaSTRkSattRhotRpotRprazAstRRNAm (6.4.11) */
// Not coded perfectly for tRn and tRc. naptrAdigrahaNaM vyutpattipakSe niyamArtham is pending.
$svasR = array("svasf","naptf","nezwf","tvazwf","kzattf","hotf","potf","praSAstf");
$excludesvasR = array("pitf","BrAtf","jAmAtf","mantf","hantf");
if (((sub(array("tar+","war+"),blank(0),blank(0),0) && !in_array($fo,$excludesvasR) )|| ($tRcvat===1 )||in_array($fo,$svasR) || $Rduza===1 || in_array($fo,$svasrAdi)) && in_array($so,$sarvanamasthana) && $pada==="pratyaya" && $sambuddhi===0)
{
    $text = three($ac,array("r","n"),array("+"),dirgha($ac),array("r","n"),array("+"),0);
    echo "<p class = sa >By aptRntRcsvasRnaptRneSTRtvaSTRkSattRhotRpotRprazAstRRNAm (6.4.11) :</p>";
    echo "<p class = sa >अप्तृन्तृच्स्वसृनप्तृनेष्टृत्वष्टृक्षत्तृहोतृपोतृप्रशास्तॄणाम्‌ (६.४.११) :</p>";
    display(3);
}
if (arr(array($fo),'/[a][p]$/') && $sarvanamasthana1===1 && $pada==="pratyaya" && $sambuddhi===0)
{
    $text = two(array("ap"),array("+"),array("Ap"),array("+"),0);
    echo "<p class = sa >By aptRntRcsvasRnaptRneSTRtvaSTRkSattRhotRpotRprazAstRRNAm (6.4.11) :</p>";
    echo "<p class = sa >अप्तृन्तृच्स्वसृनप्तृनेष्टृत्वष्टृक्षत्तृहोतृपोतृप्रशास्तॄणाम्‌ (६.४.११) :</p>";
    display(3);
}
/* apo bhi (7.4.48) */
if (arr(array($fo),'/[a][p]$/') && arr($text,'/[a][p][+][B]/') && in_array($so,array("Bis","Byas","ByAm")))
{
    $text = two(array("ap"),array("+B"),array("ad"),array("+B"),0);
    echo "<p class = sa >By apo bhi (7.4.48) :</p>";
    echo "<p class = sa >अपो भि (७.४.४८) :</p>";
    display(3);
}
/* Ato dhAtoH (6.4.140) */
$haha = array("hAhA");
if ($bham === 1 && arr($text,'/[A][+]/') && !in_array($fo,$haha) && $_GET['cond1_2']==="1"  && $Ap===0)
{
    $text = two(array("A"),array("+"),array(""),array("+"),0);
    echo "<p class = sa >By Ato dhAtoH (6.4.140) :</p>";
    echo "<p class = sa >आतो धातोः (६.४.१४०) :</p>";
    display(6);
}
if ($bham === 1 && arr($text,'/[A][+]/') &&  in_array($fo,array('ktvA','SnA')) && $Ap===0)
{
    $text = two(array("A"),array("+"),array(""),array("+"),1);
    echo "<p class = sa >By Ato dhAtoH (6.4.140) :</p>";
    echo "<p class = hn >AtaH iti yogavibhAgAdadhAtorapi AkAralopaH kvacit |</p>";       
    echo "<p class = sa >आतो धातोः (६.४.१४०) :</p>";
    echo "<p class = hn ></p>";       
    display(6);
}
/* na saMyogAdvamantAt (6.4.137) */
if ($bham === 1 && arr($text,'/['.pc('hl').'][vm][a][n][+]/'))
{
    echo "<p class = sa >By na saMyogAdvamantAt (6.4.137) :</p>";
    echo "<p class = sa >न संयोगाद्वमन्तात्‌ (६.४.१३७) :</p>";
    display(3);  $vamanta=1;   
} else {$vamanta=0; }
/* zvayuvamaghonAmataddhite (6.4.133) */
if ($bham === 1 && $taddhita===0 && sub(array("Svan","yuvan","maGavan"),array("+"),blank(0),0))
{
    $text= two(array("Svan","yuvan","maGavan"),array("+"),array("S+u+an","yu+u+an","maGa+u+an"),array("+"),0);
    echo "<p class = sa >By zvayuvamaghonAmataddhite (6.4.133) :</p>";
    echo "<p class = sa >श्वयुवमघोनामतद्धिते (६.४.१३३) :</p>";
    display(3); $samp=array_merge($samp,array(1));
}
/* vAha UTh (6.4.132) */
if ($bham===1 && sub(array("vAh"),array("+"),blank(0),0) )
{   
    $text = one(array("vAh+"),array("U+Ah+"),0);
    echo "<p class = sa >By vAha UTh (6.4.132) :</p>";
    echo "<p class = sa>वाह ऊठ्‌ (६.४.१३२) :</p>";
    display(3); $samp=array_merge($samp,array(1));
}
/* vasoH samprasAraNam (6.4.131) */
if ($bham===1 && sub(array("sedivasu!","vasu!"),array("+"),blank(0),0) && $vasu===1)
{   
    $text = one(array("sedivasu!+","vasu!+"),array("sed+u+asu!+","+u+asu!+"),0);
    echo "<p class = sa >By vasoH samprasAraNam (6.4.131) :</p>";
    if (sub(array("sed+u+asu!+"),blank(0),blank(0),0))
    {
    echo "<p class = hn >Even though the iDAgama is antaraGga, it doesnt hold in samprasAraNa by 'akRtavyUhAH pANinIyAH'.</p>";
    }
    echo "<p class = sa>वसोः सम्प्रसारणम्‌ (६.४.१३१) :</p>";
    if (sub(array("sed+u+asu!+"),blank(0),blank(0),0))
    {
    echo "<p class = hn >अन्तरङ्गोऽपि इडागमः सम्प्रसारणविषये न प्रवर्तते, 'अकृतव्यूहाः' इति परिभाषया ।</p>";
    }
    display(3); $samp=array_merge($samp,array(1));
}
/* samprasAraNAcca (6.1.108) */
if ( in_array(1,$samp) && sub(array("+i+","+u+"),$ac,blank(0),0) )
{   
    $text = two(array("+i+","+u+"),$ac,array("+i+","+u+"),blank(count($ac)),0);
    echo "<p class = sa >By samprasAraNAcca (6.1.108) :</p>";
    echo "<p class = sa>सम्प्रसारणाच्च (६.१.१०८) :</p>";
    display(0); 
} 
/* na samprasAraNe samprasAraNam (6.2.37) */
if ( in_array(1,$samp) && arr($text,'/[yv]/') )
{   
    echo "<p class = sa >By na samprasAraNe samprasAraNam (6.2.37) :</p>";
    echo "<p class = sa>न सम्प्रसारणे सम्प्रसारणम्‌ :</p>";
    display(0); 
}
/* napuMsakAcca (7.1.19) */
if ( $gender==="n" && in_array($so,array("O","Ow"))) 
{
    $text = two(array("+"),array("Ow","O",),array("+"),array("SI","SI"),0);
    echo "<p class = sa >By napuMsakAcca (7.1.19) :</p>";
    echo "<p class = sa >नपुंसकाच्च (७.१.१९) :</p>";
    display(3); $napuMsakAcca=1;
} else { $napuMsakAcca=0; }
/* auGaH zyAM pratiSedho vAcyaH (vA) */
if (arr($text,'/[+][SI]/') && in_array($so,array("O","Ow")))
{
    echo "<p class = pa >By auGaH zyAM pratiSedho vAcyaH (vA) :</p>";
    echo "<p class = pa >औङः श्यां प्रतिषेधो वाच्यः (वा) :</p>";
    display(0); $auGazyA = 1;
} else { $auGazyA = 0; }
/* paddannomAshRnnizasanyUSandoSanyakaJChakannudannAsaJChasprabhRtiSu (6.1.63) special case kakuddoSaNI */
if (sub(array("doz"),array("+"),array("SI"),0) && in_array($so,array("O","Ow")))
{
    $text = two(array("doz"),array("+"),array("dozan"),array("+"),0);
    echo "<p class = sa >By paddannomAshRnnizasanyUSandoSanyakaJChakannudannAsaJChasprabhRtiSu (6.1.63) :</p>";
    echo "<p class = hn >prabhRtigrahaNaM prakArArtham. tathA ca auGaH zyAmapi dozannAdezaH. </p>";
    echo "<p class = sa >पद्दन्नोमास्‍हृन्निशसन्यूषन्दोषन्यकञ्छकन्नुदन्नासञ्छस्प्रभृतिषु (६.१.६३) :</p>";
    echo "<p class = hn >प्रभृतिग्रहणं प्रकारार्थम्‌ । तथा च औङः श्यामपि दोषन्नादेशः ।</p>";
    display(0);
}

/* bhasya (6.4.129) and allopo'naH (6.4.134) and vibhASA GizyoH (6.4.236) and na saMyogAdvamantAt (6.4.137) */        
if ($bham === 1 && $vamanta===0 && arr($text,'/[a][n][+]/') && $shat===0 ) 
{
    if ( $so==="Ni" || $napuMsakAcca===1 )
    {
    $text = one(array("an+"),array("n+"),1);
    echo "<p class = sa >By allopo'naH (6.4.134) and vibhASA GizyoH (6.4.236) :</p>";
    echo "<p class = sa >अल्लोपोऽनः (६.४.१३४) तथा विभाषा ङिश्योः (६.४.२३६) :</p>";
    display(6);    
    }
    else
    {
    $text = one(array("an+"),array("n+"),0);
    echo "<p class = sa >By allopo'naH (6.4.134) :</p>";
    echo "<p class = sa >अल्लोपोऽनः (६.४.१३४) :</p>";
    display(6);    
    } $allopo=1;
} else {$allopo=0; }
/* ho hanterJNinneSu (7.3.54) */
// Jit and Nit pending. nakAra done.
if ( sub(array("h"),array("n"),blank(0),0) && arr(array($fo),'/[h][a][n]/') && !in_array($fo,array("ahan","dIrGAhan")))
{
    $text = two(array("h"),array("n"),array("G"),array("n"),0);
    echo "<p class = sa >By ho hanterJNinneSu (7.3.54) :</p>";
    echo "<p class = sa >हो हन्तेर्ञ्णिन्नेषु (७.३.५४) :</p>";
    display(3); $hohante=1;
} else { $hohante=0; }
/* jasi ca (7.3.109) */
if (arr($text,'/[aiufx][+][j]/') && $so==="jas")
{
    $text = two(array("a","i","u","f","x"),array("+"),array("a","e","o","ar","al"),array("+"),0);
    echo "<p class = sa >By jasi ca (7.3.109) :</p>";
    echo "<p class = sa >जसि च (७.३.१०९) :</p>";
    display(3);
}
/* trestrayaH (7.1.53) */
if (arr($text,'/[t][r][i][+][A][m]$/') && !sub(array("stri"),array("+"),blank(0),0) && $so==="Am" )
{
    $text = two(array("tri"),array("Am"),array("traya"),array("Am"),0);
    echo "<p class = sa >By trestrayaH (7.1.53) :</p>";
    echo "<p class = sa >त्रेस्त्रयः (७.१.५३) :</p>";
    display(3);
}
if (arr($text,'/[t][r][i][+][A][m]$/') && !sub(array("stri"),array("+"),blank(0),0) && $so==="Am" && $fo!=="tri")
{
    $text = two(array("tri"),array("Am"),array("traya"),array("Am"),1);
    echo "<p class = sa >By trestrayaH (7.1.53) and 'gauNatve tu neti kecit' :</p>";
    echo "<p class = sa >त्रेस्त्रयः (७.१.५३) तथा 'गौणत्वे तु नेति केचित्‌' :</p>";
    display(3);
}
/* adasa au sulopazca (7.2.107) */
if (sub(array("adas"),array("+"),array("su!"),0) && $so==="su!" && $fo==="adas")
{
    $text = two(array("adas"),array("su!"),array("adaO"),array(""),0);
    echo "<p class = sa >By adasa au sulopazca (7.2.107) :</p>";
    echo "<p class = sa >अदस औ सुलोपश्च (७.२.१०७) :</p>";
    display(3);
}
/* tyadAdInAmaH (7.2.102) */
// It is not possible to decide the prAdhAnya or gauNatva because it depends on speaker's choice.
if (sub(array("dvi"),array("+"),blank(0),0) && in_array($so,$sup) && ends(array($fo),array("dvi"),1) && $_GET['cond1_3_2']==="2" && $idamoma===0 && $idamoma1===0 && $svamo===0)
{
    $text = one(array("dvi"),array("dv+a"),0);
    echo "<p class = sa >By tyadAdInAmaH (7.2.102) :</p>";
    echo "<p class = hn >Only the words till 'dvi' are included. (vA 4468) :</p>";
    echo "<p class = sa >त्यदादीनामः (७.२.१०२) :</p>";
    echo "<p class = hn >द्विपर्यन्तानामेवेष्टिः (वा ४४६८) :</p>";
    display(3);
}
$tyadadinamah = array("dv+a","tya+a","ta+a","ya+a","eta+a","ida+a","ada+a","eka+a","idaka+a");
$tyadadinamah1 = array("dva","tya","ta","ya","eta","ida","ada","eka","idaka");
if (sub($tyadadi,array("+"),blank(0),0) && !sub(array("dvi"),array("+"),blank(0),0) && in_array($so,$sup) && in_array($fo,$tyadadi) && $idamoma===0 && $idamoma1===0 && $svamo===0)
{
    $text = one($tyadadi,$tyadadinamah,0);
    echo "<p class = sa >By tyadAdInAmaH (7.2.102) :</p>";
    echo "<p class = hn >Only the words till 'dvi' are included. (vA 4468) :</p>";
    echo "<p class = sa >त्यदादीनामः (७.२.१०२) :</p>";
    echo "<p class = hn >द्विपर्यन्तानामेवेष्टिः (वा ४४६८) :</p>";
    display(3);
    $text = one($tyadadinamah,$tyadadinamah1,0);
    echo "<p class = sa >By ato guNe (6.1.96) :</p>";
    echo "<p class = sa >अतो गुणे (६.१.९६) :</p>";
    display(0);    

}
/* ajAdyataSTAp (4.1.4) */
if ($gender==="f" && $Ap===1 && sub(array("ida","tya","ta","ya","eta","ada"),array("+"),blank(0),0) && in_array($fo,array("idam","idakam","tyad","tad","yad","etad","adas")) && in_array($so,$sup))
{
    $text = one(array("ida+","tya+","ta+","ya+","eta+","ada+"),array("idaA+","tyaA+","taA+","yaA+","etaA+","adaA+"),0);
    echo "<p class = sa >By ajAdyataSTAp (4.1.4) :</p>";
    echo "<p class = sa >अजाद्यतष्टाप्‌ (४.१.४) :</p>";
    display(3);
}
/* akaH savarNe dIrghaH (6.1.101) */
if ($gender==="f" && $Ap===1 && sub(array("idaA","tyaA","taA","yaA","etaA","adaA"),array("+"),blank(0),0) && in_array($fo,array("idam","idakam","tyad","tad","yad","etad","adas")) && in_array($so,$sup))
{
    $text = one(array("idaA","tyaA","taA","yaA","etaA","adaA"),array("idA+","tyA","tA","yA","etA","adA"),0);
    echo "<p class = sa >By akaH savarNe dIrghaH (6.1.101) :</p>";
    echo "<p class = sa >अकः सवर्णे दीर्घः (६.१.१०१) :</p>";
    display(3);
}
/* adasa au sulopazca (7.2.107) */
if (sub(array("adakas"),array("+"),array("su!"),0) && $so==="su!" && $fo==="adakas")
{
    $text = two(array("adakas"),array("su!"),array("adakaO"),array(""),1);
    $text = two(array("adakas"),array("su!"),array("asukas"),array(""),0);
    echo "<p class = sa >By adasa au sulopazca (7.2.107) and autvapratiSedhaH sAkackasya vA vaktavyaH sAdutvaM ca (vA 4482) :</p>";
    echo "<p class = sa >अदस औ सुलोपश्च (७.२.१०७) तथा औत्वप्रतिषेधः साकच्कस्य वा वक्तव्यः सादुत्वं च (वा ४४८२) :</p>";
    display(3);
}
/* tadoH saH sAvanantyayoH (7.2.106) */
$tyadadinamah3 = array("dva","tya","eta","ta","ida","ada","eka","idaka","tyA","tA","etA");
$tyadadinamah2 = array("dva","sya","eza","sa","isa","asa","eka","isaka","syA","sA","esA");
if (sub($tyadadinamah3,array("su!"),blank(0),0) && $sarvafinal!==0)
{
    $text = two($tyadadinamah3,array("su!"),$tyadadinamah2,array("su!"),0);
    echo "<p class = sa >By tadoH saH sAvanantyayoH (7.2.106) :</p>";
    echo "<p class = sa >तदोः सः सावनन्त्ययोः (७.२.१०६) :</p>";
    display(3);
}
if (sub(array("adaO","adakaO"),blank(0),blank(0),0))
{
    $text = one(array("adaO","adakaO"),array("asaO","asakaO"),0);
    $text = one(array("adakas"),array("asukas"),0);
    echo "<p class = sa >By tadoH saH sAvanantyayoH (7.2.106) :</p>";
    echo "<p class = sa >तदोः सः सावनन्त्ययोः (७.२.१०६) :</p>";
    display(3);
}
/* sarvanAmnaH smai (7.1.14) */  
if (arr($text,'/[a][+][N][e]/') && $so === "Ne" && $sarvafinal!==0)
{
    if ($sarvafinal===2)
    {
    $text = last(array("Ne"),array("smE"),1);        
    }
    else
    {
    $text = last(array("Ne"),array("smE"),0);        
    }
    echo "<p class = sa >By sarvanAmnaH smai (7.1.14) :</p>";
    echo "<p class = sa >सर्वनाम्नः स्मै (७.१.१४) :</p>";
    display(3); $sarva =1;
} else { $sarva = 0; }
/* GasiGyoH smAtsminau (7.1.15) */ 
if (arr($text,'/[a][+][N]/') && $pada=== "pratyaya" && in_array($so,array("Nasi!","Ni")) && $sarvafinal!==0)
{
    if ($sarvafinal===2)
    {
    $text = last(array("Ni","Nasi!"),array("smin","smAt"),1);        
    }
    else
    {
    $text = last(array("Ni","Nasi!"),array("smin","smAt"),0);        
    }
    echo "<p class = sa >By GasiGyoH smAtsminau (7.1.15) :</p>";
    echo "<p class = sa >ङसिङ्योः स्मात्स्मिनौ (७.१.१५) :</p>";
    display(3);
    $sarva1 =1;
} else { $sarva1 = 0; }
/* pUrvAdibhyo navabhyo vA (7.1.16) */ 
if (ends(array($fo),array("pUrva","para","avara","dakziRa","uttara","apara","aDara","sva","antara"),1) && $pada=== "pratyaya" && in_array($so,array("Nasi!","Ni")) && $sarvafinal!==0)
{
    $text = last(array("smin","smAt"),array("Ni","Nasi!"),1);
    echo "<p class = sa >By pUrvAdibhyo navabhyo vA (7.1.16) :</p>";
    echo "<p class = sa >पूर्वादिभ्यो नवभ्यो वा (७.१.१६) :</p>";
    display(3);
    $sarva1 =1;
} elseif ($sarva1 ===1) 
    { $sarva1 = 1; }
    else
    {
        $sarva1 = 0;
    }
/* TAGasiGasAminAtsyAH (7.1.12) */
if ( in_array($so,array("wA","Nas")) && arr($text,'/[a][+][wN]/'))
{
    $text = one(array("a+wA","a+Nas"),array("a+ina","a+sya"),0);
    $text = two(array("jaras"),array("ina","sya"),array("jaras"),array("wA","Nas"),0);
    echo "<p class = sa >By TAGasiGasAminAtsyAH (7.1.12) :</p>";
    echo "<p class = sa >टाङसिङसामिनात्स्याः (७.१.१२) :</p>";
    display(3);
    $wa = 1;
} else { $wa =0; }
if (arr($text,'/[a][+][N]/') && in_array($so,array("Nasi!")))
{
    $text = one(array("a+Nasi!"),array("a+At"),0);
    $text = two(array("jaras"),array("At"),array("jaras"),array("Nasi!"),0);
    echo "<p class = sa >By TAGasiGasAminAtsyAH (7.1.12) :</p>";
    echo "<p class = sa >टाङसिङसामिनात्स्याः (७.१.१२) :</p>";
    display(3);
    $wa1 = 1;
} else { $wa1 =0; }
/* Ami sarvanAmnaH suT (7.1.15) */
if ( $so === "Am" && $sarvafinal !== 0)
{
    if ( $sarvafinal === 2)
    {
    $text = last(array("Am"),array("sAm"),1);      
    }
    else
    {
    $text = last(array("Am"),array("sAm"),0);        
    }
    echo "<p class = sa >By Ami sarvanAmnaH suT (7.1.15) :</p>";
    echo "<p class = sa >आमि सर्वनाम्नः सुट्‌ (७.१.१५) :</p>";
    display(3); $sut=1;
} else { $sut=0;}
/* sAma Akam (7.1.33) */
if (sub(array("asma","yuzma"),array("+"),array("sAm"),0) && in_array($so,array("Am")))
{
    $text = one(array("asma+sAm","yuzma+sAm"),array("asma+Akam","yuzma+Akam",),0);
    echo "<p class = sa >By sAma Akam (7.1.33) :</p>";
    echo "<p class = sa >साम आकम्‌ (७.१.३३) :</p>";
    display(3); $sAmaAkam=1;
} else { $sAmaAkam=0; }
/* dvitIyATaussvenaH (2.4.34) */
if (sub(array("ida+","eta+","idaka+","idA+",),blank(0),blank(0),0) && in_array($fo,array("idam","etad","idakam")) && $anvadesha===1 && in_array($so,array("am","Ow","Sas","wA","os")))
{
    $text = one(array("ida+","eta+","idaka+","idA+",),array("ena+","ena+","ena+","enA+"),0);
    echo "<p class = sa >By dvitIyATaussvenaH (2.4.34) :</p>";
    echo "<p class = sa >द्वितीयाटौस्स्वेनः (२.४.३४) :</p>";
    display(0);
}
/* idamo'nvAdeze'zanudAttastRtIyAdau (2.4.32) */
if (sub(array("idaka+"),blank(0),blank(0),0) && $fo==="idakam" && $anvadesha===1 && in_array($so,$tRtIyAdi))
{
    $text = one(array("idaka+"),array("a+"),0);
    echo "<p class = sa >By idamo'nvAdeze'zanudAttastRtIyAdau (2.4.32) :</p>";
    echo "<p class = sa >इदमोऽन्वादेशेऽशनुदात्तस्तृतीयादौ (२.४.३२) :</p>";
    display(0);
}
/* nAnarthake'lo'ntyavidhiranabhyAsavikAre (vA 490) */
// Pending. Not clear to me.
/* Adyantavadekasmin */
// paribhASA. Difficult to code.

/* goto Nit (7.1.90) and oto Niditi vAcyam (vA 5035) */
if (sub(array("o+"),$sarvanamasthana,blank(0),0) && !in_array($fo,array("am","Sas")))
{   
    if (sub(array("go+"),$sarvanamasthana,blank(0),0))
    {$Nidvat1 = 1;
    echo "<p class = pa >By goto Nit (7.1.90) :</p>";
    echo "<p class = pa >गोतो णित्‌ (७.१.९०) :</p>";        
    display(3);
    }
    elseif (!preg_match('/[o]$/',$fo))
    {$Nidvat1 = 0;
    echo "<p class = pa >oto Niditi vAcyam (vA 5035) is overruled by 'okArAntAdvihitaM sarvanAmasthAnam'.</p>";
    echo "<p class = pa >ओकारान्ताद्विहितं सर्वनामस्थानम्‌ इति व्याख्यानात्‌ ओतो णिदिति वाच्यमित्यस्य प्रवृत्तिर्नास्ति ।</p>";
    display(0);
    }
    else
    {$Nidvat1 = 1;
    echo "<p class = pa >By oto Niditi vAcyam (vA 5035) :</p>";
    echo "<p class = pa >ओतो णिदिति वाच्यम्‌ (वा ५०३५) :</p>";
    display(3);
    }
} else {$Nidvat1 =0; }
/* aco JNiti (7.2.115) */
if ((arr($text,'/['.flat($ac).'][+][JR]/')||arr($text,'/[a][+][*][JR]$/')||$Nidvat===1||$Nidvat1===1) && $pada==="pratyaya" )
{ 
    $text = two($ac,array("+"),vriddhi($ac),array("+"),0);
    echo "<p class = sa >By aco JNiti (7.2.115) :</p>";
    echo "<p class = sa >अचो ञ्णिति (७.२.११५) :</p>";
    display(3);
}

/* RRta iddhAtoH (7.1.100) */
$kRR = array("kF","tF","gF");
if (arr($text,'/[ktg][F][+]/'))
{
    $dhatu = 1;
}
if (arr($text,'/[ktg][F][+]/'))
{
    $text = two(array("F"),array("+"),array("ir"),array("+"),1);
    echo "<p class = sa >By RRta iddhAtoH (7.1.100) :</p>";
    echo "<p class = sa >ॠत इद्धातोः (७.१.१००) :</p>";
    display(3);    
}
if ( $dhatu === 1 && sub(array("F"),array("+"),blank(0),0) && !arr($text,'/[ktg][F][+]/') )
{
    $text = two(array("F"),array("+"),array("ir"),array("+"),0);
    echo "<p class = sa >By RRta iddhAtoH (7.1.100) :</p>";
    echo "<p class = sa >ॠत इद्धातोः (७.१.१००) :</p>";
    display(3);
}
/* ambArthanadyorhrasvaH (7.3.103) */
if (sub(array("ambAqA","ambAlA","ambikA"),array("+"),blank(0),0) && $sambuddhi===1 && $so==="su!")
{
    echo "<p class = pa >asaMyuktA ye DalakAstadvatAM hrasvo na (vA 4592) :</p>";
    echo "<p class = pa >असंयुक्ता ये डलकास्तद्वतां ह्रस्वो न (वा ४५९२) :</p>";
    display(0);
}
if ($sambuddhi===1 &&  ($nadi===1 || ends(array($fo),array("ambA","akkA","alakA"),1)) && $so==="su!")
{
    $text = two(array("A","I","U"),array("+"),array("a","i","u"),array("+"),0);
    echo "<p class = sa >By ambArthanadyorhrasvaH (7.3.103) :</p>";
    echo "<p class = sa >अम्बार्थनद्योर्ह्रस्वः :</p>";
    display(3); 
    $amba = 1;
} else { $amba = 0; }
/* idudbhAym (7.3.117) */
if ($nadi!==0 && arr($text,'/[iu][+][N][i]$/'))
{
    $text = two(array("i","u"),array("+Ni"),array("i","u"),array("+Am"),1);
    echo "<p class = sa >By idudbhAym (7.3.117) :</p>";
    echo "<p class = sa >इदुद्भ्याम्‌ (७.३.११७) :</p>";
    display(3);    
}
/* GerAmnadyAmnIbhyaH (7.3.116) */
if (arr($text,'/[n][I][+]/') && $pada=== "pratyaya" && $so==="Ni")
{
    $text = two(array("+"),array("Ni"),array("+"),array("Am"),0);
    echo "<p class = sa >By GerAmnadyAmnIbhyaH (7.3.116) :</p>";
    echo "<p class = sa >ङेराम्नद्याम्नीभ्यः (७.३.११६) :</p>";
    display(3);
} 
if ($nadi!==0 && $pada=== "pratyaya" && $so==="Ni")
{
    if ($nadi===1)
    {
    $text = two(array("I","U"),array("+Ni"),array("I","U"),array("+Am"),0);        
    }
    else
    {
    $text = two(array("I","U"),array("+Ni"),array("I","U"),array("+Am"),1);        
    }
    echo "<p class = sa >By GerAmnadyAmnIbhyaH (7.3.116) :</p>";
    echo "<p class = sa >ङेराम्नद्याम्नीभ्यः (७.३.११६) :</p>";
    display(3);
}
if ($Ap===1 && $pada=== "pratyaya" && $so==="Ni")
{
    $text = two(array("A"),array("+Ni"),array("A"),array("+Am"),0);
    echo "<p class = sa >By GerAmnadyAmnIbhyaH (7.3.116) :</p>";
    echo "<p class = sa >ङेराम्नद्याम्नीभ्यः (७.३.११६) :</p>";
    display(3);
}
/* aut (7.3.118) */
if (arr($text,'/[iu][+][N][i]$/') && $so==="Ni" && $pada==="pratyaya")
{
    $text = two(array("i","u",),array("Ni"),array("i","u"),array("O"),0);
    echo "<p class = sa >By aut (7.3.118) :</p>";
    echo "<p class = sa >औत्‌ (७.३.११८) :</p>";
    display(3);
}
/* ANnadyAH (7.3.112)  */ 
// The method for finding Git is coarse. needs fine tuning. 
if ($nadi!==0 && arr($text,'/[+][N]/') && in_array($so,array("Ne","Nasi!","Nas",)))
{
    if ($nadi===1)
    {
    $text = two(array("+"),array("N"),array("+"),array("A+N"),0);        
    }
    else
    {
    $text = two(array("+"),array("N"),array("+"),array("A+N"),1);        
    }
    echo "<p class = sa >By ANnadyAH (7.3.112) :</p>";
    echo "<p class = sa >आण्नद्याः (७.३.११२) :</p>";
    display(3); $ANnadyAH =1;
} else {$ANnadyAH = 0; } 
/* acca gheH (7.3.119) */ 
if ($ghi===1 && in_array($so,array("Ni")))
{
    $text = two(array("i","u"),array("O"),array("a","a"),array("O"),0);
    echo "<p class = sa >By acca gheH (7.3.119) :</p>";
    echo "<p class = sa >अच्च घेः (७.३.११९) :</p>";
    display(3);
}
/* gherGiti (7.3.111) */
if ($ghi===1 && $noghe===0 && arr($text,'/[iu][+]/') && in_array($so,array("Ne","Nasi!","Nas")))
{
    $text = two(array("i","u"),array("Ne","Nasi!","Nas"),array("e","o"),array("Ne","Nasi!","Nas"),0);
    echo "<p class = sa >By gherGiti (7.3.111) :</p>";
    echo "<p class = sa >घेर्ङिति (७.३.१११) :</p>";
    display(3);
}
/* auGaH ApaH (7.1.18) */
if ($Ap===1 && arr($text,'/[A][+][O]$/') && in_array($so,array("O")))
{
    $text = two(array("A+"),array("O"),array("A+"),array("SI",),0);
    echo "<p class = sa >By auGaH ApaH (7.1.18) :</p>";
    echo "<p class = sa >औङ आपः (७.१.१८) :</p>";
    display(3);
}
if ($Ap===1 && arr($text,'/[A][+][O][w]$/') && in_array($so,array("Ow")))
{
    $text = two(array("A+"),array("Ow"),array("A+"),array("SI"),0);
    echo "<p class = sa >By auGaH ApaH (7.1.18) :</p>";
    echo "<p class = sa >औङ आपः (७.१.१८) :</p>";
    display(3);
}
/* sambuddhau ca (7.3.106) */
if ($Ap===1 && $sambuddhi===1 && in_array($so,array("su!")))
{
    $text = two(array("A+"),array("su!"),array("e+"),array("su!"),0);
    echo "<p class = sa >By sambuddhau ca (7.3.106) :</p>";
    echo "<p class = sa >सम्बुद्धौ च (७.३.१०६) :</p>";
    display(3);
}
/* AGi cApaH (7.3.105) */
if ($Ap===1  && in_array($so,array("wA","os")))
{
    $text = two(array("A+"),array("wA","os"),array("e+"),array("wA","os"),0);
    echo "<p class = sa >By AGi cApaH (7.3.105) :</p>";
    echo "<p class = sa >आङि चापः (७.३.१०५) :</p>";
    display(3);
}
/* vibhASA diksamAse bahuvrIhau (1.1.28) */
if ($Ap===1  && in_array($so,array("Ne","Nas","Nasi!","Ni")) && in_array(array($fo),$diksamAsa))
{
    echo "<p class = pa >vibhASA diksamAse bahuvrIhau (1.1.28) </p>";
    echo "<p class = pa >विभाषा दिक्समासे बहुव्रीहौ (१.१.२८) </p>";
    display(0); $sarvafinal = 2;
}
/* sarvanAmnaH syADDhrasvazca (7.3.114) */ 
$sarvanamastri = array("sarvA","viSvA","uBA","uBayA","atarA","atamA","anyA","anyatarA","itarA","tvA","nemA","simA","pUrvA","parA","avarA","dakziRA","uttarA","aparA","aDarA","svA","antarA","tyA","tA","yA","etA","idA","adA","ekA","dvA","kA","idakA");
$sarvanamastri1 = array("sarva","viSva","uBa","uBaya","atara","atama","anya","anyatara","itara","tva","nema","sima","pUrva","para","avara","dakziRa","uttara","apara","aDara","sva","antara","tya","ta","ya","eta","ida","ada","eka","dva","ka","idaka");
if ($Ap===1 && $sarvafinal !==0 && in_array($so,array("Ne","Nas","Ni")) && ( ends(array($fo),$sarvanama,1)||in_array($fo,array("idam")) ))
{ 
    if ( $sarvafinal === 2)
    {
    $text = one($sarvanamastri,$sarvanamastri1,0);
    $text = last(array("Ne","Nas","Am"),array("syA+Ne","syA+Nas","syA+Am"),1);        
    $text = one(array("tIyA+syA+Ne","tIyA+syA+Nas","tIyA+syA+Ni"),array("tIya+syA+Ne","tIya+syA+Nas","tIya+syA+Ni"),0);            
    }
    else
    {
    $text = one($sarvanamastri,$sarvanamastri1,0);
    $text = last(array("Ne","Nas","Am"),array("syA+Ne","syA+Nas","syA+Am"),0);        
    $text = one(array("tIyA+syA+Ne","tIyA+syA+Nas","tIyA+syA+Ni"),array("tIya+syA+Ne","tIya+syA+Nas","tIya+syA+Ni"),0);            
    }
    echo "<p class = sa >By sarvanAmnaH syADDhrasvazca (7.3.114) :</p>";
    echo "<p class = sa >सर्वनाम्नः स्याड्ढ्रस्वश्च (७.३.११४) :</p>";
    display(3); $syaddhrasva = 1;
} else { $syaddhrasva = 0; }
if ($Ap===1  && $sarvafinal !==0 && in_array($so,array("Nasi!")) && ( ends(array($fo),$sarvanama,1) ))
{
    if ( $sarvafinal === 2)
    {
    $text = one($sarvanamastri,$sarvanamastri1,0);
    $text = last(array("Nasi!"),array("syA+Nasi!"),1);        
    $text = one(array("tIyA+syA+Nasi!"),array("tIya+syA+Nasi!"),1);        
    }
    else
    {
    $text = one($sarvanamastri,$sarvanamastri1,0);
    $text = last(array("Nasi!"),array("syA+Nasi!"),0);        
    $text = one(array("tIyA+syA+Nasi!"),array("tIya+syA+Nasi!"),0);        
    }
    echo "<p class = sa >By sarvanAmnaH syADDhrasvazca (7.3.114) :</p>";
    echo "<p class = sa >सर्वनाम्नः स्याड्ढ्रस्वश्च (७.३.११४) :</p>";
    display(3); $syaddhrasva1 = 1;
} else {$syaddhrasva1=0; }
/* yADApaH (7.3.113) */
if ($Ap===1 && in_array($so,array("Ne","Nas","Ni")) && $syaddhrasva===0)
{
    $text = three(array("A+"),array(""),array("Ne","Nas","Ni"),array("A+"),array("yA+"),array("Ne","Nas","Ni"),0);
    $text = one(array("syA+yA+"),array("syA+"),0);
    echo "<p class = sa >By yADApaH (7.3.113) :</p>";
    echo "<p class = sa >याडापः (७.३.११३) :</p>";
    display(3);
}
if ($Ap===1 && in_array($so,array("Nasi!")) && $syaddhrasva1===0 )
{
    $text = three(array("A+"),array(""),array("Nasi!"),array("A+"),array("yA+"),array("Nasi!"),0);
    $text = one(array("syA+yA+"),array("syA+"),0);
    echo "<p class = sa >By yADApaH (7.3.113) :</p>";
    echo "<p class = sa >याडापः (७.३.११३) :</p>";
    display(3);
}
/* hali lopaH (7.2.113) */
if (sub(array("ida+","idA+"),$hl,blank(0),0) && $fo==="idam" && !in_array($so,array("jas","Ow","O","Sas")))
{
    $text = one(array("ida+","idA+",),array("a+","A+",),0);
    echo "<p class = sa >By hali lopaH (7.2.113) :</p>";
    echo "<p class = sa >हलि लोपः (७.२.११३) :</p>";
    display(3);
}
/* nedamadasorakoH (7.1.11) */
if (arr($text,'/^[a][+]/') && $so==="Bis" && in_array($fo,array("idam","idakam","adas")))
{
    echo "<p class = sa >By nedamadasorakoH (7.1.11) :</p>";
    echo "<p class = sa >नेदमदसोरकोः (७.२.११) :</p>";
    display(3); $nedamadas=1;
} else { $nedamadas=0; }
/* anApyakaH (7.2.112) */
if (sub(array("ida+","idA+"),blank(0),blank(0),0) && $fo==="idam" && in_array($so,$tRtIyAdiSvaci))
{
    $text = one(array("ida+","idA+"),array("ana+","anA+"),0);
    echo "<p class = sa >By anApyakaH (7.2.112) :</p>";
    echo "<p class = sa >अनाप्यकः (७.२.११२) :</p>";
    display(3);
}
/* jasaH zI (7.1.17) */ 
if (arr($text,'/[a][+]/') && $pada=== "pratyaya" && $so === "jas" && ends(array($fo),$sarvanama,1) && $nojas===0 && !sub(array("ida"),blank(0),blank(0),0) && $sarvafinal!==0 )
    {
    if ($sarvafinal===2)
    {
    $text = last(array("jas"),array("SI"),1);        
    }
    else
    {
    $text = last(array("jas"),array("SI"),0);        
    }
    echo "<p class = sa >By jasaH zI (7.1.17) :</p>";
    echo "<p class = sa >जसः शी (७.१.१७) :</p>";
    echo "<p class = hn >N.B. anekAlzitsarvasya mandates sarvAdeza :</p>";
    echo "<p class = hn >अनेकाल्शित्सर्वस्य से सर्वादेश होता है । :</p>";
    display(3);
    $sarva2 =1;
} else { $sarva2 = 0; }
/* pUrvaparAvaradakSiNottarAparAdharANi vyavasthAyAmasaJjJAyAm (1.1.34) */
if ($so === "jas" && $purvapara===1 && in_array($fo,array("pUrva","para","avara","dakziRa","uttara","apara","aDara",)))
{
    $text = last(array("SI"),array("jas"),1);
    echo "<p class = sa >By pUrvaparAvaradakSiNottarAparAdharANi vyavasthAyAmasaJjJAyAm (1.1.34) :</p>";
    echo "<p class = sa >पूर्वपरावरदक्षिणोत्तरापराधराणि व्यवस्थायामसंज्ञायाम्‌ (७.१.९) :</p>";
    display(0); $purva=1;
} else {$purva=0;}
/* svamajJAtidhanAkhyAyAm (1.1.35) */
if ($so === "jas" && $sva===1 &&  in_array($fo,array("sva",)))
{
    $text = last(array("SI"),array("jas"),1);
    echo "<p class = sa >By svamajJAtidhanAkhyAyAm (1.1.35) :</p>";
    echo "<p class = sa >स्वमज्ञातिधनाख्यायाम्‌ (१.१.३५) :</p>";
    display(0); 
}
/* antaraM bahiryogopasaMvyAnayoH (1.1.36) */
if ($so === "jas" && $antara===1 && in_array($fo,array("antara",)))
{
    $text = last(array("SI"),array("jas"),1);
    echo "<p class = sa >By antaraM bahiryogopasaMvyAnayoH (1.1.36) :</p>";
    echo "<p class = sa >अन्तरं बहिर्योगोपसंव्यानयोः (१.१.३६) :</p>";
    display(0); 
}
/* vibhASA jasi */
/* na bahuvrIhau */
/* tRtIyAsamAse */
/* dvandve ca */
/* prathamacaramatayAlpArdhakatipayanemAzca (1.1.33) */
if ($so === "jas" && in_array($fo,array("praTama","carama","alpa","arDa","katipaya")))
{
    $text = last(array("jas"),array("SI"),1);
    echo "<p class = sa >By prathamacaramatayAlpArdhakatipayanemAzca (1.1.33) :</p>";
    echo "<p class = sa >प्रथमचरमतयाल्पार्धकतिपयनेमाश्च (१.१.३३) :</p>";
    display(0); $prath=1;
} else {$prath=0;}    
if ($so === "jas" && in_array($fo,array("nema")))
{
    $text = last(array("SI"),array("jas"),1);
    echo "<p class = sa >By prathamacaramatayAlpArdhakatipayanemAzca (1.1.33) :</p>";
    echo "<p class = sa >प्रथमचरमतयाल्पार्धकतिपयनेमाश्च (१.१.३३) :</p>";
    display(0); $prath=1;
}     
/* dvandve ca (1.1.31) */
if ($so === "jas" && $dvandveca===1 )
{
    $text = last(array("jas"),array("SI"),1);
    echo "<p class = sa >By vibhASA jasi (1.1.32) :</p>";
    echo "<p class = sa >विभाषा जसि (१.१.३२) :</p>";
    display(0);
}    
if ($so === "jas" && arr(array($fo),'/(taya)$/'))
{
    $text = last(array("jas"),array("SI"),1);
    echo "<p class = sa >By prathamacaramatayAlpArdhakatipayanemAzca (1.1.33) :</p>";
    echo "<p class = sa >प्रथमचरमतयाल्पार्धकतिपयनेमाश्च (१.१.३३) :</p>";
    display(0); $taya=1;
} else {$taya=0;}    
/* upadeze'janunAsika it (1.3.2)*/ // Temporary patch. Not coded perfectly.
if (arr($text,'/['.flat($ac).'][!]/')  )
{
    it('/(['.flat($ac).'][!])/');
    echo "<p class = pa >By upadeze'janunAsika it (1.3.2) :</p>";
    echo "<p class = pa >उपदेशेऽजनुनासिक इत्‌ (१.३.२) :</p>";
    display(0);
    $text = two($ac,array("!"),blank(count($ac)),array(""),0);
    echo "<p class = sa >By tasya lopaH (1.3.9) :</p>";
    echo "<p class = sa >तस्य लोपः (१.३.९) :</p>";
    display(0);    
}
/* AdirGiTuDavaH (1.3.5) */
if ((substr($first,0,2) === "Yi" || substr($first,0,2) === "wu" || substr($first,0,2) === "qu") && $pada=== "pratyaya")
{
    if(substr($first,0,2) === "Yi") { $itprakriti = array_merge($itprakriti,array("Yi")); }
    if(substr($first,0,2) === "wu") { $itprakriti = array_merge($itprakriti,array("wu")); }
    if(substr($first,0,2) === "qu") { $itprakriti = array_merge($itprakriti,array("qu")); }
    echo "<p class = pa >By AdirGiTuDavaH (1.3.5) :</p>";
    echo "<p class = pa >आदिर्ञिटुडवः (१.३.५) :</p>";
    display(0);
    $text = first(array("Yi","wu","qu"),array("","",""),0);
    echo "<p class = sa >tasya lopaH (1.3.9) :</p>";
    echo "<p class = sa >तस्य लोपः (१.३.९) :</p>";
    display(0);
}
/* cuTU (1.3.7) */
if (arr($text,'/[+][cCjJYwWqQR]/') && $wa1 === 0 && ($sarva2 ===0 || $purva=1))
{
    it('/([+][cCjJYwWqQR])/');
    echo "<p class = pa >By cuTU (1.3.7) :</p>";
    echo "<p class = pa >चुटू (१.३.७) :</p>";
    display(0);
    $text = last(array("jas","wA"),array("as","A"),0);
    echo "<p class = sa >tasya lopaH (1.3.9) :</p>";
    echo "<p class = sa >तस्य लोपः (१.३.९) :</p>";
    display(0);
}
/* SaH pratyayasya (1.3.6) */
if (arr($text,'/[+][z]/') && $pada=== "pratyaya")
{
    it('/([+][z])/');
    echo "<p class = pa >By SaH pratyayasya (1.3.6) :</p>";
    echo "<p class = pa >षः प्रत्ययस्य (१.३.६) :</p>";
    display(0);
    $text = two(array("+"),array("z"),array("+"),array(""),0);
    echo "<p class = sa >By tasya lopaH (1.3.9) :</p>";
    echo "<p class = sa >तस्य लोपः (१.३.९) :</p>";
    display(0);
}
/* GeryaH (7.1.13) */
if (arr($text,'/[a][+][N][e]/') && $pada=== "pratyaya" && $so === "Ne" )
{
    $text = one(array("a+Ne"),array("a+ya"),0);
    $text = two(array("jaras"),array("ya"),array("jaras"),array("Ne"),0);
    echo "<p class = sa >By GeryaH (7.1.13) :</p>";
    echo "<p class = sa >ङेर्यः (७.१.१३) :</p>";
    display(3); $Ne=1;
} else { $Ne = 0; }
if (in_array($fo,array("SrIpA")) && $gender==="n" && $so==="Ne")
{
    echo "<p class = pa >By sannipAtaparibhASA prevents application of 'Ato dhAtoH'.</p>";
    echo "<p class = pa >सन्निपातपरिभाषा आतो धातोः का प्रयोग निषेध करती है ।</p>";
    display(0);    
}
/* lazakvataddhite (1.3.8) */
if (((arr($text,'/[+][lSkKgGN]/'))||$sarva2===1||$purva===1) && $taddhita === 0  && $sarva === 0 )
{
    it('/([+][lSkKgGN])/');
    echo "<p class = pa >By lazakvataddhite (1.3.8) :</p>";
    echo "<p class = pa >लशक्वतद्धिते (१.३.८) :</p>";
    display(0);
    $text = last(array("Sas","Ni","SI","Nas","Ne","Si","kvin"),array("as","i","I","as","e","i","vin"),0);
    echo "<p class = sa >By tasya lopaH (1.3.9) :</p>";
    echo "<p class = sa >तस्य लोपः (१.३.९) :</p>";
    display(0);
}
/* na vibhaktau tusmAH (1.3.4) */
if (arr($text,'/[tTdDnsm]$/') && $pada=== "pratyaya" && in_array($so,$sup) && $wa === 0 && $wa1 === 0)
{
    echo "<p class = pa >By na vibhaktau tusmAH (1.3.4)  :</p>";
    echo "<p class = pa >न विभक्तौ तुस्माः (१.३.४) :</p>";
    display(0);
}
/* halantyam (1.3.3) and tasya lopaH */
if ((arr($text,'/['.flat($hl).']$/') && $pada=== "pratyaya" && !in_array($so,$sup)) || (in_array($so,$sup) && !arr($text,'/[tTdDnsm]$/') && arr($text,'/['.pc('hl').']$/')))
{
    itprat('/(['.flat($hl).']$)/');
    echo "<p class = pa >By halantyam (1.3.3) :</p>";
    echo "<p class = pa >हलन्त्यम्‌ (१.३.३) :</p>";
    display(0); 
    $text = last(prat('hl'),blank(count(prat('hl'))),0);
    echo "<p class = sa >By tasya lopaH (1.3.9) :</p>";
    echo "<p class = sa >तस्य लोपः (१.३.९) :</p>";
    display(0); 
}
/* it additions */
if ($kvin===1)
{
    $itpratyaya=array_merge($itpratyaya,array("k","n"));
    $it=array_merge($it,array("k","n"));
}
if ($kvip===1)
{
    $itpratyaya=array_merge($itpratyaya,array("k","p"));    
    $it=array_merge($it,array("k","p"));    
}
/* viSvagdevayozca TeradryaJcatAvapratyaye (6.3.92) */
$sarvanamaadri = array("sarvadri","viSvadri","uBadri","uBayadri","ataradri","atamadri","anyadri","anyataradri","itaradri","tvadri","tvadri","nemadri","simadri","pUrvadri","paradri","avaradri","dakziRadri","uttaradri","aparadri","aDaradri","svadri","antaradri","tyadri","tadri","yadri","etadri","idadri","adadri","ekadi","dvadri","yuzmadri","asmadri","Bavadri","kadri","idakadri");
if ($ancu===1 && ( sub(array("vizvak","deva"),array("anc"),blank(0),0)||sub($sarvanama,array("anc"),blank(0),0) ) )
{
    $text = three($sarvanama,array("anc"),array("+"),$sarvanamaadri,array("anc"),array("+"),0);
    $text = three(array("vizvak","deva"),array("anc"),array("+"),array("vizvadri","devadri"),array("anc"),array("+"),0);
    echo "<p class = sa >viSvagdevayozca TeradryaJcatAvapratyaye (6.3.92) :</p>";
    echo "<p class = sa >विश्वग्देवयोश्च टेरद्र्याञ्चतावप्रत्यये (६.३.९२) :</p>";
    display(0);
    /* patch for iko yaNaci */
        if(sub(array('i','I','u','U'),prat('ac'),blank(0),0) && $bham===0)
            {
            $text = two(array('i','I','u','U'),prat('ac'),array('y','y','v','v'),prat('ac'),0);
            echo "<p class = sa >By iko yaNaci (6.1.77) :</p>";
            echo "<p class = sa >इको यणचि (६.१.७७) :</p>";
            display(4);
            }
        if(sub(array("f","F","x","X"),prat('ac'),blank(0),0) && $bham===0)
            {
            $text = two(array("f","F","x","X"),prat('ac'),array("r","r","l","l"),prat('ac'),0);
            echo "<p class = sa >By iko yaNaci (6.1.77) :</p>";
            echo "<p class = sa >इको यणचि (५.१.७७) :</p>";
            display(4); 
            }
}
/* nAJceH pUjAyAm (6.4.30) */ 
if ( !itcheck(array("i"),1) && arr($text,'/[n]['.pc('hl').'][+]/') && ( itcheck(array("k","G"),2)|| $ancu===1 ))
{
    echo "<p class = sa >nAJceH pUjAyAm (6.4.30) :</p>";
    echo "<p class = sa >नाञ्चेः पूजायाम्‌ (६.४.३०) :</p>";
    display(0); $nAJce=1;
} else { $nAJce = 0; }
/* kruJca */ 
if ( sub(array("kruYc"),array("+"),blank(0),0) )
{
    echo "<p class = pa >'RtvigdadhRksragdigaJcuyujikruJcAM ca' prohibits application of nalopa.</p>";
    echo "<p class = pa >'ऋत्विग्दधृक्स्रग्दिगञ्चुयुजिक्रुञ्चां च' इत्यनेन नलोपाभावोऽपि निपात्यते ।</p>";
    display(0); $kruJca=1;
} else { $kruJca = 0; }
/* aniditAM hala upadhAyAH kGiti (6.4.24) */ 
if ( !itcheck(array("i"),1) && arr($text,'/[nM]['.pc('hl').'][+]/') && ( itcheck(array("k","G"),2)|| $ancu===1 ) && $kruJca===0)
{
    if ($nAJce===1)
    {
    $text = three(array("n","M"),$hl,array("+"),array("",""),$hl,array("+"),1);        
    }
    else
    {
    $text = three(array("n","M"),$hl,array("+"),array("",""),$hl,array("+"),0);        
    }
    echo "<p class = sa >aniditAM hala upadhAyAH kGiti (6.4.24) :</p>";
    echo "<p class = sa >अनिदितां हल उपधायाः क्ङिति (६.४.२४) :</p>";
    display(0); $aniditAm = 1;
} else { $aniditAm = 0; }
/* uda It (6.4.139) */ 
if (preg_match('/[u][d][a][n][c][u]/',$fo) && $aniditAm === 1 && sub(array("ac","Ac"),array("+"),blank(0),0) && $bham===1 && $ancu===1)
{
    $text = two(array("ac","Ac"),array("+"),array("Ic","Ic"),array("+"),0);
    echo "<p class = sa >uda It (6.4.139) :</p>";
    echo "<p class = sa >उद इत्‌ (६.४.१३९) :</p>";
    display(0);
}
/* samaH sami (6.3.93) */ 
if (preg_match('/[s][a][m][a][n][c][u]/',$fo) && $aniditAm === 1 && sub(array("ac","Ac"),array("+"),blank(0),0) && $ancu===1)
{
    $text = two(array("samac"),array("+"),array("samiac"),array("+"),0);
    echo "<p class = sa >samaH sami (6.3.93) :</p>";
    echo "<p class = sa >समः समि (६.३.९३) :</p>";
    display(0);
}
/* sahasya sadhriH (6.3.95) */ 
if (preg_match('/[s][a][h][a][a][n][c][u]/',$fo) && $aniditAm === 1 && sub(array("ac","Ac"),array("+"),blank(0),0) && $ancu===1)
{
    $text = two(array("sahaac"),array("+"),array("saDriac"),array("+"),0);
    echo "<p class = sa >sahasya sadhriH (6.3.95) :</p>";
    echo "<p class = sa >सहस्य सध्रिः (६.३.९५) :</p>";
    display(0);
}
/* tirasastiryalope (6.3.94) */ 
if (preg_match('/[t][i][r][a][s][a][n][c][u]/',$fo) && sub(array("ac","Ac"),array("+"),blank(0),0) && $bham===0 && $ancu===1)
{
    $text = two(array("tirasac","tirasanc"),array("+"),array("tiriac","tirianc"),array("+"),0);
    echo "<p class = sa >tirasastiryalope (6.3.94) :</p>";
    echo "<p class = sa >तिरसस्तिर्यलोपे (६.३.९४) :</p>";
    display(0);
}
/* acaH (6.4.138) */ 
if ( preg_match('/[aA][n][c][u]/',$fo) && $aniditAm === 1 && sub(array("ac","Ac"),array("+"),blank(0),0) && $bham===1 && $ancu===1)
{
    if (sub(prat('ik'),prat('ac'),array("c"),0))
    {
    echo "<p class = pa >Though iko yaNaci is antaraGga than lopa by acaH, its application is barred by 'akRtavyUhAH pANinIyAH (pa 57).</p>";
    echo "<p class = pa >इको यणचि से प्राप्त यण्‌ अन्तरङ्ग होने पर भी अकृतव्यूहाः पाणिनीयाः (प ५७) से वह अचः का बाध नहीं करता ।</p>";
    display(0);        
    }
    $text = two(array("ac","Ac"),array("+"),array("c","c"),array("+"),0);
    echo "<p class = sa >acaH (6.4.138) :</p>";
    echo "<p class = sa >अचः (६.४.१३८) :</p>";
    if ($nAJce===1)
    {
    echo "<p class = hn >As there is no lopa of nakAra in nAJceH pUjAyAm, there is not akAralopa.</p>";
    echo "<p class = hn >नलोपाभावादकारलोपो न ।</p>";        
    }
    display(3); $acaH=1;
} else { $acaH=0; }
/* cau (6.3.138) */ 
if ( $acaH===1)
{
    $text = three($ac,array("c","c"),array("+"),$acdir,array("c","c"),array("+"),0);
    echo "<p class = sa >cau (6.3.138) :</p>";
    echo "<p class = sa >चौ (६.३.१३८) :</p>";
    display(3);
}
/* atvasantasya cAdhAtoH (6.4.14) */
if ( ( $atu===1  )  && $so==="su!" && $sambuddhi===0)
{
    $text = two($ac,array("t+"),$acdir,array("t+"),0);
//    $text = one(array("as+"),array("As+"),0);
    echo "<p class = sa >atvasantasya cAdhAtoH (6.4.14) :</p>";
    echo "<p class = sa >अत्वसन्तस्य चाधातोः (६.४.१४) :</p>";
    display(3);
}
/* shatR */
if ($shatR===1)
{
    $it=array_merge($it,array("f"));
    $itprakriti=array_merge($itprakriti,array("f"));
}
/* nAbhyAsAcChatuH (7.1.78) */
if ($abhyasta===1 && $shatR===1 && itcheck(array("f"),1) && $gender!=="n")
{
    echo "<p class = sa >By nAbhyastAcChatuH (7.1.78) :</p>";
    echo "<p class = sa >नाभ्यास्ताच्छतुः (7.1.78) :</p>";
    display(0); $nAbhyasta=1;
} else { $nAbhyasta=0; }
/* vA napuMsakasya (7.1.79) */ 
if ($abhyasta===1 && $shatR===1 && itcheck(array("f"),1) && $gender==="n")
{
    $text = mit('/['.pc('hl').'][+]/','n',1); $num=array_merge($num,array(1));
    $text = one(array("annc"),array("anc"),0);
    echo "<p class = sa >By vA napuMsakasya (7.1.79) :</p>";
    echo "<p class = sa >वा नपुंसकस्य (७.१.७९) :</p>";
    display(0); $vAnapuMsaka=1;
} else { $vAnapuMsaka=0; }
/* zapzyanornityam (7.1.81) */ 
if (arr($text,'/[aA][t][+[S][I]/') && ($shap===1|| $shyan===1 ) )
{
    $text = mit('/['.pc('hl').'][+]/','n',0); $num=array_merge($num,array(1));
    $text = one(array("annc"),array("anc"),0);
    echo "<p class = sa >By zapzyanornityam (7.1.81) :</p>";
    echo "<p class = sa >शप्श्यनोर्नित्यम्‌ (७.१.८१) :</p>";
    display(0);
}
/* AcChInadyornum (7.1.80) */ 
if (arr($text,'/[aA][t][+[S][I]/') && $shatR===1 && itcheck(array("f"),1) )
{
    $text = mit('/['.pc('hl').'][+]/','n',1); $num=array_merge($num,array(1));
    $text = one(array("annc"),array("anc"),0);
    echo "<p class = sa >By AcChInadyornum (7.1.80) :</p>";
    echo "<p class = sa >आच्छीनद्योर्नुम्‌ (७.१.८०) :</p>";
    display(0);
}
/* ugidacAM sarvanAmasthAne'dhAtoH (7.1.70) */
if ($sarvanamasthana1===1 && ( ($ancu===0 && $dhatu===1)  ) && $kruJca===0 && arr(array($fo),'/[a][t]$/'))
    {
    echo "<p class = pa >'ac' is for restricting the application of 'ugidacAm...' to aYcu if the word is a dhAtu. </p>";
    echo "<p class = pa >धातोश्चेदुगित्कार्यं तर्ह्यञ्चतेरेव ।</p>";      
    display(0);
    }
if ($sarvanamasthana1===1 && $nAbhyasta===0 &&  (( $dhatu===0 && itcheck(array("u","U","f","F","x","X"),1) ) ||  ($ancu===1 && $dhatu===1) ||  ( ($kvip===1 || $kvin===1)&& $dhatu===1 && arr(array($fo),'/[a][t]$/')) || $bhavat===1 ) && $kruJca===0 && $vAnapuMsaka===0)
{
    $text = mit('/['.pc('hl').'][+]/','n',0); $num=array_merge($num,array(1));
    $text = one(array("annc"),array("anc"),0);
    echo "<p class = sa >By ugidacAM sarvanAmasthAne'dhAtoH (7.1.70) :</p>";
    echo "<p class = sa >उगिदचां सर्वनामस्थानेऽधातोः (७.१.७०) :</p>";
    if ( ($kvip===1 || $kvin===1)&& $dhatu===1)
    {
    echo "<p class = hn >'adhAtoH' extends the application of this rule to the words which had adhAtu in the first place.</p>";
    echo "<p class = hn >'अधातोः' इति त्वधातुभूतपूर्वस्यापि नुमर्थम्‌ ।</p>";                
    }
    if ($nAJce===1)
    {
        echo "<p class = hn >As there is no lopa of nakAra, 'ugidacAm..' doesn't apply.</p>";
        echo "<p class = hn >अलुप्तनकारत्वात्‌ न नुम्‌ ।</p>";
    }
    display(3);      $ugidacAm=1;  
}  else {$ugidacAm=0; }
/* special message for ikAra of kvip, kvin etc. */
if (arr($text,'/[+][v][i]$/')&& in_array($so,array("kvip","kvin")) && $taddhita === 0  && $sarva === 0 )
{
    $text = last(array("vi"),array("v"),0);
    echo "<p class = sa >ikAra after 'v' in kvip, kvin etc are for fecility of pronounciation only.</p>";
    echo "<p class = sa >क्विप्‌, क्विन्‌ इत्यादि में वकार के बाद का इकार उच्चारणार्थ ही होता है ।</p>";
    display(0);
}
/* verapRktasya (3.1.67) */
if (arr($text,'/[+][v]$/')&& in_array($so,array("kvip","kvin")) && $taddhita === 0  && $sarva === 0 )
{
    $text = last(array("v"),array(""),0);
    echo "<p class = sa >verapRktasya (3.1.67) :</p>";
    echo "<p class = sa >वेरपृक्तस्य (३.१.६७) :</p>";
    display(0);
}
/* GasiGasozca (6.1.110) */
if (arr($text,'/[eo][+]/') && in_array($so,array("Nasi!","Nas")))
{
    $text = two(array("e+","o+"),array("a"),array("e+","o+"),array(""),0);
    echo "<p class = sa >By GasiGasozca (6.1.110) :</p>";
    echo "<p class = sa >ङसिङसोश्च (६.१.११०) :</p>";
    display(0);
}
/* hrasvanadyApo nuT (7.1.54) */
if ( $so === "Am" && $numacira===0 && (arr($text,'/[aiufx][+]/')) && $sut===0)
{
    $text = two($hrasva,array("+Am"),$hrasva,array("+nAm"),0);
    echo "<p class = sa >By hrasvanadyApo nuT (7.1.54) :</p>";
    echo "<p class = sa >ह्रस्वनद्यापो नुट्‌ (७.१.५४) :</p>";
    display(3);
}
if ( $so === "Am" && $numacira===0 && $nadi!==0 && !in_array($fo,$sarvanama) && $sut===0)
{
    if ($nadi===2)
    {
    $text = two(array("I","U"),array("+Am"),array("I","U"),array("+nAm"),1);        
    }
    else
    {
    $text = two(array("I","U"),array("+Am"),array("I","U"),array("+nAm"),0);        
    }
    echo "<p class = sa >By hrasvanadyApo nuT (7.1.54) :</p>";
    echo "<p class = sa >ह्रस्वनद्यापो नुट्‌ (७.१.५४) :</p>";
    display(3);
}
if ( $so === "Am" && $numacira===0 && $Ap===1 && !in_array($fo,$sarvanama) && $sut===0)
{
    $text = two(array("A"),array("+Am"),array("A"),array("+nAm"),0);
    echo "<p class = sa >By hrasvanadyApo nuT (7.1.54) :</p>";
    echo "<p class = sa >ह्रस्वनद्यापो नुट्‌ (७.१.५४) :</p>";
    display(3);
}
/* bahUrji exception to napuMsakasya jhalacaH (7.1.72) */ 
if ( $gender==="n" && $sarvanamasthana1===1 && sub(array("bahUrj"),blank(0),blank(0),0) && arr($text,'/['.pc('Jl').'][+]/') && $amipUrva === 0)
{
    $text = two(array("bahUrj"),array("+"),array("bahUrnj"),array("+"),1);
    echo "<p class = sa >By bahUrji numpratiSedhaH (vA 4331) and antyAtpUrvo vA num (vA 4332) :</p>";
    echo "<p class = sa >बहूर्जि नुम्प्रतिषेधः (वा ४३३१) तथा अन्त्यात्पूर्वो वा नुम्‍ (वा ४३३२) :</p>";
    display(3); $bahurj=1;
} else { $bahurj=0; }
/* beBid, cecCid exception to napuMsakasya jhalacaH (7.1.72) */ 
if ( $gender==="n" && $sarvanamasthana1===1 && $kvip===1 && sub(prat('Jl'),array("+"),blank(0),0) && in_array($so,array("jas","Sas")) && arr($text,'/['.pc('Jl').'][+]/') && $amipUrva === 0)
{
    echo "<p class = pa >allopa behaves like sthAnivad, therefore num (because of jhalantatva) doesn't happen. sthAnivadbhAva doesn't happen in svavidhi. Therefore num (because of ajantatva) doesn't happen. </p>";
    echo "<p class = pa >शावल्लोपस्य स्थानिवत्त्वादझलन्तत्वान्न नुम्‌ । अजन्तलक्षणस्तु नुम्‌ न । स्वविधौ स्थानिवत्त्वाभावात्‌ । </p>";
    display(0); $bebhid=1;
} else { $bebhid=0; } 
/* svap patch */
if ( $gender==="n" && $sarvanamasthana1===1 && arr($text,'/[A][n][p][+]/') && arr(array($fo),'/[a][p]$/') && $amipUrva === 0 && $nAbhyasta===0)
{
    $text = two(array("Anp"),array("+"),array("anp"),array("+"),1);
    echo "<p class = sa >'niravakAzatvaM pratipadoktatvam' mandates non application of dIrghatva here.  :</p>";
    echo "<p class = sa >'niरवकाशं प्रतिपदोक्तत्वम्‌' इति पक्षे तु प्रकृते तद्विरहात्‌ नुमेव । :</p>";
    display(3);
}
/* napuMsakasya jhalacaH (7.1.72) */ 
if ( $gender==="n" && $sarvanamasthana1===1 && arr($text,'/['.pc('ac').'][+]/') && $amipUrva === 0 && $nAbhyasta===0)
{
    $text = mit('/['.pc('ac').'][+]/','n',0);
    echo "<p class = sa >By napuMsakasya jhalacaH (7.1.72) :</p>";
    echo "<p class = sa >नपुंसकस्य झलचः (७.१.७२) :</p>";
    display(3);
}
if ( $gender==="n" && $sarvanamasthana1===1 && arr($text,'/['.pc('Jl').'][+]/') && $amipUrva === 0 && $bahurj===0 && $bebhid===0 && $ugidacAm===0 && $nAbhyasta===0 && $vAnapuMsaka===0)
{
    $text = mit('/['.pc('Jl').'][+]/','n',0);
    echo "<p class = sa >By napuMsakasya jhalacaH (7.1.72) :</p>";
    echo "<p class = sa >नपुंसकस्य झलचः (७.१.७२) :</p>";
    display(3);
}
/* sarvanAmasthAne cAsambuddhau (6.4.8) */
$acdir = array("A","A","I","I","U","U","F","F","F","F","e","o","E","O",);
if (arr($text,'/['.flat($ac).'][n][+]/') && !arr($text,'/['.flat($ac).'][n][+]$/') && !sub(array("Ahan"),blank(0),blank(0),0) && $sarvanamasthana1===1 && $sambuddhi===0 && $inhan===0 && $inhan1===0)
{
    $text = two($ac,array("n+"),$acdir,array("n+"),0);
    echo "<p class = sa >By sarvanAmasthAne cAsambuddhau (6.4.8) :</p>";
    echo "<p class = sa >सर्वनामस्थाने चासम्बुद्धौ (६.४.८) :</p>";
    echo "<p class = pa >alo'ntyAtpUrva upadhA (1.1.65) </p>";
    echo "<p class = pa >अलोऽन्त्यात्पूर्व उपधा (१.१.६५) </p>";   
    display(3);
}
/* dRnkarapunaHpUrvasya bhuvo yaN vaktavyaH (vA 4118) */ 
if ($dhatu===1 && in_array($fo,array("dfnBU","karaBU","kAraBU","punarBU"))  && in_array($so,$acsup))
{
    $text = three(array("dfnBU","karaBU","kAraBU","punarBU"),array("+"),$ac,array("dfnBv","karaBv","kAraBv","punarBv"),array("+"),$ac,0);
    echo "<p class = sa >By dRnkarapunaHpUrvasya bhuvo yaN vaktavyaH (vA 4118) :</p>";
    echo "<p class = sa >दृन्करपुनःपूर्वस्य भुवो यण्‌ वक्तव्यः (वा ४११८) :</p>";
    display(0); 
}   
/* striyAH (6.4.79) */
if (ends(array($fo),array("strI","stri"),1) && arr($text,'/[+]['.pc('ac').']/') && in_array($so,$acsup) && !in_array($so,array("am","Sas","Am")))
{
    $text = one(array("strI+","stri+"),array("striy+","striy+"),0);
    echo "<p class = sa >By striyAH (6.4.79) :</p>";
    echo "<p class = sa >स्त्रियाः (६.४.७९) :</p>";
    display(3);
}
/* varSAbhvazca (6.8.84) */ 
if ($dhatu===1 && $first==="varzABU" && $pada==="pratyaya" && in_array($so,$acsup))
{
    $text = two(array("varzABU"),array("+"),array("varzABv"),array("+"),0);
    echo "<p class = sa >By varSAbhvazca (6.8.84) :</p>";
    echo "<p class = sa >वर्षाभ्वश्च (६.४.८४) :</p>";
    display(0);
}
/* na bhUsudhiyoH (6.4.85) */
if ( $dhatu===1 && (arr($text,'/[B][U][+]/')||$fo==="suDI") && arr($text,'/[iuIU][+]['.flat($ac).']/') && $pada==="pratyaya")
{
    echo "<p class = sa >By na bhUsudhiyoH (6.4.85) :</p>";
    echo "<p class = sa >न भूसुधियोः (६.४.८५) :</p>";
    display(3);
    $nabhusu = 1;
} else { $nabhusu = 0; }
/* kvau luptaM na sthAnivat (vA 431) */
// Not displayed because it is difficult to teach sthnanivadbhav to machine now. Will come back to it if I can teach it some day.
/* aci znudhAtubhruvAM yvoriyaGuvaGau (6.4.77) */
// znu pending.  
if (($dhatu===1||$fo==="BrU") && arr($text,'/[iuIU][+]['.flat($ac).']/') && $pada==="pratyaya" && ($eranekaca===0 || ($eranekaca===1 && anekAca($fo)===false ) || (arr($text,'/[B][U][+]/')||$fo==="suDI") ))
{
    $text = three(array("i","I","u","U"),array("+"),$ac,array("iy","iy","uv","uv"),array("+"),$ac,0);
    echo "<p class = sa >By aci znudhAtubhruvAM yvoriyaGuvaGau (6.4.77) :</p>";
    echo "<p class = hn >gatikAraketarapUrvapadasya yaN neSyate (vA 5034) mandates that eranekAco... rule doesn't apply in cases where the pUrvapada is neither gati nor kAraka. iyaG or uvaG is applied in that case. :</p>";
    echo "<p class = sa >अचि श्नुधातुभ्रुवां य्वोरियङुवङौ (६.४.७७) :</p>";
    echo "<p class = hn >गतिकारकेतरपूर्वपदस्य यण्‌ नेष्यते (वा ५०३४) से गति / कारक से भिन्न पूर्वपद होने पर एरनेकाचो... सूत्र नहीं लागू होता । इयङ्‌ या उवङ्‌ की प्रवृत्ति होती है । :</p>";
    display(3);
}
/* gatikAraketarapUrvapadasya yaN neSyate (vA 5034) */
// This is attached with eranekAco... So, trying to put a note and making the iyaG and yaN optional.
/* eranekAco'saMyogapUrvasya (6.4.82) */
//echo $dhatu;echo $pada;echo $eranekaca;echo $nabhusu;
if ($dhatu===1 && in_array($fo,array("unnI")) && $pada==="pratyaya" && anekAca($fo) && $eranekaca===1 && $nabhusu===0)
{
    echo "<p class = pa >As the vizeSaNa 'dhAtunA saMyogasya' mandates that the saMyoga has to belong to dhAtu only for prohibiting 'eranekAco..', the prohibition doesn't apply here.</p>";
    echo "<p class = pa >धातुना संयोगस्य विशेषणादिह स्यादेव यण्‌ (एरनेकाचो इत्यनेन सूत्रेण) </p>";
    display(0); $unni=1;
} else { $unni=0; }
if ($dhatu===1 && (arr($text,'/['.flat($ac).']['.flat($hl).'][iI][+]['.flat($ac).']/')||$unni===1) && $pada==="pratyaya" && anekAca($fo) && $eranekaca===1 && $nabhusu===0)
{
    $text = two(array("i","I"),array("+"),array("y","y"),array("+"),0);
    echo "<p class = sa >By eranekAco'saMyogapUrvasya (6.4.82) :</p>";
    echo "<p class = hn >gatikAraketarapUrvapadasya yaN neSyate (vA 5034) mandates that this rule doesn't apply in cases where the pUrvapada is neither gati nor kAraka. iyaG or uvaG is applied in that case. :</p>";
    echo "<p class = sa >एरनेकाचोऽसंयोगपूर्वस्य (६.४.८२) :</p>";
    echo "<p class = hn >गतिकारकेतरपूर्वपदस्य यण्‌ नेष्यते (वा ५०३४) से गति / कारक से भिन्न पूर्वपद होने पर यह सूत्र नहीं लागू होता । इयङ्‌ या उवङ्‌ की प्रवृत्ति होती है । :</p>";
    display(3);
}
/* oH supi (6.4.83) */ 
if ($dhatu===1 && arr($text,'/[uU][+]['.flat($ac).']/') && $pada==="pratyaya" && anekAca($fo) && $eranekaca===1 && $nabhusu===0 && in_array($so,$sup))
{
    $text = three(array("u","U"),array("+"),$ac,array("v","v"),array("+"),$ac,0);
    echo "<p class = sa >By oH supi (6.4.83) :</p>";
    echo "<p class = hn >gatikAraketarapUrvapadasya yaN neSyate (vA 5034) mandates that this rule doesn't apply in cases where the pUrvapada is neither gati nor kAraka. iyaG or uvaG is applied in that case. :</p>";
    echo "<p class = sa >ओः सुपि (६.४.८३) :</p>";
    echo "<p class = hn >गतिकारकेतरपूर्वपदस्य यण्‌ नेष्यते (वा ५०३४) से गति / कारक से भिन्न पूर्वपद होने पर यह सूत्र नहीं लागू होता । इयङ्‌ या उवङ्‌ की प्रवृत्ति होती है । :</p>";
    display(3);
}
/* ami pUrvaH (6.1.107) */
if ( sub(array("a","A","i","I","u","U","f","F","x"),array("+am"),blank(0),0))
{
    $text = two(array("a","A","i","I","u","U","f","F","x"),array("am"),array("a","A","i","I","u","U","f","F","x"),array("m"),0);
    echo "<p class = sa >By ami pUrvaH (6.1.107) :</p>";
    echo "<p class = sa >अमि पूर्वः (६.१.१०७) :</p>";  $ato = 1;
    display(0); $amipUrva = 1;
}   else { $amipUrva = 0; }
/* halGyAbbhyo dIrghAtsutisyapRktaM hal (6.1.68) and apRkta ekAlpratyayaH (1.2.41) */
// GyAp pending. only hal handled now.
if ((arr($text,'/['.pc('hl').'][+][sts]$/') || $GI===1 || $Ap===1 )&& in_array($so,array("su!","ti","si")))
{
    echo "<p class = pa >By apRkta ekAlpratyayaH (1.2.41) :</p>";
    echo "<p class = pa >अपृक्त एकाल्प्रत्ययः (१.२.४१) :</p>";
    display(0);
}
if ((arr($text,'/['.pc('hl').'][+][sts]$/')  )&& in_array($so,array("su!","ti","si")))
{
    $text = two($hl,array("+s","+t"),$hl,array("+","+"),0);
    echo "<p class = sa >By halGyAbbhyo dIrghAtsutisyapRktaM hal (6.1.68) :</p>";
    echo "<p class = sa >हल्ङ्‍याब्भ्यो दीर्घात्सुतिस्यपृक्तं हल्‌ (६.१.६८) :</p>";
    display(0); $pada="pada";
}
if ($GI===1 && arr($text,'/[I][+][st]$/') && in_array($so,array("su!","ti","si")))
{
    $text = two(array("I"),array("+s","+t"),array("I"),array("+","+"),0);
    echo "<p class = sa >By halGyAbbhyo dIrghAtsutisyapRktaM hal (6.1.68) :</p>";
    echo "<p class = sa >हल्ङ्‍याब्भ्यो दीर्घात्सुतिस्यपृक्तं हल्‌ (६.१.६८) :</p>";
    display(0); $pada="pada";
}
if ( $Ap===1 && arr($text,'/[A][+][st]$/') && in_array($so,array("su!","ti","si")))
{
    $text = two(array("A"),array("+s","+t"),array("A"),array("+","+"),0);
    echo "<p class = sa >By halGyAbbhyo dIrghAtsutisyapRktaM hal (6.1.68) :</p>";
    echo "<p class = sa >हल्ङ्‍याब्भ्यो दीर्घात्सुतिस्यपृक्तं हल्‌ (६.१.६८) :</p>";
    display(0); $pada="pada";
}
/* sAntamahataH saMyogasya (6.4.10) */
if ( ( (arr($text,'/['.flat($ac).'][nM][s][+]/') && $dhatu===1)|| $fo==="mahat" )&& $sarvanamasthana1===1 && $sambuddhi===0)
{
    echo "<p class = pa >sAntamahataH saMyogasya (6.4.10) doesn't apply here. </p>";
    echo "<p class = pa >सान्तमहतः संयोगस्य (६.४.१०) इत्यत्र सान्तसंयोगोऽपि प्रातिपदिकस्यैव गृह्यते, न तु धातोः, महच्छब्दसाहचर्यात्‌ ।</p>";    
    display(0);
}
if ( ( (arr($text,'/['.flat($ac).'][nM][s][+]/') && $dhatu===0)|| $fo==="mahat" )&& $sarvanamasthana1===1 && $sambuddhi===0)
{
    $text = two($ac,array("ns+","Ms+"),$acdir,array("ns+","Ms+"),0);
    $text = one(array("mahant"),array("mahAnt"),0);
    echo "<p class = sa >By sAntamahataH saMyogasya (6.4.10) :</p>";
    echo "<p class = sa >सान्तमहतः संयोगस्य (६.४.१०) :</p>";
    echo "<p class = pa >alo'ntyAtpUrva upadhA (1.1.65) </p>";
    echo "<p class = pa >अलोऽन्त्यात्पूर्व उपधा (१.१.६५) </p>";   
    display(0);
}
if (arr($text,'/['.flat($ac).'][nM][s][+]/') && ends(array($fo),array("mahat"),1) && $sarvanamasthana1===1 && $sambuddhi===0)
{
    $text = two($ac,array("ns+"),$acdir,array("ns+"),0);
    echo "<p class = sa >By sAntamahataH saMyogasya (6.4.10) :</p>";
    echo "<p class = sa >सान्तमहतः संयोगस्य (६.४.१०) :</p>";
    echo "<p class = pa >alo'ntyAtpUrva upadhA (1.1.65) </p>";
    echo "<p class = pa >अलोऽन्त्यात्पूर्व उपधा (१.१.६५) </p>";   
    display(0);
}
/* Rta ut (6.1.111) */
if ( (arr($text,'/[fx][+][a]/')) && in_array($so,array("Nasi!","Nas")) && $pada==="pratyaya")
{
    $text = two(array("f","x"),array("+a"),array("ur","ul"),array("+"),0);
    echo "<p class = sa >By Rta ut (6.1.111) :</p>";
    echo "<p class = sa >ऋत उत्‌ (६.१.१११) :</p>";
    display(0);
}
/* auto'mzasoH (6.1.93) */
if (sub(array("o"),array("+"),array("a"),0) && in_array($so,array("am","Sas")))
{  
    $text = two(array("o"),array("+a"),array(""),array("+A"),0);
    echo "<p class = sa >By auto'mzasoH (6.1.93) :</p>";
    echo "<p class = sa >औतोऽम्शसोः (६.१.९३) :</p>";
    display(0);
}
/* ato bhisa ais (7.1.9) */
if (arr($text,'/[a][+]/') && $so === "Bis" && $nedamadas===0 && $fo!=="adas" )
{
    $text = two(array("a"),array("Bis"),array("a"),array("Es"),0);
    echo "<p class = sa >By ato bhisa ais (7.1.9) :</p>";
    echo "<p class = sa >अतो भिस ऐस्‌ (७.१.९) :</p>";
    display(5); $atobhis = 1;
} else { $atobhis = 0; }
/* yasyeti ca (6.4.148) */
if (arr($text,'/[aI][+][I]/') && $bham===1 && $auGazyA===0)
{
    $text = two(array("a","I"),array("I"),array("",""),array("I"),0);
    echo "<p class = sa >By yasyeti ca (6.4.148) :</p>";
    echo "<p class = sa >यस्येति च (६.१.१४८) :</p>";
    display(3); 
}
/* TeH (6.4.143) */
if ($Dit===1 && $bham===1 )
{   
    $text = Ti(0);
    echo "<p class = sa >By TeH (6.4.143) :</p>";
    echo "<p class = sa >टेः (६.४.१४३) :</p>";
    display(3); 
}



// Creating a do-while loop for sapAdasaptAdhyAyI. There is no order of application of rules in sapAdasaptAdhyAyI. 
// Therefore the cause for application may arise after application of any rule. So created a do-while loop which will check till the input and output are the same i.e. there is no difference after the application of all the sUtras.
$start = 1;
do 
{
$original = $text ;

/* osi ca (7.3.104) */
if ($so === "os" && arr($text,'/[a][+]/') && $start ===1)
{
    $text = two(array("a"),array($second),array("e"),array($second),0);
    echo "<p class = sa >By osi ca (7.3.104) :</p>";
    echo "<p class = sa >ओसि च (७.३.१०४) :</p>";
    display(3);
}
/* na tisRcatasR (6.4.4) */
if ($so === "Am" && sub(array("tisf","catasf"),array("+"),blank(0),0))
{
    echo "<p class = sa >By na tisRcatasR (6.4.4) :</p>";
    echo "<p class = hn >This prevents application of 'nAmi'.</p>";
    echo "<p class = sa >न तिसृचतसृ (६.४.४) :</p>";
    echo "<p class = hn >यह सूत्र नामि की प्रवृत्ति को निषिद्ध करता है ।</p>";
    display(3); $natisf=1;
} else { $natisf = 0; }
/* explanation of prarINAm */
if (sub(array("rI"),array("+"),array("nAm"),0) && arr(array($fo),'/[r][E]$/'))
{
    echo "<p class = hn >According to mAdhava, rAyo hali applies here to convert it to prarANAm. But it is wrong according to Siddhantakaumudi.</p>";
    echo "<p class = hn >माधव के अनुसार यहाँ रायो हलि से आत्त्व होता है । परन्तु सिद्धान्तकौमुदी के अनुसार यह गलत है ।</p>";    
    display(0);
}   
/* nAmi (6.4.3) and nR ca (6.4.6) */
if (arr($text,'/['.flat($ac).'][+][n][A][m]$/') && $start ===1 && !in_array($fo,$sarvanama) && $natisf === 0)
{
    if(arr($text,'/[n][f][+][n][A][m]$/'))
    {
    $text = two(array("nf"),array("nAm"),array("nF"),array("nAm"),1);
    echo "<p class = sa >By nR ca (6.4.6) :</p>";
    echo "<p class = sa >नृ च (६.४.६) :</p>";
    display(3);        
    }
    elseif (sub(array("a+"),array("nAm"),blank(0),0))
        {
        echo "<p class = pa >Even though, supi ca (7.3.102) is a parasUtra, it doesn't operate here. The causes are: (1) violation of sannipAtaparibhASA and (2) ArambhasAmarthya of 'nAmi'. :</p>";
        echo "<p class = pa >यद्यपि सुपि च (७.३.१०२) परसूत्र है, फिर भी उसकी प्रवृत्ति यहाँ नहीं होती है । सन्निपातपरिभाषा के विरोध से और नामि च सूत्र के प्रारम्भ के सामर्थ्य से । </p>";
        display(0);
        echo "<p class = sa >By nAmi (6.4.3) :</p>";
        echo "<p class = sa >नामि (६.४.३) :</p>";        
        $text = two($ac,array("nAm"),array("A","A","I","I","U","U","F","F","F","F","e","E","o","O"),array("nAm"),0);
        }
    else
        {
        echo "<p class = sa >By nAmi (6.4.3) :</p>";
        echo "<p class = sa >नामि (६.४.३) :</p>";        
        $text = two($ac,array("nAm"),array("A","A","I","I","U","U","F","F","F","F","e","E","o","O"),array("nAm"),0);
        }
    display(3);        
 $nami = 1;
} 
else 
    {
    $nami = 0; 
    }
/* bahuvacane jhalyet (7.3.103) */
if ((in_array($so,array("Byas","sup","Bis")) || ($sut===1 && $sAmaAkam===0)) && arr($text,'/[a][+]/') && $start ===1)
{
    $text = two(array("a"),array("Byas","su","sAm","Bis"),array("e"),array("Byas","su","sAm","Bis"),0);
    echo "<p class = sa >By bahuvacane jhalyet (7.3.103) :</p>";
    echo "<p class = sa >बहुवचने झल्येत्‌ (७.३.१०३) :</p>";
    display(3); $bahuvacane = 1;
} else { $bahuvacane = 0; }
/* supi ca (7.3.102) */
if (in_array($so,$sup) && arr($text,'/[a][+]['.pc('yY').']/') && $amipUrva===0 && $start === 1 && $bahuvacane === 0 && $nami === 0 && $Ne!==1)
{
    $text = two(array("a"),array("+"),array("A"),array("+"),0);
    echo "<p class = sa >By supi ca (7.3.102) :</p>";
    echo "<p class = sa >सुपि च (७.३.१०२) :</p>";
    display(3);
}
if ($Ne===1 && $start === 1)
{
    display(0);
    $text = one(array("a+ya"),array("A+ya"),0);
    echo "<p class = sa >By supi ca (7.3.102) :</p>";
    echo "<p class = hn >'sannipAtalakSaNo vidhiranimittaM tadvighAtasya (pa 86) doesn't apply here. Its anityatva has been shown by kaSTAya kramaNe. </p>";
    echo "<p class = sa >सुपि च (७.३.१०२) :</p>";
    echo "<p class = hn >'सन्निपातलक्षणो विधिरनिमित्तं तद्विघातस्य (प ८६) यहाँ लागू नहीं होता है । कष्टाय क्रमणे से उसका अनित्यत्व ज्ञापित होता है ।</p>";
    display(3);
}
/* pragRhya section */
/* plutapragRhyA aci nityam (6.1.125) */
// There is no definition of pluta / pragRhya here. So we will code that as and when case arises.
/* iko'savarNe zAkalyasya hrasvazca (6.1.127) */ // Right now coded for only dIrgha. Clarify wheter the hrasva preceding also included?
$ik = array("i","I","u","U","f","F","x","X");
$nonik = array("a","A","e","E","o","O");
if (sub($ik,array("+"),$nonik,0) && $pada==="pada")
{
$text = two(array("i+","I+"),array("a","A","u","U","f","F","x","X","e","o","E","O"),array("i +","i +"),array("a","A","u","U","f","F","x","X","e","o","E","O"),1);
$text = two(array("u+","U+"),array("a","A","i","I","f","F","x","X","e","o","E","O"),array("u +","u +"),array("a","A","i","I","f","F","x","X","e","o","E","O"),1);
$text = two(array("f+","F+"),array("a","A","u","U","i","I","e","o","E","O"),array("f +","f +"),array("a","A","u","U","i","I","e","o","E","O"),1);
$text = two(array("x+","X+"),array("a","A","u","U","i","I","e","o","E","O"),array("x +","x +"),array("a","A","u","U","i","I","e","o","E","O"),1);
echo "<p class = sa >By iko'savarNe zAkalyasya hrasvazca (6.1.127) :</p>
    <p class = hn >Note that this will not apply in samAsa. Also when followed by a 'sit' pratyaya, it will not apply. e.g. pArzva</p>";
echo "<p class = sa >इकोऽसवर्णे शाकल्यस्य ह्रस्वश्च (६.१.१२७) :</p>
    <p class = hn >समास व सित्‌ प्रत्यय परे होने पर यह लागू नहीं होता । जैसे कि पार्श्व ।</p>";
display(0);
}
/* upasargAdRti dhAtau (6.1.11) and vA supyApizaleH (6.1.12) */
$akarantaupasarga = array("pra","apa","ava","upa",);
$changedupasarga = array("prAr","apAr","avAr","upAr");
$changedupasarga1 = array("prar","apar","avar","upar");
$changedupasarga2 = array("prAl","apAl","avAl","upAl");
$changedupasarga3 = array("pral","apal","aval","upal");
if ((sub($akarantaupasarga,$verbs_ru,blank(0),0) && !sub(array("prafRa"),blank(0),blank(0),0))||sub($akarantaupasarga,array("xkArIy"),blank(0),0))
{
    if (arr($text,'/[I][y]/'))
    {
            $text = two($akarantaupasarga,$verbs_ru,$changedupasarga,$verbs_changed,1);
    }
    else
    {
            $text = two($akarantaupasarga,$verbs_ru,$changedupasarga,$verbs_changed,0);
    }
$text = two($akarantaupasarga,array("xkArIy"),$changedupasarga2,array("kArIy"),1);
$text = two($akarantaupasarga,array("xkArIy"),$changedupasarga3,array("kArIy"),0);
echo "<p class = sa >By upasargAdRti dhAtau (6.1.11) and vA supyApizaleH (6.1.12) :</p>";
echo "<p class = hn >In case akArAnta upasarga is followed by RkArAdi nAmadhAtu, there is optional vRddhi ekAdeza. If there is dIrgha RUkAra at the start of dhAtu or nAmadhAtu, upasargAdRti dhAtau and vA supyApizaleH don't apply. iko yaNaci and uraNraparaH apply.</p>";
echo "<p class = sa >उपसर्गादृति धातौ (६.१.११) तथा वा सुप्यापिशलेः (६.१.१२) :</p>";
echo "<p class = hn >अकारान्त उपसर्ग से ऋकारादि नामधातु परे होने पर विकल्प से वृद्धि एकादेश होता है । यदि धातु या नामधातु ॠकार से आरंभ होता है, तब उपसर्गादृति धातौ तथा वा सुप्यापिशलेः लागू नहीं होते हैं । अतः इको यणचि व उरण्रपरः ही लागू होते हैं ।</p>";
display(0); $upas = 1;
} else { $upas = 0; }
/* RtyakaH (6.1.128) */
$ak = array("a","A","i","I","u","U","f","F","x","X"); 
$akrt = array("a ","A ","i ","I ","u ","U ","f ","F ","x ","X "); 
if (arr($text,'/['.flat($ak).'][+][fx]/') && $start===1 && $pada ==="pada" && $upas ===0 )
{
if (sub($ak,array("f","x"),blank(0),0))
{
$text = two ($ak,array("f","x"),$akrt,array("f","x"),1);
echo "<p class = sa >By RtyakaH (6.1.128) :</p>
    <p class = hn >Note: This applies only to padAnta. </p>";
echo "<p class = sa >ऋत्यकः (६.१.१२८) :</p>
    <p class = hn >Note: This applies only to padAnta. </p>";
display(0);
}
}
if ($upas === 1)
{
    echo "<p class = hn >RtyakaH is barred by upasargAdRti dhAtau. </p>
    <p class = hn >ऋत्यकः उपसर्गादृति धातौ से बाधित हुआ है ।</p><hr>";
}
/* vAkyasya TeH pluta udAttaH (8.2.82) */
// This is adhikArasutra. Nothing to code here.
/* pratyabhivAde'zUdre (8.2.83) */
/* dUrAddhUte ca (8.2.84) */
/* haihe prayoge haihayoH (8.2.85) */
/* guronanRto'nantyasyApyekaikasya prAcAm (8.2.86) */
/* aplutavadupasthite (6.1.129) */
/* I3 cAkravarmaNasya (6.1.130) */
// These two are not possible to code, because it will depend on the speaker's choice.
/* IdUdeddvivacanaM pragRhyam (1.1.11) */
// not possible to code till we get the word forms of all words and check whether it is dvivacana or not. Pending
/* adaso mAt (1.1.12) */
if (sub(array("amI"),blank(0),blank(0),0) && $fo === "amI" && $start===1)
{
$text = two (array("amI"),$ac,array("amI "),$ac,1);
echo "<p class = sa >By adaso mAt (1.1.12) :</p>";
echo "<p class = sa >अदसो मात्‌ (१.१.१२) :</p>";
display(0);
}
if (sub(array("amU"),blank(0),blank(0),0)&& $fo === "amU" &&$start===1)
{
$text = two (array("amU"),$ac,array("amU "),$ac,1);
echo "<p class = sa >By adaso mAt (1.1.12) :</p>";
echo "<p class = sa >अदसो मात्‌ (१.१.१२) :</p>";
display(0);
}
/* ze (1.1.13) */
// Not possible to know whether one form has ze or not.
/* nipAta ekAjanAG (1.1.14) */
$nipata = array("a","A","i","I","u","U","e","E","o","O");
$nipata1 = array("a ","A ","i ","I ","u ","U ","e ","E ","o ","O "); 
if (in_array($first,$nipata) && sub(array($first),$ac,blank(0),0) && $start===1)
{
$text = two ($nipata,$ac,$nipata1,$ac,0);
echo "<p class = sa >By nipAta ekAjanAG (1.1.14) :</p>";
echo "<p class = sa >निपात एकाजनाङ्‌ (१.१.१४) :</p>";
display(0);
}
/* ot (1.1.15) */
$ot = array("o","aho","ho","utAho","aTo");
$ot1 = array("o ","aho ","ho ","utAho ","aTo ");
if (in_array($first,$ot) && sub(array($first),$ac,blank(0),0) && $start===1)
{
$text = two ($ot,$ac,$ot1,$ac,0);
echo "<p class = sa >By ot (1.1.15) :</p>";
echo "<p class = sa >ओत्‌ (१.१.१५) :</p>";
display(0);
}
/* sambuddhau zAkalyasyetAvanArSe (1.1.16) */
if (arr($text,'/[o][+]/') && $second === "iti" && $start===1)
{
$text = two(array($first),$ac,array($first." "),$ac,1);
echo "<p class = sa >By sambuddhau zAkalyasyetAvanArSe (1.1.16) :</p>
    <p class = hn >Note: This rule will apply only in case the 'o'kAra at the end of the first word is for sambuddhi and the 'iti' is anArSa (of non-vedic origin).</p>";
"<p class = sa >सम्बुद्धौ शाकल्यस्येतावनार्षे (१.१.१६) :</p>
    <p class = hn >यह नियम तभी लागू होगा जब प्रथम शब्द के अन्त का ओकार सम्बुद्धि के लिए हो और अनार्ष 'इति' शब्द उसके परे हो ।</p>";
display(0);
}
/* UYaH (1.1.17) */
if ($first === "u" && $second === "iti" && $start===1)
{
$text = two(array("u"),array("iti"),array("u "),array("iti"),1);
echo "<p class = sa >By uYaH (1.1.17) :</p>";
echo "<p class = sa >उञः (१.१.१७) :</p>";
display(0);
}
/* U! (1.1.18) */ // Here ! has been used for anunAsika.
if ($first === "u" && $second === "iti" && $start===1)
{
$text = two(array("u"),array("iti"),array("U! "),array("iti"),1);
echo "<p class = sa >By U! (1.1.17) :</p>";
echo "<p class = sa >ऊँ (१.१.१७) :</p>";
display(0);
}
/* maya uYo vo vA (8.3.33) */
if (sub(array("Sam","kim","tvam","tad"),array("u"),$ac,0))
{
$text = three(array("Sam","kim","tvam","tad"),array("u"),$ac,array("Sam","kim","tvam","tad"),array("v"),$ac,1);
echo "<p class = sa >By maya uYo vo vA (8.3.33) :</p>";
echo "<p class = sa >मय उञो वो वा (८.३.३३) :</p>";
display(0);
}
/* IdUtau ca saptamyarthe (1.1.19) */
/*$idut = array("I","U"); $idut1 = array("I ","U ");
if (preg_match('/[IU]$/',$first) && sub(array("I","U"),$ac,blank(0),0) && $pada ==="pada")
{
$text = two($idut,$ac,$idut1,$ac,1);
echo "<p class = sa >By IdUtau ca saptamyarthe (1.1.19) :</p>";
echo "<p class = hn >N.B.: This will apply only in case the I/U at the end of the first word have been used in sense of saptamI vibhakti. Otherwise this pragRhyatva will not be there.</p>";
echo "<p class = sa >ईदूतौ च सप्तम्यर्थे (१.१.१९) :</p>";
echo "<p class = hn >यदि प्रथम पद के अन्त में ई / ऊ सप्तमी के अर्थ में प्रयुक्त हुए हों तभी यह नियम लागू होगा ।</p>";
display(0);
}*/
/* zakandhvAdiSu pararUpaM vAcyam (vA 3632) */
$shakandhu1 = array("Saka","karka","kula","manas","hala","lANgala","patan","mfta");
$shakandhu2 = array("anDu","anDu","awA","IzA","IzA","IzA","aYjali","aRqa");
$shakandhu = array("Sak","kark","kul","man","hal","lANgal","pat","mArt");
if (sub($shakandhu1,$shakandhu2,blank(0),0))
{
$text = two($shakandhu1,$shakandhu2,$shakandhu,$shakandhu2,0);
echo "<p class = sa >By zakandhvAdiSu pararUpaM vAcyam (vA 3632) :</p>";
echo "<p class = sa >शकन्ध्वादिषु पररूपं वाच्यम्‌ (वा ३६३२) :</p>";
display(0);
}
$shakandhu1 = array("sIman","sAra");
$shakandhu2 = array("anta","aNga");
$shakandhu = array("sIm","sAr");
if (sub($shakandhu1,$shakandhu2,blank(0),0))
{
$text = two($shakandhu1,$shakandhu2,$shakandhu,$shakandhu2,1);
$text = one(array("sIman+ant","sAra+aNg"),array("sIm+Ant","sAr+ANg"),0);
echo "<p class = sa >By zakandhvAdiSu pararUpaM vAcyam (vA 3632) :</p>";
echo  "<p class = hn >Note: the sImanta - kezaveSa and sAraGga - pazu/pakSI - Then only this will apply.</p>";
echo "<p class = sa >शकन्ध्वादिषु पररूपं वाच्यम्‌ (वा ३६३२) :</p>";
echo  "<p class = hn >यदि सीमन्त केशवेश के अर्थ में और सारङ्ग पशु-पक्षी के अर्थ में प्रयुक्त हुए हो, तभी यह नियम लागू होता है ।</p>";
display(0);
}
/* omAGozca (6.1.95) */ 
$aag = array("om","OM","Aj","Acy","AYc","Anakt","Att","As","er","Eray","okz","ArcC","Arpit","Ohyat","oQ","arSyAt");
if (sub(array("a","A"),$aag,blank(0),0))
{ 
$text = two(array("a","A"),array("om","OM"),blank(2),array("om","om"),0);
$text = two(array("a","A"),$aag,blank(2),$aag,0);
echo "<p class = sa >By omAGozca (6.1.95) :</p>
    <p class = hn >The om or AG following the a,A gets converted to pararUpa. </p>";
echo "<p class = sa >ओमाङोश्च (६.१.९५) :</p>
    <p class = hn >अ/आ के परे यदि ओम्‌ या आङ्‌ हो तो पररूप होता है । </p>";
display(0);
}
/* ATazca (6.1.90) */
// right now only ANnadyAH case is taken. Add the other cases as and when they arise.
if ((arr($text,'/[+][A][+]['.flat($ac).']/') && $ANnadyAH===1) )
{
$text = two(array("+A+"),$ac,array("+"),vriddhi($ac),0);
echo "<p class = sa >By ATazca (6.1.90) :</p>";
echo "<p class = sa >आटश्च :</p>";
display(0);
}
/* nAdici (6.1.104) */
$ic = array("i","I","u","U","f","F","x","X","e","o","E","O");
if (arr($text,'/[a][+]['.flat($ic).']/') && (in_array($so,$prathama)))
{
    echo "<p class = pa >By nAdici (6.1.104) :</p>
        <p class = hn >N.B. : This is exception to prathamayoH pUrvasavarNaH. </p>";
      echo "<p class = pa >नादिचि (६.१.१०४) :</p>
        <p class = hn >यह नियम प्रथमयोः पूर्वसवर्णः का अपवाद है ।</p>";
    display (0); $nadici = 1;
} else { $nadici = 0; }
/* dIrghAjjasi ca (6.1.105) */
if ((arr($text,'/[AIUFeEoO][+]['.flat($ic).']/')||((sub($dirgha,array("+"),array("as"),0)) && $so==="jas")) && (in_array($so,$prathama)))
{
    echo "<p class = pa >By dIrghAjjasi ca (6.1.105) :</p>
        <p class = hn >N.B. : This is exception to prathamayoH pUrvasavarNaH. </p>";
      echo "<p class = pa >दीर्घाज्जसि च (६.१.१०५) :</p>
        <p class = hn >यह नियम प्रथमयोः पूर्वसवर्णः का अपवाद है ।</p>";
    display (0); $nadici1 = 1;
} else { $nadici1 = 0; }
/* prathamayoH pUrvasavarNaH (6.1.102) */ 
// Not coded well. Please revisit.
$ak = array("a","A","i","I","u","U","f","F","x","X"); 
$akreplace = array("A","A","I","I","U","U","F","F","F","X");
if (sub($ak,array("+"),array("a","O"),0) && in_array($so,$prathama)  && $nadici === 0 && $nadici1 === 0)
{
    if (sub(array("a"),array("a","O"),blank(0),0)&& in_array($so,$prathama)  && $nadici === 0 && $nadici1 === 0)
    {
        echo "<p class = hn >ato guNe (6.1.96) is exception to only akaH savarNe dIrghaH (6.1.101) and not to prathamayoH pUrvasavarNaH (6.1.102), because of the paribhASA 'purastAdapavAdA anantarAnvidhInbAdhante nottarAn (pa 60). Therefore pURvasavarNadIrgha can occur. :</p>";
        echo "<p class = hn >'पुरस्तादपवादा अनन्तरान्विधीन्बाधन्ते नोत्तरान्‌ (प ६०) परिभाषा के कारण अतो गुणे (६.१.९६) सिर्फ अकः सवर्णे दीर्घः (६.१.१०१) का अपवाद है, प्रथमयोः पूर्वसवर्णः (६.१.१०२) का नहीं । अतः पूर्वसवर्णदीर्घ हो सकता है ।</p>";
        display (0);
    }
    $text = two($ak,array("a","O"),$akreplace,array("",""),0);
    echo "<p class = sa >By prathamayoH pUrvasavarNaH (6.1.102) :</p>
        <p class = hn >N.B. : This applies to only in prathamA and dvitIyA vibhakti, and not in other cases. </p>";
    echo "<p class = sa >प्रथमयोः पूर्वसवर्णः (६.१.१०२) :</p>
        <p class = hn >यह प्रथमा और द्वितीया विभक्तियों में लागू होता है ।</p>";
    display (0); $prathamayoh = 1;
} else { $prathamayoh = 0; }
/* tasmAcChaso naH puMsi (6.1.103) */
if ($prathamayoh ===1 && $so === "Sas" && $gender==="m")
{
    $text = one(array("+s"),array("+n"),0);
    echo "<p class = sa >By tasmAcChaso naH puMsi (6.1.103) :</p>";
    echo "<p class = sa >तस्माच्छसो नः पुंसि (६.१.१०३) :</p>";  
    display(0); $tasmat = 1; $second = "an";
} else { $tasmat = 0; }
/* ato guNe (6.1.17) */
if (sub(array("a"),array("a","e","o"),blank(0),0) && !sub(array("pra","upa"),array("a","e","o"),blank(0),0) && $pada === "pratyaya" && $gogo===0)
{
    $text = two(array("a"),array("a","e","o"),blank(1),array("a","e","o"),0);
    echo "<p class = sa >By ato guNe (6.1.17) :</p>";
    echo "<p class = sa >अतो गुणे (६.१.१७) :</p>";  $ato = 1;
    display(0);
} else { $atogune = 0; } 
/* hrasvasya guNaH (7.3.108) */
if (arr($text,'/[iufx][+][s]/') && $so==="su!" && $sambuddhi===1 && $amba===0)
{
    $text = two(array("i","u","f","x"),array("+"),array("e","o","ar","al"),array("+"),0);
    echo "<p class = sa >By hrasvasya guNaH (7.3.108) :</p>";
    echo "<p class = sa >ह्रस्वस्य गुणः (७.३.१०८) :</p>";
    display(3);
}
if (arr($text,'/[iufx][+]$/') && $so==="su!" && $sambuddhi===1 && $svamo===1)
{
    $text = two(array("i","u","f","x"),array("+"),array("e","o","ar","al"),array("+"),1);
    echo "<p class = sa >By hrasvasya guNaH (7.3.108) :</p>";
    echo "<p class = sa >ह्रस्वस्य गुणः (७.३.१०८) :</p>";
    display(3);
}
/* eGhrasvAtsambuddheH (6.1.69) and ekavacanaM sambuddhiH (2.3.49) */ // removed the last letter, not as in sutra. Look out for issues if any crops up.
if ($sambuddhi === 1 && $so === "su!" && (sub($hrasva,array("+"),array("s","m"),0)||sub(array("e","o"),array("+"),array("s","m"),0)))
{
    foreach ($text as $value)
    {
        if(substr($value,-1)!=="+")
        {
            $value1[] = substr($value,0,strlen($value)-1);
        }
        else
        {
            $value1[] = $value;
        }
    }
    $text = $value1;
    $value1 = array();
    echo "<p class = sa >By eGhrasvAtsambuddheH (6.1.69) :</p>";
    echo "<p class = sa >एङ्ह्रस्वात्सम्बुद्धेः (६.१.६९) :</p>";  $ato = 1;
    display(0); $eg = 1;
} else { $eg = 0; }


/* Rti savarNe R vA (vA 3640) and lRti savarNe lR vA (vA 3641) */
$ruti1 = array("f","F","x","X");
$ruti2 = array("f");
$lruti2 = array("x");
if (sub($ruti1,array("f","x"),blank(0),0))
{
$text = two($ruti1,array("f"),blank(count($ruti1)),$ruti2,1);
$text = two($ruti1,array("x"),blank(count($ruti1)),$lruti2,1);
echo "<p class = sa >By Rti savarNe R vA (vA 3640) and lRti savarNe lR vA (vA 3641) :</p>";
echo "<p class = sa >ऋति सवर्णे ऋ वा (वा ३६४०) तथा लृति सवर्णे लृ वा (वा ३६४१) :</p>";
display(0); $rutrut = 1;
} else { $rutrut = 0; } 
/* akaH savarNe dIrghaH (6.1.101) */ 
$ak1 = array("a","a","A","A","i","i","I","I","u","u","U","U","f","f","F","F","f","f","F","F","x","x","X","X","x","x","X","X");
$ak2 = array("a","A","a","A","i","I","i","I","u","U","u","U","f","F","f","F","x","X","x","X","f","F","f","F","x","X","x","X");
if (sub($ak1,$ak2,blank(28),1) && $atogune !== 1)
{
$text = two(array("a","A"),array("a","A"),array("A","A"),blank(2),0);
$text = two(array("i","I"),array("i","I"),array("I","I"),blank(2),0);
$text = two(array("u","U"),array("u","U"),array("U","U"),blank(2),0);
$text = two(array("f","F","x","X"),array("f","F","x","X"),array("F","F","F","F"),blank(4),0);
$text = two(array("x","X"),array("x","X"),array("F","F"),blank(2),0);
echo "<p class = sa >By akaH savarNe dIrghaH (6.1.101) :</p>";
echo "<p class = sa >अकः सवर्णे दीर्घः (६.१.१०१) :</p>";
display(0);
}
/* dazca (7.2.109) */
if (sub(array("ida","idaka","idA","idAn"),array("+"),blank(0),0) && in_array($fo,array("idam","idakam")) && in_array($so,$sup))
{
    $text = one(array("ida+","idaka+","idA+","idAn+"),array("ima+","imaka+","imA+","imAn+"),0);
    echo "<p class = sa >By dazca (7.2.109) :</p>";
    echo "<p class = sa >दश्च (७.२.१०९) :</p>";
    display(3);
}
/* iko yaNaci (6.1.77) */
if(sub(array('i','I','u','U'),prat('ac'),blank(0),0))
{
$text = two(array('i','I','u','U'),prat('ac'),array('y','y','v','v'),prat('ac'),0);
echo "<p class = sa >By iko yaNaci (6.1.77) :</p>";
echo "<p class = sa >इको यणचि (६.१.७७) :</p>";
display(4);
}
if(sub(array("f","F","x","X"),prat('ac'),blank(0),0))
{
$text = two(array("f","F","x","X"),prat('ac'),array("r","r","l","l"),prat('ac'),0);
echo "<p class = sa >By iko yaNaci (6.1.77) :</p>";
echo "<p class = sa >इको यणचि (५.१.७७) :</p>";
$sthanivadbhav = 1;
display(4); 
}
else
{
$sthanivadbhav = 0; 
}
/* sarvatra vibhASA goH (6.1.122) */ 
$go = array("go"); $aonly = array("a");
if(sub($go,$aonly,blank(0),0) && ( $pada==="pada" || $bham===1 || sub(array("goanc"),blank(0),blank(0),0)))
{
$text = two($go,$aonly,array("go "),$aonly,1);
echo "<p class = sa >By sarvatra vibhASA goH (6.1.122)</p>
    <p class = hn >it is optionally kept as prakRtibhAva :</p>";
echo "<p class = sa >सर्वत्र विभाषा गोः (६.१.१२२)</p>
    <p class = hn >पाक्षिक रूप से प्रकृतिभाव भी होता है ।</p>";
display(0); $gogo = 1;
} else { $gogo = 0; } 
/* avaG sphoTAyanasya (6.1.123) */
if (sub($go,prat('ac'),blank(0),0) && ( $pada==="pada" || $bham===1 || sub(array("goanc"),blank(0),blank(0),0))  )
{
$text = two($go,prat('ac'),array('gava'),prat('ac'),1);
echo "<p class = sa >By avaG sphoTAyanasya (6.1.123) </p>
    <p class = hn >it is optionally converted to avaG :</p>";
echo "<p class = sa >अवङ्‌ स्फोटायनस्य (६.१.१२३) </p>
    <p class = hn >पाक्षिक रूप से अवङ्‌ भी होता है ।</p>";
display(0); $gogo1 = 1;
} else { $gogo1 = 0; }
/* indre ca (6.1.124) */
if (sub($go,array("indra"),blank(0),0)  && ( $pada==="pada" || $bham===1 || sub(array("goanc"),blank(0),blank(0),0)))
{
$text = two($go,array("indra"),array('gava'),array("indra"),0);
echo "<p class = sa >by indre ca (6.1.124) :</p>";
echo "<p class = sa >इन्द्रे च (६.१.१२४) :</p>";
display(0); $gogo2 = 1;
} else { $gogo2 = 0; }
/* eGaH padAntAdati (6.1.109) */
if (sub(array("e","o"),array("a"),blank(0),0)  && ( $pada==="pada" || $bham===1 || sub(array("goanc"),blank(0),blank(0),0)))
{
    $text = two(prat('eN'),array("a"),prat('eN'),array("'"),0);
    echo "<p class = sa >By eGaH padAntAdati (6.1.109) : </p>";
    echo "<p class = sa >एङः पदान्तादति (६.१.१०९) : </p>";
    display(0);
}
/* eco'yavAyAvaH (7.1.78) */
$ayavayavah = array("ay","av","Ay","Av");
if (sub(prat('ec'),prat('ac'),blank(0),0))
{
$text = two(prat('ec'),prat('ac'),$ayavayavah,prat('ac'),0);
echo "<p class = sa >By echo'yavAyAvaH (7.1.78) :</p>";
echo "<p class = sa >एचोऽयवायावः (७.१.७८) :</p>";
display(4);
$bho = 1;
} else { $bho = 0; }
/* vAnto yi pratyaye (6.1.71), goryutau CandasyupasaMkhyAnam (vA 3543), adhvaparimANe ca (vA 3544) dhAtostannimittasyaiva (6.1.80) */
$o = array("o","O"); $oo = 'oO'; $y = array("y"); $ab = array("av","Av");
$dhato = array("urRo","ro","no","sno","kzo","kzRo","Do","Dro","do","dro","sro","so","ko","Go","qo","cyo","jyo","pro","plo","ro","ho","Sro","hno","dyo","sko","po","lo","kno","mo","Bo","urRO","rO","snO","kzO","kzRO","DO","DrO","dO","drO","srO","sO","kO","GO","qO","cyO","jyO","prO","plO","rO","hO","SrO","hnO","dyO","skO","pO","lO","knO","mO","BO","Co","zo","So");
$dhato1 = array("urRa","ra","na","sna","kza","kzRa","Da","Dra","da","dra","sra","sa","ka","Ga","qa","cya","jya","pra","pla","ra","ha","Sra","hna","dya","ska","pa","la","kna","ma","Ba","urRA","rA","snA","kzA","kzRA","DA","DrA","dA","drA","srA","sA","kA","GA","qA","cyA","jyA","prA","plA","rA","hA","SrA","hnA","dyA","skA","pA","lA","knA","mA","BA","Ca","za","Sa");
$text1 = $text;
if (sub($dhato,$y,blank(0),0) && $pada ==="pratyaya" && $start ===1)
{
$text = two($dhato,$y,$dhato1,array("vy"),0);
    echo "<p class = sa >By dhAtostannimittasyaiva (6.1.77)  : </p>";
    echo "<p class = sa >धातोस्तन्निमित्तस्यैव (६.१.७७) : </p>";
    display(0);
} 
if (sub($o,$y,blank(0),0) && $pada ==="pratyaya" && !sub($dhato,$y,blank(0),0))
{
    if (sub(array("gav"),$y,blank(0),0))
    {
    $text = two($o,$y,$ab,$y,0);
    echo "<p class = sa >By vAnto yi pratyaye (6.1.71), goryutau CandasyupasaMkhyAnam (vA 3543), adhvaparimANe ca (vA 3544)  : </p>
        <p class = hn > If the 'y' following 'o/O' belongs to a pratyaya or the word 'go' is followed by 'yuti' in Chandas/ as a measure of distance (vA 3543, 3544).</p>";
    echo "<p class = sa >वान्तो यि प्रत्यये (६.१.७१), गोर्यूतौ छन्दस्युपसंख्यानम्‌ (वा ३५४३), अध्वपरिमाणे च (वा ३५४४)  : </p>
        <p class = hn > यकारादि प्रत्यय के परे रहते या वैदिक भाषा / अध्वपरिमाण के अर्थ में यूति शब्द परे हो तब यह नियम लागू होता है ।</p>";        
    }
    elseif (sub(array("o","O"),array("yat"),blank(0),0))
    {
    echo "<p class = sa >By dhAtostannimittasyaiva (6.1.77)  : </p>";
    echo "<p class = hn >Here the 'o' is because of 'y'. Therefore This doesn't apply. </p>";
    echo "<p class = sa >धातोस्तन्निमित्तस्यैव (६.१.७७) :</p>";                
    echo "<p class = hn >ओयते में ओकार यकारनिमित्तक नहीं होने के कारण इस सूत्र से अवादेश नहीं हुआ ।</p>";                
    }
    else
    {
    $text = two($o,$y,$ab,$y,0);
    echo "<p class = sa >By vAnto yi pratyaye (6.1.71) : </p>";
    echo "<p class = sa >वान्तो यि प्रत्यये (६.१.७१) :</p>";        
    }
    display(0);
}
/* kSayyajayyau zakyArthe (6.1.81)*/
if (sub(array("kze"),array("ya"),blank(0),0)  && $pada ==="pratyaya" && $start === 1)
{
    $text = two(array("kze"),array("ya"),array("kzay"),array("ya"),1);
    echo "<p class = sa >By kSayyajayyau zakyArthe (6.1.81) :</p>
        <p class = hn >If the word is to be used in the meaning of 'being capable of', then only it will be क्षय्य.</p>";
    echo "<p class = sa >क्षय्यजय्यौ शक्यार्थे (६.१.८१) :</p>
        <p class = hn >यदि क्षय कर सकने के  अर्थ में प्रयोग होता है तभी क्षय्य होगा ।</p>";
    display(0);    
}
if (sub(array("je"),array("ya"),blank(0),0) && $pada ==="pratyaya" && $start === 1)
{
        $text = two(array("je"),array("ya"),array("jay"),array("ya"),1);
    echo "<p class = sa >By kSayyajayyau zakyArthe (6.1.81) :</p>
        <p class = hn >If the word is to be used in the meaning of 'being capable of', then only it will be जय्य.</p>";
    echo "<p class = sa >क्षय्यजय्यौ शक्यार्थे (६.१.८१) :</p>
        <p class = hn >यदि जय कर सकने के  अर्थ में प्रयोग होता है तभी जय्य होगा ।</p>";
    display(0);
}
/* krayyastadarthe (6.1.82) */
if (sub(array("kre"),array("ya"),blank(0),0)  && $pada ==="pratyaya" && $start ===1)
{
    
    $text = two(array("kre"),array("ya"),array("kray"),array("ya"),1);
    echo "<p class = sa >By krayyastadarthe (6.1.82) :</p>
        <p class = hn >If the word is to be used in the meaning of 'for sale', then only it will be क्रय्य.</p>";
     echo "<p class = sa >क्रय्यस्तदर्थे (६.१.८२) :</p>
        <p class = hn >यदि बेचने के लिये रखा हुआ इस अर्थ में प्रयोग हो तभी क्रय्य शब्द बनता है </p>";
    display(0);
}
/* khyatyAtparasya (6.1.112) */
if (arr($text,'/[Kt][y][+][a]/')  && arr(array($fo),'/[Kt][iI]$/') && in_array($so,array("Nasi!","Nas")) && $pada==="pratyaya")
{
    $text = three(array("Ky","ty"),array("+"),array("a"),array("Ky","ty"),array("+"),array("u"),0);
    echo "<p class = sa >By khyatyAtparasya (6.1.112) :</p>";
    echo "<p class = sa >ख्यत्यात्परस्य (६.१.११२) :</p>";
    display(0);
}
if (sub(array("lUny","kzAmy","prastImy"),array("+"),blank(0),0) && in_array($so,array("Nasi!","Nas")) && $pada==="pratyaya")
{
    $text = three(array("lUny","kzAmy","prastImy"),array("+"),array("a"),array("lUny","kzAmy","prastImy"),array("+"),array("u"),0);
    echo "<p class = sa >By khyatyAtparasya (6.1.112) :</p>";
    echo "<p class = sa >ख्यत्यात्परस्य (६.१.११२) :</p>";
    display(0);
}

/* Exceptions to sasajuSo ruH */
/* etattadoH sulopo'konaJsamAse hali (6.1.132) */
if (sub(array("sas","ezas"),$hl,blank(0),0)  && !sub(array("asa","anEza"),array("s"),$hl,0) && in_array($fo,array("sas","ezas")))
{
    $text = two(array("sas","ezas"),$hl,array("sa ","eza "),$hl,1);
    echo "<p class = sa >By etattadoH sulopo&konaJsamAse hali (6.1.132) :</p>";
    echo "<p class = sa >एतत्तदोः सुलोपोऽकोऽनञ्समासे हलि (६.१.१३२)) :</p>";
    display(0);
}
/* so'ci lope cetpAdapUraNam (6.1.134) */
if (sub(array("sa"),array("s"),$ac,0))
{
    $text = three(array("sa"),array("s"),$ac,array("sa"),array(""),$ac,1);
    echo "<p class = sa >so'ci lope cetpAdapUraNam (6.1.134) :</p>
        <p class = hn >N.B. : There is difference of opinion here. vAmana thinks that it applies only to RkpAda. Others think that it applies to zlokapAda also e.g. 'saiSa dAzarathI rAmaH'.</p>";
    echo "<p class = sa >सोऽचि लोपे चेत्पादपूरणम्‌ (६.१.१३४) :</p>
        <p class = hn >यहाँ मतान्तर है । वामन के मत में यह केवल ऋक्पाद में लागू होता है । अन्यों के मत में यह श्लोकपाद में भी लागू होता है । जैसे कि सैष दाशरथी रामः ।</p>";
    display(0);
}
/* vasusraMsudhvaMsvanaDuhAM daH (8.2.72) */
$vasu1 = array("sraMs","DvaMs","anaquh");
if (sub($vasu1,blank(0),blank(0),0)  && $pada ==="pada")
{
    $text = one($vasu1,array("srad","Dvad","anaqud"),0);
    echo "<p class = sa >By vasusraMsudhvaMsvanaDuhAM daH (8.2.72) :</p>";
     echo "<p class = sa >वसुस्रंसुध्वंस्वनडुहां दः (८.२.७२) :</p>";
    display(0); 
}
if ((sub(array("vidvas","sedivas","uzivas","Suzruvas","upeyivas","anASvas"),array("+"),blank(0),0))  && $pada ==="pada" && !arr($text,'/[s][+]$/'))
{
    $text = one(array("vidvas","sedivas","uzivas","Suzruvas","upeyivas","anASvas"),array("vidvad","sedivad","uzivad","Suzruvad","upeyivad","anASvad"),0);
    echo "<p class = sa >By vasusraMsudhvaMsvanaDuhAM daH (8.2.72) :</p>
        <p class = hn >N.B. : If 'vas' is used in sense of vasupratyayAnta as in 'vidvas', then only this conversion takes place. Not in cases like 'zivas'.</p>";
     echo "<p class = sa >वसुस्रंसुध्वंस्वनडुहाः दः (८.२.७२) :</p>
        <p class = hn >यदि वसुप्रत्ययान्त शब्द जैसे कि विद्वस्‌ इत्यादि में यह नियम लागू होता है । शिवस्‌ जैसे शब्दों में नहीं ।</p>";
   display(0); 
}
/* saMyogAnta patch for asmad / yuSmad */
if (arr($text,'/['.pc('hl').'][s]$/') )
{
    $text = last(array("nas","vas"),array("nass","vass"),0);
   $text = last(array("s"),array(""),0);
    echo "<p class = sa >By saMyogAntasya lopaH (8.2.23) :</p>";
    echo "<p class = sa >संयोगान्तस्य लोपः (८.२.२३) :</p>";
   display(0);
}
/* patch for asiddhatva of SakAra of pratyaya as in pipaThiS */
if (arr($text,'/[z][+]/') && $pada==="pada")
{
   $text = two(array("z"),array("+"),array("r@"),array("+"),0); $R=array_merge($R,array(1));
    echo "<p class = sa >Satva is asiddha to rutva. Therefore sasajuSo ruH applies. </p>";
    echo "<p class = sa >रुत्वं प्रति षत्वस्यासिद्धत्वात्‌ ससजुषो रुः इति रुत्वम्‌ ।</p>";
   display(0);
}
/* sasajuSo ruH (8.2.66) */
if ((arr($text,'/[s][a][j][u][z][+]/') && $start===1  && $pada ==="pada" ))//&& $eg !== 1) )
{
    $text = one(array("z+",),array("r@+",),0); $R=array_merge($R,array(1));
    echo " <p class = hn >You have entered a visarga at the end of the first word. Usually it is derived from a sakAra at the end of the word.</p>";
    echo " <p class = hn >आपने प्रथम शब्द के अन्त में विसर्ग का प्रयोग किया है । सामान्यतः यह सकारान्त शब्द से उद्भव होता है ।</p>";
       display(0);
}
if ((arr($text,'/[H][+]/') && $start===1  && $pada ==="pada" ))//&& $eg !== 1) )
{
    $text = one(array("H+",),array("r@+",),0); $R=array_merge($R,array(1));
    echo " <p class = hn >You have entered a visarga at the end of the first word. Usually it is derived from a sakAra at the end of the word.</p>";
    echo " <p class = hn >आपने प्रथम शब्द के अन्त में विसर्ग का प्रयोग किया है । सामान्यतः यह सकारान्त शब्द से उद्भव होता है ।</p>";
       display(0);
}
if (arr($text,'/[aAiIuUfFxXeEoO][s][+]/') && $start===1  && ( $pada ==="pada" || $so==="su!" ))// && $eg !== 1) )
{
    $text = one(array("s+"),array("r@+"),0); $R=array_merge($R,array(1));
    echo " <p class = sa >By sasajuSo ruH (8.2.66) :</p>";
    echo " <p class = sa >ससजुषो रुः (८.२.६६) :</p>";
       display(0); $r1=1;
}
elseif ($start>1 && $r1!==0) { $r1 = 1; } else {$r1=0; }
if ((arr($text,'/[^'.pc('hl').'][s]$/') ) && $start===1 )//&& $eg !==1 )
{
    $text = last(array("s"),array("r@"),0); $R=array_merge($R,array(1));
     echo "<p class = sa >By sasajuSo ruH (8.2.66) :</p>"; 
     echo "<p class = sa >ससजुषो रुः (८.२.६६) :</p>";$r2 = 1;
     display(0);
}
elseif ($start>1 && $r2!==0) 
    {
    $r2 = 1; 
    } 
else 
    {
    $r2=0; 
    }
if (arr($text,'/[H]$/') && $start===1  && $pada ==="pada" )//&& $eg !==1 )
{
     $text = last(array("H"),array("r@"),0); $R=array_merge($R,array(1));
      echo " <p class = hn >You have entered a visarga at the end of the second word. Usually it is derived from a sakAra at the end of the word.</p>";
    echo " <p class = hn >आपने द्वितीय शब्द के अन्त में विसर्ग का प्रयोग किया है । सामान्यतः यह सकारान्त शब्द से उद्भव होता है ।</p>";
     echo "<p class = sa >By sasajuSo ruH (8.2.66) :</p>"; 
      echo "<p class = sa >ससजुषो रुः (८.२.६६) :</p>";$r1= 1;
     display(0);
}
/* ahan(8.2.68) and ro'supi (8.2.69) and rUparAtrirathantareSu vAcyam (vA 4847) */ 
$noahan = array("vftrahan");
if (sub(array("ahan","AhaAn"),array("+"),blank(0),0) && !sub($noahan,blank(0),blank(0),0) && $first === "ahan" && !(in_array($so,$sup)) && $pada==="pada")
{ 
    if ((strpos($so,"rUp")===0)||(strpos($so,"rAtr")===0)||(strpos($so,"raTantar")===0))
    {
    $text = one(array("ahan","Ahan"),array("ahar@","Ahar@"),0); $R=array_merge($R,array(1));
    echo "<p class = sa >By ahan (8.2.68) and rUparAtrirathantareSu vAcyam (vA 4847).</p>";
     echo "<p class = sa >अहन्‌ (८.२.६८) तथा रूपरात्रिरथन्तरेषु वाच्यम्‌ (वा ४८४७) ।</p>";
     display(0);
    }
    else 
    {
    $text = one(array("ahan","Ahan"),array("ahar","Ahan"),0);
        echo "<p class = sa >ro'supi (8.2.69) :</p>";
     echo "<p class = sa >रोऽसुपि (८.२.६९) :</p>";
     display(0);
    }
}
if ( (arr($text,'/[aA][h][a][n]$/')||arr($text,'/[aA][h][a][n][+]/') )&& !sub($noahan,blank(0),blank(0),0) && (in_array($so,$sup)) && $pada === "pada")
{
     echo "<p class = sa >By ahan (8.2.68) :</p>";
     echo "<p class = hn >This creates a nipAta for ahan, and shows that the na lopaH prAtipadikAntasya doesn't apply here.</p>";
     echo "<p class = sa >अहन्‌ (८.२.६८) :</p>";
     echo "<p class = hn >अनेन नलोपाभावं निपात्यते ।</p>";
     display(0);
    $text = one(array("ahan","Ahan"),array("ahar@","Ahar@"),0); $R=array_merge($R,array(1));
     echo "<p class = sa >By ahan (8.2.68) :</p>";
     echo "<p class = hn >This mandates rutva here.</p>";
     echo "<p class = sa >अहन्‌ (८.२.६८) :</p>";
     echo "<p class = hn >अनेन रुर्विधेयः ।</p>";
   display(0); $r3 = 1;
} else { $r3 = 0; }
/* samaH suTi (8.3.5) */ // have used @ as mark of anunAsika u of ru. 
if (sub(array("sam"),array("s"),array("k"),0))
{
$text = three(array("sam"),array("s"),array("k"),array("saMr@"),array("s"),array("k"),0);
$text = one(array("Mr@"),array("!r@"),1); $R=array_merge($R,array(1));
echo "<p class = sa >By samaH suTi (8.3.5), atrAnunAsikaH pUrvasya tu vA (8.3.2) and anunAsikAtparo'nusvAraH (8.3.4) :</p>";
echo "<p class = sa >समः सुटि (८.३.५), अत्रानुनासिकः पूर्वस्य तु वा (८.३.२) तथा अनुनासिकात्परोऽनुस्वारः (८.३.४) :</p>";
display(0); $r4 = 1;
} else { $r4 = 0; }
/* khyAYAdeze na (vA 1591) */
if (sub(array("pum"),array("Ky"),blank(0),0))
{
echo "<p class = sa >By khyAYAdeze na (vA 1591) :</p>";
echo "<p class = sa >ख्याञादेशे न (वा १५९१) :</p>";
display(0); $pum = 1;
} else { $pum = 0; }
/* pumaH khayyampare (8.3.6) */
$am = array("a","A","i","I","u","U","f","F","x","X","e","o","E","O","h","y","v","r","l","Y","m","N","R","n");
if(sub(array("pum"),prat('Ky'),$am,0) && $pum === 0)
{
$text = three(array("pum"),prat('Ky'),$am,array("puMr@"),prat('Ky'),$am,0);
$text = one(array("Mr@"),array("!r@"),1);
echo "<p class = sa >By pumaH khayyampare (8.3.6), atrAnunAsikaH pUrvasya tu vA (8.3.2) and anunAsikAtparo'nusvAraH (8.3.4) :</p>";
echo "<p class = sa >पुमः खय्यम्परे (८.३.६), अत्रानुनासिकः पूर्वस्य तु वा (८.३.२) तथा अनुनासिकात्परोऽनुस्वारः (८.३.४) :</p>";
display(0); $r5 = 1;
} else { $r5 = 0; }
/* nazChavyaprazAn (8.3.7) */
if (sub(array("n"),prat('Cv'),$am,0) && arr($text,'/[n][+]['.pc('Cv').']/') && $pada ==="pada")
{
$text = three(array("n"),prat('Cv'),$am,array("Mr@"),prat('Cv'),$am,0); $R=array_merge($R,array(1));
$text = one(array("praSAMr@"),array("praSAn"),0);
$text = one(array("Mr@"),array("!r@"),1);
echo "<p class = sa >By nazChavyaprazAn (8.3.7), atrAnunAsikaH pUrvasya tu vA (8.3.2) and anunAsikAtparo'nusvAraH (8.3.4) :</p>";
echo "<p class = sa >नश्छव्यप्रशान्‌ (८.३.७), अत्रानुनासिकः पूर्वस्य तु वा (८.३.२) तथा अनुनासिकात्परोऽनुस्वारः (८.३.४)  :</p>";
display(0); $r6 = 1;
} else { $r6 = 0; }
/* nRUnpe (8.3.10) */
if (sub(array("nFn"),array("p"),blank(0),0)  && $pada ==="pada")
{
$text = two(array("nFn"),array("p"),array("nFMr@"),array("p"),0);
$text = one(array("Mr@"),array("!r@"),1);
echo "<p class = sa >By nRUnpe (8.3.10), atrAnunAsikaH pUrvasya tu vA (8.3.2) and anunAsikAtparo'nusvAraH (8.3.4) </p>";
echo "<p class = sa >नॄन्पे (८.३.१०), अत्रानुनासिकः पूर्वस्य तु वा (८.३.२) तथा अनुनासिकात्परोऽनुस्वारः (८.३.४) : </p>";
display(0); $r7 = 1;
} else { $r7 =0;}
/* svatavAn pAyau (8.3.11) */
if (sub(array("svatavAn"),array("pAyu"),blank(0),0)  && $pada ==="pada")
{
$text = two(array("svatavAn"),array("pAyu"),array("svatavA! "),array("pAyu"),0);
echo "<p class = sa >By svatavAn pAyau (8.3.11), atrAnunAsikaH pUrvasya tu vA (8.3.2)</p>";
echo "<p class = sa >स्वतवान्पायौ (८.३.११), अत्रानुनासिकः पूर्वस्य तु वा (८.३.२) : </p>";
display(0); $r8 = 1;
} else { $r8 =0;}
/* kAnAmreDite (8.3.12) */ 
if (sub(array("kAn"),array("kAn"),blank(0),0))
{
$text = two(array("kAn"),array("kAn"),array("kAMr@"),array("kAn"),0); $R=array_merge($R,array(1));
$text = one(array("Mr@"),array("!r@"),1);
echo "<p class = sa >By kAnAmreDite (8.3.12), atrAnunAsikaH pUrvasya tu vA (8.3.2) and anunAsikAtparo'nusvAraH (8.3.4) :</p>";
echo "<p class = sa >कानाम्रेडिते (८.३.१२), अत्रानुनासिकः पूर्वस्य तु वा (८.३.२) तथा अनुनासिकात्परोऽनुस्वारः (८.३.४)  :</p>";
display(0); $r8 = 1;
} else { $r8 =0; }
/* ato roraplutAdaplute (6.1.113) */
if (sub(array("ar@"),array("a"),blank(0),0))
{
    $text = two(array("ar@"),array("a"),array("au"),array("a"),0);
    echo "<p class = sa >By ato roraplutAdaplute (6.1.113) :</p>";
    echo "<p class = sa >अतो रोरप्लुतादप्लुते (६.१.११३) :</p>";
    display (0); $ato = 1;
} else {$ato = 0;}
/* hazi ca (6.1.114) */
if (sub(array("a"),array("r@"),prat('hS'),0))
{
    $text = three(array("a"),array("r@"),prat('hS'),array("a"),array("u"),prat('hS'),0);
    echo "<p class = sa >By hazi ca (6.1.114) :</p>";
    echo "<p class = sa >हशि च (६.१.११४) :</p>";
    display (0); $hazi = 1;
} else { $hazi = 0; } 
/* ekaH pUrvaparayoH (6.1.84) */ // This is the adhikArasUtra. No vidhi mentioned.
// The following vArtikas are exception to AdguNaH. Otherwise after joining, it will be difficult to identify. So coded here.
/* akSAdUhinyAmupasaMkhyAnam (vA 3604) */
/* svAdireriNoH (vA 3606) */
/*prAdUhoDhoDyeSaiSyeSu (vA 3605) */
/* Rte ca tRtIyAsamAse (vA 3607) */
/* pravatsatarakambalavasanadazArNAnAmRNe (vA 3608-9) */
$v1 = array('akza','sva','pra','pra','pra','pra','suKa','pra','vatsatara','kambala','vasana','daSa','fRa','sva');
$v2 = array('Uhin','ir','Uh','UQ','ez','ezy','ft','fR','fR','fR','fR','fR','fR','Ir');
$v3 = array('akz','sv','pr','pr','pr','pr','suK','pr','vatsatar','kambal','vasan','daS','fR','sv');
$v4 = array('OhiR','Er','Oh','OQ','Ez','Ezy','Art','ArR','ArR','ArR','ArR','ArR','ArR','Er');
if (sub($v1,$v2,blank(0),0) && $pada === "pada")
{
$text = two($v1,$v2,$v3,$v4,0);
echo "<p class = sa >Applying the following vArtikas : akSAdUhinyAmupasaMkhyAnam (vA 3604), svAdireriNoH (vA 3606), prAdUhoDhoDyeSaiSyeSu (vA 3605), Rte ca tRtIyAsamAse (vA 3607), pravatsatarakambalavasanadazArNAnAmRNe (vA 3608-9)</p>";
echo "<p class = sa >अक्षादूहिन्यामुपसंख्यानम्‌ (वा ३६०४), स्वादेरेरिणोः (वा ३६०६), प्रादूहोढोढ्येषैष्येषु (वा ३६०५), ऋते च तृतीयासमासे (वा ३६०७), प्रवत्सतरकम्बलवसनदशार्णानामृणे (वा ३६०८-०९)</p>";
display(0);
}
/* etyedhatyuThsu (6.1.89) */ 
if (sub(array("a","A"),array("eti","ezi","emi","etu","Et","EtAm","EH","Es","Etam","Eta","Eva","Ema","ezyati","Ezyati","etA","eD","ED","Uh"),blank(0),0))
{
    $text = two (array("a","A"),array("eti","ezi","emi","etu","Et","EtAm","EH","Es","Etam","Eta","Eva","Ema","ezyati","Ezyati","etA","eD","ED","Uh"),blank(2),array("Eti","Ezi","Emi","Etu","Et","EtAm","EH","Es","Etam","Eta","Eva","Ema","Ezyati","Ezyati","EtA","ED","ED","Oh"),0);
    echo "<p class = sa >By etyedhatyuThsu (6.1.89) :</p>";
    echo "<p class = sa >एत्येधत्यूठ्सु (६.१.८९) :</p>";
    display(0);
}
/* AdguNaH (6.1.87) */
$forguna = array("i","I","u","U");
$rep = array("e","e","o","o");
if (sub($aa,$forguna,blank(0),0))
{
$text = two($aa,$forguna,blank(2),$rep,0);
echo "<p class = sa >By AdguNaH (6.1.87) :</p>";
echo "<p class = sa >आद्गुणः (६.१.८७) :</p>";
display(0);
}
/* uraNraparaH (1.1.51) */ 
$forguna = array("f","F","x","X");
$rep = array("ar","ar","al","al");
if (sub($aa,$forguna,blank(0),0))
{
$text = two($aa,$forguna,blank(2),$rep,0);
echo "<p class = sa >By AdguNaH (6.1.87) and uraNraparaH (1.1.51) :</p>";
echo "<p class = sa >आद्गुणः (६.१.८७) तथा उरण्रपरः (१.१.५१) :</p>";
display(0);
}
/* eGi pararUpam (6.1.94) */ // Added it here because it is exception to vRddhireci.
for($i=0;$i<count($akarantaupasarga);$i++)
{
    $a_upa_without_a[$i] = substr($akarantaupasarga[$i],0,count(str_split($akarantaupasarga[$i]))-1); 
}
if (sub($akarantaupasarga,prat('eN'),blank(0),0) && arr($text,'/[I][y]/') && in_array($first,$akarantaupasarga))
{
$text = two($akarantaupasarga,prat('eN'),$a_upa_without_a,prat('eN'),1);
echo "<p class = sa >By eGi pararUpam (6.1.94) and anuvRtti of vA supi :</p>";
echo "<p class = sa >एङि पररूपम्‌ (६.१.९४) तथा वा सुपि की अनुवृत्ति :</p>";
display(0);
}
elseif (sub($akarantaupasarga,prat('eN'),blank(0),0) && in_array($first,$akarantaupasarga))
{
$text = two($akarantaupasarga,prat('eN'),$a_upa_without_a,prat('eN'),0);
echo "<p class = sa >By eGi pararUpam (6.1.94) :</p>";
echo "<p class = sa >एङि पररूपम्‌ (६.१.९४) :</p>";
display(0);
}
/* eve cAniyoge (vA 3631) */
$eva = array("eva");
if (sub($aa,$eva,blank(0),0))
{
$text = two($aa,$eva,blank(2),$eva,1);
echo "<p class = sa >By eve cAniyoge (vA 3631) :</p>
    <p class = hn >N.B. that the optionality applies only in case the eva is used for avadhAraNa.</p>" ;
echo "<p class = sa >एवे चावधारणे (वा ३६३१) :</p>
    <p class = hn >जब 'एव' अवधारण के अर्थ में प्रयुक्त हुआ हो, तभी यह नियम लागू होता है ।</p>" ;
display(0);
}
/* vA supyapizaleH (6.1.92) */ // Not possible to know what is nAmadhAtu and what is not. Therefore added as comments. Not coded.
/* aco'ntyAdi Ti (1.1.64) */ // a saJjJAsUtra. No vidhi mentioned.
/* otvoShThayoH samAse vA (vA 3634) */
$otu = array("otu","ozW");
if (sub($aa,$otu,blank(0),0))
{
$text = two($aa,$otu,blank(2),$otu,1);
echo "<p class = sa >By otvoShThayoH samAse vA (vA 3634) :</p>
    <p class = hn >If what you entered is a samAsa, it will be optionally converted. Otherwise ignore the pararUpa form.</p>";
echo "<p class = sa >ओत्वोष्ठ्योः समासे वा (वा ३६३४) :</p>
    <p class = hn >यदि समास है तभी यह नियम लागू होगा । अन्यथा पररूप वाला रूप नहीं बनेगा ।</p>";
display(0);
}
/* nAmreDitasyAntasya tu vA (6.1.99), tasya paramAmreDitam (8.1.2) */
for($i=0;$i<count($text);$i++)
{
    $tttt = explode("at",$text[$i]);
    if (count($tttt) > 1 )
    {
    if ($tttt[0] === $tttt[1])
    {
        //echo "<p class = hn >Your data matches criteria for AmreDita.</p>";
        $amredita = 1;
        break;
    }
    else
    {
        $amredita = 0;
    }
    }
    else
    {
        $amredita = 0;
    }
}
if (($amredita === 1) && $start === 1)
{
$at = array("at");
$iti = array("iti");
$text = two($at,$iti,array("a"),$iti,1);
echo "<p class = sa >nAmreDitasyAntasya tu vA (6.1.99), tasya paramAmreDitam (8.1.2) :</p>
    <p class = hn >When the 'at' happens to be at the end of an onaematopic word and it is followed by 'iti', its 'Ti' is elided. This rule doesn't apply on single vowel words like 'zrat'.</p>";
echo "<p class = sa >नाम्रेडितस्यान्तस्य तु वा (६.१.९९), तस्य परमाम्रेडितम्‌ (८.१.२) :</p>
    <p class = hn >आम्रेडित में यह नियम लागू वैभाषिक तौर से होता है, और अन्तिम तकार का होता है । एकाच्‌ शब्दों में, जैसे कि श्रत्‌, यह लागू नहीं होता ।</p>";
display(0);   
}
/* avyaktAnukaraNasyAta itau (6.1.98) */
$at = array("at");
$iti = array("iti");
$ff = preg_split('/[aAiiuUfFxXeEoO]/',$first);
if (sub($at,$iti,blank(0),0) && $amredita === 0 && $start ===1 && count($ff)>2)
{
$text = two($at,$iti,blank(1),$iti,0);
echo "<p class = sa >By avyaktAnukaraNasyAta itau (6.1.98) :</p>
    <p class = hn > When the 'at' happens to be at the end of an onaematopic word and it is followed by 'iti', its 'Ti' is elided. This rule doesn't apply on single vowel words like 'zrat'.</p>";
echo "<p class = sa >अव्यक्तानुकरणस्यात इतौ (६.१.९८) :</p>
    <p class = hn >अव्यक्तानुकरण में प्रयुक्त हुए शब्द के अत्‌ के बाद में यदि इति हो तो यह नियम लागू होता है । एकाच्‌ शब्दों में, जैसे कि श्रत्‌, यह लागू नहीं होता ।</p>";
display(0);
}
/* vRddhireci (6.1.88) */
$aa = array("a","A");
$vrrdhi = array("E","O","E","O","E","O","E","O");
if (sub($aa,prat("ec"),blank(0),0) )
{
$text = one(array("a+e","a+E","a+o","a+O","A+e","A+E","A+o","A+O"),array("E+","E+","O+","O+","E+","E+","O+","O+"),0);
$text = two($aa,prat('ec'),blank(2),$vrrdhi,0);
echo "<p class = sa >By vRddhireci (6.1.88) :</p>";
echo "<p class = sa >वृद्धिरेचि (६.१.८८) :</p>";
display(0); $vriddhireci=1;
} else {$vriddhireci=0; }
/* udaH sthAstambhvoH pUrvasya (8.1.61) */
if(sub(array("ud","ut"),array("sTA","stam"),blank(0),0))
{
$text = two(array("ud","ut"),array('sTA','stam'),array("ud","ut"),array('TTA','Ttam'),0);
echo "<p class = sa >By udaH sthAstambhvoH pUrvasya (8.1.61) :</p>";
echo "<p class = sa >उदः स्थास्तम्भ्वोः पूर्वस्य (८.१.६१) :</p>";
display(0);
}
/* saMhitAyAm (6.1.72) */ // This is adhikArasUtra. Nothing to code here.
/* Che ca (6.1.73) */
$che = array("a","i","u","f","x");
$hrasvata = array("at","it","ut","ft","xt");
if (sub($hrasva,array("C"),blank(0),0))
{
$text = two($che,array("C"),$hrasvata,array("C"),0);
echo "<p class = sa >By Che ca (6.1.73) :</p>";
echo "<p class = sa >छे च (६.१.७३) :</p>";
display(0);
}
/* AGmAGozca (6.1.74) */
if (($first === "A" || $first === "mA") && $start===1)
{
$text = two(array("A"),array("C"),array("At"),array("C"),0);
echo "<p class = sa >By AGmAGozca (6.1.74) :</p>";
echo "<p class = sa >आङ्माङोश्च (६.१.७४) :</p>";
display(0);
}
/* dIrghAt (6.1.75) and padAntAdvA (6.1.76) */
$dirghata = array("At","It","Ut","Ft","Xt","et","Et","ot","Ot");
if (sub($dirgha,array("C"),blank(0),0) && $pada === "pratyaya" && $start === 1)
{
$text = two($dirgha,array("C"),$dirghata,array("C"),0);
echo "<p class = sa >By dIrghAt (6.1.75) padAntAdvA (6.1.76) :</p>
    <p class = hn >N.B.: The 'tuk' Agama is optional in case the preceding dIrgha vowel is at the padAnta. Otherwise, it is mandatory to add.</p>";
echo "<p class = sa >दीर्घात्‌ (६.१.७५) तथा पदान्ताद्वा (६.१.७६) :</p>
    <p class = hn >यदी दीर्घ स्वर पदान्त में हो तब तुक्‌ आगम लगाना पाक्षिक है । अन्यथा यह आवश्यक है ।</p>";
display(0);
}
if (sub($dirgha,array("C"),blank(0),0) && $pada === "pada" && $start ===1)
{
$text = two($dirgha,array("C"),$dirghata,array("C"),1);
echo "<p class = sa >By dIrghAt (6.1.75) padAntAdvA (6.1.76) :</p>
    <p class = hn >N.B.: The 'tuk' Agama is optional in case the preceding dIrgha vowel is at the padAnta. Otherwise, it is mandatory to add.</p>";
echo "<p class = sa >दीर्घात्‌ (६.१.७५) तथा पदान्ताद्वा (६.१.७६) :</p>
    <p class = hn >यदी दीर्घ स्वर पदान्त में हो तब तुक्‌ आगम लगाना पाक्षिक है । अन्यथा यह आवश्यक है ।</p>";
display(0);
}

/* yasmAtpratyayavidhistadAdi pratyaye'Ggam (2.4.13) */
// Pending to code.
/* creating a + elision for two ++ simultaneously. */
$text = one(array("++"),array("+"),0);

// looping till all the applicable sUtras of sapAdasaptAdhyAyI are exhausted. i.e. the original and the output are the same.
$start++;
}
while ($text !== $original);


/* tripAdI functions */

/* na NisambuddhyoH (8.2.8) */ 
if (arr($text,'/[n][+]$/')  && ( in_array($so,array("Ni")) || (in_array($so,array("su!")) && $sambuddhi===1)) && $bham===0 && $shi===0 && $ikoci===0 )
{
    echo "<p class = sa >By na NisambuddhyoH (8.2.8) :</p>";
    echo "<p class = sa >न ङिसम्बुद्ध्योः (८.२.८) :</p>";
    display(0); $Gisambu=1;
} else {$Gisambu=0; }
/* patches for maghavA bahulam */
if (sub(array("maGavAn"),blank(0),blank(0),0) && arr($text,'/[v][a][n][+]$/') && in_array($so,$sup) && $bham===0 && $shi===0 && $ikoci===0 && $Gisambu===0 && $sambuddhi===0)
{
    $text = two(array("maGavAn"),array("+"),array("maGavA"),array("+"),0);
    echo "<p class = sa >By na lopaH prAtipadikAntasya (8.2.7) :</p>";
    echo "<p class = sa >न लोपः प्रातिपदिकान्तस्य (८.२.७) :</p>";
    display(0);        
}
if (sub(array("maGavan","Ahar@","Ahan"),blank(0),blank(0),0) && in_array($so,$sup) && $bham===0 && $shi===0 && $ikoci===0 && $Gisambu===0 && $sambuddhi===0)
{
    $text = two(array("maGavan","Ahar@","Ahan"),array("+"),array("maGavAn","AhAr@","AhAn"),array("+"),0);
    echo "<p class = sa >By sarvanAmasthAne cAsambuddhau (6.4.8) :</p>";
    echo "<p class = hn >Because of bahulagrahaNa in maghavan, saMyogAntasya lopaH is not asiddha here. :</p>";
    echo "<p class = sa >सर्वनामस्थाने चासम्बुद्धौ (६.४.८)  :</p>";
    echo "<p class = hn >मघवा बहुलं के बहुलग्रहण के कारण, संयोगान्तलोप असिद्ध नहीं है । </p>";
    display(0);        
}
/* NAvuttarapade pratiSedho vaktavyaH (vA 4785) */
// Pending because involves samAsa. Out of purview right now.

/* sambuddhau napuMsakAnAM nalopo vA vAcyaH (vA 4786) */
$napumsakanalopa=array();
if (arr($text,'/[n][+]$/') && in_array($so,$sup) && $bham===0 && $shi===0 && $ikoci===0 && $so==="su!" && $sambuddhi===1 && $gender==="n")
{
    $text = two(array("n"),array("+"),array(""),array("+"),1);
    echo "<p class = sa >By sambuddhau napuMsakAnAM nalopo vA vAcyaH (vA 4786) :</p>";
    echo "<p class = sa >सम्बुद्धौ नपुंसकानां नलोपो वा वाच्यः (वा ४७८६) :</p>";
    display(0); $napumsakanalopa=array_merge($napumsakanalopa,array(1));
}

/* na lopaH prAtipadikAntasya (8.2.7) */
// parame vyoman is pending. Vedic in nature.
if (arr($text,'/[n][+]$/') && $nopadha===1 && !in_array(1,$napumsakanalopa) )
{
    $text = two(array("n"),array("+"),array(""),array("+"),0);
    echo "<p class = sa >By na lopaH prAtipadikAntasya (8.2.7) :</p>";
    echo "<p class = sa >न लोपः प्रातिपदिकान्तस्य (८.२.७) :</p>";
    display(0);        
}
elseif (arr($text,'/[n][+]$/') && in_array($so,$sup) && $bham===0 && $shi===0 && $ikoci===0 && $Gisambu===0  && !in_array(1,$napumsakanalopa))
{
    $text = two(array("n"),array("+"),array(""),array("+"),0);
    echo "<p class = sa >By na lopaH prAtipadikAntasya (8.2.7) :</p>";
    echo "<p class = sa >न लोपः प्रातिपदिकान्तस्य (८.२.७) :</p>";
    display(0);        
}
if (arr($text,'/[n][+]['.pc('hl').']/') && ( $astana===1 || $Satcatur===1)  && !in_array(1,$napumsakanalopa))
{
    $text = two(array("n"),array("+"),array(""),array("+"),0);
    echo "<p class = sa >By na lopaH prAtipadikAntasya (8.2.7) :</p>";
    echo "<p class = sa >न लोपः प्रातिपदिकान्तस्य (८.२.७) :</p>";
    display(0);        
}
elseif (arr($text,'/[n][+]['.pc('hl').']/')  && !arr($text,'/[n][+][e]/') && ($pada==="pada"|| $so==="Am" ) && in_array($so,$sup) && $bham===0 && $shi===0 && $ikoci===0 && $Gisambu===0  && !in_array(1,$napumsakanalopa))
{
    $text = two(array("n"),array("+"),array(""),array("+"),0);
    echo "<p class = sa >By na lopaH prAtipadikAntasya (8.2.7) :</p>";
    echo "<p class = sa >न लोपः प्रातिपदिकान्तस्य (८.२.७) :</p>";
    display(0);        
}
/* nazervA (8.2.63) */
if (arr($text,'/[n][a][S][+]/') && $dhatu===1 && $pada==="pada")
{
    $text = one(array("naS+",),array("nak+",),1);
    echo " <p class = sa >By nazervA (8.2.63) :</p>";
    echo " <p class = sa >नशेर्वा (८.२.६३) :</p>";
    display(0);
}
/* kvinpratyayasya kuH (8.2.62) */
if (sub(array("S","z","s"),array("+"),blank(0),0) && ( $kvin===1 || ($kvip===1 && $fo==="diS") )&& $pada==="pada" && $Asarva===1)
{
    $text1 = $text;        
    $text2 = two(array("S","z","s"),array("+"),array("K","k","k"),array("+"),0); // check for z and s.
    $text = $text2;
    echo "<p class = pa >There is difference of opinion here. According to one school, vrazca.. applies and z->S->g->g,k is done. According to the other school, kvinpratyayasya kuH is apavAda of Satva. Therefore z->K->K,k happens.</p>";
    echo "<p class = pa >कुत्वस्यासिद्धत्वाद्‌ 'व्रश्च..' इति षः, तस्य जश्त्वे डः । तस्य कुत्वेन गः । तस्य चर्त्वेन पक्षे कः । तादृग्‌, तादृश्‌ ॥ 'षत्वापवादत्वात्‌ कुत्वेन खकारः' इति कैयटहरदत्तादिमते तु चर्त्वाभावपक्षे ख एव श्रूयते, न तु गः, जश्त्वं प्रति कुत्वस्य असिद्धत्वात्‌ ॥</p>";
    display(0); 
    $text= $text1;
    $kvinku=1;    
} else { $kvinku=0; }
if (sub($hl,array("+"),blank(0),0) && ( $kvin===1 || ($kvip===1 && $fo==="diS") ) && $pada==="pada" && !sub(array("S","z","s"),array("+"),blank(0),0))
{   
    $text = two($cu,array("+"),$ku,array("+"),0);
    $text = two($Tu,array("+"),$ku,array("+"),0);
    $text = two($tu,array("+"),$ku,array("+"),0);
    $text = two($pu,array("+"),$ku,array("+"),0);
    $text = two(array("h"),array("+"),array("g"),array("+"),0);
    echo "<p class = sa >By kvinpratyayasya kuH (8.2.62) :</p>";
    echo "<p class = sa >क्विन्प्रत्ययस्य कुः (८.२.६२) :</p>";
    display(0);
}
/* vivikz patch for overcoming skoH saMyogAdyorante ca */
if (sub(array("vivikz"),array("+"),blank(0),0) && $pada==='pada')
{
    $text = two(array("vivikz"),array("+"),array("viviS"),array("+"),0);
    echo "<p class = sa >As katva is asiddha to skoH saMyogAdyorante ca, saMyogAntalopa happens. 'S' is changed to 's' by nimittApAye naimittikasyApyapAyaH. :</p>";
    echo "<p class = sa >स्कोः संयोगाद्योरन्ते च इति कलोपे प्राप्ते कत्वस्य असिद्धत्वात्‌ संयोगान्तलोपः । सकारस्य लोपे 'निमित्ताभावे नैमित्तिकस्याप्यपायः' इति षत्वमपि निवर्तते । :</p>";
    display(0);    
}
/* vrazcabhrasjamRjayajarAjabhrAjacChazAM ca (8.2.35) */
// TubhrAjR dIptau and ejR bhejR bhrAjR dIptau are different.
// parau vrajeH SaH padAnte (u 217) pending.
$vrasca = array("vfSc","sfj","mfj","yaj","rAj","BrAj","devej","parivrAj","Bfj","ftvij");
$vrashca = array("vfSz","sfz","mfz","yaz","rAz","BrAz","devez","parivrAz","Bfz","ftviz");
if (sub($vrasca,array("+"),prat("Jl"),0) ||  ( sub($vrasca,array("+"),blank(0),0) && $pada==="pada"  ))
{
    if (sub($vrasca,prat('Jl'),blank(0),0))
    {
    $text = two($vrasca,prat('Jl'),$vrashca,prat("Jl"),0);
    }
    else 
    {
    $text = one($vrasca,$vrashca,0);    
    }
    echo "<p class = sa >By vrazcabhrasjasRjamRjayajarAjabhrAjacChazAM ShaH (8.2.35) :</p>";
    echo "<p class = sa >व्रश्चभ्रस्जसृजमृजयजराजभ्राजच्छशां षः (८.२.३५) :</p>";
    display(0); $vras1 = 1;
} else { $vras1 = 0; }
if (arr($text,'/[CS]$/'))
{ 
    if ($dhatu===1)
    {
        if ($kvinku===1 && $Asarva===1 && arr(array($fo),'/[S]$/'))
        {
            $text = last(array("C","S"),array("z","z"),0);
        }
        else
        {
    $text = last(array("C","S"),array("z","z"),0);                    
        }
    echo "<p class = sa >By vrazcabhrasjasRjamRjayajarAjabhrAjacChazAM ShaH (8.2.35) :</p>";
    echo "<p class = sa >व्रश्चभ्रस्जसृजमृजयजराजभ्राजच्छशां षः (८.२.३५) :</p>";
    }
    else
    {
        if ($kvinku===1 && $Asarva===1 &&  arr(array($fo),'/[S]$/'))
        {
            $text = last(array("C","S"),array("z","z"),1);                                
        }
        else
        {
            $text = last(array("C","S"),array("z","z"),1);                    
        }
    echo "<p class = sa >By vrazcabhrasjasRjamRjayajarAjabhrAjacChazAM ShaH (8.2.35) :</p>";
    echo "<p class = hn >Some people hold that there is anuvRtti of 'dhAtoH' here. In that case Satva won't happen. It is optional.</p>";
    echo "<p class = sa >व्रश्चभ्रस्जसृजमृजयजराजभ्राजच्छशां षः (८.२.३५) :</p>";
    echo "<p class = hn >केचित्तु व्रश्चादिसूत्रे 'दादेर्धातोः इति सूत्रात्‌ 'धातोः' इत्यनुवर्तयन्ति । तन्मते षत्वं न भवति ।</p>";
    }
    display(0); $vras3 = 1;
} else { $vras3 =0; }
if (arr($text,'/[CS][+]/') && $pada === "pada")
{
    if ($dhatu===1)
    {
        if ($kvinku===1 && $Asarva===1 && arr(array($fo),'/[S]$/'))
        {
            $text = two(array("C","S"),array("+"),array("z","z"),array("+"),0);
        }
        else
        {
            $text = two(array("C","S"),array("+"),array("z","z"),array("+"),0);
        }
    echo "<p class = sa >By vrazcabhrasjasRjamRjayajarAjabhrAjacChazAM ShaH (8.2.35) :</p>";
    echo "<p class = sa >व्रश्चभ्रस्जसृजमृजयजराजभ्राजच्छशां षः (८.२.३५) :</p>";
    }
    else
    {
        if ($kvinku===1 && $Asarva===1 && arr(array($fo),'/[S]$/'))
        {
            $text2=$text;
            $text=$text1;
            $text = two(array("C","S"),array("+"),array("z","z"),array("+"),1);
            $text = array_merge($text,$text2);
            $text1=array(); $text2=array();                        
        }
        else
        {
           $text = two(array("C","S"),array("+"),array("z","z"),array("+"),1);
        }
    echo "<p class = sa >By vrazcabhrasjasRjamRjayajarAjabhrAjacChazAM ShaH (8.2.35) :</p>";
    echo "<p class = hn >Some people hold that there is anuvRtti of 'dhAtoH' here. In that case Satva won't happen. It is optional.</p>";
    echo "<p class = sa >व्रश्चभ्रस्जसृजमृजयजराजभ्राजच्छशां षः (८.२.३५) :</p>";
    echo "<p class = hn >केचित्तु व्रश्चादिसूत्रे 'दादेर्धातोः इति सूत्रात्‌ 'धातोः' इत्यनुवर्तयन्ति । तन्मते षत्वं न भवति ।</p>";
    }
    display(0); $vras4 = 1;
} else { $vras4 = 0; } 
/* nimittApAye naimittikasyApyapAyaH (paribhASA) */ 
if (($vras1===1 && sub(array("vfSz"),blank(0),blank(0),0)) || (($vras3 ===1 || $vras4 ===1) && sub(array("cz"),blank(0),blank(0),0)))
{
    $text = one(array("vfSz"),array("vfsz"),0);
    $text = one(array("cz"),array("z"),0);
    echo "<p class = sa >By nimittApAye naimittikasyApyapAyaH (paribhASA) :</p>";
    echo "<p class = sa >निमित्तापाये नैमित्तिकस्याप्यपायः (परिभाषा) :</p>";
    display(0);
}
/* rakS, takS patch to bar application of skoH saMyogAdyorante ca */
if (sub(array("takz","rakz"),array("+"),blank(0),0) && $pada === "pada" && $Nyanta===1)
{
    echo "<p class = pa >skoH saMyogAdyorante ca doesn't apply here because of sthAnivadbhAva of Nilopa.</p>";
    echo "<p class = hn >'pUrvatrAsiddhe na sthAnivat' (vA 433) doesn't apply here, because it is overruled by 'tasya doSaH saMyogAdilopalatvaNatveSu (vA 440).</p>";
    echo "<p class = pa >तक्षिरक्षिभ्यां ण्यन्ताभ्यां क्विपि तु 'स्कोः..' इति न प्रवर्तते । णिलोपस्य स्थानिवद्भावात्‌ ।</p>";
    echo "<p class = hn >'पूर्वत्रासिद्धे न स्थानिवत्‌' (वा ४४३) इह नास्ति । 'तस्य दोषः संयोगादिलोपलत्वणत्वेषु (वा ४४०) इति निषेधात्‌ ।</p>";
    display(0); $rakS=1;
} else { $rakS=0; }
/* pipak, vivak, didhak patch to bar application of skoH saMyogAdyorante ca */
if (sub(array("vivakz","diDakz","pipakz"),array("+"),blank(0),0) && $pada === "pada" && $san===1)
{
    echo "<p class = pa >skoH saMyogAdyorante ca doesn't apply here because kutva is asiddha to it.</p>";
    echo "<p class = pa >'स्कोः...' इति कलोपं प्रति कुत्वस्य असिद्धत्वात्‌ संयोगान्तलोपः ।</p>";
    display(0); $pipakS=1;
} else { $pipakS=0; }

/* skoH saMyogAdyorante ca (8.2.29) */
if ((sub(array("s","k"),$hl,prat("Jl"),0) || arr($text,'/[sk]['.flat($hl).'][+]$/'))  && $pada === "pada" && $rakS===0 && $pipakS===0)
{
    $text = three(array("s","k"),$hl,prat("Jl"),array("",""),$hl,prat("Jl"),0);
    $text = three($ac,array("s","k"),$hl,$ac,array("",""),$hl,0);
    echo "<p class = sa >By skoH saMyogAdyorante ca (8.2.29) :</p>";
    echo "<p class = sa >स्कोः संयोगाद्योरन्ते च (८.२.२९) :</p>";
    display(0); $sko=1;
} else {$sko=0; }
/* patch for cikIrz */
if (sub(array("cikIrz"),array("+"),blank(0),0) && ($pada==="pada" || arr($text,'/[r][z][+]$/')) )
{
    $text = two(array("cikIrz"),array("+"),array("cikIr"),array("+"),0);
    echo "<p class = sa >By rAtsasya (8.2.24) :</p>"; 
    echo "<p class = sa >रात्सस्य (८.२.२४) :</p>";
    display(0); 
}
/* rAtsasya (8.2.24) */
if ((arr($text,('/[r][+][s]$/')) && $pada === "pratyaya") || (arr($text,('/[r][s][+]/')) && $pada === "pada") )
{
    $text = one(array("r+s"),array("r"),0);
    $text = two(array("rs"),array("+"),array("r"),array("+"),0);
    echo "<p class = sa >By rAtsasya (8.2.24) :</p>"; 
    echo "<p class = sa >रात्सस्य (८.२.२४) :</p>";
    display(0); 
}
if ((arr($text,('/[r][+][hyvrlYmGRnJBGQDjbgqdKPCWTcwtkpzS]$/')) && $pada === "pratyaya") || (arr($text,('/[r][hyvrlYmGRnJBGQDjbgqdKPCWTcwtkpzS@][+]/')) && $pada === "pada") )
{
    echo "<p class = pa >rAtsasya (8.2.24) prevents application of saMyogAntasya lopaH.</p>"; 
    echo "<p class = pa >रात्सस्य (८.२.२४) से संयोगान्तस्य लोपः का प्रतिषेध होता है ।</p>";
    display(0); $ratsasya=1;
} else { $ratsasya=0; }
/* saMyogAntasya lopaH (8.2.23) */
// coding pending because not clear. And also 'yaNaH pratiSedho vAcyaH' prohibits its application.
if ( sub($hl,$hl,array("+"),0) && $bham===0 && $pada==="pada" && $ratsasya===0 && $vriddhireci===0 && !arr($text,'/['.pc('hl').']['.pc('hl').'][+]['.pc('ac').']/'))
{
    $text = three($hl,$hl,array("+"),$hl,blank(count($hl)),array("+"),0);
    echo "<p class = sa >By saMyogAntasya lopaH (8.2.23) :</p>";
    echo "<p class = sa >संयोगान्तस्य लोपः (८.२.२३) :</p>";
    display(0); $samyoga=1;           
} else { $samyoga=0; } 
if ( sub(array("M"),$hl,array("+"),0) && $bham===0 && $pada==="pada" && $vriddhireci===0)
{
    $text = three(array("M"),$hl,array("+"),array("M"),blank(count($hl)),array("+"),0);
    echo "<p class = sa >By saMyogAntasya lopaH (8.2.23) :</p>";
    echo "<p class = sa >संयोगान्तस्य लोपः (८.२.२३) :</p>";
    display(0);            
    if (sub(array("M"),array("+"),blank(0),0))
    {
    $text = three(array("M"),array("+"),$ku,array("N"),array("+"),$ku,0);
    $text = three(array("M"),array("+"),$cu,array("Y"),array("+"),$cu,0);
    $text = three(array("M"),array("+"),$Tu,array("R"),array("+"),$Tu,0);
    $text = three(array("M"),array("+"),$tu,array("n"),array("+"),$tu,0);
    $text = three(array("M"),array("+"),$pu,array("m"),array("+"),$pu,0);
    $text = two(array("M"),array("+"),array("m"),array("+"),0);
    echo "<p class = sa >By nimittApAye naimittikasyApyapAyaH (pa) :</p>";
    echo "<p class = sa >निमित्तापाये नैमित्तिकस्याप्यपायः (प) :</p>";
    display(0);
    } $samyoga1=1;
} else {$samyoga1=0; }
/* coH kuH (8.2.30) */
$cu = array("c","C","j","J","Y");
$ku = array("k","K","g","G","N");
$noco = array("ac","ic","ec","Ec");
if ((arr($text,'/['.flat($cu).'][+]['.pc('Jl').']/')) && !in_array($fo,$noco))
{
$text = three($cu,array("+"),prat('Jl'),$ku,array("+"),prat('Jl'),0); 
echo "<p class = sa >By coH kuH (8.2.30) :</p>";
echo "<p class = sa >चोः कुः (८.२.३०) :</p>";
display(0);
}
if (!in_array($so,$noco) && arr($text,'/['.flat($cu).'][+]$/'))
{
    $text = two($cu,array("+"),$ku,array("+"),0);
    echo "<p class = sa >By coH kuH (8.2.30) :</p>";
    echo "<p class = sa >चोः कुः (८.२.३०) :</p>";
    display(0);   
}
/* vA druhamuhaSNuhaSNihAm (8.2.34) */
$druh = array("druh","muh","snuh","snih");
if (sub($druh,blank(0),blank(0),0) && (arr($text,'/[+]$/') || arr($text,'/[+]['.pc("Jl").']/')) )
{ 
    $text = one(array("druh","muh","snuh","snih"),array("druG","muG","snuG","sniG"),1);
    echo "<p class = sa >By vA druhamuhaSNuhaSNihAm (8.2.34) :</p>";
    echo "<p class = sa >वा द्रुहमुहष्णुहष्णिहाम्‌ (८.२.३४) :</p>"; 
    display(0);
}
/* dAderdhAtorghaH (8.2.33) */
$dade = array("dah","dAh","dih","duh","dfh","drAh",);
if (sub($dade,blank(0),blank(0),0) && (arr($text,'/[+]$/') || arr($text,'/[+]['.pc("Jl").']/')) )
{
    $text = one(array("dah","dAh","dih","duh","dfh","drAh","druh"),array("daG","dAG","diG","duG","dfG","drAG","druG"),0);
    echo "<p class = sa >By dAderdhAtorghaH (8.2.33) :</p>";
    echo "<p class = sa >दादेर्धातोर्घः (८.२.३३) :</p>";
    display(0); $hodha1 = 1;
} else { $hodha1 = 0; } 
/* naho dhaH (8.2.35) */
if (sub(array("nah"),blank(0),blank(0),2) && (arr($text,'/[+]$/') || arr($text,'/[+]['.pc("Jl").']/')) )
{
    $text = one(array("nah",),array("naD"),0);
    echo "<p class = sa >By naho dhaH (8.2.35) :</p>";
    echo "<p class = sa >नहो धः (८.२.३५) :</p>";
    display(0); $hodha2 = 1; 
} else { $hodha2 = 0; } 
/* AhasthaH (8.2.36) */
if (in_array($first,array("Ah")) && (arr($text,'/[+]['.pc("Jl").']/')) )
{
    $text = one(array("Ah",),array("AT"),0);
    echo "<p class = sa >By AhasthaH (8.2.36) :</p>";
    echo "<p class = sa >आहस्थः (८.२.३६) :</p>";
    display(0); $hodha3=1;
} else { $hodha3 = 0; } 
/* ho DhaH (8.2.32) */ 
if (arr($text,'/[h][+]/') && sub(array("h"),prat("Jl"),blank(0),0) && $hodha1===0 && $hodha2 === 0 && $hodha3 === 0)
{
    $text = two(array("h"),prat('Jl'),array("Q"),prat('Jl'),0);
    echo "<p class = sa >ho DhaH (8.2.32)  :</p>";
    echo "<p class = sa >हो ढः (८.२.३२)  :</p>";
    display(0);    
} 
if (arr($text,'/[h][+]$/') && $pada ==="pada" && $hodha1===0 && $hodha2 === 0 && $hodha3 === 0)
{ 
    $text = two(array("h"),array("+"),array("Q"),array("+"),0);
    echo "<p class = sa >ho DhaH (8.2.32) :</p>";
    echo "<p class = sa >हो ढः (८.२.३२) :</p>";
    display(0);    
}
if (arr($text,'/[h]$/')  && $hodha1===0 && $hodha2 === 0 && $hodha3 === 0)
{
    $text = last(array("h"),array("Q"),0);
    echo "<p class = sa >ho DhaH (8.2.32)  :</p>";
    echo "<p class = sa >हो ढः (८.२.३२)  :</p>";
    display(0);    
}
/* ekAco bazo bhaS jhaSantasya sdhvoH (8.2.37) */  // Not good code. Think hard.
$ekaco = array("gaD","gaB","gaQ","gAQ","gAD","gAQ","guD","guQ","gUQ","gfD","gfQ","graB","graQ","griQ","glaQ","qaQ","qiQ","quQ","daG","daG","daG","daG","diG","duG","duG","dfG","dfG","dfG","drAG","drAG","druG","druh","baD","baQ","bAQ","bAD","bAQ","bIB","buD","bfQ","beQ","braQ","druQ");
$ekaco1 = array("GaD","GaB","GaQ","GAQ","GAD","GAQ","GuD","GuQ","GUQ","GfD","GfQ","GraB","GraQ","GriQ","GlaQ","QaQ","QiQ","QuQ","DaG","DaG","DaG","DaG","DiG","DuG","DuG","DfG","DfG","DfG","DrAG","DrAG","DruG","DruQ","BaD","BaQ","BAQ","BAD","BAQ","BIB","BuD","BfQ","BeQ","BraQ","DruQ");
if (sub($ekaco,array("+"),blank(0),0) && ( arr($text,'/[+][sd]/') || arr($text,'/[+]$/') || $bham===0))
{
 $text = one($ekaco,$ekaco1,0);
 echo "<p class = sa >By ekAco bazo bhaS jhaSantasya sdhvoH (8.2.37) :</p>";
    echo "<p class = sa >एकाचो बशो भष्‌ झषन्तस्य स्ध्वोः (८.२.३७):</p>";
    display(0);  
}
/* jhalAM jazo'nte (8.2.39) */
if (arr($text,'/['.pc('Jl').']$/') )
{
    if ($r2 ===1) 
         {
            echo "<p class = sa >jhalAM jazo'nte is barred by sasajuSo ruH for second word. <hr>"; echo "<p class = sa >द्वितीय पद के लिए ससजुषो रुः से झलां जशोऽन्ते बाधित हुआ है । <hr>";          
         }    
    else 
        {
            $text = last(prat('Jl'),savarna(prat('Jl'),prat('jS')),0);            
        }
            echo "<p class = sa >By jhalAM jazo'nte (8.2.39), The padAnta is 'jhal' is replaced by 'jaz' :</p>";
            echo "<p class = sa >झलां जशोऽन्ते (८.२.३९) :</p>";
            display(0);
}
if (arr($text,'/['.pc('Jl').'][+]/') && ( $pada === "pada" && !arr(array($fo),'/[s]$/')))
{     
    if ($r1 === 1 ) 
        {
            echo "<p class = sa >jhalAM jazo'nte is barred by sasajuSo ruH for first word. <hr>"; echo "<p class = sa >प्रथम पद के लिए ससजुषो रुः से झलां जशोऽन्ते बाधित हुआ है । <hr>";
        }
    else 
        {
            $text = two(prat('Jl'),array("+"),savarna(prat('Jl'),prat('jS')),array("+"),0);                
            echo "<p class = sa >By jhalAM jazo'nte (8.2.39), The padAnta is 'jhal' is replaced by 'jaz' :</p>";
            echo "<p class = sa >झलां जशोऽन्ते (८.२.३९) :</p>";
            display(0);    
        }
} 
/* kvinpratyayasya kuH (8.2.62) */
if (sub($hl,array("+"),blank(0),0) && ( $kvin===1 || ($kvip===1 && $fo==="diS") ) && $pada==="pada" && !sub(array("S","z","s"),array("+"),blank(0),0) && ( $kvinku===1 || $Asarva===0))
{   
    $text = two($cu,array("+"),$ku,array("+"),0);
    $text = two($Tu,array("+"),$ku,array("+"),0);
    $text = two($tu,array("+"),$ku,array("+"),0);
    $text = two($pu,array("+"),$ku,array("+"),0);
    if($kvinku===1)
    {
    $text = array_merge($text,$text2);        
    }
    echo "<p class = sa >By kvinpratyayasya kuH (8.2.62) :</p>";
    if ($kvip===1)
    {
    echo "<p class = hn >As 'tyadAdiSu dRSo'nAlocane kaYca (3.2.60) mandates kvin for dRS, others also take kutvam. </p>";       
    }
    echo "<p class = sa >क्विन्प्रत्ययस्य कुः (८.२.६२) :</p>";
    if ($kvip===1)
    {
    echo "<p class = hn >त्यदादिषु दृशोऽनालोचने कञ्च (३.२.६०) इति दृशेः क्विन्विधानादन्यत्रापि कुत्वम्‌ ।</p>";        
    }
    display(0);
}
/* vizvasya vasurAToH (6.3.128) */
if (sub(array("viSva"),array("vasu","rAq"),blank(0),0)) 
{
    $text = two(array("viSva"),array("vasu","rAq"),array("viSvA"),array("vasu","rAq"),0);
    echo "<p class = sa >By vizvasya vasurAToH (6.3.128) :</p>";
     echo "<p class = sa >विश्वस्य वसुराटोः (६.३.१२८) :</p>";
    display (0);
}
/* bhobhagoaghoapUrvasya yo'zi (8.3.17) : */
$ash = array("a","A","i","I","u","U","f","F","x","X","e","o","E","O","h","y","v","r","l","Y","m","N","R","n","J","B","G","Q","D","j","b","g","q","d");
if (sub(array("Bo","Bago","aGo","a","A"),array("r@"),$ash,0)) 
{
    $text = three(array("Bo","Bago","aGo","a","A"),array("r@"),$ash,array("Bo","Bago","aGo","a","A"),array("y"),$ash,0);
    echo "<p class = sa >By bhobhagoaghoapUrvasya yo'zi (8.3.17):</p>";
     echo "<p class = sa >भोभगोअघोअपूर्वस्य योऽशि (८.३.१७) :</p>";
    $bho = 1;
    display (0);
} else { $bho =0; }
// Patch to convert the rutva before vowels and hash to repha.
if (arr($text,'/[r][@]/'))
{ 
    echo "<p class = pa >By upadeze'janunAsika it (1.3.2) :</p>";
    echo "<p class = pa >उपदेशेऽजनुनासिक इत्‌ (१.३.२) :</p>";
    display(0);
    $text = two(array("r@"),$ac,array("r"),$ac,0);
    $text = two(array("r@"),prat('hS'),array("r"),prat('hS'),0);
    $text = two(array("r@"),array("+"),array("r"),array("+"),0);
    if (arr($text,'/[r][@]$/'))
    {
    $text = last(array("@"),array(""),0); 
    }    
    echo "<p class = sa >By tasya lopaH (1.3.9) :</p>";
    echo "<p class = sa >तस्य लोपः (१.३.९) :</p>";
    display(0);    
}
/* SaDhoH kassi (8.2.41) */
if (sub(array("z","Q"),array("s"),blank(0),0))
{
    $text = two(array("z","Q"),array("s"),array("k","k"),array("s"),0);
    echo "<p class = sa >By SaDhoH kassi (8.2.41) :</p>";
    echo "<p class = sa >षढोः कस्सि (८.२.४१) :</p>";
    display(0);    
}
/* mo no dhAtoH (8.2.64) */
if (arr($text,'/[m][+]/') && $dhatu===1 && $pada==="pada")
{
    $text = one(array("m+",),array("n+",),0);
    echo " <p class = sa >By mo no dhAtoH (8.2.64) :</p>";
    echo " <p class = sa >मो नो धातोः (८.२.६४) :</p>";
    display(0);
}
/* rvorupadhAyA dIrgha ikaH (8.2.76) */
if ($dhatu===1 && ((sub(array("i","I","u","U","f","F","x","X",),array("r+","v+"),$hl,0) && $pada==="pada" )||arr($text,'/[iIuUfFxX][rv]$/')||sub(array("i","I","u","U","f","F","x","X",),array("r","v"),array("+"),0)) && $pada==="pada")
{
    $text = three(array("i","I","u","U","f","F","x","X",),array("r","v"),array("+"),array("I","I","U","U","F","F","F","F",),array("r","v"),array("+"),0);
    echo "<p class = sa >By rvorupadhAyA dIrgha ikaH (8.2.76) :</p>";
    echo "<p class = sa >र्वोरुपधाया दीर्घ इकः (८.२.७६) :</p>";
    display(0); $r4 = 1;
}
/* hali ca (8.2.77) */
if ($dhatu===1 && sub($ik,array("r","v"),$hl,0) && arr(array($fo),'/[rv]$/'))
{
    $text = three(array("i","I","u","U","f","F","x","X",),array("r","v"),$hl,array("I","I","U","U","F","F","F","F",),array("r","v"),$hl,0);
    echo "<p class = sa >By hali ca (8.2.77) :</p>";
    echo "<p class = sa >हलि च (८.२.७७) :</p>"; 
    if ($allopo===1)
    {
        echo "<p class = hn >allopa doesn't have sthAnivadbhAva, because sthAnivadbhAva is barred in dIrghavidhi.</p>";
        echo "<p class = hn >स्थानिवद्भाव का दीर्घविधि में निषेध होने से यहाँ अल्लोप का स्थानिवद्भाव नहीं है ।</p>";        
    }
    display(0); $r4 = 1;
}
/* adaso'serdAdu do maH (8.2.80) */
// For proper adas forms. 
$acmu = array("u","U","u","U","u","U","u","U","u","U","U","U","U","U",);
//if (sub(array("adO","ada+m","adA+n","adA+ByAm","ada+smE","ada+sm","ada+sya","aday+or"),blank(0),blank(0),0) && $fo==="adas")
if (sub(array("ad"),blank(0),blank(0),0) && $fo==="adas" && !arr($text,'/[a][r][+]/') )
{
//     $text=one(array("adO","ada+m","adA+n","adA+ByAm","ada+smE","ada+sm","ada+sya","aday+or"),array("amU","amum","amUn","amU+ByAm","amu+smE","amu+sm","amu+sya","amuy+or"),0);
     $text=two(array("ad"),$ac,array("am"),$acmu,0);
     echo "<p class = sa >adaso'serdAdu do maH (8.2.80) :</p>";
     echo "<p class = sa >अदसोऽसेर्दादु दो मः (८.२.८०) :</p>";
     display(0);
}
// Not coded properly. coded only for adas-ancu combination.
if (sub(array("adadr"),blank(0),blank(0),0) )
{
     $text=one(array("adadr"),array("amumu"),1);
     $text=one(array("amumu"),array("adamu"),1);
     echo "<p class = sa >adaso'serdAdu do maH (8.2.80) :</p>";
     echo "<p class = hn >adaso'dreH pRthaGmutvaM kecidicCanti latvavat | kecidantyasadezasya netyeke'serhi dRSyate || </p>";
     echo "<p class = sa >अदसोऽसेर्दादु दो मः (८.२.८०) :</p>";
     echo "<p class = hn >अदसोऽद्रेः पृथङ्मुत्वं केचिदिच्छन्ति लत्ववत्‌ । केचिदन्त्यसदेशस्य नेत्येकेऽसेर्हि दृश्यते ॥</p>";
     display(0);
}
/* eta Idbahuvacane (8.2.81) */
if (sub(array("ad+e","ade+Bir","ade+Byar","ade+sAm","ade+su"),blank(0),blank(0),0) && in_array($so,$bahusup) && $fo==="adas")
        
{
     $text=one(array("ad+e","ade+Bir","ade+Byar","ade+sAm","ade+su"),array("amI","amI+Bir","amI+Byar","amI+sAm","amI+su"),0);
     echo "<p class = sa >eta Idbahuvacane (8.2.81) :</p>";
     echo "<p class = sa >एत ईद्बहुवचने (८.२.८१) :</p>";
     display(0);
}
/* vyorlaghuprayatnataraH zAkaTAyanasya (8.3.18) */
// This is regarding pronounciation.

/* roH supi (8.3.16) */
if (arr($text,'/[r][+][s][u]$/') && $so==="sup" && !in_array(1,$R))
{
 echo "<p class = pa >roH supi (8.3.16) prevents application of kharavasAnayorvisarjanIyaH. </p>";
 echo "<p class = pa >रोः सुपि (८.३.१६) से खरवसानयोर्विसर्जनीयः का प्रतिषेध होता है ।</p>";
 display(0); $roHsupi=1;
} else { $roHsupi=0; }
/* kharavasAnayorvisarjanIyaH (8.3.15) */
if (arr($text,'/[+]['.pc('Kr').']/') && $roHsupi===0 && sub(array("r","r@"),array("+"),prat('Kr'),0) && $pada === "pada")
{
 $text = two(array("r@","r"),prat("Kr"),array("H","H"),prat("Kr"),0);
 echo "<p class = sa >By kharavasAnayorvisarjanIyaH (8.3.15) :</p>";
 echo "<p class = sa >खरवसानयोर्विसर्जनीयः (८.३.१५) :</p>";
 display(0);
}
if ( arr($text,'/[@r]$/')||arr($text,'/[r][+]$/') && $roHsupi===0)
{
 $text = last(array("r@","r"),array("H","H"),0);
 if (arr($text,'/[r][+]$/'))
 {
     $text = one(array("+"),array(""),0);
 }
 $text = last(array("r"),array("H"),0);
 echo "<p class = sa >By kharavasAnayorvisarjanIyaH (8.3.15) :</p>";
 echo "<p class = sa >खरवसानयोर्विसर्जनीयः (८.३.१५) :</p>";
 display(0);
}
/* Dho Dhe lopaH (8.3.13) */
if (sub(array("Q"),array("Q"),blank(0),0))
{
    $text = two(array('Q'),array('Q'),array(''),array('#Q'),0); 
    echo "<p class = sa >By Dho Dhe lopaH (8.3.13) :</p>";
    echo "<p class = sa >ढो ढे लोपः (८.३.१३) :</p>";
    display(0); $dho = 1;
} else { $dho = 0; }
/* ro ri (8.3.14) */
if (sub(array("r"),array("r"),blank(0),0))
{
    $text = two(array('r'),array('r'),array(''),array('#r'),0); 
    $ro = 1;
    echo "<p class = sa >By ro ri (8.3.14) :</p>";
    echo "<p class = sa >रो रि (८.३.१४) :</p>";
    display(0);
} else { $ro = 0; }
/* Dhralope pUrvasya dIrgho'NaH (6.3.111) */
$ana = array("a","A","i","I","u","U","f","F","x","X");
$anna = array("A","A","I","I","U","U","F","F","X","X");
if (($ro ===1 || $dho===1) && sub($ana,array('#r',"#Q"),blank(0),0))
{
$text = two($ana,array('#r','#Q'),$anna,array(' r',' Q'),0);
echo "<p class = sa >By Dhralope pUrvasya dIrgho'NaH (6.3.111) :</p>";
echo "<p class = sa >ढ्रलोपे पूर्वस्य दीर्घोऽणः (६.३.१११) :</p>";
display(0);
}
/* lopaH zAkalyasya (8.3.19) and vyorlaghuprayatnataraH zAkaTAyanasya (8.3.18) */ 
$aa = array("a","A");$yv = array("y+","v+"); $space=array(" "," ");
if (sub($aa,$yv,$ac,0) && (arr($text,'/['.pc('ec').'][+]['.flat($ac).']/') || $bho === 1) && $pada === "pada")
{
echo "<p class = sa >By lopaH zAkalyasya (8.3.19) and vyorlaghuprayatnataraH zAkaTAyanasya (8.3.18) :</p>";
echo "<p class = sa >लोपः शाकल्यस्य (८.३.१९) तथा व्योर्लघुप्रयत्नः शाकटायनस्य (८.३.१८) :</p>";
$text = three($aa,$yv,$ac,$aa,array(" +"," +"),$ac,1); 
display(0);
}
/* hali sarveSAm (8.3.22) */
if ($bho === 1 && sub(array("y+"),$hl,blank(0),0) && $pada==="pratyaya")
{
    $text = three(array("Bo","Bago","aGo","A"),array("y+"),$hl,array("Bo","Bago","aGo","A"),array("+"),$hl,0);
    echo "<p class = sa >By hali sarveSAm (8.3.22) :</p>";
    echo "<p class = sa >हलि सर्वेषाम्‌ (८.३.२२) :</p>";
    display(0);
}
if ($bho === 1 && sub(array("y+"),$hl,blank(0),0) && (in_array($so,$sup) && $pada==="pada"))
{
    $text = three(array("Bo","Bago","aGo","A"),array("y+"),$hl,array("Bo","Bago","aGo","A"),array("+"),$hl,0);
    echo "<p class = sa >By hali sarveSAm (8.3.22) :</p>";
    echo "<p class = sa >हलि सर्वेषाम्‌ (८.३.२२) :</p>";
    display(0);
}
/* oto gArgyasya (8.3.20) */
if (arr($text,'/[o][y][+]/') && $bho ===1 && $pada === "pada")
{
    $text = one(array("oy+"),array("o +"),0);
    echo "<p class = sa >By oto gArgyasya (8.3.20) :</p>
        <p class = hn >N.B. This rule applies only to the padAnta alaghuprayatna yakAra following 'o' only.</p>";
    echo "<p class = sa >ओतो गार्ग्यस्य (८.३.२०) :</p>
        <p class = hn >यह ओकार के परे आए हुए अलघुप्रयत्न पदान्त यकार को ही लागू होता है ।</p>";
    display(0);
}
/* uJi ca pade (8.3.21) */
if ((sub(array("ay","av"),array("u "),blank(0),0)|| (sub(array("ay","av"),blank(0),blank(0),0) && $second === "u")) && $bho ===1 && $pada === "pada")
{
    $text = two(array("ay","av"),array("u"),array("a","a"),array("u"),0);
    echo "<p class = sa >By uJi ca pade (8.3.21) :</p>";
    echo "<p class = sa >उञि च पदे (८.३.२१) :</p>";
    display(0);
}
/* mo rAji samaH kvau (8.3.25) */
if (sub(array("sam"),array("rA"),blank(0),0))
{
    $text = two(array("sam"),array("rA"),array("sam"),array("rA"),0);
    echo "<p class = sa >By mo rAji samaH kvau (8.3.25) :</p>";
  echo "<p class = sa >मो राजि समः क्वौ (८.३.२५) :</p>";
  display(0); $mo = 1;
} else { $mo = 0; }
/* mo'nusvAraH (8.3.23) */
if (arr($text,'/[m][+]['.pc('hl').']/') && $pada ==="pada" && $mo === 0)
{
$text = two(array('m'),prat('hl'),array('M'),prat('hl'),0);
echo "<p class = sa >By mo'nusvAraH (8.3.23) :</p>
    <p class = hn >N.B.: The conversion to anusvAra occurs only if the m is at the end of a pada. Otherwise this conversion doesn't apply. Ignore all consequentiality in that case.</p>";
echo "<p class = sa >मोऽनुस्वारः (८.३.२३) :</p>
    <p class = hn >यदि मकार पदान्त में है तभी अनुस्वार में बदलता है । अन्यथा नहीं ।</p>";
display(0);
}
/* nazcApadAntasya jhali (8.3.24) */
if (arr($text,'/[mn][+]['.pc('Jl').']/') && $pada === "pratyaya" )
{
$text = two(array('m','n'),prat('Jl'),array('M','M'),prat('Jl'),0);
echo "<p class = sa >By nazcApadAntasya jhali (8.3.24) :</p>
    <p class = hn >If n/m is inside a pada, it should be converted to anusvAra. So ignore the case which doesn't apply here.</p>";
echo "<p class = sa >नश्चापदान्तस्य झलि (८.३.२४) :</p>
    <p class = hn >यदि नकार या मकार पदान्त में नहीं है तब भी यह नियम से अनुस्वार होता है ।</p>";
display(0);
}
if(arr($text,'/[mn]['.pc('Jl').']/') )
{
$text = two(array('m','n'),prat('Jl'),array('M','M'),prat('Jl'),2);
echo "<p class = sa >By nazcApadAntasya jhali (8.3.24) :</p>
    <p class = hn >If n/m is inside a pada, it should be converted to anusvAra. So ignore the case which doesn't apply here.</p>";
echo "<p class = sa >नश्चापदान्तस्य झलि (८.३.२४) :</p>
    <p class = hn >यदि नकार या मकार पदान्त में नहीं है तब भी यह नियम से अनुस्वार होता है ।</p>";
display(0);
}
/* he mapare vA (8.3.26) and yavalapare yavalA veti vaktavyam (vA 4902) */
if (sub(array("M"),array("hm","hy","hv","hl"),blank(0),0))
{
$text = two(array("M"),array("hy",),array("!y",),array("hy",),1);
$text = two(array("M"),array("hm",),array("m",),array("hy",),1);
$text = two(array("M"),array("hv",),array("!v",),array("hv",),1);
$text = two(array("M"),array("hl",),array("!l",),array("hl",),1);
echo "<p class = sa >By he mapare vA (8.3.26) and yavalapare yavalA veti vaktavyam (vA 4902) :</p>";
echo "<p class = sa >हे मपरे वा (८.३.२६) तथा यवलपरे यवला वेति वक्तव्यम्‌ (वा ४९०२) :</p>";
display(0);
}
/* napare naH (8.3.27) */
if (sub(array("M"),array("hn"),blank(0),0))
{
$text = two(array("M"),array("hn"),array("n"),array("hn",),1);
echo "<p class = sa >By napare naH (8.3.27) :</p>";
echo "<p class = sa >नपरे नः (८.३.२७) :</p>";
display(0);
}
/* GNoH kukTukzari (8.3.28) */
if (sub(array("N","R"),prat('Sr'),blank(0),0))
{
$text = two(array("N","R"),prat('Sr'),array("Nk","Rw"),prat('Sr'),1);
echo "<p class = sa >By GNoH kukTukzari (8.3.28) :</p>";
echo "<p class = sa >ङ्णोः कुक्टुक्शरि (८.३.२८) :</p>";
display(0);
}
/* DaH si dhuT (8.3.29) */
if (sub(array("q"),array("s"),blank(0),0))
{
$text = two(array("q"),array("s"),array("q"),array("Ds"),1);
echo "<p class = sa >By DaH si dhuT (8.3.29) :</p>";
echo "<p class = sa >डः सि धुट्‌ (८.३.२९) :</p>";
display(0); $dhut = 1;
} else {$dhut = 0; }
/* nazca (8.3.30) */
if (sub(array("n"),array("s"),blank(0),0))
{
$text = two(array("n"),array("s"),array("n"),array("Ds"),1);
echo "<p class = sa >By nazca (8.3.30) :</p>";
echo "<p class = sa >नश्च (८.३.३०) :</p>";
display(0); $dhut = 1;
} else { $dhut = 0; }
/* zi tuk (8.3.31) */
if (arr($text,'/[n][+][S]/') && $pada === "pada")
{
$text = one(array("n+S"),array("nt+S"),1);    
echo "<p class = sa >By zi tuk (8.3.31) :</p>";
echo "<p class = sa >शि तुक्‌ (८.३.३१) :</p>";
display(0);
}
/* Gamo hrasvAdaci GamuNnityam (8.3.32) */ // Here the Agama has to be affiliated to $ac. Patch is bad.
$nogamo = array("aR","ak","ik","uk","ac","ic","ec","aw","aR","iR","am","aS","al",);
if (arr($text,'/['.flat($hrasva).'][NRn][+]['.flat($ac).']/') && $pada === "pada" && !in_array($second,$nogamo) && !sub(array("pataYjal","sImant"),blank(0),blank(0),0))
{
$text = three($hrasva,array("N","R","n"),$ac,$hrasva,array("NN","RR","nn"),$ac,0);
echo "<p class = sa >By Gamo hrasvAdaci GamuNnityam (8.3.32) :</p>";
echo "<p class = sa >ङमो ह्रस्वादचि ङमुण्नित्यम्‌ (८.३.३२) :</p>";
display(0);
}
/* saheH sADaH saH (8.3.56) */
if (sub(array("sAq"),array("+"),blank(0),0))
{
$text = two(array("sAq"),array("+"),array("zAq"),array("+"),0);
echo "<p class = sa >By saheH sADaH saH (8.3.56) :";
echo "<p class = sa >सहेः साडः सः (८.३.५६) :";
display(0);
}

/* sampuGkAnAM so vaktavyaH (vA 4892) */
if (sub(array("saM","sa!","puM","pu!","kAM","kA!"),array("H"),blank(0),0))
{
$text = two(array("saM","sa!","puM","pu!","kAM","kA!"),array("H"),array("saM","sa!","puM","pu!","kAM","kA!"),array("s"),0);
echo "<p class = sa >By sampuGkAnAM so vaktavyaH (vA 4892) :";
echo "<p class = sa >सम्पुङ्कानां सो वक्तव्यः (वा ४८९२) :";
display(0);
}
/* samo vA lopameke (bhASya) */
if (sub(array("saMs","sa!s"),array("s"),$hl,0))
{
$text = two(array("saMs","sa!s"),array("s"),array("saM","sa!"),array("s"),1);
echo "<p class = sa >By samo vA lopameke (bhASya) :</p>";
echo "<p class = sa >समो वा लोपमेके (भाष्य) :</p>";
display(0);
}
/* dvistrizcaturiti kRtvo'rthe (8.3.43) */
if (sub(array("dviH","triH","catuH"),$ku,blank(0),0))
{
    $text = two (array("dviH","triH","catuH"),$ku,array("dviz","triz","catuz"),$ku,1);
    echo "<p class = sa >By dvistrizcaturiti kRtvo'rthe (8.3.43) :</p>
        <p class = hn >N.B. This applies only in case of kRtvo'rthe.</p>";
    echo "<p class = sa >द्विस्त्रिश्चतुरिति कृत्वोऽर्थे (८.३.४३):</p>
        <p class = hn >यह नियम सिर्फ कृत्वोऽर्थ में ही लागू होता है ।</p>";
    display(0); $dvi1 = 1;
} else { $dvi1 = 0; }
if (sub(array("dviH","triH","catuH"),$pu,blank(0),0))
{
 $text = two (array("dviH","triH","catuH"),$pu,array("dviz","triz","catuz"),$pu,1);
 echo "<p class = sa >By dvistrizcaturiti kRtvo'rthe (8.3.43) :</p>
        <p class = hn >N.B. This applies only in case of kRtvo'rthe.</p>";
 echo "<p class = sa >द्विस्त्रिश्चतुरिति कृत्वोऽर्थे (८.३.४३):</p>
        <p class = hn >यह नियम सिर्फ कृत्वोऽर्थ में ही लागू होता है ।</p>";
    display(0); $dvi2 = 1;
} else { $dvi2 = 0; }
/* muhusaH pratiSedhaH (vA 4911) */
if (sub(array("muhu"),array("H"),$pu,0)||sub(array("muhu"),array("H"),$ku,0))
{
    $text = three(array("muhu"),array("H"),$pu,array("muhu"),array("H"),$pu,0);
    $text = three(array("muhu"),array("H"),$ku,array("muhu"),array("H"),$ku,0);
    echo "<p class = sa >By muhusaH pratiSedhaH (vA 4911) :</p>";
    echo "<p class = sa >मुहुसः प्रतिषेधः (वा ४९११) :</p>";
    display(0); $muhu1 = 1;
} else { $muhu1 = 0; }
/* kaskAdiSu ca (8.3.48) */
$kaska = array("kaHkaH","kOtaHkut","sarpiHkuRqik","BrAtuHputr","SunaHkarR","sadyaHkAl","sadyaHkI","sAdyaHk","kAMHkAn","DanuHkapAl","bahiHpal","barhiHpal","yajuHpAtr","ayaHkAnt","tamaHkARq","ayaHkARq","medaHpiRq","BAHkar","ahaHkar","kaH+kaH","kOtaH+kut","sarpiH+kuRqik","BrAtuH+putr","SunaH+karR","sadyaH+kAl","sadyaH+kI","sAdyaH+k","kAMH+kAn","DanuH+kapAl","bahiH+pal","barhiH+pal","yajuH+pAtr","ayaH+kAnt","tamaH+kARq","ayaH+kARq","medaH+piRq","BAH+kar","ahaH+kar");
$kaskareplace = array("kaskaH","kOtaskut","sarpizkuRqik","BrAtuzputr","SunaskarR","sadyaskAl","sadyaskI","sAdyask","kAMskAn","DanuzkapAl","bahizpal","barhizpal","yajuzpAtr","ayaskAnt","tamaskARq","ayaskARq","medaspiRq","BAskar","ahaskar","kas+kaH","kOtas+kut","sarpiz+kuRqik","BrAtuz+putr","Sunas+karR","sadyas+kAl","sadyas+kI","sAdyas+k","kAMs+kAn","Danuz+kapAl","bahiz+pal","barhiz+pal","yajuz+pAtr","ayas+kAnt","tamas+kARq","ayas+kARq","medas+piRq","BAs+kar","ahas+kar");
if(sub($kaska,blank(0),blank(0),0))
{
$text = one ($kaska,$kaskareplace,0);
echo "<p class = sa >By kaskAdiSu ca (8.3.48) ";
echo "<p class = sa >कस्कादिषु च (८.३.४८) ";
    display(0); $kaska = 1;
} else { $kaska = 0; }
/* isusoH sAmarthye (8.3.44) and nityaM samAse'nuttarapadasthasya (8.3.45) */ 
if (sub(array("iH","uH",),$ku,blank(0),0) && $dvi1===0 && $dvi2===0 && $muhu1 ===0)
{
    $text = two (array("iH","uH"),$ku,array("iz","uz"),$ku,1);
    echo "<p class = sa >By isusoH sAmarthye (8.3.44) and nityaM samAse'nuttarapadasthasya (8.3.45) :</p>
        <p class = hn >N.B. This applies only in case of sAmarthya. If 'is' or 'us' pratyayas are at the end of first component of a compound, they are mandatorily converted to 'S'.</p>";
    echo "<p class = sa >इसुसोः सामर्थ्ये (८.३.४४) तथा नित्यं समासेऽनुत्तरपदस्थस्य (८.३.४५) :</p>
        <p class = hn >यह तभी लागू होता है जब सामर्थ्य में प्रयोग हुआ हो । यदि 'इस्‌' और 'उस्‌' प्रत्यय उत्तरपद में न हों तब आवश्यक रूप से शकार में परिवर्तन होता है ।</p>";
    display(0); $isu1 = 1;
} else { $isu1 = 0; }
if (sub(array("iH","uH"),$pu,blank(0),0))
{
 $text = two (array("iH","uH"),$pu,array("iz","uz"),$pu,1);
 echo "<p class = sa >By isusoH sAmarthye (8.3.44) and nityaM samAse'nuttarapadasthasya (8.3.45) :</p>
        <p class = hn >N.B. This applies only in case of sAmarthya. If 'is' or 'us' pratyayas are at the end of first component of a compound, they are mandatorily converted to 'S'.</p>";
    echo "<p class = sa >इसुसोः सामर्थ्ये (८.३.४४) तथा नित्यं समासेऽनुत्तरपदस्थस्य (८.३.४५) :</p>
        <p class = hn >यह तभी लागू होता है जब सामर्थ्य में प्रयोग हुआ हो । यदि 'इस्‌' और 'उस्‌' प्रत्यय उत्तरपद में न हों तब आवश्यक रूप से षकार में परिवर्तन होता है ।</p>";
    display(0); $isu2 = 1;
} else { $isu2= 0; }
/* idudupadhasya cApratyayasya (8.3.41) */
$id = array("i","u",);
if (sub($iN,array("H"),$ku,0) && $dvi1===0 && $dvi2===0 && $isu1 ===0 && $isu2 ===0&& $muhu1 ===0 && $pada !== "pratyaya")
{
    $text = three($id,array("H"),$ku,$id,array("z"),$ku,1);
    echo "<p class = sa >By idudupadhasya cApratyayasya (8.3.41) :</p>
        <p class = hn >N.B. : the visarga will be converted to 'S' only if it is not followed by pratyaya.</p>";
    echo "<p class = sa >इदुदुपधस्य चाप्रत्ययस्य (८.३.४१) :</p>
        <p class = hn >यदि परे प्रत्यय न हो तभी षकार में परिवर्तन होता है ।</p>";
    display(0);
}
if (sub($iN,array("H"),$pu,0) && $pada !== "pratyaya")
{
    $text = three($id,array("H"),$pu,$id,array("z"),$pu,1);
    echo "<p class = sa >By idudupadhasya cApratyayasya (8.3.41) :</p>
        <p class = hn >N.B. : the visarga will be converted to 'S' only if it is not followed by pratyaya.</p>";
    echo "<p class = sa >इदुदुपधस्य चाप्रत्ययस्य (८.३.४१) :</p>
        <p class = hn >यदि परे प्रत्यय न हो तभी षकार में परिवर्तन होता है ।</p>";
    display(0);
}
/* ekAdezazAstranimittikasya na Satvam | kaskAdiSu bhrAtuSputrazabdasya pAThAt (vA 4915) */ 
// Pending to code.
/* iNaH SaH (8.3.39) */
if (sub($iN,array("H"),array("pAS","kalp","kAmy","ka","kAMy"),blank(0),0) && $dvi1===0 && $dvi2===0 && $isu1 ===0 && $isu2 ===0 && $muhu1 ===0) 
{
    $text = three($iN,array("H"),array("pAS","kalp","kAmy","ka","kAMy"),$iN,array("z"),array("pAS","kalp","kAmy","ka","kAmy"),0);
    echo "<p class = sa >By iNaH SaH (8.3.39) :</p>";
    echo "<p class = sa >इणः षः (८.३.३९) :</p>";
    display(0); $inah = 1;
} else { $inah = 0; }
/* namaspurasorgatyoH (8.3.40) */
$namas = array("namaH","puraH"); 
if (sub($namas,$ku,blank(0),0))
{
    $text = two($namas,$ku,array("namas","puras"),$ku,1);
    echo "<p class = sa >By namaspurasorgatyoH (8.3.40) :</p>
          <p class = hn >N.B. : The conversion to namas / puras is done only in case it has gati saJjJA.</p>";
    echo "<p class = sa >नमस्पुरसोर्गत्योः (८.३.४०) :</p>
          <p class = hn >यदि गति संज्ञा हो तभी नमस्‌ / पुरस्‌ में परिवर्तन होता है ।</p>";
    display(0); $nama1 = 1;
} else { $nama1 = 0; }
if (sub($namas,$pu,blank(0),0) && $nama1 !==1)
{
    $text = two($namas,$pu,array("namas","puras"),$pu,1);
    echo "<p class = sa >By namaspurasorgatyoH (8.3.40) :</p>
        <p class = hn >N.B. : The conversion to namas / puras is done only in case it has gati saJjJA.</p>";
    echo "<p class = sa >नमस्पुरसोर्गत्योः (८.३.४०) :</p>
          <p class = hn >यदि गति संज्ञा हो तभी नमस्‌ / पुरस्‌ में परिवर्तन होता है ।</p>";
    display(0); $nama2 = 1;
} else { $nama2 = 0; }
/* tiraso'nyatarsyAm (8.3.42) */
if (sub(array("tiraH"),$ku,blank(0),0))
{
    $text = two (array('tiraH'),$ku,array('tiras'),$ku,1);
    echo "<p class = sa >By tiraso'nyatarasyAm  (8.3.42) :</p>";
    echo "<p class = sa >तिरसोऽन्यतरस्याम्‌  (८.३.४२) :</p>";
    display(0); $tir1 = 1;
} else { $tir1 = 0; }
if (sub(array("tiraH"),$pu,blank(0),0))
{
 $text = two (array('tiraH'),$pu,array('tiras'),$pu,1);
 echo "<p class = sa >By tiraso'nyatarasyAm  (8.3.42) :</p>";
 echo "<p class = sa >तिरसोऽन्यतरस्याम्‌  (८.३.४२) :</p>";
    display(0); $tir2 = 1;
} else { $tir2 = 0; }
/* ataH kRkamikaMsakumbhapAtrakuzAkarNISvanavyayasya (8.3.46) */
if (sub(array("aH"),array("kAr","kAm","kAMs","kumBa","pAtra","kuSA","karRI"),blank(0),0) && $nama1 !== 1 && $nama2 !== 1   && $tir1===0 && $tir2===0 )
{
    $text = two(array("aH"),array("kAr","kAm","kAMs","kumBa","pAtra","kuSA","karRI"),array('as'),array("kAr","kAm","kAMs","kumBa","pAtra","kuSA","karRI"),1);
    echo "<p class = sa >By ataH kRkamikaMsakumbhapAtrakuzAkarNISvanavyayasya (8.3.46) :</p>
       <p class = hn > This applies olny when there is compound and the word with 'as' is neither uttarapadastha nor avyaya.</p>";
    echo "<p class = sa >अतः कृकमिकंसकुम्भपात्रकुशाकर्णीष्वनव्ययस्य (८.३.४६) :</p>
       <p class = hn >यह तब लागू होता है, जब समास में 'अस्‌' से अन्त होनेवाला शब्द न तो उत्तरपदस्त हो न ही अव्यय हो ।</p>";
    display(0); $atah = 1;
} else { $atah = 0; }
/* adhazzirasI pade */
if (sub(array("aDaH","SiraH"),array("pada"),blank(0),0)  )
{
    $text = two(array("aDaH","SiraH"),array("pada"),array("aDas","Siras"),array("pada"),1);
    echo "<p class = sa >By aDazzirasI pade (8.3.47) :</p>
       <p class = hn > This applies olny when there is compound and the word 'adhas' or 'ziras' is not uttarapadastha.</p>";
    echo "<p class = sa >अधश्शिरसी पदे (८.३.४७) :</p>
       <p class = hn >यह नियम तभी लागू होता है जब अधस्‌ / शिरस्‌ उत्तरपदस्थ नहीं होते ।</p>";
    display(0); $atah = 1;
} else { $atah = 0; }
/* so'padAdau (8.3.38), pAzakalpakakAmyeSviti vAcyam (vA 5033), anavyayasyeti vAcyam (vA 4902) and kAmye roreveti vAcyam (vA 4902) */ 
// anavyayasyeti vAcyam (vA 4901) is pending to code.
if (sub(array("H"),array("pAS","kalp","kAmy","ka"),blank(0),0) && $inah !== 1 && $nama1 !== 1 && $nama2 !== 1 && $dvi1===0 && $dvi2===0 && $isu1 ===0 && $isu2 ===0 && $tir1===0 && $tir2===0 && $muhu1 ===0  && $atah ===0)
{
    $text = two(array("H"),array("kalp","kAmy","ka","kAMy"),array('s'),array("kalp","kAmy","ka","kAMy"),0);
    $text = two(array("H"),array("pAS"),array('s'),array("pAS"),0);
    if (preg_match('/[sr]$/',$first))
    {
        $text = one(array('skAmy','skAMy'),array('HkAmy','HkAMy'),1);      
    }
    echo "<p class = sa >By so'padAdau (8.3.38), pAzakalpakakAmyeSviti vAcyam (vA 5033), anavyayasyeti vAcyam (vA 4902) and kAmye roreveti vAcyam (vA 4902) :</p>";
    echo "<p class = sa >सोऽपदादौ (८.३.३८), पाशकल्पककाम्येष्विति वाच्यम्‌ (वा ५०३३), अनव्ययस्येति वाच्यम्‌ (वा ४९०२) तथा काम्ये रोरेवेति वाच्यम् (वा ४९०२) :</p>";
    display(0);
}
/* zarpare visarjanIyaH (8.3.35) */
if (sub(array("H"),prat('Kr'),prat('Sr'),0) )
{
echo "<p class = sa >By zarpare visarjanIyaH (8.3.35) :</p>";
echo "<p class = sa >शर्परे विसर्जनीयः (८.३.३५) :</p>";
display(0); $zarpare = 1;
} else { $zarpare = 0; }
/* kupvoH &k&pau ca (8.3.37) */ // <p class = hn >Note that we have used & as jihvAmUlIya and * as upadhmAnIya.
if((sub(array("H"),$ku,blank(0),0)||sub(array("H"),$pu,blank(0),0)) && $kaska !== 1 && $zarpare ===0)
{
$text = two(array("H"),$ku,array("&"),$ku,1);
$text = two(array("H"),$pu,array("&"),$pu,1);
echo "<p class = sa >By kupvoH &k&pau ca (8.3.37). :</p>";
echo "<p class = sa >कुप्वोः ᳲकᳲपौ च (८.३.३७). :</p>";
display(0); $kupvo = 1;
} else {$kupvo = 0; }
/* visarjanIyasya saH (8.3.34) */ 
if(sub(array("H"),prat('Kr'),blank(0),0) && $zarpare !==1 && $kupvo ===0)
{
$text = two(array("H"),prat('Kr'),array("s"),prat('Kr'),0);
$zarpare = 2;
echo "<p class = sa >By visarjanIyasya saH (8.3.34) :</p>";
echo "<p class = sa >विसर्जनीयस्य सः (८.३.३४) :</p>";
display(0);
}
/* vA zari (8.3.36) */
if(sub(array("s"),prat('Sr'),blank(0),0) && $zarpare === 2)
{
$text = two(array("s"),array("S","z","s"),array("H"),array("S","z","s"),1);
echo "<p class = sa >By vA zari (8.3.36) :</p>";
display(0); $zarpare = 3;
}
/* kharpare zari vA visargalopo vaktavyaH (vA 4906) */
if(sub(array("H"),prat('Sr'),prat('Kr'),0) && $zarpare === 3)
{
$text = three(array("H"),prat('Sr'),prat('Kr'),array(""),prat('Sr'),prat('Kr'),1);
echo "<p class = sa >By kharpare zari vA visargalopo vaktavyaH (vA 4906) :</p>";
echo "<p class = sa >खर्परे शरि वा विसर्गलोपो वक्तव्यः (वा ४९०६) :</p>";
display(0);
}
/* apadAntasya mUrdhanyaH (8.3.55), iNkoH (8.3.57) and AdezapratyayayoH (8.3.59) */
// Not coded perfectly, only according to the need of vibhaktis. 
$iN1 = array("i","I","u","U","f","F","x","X","e","o","E","O","h","y","v","r","l","k","K","g","G","N"); 
if((sub(array("i","I","u","U","f","F","x","X","e","o","E","O","h","y","v","r","l","k","K","g","G","N"),array("+s"),blank(0),0)) &&  (in_array($so,array("Am","sup"))|| in_array(1,$samp)) || ($fo==="adas" && in_array($so,array("Ne","Nasi!","Nas","Am","Ni"))) )
{
$text = two($iN1,array("+s"),$iN1,array("+z"),0);
echo "<p class = sa >By apadAntasya mUrdhanyaH (8.3.55), iNkoH (8.3.57) and AdezapratyayayoH (8.3.59) :</p>";
echo "<p class = sa >अपदान्तस्य मूर्धन्यः (८.३.५५), इण्कोः (८.३.५७) तथा आदेशप्रत्यययोः (८.३.५९) :</p>";
display(0);
}
/* numvisarjanIyazarvyavAye'pi (8.3.58) */
// Not coded perfectly, only according to the need of vibhaktis.
$iN1 = array("i","I","u","U","f","F","x","X","e","o","E","O","h","y","v","r","l","k","K","g","G","N");
$pr1= '/(['.flat($iN1).'])([M+]*)([s])([uA])/';
$pr2= '/(['.flat($iN1).'])([H+]*)([s])([uA])/';
$pr3= '/(['.flat($iN1).'])([S+]*)([s])([uA])/';
$pr4= '/(['.flat($iN1).'])([z+]*)([s])([uA])/';
$pr5= '/(['.flat($iN1).'])([s+]*)([s])([uA])/';
$prr = '$1$2z$4';
if ( (arr($text,'/['.flat($iN1).']([HSzs+]*)[s][uA]/')|| (arr($text,'/['.flat($iN1).']([HSzs+]*)[s][uA]/') && $num===1 )) && sub(array("+su","+sAm"),blank(0),blank(0),0) )
{
    foreach ($text as $value)
    {
        if(in_array(1,$num))
        {
        $val[] = preg_replace($pr1,$prr,$value);            
        }
        $val[] = preg_replace($pr2,$prr,$value);
        $val[] = preg_replace($pr3,$prr,$value);
        $val[] = preg_replace($pr4,$prr,$value);
        $val[] = preg_replace($pr5,$prr,$value);
    }
    $text = array_diff($val,$text);; 
    $text = array_unique($text);
    $text = array_values($text);
    $val=array();
echo "<p class = sa >By numvisarjanIyazarvyavAye'pi (8.3.58) :</p>";
echo "<p class = sa >नुम्विसर्जनीयशर्व्यवायेऽपि (८.३.५८) :</p>";
display(0);
}

/* hanteratpUrvasya (8.4.22) */
if( sub($upasarga,array("han","Gn"),blank(0),0))
{
$text = two($upasarga,array("han","Gn"),$upasarga,array("haR","Gn"),0);
echo "<p class = sa >By hanteratpUrvasya (8.4.22) :</p>";
echo "<p class = sa >हन्तेरत्पूर्वस्य (८.४.२२) :</p>";
display(0);   
} 
if( arr($text,'/[G][n]/') && arr(array($fo),'/[h][a][n]/') && !sub($upasarga,array("han","Gn"),blank(0),0))
{
$text = one(array("han","Gn"),array("haR","Gn"),0);
echo "<p class = sa >By hanteratpUrvasya (8.4.22) :</p>";
echo "<p class = sa >हन्तेरत्पूर्वस्य (८.४.२२) :</p>";
display(0);   
}
/* raSAbhyAM no NaH samAnapade (8.4.1) */
// pUrvasmAdapi vidhau sthAnivadbhAvaH , pUrvatrAsiddhe na sthAnivat (vA 433) and tasya doSaH saMyogAdilopalatvaNatveSu (vA 440) are pending to code.
if($pada === "pratyaya" && sub(array("r","z"),array("n"),blank(0),0))
{
$text = two(array("r","z"),array("n"),array("r","z"),array("R"),0);
echo "<p class = sa >By raSAbhyAM no NaH samAnapade (8.4.1) :</p>";
echo "<p class = sa >रषाभ्यां नो णः समानपदे (८.४.१) :</p>";
display(0);   
}
/* ekAjuttarapade NaH (8.4.12) */
$rasek = '/([rzfF])([aAiIuUfFxXeoEOhyvrkKgGNpPbBmM+]*)([n])/';
$rasendek = '/([rzfF])([aAiIuUfFxXeoEOhyvrkKgGNpPbBmM+]*)([n])$/';
$ras1ek = '$1$2R'; 
if( $ekajuttarapada===1 && arr($text,$rasek) && $hohante===0 )// && !arr($text,$rasend) && $pada==="pada")
{ 
    foreach ($text as $value)
    {
        $value1[] = preg_replace($rasek,$ras1ek,$value);
    }
    $text = $value1;
echo "<p class = sa >By ekAjuttarapade NaH (8.4.12) :</p>";
echo "<p class = sa >एकाजुत्तरपदे णः (८.४.१२) :</p>";
display(0);   
}
/* Patch to remove the + sign */
if (arr($text,'/['.pc('hl').' ][+]['.pc('hl').']/') || arr($text,'/[HM!][+]['.pc('hl').']/'))
{
$text = three($hl,array("+"," +"),$hl,$hl,array(""," "),$hl,0);    
$text = three(array("H","M","!"),array("+"),$hl,array("H","M","!"),array(""),$hl,0);    
}
if ( arr($text,'/['.pc('ac').'HM! ][+]['.pc('ac').']/') || arr($text,'/[HM!][+]['.pc('ac').']/') )
{  
$text = one(array("+"),array(" "),0);
}
if ( arr($text,'/['.pc('ac').' ][+]['.pc('hl').'MH]/') || arr($text,'/[+]$/') )
{  
$text = one(array("+"),array(""),0);
}
if ( arr($text,'/['.pc('hl').'][+]['.pc('ac').']/') )
{  
$text = one(array("+"),array(""),0);
}

/* aTkupvAGnumvyavAye'pi (8.4.2) and na padAntasya (8.4.37) */
/* RvarNAnnasya NatvaM vAcyam (vA 4969) */
/* na padAntasya 8.4.37) */
// The issue is identifying samAnapada. Can't be coded properly as of now.
$ras = '/([rzfF])([aAiIuUfFxXeoEOhyvrkKgGNpPbBmM+]*)([n])/';
$rasend = '/([rzfF])([aAiIuUfFxXeoEOhyvrkKgGNpPbBmM+]*)([n])$/';
$ras1 = '$1$2R'; 

if (arr($text,$rasend) && $hohante===0)
{
echo "<p class = pa >By na padAntasya 8.4.37), application of aTkupvAGnumvyavAye'pi (8.4.2) is barred. </p>";
echo "<p class = pa >न पदान्तस्य (८.४.३७) से अट्कुप्वाङ्नुम्व्यवायेऽपि का निषेध हुआ है । </p>";     
display(0);    
}
if (arr($text,$ras) && !arr($text,$rasend) && $hohante===0) 
{ 
    foreach ($text as $value)
    {
        if (preg_match('/([rzfF])([aAiIuUfFxXeoEOhyvrkKgGNpPbBmM+]*)([n])/',$value) )
        {
        $value1[] = preg_replace($ras,$ras1,$value);
        }
        else
        {
        $value1[] = $value;    
        }
    }
$text = $value1;
$value1 = array();
if(arr($text,'/([rz])([aAiIuUfFxXeoEOhyvrkKgGNpPbBmM+]*)([R])/') && $hohante===0)
{
echo "<p class = sa >By aTkupvAGnumvyavAye'pi (8.4.2) :</p>";
echo "<p class = sa >अट्कुप्वाङ्नुम्व्यवायेऽपि (८.४.२) :</p>";     
}
if(arr($text,'/([fF])([aAiIuUfFxXeoEOhyvrkKgGNpPbBmM+]*)([R])/') && $hohante===0)
{
echo "<p class = sa >By RvarNAnnasya NatvaM vAcyam (vA 4969) :</p>";
echo "<p class = sa >ऋवर्णान्नस्य णत्वं वाच्यम्‌ (वा ४९६९) :</p>";     
}
display(0);
}
/* stoH zcunA zcuH (8.4.40) */
$stu = array("s","t","T","d","D","n");
$zcu = array("S","c","C","j","J","Y");
if(sub($stu,$zcu,blank(0),0))
{
$text = two(array("s"),$zcu,array("S"),$zcu,0);
$text = two(array("t"),$zcu,array("c"),$zcu,0);
$text = two(array("T"),$zcu,array("C"),$zcu,0);
$text = two(array("d"),$zcu,array("j"),$zcu,0);
$text = two(array("D"),$zcu,array("J"),$zcu,0);
$text = two(array("n"),$zcu,array("Y"),$zcu,0);
echo "<p class = sa >By stoH zcunA zcuH (8.4.40) :</p>";
echo "<p class = sa >स्तोः श्चुना श्चुः (८.४.४०) :</p>";
display(0);
}
/* stoH zcunA zcuH (8.4.40) and zAt (8.4.44) */
$zcu1= array("c","C","j","J","Y");
if(sub($zcu1,$stu,blank(0),0))
{
$text = two($zcu1,array("s"),$zcu1,array("S"),0); 
$text = two($zcu1,array("t"),$zcu1,array("c"),0); 
$text = two($zcu1,array("T"),$zcu1,array("C"),0); 
$text = two($zcu1,array("d"),$zcu1,array("j"),0);
$text = two($zcu1,array("D"),$zcu1,array("J"),0); 
$text = two($zcu1,array("n"),$zcu1,array("Y"),0); 
$text = two(array("S"),array("s"),array("S"),array("S"),0); 
    echo "<p class = sa >By stoH zcunA zcuH (8.4.40) and zAt (8.4.44) :</p>";
    echo "<p class = sa >स्तोः श्चुना श्चुः (८.४.४०) तथा शात्‌ (८.४.४४) :</p>";
display(0);
}
/* anAmnavatinagarINAmiti vAcyam (vA 5016) */
$shtu = array("z","w","W","q","Q","R",);
if (sub($shtu,array("nAm","navat","nagar"),blank(0),0) && $allopo!==1)
{
$text = two($shtu,array("nAm","navat","nagar"),$shtu,array("RAm","Ravat","Ragar"),0);
echo "<p class = sa >By na padAntATToranAm (8.4.42) and anAmnavatinagarINAmiti vAcyam (vA 5016) :</p>";
echo "<p class = sa >न पदान्ताट्टोरनाम्‌ (८.४.४२) तथा अनाम्नवतिनगरीणामिति वाच्यम्‌ (वा ५०१६) :</p>";
display(0);
if (sub($shtu,array("Ravat","Ragar"),blank(0),0) && $allopo!==1)
{
$text = two($shtu,array("Ravat","Ragar"),array("R","R","R","R","R","R"),array("Ravat","Ragar"),0);
    echo "<p class = sa >By stoH STunA STuH (8.4.41) :</p>";
    echo "<p class = sa >स्तोः ष्टुना ष्टुः (८.४.४१) :</p>";
    display(0);
}
if (sub($shtu,array("RAm"),blank(0),0) && $allopo!==1)
{
$text = two($shtu,array("RAm"),array("R","R","R","R","R","R"),array("RAm"),0);
    echo "<p class = sa >By yaro'nunAsike'nunAsiko vA (8.4.45) and pratyaye bhASAyAm nityam (vA) :</p>";
    echo "<p class = sa >यरोऽनुनासिकेऽनुनासिको वा (८.४.४५) तथा प्रत्यये भाषायां नित्यम्‌ (वार्तिक) :</p>";
    display(0);
}
} 
/* stoH STunA STuH (8.4.41) and na padAntATToranAm (8.4.41) and toH Si (8.4.43) */
$Tu = array("w","W","q","Q","R",); $tu = array("t","T","d","D","n");
if(((sub($shtu,$stu,blank(0),0)|| sub($stu,$shtu,blank(0),0))) && $allopo!==1 )
{
    echo "<p class = pa >stoH STunA STuH (8.4.41) is prevented by sthAnivadbhAva of allopa.</p>";
    echo "<p class = pa >पूर्वस्मादपि विधावल्लोपस्य स्थानिवद्भावान्न ष्टुत्वम्‌ ।</p>";
    display(0);    
}        
if(((sub($shtu,$stu,blank(0),0)|| sub($stu,$shtu,blank(0),0))) && $allopo===0 )
{
$text = two(array("z"),$stu,array("z"),$shtu,0);
$text = two(array("s"),$shtu,array("z"),$shtu,0);
$text = two(array("t"),$Tu,array("w"),$Tu,0);
$text = two(array("T"),$Tu,array("W"),$Tu,0);
$text = two(array("d"),$Tu,array("q"),$Tu,0);
$text = two(array("D"),$Tu,array("Q"),$Tu,0);
$text = two(array("n"),$Tu,array("R"),$Tu,0);
    if ($pada === "pratyaya" && (sub($Tu,$tu,blank(0),0)))
    {
        $text = two(array("w"),$tu,array("w"),$Tu,0);
        $text = two(array("W"),$tu,array("W"),$Tu,0);
        $text = two(array("q"),$tu,array("q"),$Tu,0);
        $text = two(array("Q"),$tu,array("Q"),$Tu,0);
        $text = two(array("R"),$tu,array("R"),$Tu,0);
    }       
    echo "<p class = sa >By stoH STunA STuH (8.4.41) and na padAntATToraNam (8.4.42) and toH Si (8.4.43) :</p>";
    echo "<p class = sa >स्तोः ष्टुना ष्टुः (८.४.४१), न पदान्ताट्टोरणाम्‌ (८.४.४२) तथा तोः षि (८.४.४३) :</p>";
    display(0);
}
/* yaro'nunAsike'nunAsiko vA (8.4.45) */ // this is applicable to only sparzas.
$yara = array("J","B","G","Q","D","j","b","g","q","d","K","P","C","W","T","c","w","t","k","p");
$anunasikarep = array("Y","m","N","R","n","Y","m","N","R","n","N","m","Y","R","n","Y","R","n","N","m");
$anunasika = array("N","Y","R","n","m");
if (sub($yara,array("+"),$anunasika,0) && $pada === "pada")
{
$text = three($yara,array("+"),$anunasika,$anunasikarep,array("+"),$anunasika,1);
echo "<p class = sa >By yaro'nunAsike'nunAsiko vA (8.4.45) :</p>";
echo "<p class = sa >यरोऽनुनासिकेऽनुनासिको वा (८.४.४५) :</p>";
display(0);
}
if (sub($yara,array("+"),$anunasika,0) && $pada === "pratyaya")
{
$text = two($yara,$anunasika,$anunasikarep,$anunasika,0);
echo "<p class = sa >By yaro'nunAsike'nunAsiko vA (8.4.45) :</p>";
echo "<p class = sa >यरोऽनुनासिकेऽनुनासिको वा (८.४.४५) :</p>";
display(0);
}
/* nAdinyAkroze putrasya (8.4.48) */
if (sub(array('putrAdin'),blank(0),blank(0),0))
{
    echo "<p class = sa >By nAdinyAkroze putrasya (8.4.48) - If Akroza is meant : The dvitva doesn't happen. Otherwise dvitva will happen.</p>";
    echo "<p class = sa >नादिन्याक्रोशे पुत्रस्य (८.४.४८) - यदि आक्रोश के अर्थ में प्रयुक्त हुआ है, तब द्वित्व नहीं होगा । अन्यथा द्वित्व होगा ।</p>";
}
/* vA hatajagdhayoH (vA 5022) */
if (sub(array("putrahatI"),blank(0),blank(0),0))
{
echo "<p class = sa >By vA hatajagdhayoH (vA 5022) :</p>";
echo "<p class = sa >वा हतजग्धयोः (वा ५०२२) :</p>";
display(0);
}
if (sub(array('putrajagDI'),blank(0),blank(0),0))
{
echo "<p class = sa >By vA hatajagdhayoH (vA 5022) :</p>";
echo "<p class = sa >वा हतजग्धयोः (वा ५०२२) :</p>";
display(0);
}
/* cayo dvitIyAH zari pauSkarasAderiti vAcyam (vA 5023) */
if (sub(array("N","R"),prat('Sr'),blank(0),0))
{
$text = two(array("Nk","Rw"),prat('Sr'),array("NK","RW"),prat('Sr'),1);
echo "<p class = sa >By cayo dvitIyAH zari pauSkarasAderiti vAcyam (vA 5023) :</p>";
echo "<p class = sa >चयोः द्वितीयाः शरि पौष्करसादेरिति वाच्यम्‌ (वा ५०२३) :</p>";
display(0); $cayo=1;
} else {$cayo = 0; }
/*anaci ca (8.4.47)*/ // Here the sudhI + upAsya - what about the Asy - Assy is possbile ? Code gives it. But there are 4 options. Code gives two only.
// The cause for using $hrasva instead of $ac is that the dIrgha vowels are debarred by dIrghAdAcAyANAm.
// Here instead of using pratyAhAra hl, we shall do manual enumeration of all the members. Bexause of "anusvAravisargajihvAmUlIyopadhmAnIyayamAnAmakAropari zarSu ca pAThasyopasaGkhyAtatvenAnusvArasyApyactvAt (in derivation of samskAra) 
$hrasvaplus = array("M","!","'");
$hala1 = array("y","v","l","Y","m","N","R","n","J","B","G","Q","D","j","b","g","q","d","K","P","C","W","T","c","w","t","k","p","S","z","s","M",);
$hala2 = array("h","y","v","r","l","Y","m","N","R","n","J","B","G","Q","D","j","b","g","q","d","K","P","C","W","T","c","w","t","k","p","S","z","s","M",);
if(sub($hrasva,$hala1,$hala2,0))
{
    $text = dvitva($hrasva,$hala1,$hala2,array(""),2,1);
    if (sub($dirgha,$hala1,$hala2,0))
    {
    echo "<p class = sa >By anaci ca (8.4.47) and dIrghAdAcAryANAm (8.4.52) :</p>"; 
    echo "<p class = sa >अनचि च (८.४.४७): तथा दीर्घादाचार्याणाम्‌ (८.४.५२) :</p>";     
    }
    else
    {
    echo "<p class = sa >By anaci ca (8.4.47):</p>"; 
    echo "<p class = sa >अनचि च (८.४.४७):</p>";     
    }
display(1);
}
if(sub($hrasvaplus,$hl,$hala2,0))
{
    $text = dvitva($hrasvaplus,$hl,$hala2,array(""),2,1);
    if (sub($dirgha,$hl,$hala2,0))
    {
    echo "<p class = sa >By anaci ca (8.4.47) and dIrghAdAcAryANAm (8.4.52) :</p>"; 
    echo "<p class = sa >अनचि च (८.४.४७): तथा दीर्घादाचार्याणाम्‌ (८.४.५२) :</p>";     
    }
    else
    {
    echo "<p class = sa >By anaci ca (8.4.47):</p>"; 
    echo "<p class = sa >अनचि च (८.४.४७):</p>";     
    }
    display(1);
}
if(checkarray($dirgha,$hl,array('r','l'),blank(0))!==0 && $sthanivadbhav===1) 
{
$text = dvitva($dirgha,$hala1,$hala2,array(""),2,1);
    if (sub($dirgha,$hl,array('r','l'),0))
    {
    echo "<p class = sa >By anaci ca (8.4.47) and dIrghAdAcAryANAm (8.4.52) :</p>"; 
    echo "<p class = sa >अनचि च (८.४.४७): तथा दीर्घादाचार्याणाम्‌ (८.४.५२) :</p>";     
    }
    else
    {
    echo "<p class = sa >By anaci ca (8.4.47):</p>"; 
    echo "<p class = sa >अनचि च (८.४.४७):</p>";     
    }
display(1);
}
/* By anaci ca (according to mahAbhASya example of vAkk) */ 
if (arr($text,'/['.flat($ac).']['.flat($hl).']$/') || (preg_match('/['.flat($ac).']['.flat($hl).']$/',$first) && $input === $first ))
{
    foreach ($text as $value)
    {
        $split = str_split($value);
        $post = $split[count($split)-1];
        if (in_array($post,$hl))
        {
        $pre = chop($value,$post); 
        $value1[] = str_replace($value,$pre.$post.$post,$value);
        }
        else
        {
            $value1[] = $value;
        }
    }
    $text = array_merge($text,$value1);
    $text = array_unique($text);
    $text = array_values($text);
    $value1 = array();
    if (sub($dirgha,$hala1,$hala2,0))
    {
    echo "<p class = sa >By anaci ca (8.4.47) and dIrghAdAcAryANAm (8.4.52) :</p>"; 
    echo "<p class = sa >अनचि च (८.४.४७): तथा दीर्घादाचार्याणाम्‌ (८.४.५२) :</p>";     
    }
    else
    {
    echo "<p class = sa >By anaci ca (8.4.47):</p>"; 
    echo "<p class = sa >अनचि च (८.४.४७):</p>";     
    }
    display(1);
}
/* zaraH khayaH (vA 5019) */
$shara = array("S","z","s",);
if (sub($shara,prat('Ky'),blank(0),0))
{
$text = dvitva($shara,prat('Ky'),array(""),array(""),2,1);
echo "<p class = sa >zaraH khayaH (vA 5019) :</p>";
echo "<p class = sa >शरः खयः (वा ५०१९) :</p>";
display(1);
}
/* aco rahAbhyAM dve (8.4.46) */ 
$rh = array("r","h");
if (sub($ac,$rh,prat('yr'),0))
{
    if (sub($rh,array("S","z","s"),$ac,0))
    {
        echo "<p class = sa >By zaro'ci (8.4.48) :</p>";
        echo "<p class = hn >N.B.: zaro'ci bars application of aco rahAbhyAm dve</p>";
        echo "<p class = sa >शरोऽचि (८.४.४८) :</p>";
        echo "<p class = hn >शरोऽचि अचो रहाभ्यां द्वे के प्रयोग का निषेध करता है ।</p>";
        display(0);
    }
    else
    {
        $text = dvitva($ac,$rh,prat('yr'),array(""),3,1);
        echo "<p class = sa >By aco rahAbhyAM dve (8.4.46) :</p>";
        echo "<p class = sa >अचो रहाभ्यां द्वे (८.४.४६) :</p>";
        display(1);
    }
}
/* triprabhRtiSu zAkaTAyanasya (8.4.50)*/
if (checkarray($ac,$hl,$hl,$hl) === 1)
{
echo "<p class = hn >N.B.: By triprabhRtiSu zAkaTAyanasya (8.4.50), the dvitva is optionally not done in cases where there are more than three hals appearing consecutively. e.g. indra - inndra.  </p>";
echo "<p class = hn >त्रिप्रभृतिषु शाकटायनस्य (८.४.५०) - तीन या उससे ज्यादा हल्‌ अगर हो तब शाकटायन के मत में द्वित्व नहीं होता है ।</p>";
}
/* sarvatra zAkalyasya (8.4.51) */
// It is not coded separately. It is sent as a message in all display function when 1 is selected as option. 
/* dIrghAdAcAryANAm (8-4-52) */
// Not coded separately, because we did dvitva only for $hrasva, and not for 'ac'. So this is already taken care of.
/* jhalAM jaz jhaSi (8.4.53) */
while(sub(array_diff(prat('Jl'),prat('jS')),prat('JS'),blank(0),0) !== false)
{
    if(sub(prat('Jl'),prat('JS'),blank(0),0))
    {
    $text = two(prat('Jl'),prat('JS'),savarna(prat('Jl'),prat('jS')),prat('JS'),0);
    echo "<p class = sa >By jhalAM jaz jhazi (8.4.53):</p>";
    echo "<p class = sa >झलां जश्‌ झशि (८.४.५३):</p>";
    display(0);
    }
}
/* yaNo mayo dve vAcye (vA 5018) yaN in paJcamI and may in SaSThI)*/
if (sub($hrasva,prat('yR'),prat('my'),0))
{
$text = dvitva(prat('yR'),prat('my'),array(""),array(""),2,1);
echo "<p class = sa >By yaNo mayo dve vAcye (yaN in paJcamI and may in SaSThI) (vA 5018) :</p>";
echo "<p class = sa >यणो मयो द्वे वाच्ये (यण्‌ पञ्चमी तथा मय्‌ षष्ठी) (वा ५०१८) :</p>";
display(1); 
}
if (sub($dirgha,prat('yR'),prat('my'),0) && $sthanivadbhav ===1)
{
$text = dvitva(prat('yR'),prat('my'),array(""),array(""),2,1);
echo "<p class = sa >By yaNo mayo dve vAcye (yaN in paJcamI and may in SaSThI) (vA 5018) :</p>";
echo "<p class = sa >यणो मयो द्वे वाच्ये (यण्‌ पञ्चमी तथा मय्‌ षष्ठी) (वा ५०१८) :</p>";
display(1); 
}
/* yaNo mayo dve vAcye (vA 5018) may in paJcamI and yaN in SaSThI)*/
if (sub($hrasva,prat('my'),prat('yR'),0))
{
$text = dvitva(prat('my'),prat('yR'),array(""),array(""),2,1);
echo "<p class = sa >By yaNo mayo dve vAcye (may in paJcamI and yaN in SaSThI) (vA 5018):</p>";
echo "<p class = sa >यणो मयो द्वे वाच्ये (मय्‌ पञ्चमी तथा यण्‌ षष्ठी) (वा ५०१८) :</p>";
display(1);
}
if (sub($dirgha,prat('my'),prat('yR'),0) && $sthanivadbhav ===1)
{
$text = dvitva(prat('my'),prat('yR'),array(""),array(""),2,1);
echo "<p class = sa >By yaNo mayo dve vAcye (may in paJcamI and yaN in SaSThI) (vA 5018):</p>";
echo "<p class = sa >यणो मयो द्वे वाच्ये (मय्‌ पञ्चमी तथा यण्‌ षष्ठी) (वा ५०१८) :</p>";
display(1);
}
/* vA'vasAne (8.4.54) */
if (arr($text,'/['.pc('Jl').']$/'))
{
$text = last(prat('Jl'),savarna(prat('Jl'),prat('cr')),1);
echo "<p class = sa >By vA'vasAne (8.4.54) :</p>";
echo "<p class = sa >वाऽवसाने (८.४.५४) :</p>";
    display(0);
}
/* khari ca (8.4.55) */ 
$Jl1 = array("J","B","G","Q","D","j","b","g","q","d","K","P","C","W","T","c","w","t","k","p","S","z","s","h");
$Jl2 = array("J","B","G","Q","D","j","b","g","q","d","K","P","C","W","T","h");
if ($cayo===0)
{
    while(sub($Jl2,prat('Kr'),blank(0),0) !== false)
    {
        if ( (sub($Jl1,prat('Kr'),blank(0),0) || $dhut === 1))
        {
        $text = two($Jl1,prat('Kr'),savarna(prat('Jl'),prat('cr')),prat('Kr'),0);
        echo "<p class = sa >By khari ca (8.4.55) :</p>";
        echo "<p class = sa >खरि च (८.४.५५) :</p>";
        display(0);
        }
    }
}
if (sub(prat('cr'),prat('Kr'),blank(0),0) || $dhut === 1)
    {
    echo "<p class = sa >By khari ca (8.4.55) :</p>";
    echo "<p class = hn >N.B. By khari ca (8.4.55), 'car' varNas give 'car' varNas only as their savarNa :</p>";
    echo "<p class = sa >खरि च (८.४.५५) :</p>";
    echo "<p class = hn >खरि च (८.४.५५) से चर्‌ वर्णों का सवर्ण चर्‌ ही रहता है ।</p>";
    display(0);
    }
/* aNo'pragRhyasyAnunAsikaH (8.4.57) */
if (arr($text,'/[aAiIuUfFxX]$/'))
{
    $text = last(array("a","A","i","I","u","U","f","F","x","X"),array("a!","A!","i!","I!","u!","U!","f!","F!","x!","X!"),1);
    echo "<p class = sa >By aNo'pragRhyasyAnunAsikaH (8.4.57) :</p>";
    echo "<p class = sa >अणोऽप्रगृह्यस्यानुनासिकः (८.३.५७) :</p>";
display(0);
}
/* anusvArasya yayi parasavarNaH (8.4.58) and vA padAntasya (8.4.59) */
$mm = array("My","Mv","Mr","Ml","MY","Mm","MN","MR","Mn","MJ","MB","MG","MQ","MD","Mj","Mb","Mg","Mq","Md","MK","MP","MC","MW","MT","Mc","Mw","Mt","Mk","Mp");
$pa = array("!yy","!vv","!rr","!ll","YY","mm","NN","RR","nn","YJ","mB","NG","RQ","nD","Yj","mb","Ng","Rq","nd","NK","mP","YC","RW","nT","Yc","Rw","nt","Nk","mp");
if (sub(array("M"),prat('yy'),blank(0),0))
{
$text = one($mm,$pa,1);
echo "<p class = sa >By anusvArasya yayi parasavarNaH (8.4.58) and vA padAntasya (8.4.59) :</p>
    <p class = hn >N.B.: The change of anusvARa to parasavarNa is mandatory for non padAnta conjoints. For padAnta conjoints, it is optional.</p>";
echo "<p class = sa >अनुस्वारस्य ययि परसवर्णः (८.४.५८) तथा वा पदान्तस्य (८.४.५९) :</p>
    <p class = hn >पदान्त में पाक्षिक है । अपदान्त के लिए अनिवार्य है ।</p>";
display(0);
}
/* torli (8.4.60) */
$to = array("tl","Tl","dl","Dl","nl");
$lirep = array("ll","ll","ll","ll","l!l",);
while(sub($to,blank(0),blank(0),0) !== false)
{
if (sub($to,blank(0),blank(0),0))
{
$text = one($to,$lirep,0);
echo "<p class = sa >By torli (8.4.60) :</p>";
echo "<p class = sa >तोर्लि (८.४.६०) :</p>";
display(0);
}
}
/* jhayo ho'nyatarasyAm (8.4.62) */ 
$Jy = array("Jh","Bh","Gh","Qh","Dh","jh","bh","gh","qh","dh","Kh","Ph","Ch","Wh","Th","ch","wh","th","kh","ph",);
$h1 = array("JJ","BB","GG","QQ","DD","jJ","bB","gG","qQ","dD","KG","PB","CJ","WQ","TD","cJ","wQ","tD","kG","pB",);
if (sub($Jy,blank(0),blank(0),0)) 
{
$text = one($Jy,$h1,1);
echo "<p class = sa >By jhayo ho'nyatarasyAm (8.4.62) :</p>";
echo "<p class = sa >झयो होऽन्यतरस्याम्‌ (८.४.६२) :</p>";
display(0);
}
/* zazCho'Ti (8.4.63) and ChatvamamIti vAcyam (vA 5025) */
$Jy = array("JS","BS","GS","QS","DS","jS","bS","gS","qS","dS","KS","PS","CS","WS","TS","cS","wS","tS","kS","pS",);
$h1 = array("JC","BC","GC","QC","DC","jC","bC","gC","qC","dC","KC","PC","CC","WC","TC","cC","wC","tC","kC","pC",);
$aT = array("a","A","i","I","u","U","f","F","x","X","e","o","E","O","h","y","v","r","l","Y","m","G","R","n");
if(sub($Jy,$aT,blank(0),0) && $pada === "pada")
{
$text = two($Jy,$aT,$h1,$aT,1);
echo "<p class = sa >By zazCho'Ti (8.4.63) and ChatvamamIti vAcyam (vA 5025) :</p>";
echo "<p class = sa >शश्छोऽटि (८.४.६३) तथा छत्वममीति वाच्यम्‌ (वा ५०२५) :</p>";
display(0);
}
/* halo yamAM yami lopaH (8.4.64) */ 
$duplicate = array("NN","YY","RR","nn","mm","yy","rr","ll","vv",);
$dup = array("N","Y","R","n","m","y","r","l","v",);
$hl = array("k","K","g","G","N","c","C","j","J","Y","w","W","q","Q","R","t","T","d","D","n","p","P","b","B","m","y","r","l","v","S","z","s","h");
if (sub($hl,prat('ym'),prat('ym'),0))
{
$text = two($hl,$duplicate,$hl,$dup,1);
echo "<p class = sa >By halo yamAM yami lopaH (8.4.64) :</p>";
echo "<p class = sa >हलो यमां यमि लोपः (८.४.६४) :</p>";
display(0);
}
/* jharo jhari savarNe (8.4.65) */ 
if(sub(prat('hl'),prat('Jr'),prat('Jr'),0))
{
for ($i=0;$i<count(prat('Jr'));$i++)
{$kkk = array("k","K","g","G"); $ccc = array("c","C","j","J","S");
$www = array("w","W","q","Q","z"); $ttt = array("t","T","d","D","s");
$ppp = array("p","P","b","B");
$text = three(prat('hl'),$kkk,$kkk,prat('hl'),blank(4),$kkk,1);
$text = three(prat('hl'),$ccc,$ccc,prat('hl'),blank(5),$ccc,1);
$text = three(prat('hl'),$www,$www,prat('hl'),blank(5),$www,1);
$text = three(prat('hl'),$ttt,$ttt,prat('hl'),blank(5),$ttt,1);
$text = three(prat('hl'),$ppp,$ppp,prat('hl'),blank(4),$ppp,1);
}
echo "<p class = sa >By jharo jhari savarNe (8.4.65) :</p>";
echo "<p class = sa >झरो झरि सवर्णे (८.४.६५) :</p>";
display(0);
}
/* Final Display */
echo "<p class = sa >Final forms are :</p>";
echo "<p class = sa >आखिरी रूप हैं :</p>";
display(0);
?>
</body>
</html>