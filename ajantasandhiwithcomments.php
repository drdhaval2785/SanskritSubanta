ï»¿<html>
<body>

<?php
// Including arrays and functions 
include "C://xampp//htdocs//sanskrit//function.php";
// set execution time to an hour
ini_set('max_execution_time', 36000);
// set memory limit to 1000 MB
ini_set("memory_limit","1000M");

// Reading from the HTML input.
$first = $_POST["first"];
$second = $_POST['second'];
// displaying the data back to the user
echo "You entered: ".$first." + ".$second."</br></br>";
    echo "---------------------------------------------------------------------------------------------------------------------------------------</br>";


/* main coding part starts from here.
 * Based on Siddhantakaumudi text.
 */
$text = array();
$input = $first.$second;

// joining the two words
$text[] = (string)($first.$second); 

/* pragRhya section */

/* plutapragRhyA aci nityam (6.1.125) */
// There is no definition of pluta / pragRhya here. So we will code that as and when case arises.

/* iko'savarNe zAkalyasya hrasvazca (6.1.127) */ // Right now coded for only dIrgha. Clarify wheter the hrasva preceding also included?
/*$ik = 'IUFX';
if (preg_match('/['.$ik.']$/',$first) && preg_match('/^['.pc('ac').']/',$second))
{
$text = two(array("I"),nosavarna("I"),array("i "),nosavarna("I"),1);
$text = two(array("U"),nosavarna("U"),array("u "),nosavarna("U"),1);
$text = two(array("F"),nosavarna("F"),array("f "),nosavarna("F"),1);
$text = two(array("X"),nosavarna("X"),array("x "),nosavarna("X"),1);
}
echo "By iko'savarNe zAkalyasya hrasvazca (6.1.127) :</br>
    Note that this will not apply in samAsa. Also when followed by a 'sit' pratyaya, it will not apply. e.g. pArzva";
display(0);
*/

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
if ($first === "amI")
{
$text = two (array("amI"),$ac,array("amI "),$ac,1);
echo "By adaso mAt (1.1.12) :";
display(0);
}
if ($first === "amU")
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

/* maya uYo vo vA (8.3.33) */
if ($first === "kimu")
{
$text = two(array("kimu"),$ac,array("kimv"),$ac,1);
echo "By maya uYo vo vA (8.3.33) :";
display(0);
}

/* IdUtau ca saptamyarthe (1.1.19) */
$idut = array("I","U"); $idut1 = array("I ","U ");
if (preg_match('/[IU]$/',$first))
{
$text = two($idut,$ac,$idut1,$ac,1);
echo "By IdUtau ca saptamyarthe (1.1.19) :</br>
    Please note: This will apply only in case the I/U at the end of the first word have been used in sense of saptamI vibhakti. Otherwise this pragRhyatva will not be there.";
display(0);
}



/*iko yaNaci (6.1.77) */
$text = two(prat('ik'),prat('ac'),prat('yR'),prat('ac'),0);
echo "By iko yaNaci (6.1.77) :";
display(0);
/* sarvatra vibhASA goH (6.1.122) */
$go = array("go"); $aonly = array("a");
$text = two($go,$aonly,array("go "),$aonly,1);
echo "By sarvatra vibhASA goH (6.1.122), it is optionally kept as prakRtibhAva :</br>";
display(0);

/* avaG sphoTAyanasya (6.1.123) */
$text = two($go,prat('ac'),array('gava'),prat('ac'),1);
echo "By avaG sphoTAyanasya (6.1.123), it is optionally converted to avaG :";
display(0);

/* indre ca (6.1.124) */
$text = two($go,array("indra"),array('gava'),array("indra"),0);
echo "by indre ca (6.1.124) :";
display(0);

/* eGaH padAntAdati (6.1.109) */
if (preg_match('/[eo]$/',$first) && preg_match('/^[a]/',$second))
{
    $text = two(prat('eN'),array("a"),prat('eN'),array("'"),0);
    echo "By eGaH padAntAdati (6.1.109) : ";
    display(0);
}

/* eco'yavAyAvaH (7.1.78) */
$ayavayavah = array("ay","av","Ay","Av");
$text = two(prat('ec'),prat('ac'),$ayavayavah,prat('ac'),0);
echo "By echo'yavAyAvaH (7.1.78) :";
display(0);

