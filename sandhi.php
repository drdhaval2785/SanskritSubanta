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
// Including arrays and functions 
include "function.php";
include "slp-dev.php";
include "dev-slp.php";
// set execution time to an hour
ini_set('max_execution_time', 36000);
// set memory limit to 1000 MB
ini_set("memory_limit","1000M");
// Reading from the HTML input.
$first = $_POST["first"];
$second = $_POST['second'];
$tran = $_POST['tran'];
//$first = "rAma";
//$second = "iti";
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





// Devanagari handling. This is innocuous. Therefore even running without the selection in dropbox.
$first = json_encode($first);
$first = str_replace("\u200d","",$first);
$first = str_replace("\u200c","",$first);
$first = json_decode($first);
$second = json_encode($second);
$second = str_replace("\u200d","",$second);
$second = str_replace("\u200c","",$second);
$second = json_decode($second);
$first = convert1($first); //echo $input1."</p>";
$second = convert1($second);// echo $input2."</p>";

 
$input = ltrim(chop($first.$second));

//$padanta[] = strpos($input,$second);

// displaying the data back to the user
echo "<p class = no >You entered: ".convert($first)." + ".convert($second)."</p>";
echo "</br>";
    

    
 /* main coding part starts from here.
 * Based on Siddhantakaumudi text.
 */
    
    
