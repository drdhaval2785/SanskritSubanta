<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-
transitional.dtd">
<html>
<body>

<?php

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
//$first = "rAma";
//$second = "iti";

// displaying the data back to the user
echo "You entered: ".$first." + ".$second."</br>";
    echo "<hr>";


/* main coding part starts from here.
 * Based on Siddhantakaumudi text.
 */
$text = array();
//echo json_encode($first)."</br>".json_encode($second);
$input1 = convert1($first); //echo $input1."</br>";
$input2 = convert1($second);// echo $input2."</br>";
//$input = $first.$second;
$input = ltrim(chop($input1.$input2));
// joining the two words
$text[] = $input; 
//print_r($text);
/* pragRhya section */

/* plutapragRhyA aci nityam (6.1.125) */
// There is no definition of pluta / pragRhya here. So we will code that as and when case arises.

/* iko'savarNe zAkalyasya hrasvazca (6.1.127) */ // Right now coded for only dIrgha. Clarify wheter the hrasva preceding also included?
$ik = array("i","I","u","U","f","F","x","X");
if (sub($ik,$ac,blank(0),0))
{
$text = two(array("i","I"),array("a","A","u","U","f","F","x","X","e","o","E","O"),array("i ","i "),array("a","A","u","U","f","F","x","X","e","o","E","O"),1);
$text = two(array("u","U"),array("a","A","i","I","f","F","x","X","e","o","E","O"),array("u ","u "),array("a","A","i","I","f","F","x","X","e","o","E","O"),1);
$text = two(array("f","F"),array("a","A","u","U","i","I","e","o","E","O"),array("f ","f "),array("a","A","u","U","i","I","e","o","E","O"),1);
$text = two(array("x","X"),array("a","A","u","U","i","I","e","o","E","O"),array("x ","x "),array("a","A","u","U","i","I","e","o","E","O"),1);
echo "By iko'savarNe zAkalyasya hrasvazca (6.1.127) :</br>
    Note that this will not apply in samAsa. Also when followed by a 'sit' pratyaya, it will not apply. e.g. pArzva";
display(0);
}