/* vAnto yi pratyaye (6.1.71), goryutau CandasyupasaMkhyAnam (vA 3543), adhvaparimANe ca (vA 3544) dhAtostannimittasyaiva (6.1.80) */
$o = array("o","O"); $oo = 'oO'; $y = array("y"); $ab = array("av","Av");
$text1 = $text; 
$text = two($o,$y,$ab,$y,0);
if (preg_match('/['.$oo.'][y]/',$first.$second))
{
    echo "vAnto yi pratyaye (6.1.71), goryutau CandasyupasaMkhyAnam (vA 3543), adhvaparimANe ca (vA 3544)  : </br>
        If the 'y' following 'o/O' belongs to a pratyaya or the word 'go' is followed by 'yuti' in Chandas/ as a measure of distance (vA 3543, 3544) : ";
    display(0);
    echo "Please note that if the 'o'kAra or 'au'kAra is of a dhAtu and the pratyaya is starting from 'y', this prakriyA applies only in cases where the 'o'kAra or the 'au'kAra is of dhAtu only.</br>";
    echo "Otherwise :";
    display(2);
}
$text = merge($text,$text1);

/* kSayyajayyau zakyArthe (6.1.81)*/
if ($first.$second === "kSeya")
{
    echo "By kSayyajayyau zakyArthe (6.1.81) :</br>If the word is to be used in the meaning of 'being capable of' : </br> kzayya </br>";
}
if ($first.$second === "jeya")
{
    echo "By kSayyajayyau zakyArthe (6.1.81) :</br>If the word is to be used in the meaning of 'being capable of' : </br> jayya </br>";
}

/* krayyastadarthe _6.1.82) */
if ($first.$second === "kreya")
{
    echo "By krayyastadarthe _6.1.82) :</br>If the word is to be used in the meaning of 'for sale' : </br> krayya </br>";
}