$text = array();
// joining the two words
$text[] = $input; 
//print_r($text);
$start = 1;
do 
{
$original = $text ;
/* pragRhya section */

/* plutapragRhyA aci nityam (6.1.125) */
// There is no definition of pluta / pragRhya here. So we will code that as and when case arises.

/* iko'savarNe zAkalyasya hrasvazca (6.1.127) */ // Right now coded for only dIrgha. Clarify wheter the hrasva preceding also included?
$ik = array("i","I","u","U","f","F","x","X");
$nonik = array("a","A","e","E","o","O");
if (sub($ik,$nonik,blank(0),0))
{
$text = two(array("i","I"),array("a","A","u","U","f","F","x","X","e","o","E","O"),array("i ","i "),array("a","A","u","U","f","F","x","X","e","o","E","O"),1);
$text = two(array("u","U"),array("a","A","i","I","f","F","x","X","e","o","E","O"),array("u ","u "),array("a","A","i","I","f","F","x","X","e","o","E","O"),1);
$text = two(array("f","F"),array("a","A","u","U","i","I","e","o","E","O"),array("f ","f "),array("a","A","u","U","i","I","e","o","E","O"),1);
$text = two(array("x","X"),array("a","A","u","U","i","I","e","o","E","O"),array("x ","x "),array("a","A","u","U","i","I","e","o","E","O"),1);
echo "<p class = sa >By iko'savarNe zAkalyasya hrasvazca (6.1.127) :</p>
    <p class = hn >Note that this will not apply in samAsa. Also when followed by a 'sit' pratyaya, it will not apply. e.g. pArzva</p>";
display(0);
}


/* RtyakaH (6.1.128) */
$ak = array("a","A","i","I","u","U","f","F","x","X"); 
if (preg_match('/['.flat($ak).']$/',$first) && preg_match('/^[fx]/',$second) && $start===1 )
{
if (checkarray($ak,array("f","x"),blank(0),blank(0))===1)
{
$text = two ($ak,array("f","x"),$ak,array(" f"," x"),1);
echo "<p class = sa >By RtyakaH (6.1.128) :</p>
    <p class = hn >Note: This applies only to padAnta. </p>";
display(0);
}
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
if (sub(array("amI"),blank(0),blank(0),0) && $start===1)
{
$text = two (array("amI"),$ac,array("amI "),$ac,1);
echo "<p class = sa >By adaso mAt (1.1.12) :</p>";
display(0);
}
if (sub(array("amU"),blank(0),blank(0),0)&& $start===1)
{
$text = two (array("amU"),$ac,array("amU "),$ac,1);
echo "<p class = sa >By adaso mAt (1.1.12) :</p>";
display(0);
}

/* ze (1.1.13) */
// Not possible to know whether one form has ze or not.

/* nipAta ekAjanAG (1.1.14) */
$nipata = array("a","A","i","I","u","U","e","E","o","O");
$nipata1 = array("a ","A ","i ","I ","u ","U ","e ","E ","o ","O ");
if (in_array($first,$nipata) && $start===1)
{
$text = two ($nipata,$ac,$nipata1,$ac,0);
echo "<p class = sa >By nipAta ekAjanAG (1.1.14) :</p>";
display(0);
}

/* ot (1.1.15) */
$ot = array("o","aho","ho","utAho","aTo");
$ot1 = array("o ","aho ","ho ","utAho ","aTo ");
if (in_array($first,$ot) && $start===1)
{
$text = two ($ot,$ac,$ot1,$ac,0);
echo "<p class = sa >By ot (1.1.15) :</p>";
display(0);
}

/* sambuddhau zAkalyasyetAvanArSe (1.1.16) */
if (preg_match('/[o]$/',$first) && $second === "iti" && $start===1)
{
$text = two(array($first),$ac,array($first." "),$ac,1);
echo "<p class = sa >By sambuddhau zAkalyasyetAvanArSe (1.1.16) :</p>
    <p class = hn >Note: This rule will apply only in case the 'o'kAra at the end of the first word is for sambuddhi and the 'iti' is anArSa (of non-vedic origin).</p>";
display(0);
}

/* UYaH (1.1.17) */
if ($first === "u" && $second === "iti" && $start===1)
{
$text = two(array("u"),array("iti"),array("u "),array("iti"),1);
echo "<p class = sa >By uYaH (1.1.17) :</p>";
display(0);
}

/* U! (1.1.18) */ // Here ! has been used for anunAsika.
if ($first === "u" && $second === "iti" && $start===1)
{
$text = two(array("u"),array("iti"),array("U! "),array("iti"),1);
echo "<p class = sa >By U! (1.1.17) :</p>";
display(0);
}

/* maya uYo vo vA (8.3.33) */
if (sub(prat('my'),array("u"),$ac,0))
{
$text = three(prat('my'),array("u"),$ac,prat('my'),array("v"),$ac,1);
echo "<p class = sa >By maya uYo vo vA (8.3.33) :</p>";
display(0);
}


/* IdUtau ca saptamyarthe (1.1.19) */
$idut = array("I","U"); $idut1 = array("I ","U ");
if (preg_match('/[IU]$/',$first) && sub(array("I","U"),$ac,blank(0),0))
{
$text = two($idut,$ac,$idut1,$ac,1);
echo "<p class = sa >By IdUtau ca saptamyarthe (1.1.19) :</p>
    <p class = hn >N.B.: This will apply only in case the I/U at the end of the first word have been used in sense of saptamI vibhakti. Otherwise this pragRhyatva will not be there.</p>";
display(0);
}

/* zakandhvAdiSu pararUpaM vAcyam (vA 3632) */
$shakandhu1 = array("Saka","karka","kula","manas","hala","lANgala","patan","mfta");
$shakandhu2 = array("anDu","anDu","awA","IzA","IzA","IzA","aYjali","aRqa");
$shakandhu = array("SakanDu","karkanDu","kulawA","manIzA","halIzA","lANgalIzA","pataYjali","mArtaRqa");
if (sub($shakandhu1,$shakandhu2,blank(0),0))
{
$text = two($shakandhu1,$shakandhu2,$shakandhu,blank(count($shakandhu)),0);
echo "<p class = sa >By zakandhvAdiSu pararUpaM vAcyam (vA 3632) :</p>";
display(0);
}
$shakandhu1 = array("sIman","sAra");
$shakandhu2 = array("anta","aNga");
$shakandhu = array("sImanta","sAraNga");
if (sub($shakandhu1,$shakandhu2,blank(0),0))
{
$text = two($shakandhu1,$shakandhu2,$shakandhu,blank(count($shakandhu)),0);
echo  "<p class = hn >Note: the sImanta - kezaveSa and sAraGga - pazu/pakSI - Then only this will apply.</p>";
display(0);
}


/* Rti savarNe R vA (vA 3640) and lRti savarNe lR vA (vA 3641) */
$ruti1 = array("f","F","x","X");
$ruti2 = array("f","f");
$lruti2 = array("x","x");
if (sub($ruti1,$ruti2,blank(0),0)||sub($ruti1,$lruti2,blank(0),0))
{
$text = two($ruti1,$ruti2,blank(count($ruti1)),$ruti2,1);
$text = two($ruti1,$lruti2,blank(count($ruti1)),$lruti2,1);
echo "<p class = sa >By Rti savarNe R vA (vA 3640) and lRti savarNe lR vA (vA 3641) :</p>";
display(0);
}

/* akaH savarNe dIrghaH (6.1.101) */ // Check RlRyoH mithaH sAvarNyam vAcyam.. Not coded for it. Not that clear.
$ak1 = array("a","a","A","A","i","i","I","I","u","u","U","U","f","f","F","F","f","f","F","F","x","x","X","X","x","x","X","X");
$ak2 = array("a","A","a","A","i","I","i","I","u","U","u","U","f","F","f","F","x","X","x","X","f","F","f","F","x","X","x","X");
if (sub($ak1,$ak2,blank(28),1))
{
$text = two(array("a","A"),array("a","A"),blank(2),array("A","A"),0);
$text = two(array("i","I"),array("i","I"),blank(2),array("I","I"),0);
$text = two(array("u","U"),array("u","U"),blank(2),array("U","U"),0);
$text = two(array("f","F","x","X"),array("f","F","x","X"),blank(4),array("F","F","F","F"),0);
$text = two(array("x","X"),array("x","X"),blank(2),array("F","F"),0);
echo "<p class = sa >By akaH savarNe dIrghaH (6.1.101) :</p>";
display(0);
}


/*iko yaNaci (6.1.77) */
if(sub(array('i','I','u','U'),prat('ac'),blank(0),0))
{
$text = two(array('i','I','u','U'),prat('ac'),array('y','y','v','v'),prat('ac'),0);
echo "<p class = sa >By iko yaNaci (6.1.77) :</p>";
display(0);
}
if(sub(array("f","F","x","X"),prat('ac'),blank(0),0))
{
$text = two(array("f","F","x","X"),prat('ac'),array("r","r","l","l"),prat('ac'),0);
echo "<p class = sa >By iko yaNaci (6.1.77) :</p>";
$sthanivadbhav = 1;
display(0);
}
else
{
$sthanivadbhav = 0;
}
/* sarvatra vibhASA goH (6.1.122) */
$go = array("go"); $aonly = array("a");
if(sub($go,$aonly,blank(0),0))
{
$text = two($go,$aonly,array("go "),$aonly,1);
echo "<p class = sa >By sarvatra vibhASA goH (6.1.122)</p>
    <p class = hn >it is optionally kept as prakRtibhAva :</p>";
display(0); $gogo = 1;
} else { $gogo = 0; } 
/* avaG sphoTAyanasya (6.1.123) */
if (sub($go,prat('ac'),blank(0),0))
{
$text = two($go,prat('ac'),array('gava'),prat('ac'),1);
echo "<p class = sa >By avaG sphoTAyanasya (6.1.123) </p>
    <p class = hn >it is optionally converted to avaG :</p>";
display(0); $gogo1 = 1;
} else { $gogo1 = 0; }
/* indre ca (6.1.124) */
if (sub($go,array("indra"),blank(0),0))
{
$text = two($go,array("indra"),array('gava'),array("indra"),0);
echo "<p class = sa >by indre ca (6.1.124) :</p>";
display(0); $gogo2 = 1;
} else { $gogo2 = 0; }

/* eGaH padAntAdati (6.1.109) */
if (sub(array("e","o"),array("a"),blank(0),0))
{
    $text = two(prat('eN'),array("a"),prat('eN'),array("'"),0);
    echo "<p class = sa >By eGaH padAntAdati (6.1.109) : </p>";
    display(0);
}


/* eco'yavAyAvaH (7.1.78) */
$ayavayavah = array("ay","av","Ay","Av");
if (sub(prat('ec'),prat('ac'),blank(0),0))
{
$text = two(prat('ec'),prat('ac'),$ayavayavah,prat('ac'),0);
echo "<p class = sa >By echo'yavAyAvaH (7.1.78) :</p>";
display(0);
$bho = 1;
} else { $bho = 0; }
/* vAnto yi pratyaye (6.1.71), goryutau CandasyupasaMkhyAnam (vA 3543), adhvaparimANe ca (vA 3544) dhAtostannimittasyaiva (6.1.80) */
$o = array("o","O"); $oo = 'oO'; $y = array("y"); $ab = array("av","Av");
$text1 = $text; 
if (sub($o,$y,blank(0),0))
{
$text = two($o,$y,$ab,$y,0);
    echo "<p class = sa >By vAnto yi pratyaye (6.1.71), goryutau CandasyupasaMkhyAnam (vA 3543), adhvaparimANe ca (vA 3544)  : </p>
        <p class = hn > If the 'y' following 'o/O' belongs to a pratyaya or the word 'go' is followed by 'yuti' in Chandas/ as a measure of distance (vA 3543, 3544).</p>";
    display(0);
    echo "<p class = hn >N.B. that if the 'o'kAra or 'au'kAra is of a dhAtu and the pratyaya is starting from 'y', this prakriyA applies only in cases where the 'o'kAra or the 'au'kAra is of dhAtu only.</p>";
    echo "<p class = hn >Otherwise :</p>";
    display(2);
}
$text = merge($text,$text1);

/* kSayyajayyau zakyArthe (6.1.81)*/
if (sub(array("kzeya"),blank(0),blank(0),0))
{
    $text = one(array("kzeya"),array("kzayya"),1);
    echo "<p class = sa >By kSayyajayyau zakyArthe (6.1.81) :</p>
        <p class = hn >If the word is to be used in the meaning of 'being capable of', then only it will be क्षय्य.</p>";
    display(0);    
}
if (sub(array("jeya"),blank(0),blank(0),0))
{
        $text = one(array("jeya"),array("jayya"),1);
    echo "<p class = sa >By kSayyajayyau zakyArthe (6.1.81) :</p>
        <p class = hn >If the word is to be used in the meaning of 'being capable of', then only it will be जय्य.</p>";
    
    display(0);
}

/* krayyastadarthe (6.1.82) */
if (sub(array("kreya"),blank(0),blank(0),0))
{
    
    $text = one(array("kreya"),array("krayya"),1);
    echo "<p class = sa >By krayyastadarthe _6.1.82) :</p>
        <p class = hn >If the word is to be used in the meaning of 'for sale', then only it will be क्रय्य.</p>";
    display(0);
}
// This is to patch for tripadi function of sasajuSo ruH 

/* etattadoH sulopo'konaJsamAse hali (6.1.132) */
if (sub(array("sa","eza"),array("s"),$hl,0)  && !sub(array("asa","anEza"),array("s"),$hl,0))
{
    $text = three(array("sa","eza"),array("s"),$hl,array("sa","eza"),array(" "),$hl,1);
    echo "<p class = sa >By etattadoH sulopo&konaJsamAse hali 6.1.132) :</p>";
    display(0);
}
/* so'ci lope cetpAdapUraNam (6.1.134) */
if (sub(array("sa"),array("s"),$ac,0))
{
    $text = three(array("sa"),array("s"),$ac,array("sa"),array(""),$ac,1);
    echo "<p class = sa >so'ci lope cetpAdapUraNam (6.1.134) :</p>
        <p class = hn >N.B. : There is difference of opinion here. vAmana thinks that it applies only to RkpAda. Others think that it applies to zlokapAda also e.g. 'saiSa dAzarathI rAmaH'.</p>";
    display(0);
}


/* vasusraMsudhvaMsvanaDuhAM daH (8.2.72) */
$vasu = array("sraMs","DvaMs","anaquh");
if (sub($vasu,blank(0),blank(0),0))
{
    $text = one($vasu,array("vad","srad","Dvad","anaqud"),0);
    echo "<p class = sa >By vasusraMsudhvaMsvanaDuhAM daH (8.2.72) :</p>";
    display(0); $vasuu = 1;
} else {$vasuu = 0; }
$vasu1 = array("vas");
if ((substr($first,strlen($first)-3) === "vas" ||substr($second,strlen($second)-3) === "vas") && $vasuu !==1 )
{
    $text = one($vasu1,array("vad"),1);
    echo "<p class = sa >By vasusraMsudhvaMsvanaDuhAM daH (8.2.72) :</p>
        <p class = hn >N.B. : If 'vas' is used in sense of vasvanta as in 'vidvas', then only this conversion takes place. Not in cases like 'zivas'.</p>";
    display(0); $vasuu = 1;
} else {$vasuu = 0; }

/* sasajuSo ruH (8.2.66) */
if (preg_match('/[H]$/',$first) && $start===1)
{
    $text = one(array("H"),array("r@"),0);
    echo " <p class = hn >You have entered a visarga at the end of the first word. Usually it is derived from a sakAra at the end of the word.</p>";
}
if (preg_match('/[s]$/',$first) && $start===1)
{
     $text = one(array($first),array(substr($first,0,strlen($first)-1)."r@"),0);
     echo "<p class = sa >By sasajuSo ruH (8.2.66) :</p>
        <p class = hn >This is an exception to jhalAM jazo'nte.</p>"; $r1= 1;
     display(0);
}
elseif ($start>1 && $r1!==0) { $r1 = 1; } else {$r1=0; }
if (preg_match('/[s]$/',$second) && $start===1)
{
     $text = one(array(substr($second,1)),array(substr($second,1,strlen($second)-2)."r@"),0);
     echo "<p class = sa >By sasajuSo ruH (8.2.66) :</p>
         <p class = hn >This is an exception to jhalAM jazo'nte.</p>"; $r2 = 1;
     display(0);
}
elseif ($start>1 && $r2!==0) { $r2 = 1; } else {$r2=0; }


/* ahan(8.2.68) and ro'supi (8.2.69) and rUparAtrirathantareSu vAcyam (vA 4847) */
if (sub(array("ahan"),blank(0),blank(0),0) && ($first === "ahan" || $second === "ahan" ))      
{
    $text = one(array("ahan"),array("ahaMr@"),0); 
     $text = one(array("Mr@"),array("!r@"),1);
    $text = one(array("ahar@"),array("ahar"),1);
    $text = two(array("ahar"),array("rUpa","rAtr","raTantar"),array("ahar@"),array("rUpa","rAtr","raTantar"),0);
    echo "<p class = sa >By ahan (8.2.68) and ro'supi (8.2.69),  atrAnunAsikaH pUrvasya tu vA (8.3.2), anunAsikAtparo'nusvAraH (8.3.4) and rUparAtrirathantareSu vAcyam (vA 4847).</p>
        <p class = hn >N.B. - the rule converting the 'n' to rutva applies only in case of padAntatva. The rephAdeza occurs in case it is not followed by sup pratyayas.</p>";
    display(0); $r3 = 1;
} else { $r3 = 0; }

/* samaH suTi (8.3.5) */ // have used @ as mark of anunAsika u of ru. 
if (sub(array("samsk"),blank(0),blank(0),0))
{
$text = one(array("sams"),array("saMr@s"),0);
$text = one(array("Mr@"),array("!r@"),1);
echo "<p class = sa >By samaH suTi (8.3.5), atrAnunAsikaH pUrvasya tu vA (8.3.2) and anunAsikAtparo'nusvAraH (8.3.4) :</p>";
display(0); $r4 = 1;
} else { $r4 = 0; }
/* pumaH khayyampare (8.3.6) */
$am = array("a","A","i","I","u","U","f","F","x","X","e","o","E","O","h","y","v","r","l","Y","m","N","R","n");
if(sub(array("pum"),prat('Ky'),$am,0))
{
$text = three(array("pum"),prat('Ky'),$am,array("puMr@"),prat('Ky'),$am,0);
$text = one(array("Mr@"),array("!r@"),1);
echo "<p class = sa >By pumaH khayyampare (8.3.6), atrAnunAsikaH pUrvasya tu vA (8.3.2) and anunAsikAtparo'nusvAraH (8.3.4) :</p>";
display(0); $r5 = 1;
} else { $r5 = 0; }
/* khyAYAdeze na (vA 1591) */
if (sub(array("pur@Ky"),blank(0),blank(0),0))
{
$text = one(array("pur@Ky"),array("pumKy"),0);
$text = one(array("!r@"),array("m"),0);
$text = one(array("Mr@"),array("m"),0);
echo "<p class = sa >By khyAYAdeze na (vA 1591) :</p>";
display(0);
}
/* nazChavyaprazAn (8.3.7) */
if (sub(array("n"),prat('Cv'),$am,0) && preg_match('/[n]$/',$first) && preg_match('/^['.pc('Cv').']/',$second))
{
$text = three(array("n"),prat('Cv'),$am,array("Mr@"),prat('Cv'),$am,0);
$text = one(array("praSAMr@"),array("praSAn"),0);
$text = one(array("Mr@"),array("!r@"),1);
echo "<p class = sa >By nazChavyaprazAn (8.3.7), atrAnunAsikaH pUrvasya tu vA (8.3.2) and anunAsikAtparo'nusvAraH (8.3.4) :</p>";
display(0); $r6 = 1;
} else { $r6 = 0; }

/* nRUnpe (8.3.10) */
if (sub(array("nFnp"),blank(0),blank(0),0))
{
$text = one(array("nFnp"),array("nFMr@p"),0);
$text = one(array("Mr@"),array("!r@"),1);
echo "<p class = sa >By nRUnpe (8.3.10), atrAnunAsikaH pUrvasya tu vA (8.3.2) and anunAsikAtparo'nusvAraH (8.3.4) ";
display(0); $r7 = 1;
} else { $r7 =0;}

/* kAnAmreDite (8.3.12) */ 
if (sub(array("kAnkAn"),blank(0),blank(0),0))
{
$text = one(array("kAnkAn"),array("kAMr@kAn"),0);
$text = one(array("Mr@"),array("!r@"),1);
echo "<p class = sa >By kAnAmreDite (8.3.12), atrAnunAsikaH pUrvasya tu vA (8.3.2) and anunAsikAtparo'nusvAraH (8.3.4) :</p>";
display(0); $r8 = 1;
} else { $r8 =0; }

/* ato roraplutAdaplute (6.1.113) */
if (sub(array("ar@a"),blank(0),blank(0),0))
{
    $text = one(array("ar@a"),array("aua"),0);
    echo "<p class = sa >By ato roraplutAdaplute (6.1.113) :</p>";
    display (0); $ato = 1;
} else {$ato = 0;}


/* hazi ca (6.1.114) */
if (sub(array("a"),array("r@"),prat('hS'),0))
{
    $text = three(array("a"),array("r@"),prat('hS'),array("a"),array("u"),prat('hS'),0);
    echo "<p class = sa >By hazi ca (6.1.114) :</p>";
    display (0); $hazi = 1;
} else { $hazi = 0; } 
/* nAdici (6.1.104) */
$ic = array("i","I","u","U","f","F","x","X","e","o","E","O");
if (sub(array("a","A"),$ic,blank(0),0) && ($ato ===1||$hazi === 1))
{
    echo "<p class = sa >By nAdici (6.1.104) :</p>
        <p class = hn >N.B. : This is exception to prathamayoH pUrvasavarNaH. </p>";
    display (0); $nadici = 1;
} else { $nadici = 0; }

/* prathamayoH pUrvasavarNaH (6.1.102) */
$ak = array("a","A","i","I","u","U","f","F","x","X"); 
$akreplace = array("A","A","I","I","U","U","F","F","F","X");
if (sub($ak,$ac,blank(0),0) && ($ato ===1||$hazi === 1) && $nadici !== 1)
{
    $text = two($ak,$ac,$akreplace,blank(count($ac)),1);
    echo "<p class = sa >By prathamayoH pUrvasavarNaH (6.1.102) :</p>
        <p class = hn >N.B. : This applies to only in prathamA and dvitIyA vibhakti, and not in other cases. </p>";
    display (0);
}


/* ekaH pUrvaparayoH (6.1.84) */ // This is the adhikArasUtra. No vidhi mentioned.



// The following vArtikas are exception to AdguNaH. Otherwise after joining, it will be difficult to identify. So coded here.
/* akSAdUhinyAmupasaMkhyAnam (vA 3604) */
/* svAdireriNoH (vA 3606) */
/*prAdUhoDhoDyeSaiSyeSu (vA 3605) */
/* Rte ca tRtIyAsamAse (vA 3607) */
/* pravatsatarakambalavasanadazArNAnAmRNe (vA 3608-9) */
$va3607 = array('akzaUhinI','svairi','praUh','praUQ','praez','praezy','suKaft','prafR','vatsafR','kambalafR','vasanafR','daSafR','fRafR','svaira');
$va3608 = array('akzOhiRI','svEri','prOh','prOQ','prEz','prEzy','suKArt','prArR','vatsArR','kambalArR','vasanArR','daSArR','fRArR','svEra');
if (sub($va3607,blank(0),blank(0),0))
{
$text = one($va3607,$va3608,0);
echo "<p class = sa >Applying the following vArtikas : akSAdUhinyAmupasaMkhyAnam (vA 3604), svAdireriNoH (vA 3606), prAdUhoDhoDyeSaiSyeSu (vA 3605), Rte ca tRtIyAsamAse (vA 3607), pravatsatarakambalavasanadazArNAnAmRNe (vA 3608-9)</p>";
display(0);
}
/* upasargAdRti dhAtau (6.1.11) */
if (sub($akarantaupasarga,$verbs_ru,blank(0),0))
{
$text = two($akarantaupasarga,$verbs_ru,$changedupasarga,$verbs_changed,0);
echo "<p class = sa >By upasargAdRti dhAtau (6.1.11) :</p>";
echo "<p class = hn >If the dhAtu used is a nAmadhAtu, the 'a'kAra of upasarga is optionally kept hrasva by vA supyApizaleH (6.1.92).
    Also if the following verb starts from a dIrgha 'R'kAra or dIrgha 'lR'kAra, the optionallity is not there. There is always a hrasva.</p>";
display(0);
}


/* AdguNaH (6.1.87) */
$forguna = array("i","I","u","U");
$rep = array("e","e","o","o");
if (sub($aa,$forguna,blank(0),0))
{
$text = two($aa,$forguna,blank(2),$rep,0);
echo "<p class = sa >By AdguNaH (6.1.87) :</p>";
display(0);
}

/* uraNraparaH (1.1.51) */ 
$forguna = array("f","F","x","X");
$rep = array("ar","ar","al","al");
if (sub($aa,$forguna,blank(0),0))
{
$text = two($aa,$forguna,blank(2),$rep,0);
echo "<p class = sa >By AdguNaH (6.1.87) and uraNraparaH (1.1.51) :</p>";
display(0);
}

/* etyedhatyuThsu (6.1.89) */ // Pending. Too less examples and too wide implications. 
if (sub(array("a","A"),array("eti","eDati","oha"),blank(0),0))
{
    $text = two (array("a","A"),array("eti","eDati","oha"),blank(2),array("Eti","EDati","Oha"),0);
    echo "<p class = sa >By etyedhatyuThsu (6.1.89) :</p>";
    display(0);
}

/* eGi pararUpam (6.1.94) */ // Added it here because it is exception to vRddhireci.
for($i=0;$i<count($akarantaupasarga);$i++)
{
    $a_upa_without_a[$i] = substr($akarantaupasarga[$i],0,count(str_split($akarantaupasarga[$i]))-1); 
}
if (sub($akarantaupasarga,prat('eN'),blank(0),0))
{
$text = two($akarantaupasarga,prat('eN'),$a_upa_without_a,prat('eN'),0);
echo "<p class = sa >By eGi pararUpam (6.1.94) :</p>";
display(0);
}
/* eve cAniyoge (vA 3631) */
$eva = array("eva");
if (sub($aa,$eva,blank(0),0))
{
$text = two($aa,$eva,blank(2),$eva,1);
echo "<p class = sa >By eve cAniyoge (vA 3631) :</p>
    <p class = hn >N.B. that the optionality applies only in case the eva is used for avadhAraNa.</p>" ;
display(0);
}

/* vA supyapizaleH (6.1.92) */ // Not possible to know what is nAmadhAtu and what is not. Therefore added as comments. Not coded.

/* aco'ntyAdi Ti (1.1.64) */ // a saJjJAsUtra. No vidhi meant.

/* otvoShThayoH samAse vA (vA 3634) */
$otu = array("otu","ozQ");
if (sub($aa,$otu,blank(0),0))
{
$text = two($aa,$otu,blank(2),$otu,1);
echo "<p class = sa >By otvoShThayoH samAse vA (vA 3634) :</p>
    <p class = hn >If what you entered is a samAsa, it will be optionally converted. Otherwise ignore the pararUpa form.</p>";
display(0);
}
/* omAGozca (6.1.95) */ 
$om = array("om");
if (sub($aa,$om,blank(0),0))
{
$text = two($aa,$om,blank(2),$om,0);
echo "<p class = sa >By omAGozca (6.1.95) :</p>
    <p class = hn >The om or AG following the a,A gets converted to pararUpa. Because of technical reasons, we can't tell when there is an 'AG' in the verb form. Whenever 'AG' is used, this rule would apply.</p>";
display(0);
}
/* avyaktAnukaraNasyAta itau (6.1.98) */
$at = array("at");
$iti = array("iti");
if (sub($at,$iti,blank(0),0))
{
$text = two($at,$iti,blank(1),$iti,1);
echo "<p class = sa >By avyaktAnukaraNasyAta itau (6.1.98) :</p>
    <p class = hn > When the 'at' happens to be at the end of an onaematopic word and it is followed by 'iti', its 'Ti' is elided. This rule doesn't apply on single vowel words like 'zrat'.</p>";
display(0);
}
/* nAmreDitasyAntasya tu vA (6.1.99), tasya paramAmreDitam (8.1.2) */
for($i=0;$i<count($text);$i++)
{
    $tttt = explode("at",$text[$i]);
    if (count($tttt) > 1)
    {
    if ($tttt[0] === $tttt[1])
    {
        echo "<p class = hn >Your data matches criteria for AmreDita.</p>";
        $amredita = 1;
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
if ($amredita === 1)
{
$at = array("at");
$iti = array("iti");
$text = two($at,$iti,array("a"),$iti,1);
echo "<p class = sa >nAmreDitasyAntasya tu vA (6.1.99), tasya paramAmreDitam (8.1.2) :</p>
    <p class = hn >When the 'at' happens to be at the end of an onaematopic word and it is followed by 'iti', its 'Ti' is elided. This rule doesn't apply on single vowel words like 'zrat'.</p>";
display(0);   
}

/* vRddhireci (6.1.88) */
$vrrdhi = array("E","O","E","O");
if (sub($aa,prat('ec'),blank(0),0))
{
$text = two($aa,prat('ec'),blank(2),$vrrdhi,0);
echo "<p class = sa >By vRddhireci (6.1.88) :</p>";
display(0);
}

/* udaH sthAstambhvoH pUrvasya (8.1.61) */
if(sub(array("utsTA","utstam"),blank(0),blank(0),0))
{
$text = two(array("ut"),array('sTA','stam'),blank(1),array('utTA','uttam'),0);
echo "<p class = sa >By udaH sthAstambhvoH pUrvasya (8.1.61) :</p>";
display(0);
}


/* saMhitAyAm (6.1.72) */ // This is adhikArasUtra. Nothing to code here.

/* Che ca (6.1.73) */
if (sub($hrasva,array("C"),blank(0),0))
{
$text = two($hrasva,array("C"),$hrasva,array("tC"),0);
echo "<p class = sa >By Che ca (6.1.73) :</p>";
display(0);
}
/* AGmAGozca (6.1.74) */
if (($first === "A" || $first === "mA") && $start===1)
{
$text = two(array("A"),array("C"),array("A"),array("tC"),0);
echo "<p class = sa >By AGmAGozca (6.1.74) :</p>";
display(0);
}

/* dIrghAt (6.1.75) and padAntAdvA (6.1.76) */
if (sub($dirgha,array("C"),blank(0),0))
{
$text = two($dirgha,array("C"),$dirgha,array("tC"),0);
echo "<p class = sa >By dIrghAt (6.1.75) padAntAdvA (6.1.76) :</p>
    <p class = hn >N.B.: The 'tuk' Agama is optional in case the preceding dIrgha vowel is at the padAnta. Otherwise, it is mandatory to add.</p>";
display(0);
}


$start++;
}
while ($text !== $original);





/* tripAdI functions */

/* saMyogAntasya lopaH (8.2.23) */ // coding pending because not clear. And also 'yaNaH pratiSedho vAcyaH' prohibits its application.

/* vrazcabhrasjamRjayajarAjabhrAjacChazAM ca (8.2.35) */
$vrasca = array("vraS","Bras","sfj","yaj","rAj","BrAj",);
$vrashca = array("vraz","Braz","sfz","yaz","rAz","BrAz");
if (sub($vrasca,prat('Jl'),blank(0),0) || sub($vrasca,blank(0),blank(0),0) && (in_array($first,$vrasca) ||in_array($second,$vrasca)))
{
    $text = one($vrasca,$vrashca,0);
    echo "<p class = sa >By vrazcabhrasjamRjayajarAjabhrAjacChazAM ca (8.2.35) :</p>";
    display(0);
}
if (preg_match('/[CS]$/',$second))
{
    $text = one(array(substr($second,0,strlen($second)-1)."C"),array(substr($second,0,strlen($second)-1)."z"),0);
    $text = one(array(substr($second,0,strlen($second)-1)."S"),array(substr($second,0,strlen($second)-1)."z"),0);
    echo "<p class = sa >By vrazcabhrasjamRjayajarAjabhrAjacChazAM ca (8.2.35) :</p>";
    display(0);
}
if (preg_match('/[CS]$/',$first) )
{
    $text = one(array(substr($first,0,strlen($first)-1)."C"),array(substr($first,0,strlen($first)-1)."z"),0);
    $text = one(array(substr($first,0,strlen($first)-1)."S"),array(substr($first,0,strlen($first)-1)."z"),0);
    echo "<p class = sa >By vrazcabhrasjamRjayajarAjabhrAjacChazAM ca (8.2.35) :</p>";
    display(0);
}

/* coH kuH (8.2.30) */
$cu = array("c","C","j","J","Y");
$ku = array("k","K","g","G","N");
if (preg_match('/['.flat($cu).']$/',$first) && preg_match('/^['.pc('Jl').']/',$second)) 
{
$text = two($cu,prat('Jl'),$ku,prat('Jl'),0); 
echo "<p class = sa >By coH kuH (8.2.30) :</p>";
display(0);
}

$second1 = str_split($second);
$second2 = substr($second,count($second1)-1); 
$secondbereplaced = chop($second,$second2); 
$second2 = array($second2); $secondbereplaced=array($secondbereplaced);
if (preg_match('/['.flat($cu).']$/',$second))
{
    $text = two($secondbereplaced,$cu,$secondbereplaced,$ku,0);
    echo "<p class = sa >By coH kuH (8.2.30) :</p>";
    display(0);   
}
$first1 = str_split($first);
$first2 = substr($first,count($first1)-1); 
$firstbereplaced = chop($first,$first2); 
$first2 = array($first2); $firstbereplaced=array($firstbereplaced);
if (preg_match('/['.flat($cu).']$/',$first) && $first === $input)
{
    $text = two($firstbereplaced,$cu,$firstbereplaced,$ku,0);
    echo "<p class = sa >By coH kuH (8.2.30) :</p>";
    display(0);   
}


/* ho DhaH (8.2.32) */
$first1 = str_split($first);
$first2 = substr($first,count($first1)-1); 
$firstbereplaced = chop($first,$first2); 
$first2 = array($first2); $firstbereplaced=array($firstbereplaced);
if (preg_match('/[h]$/',$first))
{
    $text = two($firstbereplaced,array("h"),$firstbereplaced,array("Q"),0);
    echo "<p class = sa >ho DhaH (8.2.32)  :</p>";
    display(0);    
}
$second1 = str_split($second);
$second2 = substr($second,count($second1)-1); 
$secondbereplaced = chop($second,$second2); 
$second2 = array($second2); $secondbereplaced=array($secondbereplaced);
if (preg_match('/[h]$/',$second))
{
    $text = two($secondbereplaced,array("h"),$secondbereplaced,array("Q"),0);
    echo "<p class = sa >By ho DhaH (8.2.32) :</p>";
    display(0);   
}


/* dAderdhAtorghaH (8.2.32) */
// Pending to code because involves dhAtus.

/* vA druhamuhaSNuhaSNihAm (8.2.33) */ 
// Pending to code

/* naho dhaH (8.2.33) */
// Pending to code

/* AhsthaH (8.2.34) */
// Pending to code


/* jhalAM jazo'nte (8.2.39) */ // The way I handle padAnta needs revision. Check whether we can apply a "+" sign at the end of $first. Ignore it in other cases. Remember when we need padAnta. Think.
$first1 = str_split($first);
$first2 = substr($first,count($first1)-1); 
$firstbereplaced = chop($first,$first2); 
$first2 = array($first2); $firstbereplaced=array($firstbereplaced);

$second1 = str_split($second);
$second2 = substr($second,count($second1)-1); 
$secondbereplaced = chop($second,$second2); 
$second2 = array($second2); $secondbereplaced=array($secondbereplaced);
if (preg_match('/['.pc('Jl').']$/',$second))
{
    $text = two($secondbereplaced,prat('Jl'),$secondbereplaced,savarna(prat('Jl'),prat('jS')),0);
    if ($r1 === 1) {echo "<p class = sa >jhalAM jazo'nte is barred by sasajuSo ruH. <hr>"; }
    else {
    echo "<p class = sa >By jhalAM jazo'nte (8.2.39), The padAnta is 'jhal' is replaced by 'jaz' :</p>
        <p class = hn >N.B.: If the jhal is at the end of a pada, it is mandatory to change it. Otherwise it is not going to change. Ignore which is not applicable.</p>";
    display(0);    }
}
if (preg_match('/['.pc('Jl').']$/',$first) )
{ 
    $text = two($firstbereplaced,prat('Jl'),$firstbereplaced,savarna(prat('Jl'),prat('jS')),0);
    if ($r1 === 1) {echo "<p class = sa >jhalAM jazo'nte is barred by sasajuSo ruH. <hr>"; }
    else {
    echo "<p class = sa >By jhalAM jazo'nte (8.2.39), The padAnta is 'jhal' is replaced by 'jaz' :</p>
        <p class = hn >N.B.: If the jhal is at the end of a pada, it is mandatory to change it. Otherwise it is not going to change. Ignore which is not applicable.</p>";
    display(0);    }
}



/* bhobhagoaghoapUrvasya yo'zi (8.3.17) and vyorlaghuprayatnataraH zAkaTAyanasya (8.3.18) : */
$ash = array("a","A","i","I","u","U","f","F","x","X","e","o","E","O","h","y","v","r","l","Y","m","N","R","n","J","B","G","Q","D","j","b","g","q","d");
if (sub(array("Bo","Bago","aGo","a","A"),array("r@"),$ash,0)) 
{
    $text = three(array("Bo","Bago","aGo","a","A"),array("r@"),$ash,array("Bo","Bago","aGo","a","A"),array("y+"),$ash,0);
    echo "<p class = sa >By bhobhagoaghoapUrvasya yo'zi (8.3.17) and vyorlaghuprayatnataraH zAkaTAyanasya (8.3.18) :</p>
       <p class = hn > In the opinion of zAkaTAyana, the padAnta yakAra and vakAra gets laghUccAraNa.</p>"; $bho = 1;
    display (0);
} else { $bho =0; }

/* vyorlaghuprayatnataraH zAkaTAyanasya (8.3.18) */
// This is regarding pronounciation.


// Patch to convert the rutva before vowels and hash to repha.
$text = two(array("r@"),$ac,array("r"),$ac,0);
$text = two(array("r@"),prat('hS'),array("r"),prat('hS'),0);


/* kharavasAnayorvisarjanIyaH (8.3.15) */
if (preg_match('/^['.pc('Kr').']/',$second) && sub(array("r"), array("@"),prat('Kr'),0))
{
 $text = two(array("r@"),prat("Kr"),array("H"),prat("Kr"),0);
 echo "<p class = sa >By kharavasAnayorvisarjanIyaH (8.3.15) :</p>";
 display(0);
}
if ( sub(array("r"), array("@"),array(""),0) && preg_match('/[snmMrH]$/',$second))
{
 $text = one(array("r@"),array("H"),0);
 echo "<p class = sa >By kharavasAnayorvisarjanIyaH (8.3.15) :</p>";
 display(0);
}



/* ro ri (8.3.14) */
if (sub(array("rr"),blank(0),blank(0),0))
{
    $text = one(array('rr'),array('#r'),0); 
    $ro = 1;
    echo "<p class = sa >By ro ri (8.3.14) :</p>";
    display(0);
} else { $ro = 0; }

/* Dhralope pUrvasya dIrgho'NaH (6.3.111) */
$ana = array("a","A","i","I","u","U","f","F","x","X");
$anna = array("A","A","I","I","U","U","F","F","X","X");
if ($ro ===1 && sub($ana,array('#r'),blank(0),0))
{
$text = two($ana,array('#r'),$anna,array('r'),0);
echo "<p class = sa >By Dhralope pUrvasya dIrgho'NaH (6.3.111) :</p>";
display(0);
}

/* lopaH zAkalyasya (8.3.19) */ 
$aa = array("a","A");$yv = array("y+","v"); $space=array(" "," ");
if (sub($aa,$yv,blank(0),0) && (preg_match('/['.pc('ec').']$/',$first) || $bho === 1))
{
echo "<p class = sa >By lopaH zAkalyasya (8.3.19) :</p>";
$text = three($aa,$yv,$ac,$aa,$space,$ac,1); 
$text = one(array("+"),array(""),0); 
display(0);
}

/* oto gArgyasya (8.3.20) */
if (sub(array("oy"),blank(0),blank(0),1) && $bho ===1)
{
    $text = one(array("oy"),array("o "),1);
    echo "<p class = sa >By oto gArgyasya (8.3.20) :</p>
        <p class = hn >N.B. This rule applies only to the padAnta alaghuprayatna yakAra following 'o' only.</p>";
    display(0);
}

/* uJi ca pade (8.3.21) */
if ((sub(array("ay","av"),array("u "),blank(0),0)|| sub(array("ay","av"),blank(0),blank(0),0) && $second === "u") && $bho ===1)
{
    $text = two(array("ay","av"),array("u"),array("a","a"),array("u"),0);
    echo "<p class = sa >By uJi ca pade (8.3.21) :</p>";
    display(0);
}

/* hali sarveSAm (8.3.22) */
if ($bho === 1 && sub(array("y"),$hl,blank(0),0))
{
    $text = three(array("Bo","Bago","aGo","A"),array("y"),$hl,array("Bo","Bago","aGo","A"),array(" "),$hl,0);
    echo "<p class = sa >By hali sarveSAm (8.3.22) :</p>";
    display(0);
}


/* mo'nusvAraH (8.3.23) */ 
if (preg_match('/[m]$/',$first) && preg_match('/^['.pc('hl').']/',$second) && sub(array("m"),$hl,blank(0),0))
{
$text = two(array('m'),prat('hl'),array('M'),prat('hl'),1);
echo "<p class = sa >By mo'nusvAraH (8.3.23) :</p>
    <p class = hn >N.B.: The conversion to anusvAra occurs only if the m is at the end of a pada. Otherwise this conversion doesn't apply. Ignore all consequentiality in that case.</p>";
display(0);
}

/* nazcApadAntasya jhali (8.3.24) */
if (preg_match('/[mn]$/',$first)!== true && sub(array("m","n"),prat('Jl'),blank(0),0))
{
$text = two(array('m','n'),prat('Jl'),array('M','M'),prat('Jl'),1);
echo "<p class = sa >By nazcApadAntasya jhali (8.3.24) :</p>
    <p class = hn >N.B.: If the 'n'/'m' is in padAnta, it should not be converted to anusvARa.</p>
    <p class = hn >If it is inside a pada, it should be converted to anusvAra. So ignore the case which doesn't apply here.</p>";
display(0);
}

/* mo rAji samaH kvau (8.3.25) */
if (sub(array("saMrA"),blank(0),blank(0),0))
{
    $text = one(array("saMrA"),array("samrA"),0);
    echo "<p class = sa >By mo rAji samaH kvau (8.3.25) :</p>";
    display(0);
}

/* he mapare vA (8.3.26) and yavalapare yavalA veti vaktavyam (vA 4902) */
if (sub(array("Mhm","Mhy","Mhv","Mhl"),blank(0),blank(0),0))
{
$text = one(array("Mhm","Mhy","Mhv","Mhl"),array("mhm","!yhy","!vhv","!lhl"),1);
echo "<p class = sa >By he mapare vA (8.3.26) and yavalapare yavalA veti vaktavyam (vA 4902) :</p>";
display(0);
}

/* napare naH (8.3.27) */
if (sub(array("Mhn"),blank(0),blank(0),0))
{
$text = one(array("Mhn",),array("nhn",),1);
echo "<p class = sa >By napare naH (8.3.27) :</p>";
display(0);
}

/* GNoH kukTukzari (8.3.28) */
if (sub(array("N","R"),prat('Sr'),blank(0),0))
{
$text = two(array("N","R"),prat('Sr'),array("Nk","Rw"),prat('Sr'),1);
echo "<p class = sa >By GNoH kukTukzari (8.3.28) :</p>";
display(0);
/* cayo dvitIyAH zari pauSkarasAderiti vAcyam (vA 5023) */
$text = two(array("Nk","Rw"),prat('Sr'),array("NK","RW"),prat('Sr'),1);
echo "<p class = sa >By cayo dvitIyAH zari pauSkarasAderiti vAcyam (vA 5023) :</p>";
display(0);
}

/* DaH si dhuT (8.3.29) */
if (sub(array("q"),array("s"),blank(0),0))
{
$text = two(array("q"),array("s"),array("qD"),array("s"),1);
echo "<p class = sa >By DaH si dhuT (8.3.29) :</p>";
display(0); $dhut = 1;
} else {$dhut = 0; }

/* nazca (8.3.30) */
if (sub(array("ns"),blank(0),blank(0),0))
{
$text = two(array("n"),array("s"),array("nD"),array("s"),1);
echo "<p class = sa >By nazca (8.3.30) :</p>";
display(0); $dhut = 1;
} else { $dhut = 0; }

/* zi tuk (8.3.31) */
if (sub(array("nS"),blank(0),blank(0),0))
{
$text = one(array("nS"),array("ntS"),1);    
echo "<p class = sa >By zi tuk (8.3.31) :</p>";
display(0);
}

/* Gamo hrasvAdaci GamuNnityam (8.3.32) */
if (preg_match('/['.flat($hrasva).'][NRn]$/',$first) && preg_match('/^['.flat($ac).']/',$second) )
{
$text = three($hrasva,array("N","R","n"),$ac,$hrasva,array("NN","RR","nn"),$ac,0);
echo "<p class = sa >By Gamo hrasvAdaci GamuNnityam (8.3.32) :</p>
    <p class = hn >N.B.: This rule applies only in cases wehre there is G,N or n at the end of a pada. Not in other cases. Ignore such cases.</p>";
display(0);
}




/* sampuGkAnAM so vaktavyaH (vA 4892) */
if (sub(array("saMH","sa!H","puMH","pu!H","kAMH","kA!H"),blank(0),blank(0),0))
{
$text = one(array("saMH","sa!H","puMH","pu!H","kAMH","kA!H"),array("saMs","sa!s","puMs","pu!s","kAMs","kA!s"),0);
echo "<p class = sa >By sampuGkAnAM so vaktavyaH (vA 4892) ";
display(0);
}
/* samo vA lopameke (bhASya) */
if (sub(array("saMss","sa!ss"),$hl,blank(0),0))
{
$text = one(array("saMss","sa!ss"),array("saMs","sa!s"),1);
echo "<p class = sa >By samo vA lopameke (bhASya) :</p>";
display(0);
}


/* dvistrizcaturiti kRtvo'rthe (8.3.43) */
if (sub(array("dviH","triH","catuH"),$ku,blank(0),0))
{
    $text = two (array("dviH","triH","catuH"),$ku,array("dviz","triz","catuz"),$ku,1);
    echo "<p class = sa >By dvistrizcaturiti kRtvo'rthe (8.3.43) :</p>
        <p class = hn >N.B. This applies only in case of kRtvo'rthe.</p>";
    display(0); $dvi1 = 1;
} else { $dvi1 = 0; }
if (sub(array("dviH","triH","catuH"),$pu,blank(0),0))
{
 $text = two (array("dviH","triH","catuH"),$pu,array("dviz","triz","catuz"),$pu,1);
 echo "<p class = sa >By dvistrizcaturiti kRtvo'rthe (8.3.43) :</p>
        <p class = hn >N.B. This applies only in case of kRtvo'rthe.</p>";
    display(0); $dvi2 = 1;
} else { $dvi2 = 0; }

/* muhusaH pratiSedhaH (vA 4911) */
if (sub(array("muhu"),array("H"),blank(0),0))
{
    $text = three(array("muhu"),array("H"),$pu,array("muhu"),array("H"),$pu,0);
    $text = three(array("muhu"),array("H"),$ku,array("muhu"),array("H"),$ku,0);
    echo "<p class = sa >By muhusaH pratiSedhaH (vA 4911) :</p>";
    display(0); $muhu1 = 1;
} else { $muhu1 = 0; }

/* isusoH sAmarthye (8.3.44) and nityaM samAse'nuttarapadasthasya (8.3.45) */ 
if (sub(array("iH","uH",),$ku,blank(0),0) && $dvi1===0 && $dvi2===0 && $muhu1 ===0)
{
    $text = two (array("iH","uH"),$ku,array("iz","uz"),$ku,1);
    echo "<p class = sa >By isusoH sAmarthye (8.3.44) and nityaM samAse'nuttarapadasthasya (8.3.45) :</p>
        <p class = hn >N.B. This applies only in case of sAmarthya. If 'is' or 'us' pratyayas are at the end of first component of a compound, they are mandatorily converted to 'S'.</p>";
    display(0); $isu1 = 1;
} else { $isu1 = 0; }
if (sub(array("iH","uH"),$pu,blank(0),0))
{
 $text = two (array("iH","uH"),$pu,array("iz","uz"),$pu,1);
 echo "<p class = sa >By isusoH sAmarthye (8.3.44) and nityaM samAse'nuttarapadasthasya (8.3.45) :</p>
        <p class = hn >N.B. This applies only in case of sAmarthya. If 'is' or 'us' pratyayas are at the end of first component of a compound, they are mandatorily converted to 'S'.</p>";
    display(0); $isu2 = 1;
} else { $isu2= 0; }
/* idudupadhasya cApratyayasya (8.3.41) */
$id = array("i","u",);
if (sub($iN,array("H"),$ku,0) && $dvi1===0 && $dvi2===0 && $isu1 ===0 && $isu2 ===0&& $muhu1 ===0)
{
    $text = three($id,array("H"),$ku,$id,array("z"),$ku,1);
    echo "<p class = sa >By idudupadhasya cApratyayasya (8.3.41) :</p>
        <p class = hn >N.B. : the visarga will be converted to 'S' only if it is not followed by pratyaya.</p>";
    display(0);
}
if (sub($iN,array("H"),$pu,0))
{
    $text = three($id,array("H"),$pu,$id,array("z"),$pu,1);
    echo "<p class = sa >By idudupadhasya cApratyayasya (8.3.41) :</p>
        <p class = hn >N.B. : the visarga will be converted to 'S' only if it is not followed by pratyaya.</p>";
    display(0);
}

/* ekAdezazAstranimittikasya na Satvam | kaskAdiSu bhrAtuSputrazabdasya pAThAt (vA 4915) */ 
// Pending to code.


/* iNaH SaH (8.3.39) */

if (sub($iN,array("HpAS","Hkalp","HkAmy","Hka","HkAMy"),blank(0),0) && $dvi1===0 && $dvi2===0 && $isu1 ===0 && $isu2 ===0 && $muhu1 ===0) 
{
    $text = one(array("HpAS","Hkalp","HkAmy","Hka","HkAmy"),array("zpAS","zkalp","zkAmy","zka","zkAmy"),0);
    echo "<p class = sa >By iNaH SaH (8.3.39) :</p>";
    display(0); $inah = 1;
} else { $inah = 0; }

/* namaspurasorgatyoH (8.3.40) */
$namas = array("namaH","puraH"); 
if (sub($namas,$ku,blank(0),0))
{
    $text = two($namas,$ku,array("namas","puras"),$ku,1);
    echo "<p class = sa >By namaspurasorgatyoH (8.3.40) :</p>
          <p class = hn >N.B. : The conversion to namas / puras is done only in case it has gati saJjJA.</p>";
    display(0); $nama1 = 1;
} else { $nama1 = 0; }
if (sub($namas,$pu,blank(0),0) && $nama1 !==1)
{
    $text = two($namas,$pu,array("namas","puras"),$pu,1);
    echo "<p class = sa >By namaspurasorgatyoH (8.3.40) :</p>
        <p class = hn >N.B. : The conversion to namas / puras is done only in case it has gati saJjJA.</p>";
    display(0); $nama2 = 1;
} else { $nama2 = 0; }

/* tiraso'nyatarsyAm (8.3.42) */
if (sub(array("tiraH"),$ku,blank(0),0))
{
    $text = two (array('tiraH'),$ku,array('tiras'),$ku,1);
    echo "<p class = sa >By tiraso'nyatarasyAm  (8.3.42) :</p>";
    display(0); $tir1 = 1;
} else { $tir1 = 0; }
if (sub(array("tiraH"),$pu,blank(0),0))
{
 $text = two (array('tiraH'),$pu,array('tiras'),$pu,1);
 echo "<p class = sa >By tiraso'nyatarasyAm  (8.3.42) :</p>";
    display(0); $tir2 = 1;
} else { $tir2 = 0; }

/* ataH kRkamikaMsakumbhapAtrakuzAkarNISvanavyayasya (8.3.46) */
if (sub(array("aH"),array("kAr","kAm","kAMs","kumBa","pAtra","kuSA","karRI"),blank(0),0) && $nama1 !== 1 && $nama2 !== 1   && $tir1===0 && $tir2===0 )
{
    $text = two(array("aH"),array("kAr","kAm","kAMs","kumBa","pAtra","kuSA","karRI"),array('as'),array("kAr","kAm","kAMs","kumBa","pAtra","kuSA","karRI"),1);
    echo "<p class = sa >By ataH kRkamikaMsakumbhapAtrakuzAkarNISvanavyayasya (8.3.46) :</p>
       <p class = hn > This applies olny when there is compound and the word with 'as' is neither uttarapadastha nor avyaya.</p>";
    display(0); $atah = 1;
} else { $atah = 0; }

/* adhazzirasI pade */
if (sub(array("aDaH","SiraH"),array("pada"),blank(0),0)  )
{
    $text = two(array("aDaH","SiraH"),array("pada"),array("aDas","Siras"),array("pada"),1);
    echo "<p class = sa >By aDazzirasI pade (8.3.47) :</p>
       <p class = hn > This applies olny when there is compound and the word 'adhas' or 'ziras' is not uttarapadastha.</p>";
    display(0); $atah = 1;
} else { $atah = 0; }


/* so'padAdau (8.3.38), pAzakalpakakAmyeSviti vAcyam (vA 5033), anavyayasyeti vAcyam (vA 4902) and kAmye roreveti vAcyam (vA 4902) */ 
// anavyayasyeti vAcyam (vA 4901) is pending to code.
if (sub(array("pAS","kalp","kAmy","ka"),blank(0),blank(0),0) && $inah !== 1 && $nama1 !== 1 && $nama2 !== 1 && $dvi1===0 && $dvi2===0 && $isu1 ===0 && $isu2 ===0 && $tir1===0 && $tir2===0 && $muhu1 ===0 && $atah ===0)
{
    $text = two(array("H"),array("kalp","kAmy","ka","kAMy"),array('s'),array("kalp","kAmy","ka","kAMy"),0);
    $text = two(array("H"),array("pAS"),array('s'),array("pAS"),0);
    if (preg_match('/[sr]$/',$first))
    {
        $text = one(array('skAmy','skAMy'),array('HkAmy','HkAMy'),1);      
    }
    echo "<p class = sa >By so'padAdau (8.3.38), pAzakalpakakAmyeSviti vAcyam (vA 5033), anavyayasyeti vAcyam (vA 4902) and kAmye roreveti vAcyam (vA 4902) :</p>";
    display(0);
}

/* kaskAdiSu ca (8.3.48) */
if(sub(array("kaHka","kOtaHkuta","sarpiHkuRqikA","DanuHkapAla"),blank(0),blank(0),0))
{
$text = one (array("kaHka","kOtaHkuta","sarpiHkuRqikA","DanuHkapAla"),array("kaska","kOtaskuta","sarpizkuRqikA","DanuzkapAla"),0);
echo "<p class = sa >By kaskAdiSu ca (8.3.48) ";
    display(0); $kaska = 1;
} else { $kaska = 0; }



/* kupvoH &k&pau ca (8.3.37) */ // <p class = hn >Note that we have used & as jihvAmUlIya and * as upadhmAnIya.

if(sub(array("H"),$ku,blank(0),0) && $kaska !== 1)
{
$text = two(array("H"),$ku,array("&"),$ku,1); $zarpare = 1;
echo "<p class = sa >By kupvoH &k&pau ca (8.3.37). :</p>";
display(0);
} else { $zarpare = 0; }
if(sub(array("H"),$pu,blank(0),0) && $kaska !== 1)
{
$text = two(array("H"),$pu,array("&"),$pu,1); $zarpare = 1;
echo "<p class = sa >By kupvoH &k&pau ca (8.3.37). :</p>";
display(0);
} else { if ($zarpare === 1) {$zarpare = 1; } else {$zarpare = 0;}}


/* visarjanIyasya saH (8.3.34) */ 
// Ky is used because for Sr we have an option. 
if(sub(array("H"),prat('Ky'),blank(0),0) && $zarpare !==1)
{
$text = two(array("H"),prat('Ky'),array("s"),prat('Ky'),0);
$zarpare = 2;
echo "<p class = sa >By visarjanIyasya saH (8.3.34) :</p>";
display(0);
} else { if ($zarpare === 1) {$zarpare = 1; } else {$zarpare = 0;}}
/* zarpare visarjanIyaH (8.3.35) */
if (sub(array("s"),prat('Kr'),prat('Sr'),0) && $zarpare === 2)
{
$text = three(array("s"),prat('Kr'),prat('Sr'),array('H'),prat('Kr'),prat('Sr'),0);
$text = three(array("&"),prat('Kr'),prat('Sr'),array('H'),prat('Kr'),prat('Sr'),0);
echo "<p class = sa >By zarpare visarjanIyaH (8.3.35) :</p>";
display(0);
}
/* vA zari (8.3.36) */
if(sub(array("H"),prat('Sr'),blank(0),0))
{
$text = one(array("HS","Hz","Hs"),array("SS","zz","ss"),1);
echo "<p class = sa >By vA zari (8.3.36) :</p>";
display(0);
}   
/* kharpare zari vA visargalopo vaktavyaH (vA 4906) */
if(sub(array("H"),prat('Sr'),prat('Kr'),0))
{
$text = three(array("H"),prat('Sr'),prat('Kr'),array(" "),prat('Sr'),prat('Kr'),1);
echo "<p class = sa >By kharpare zari vA visargalopo vaktavyaH (vA 4906) :</p>";
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
$text = two(array("S"),array("s"),array("S"),array("S"),0); 

    echo "<p class = sa >By stoH zcunA zcuH (8.4.40) and zAt (8.4.44) :</p>";
display(0);
}

/* anAmnavatinagarINAmiti vAcyam (vA 5016) */
$shtu = array("z","w","W","q","Q","R",);
if (sub($shtu,array("nAm","navati","nagar"),blank(0),0))
{
$text = two($shtu,array("nAm","navati","nagar"),blank(count($shtu)),array("RRAm","RRavati","RRagar"),0);
echo "<p class = sa >By anAmnavatinagarINAmiti vAcyam (vA 5016) :</p>";
display(0);
}

/* stoH STunA STuH (8.4.41) and na padAntATToranAm (8.4.41) and toH Si (8.4.43) */
$Tu = array("w","W","q","Q","R",);
if((sub($shtu,$stu,blank(0),0)|| sub($stu,$shtu,blank(0),0)) && !preg_match('/[wWqQR]$/',$first))
{
$text = two(array("z"),$stu,array("z"),$shtu,0);
$text = two(array("s"),$shtu,array("z"),$shtu,0);
$text = two(array("t"),$Tu,array("w"),$Tu,0);
$text = two(array("T"),$Tu,array("W"),$Tu,0);
$text = two(array("d"),$Tu,array("q"),$Tu,0);
$text = two(array("D"),$Tu,array("Q"),$Tu,0);
$text = two(array("n"),$Tu,array("R"),$Tu,0);
    echo "<p class = sa >By stoH STunA STuH (8.4.41) and na padAntATToraNam (8.4.42) and toH Si (8.4.43) :</p>";
display(0);
}

/* yaro'nunAsike'nunAsiko vA (8.4.45) */ // this is applicable to only sparzas.
$yara = array("J","B","G","Q","D","j","b","g","q","d","K","P","C","W","T","c","w","t","k","p");
$anunasikarep = array("Y","m","N","R","n","Y","m","N","R","n","N","m","Y","R","n","Y","R","n","N","m");
$anunasika = array("N","Y","R","n","m");

if (preg_match('/['.flat($yara).']$/',$first) && preg_match('/['.flat($anunasika).']/',$second))
{
$text = two($yara,$anunasika,$anunasikarep,$anunasika,1);
echo "<p class = sa >By yaro'nunAsike'nunAsiko vA (8.4.45) :</p>
    <p class = hn >N.B.: If the second member is a pratyaya, it is mandatory to change it to anunAsika.</p>";
display(0);
}


/*anaci ca (8.4.47)*/ // Here the sudhI + upAsya - what about the Asy - Assy is possbile ? Code gives it. But there are 4 options. Code gives two only.
// The cause for using $hrasva instead of $ac is that the dIrgha vowels are debarred by dIrghAdAcAyANAm.
// Here instead of using pratyAhAra hl, we shall do manual enumeration of all the members. Bexause of "anusvAravisargajihvAmUlIyopadhmAnIyayamAnAmakAropari zarSu ca pAThasyopasaGkhyAtatvenAnusvArasyApyactvAt (in derivation of samskAra) 
$hrasvaplus = array("M","!","'");
$hala1 = array("y","v","l","Y","m","N","R","n","J","B","G","Q","D","j","b","g","q","d","K","P","C","W","T","c","w","t","k","p","S","z","s","M",);
$hala2 = array("h","y","v","r","l","Y","m","N","R","n","J","B","G","Q","D","j","b","g","q","d","K","P","C","W","T","c","w","t","k","p","S","z","s","M",);

if(sub($hrasva,$hala1,$hala2,0))
{
    $text = dvitva($hrasva,$hala1,$hala2,array(""),2,1);
echo "<p class = sa >By anaci ca (8.4.47):</p>"; 
display(1);
}
if(sub($hrasvaplus,$hala1,$hala2,0))
{
    $text = dvitva($hrasvaplus,$hala1,$hala2,array(""),2,1);
    echo "<p class = sa >By anaci ca (8.4.47):</p>"; 
    display(1);
}
if(checkarray($dirgha,$hl,array('r','l'),blank(0))!==0 && $sthanivadbhav===1) 
{
$text = dvitva($dirgha,$hala1,$hala2,array(""),2,1);
echo "<p class = sa >By anaci ca (8.4.47):</p>";
display(1);
}
/* By anaci ca (according to mahAbhASya example of vAkk) */ 
if (preg_match('/['.flat($ac).']['.flat($hl).']$/',$second) || (preg_match('/['.flat($ac).']['.flat($hl).']$/',$first) && $input === $first ))
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
    echo "<p class = sa >By anaci ca :</p>";
    display(1);
}

/* nAdinyAkroze putrasya (8.4.48) */
if (sub(array('putrAdinI'),blank(0),blank(0),0))
{
    echo "<p class = sa >By nAdinyAkroze putrasya (8.4.48) - If Akroza is meant : The dvitva doesn't happen. </p> Otherwise dvitva will happen.</p><hr>";
}
/* vA hatajagdhayoH (vA 5022) */
if (sub(array("putrahatI"),blank(0),blank(0),0))
{
echo "<p class = sa >By vA hatajagdhayoH (vA 5022) :</p>";
display(0);
}
if (sub(array('putrajagDI'),blank(0),blank(0),0))
{
echo "<p class = sa >By vA hatajagdhayoH (vA 5022) :</p>";
display(0);
}

/* zaraH khayaH (vA 5019) */
$shara = array("S","z","s",);
if (sub($shara,prat('Ky'),blank(0),0))
{
$text = dvitva($shara,prat('Ky'),array(""),array(""),2,1);
echo "<p class = sa >zaraH khayaH (vA 5019) :</p>";
display(1);
}
/* aco rahAbhyAM dve (8.4.46) */ 
$rh = array("r","h");
if (sub($ac,$rh,prat('yr'),0))
{
$text = dvitva($ac,$rh,prat('yr'),array(""),3,1);
echo "<p class = sa >By aco rahAbhyAM dve (8.4.46) :</p>";
display(1);
}
/* triprabhRtiSu zAkaTAyanasya (8.4.50)*/
$hrasva1 = "'".implode("",$hrasva)."'";
if (checkarray($ac,$hl,$hl,$hl) === 1)
{
echo "<p class = hn >N.B.: By triprabhRtiSu zAkaTAyanasya (8.4.50), the dvitva is optionally not done in cases where there are more than three hals appearing consecutively. e.g. indra - inndra.  </p>";
}

/* sarvatra zAkalyasya (8.4.51) */
// It is not coded separately. It is sent as a message in all display function when 1 is selected as option. 

/* dIrghAdAcAryANAm (8-4-52) */
// Not coded separately, because we did dvitva only for $hrasva, and not for 'ac'. So this is already taken care of.

/* jhalAM jaz jhaSi (8.4.53) */
if(sub(prat('Jl'),prat('JS'),blank(0),0))
{
$text = two(prat('Jl'),prat('JS'),savarna(prat('Jl'),prat('jS')),prat('JS'),0);
echo "<p class = sa >By jhalAM jaz jhaSi (8.4.53):</p>";
display(0);
}
/* yaNo mayo dve vAcye (vA 5018) yaN in paJcamI and may in SaSThI)*/
if (sub($hrasva,prat('yR'),prat('my'),0))
{
$text = dvitva(prat('yR'),prat('my'),array(""),array(""),2,1);
echo "<p class = sa >By yaNo mayo dve vAcye (yaN in paJcamI and may in SaSThI) (vA 5018) :</p>";
display(1); 
}
if (sub($dirgha,prat('yR'),prat('my'),0) && $sthanivadbhav ===1)
{
$text = dvitva(prat('yR'),prat('my'),array(""),array(""),2,1);
echo "<p class = sa >By yaNo mayo dve vAcye (yaN in paJcamI and may in SaSThI) (vA 5018) :</p>";
display(1); 
}

/* yaNo mayo dve vAcye (vA 5018) may in paJcamI and yaN in SaSThI)*/
if (sub($hrasva,prat('my'),prat('yR'),0))
{
$text = dvitva(prat('my'),prat('yR'),array(""),array(""),2,1);
echo "<p class = sa >By yaNo mayo dve vAcye (may in paJcamI and yaN in SaSThI) (vA 5018):</p>";
display(1);
}
if (sub($dirgha,prat('my'),prat('yR'),0) && $sthanivadbhav ===1)
{
$text = dvitva(prat('my'),prat('yR'),array(""),array(""),2,1);
echo "<p class = sa >By yaNo mayo dve vAcye (may in paJcamI and yaN in SaSThI) (vA 5018):</p>";
display(1);
}


/* vA'vasAne (8.4.54) */

foreach($text as $value)
{
    $part1 = substr($value,0,count(str_split($value))-1); 
    if (in_array(str_split($value)[count(str_split($value))-1],prat('Jl')))
    {
    $part2 = sl(str_split($value)[count(str_split($value))-1],prat('cr'));
    if (in_array(str_split($value)[count(str_split($value))-1],$hl))
    {
    $value1[] = str_replace($value,$part1.$part2,$value);
    }
    else
    {
        $value1[] = $value;
    }
    }
}
if ($value1!==$text)
{
$text = array_merge($text,$value1);
$value1= array();
echo "<p class = sa >By vA'vasAne (8.4.54) :</p>";
    display(0);
}

/* khari ca (8.4.55) */ 
$Jl1 = array("J","B","G","Q","D","j","b","g","q","d","K","P","C","W","T","c","w","t","k","p","S","z","s","h");
$Jl2 = array("J","B","G","Q","D","j","b","g","q","d","K","P","C","W","T","h");
while(sub($Jl2,prat('Kr'),blank(0),0) !== false)
{
if (sub($Jl1,prat('Kr'),blank(0),0) || $dhut === 1)
{
$text = two($Jl1,prat('Kr'),savarna(prat('Jl'),prat('cr')),prat('Kr'),0);
echo "<p class = sa >By khari ca (8.4.55) :</p>";
display(0);
}
}
/* aNo'pragRhyasyAnunAsikaH (8.4.57) */
if (preg_match('/[aAiIuUfFxX]$/',$second))
{
    foreach($text as $value)
    {
    $value1[] = $value."!";
    }
    $value1 = array_merge($text,$value1);
    $value1 = array_unique($value1);
    $text = array_values($value1);
    echo "<p class = sa >By aNo'pragRhyasyAnunAsikaH (8.4.57) :</p>";
    display(0);
}


/* anusvArasya yayi parasavarNaH (8.4.58) and vA padAntasya (8.4.59) */
$pa = array("!yy","!vv","!rr","!ll","YY","mm","NN","RR","nn","YJ","mB","NG","RQ","nD","Yj","mb","Ng","Rq","nd","NK","mP","YC","RW","nT","Yc","Rw","nt","Nk","mp");
$mm = array("My","Mv","Mr","Ml","MY","Mm","MN","MR","Mn","MJ","MB","MG","MQ","MD","Mj","Mb","Mg","Mq","Md","MK","MP","MC","MW","MT","Mc","Mw","Mt","Mk","Mp");
if (sub(array("M"),prat('yr'),blank(0),0))
{
$text = one($mm,$pa,1);
echo "<p class = sa >By anusvArasya yayi parasavarNaH (8.4.58) and vA padAntasya (8.4.59) :</p>
    <p class = hn >N.B.: The change of anusvARa to parasavarNa is mandatory for non padAnta conjoints. For padAnta conjoints, it is optional.</p>";
display(0);
}

/* torli (8.4.60) */
$to = array("tl","Tl","dl","Dl","nl");
//$li = array("l","l","l","l","l",);
$lirep = array("ll","ll","ll","ll","!ll",);
while(sub($to,blank(0),blank(0),0) !== false)
{
if (sub($to,blank(0),blank(0),0))
{
$text = one($to,$lirep,0);
echo "<p class = sa >By torli (8.4.60) :</p>";
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
display(0);
}

/* zazCho'Ti (8.4.63) and ChatvamamIti vAcyam (vA 5025) */
$Jy = array("JS","BS","GS","QS","DS","jS","bS","gS","qS","dS","KS","PS","CS","WS","TS","cS","wS","tS","kS","pS",);
$h1 = array("JC","BC","GC","QC","DC","jC","bC","gC","qC","dC","KC","PC","CC","WC","TC","cC","wC","tC","kC","pC",);
$aT = array("a","A","i","I","u","U","f","F","x","X","e","o","E","O","h","y","v","r","l","Y","m","G","R","n");
if(sub($Jy,$aT,blank(0),0))
{
$text = two($Jy,$aT,$h1,$aT,1);
echo "<p class = sa >By zazCho'Ti (8.4.63) and ChatvamamIti vAcyam (vA 5025) :</p>";
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
display(0);
}

echo "<p class = sa >Final forms are :</p>";
display(0);
?>
</body>
</html>