/* RtyakaH (6.1.128) */
$ak = array("a","A","i","I","u","U","f","F","x","X"); 
if (preg_match('/['.flat($ak).']$/',$first) && preg_match('/^[f]/',$second))
{
if (checkarray($ak,array("f"),blank(0),blank(0))===1)
{
$text = two ($ak,array("f"),$ak,array(" f"),1);
echo "By RtyakaH (6.1.128) :</br>
    Note: This applies only to padAnta. ";
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
if (sub(array("amI"),blank(0),blank(0),0))
{
$text = two (array("amI"),$ac,array("amI "),$ac,1);
echo "By adaso mAt (1.1.12) :";
display(0);
}
if (sub(array("amU"),blank(0),blank(0),0))
{
$text = two (array("amU"),$ac,array("amU "),$ac,1);
echo "By adaso mAt (1.1.12) :";
display(0);
}

/* ze (1.1.13) */
// Not possible to know whether one form has ze or not.

/* nipAta ekAjanAG (1.1.14) */
if ($first === "a")
{
$text = two (array("a"),$ac,array("a "),$ac,1);
echo "By nipAta ekAjanAG (1.1.14) :";
display(0);
}
if ($first === "i")
{
$text = two (array("i"),$ac,array("i "),$ac,1);
echo "By nipAta ekAjanAG (1.1.14) :";
display(0);
}
if ($first === "u")
{
$text = two (array("u"),$ac,array("u "),$ac,1);
echo "By nipAta ekAjanAG (1.1.14) :";
display(0);
}
if ($first === "A")
{
$text = two (array("A"),$ac,array("A "),$ac,1);
echo "By nipAta ekAjanAG (1.1.14) :</br>
    Note: If the 'A'kAra is of 'Git; origin, it is not pragRhya. If 'aGit' it is pragRhya";
display(0);
}

/* ot (1.1.15) */
if ($first === "o")
{
$text = two (array("o"),$ac,array("o "),$ac,1);
echo "By ot (1.1.15) :";
display(0);
}
if ($first === "aho")
{
$text = two (array("aho"),$ac,array("aho "),$ac,1);
echo "By ot (1.1.15) :";
display(0);
}

/* sambuddhau zAkalyasyetAvanArSe (1.1.16) */
if (preg_match('/[o]$/',$first) && $second === "iti")
{
$text = two(array($first),$ac,array($first." "),$ac,1);
echo "By sambuddhau zAkalyasyetAvanArSe (1.1.16) :</br>
    Note: This rule will apply only in case the 'o'kAra at the end of the first word is for sambuddhi and the 'iti' is anArSa (of non-vedic origin).";
display(0);
}

/* UYaH (1.1.17) */
if ($first === "u" && $second === "iti")
{
$text = two(array("u"),array("iti"),array("u "),array("iti"),1);
echo "By uYaH (1.1.17) :</br>";
display(0);
}

/* U! (1.1.1) */ // Here ! has been used for anunAsika.
if ($first === "u" && $second === "iti")
{
$text = two(array("u"),array("iti"),array("U! "),array("iti"),1);
echo "By U! (1.1.17) :</br>
    Please note that we have used ! as marker of anunAsikatva of a vowel";
display(0);
}


/* IdUtau ca saptamyarthe (1.1.19) */
$idut = array("I","U"); $idut1 = array("I ","U ");
if (preg_match('/[IU]$/',$first) && sub(array("I","U"),$ac,blank(0),0))
{
$text = two($idut,$ac,$idut1,$ac,1);
echo "By IdUtau ca saptamyarthe (1.1.19) :</br>
    Please note: This will apply only in case the I/U at the end of the first word have been used in sense of saptamI vibhakti. Otherwise this pragRhyatva will not be there.";
display(0);
}

/* akaH savarNe dIrghaH (6.1.101) */ // Check RlRyoH mithaH sAvarNyam vAcyam.. Not coded for it. Not that clear.
$ak1 = array("a","a","A","A","i","i","I","I","f","F","x","X");
$ak2 = array("a","A","a","A","i","I","i","I","F","F","X","X");
if (sub($ak1,$ak2,blank(12),1))
{
$text = two(array("a","A"),array("a","A"),blank(2),array("A","A"),0);
$text = two(array("i","I"),array("i","I"),blank(2),array("I","I"),0);
$text = two(array("u","U"),array("u","U"),blank(2),array("U","U"),0);
$text = two(array("f","F"),array("F"),blank(2),array("F"),0);
$text = two(array("x","X"),array("X"),blank(2),array("X"),0);
echo "By akaH savarNe dIrghaH (6.1.101) :";
display(0);
}
/* Rti savarNe R vA (vA 3640) and lRti savarNe lR vA (vA 3641) */
$ruti1 = array("f","F","x","X");
$ruti2 = array("f","f","x","x");
if (sub($ruti1,$ruti2,blank(0),0))
{
$text = two($ruti1,$ruti2,$ruti2,blank(count($ruti1)),1);
echo "By Rti savarNe R vA (vA 3640) and lRti savarNe lR vA (vA 3641) :";
display(0);
}


/*iko yaNaci (6.1.77) */
if(sub(array('i','I','u','U'),prat('ac'),blank(0),0))
{
$text = two(array('i','I','u','U'),prat('ac'),array('y','y','v','v'),prat('ac'),0);
echo "By iko yaNaci (6.1.77) :";
display(0);
}
if(sub(array("f","F","x","X"),prat('ac'),blank(0),0))
{
$text = two(array("f","F","x","X"),prat('ac'),array("r","r","l","l"),prat('ac'),0);
echo "By iko yaNaci (6.1.77) :";
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
echo "By sarvatra vibhASA goH (6.1.122), it is optionally kept as prakRtibhAva :</br>";
display(0);
}
/* avaG sphoTAyanasya (6.1.123) */
if (sub($go,prat('ac'),blank(0),0))
{
$text = two($go,prat('ac'),array('gava'),prat('ac'),1);
echo "By avaG sphoTAyanasya (6.1.123), it is optionally converted to avaG :";
display(0);
}
/* indre ca (6.1.124) */
if (sub($go,array("indra"),blank(0),0))
{
$text = two($go,array("indra"),array('gava'),array("indra"),0);
echo "by indre ca (6.1.124) :";
display(0);
}

/* eco'yavAyAvaH (7.1.78) */
$ayavayavah = array("ay","av","Ay","Av");
if (sub(prat('ec'),prat('ac'),blank(0),0))
{
$text = two(prat('ec'),prat('ac'),$ayavayavah,prat('ac'),0);
echo "By echo'yavAyAvaH (7.1.78) :";
display(0);
$bho = 1;
} else { $bho = 0; }
/* vAnto yi pratyaye (6.1.71), goryutau CandasyupasaMkhyAnam (vA 3543), adhvaparimANe ca (vA 3544) dhAtostannimittasyaiva (6.1.80) */
$o = array("o","O"); $oo = 'oO'; $y = array("y"); $ab = array("av","Av");
$text1 = $text; 
if (sub($o,$y,blank(0),0))
{
$text = two($o,$y,$ab,$y,0);
    echo "vAnto yi pratyaye (6.1.71), goryutau CandasyupasaMkhyAnam (vA 3543), adhvaparimANe ca (vA 3544)  : </br>
        If the 'y' following 'o/O' belongs to a pratyaya or the word 'go' is followed by 'yuti' in Chandas/ as a measure of distance (vA 3543, 3544) : ";
    display(0);
    echo "Please note that if the 'o'kAra or 'au'kAra is of a dhAtu and the pratyaya is starting from 'y', this prakriyA applies only in cases where the 'o'kAra or the 'au'kAra is of dhAtu only.</br>";
    echo "Otherwise :";
    display(2);
}
$text = merge($text,$text1);

/* kSayyajayyau zakyArthe (6.1.81)*/
if (sub(array("kzeya"),blank(0),blank(0),0))
{
    $text = one(array("kzeya"),array("kzayya"),1);
    echo "By kSayyajayyau zakyArthe (6.1.81) :</br>If the word is to be used in the meaning of 'being capable of', then only it will be क्षय्य. : ";
    display(0);    
}
if (sub(array("jeya"),blank(0),blank(0),0))
{
        $text = one(array("jeya"),array("jayya"),1);
    echo "By kSayyajayyau zakyArthe (6.1.81) :</br>If the word is to be used in the meaning of 'being capable of', then only it will be जय्य. : ";
    display(0);
}

/* krayyastadarthe _6.1.82) */
if (sub(array("kreya"),blank(0),blank(0),0))
{
    
    $text = one(array("kreya"),array("krayya"),1);
    echo "By krayyastadarthe _6.1.82) :</br>If the word is to be used in the meaning of 'for sale', then only it will be क्रय्य :";
    display(0);
}
// This is to patch for tripadi function of sasajuSo ruH 

/* etattadoH sulopo&konaJsamAse hali (6.1.132) */
if (sub(array("sa","eza"),array("s"),$hl,0)  && !sub(array("asa","anEza"),array("s"),$hl,0))
{
    $text = three(array("sa","eza"),array("s"),$hl,array("sa","eza"),array(" "),$hl,1);
    echo "By etattadoH sulopo&konaJsamAse hali 6.1.132) :";
    display(0);
}
/* so'ci lope cetpAdapUraNam (6.1.134) */
if (sub(array("sa"),array("s"),$ac,0))
{
    $text = three(array("sa"),array("s"),$ac,array("sa"),array(""),$ac,1);
    echo "so'ci lope cetpAdapUraNam (6.1.134) :</br>
        N.B. : There is difference of opinion here. vAmana thinks that it applies only to RkpAda. Others think that it applies to zlokapAda also e.g. 'saiSa dAzarathI rAmaH'.";
    display(0);
}


/* sasajuSo ruH (8.2.66) */
if (preg_match('/[s]$/',$first))
{
     $text = one(array($first),array(substr($first,0,strlen($first)-1)."r@"),0);
     echo "By sasajuSo ruH (8.2.66) :"; $rutva = 1;
     display(0);
}
else { $rutva = 0; }
if (preg_match('/[s]$/',$second))
{
     $text = one(array($second),array(substr($second,0,strlen($second)-1)."r@"),0);
     echo "By sasajuSo ruH (8.2.66) :"; $rutva = 1;
     display(0);
}
else { $rutva = 0; }


/* ahan(8.2.68) and ro'supi (8.2.69) and rUparAtrirathantareSu vAcyam (vA 4847) */
if (sub(array("ahan"),blank(0),blank(0),0) && ($first === "ahan" || $second === "ahan" ))      
{
    $text = one(array("ahan"),array("ahar@"),0); 
    $text = one(array("ahar@"),array("ahar"),1);
    $text = two(array("ahar"),array("rUpa","rAtr","raTantar"),array("ahar@"),array("rUpa","rAtr","raTantar"),0);
    echo "By ahan (8.2.68) and ro'supi (8.2.69)  and rUparAtrirathantareSu vAcyam (vA 4847).</br>
        N.B. - the rule converting the 'n' to rutva applies only in case of padAntatva. The rephAdeza occurs in case it is not followed by sup pratyayas.";
    display(0);
}

/* */


/* ato roraplutAdaplute (6.1.113) */
if (sub(array("ar@a"),blank(0),blank(0),0) && $rutva === 1)
{
    $text = one(array("ar@a"),array("aua"),0);
    echo "By ato roraplutAdaplute (6.1.113) :";
    display (0);
}

/* nAdici (6.1.104) */
$ic = array("i","I","u","U","f","F","x","X","e","o","E","O");
if (sub(array("a","A"),$ic,blank(0),0) && $rutva === 1)
{
    echo "By nAdici (6.1.104) :</br>
        N.B. : This is exception to prathamayoH pUrvasavarNaH. ";
    display (0); $nadici = 1;
} else { $nadici = 0; }

/* prathamayoH pUrvasavarNaH (6.1.102) */
$ak = array("a","A","i","I","u","U","f","F","x","X"); 
$akreplace = array("A","A","I","I","U","U","F","F","F","X");
if (sub($ak,$ac,blank(0),0) && $rutva === 1 && $nadici !== 1)
{
    $text = two($ak,$ac,$akreplace,blank(count($ac)),1);
    echo "By prathamayoH pUrvasavarNaH (6.1.102) :</br>
        N.B. : This applies to only in prathamA and dvitIyA vibhakti, and not in other cases. ";
    display (0);
}

/* hazi ca (6.1.114) */
if (sub(array("a"),array("r@"),prat('hS'),0))
{
    $text = three(array("a"),array("r@"),prat('hS'),array("a"),array("u"),prat('hS'),0);
    echo "By hazi ca (6.1.114) :";
    display (0);
}

/* ekaH pUrvaparayoH (6.1.84) */ // This is the adhikArasUtra. No vidhi mentioned.

/* etyedhatyuThsu (6.1.89) */ // Pending. Too less examples and too wide implications. 

// The following vArtikas are exception to AdguNaH. Otherwise after joining, it will be difficult to identify. So coded here.
/* akSAdUhinyAmupasaMkhyAnam (vA 3604) */
/* svAdireriNoH (vA 3606) */
/*prAdUhoDhoDyeSaiSyeSu (vA 3605) */
/* Rte ca tRtIyAsamAse (vA 3607) */
/* pravatsatarakambalavasanadazArNAnAmRNe (vA 3608-9) */
$va3607 = array('akzaUhiRI','svairi','praUh','praUQ','praez','praezy','suKaFt','prafR','vatsafR','kambalafR','vasanafR','daSafR','fRafR');
$va3608 = array('akzOhiRI','svEri','prOh','prOQ','prEz','prEzy','suKArt','prArR','vatsArR','kambalArR','vasanArR','daSArR','fRArR');
if (sub($va3607,blank(0),blank(0),0))
{
$text = one($va3607,$va3608,0);
echo "Applying the following vArtikas : akSAdUhinyAmupasaMkhyAnam (vA 3604), svAdireriNoH (vA 3606), prAdUhoDhoDyeSaiSyeSu (vA 3605), Rte ca tRtIyAsamAse (vA 3607), pravatsatarakambalavasanadazArNAnAmRNe (vA 3608-9)";
display(0);
}
/* upasargAdRti dhAtau (6.1.11) */
if (sub($akarantaupasarga,$verbs_ru,blank(0),0))
{
$text = two($akarantaupasarga,$verbs_ru,$changedupasarga,$verbs_changed,0);
echo "By upasargAdRti dhAtau (6.1.11) :</br>";
echo "If the dhAtu used is a nAmadhAtu, the 'a'kAra of upasarga is optionally kept hrasva by vA supyApizaleH (6.1.92). </br>
    Also if the following verb starts from a dIrgha 'R'kAra or dIrgha 'lR'kAra, the optionallity is not there. There is always a hrasva.</br>";
display(0);
}


/* AdguNaH (6.1.87) */
$forguna = array("i","I","u","U");
$rep = array("e","e","o","o");
if (sub($aa,$forguna,blank(0),0))
{
$text = two($aa,$forguna,blank(2),$rep,0);
echo "By AdguNaH (6.1.87) :";
display(0);
}

/* uraNraparaH (1.1.51) */ 
$forguna = array("f","F","x","X");
$rep = array("ar","ar","al","al");
if (sub($aa,$forguna,blank(0),0))
{
$text = two($aa,$forguna,$rep,blank(4),0);
echo "By AdguNaH (6.1.87) and uraNraparaH (1.1.51) :";
display(0);
}
/* eGi pararUpam (6.1.94) */ // Added it here because it is exception to vRddhireci.
// difficult to code till I get the list of dhAtus which have forms starting from e,o.  Maybe I will have to ask for user input here.
for($i=0;$i<count($akarantaupasarga);$i++)
{
    $a_upa_without_a[$i] = substr($akarantaupasarga[$i],1); 
}
if (sub($akarantaupasarga,prat('eN'),blank(0),0))
{
$text = two($akarantaupasarga,prat('eN'),$a_upa_without_a,prat('eN'),1);
echo "By eGi pararUpam (6.1.94) :";
display(0);
}
/* eve cAniyoge (vA 3631) */
$eva = array("eva");
if (sub($aa,$eva,blank(0),0))
{
$text = two($aa,$eva,blank(2),$eva,1);
echo "By eve cAniyoge (vA 3631) :</br>
    Please note that the optionality applies only in case the eva is used for avadhAraNa." ;
display(0);
}

/* eGaH padAntAdati (6.1.109) */
if (sub(array("e","o"),array("a"),blank(0),0))
{
    $text = two(prat('eN'),array("a"),prat('eN'),array("'"),0);
    echo "By eGaH padAntAdati (6.1.109) : ";
    display(0);
}

/* vA supyapizaleH (6.1.92) */ // Not possible to know what is nAmadhAtu and what is not. Therefore added as comments. Not coded.

/* aco'ntyAdi Ti (1.1.64) */ // a saJjJAsUtra. No vidhi meant.

/* zakandhvAdiSu pararUpaM vAcyam (vA 3632) */
$shakandhu1 = array("Saka","karka","kula","manas","hala","lANgala","patan","mfta");
$shakandhu2 = array("anDu","anDu","awA","IzA","IzA","IzA","aYjali","aRqa");
$shakandhu = array("SakanDu","karkanDu","kulawA","manIzA","halIzA","lANgalIzA","pataYjali","mArtaRqa");
if (sub($shakandhu1,$shakandhu2,blank(0),0))
{
$text = two($shakandhu1,$shakandhu2,$shakandhu,blank(count($shakandhu)),0);
echo "By zakandhvAdiSu pararUpaM vAcyam (vA 3632) :";
display(0);
}
$shakandhu1 = array("sIman","sAra");
$shakandhu2 = array("anta","aNga");
$shakandhu = array("sImanta","sAraNga");
if (sub($shakandhu1,$shakandhu2,blank(0),0))
{
$text = two($shakandhu1,$shakandhu2,$shakandhu,blank(count($shakandhu)),0);
echo  "Note: the sImanta - kezaveSa and sAraGga - pazu/pakSI - Then only this will apply.";
display(0);
}
/* otvoShThayoH samAse vA (vA 3634) */
$otu = array("otu","ozQ");
if (sub($aa,$otu,blank(0),0))
{
$text = two($aa,$otu,blank(2),$otu,1);
echo "If what you entered is a samAsa, By otvoShThayoH samAse vA (vA 3634), it will be optionally converted. Otherwise ignore the pararUpa form. ";
display(0);
}
/* omAGozca (6.1.95) */ 
$om = array("om");
if (sub($aa,$o,blank(0),0))
{
$text = two($aa,$om,blank(2),$om,0);
echo "By omAGozca (6.1.95) the om or AG following the a,A gets converted to pararUpa. Because of technical reasons, we can't tell when there is an 'AG' in the verb form. Whenever 'AG' is used, this rule would apply. ";
display(0);
}
/* avyaktAnukaraNasyAta itau (6.1.98) */
$at = array("at");
$iti = array("iti");
if (sub($at,$iti,blank(0),0))
{
$text = two($at,$iti,blank(1),$iti,1);
echo "When the 'at' happens to be at the end of an onaematopic word and it is followed by 'iti', its 'Ti' is elided. This rule doesn't apply on single vowel words like 'zrat'. ";
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
        echo "Your data matches criteria for AmreDita.</br>";
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
echo "When the 'at' happens to be at the end of an onaematopic word and it is followed by 'iti', its 'Ti' is elided. This rule doesn't apply on single vowel words like 'zrat'. ";
display(0);   
}

/* vRddhireci (6.1.88) */
$vrrdhi = array("E","O","E","O");
if (sub($aa,prat('ec'),blank(0),0))
{
$text = two($aa,prat('ec'),blank(2),$vrrdhi,0);
echo "By vRddhireci (6.1.88) :";
display(0);
}

/* udaH sthAstambhvoH pUrvasya (8.1.61) */
if(sub(array("utsTA","utstam"),blank(0),blank(0),0))
{
$text = two(array("ut"),array('sTA','stam'),blank(1),array('utTA','uttam'),0);
echo "By udaH sthAstambhvoH pUrvasya (8.1.61) :";
display(0);
}


/* saMhitAyAm (6.1.72) */ // This is adhikArasUtra. Nothing to code here.

/* Che ca (6.1.73) */
if (sub($hrasva,array("C"),blank(0),0))
{
$text = two($hrasva,array("C"),$hrasva,array("tC"),0);
echo "By Che ca (6.1.73) :";
display(0);
}
/* AGmAGozca (6.1.74) */
if ($first === "A" || $first === "mA")
{
$text = two(array("A"),array("C"),array("A"),array("tC"),0);
echo "By AGmAGozca (6.1.74) :";
display(0);
}

/* dIrghAt (6.1.75) and padAntAdvA (6.1.76) */
if (sub($dirgha,array("C"),blank(0),0))
{
$text = two($dirgha,array("C"),$dirgha,array("tC"),0);
echo "By dIrghAt (6.1.75) padAntAdvA (6.1.76) :</br>
    Please note: The 'tuk' Agama is optional in case the preceding dIrgha vowel is at the padAnta. Otherwise, it is mandatory to add.";
display(0);
}

/* tripAdI functions */

/* saMyogAntasya lopaH (8.2.23) */ // coding pending because not clear. And also 'yaNaH pratiSedho vAcyaH' prohibits its application.

/* coH kuH (8.2.30) */
$cu = array("c","C","j","J","Y");
$ku = array("k","K","g","G","N");
if (preg_match('/['.flat($cu).']$/',$first) || preg_match('/['.flat($cu).']$/',$second))    
{
$text = one($cu,$ku,0); 
echo "By coH kuH (8.2.30) :";
display(0);
}
if (sub($cu,prat("Jl"),blank(0),0))
{
$text = two($cu,prat('Jl'),$ku,prat('Jl'),0);
echo "By coH kuH (8.2.30) :";
display(0);
}


/* jhalAM jazo'nte (8.2.39) */ // The way I handle padAnta needs revision. Check whether we can apply a "+" sign at the end of $first. Ignore it in other cases. Remember when we need padAnta. Think.
$first1 = str_split($first);
$first2 = substr($first,count($first1)-1); 
$firstbereplaced = chop($first,$first2); 
$first2 = array($first2); $firstbereplaced=array($firstbereplaced);
if (preg_match('/['.pc('Jl').']$/',$first) || preg_match('/['.pc('Jl').']$/',$second))
{
    $text = two($firstbereplaced,prat('Jl'),$firstbereplaced,savarna(prat('Jl'),prat('jS')),1);
    if ($rutva === 1) {echo "jhalAM jazo'nte is barred by sasajuSo ruH. <hr>"; }
    else {
    echo "By jhalAM jazo'nte (8.2.39), The padAnta is 'jhal' is replaced by 'jaz' :</br>
        Please note: If the jhal is at the end of a pada, it is mandatory to change it. Otherwise it is not going to change. Ignore which is not applicable.";
    display(0);    }
}

/* samaH suTi (8.3.5) */ // have used @ as mark of anunAsika u of ru. 
if (sub(array("samsk"),blank(0),blank(0),0))
{
$text = one("samsk","sar@sk",0);
echo "By samaH suTi (8.3.5) :";
display(0);
}
/* pumaH khayyampare (8.3.6) */
$am = array("a","A","i","I","u","U","f","F","x","X","e","o","E","O","h","y","v","r","l","Y","m","N","R","n");
if(sub(array("pum"),prat('Ky'),$am,0))
{
$text = three(array("pum"),prat('Ky'),$am,array("pur@"),prat('Ky'),$am,0);
echo "By pumaH khayyampare (8.3.6) :";
display(0);
}
/* khyAYAdeze na (vA 1591) */
if (sub(array("pur@Ky"),blank(0),blank(0),0))
{
$text = one(array("pur@Ky"),array("pumKy"),0);
echo "By khyAYAdeze na (vA 1591) :";
display(0);
}
/* nazChavyaprazAn (8.3.7) */
if (sub(array("n"),prat('Cv'),$am,0))
{
$text = three(array("n"),prat('Cv'),$am,array("r@"),prat('Cv'),$am,0);
$text = one(array("praSAr@"),array("praSAn"),0);
echo "By nazChavyaprazAn (8.3.7) :";
display(0);
}

/* nRUnpe (8.3.10) */
if (sub(array("nFnp"),blank(0),blank(0),0))
{
$text = one(array("nFnp"),array("nFr@p"),1);
echo "By nRUnpe (8.3.10) ";
display(0);
}

/* kAnAmreDite (8.3.12) */ 
if (sub(array("kAnkAn"),blank(0),blank(0),0))
{
$text = one(array("kAnkAn"),array("kAr@kAn"),0);
echo "By kAnAmreDite (8.3.12) :";
display(0);
}

/* kharavasAnayorvisarjanIyaH (8.3.15) */
// Patch for ru
if (sub(array("r@","r"),prat('Kr'),blank(0),0))
{
$text = two(array("r@","r"),prat('Kr'),array("H","H"),prat('Kr'),0);
echo "By kharavasAnayorvisarjanIyaH (8.3.15) :";
display(0);
}
/*if (sub(array("r@"),blank(0),blank(0),0) && preg_match('/[nrsH]$/',$first))
{
$text = one(array(substr($first,0,strlen($first)-1)."r@"),array(substr($first,0,strlen($first)-1)."H"),0);
echo "By kharavasAnayorvisarjanIyaH (8.3.15) :";
display(0);
}*/
if (sub(array("r@"),blank(0),blank(0),0) && preg_match('/[nrsH]$/',$second))
{
$text = one(array(substr($second,0,strlen($second)-1)."r@"),array(substr($second,0,strlen($second)-1)."H"),0);
echo "By kharavasAnayorvisarjanIyaH (8.3.15) :";
display(0);
}
if (sub(array("aharahar"),blank(0),blank(0),0) && preg_match('/[nrsH]$/',$second))
{
$text = one(array("aharahar"),array("aharahaH"),0);
echo "By kharavasAnayorvisarjanIyaH (8.3.15) :";
display(0);
}

/* ro ri (8.3.14) */
if (sub(array("rr"),blank(0),blank(0),0))
{
    $text = one(array('rr'),array('#r'),0); 
    $ro = 1;
    echo "By ro ri (8.3.14) :";
    display(0);
} else { $ro = 0; }

/* Dhralope pUrvasya dIrgho'NaH (6.3.111) */
$ana = array("a","A","i","I","u","U","f","F","x","X");
$anna = array("A","A","I","I","U","U","F","F","X","X");
if ($ro ===1 && sub($ana,array('#r'),blank(0),0))
{
$text = two($ana,array('#r'),$anna,array('r'),0);
echo "By Dhralope pUrvasya dIrgho'NaH (6.3.111) :";
display(0);
}



/* bhobhagoaghoapUrvasya yo'zi (8.3.17) and vyorlaghuprayatnataraH zAkaTAyanasya (8.3.18) : */
$ash = array("a","A","i","I","u","U","f","F","x","X","e","o","E","O","h","y","v","r","l","Y","m","N","R","n","J","B","G","Q","D","j","b","g","q","d");
if (sub(array("Bo","Bago","aGo","a","A"),array("r@"),$ash,0)) 
{
    $text = three(array("Bo","Bago","aGo","a","A"),array("r@"),$ash,array("Bo","Bago","aGo","a","A"),array("y"),$ash,0);
    echo "By bhobhagoaghoapUrvasya yo'zi (8.3.17) and vyorlaghuprayatnataraH zAkaTAyanasya (8.3.18) :</br>
        In the opinion of zAkaTAyana, the padAnta yakAra and vakAra gets laghUccAraNa. "; $bho = 1;
    display (0);
} else { $bho =0; }

/* vyorlaghuprayatnataraH zAkaTAyanasya (8.3.18) */
// This is regarding pronounciation.

/* lopaH zAkalyasya (8.3.19) */ 
$aa = array("a","A");$yv = array("y","v"); $space=array(" "," ");
if (sub($aa,$yv,blank(0),0) && (preg_match('/['.pc('ec').']$/',$first) || $bho === 1))
{
echo "By lopaH zAkalyasya (8.3.19) :";
$aa = array("a","A");$yv = array("y","v"); $space=array(" "," ");
$text = three($aa,$yv,$ac,$aa,$space,$ac,1); 
display(0);
}

/* oto gArgyasya (8.3.20) */
if (sub(array("oy"),blank(0),blank(0),1) && $bho ===1)
{
    $text = one(array("oy"),array("o "),1);
    echo "By oto gArgyasya (8.3.20) :</br>
        N.B. This rule applies only to the padAnta alaghuprayatna yakAra following 'o' only.";
    display(0);
}

/* uJi ca pade (8.3.21) */
if ((sub(array("ay","av"),array("u "),blank(0),0)|| sub(array("ay","av"),blank(0),blank(0),0) && $second === "u") && $bho ===1)
{
    $text = two(array("ay","av"),array("u"),array("a","a"),array("u"),0);
    echo "By uJi ca pade (8.3.21) :";
    display(0);
}

/* hali sarveSAm (8.3.22) */
if ($bho === 1 && sub(array("y"),$hl,blank(0),0))
{
    $text = three(array("Bo","Bago","aGo","A"),array("y"),$hl,array("Bo","Bago","aGo","A"),array(" "),$hl,0);
    echo "By hali sarveSAm (8.3.22) :";
    display(0);
}



/* atrAnunAsikaH pUrvasya tu vA (8.3.2) */
if (sub($ac,array("r@"),blank(0),0))
{
$text = two($ac,array("r@"),$ac,array("!r@"),1);
echo "By atrAnunAsikaH pUrvasya tu vA (8.3.34) :";
display(0);
}

/* anunAsikAtparo'nusvAraH (8.3.4) */
if (sub(array("r@"),blank(0),blank(0),0))
{
$text = one(array("r@"),array("Mr@"),0);
$text = one(array("!Mr@"),array("!r@"),0);
echo "By anunAsikAtparo'nusvAraH (8.3.4) :";
display(0);
}

/* mo'nusvAraH (8.3.23) */ 
if (sub(array('m'),prat('hl'),blank(0),0))
{
$text = two(array('m'),prat('hl'),array('M'),prat('hl'),1);
echo "By mo'nusvAraH (8.3.23) :</br>
    Please note: The conversion to anusvAra occurs only if the m is at the end of a pada. Otherwise this conversion doesn't apply. Ignore all consequentiality in that case.";
display(0);
}

/* nazcApadAntasya jhali (8.3.24) */
if (preg_match('/[mn]$/',$first)!== true && sub(array("m","n"),prat('Jl'),blank(0),0))
{
$text = two(array('m','n'),prat('Jl'),array('M','M'),prat('Jl'),1);
echo "By nazcApadAntasya jhali (8.3.24) :</br>
    Please note: If the 'n'/'m' is in padAnta, it should not be converted to anusvARa.</br>
    If it is inside a pada, it should be converted to anusvAra. So ignore the case which doesn't apply here.";
display(0);
}

/* mo rAji samaH kvau (8.3.25) */
if (sub(array("saMrA"),blank(0),blank(0),0))
{
    $text = one(array("saMrA"),array("samrA"),0);
    echo "By mo rAji samaH kvau (8.3.25) :";
    display(0);
}

/* he mapare vA (8.3.26) and yavalapare yavalA veti vaktavyam (vA 4902) */
if (sub(array("Mhm","Mhy","Mhv","Mhl"),blank(0),blank(0),0))
{
$text = one(array("Mhm","Mhy","Mhv","Mhl"),array("mhm","!yhy","!vhv","!lhl"),1);
echo "By he mapare vA (8.3.26) and yavalapare yavalA veti vaktavyam (vA 4902) :";
display(0);
}

/* napare naH (8.3.27) */
if (sub(array("Mhn"),blank(0),blank(0),0))
{
$text = one(array("Mhn",),array("nhn",),1);
echo "By napare naH (8.3.27) :";
display(0);
}

/* GNoH kukTukzari (8.3.28) */
if (sub(array("N","R"),prat('Sr'),blank(0),0))
{
$text = two(array("N","R"),prat('Sr'),array("Nk","Rw"),prat('Sr'),1);
echo "By GNoH kukTukzari (8.3.28) :";
display(0);
/* cayo dvitIyAH zari pauSkarasAderiti vAcyam (vA 5023) */
$text = two(array("Nk","Rw"),prat('Sr'),array("NK","RW"),prat('Sr'),1);
echo "By cayo dvitIyAH zari pauSkarasAderiti vAcyam (vA 5023) :";
display(0);
}

/* DaH si dhuT (8.3.29) */
if (sub(array("q"),array("s"),blank(0),0))
{
$text = two(array("q"),array("s"),array("qD"),array("s"),1);
echo "By DaH si dhuT (8.3.29) :";
display(0);
}

/* nazca (8.3.30) */
if (sub(array("Ms"),blank(0),blank(0),0))
{
$text = two(array("M"),array("s"),array("nD"),array("s"),1);
echo "By nazca (8.3.30) :";
display(0);
}

/* zi tuk (8.3.31) */
if (sub(array("nS"),blank(0),blank(0),0))
{
$text = one(array("nS"),array("ntS"),1);    
echo "By zi tuk (8.3.31) :";
display(0);
}

/* Gamo hrasvAdaci GamuNnityam (8.3.32) */
if (preg_match('/['.flat($hrasva).'][NRn]$/',$first) && preg_match('/^['.flat($ac).']/',$second) )
{
$text = three($hrasva,array("N","R","n"),$ac,$hrasva,array("NN","RR","nn"),$ac,0);
echo "By Gamo hrasvAdaci GamuNnityam (8.3.32) :</br>
    Please note: This rule applies only in cases wehre there is G,N or n at the end of a pada. Not in other cases. Ignore such cases.";
display(0);
}


/* maya uYo vo vA (8.3.33) */
if (sub(array("kimu"),blank(0),blank(0),0))
{
$text = two(array("kimu"),$ac,array("kimv"),$ac,1);
echo "By maya uYo vo vA (8.3.33) :";
display(0);
}

/* sampuGkAnAM so vaktavyaH (vA 4892) */
if (sub(array("saMH","sa!H","puMH","pu!H","kAMH","kA!H"),blank(0),blank(0),0))
{
$text = one(array("saMH","sa!H","puMH","pu!H","kAMH","kA!H"),array("saMs","sa!s","puMs","pu!s","kAMs","kA!s"),0);
echo "By sampuGkAnAM so vaktavyaH (vA 4892) ";
display(0);
}
/* samo vA lopameke (bhASya) */
if (sub(array("saMs","sa!s"),blank(0),blank(0),0))
{
$text = one(array("saMs","sa!s"),array("saM","sa!"),1);
echo "By samo vA lopameke (bhASya) :";
display(0);
}
/* kaskAdiSu ca (8.3.48) */
if(sub(array("kaHka","kautaHkuta","sarpiHkuRqikA","dhanuHkapAla"),blank(0),blank(0),0))
{
$text = one (array("kaHka","kautaHkuta","sarpiHkuRqikA","dhanuHkapAla"),array("kaska","kautaskuta","sarpizkuRqikA","dhanuzkapAla"),0);
echo "By kaskAdiSu ca (8.3.48) ";
    display(0);
}

/* kupvoH &k*pau ca (8.3.37) */ // Note that we have used & as jihvAmUlIya and * as upadhmAnIya.
// zarpare visarjanIyaH is not exempted by this sutra. So remember to code accordingly there.
$ku = array("k","K","g","G","N");
$pu = array("p","P","b","B","m");
if(sub(array("H"),$ku,blank(0),0))
{
$text = two(array("H"),$ku,array("&"),$ku,1); $zarpare = 1;
echo "By kupvoH &k*pau ca (8.3.37). :</br>
    Please note that we have used & as jihvAmUlIya and * as upadhmAnIya. ";
display(0);
} else { $zarpare = 0; }
if(sub(array("H"),$pu,blank(0),0) )
{
$text = two(array("H"),$pu,array("*"),$pu,1); $zarpare = 1;
echo "By kupvoH &k*pau ca (8.3.37). :</br>
    Please note that we have used & as jihvAmUlIya and * as upadhmAnIya. ";
display(0);
} else { if ($zarpare === 1) {$zarpare = 1; } else {$zarpare = 0;}}
/* visarjanIyasya saH (8.3.34) */ // Ky is used because for Sr we have an option. 
if(sub(array("H"),prat('Ky'),blank(0),0) && $zarpare !==1)
{
$text = two(array("H"),prat('Ky'),array("s"),prat('Ky'),0);
$zarpare = 2;
echo "By visarjanIyasya saH (8.3.34) :";
display(0);
} else { if ($zarpare === 1) {$zarpare = 1; } else {$zarpare = 0;}}
/* zarpare visarjanIyaH (8.3.35) */
if (sub(array("s"),prat('Kr'),prat('Sr'),0) && $zarpare === 2)
{
$text = three(array("s"),prat('Kr'),prat('Sr'),array('H'),prat('Kr'),prat('Sr'),0);
$text = three(array("&"),prat('Kr'),prat('Sr'),array('H'),prat('Kr'),prat('Sr'),0);
echo "By zarpare visarjanIyaH (8.3.35) :";
display(0);
}
/* vA zari (8.3.36) */
if(sub(array("H"),prat('Sr'),blank(0),0))
{
$text = one(array("HS","Hz","Hs"),array("SS","zz","ss"),1);
echo "By vA zari (8.3.36) :";
display(0);
}   
/* kharpare zari vA visargalopo vaktavyaH (vA 4906) */
if(sub(array("H"),prat('Sr'),prat('Kr'),0))
{
$text = three(array("H"),prat('Sr'),prat('Kr'),array(" "),prat('Sr'),prat('Kr'),1);
echo "By kharpare zari vA visargalopo vaktavyaH (vA 4906) :";
display(0);
}

/* so'padAdau (8.3.38), pAzakalpakakAmyeSviti vAcyam (vA 5033), anavyayasyeti vAcyam (vA 4902) and kAmye roreveti vAcyam (vA 4902) */ 
// anavyayasyeti vAcyam (vA 4901) is pending to code.
if (sub(array("pAS","kalp","kAmy","ka"),blank(0),blank(0),0) && $zarpare === 1)
{
    $text = two(array("H"),array("kalp","kAmy","ka","kAMy"),array('s'),array("kalp","kAmy","ka","kAMy"),0);
    $text = two(array("H"),array("pAS"),array('s'),array("pAS"),0);
        $text = two(array("&"),array("kalp","kAmy","ka","kAMy"),array('s'),array("kalp","kAmy","ka","kAMy"),0);
    $text = two(array("*"),array("pAS"),array('s'),array("pAS"),0);

    if (preg_match('/[sr]$/',$first))
    {
        $text = one(array('skAmy','skAMy'),array('HkAmy','HkAMy'),0);
       
    }
    echo "By so'padAdau (8.3.38), pAzakalpakakAmyeSviti vAcyam (vA 5033), anavyayasyeti vAcyam (vA 4902) and kAmye roreveti vAcyam (vA 4902) :";
    display(0);
}

/* iNaH SaH (8.3.39) */
$iN = array("i","I","u","U");
if (sub($iN,array("spAS","skalp","skAmy","ska","skAMy"),blank(0),0))
{
    $text = one(array("spAS","skalp","skAmy","ska","skAmy"),array("zpAS","zkalp","zkAmy","zka","zkAmy"),0);
    echo "By iNaH SaH (8.3.39) :";
    display(0);
}

/* namaspurasorgatyoH (8.3.40) */
$namas = array("namas","puras");
if (sub($namas,$ku,blank(0),0))
{
    $text = two($namas,$ku,array("namaH","puraH"),$ku,1);
    echo "By namaspurasorgatyoH (8.3.40) :</br>
          N.B. : The conversion to namas / puras is done only in case it has gati saJjJA.";
    display(0);
}
if (sub($namas,$pu,blank(0),0))
{
    $text = two($namas,$pu,array("namaH","puraH"),$pu,1);
    echo "By namaspurasorgatyoH (8.3.40) :</br>
        N.B. : The conversion to namas / puras is done only in case it has gati saJjJA.";
    display(0);
}

/* idudupadhasya cApratyayasya (8.3.41) */
$id = array("i","u",);
if (sub($iN,array("H"),$ku,0))
{
    $text = three($id,array("H"),$ku,$id,array("z"),$ku,1);
    echo "By idudupadhasya cApratyayasya (8.3.41) :</br>
        N.B. : the visarga will be converted to 'S' only if it is not followed by pratyaya.";
    display(0);
}
if (sub($iN,array("H"),$pu,0))
{
    $text = three($id,array("H"),$pu,$id,array("z"),$pu,1);
    echo "By idudupadhasya cApratyayasya (8.3.41) :</br>
        N.B. : the visarga will be converted to 'S' only if it is not followed by pratyaya.";
    display(0);
}

/* ekAdezazAstranimittikasya na Satvam | kaskAdiSu bhrAtuSputrazabdasya pAThAt (vA 4915) */ 
// Pending to code.

/* muhusaH pratiSedhaH (vA 4911) */
if (sub(array("muhu"),array("z"),blank(0),0))
{
    $text = three(array("muhu"),array("z"),$pu,array("muhu"),array("H"),$pu,0);
    $text = three(array("muhu"),array("z"),$ku,array("muhu"),array("H"),$ku,0);
    echo "By muhusaH pratiSedhaH (vA 4911) :";
    display(0);
}

/* tiraso'nyatarsyAm (8.3.42) */
if (sub(array("tiras"),$ku,blank(0),0))
{
    $text = two (array('tiras'),$ku,array('tiraH'),$ku,1);
    echo "By tiraso'nyatarasyAm  (8.3.42) :";
    display(0);
}
if (sub(array("tiras"),blank(0),blank(0),0))
{
 $text = two (array('tiras'),$pu,array('tiraH'),$pu,1);
 echo "By tiraso'nyatarasyAm  (8.3.42) :";
    display(0);
}
/* dvistrizcaturiti kRtvo'rthe (8.3.43) */
if (sub(array("dviz","triz","catuz"),$ku,blank(0),0))
{
    $text = two (array("dviz","triz","catuz"),$ku,array("dviH","triH","catuH"),$ku,1);
    echo "By dvistrizcaturiti kRtvo'rthe (8.3.43) :</br>
        N.B. This applies only in case of kRtvo'rthe. ";
    display(0);
}
if (sub(array("dviz","triz","catuz"),$pu,blank(0),0))
{
 $text = two (array("dviz","triz","catuz"),$pu,array("dviH","triH","catuH"),$pu,1);
 echo "By dvistrizcaturiti kRtvo'rthe (8.3.43) :</br>
        N.B. This applies only in case of kRtvo'rthe. ";
    display(0);
}

/* isusoH sAmarthye (8.3.44) and nityaM samAse'nuttarapadasthasya (8.3.45) */ 
if (sub(array("iz","uz",),$ku,blank(0),0))
{
    $text = two (array("iz","uz"),$ku,array("iH","uH"),$ku,1);
    echo "By isusoH sAmarthye (8.3.44) and nityaM samAse'nuttarapadasthasya (8.3.45) :</br>
        N.B. This applies only in case of sAmarthya. If 'is' or 'us' pratyayas are at the end of first component of a compound, they are mandatorily converted to 'S'. ";
    display(0);
}
if (sub(array("dviz","triz","catuz"),$pu,blank(0),0))
{
 $text = two (array("iz","uz"),$pu,array("iH","uH"),$pu,1);
 echo "By isusoH sAmarthye (8.3.44) and nityaM samAse'nuttarapadasthasya (8.3.45) :</br>
        N.B. This applies only in case of sAmarthya. If 'is' or 'us' pratyayas are at the end of first component of a compound, they are mandatorily converted to 'S'. ";
    display(0);
}

/* ataH kRkamikaMsakumbhapAtrakuzAkarNISvanavyayasya (8.3.46) */
//Right now coded without consideration of avyayas. I have a list of avyayas. Integrate later. */
if (sub(array('as'),array("kAr","kAm","kaMs","kumB","kuSA","karRI"),blank(0),0))
{
 $text = two (array('as'),array("kAr","kAm","kaMs","kumB","kuSA","karRI"),array('aH'),array("kAr","kAm","kaMs","kumB","kuSA","karRI"),1);
 echo "ataH kRkamikaMsakumbhapAtrakuzAkarNISvanavyayasya (8.3.46) :</br>
     N.B : If the word is an avyaya, the 's'kAra doesn't happen. It is visarga only. In case the word ending in 'as' is second part of samAsa, it remains as visarga only.";
    display(0);
}

/* adhazzirasI pade (8.3.47) */
if (sub(array("adhaspada","Siraspada"),blank(0),blank(0),0))
{
    $text = one(array("adhaspada","Siraspada"),array("adhaspada","Siraspada"),1);
    echo "By adhazzirasI pade (8.3.47) :<br>
        N.B. : sakArAdeza happens only when there is samAsa and adhas / ziras is not uttarapadastha. ";
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
echo "By stoH zcunA zcuH (8.4.40) :";
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

    echo "By stoH zcunA zcuH (8.4.40) and zAt (8.4.44) :";
display(0);
}

/* idupupadhasya cApratyasya (8.3.41) */

/* anAmnavatinagarINAmiti vAcyam (vA 5016) */
$shtu = array("z","w","W","q","Q","R",);
if (sub($shtu,array("nAm","navati","nagar"),blank(0),0))
{
$text = two($shtu,array("nAm","navati","nagar"),blank(count($shtu)),array("RRAm","RRavati","RRagar"),0);
echo "By anAmnavatinagarINAmiti vAcyam (vA 5016) :";
display(0);
}

/* stoH STunA STuH (8.4.41) and na padAntATToranAm (8.4.41) and toH Si (8.4.43) */
$Tu = array("w","W","q","Q","R",);
if(sub($shtu,$stu,blank(0),0)|| sub($stu,$shtu,blank(0),0))
{
$text = two(array("z"),$stu,array("z"),$shtu,0);
$text = two(array("s"),$shtu,array("z"),$shtu,0);
$text = two(array("t"),$Tu,array("w"),$Tu,0);
$text = two(array("T"),$Tu,array("W"),$Tu,0);
$text = two(array("d"),$Tu,array("q"),$Tu,0);
$text = two(array("D"),$Tu,array("Q"),$Tu,0);
$text = two(array("n"),$Tu,array("R"),$Tu,0);
    echo "By stoH STunA STuH (8.4.41) and na padAntATToraNam (8.4.42) and toH Si (8.4.43) :";
display(0);
}

/* yaro'nunAsike'nunAsiko vA (8.4.45) */ // this is applicable to only sparzas.
$yara = array("J","B","G","Q","D","j","b","g","q","d","K","P","C","W","T","c","w","t","k","p");
$anunasikarep = array("Y","m","N","R","n","Y","m","N","R","n","N","m","Y","R","n","Y","R","n","N","m");
$anunasika = array("N","Y","R","n","m");

if (sub($yara,$anunasika,blank(0),0))
{
$text = two($yara,$anunasika,$anunasikarep,$anunasika,1);
echo "By yaro'nunAsike'nunAsiko vA (8.4.45) :</br>
    Please note: If the second member is a pratyaya, it is mandatory to change it to anunAsika.";
display(0);
}

/* aco rahAbhyAM dve (8.4.46) */ 
$rh = array("r","h");
if (sub($ac,$rh,prat('yr'),0))
{
$text = dvitva($ac,$rh,prat('yr'),array(""),3,1);
echo "By aco rahAbhyAM dve (8.4.46) :";
display(1);
}

/*anaci ca (8.4.47)*/ // Here the sudhI + upAsya - what about the Asy - Assy is possbile ? Code gives it. But there are 4 options. Code gives two only.
// The cause for using $hrasva instead of $ac is that the dIrgha vowels are debarred by dIrghAdAcAyANAm.
// Here instead of using pratyAhAra hl, we shall do manual enumeration of all the members. Bexause of "anusvAravisargajihvAmUlIyopadhmAnIyayamAnAmakAropari zarSu ca pAThasyopasaGkhyAtatvenAnusvArasyApyactvAt (in derivation of samskAra) 
$hala1 = array("h","y","v","r","l","Y","m","N","R","n","J","B","G","Q","D","j","b","g","q","d","K","P","C","W","T","c","w","t","k","p","-y","S","z","s","H","M");
if(sub($hrasva,$hl,$hala1,0))
{
$text = dvitva($hrasva,$hl,$hala1,array(""),2,1);
echo "By anaci ca (8.4.47):";
display(1);
}
if(checkarray($dirgha,$hl,array('r','l'),blank(0))!==0 && $sthanivadbhav===1)
{
$text = dvitva($dirgha,$hl,$hala1,array(""),2,1);
echo "By anaci ca (8.4.47):</br>
    Please note: The exception dIrghAdAcAryANAm is taken as optional in the mahAbhASya by denoting vAkk as a valid form. There is difference of opinion on this point in commentaries.";
display(1);
}
if (preg_match('/['.flat($ac).']['.flat($hl).']$/',$second))
{
    foreach ($text as $value)
    {
        $split = str_split($value);
        $last = $split[count($split)-1];
        $first = chop($value,$last);
        $value = str_replace($value,$first.$last.$last,$value);
    }
    echo "By anaci ca (according to mahAbhASya example of vAkk) :";
    display(1);
}
/* nAdinyAkroze putrasya (8.4.48) */
if (sub(array('putrAdinI'),blank(0),blank(0),0))
{
    echo "By nAdinyAkroze putrasya (8.4.48) - If Akroza is meant : The dvitva doesn't happen. </br> Otherwise dvitva will happen.</br><hr>";
}
/* vA hatajagdhayoH (vA 5022) */
if (sub(array("putrahatI"),blank(0),blank(0),0))
{
echo "By vA hatajagdhayoH (vA 5022) :";
display(0);
}
if (sub(array('putra'),array('jagDI'),blank(0),0))
{
echo "By vA hatajagdhayoH (vA 5022) :";
display(0);
}

/* zaraH khayaH (vA 5019) */
if (sub(prat('Sr'),prat('Ky'),blank(0),0))
{
$text = dvitva(prat('Sr'),prat('Ky'),array(""),array(""),2,1);
echo "zaraH khayaH (vA 5019) :";
display(1);
}

/* triprabhRtiSu zAkaTAyanasya (8.4.50)*/
$hrasva1 = "'".implode("",$hrasva)."'";
if (checkarray($ac,$hl,$hl,$hl) === 1)
{
echo "Please note: By triprabhRtiSu zAkaTAyanasya (8.4.50), the dvitva is optionally not done in cases where there are more than three hals appearing consecutively. e.g. indra - inndra.  </br><hr>";
}

/* sarvatra zAkalyasya (8.4.51) */
// It is not coded separately. It is sent as a message in all display function when 1 is selected as option. 

/* dIrghAdAcAryANAm (8-4-52) */
// Not coded separately, because we did dvitva only for $hrasva, and not for 'ac'. So this is already taken care of.

/* jhalAM jaz jhaSi (8.4.53) */
if(sub(prat('Jl'),prat('Jz'),blank(0),0))
{
$text = two(prat('Jl'),prat('Jz'),savarna(prat('Jl'),prat('jS')),prat('Jz'),0);
echo "By jhalAM jaz jhaSi (8.4.53):";
display(0);
}
/* yaNo mayo dve vAcye (vA 5018) yaN in paJcamI and may in SaSThI)*/
if (sub(prat('yR'),prat('my'),blank(0),0))
{
$text = dvitva(prat('yR'),prat('my'),array(""),array(""),2,1);
echo "By yaNo mayo dve vAcye (yaN in paJcamI and may in SaSThI) (vA 5018) :";
display(1); 
}
/* yaNo mayo dve vAcye (vA 5018) may in paJcamI and yaN in SaSThI)*/
if (sub(prat('my'),prat('yR'),blank(0),0))
{
$text = dvitva(prat('my'),prat('yR'),array(""),array(""),2,1);
echo "By yaNo mayo dve vAcye (may in paJcamI and yaN in SaSThI) (vA 5018):";
display(1);
}

/* khari ca (8.4.55) */ 
$Jl1 = array("J","B","G","Q","D","j","b","g","q","d","K","P","C","W","T","c","w","t","k","p","S","z","s","h");
if (sub($Jl1,prat('Kr'),blank(0),0))
{
$text = two($Jl1,prat('Kr'),savarna(prat('Jl'),prat('cr')),prat('Kr'),0);
echo "By khari ca (8.4.55) :";
display(0);
}

/* aNo'pragRhyasyAnunAsikaH (8.4.57) */
if (preg_match('/[aAiIuUfFxX]$/',$second) || sub(array(" "),blank(0),blank(0),0))
{
$text3 = two($text,array(""),$text,array("!"),1);
$text = $text3;
$text4 = two(array("a","A","i","I","f","F","x","X"),array(" "),array("a","A","i","I","f","F","x","X"),array("! "),1);
$text = $text4;
echo "By aNo'pragRhyasyAnunAsikaH (8.4.57) :</br>
Please note that we have used ! as marker of anunAsikatva of a vowel";
display(0);
}

/* anusvArasya yayi parasavarNaH (8.4.58) and vA padAntasya (8.4.59) */
$pa = array("!yy","!vv","!rr","!ll","YY","mm","NN","RR","nn","YJ","mB","NG","RQ","nD","Yj","mb","Ng","Rq","nd","NK","mP","YC","RW","nT","Yc","Rw","nt","Nk","mp");
$mm = array("My","Mv","Mr","Ml","MY","Mm","MN","MR","Mn","MJ","MB","MG","MQ","MD","Mj","Mb","Mg","Mq","Md","MK","MP","MC","MW","MT","Mc","Mw","Mt","Mk","Mp");
if (sub(array("M"),prat('yr'),blank(0),0))
{
$text = one($mm,$pa,1);
echo "By anusvArasya yayi parasavarNaH (8.4.58) and vA padAntasya (8.4.59) :</br>
    Please note: The change of anusvARa to parasavarNa is mandatory for non padAnta conjoints. For padAnta conjoints, it is optional.";
display(0);
}

/* torli (8.4.60) */
$to = array("tl","Tl","dl","Dl","nl");
//$li = array("l","l","l","l","l",);
$lirep = array("ll","ll","ll","ll","!ll",);
if (sub($to,blank(0),blank(0),0))
{
$text = one($to,$lirep,0);
echo "By torli (8.4.60) :";
display(0);
}

/* jhayo ho'nyatarasyAm (8.4.62) */ // No idea - this is going wrong.. vAg + hari -> vAgGari, but displays vAgJari.
$Jy = array("Jh","Bh","Gh","Qh","Dh","jh","bh","gh","qh","dh","Kh","Ph","Ch","Wh","Th","ch","wh","th","kh","ph",);
$h1 = array("JJ","BB","GG","QQ","DD","jJ","bB","gG","qQ","dD","KG","PB","CJ","WQ","TD","cJ","wQ","tD","kG","pB",);
//$h2 = array("","B","G","Q","D","J","B","G","Q","D","G","B","G","Q","D","J","Q","D","G","B");
if (sub($Jy,blank(0),blank(0),0)) // This needs revision. Not necessarily it should be in the input.
{
$text = one($Jy,$h1,1);
echo "By jhayo ho'nyatarasyAm (8.4.62) :";
display(0);
}


/* zazCho'Ti (8.4.63) and ChatvamamIti vAcyam (vA 5025) */
$Jy = array("JS","BS","GS","QS","DS","jS","bS","gS","qS","dS","KS","PS","CS","WS","TS","cS","wS","tS","kS","pS",);
$h1 = array("JC","BC","GC","QC","DC","jC","bC","gC","qC","dC","KC","PC","CC","WC","TC","cC","wC","tC","kC","pC",);
$aT = array("a","A","i","I","u","U","f","F","x","X","e","o","E","O","h","y","v","r","l","Y","m","G","R","n");
if(sub($Jy,$aT,blank(0),0))
{
$text = two($Jy,$aT,$h1,$aT,1);
echo "By zazCho'Ti (8.4.63) and ChatvamamIti vAcyam (vA 5025) :";
display(0);
}

/* halo yamAM yami lopaH (8.4.64) */ //the lopa function needs revisit. It gives me hayanubhava from haryanubhava. Not good.
$duplicate = array("kk","KK","gg","GG","NN","cc","CC","jj","JJ","YY","ww","WW","qq","QQ","RR","tt","TT","dd","DD","nn","pp","PP","bb","BB","mm","yy","rr","ll","vv","SS","zz","ss","hh");
$hl = array("k","K","g","G","N","c","C","j","J","Y","w","W","q","Q","R","t","T","d","D","n","p","P","b","B","m","y","r","l","v","S","z","s","h");
if (sub($hl,$duplicate,blank(0),0))
{
$text = lopa($hl,$duplicate,blank(0),blank(0),1,1);
echo "By halo yamAM yami lopaH (8.4.64) :";
display(0);
}
/* jharo jhari savarNe (8.4.65) */
if(sub(prat('hl'),prat('Jr'),prat('Jr'),0))
{
for ($i=0;$i<count(prat('Jr'));$i++)
{$kkk = array("k","K","g","G"); $ccc = array("c","C","j","J","S");
$www = array("w","W","q","Q","z"); $ttt = array("t","T","d","D","s");
$ppp = array("p","P","b","B");
$text = lopa(prat('hl'),$kkk,$kkk,array(""),2,1);
$text = lopa(prat('hl'),$ccc,$ccc,array(""),2,1);
$text = lopa(prat('hl'),$www,$www,array(""),2,1);
$text = lopa(prat('hl'),$ttt,$ttt,array(""),2,1);
$text = lopa(prat('hl'),$ppp,$ppp,array(""),2,1);
}
echo "By jharo jhari savarNe (8.4.65) :";
display(0);
}

echo "Final forms are :";
display(0);
?>
</body>
</html>