/* lopaH zAkalyasya (8.3.19) */
if (preg_match('/(['.pc('ec').']['.pc('ac').'])/',$first.$second))
{echo "By lopaH zAkalyasya (8.3.19) :";
$aa = array("a","A");$yv = array("y","v"); $space=array(" "," ");
$text = three($aa,$yv,prat('aS'),$aa,$space,prat('aS'),1); 
display(0);
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
$text = one($va3607,$va3608,0);
echo "Applying the following vArtikas : akSAdUhinyAmupasaMkhyAnam (vA 3604), svAdireriNoH (vA 3606), prAdUhoDhoDyeSaiSyeSu (vA 3605), Rte ca tRtIyAsamAse (vA 3607), pravatsatarakambalavasanadazArNAnAmRNe (vA 3608-9)";
display(0);

/* upasargAdRti dhAtau (6.1.11) */
$text = two($akarantaupasarga,$verbs_ru,$changedupasarga,$verbs_changed,0);
echo "By upasargAdRti dhAtau (6.1.11) :</br>";
echo "If the dhAtu used is a nAmadhAtu, the 'a'kAra of upasarga is optionally kept hrasva by vA supyApizaleH (6.1.92). </br>
    Also if the following verb starts from a dIrgha 'R'kAra or dIrgha 'lR'kAra, the optionallity is not there. There is always a hrasva.</br>";
display(0);


/* AdguNaH (6.1.87) */
$forguna = array("i","I","u","U");
$rep = array("e","e","o","o");
//if (preg_match('/[aA]['.flat($forguna).']/',$input))
//{
$text = two($aa,$forguna,blank(2),$rep,0);
echo "By AdguNaH (6.1.87) :";
display(0);
//}

/* uraNraparaH (1.1.51) */ 
$forguna = array("f","F","x","X");
$rep = array("ar","ar","al","al");
//if (preg_match('/[aA]['.flat($forguna).']/',$input))
//{
$text = two($aa,$forguna,$rep,blank(4),0);
echo "By AdguNaH (6.1.87) and uraNraparaH (1.1.51) :";
display(0);
// Once this is converted to 'r'/'l' there are chances of dvitva applying. So added it once more here.
//}

/* eGi pararUpam (6.1.94) */ // Added it here because it is exception to vRddhireci.
// difficult to code till I get the list of dhAtus which have forms starting from e,o.  Maybe I will have to ask for user input here.
for($i=0;$i<count($akarantaupasarga);$i++)
{
    $a_upa_without_a[$i] = substr($akarantaupasarga[$i],1); 
}
$text = two($akarantaupasarga,prat('eN'),$a_upa_without_a,prat('eN'),1);
echo "By eGi pararUpam (6.1.94) :";
display(0);

/* eve cAniyoge (vA 3631) */
$eva = array("eva");
$text = two($aa,$eva,blank(2),$eva,1);
echo "By eve cAniyoge (vA 3631) :</br>
    Please note that the optionality applies only in case the eva is used for avadhAraNa." ;
display(0);



/* kharavasAnayorvisarjanIyaH (8.3.15) */
// Not applicable here.

/* vA supyapizaleH (6.1.92) */ // Not possible to know what is nAmadhAtu and what is not. Therefore added as comments. Not coded.

/* aco'ntyAdi Ti (1.1.64) */ // a saJjJAsUtra. No vidhi meant.

/* zakandhvAdiSu pararUpaM vAcyam (vA 3632) */
$shakandhu1 = array("Saka","karka","kula","manas","hala","lANgala","patan","mfta");
$shakandhu2 = array("anDu","anDu","awA","IzA","IzA","IzA","aYjali","aRqa");
$shakandhu = array("SakanDu","karkanDu","kulawA","manIzA","halIzA","lANgalIzA","pataYjali","mArtaRqa");
$text = two($shakandhu1,$shakandhu2,$shakandhu,blank(count($shakandhu)),0);
echo "By zakandhvAdiSu pararUpaM vAcyam (vA 3632) :";
display(0);
$shakandhu1 = array("sIman","sAra");
$shakandhu2 = array("anta","aNga");
$shakandhu = array("sImanta","sAraNga");
$text = two($shakandhu1,$shakandhu2,$shakandhu,blank(count($shakandhu)),0);
echo  "Note: the sImanta - kezaveSa and sAraGga - pazu/pakSI - Then only this will apply.";
display(0);

/* otvoShThayoH samAse vA (vA 3634) */
$otu = array("otu","ozQ");
$text = two($aa,$otu,blank(2),$otu,1);
echo "If what you entered is a samAsa, By otvoShThayoH samAse vA (vA 3634), it will be optionally converted. Otherwise ignore the pararUpa form. ";
display(0);

/* omAGozca (6.1.95) */ 
$om = array("om");
$text = two($aa,$om,blank(2),$om,0);
echo "By omAGozca (6.1.95) the om or AG following the a,A gets converted to pararUpa. Because of technical reasons, we can't tell when there is an 'AG' in the verb form. Whenever 'AG' is used, this rule would apply. ";
display(0);

/* avyaktAnukaraNasyAta itau (6.1.98) */
$at = array("at");
$iti = array("iti");
$text = two($at,$iti,blank(1),$iti,1);
echo "When the 'at' happens to be at the end of an onaematopic word and it is followed by 'iti', its 'Ti' is elided. This rule doesn't apply on single vowel words like 'zrat'. ";
display(0);

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
$text = two($aa,prat('ec'),blank(2),$vrrdhi,0);
echo "By vRddhireci (6.1.88) :";
display(0);

/* akaH savarNe dIrghaH (6.1.101) */ // Check RlRyoH mithaH sAvarNyam vAcyam.. Not coded for it. Not that clear.
$ak1 = array("a","a","A","A","i","i","I","I","f","F","x","X");
$ak2 = array("a","A","a","A","i","I","i","I","F","F","X","X");
$akdirgha = array("A","A","A","A","I","I","I","I","F","F","X","X");
$text = two($ak1,$ak2,$akdirgha,blank(count($ak1)),0);
echo "By akaH savarNe dIrghaH (6.1.101) :";
display(0);

/* Rti savarNe R vA (vA 3640) and lRti savarNe lR vA (vA 3641) */
$ruti1 = array("f","F","x","X");
$ruti2 = array("f","f","x","x");
$text = two($ruti1,$ruti2,$ruti2,blank(count($ruti1)),1);
echo "By Rti savarNe R vA (vA 3640) and lRti savarNe lR vA (vA 3641) :";
display(0);


/* jhalAM jazo'nte (8.2.39) */ // The way I handle padAnta needs revision. Check whether we can apply a "+" sign at the end of $first. Ignore it in other cases. Remember when we need padAnta. Think.
$first1 = str_split($first);
$first2 = substr($first,count($first1)-1); 
$firstbereplaced = chop($first,$first2); 
$first2 = array($first2); $firstbereplaced=array($firstbereplaced);
if (preg_match('/['.pc('Jl').']$/',$first))
{
    $text = two($firstbereplaced,prat('Jl'),$firstbereplaced,savarna(prat('Jl'),prat('jS')),0);
    echo "By jhalAM jazo'nte (8.2.39), The padAnta is 'jhal' is replaced by 'jaz' :";
    display(0);    
}



 
// To take care of dvitva prakarana a separate functin has been created. Maybe this can be extended to the whole of tripAdi.
$text = dvitvaprakarana();

/* aNo'pragRhyasyAnunAsikaH (8.4.57) */
if (preg_match('/['.flat($ac).']$/',$second))
{
$text3 = two($text,array(""),$text,array("!"),1);
$text = $text3;
echo "By aNo'pragRhyasyAnunAsikaH (8.4.57) :</br>
Please note that we have used ! as marker of anunAsikatva of a vowel";
display(0);
}

?>
</body>
</html>