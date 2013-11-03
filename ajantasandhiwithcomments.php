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


?>
</body>
</html>