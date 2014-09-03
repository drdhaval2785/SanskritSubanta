<?php
/* This code is developed by Dr. Dhaval Patel (drdhaval2785@gmail.com) of www.sanskritworld.in and Ms. Sivakumari Katuri.
  * Layout assistance by Mr Marcis Gasuns.
  * Available under GNU licence.
  * Version 1.1 date 17/11/2013
  * The latest source code is available at https://github.com/drdhaval2785/sanskrit
  * For setup, copy and paste sandhi.html, sandhi.php, function.php, mystyle.css, slp-dev.php and dev-slp.php to your localhost and server and run sandhi.html.
  * sandhi.html is the frontend for the code.
  * function.php stores the frequently used functions in this code (The description on how to use the code is there in function.php.
  * slp-dev.php is for converting SLP1 data to Devanagari. dev-slp.php is for converting Devanagari data to SLP1.
  * Mystyle.css is stylesheet where you can change your preferences.
  */

/* Defining grammatical arrays */
$shiv=array("a","i","u","-R","f","x","-k","e","o","-N","E","O","-c","h","y","v","r","-w","l","-R","Y","m","N","R","n","-m","J","B","-Y","G","Q","D","-z","j","b","g","q","d","-S","K","P","C","W","T","c","w","t","-v","k","p","-y","S","z","s","-r","h","-l");
$kantha = array("a","A","k","K","g","G","N","h","H");
$talu = array("i","I","c","C","j","J","Y","y","S");
$murdha = array("f","F","w","W","q","Q","R","r","z");
$danta = array("x","X","t","T","d","D","n","l","s");
$oshtha = array("u","U","p","P","b","B","m");
$nasika = array("N","Y","R","n","m","M");
$kanthatalu = array ("e","E");
$kanthoshtha = array("o","O");
$dantoshtha = array("v");
$sparsha = array("k","K","g","G","N","c","C","j","J","Y","w","W","q","Q","R","t","T","d","D","n","p","P","b","B","m");
$sprushta = array("k","K","g","G","N","c","C","j","J","Y","w","W","q","Q","R","t","T","d","D","n","p","P","b","B","m",);
$ishatsprushta = array("y","r","l","v");
$vivruta = array("S","z","s","h","a","A","i","I","u","U","f","F","x","X","e","E","o","O");
$samvruta = array("a");
$vivara = array("k","K","c","C","w","W","t","T","p","P","H","S","z","s");
$shvasa = array("k","K","c","C","w","W","t","T","p","P","H","S","z","s");
$aghosha = array("k","K","c","C","w","W","t","T","p","P","H","S","z","s");
$samvara = array("g","G","N","j","J","Y","q","Q","R","d","D","n","b","B","m","y","r","l","v","h");
$nada = array("g","G","N","j","J","Y","q","Q","R","d","D","n","b","B","m","y","r","l","v","h");
$ghosha = array("g","G","N","j","J","Y","q","Q","R","d","D","n","b","B","m","y","r","l","v","h");
$alpaprana = array("k","g","c","j","w","q","t","d","p","b","y","r","l","v");
$mahaprana = array("K","G","C","J","W","Q","T","D","P","B","S","z","s","h");
$ru = array("f","F","x","X");
$ac = array("a","A","i","I","u","U","f","F","x","X","e","o","E","O",);
$hl = array("k","K","g","G","N","c","C","j","J","Y","w","W","q","Q","R","t","T","d","D","n","p","P","b","B","m","y","r","l","v","S","z","s","h");
$e = array("e","E","o","O");
$dirgha = array("A","I","U","F","X","e","E","o","O");
$hrasva = array("a","i","u","f","x");
$guna = array ("e","o");
$vruddhi = array("E","O");
$aa = array("a","A");
$upasarga = array("pra","prati","api","parA","apa","upa","pari","anu","ava","vi","saM","su","ati","ni","nir","ut","adhi","dur","abhi");
$verbs_ru = array("fkz","fc","fC","fj","fYj","fR","ft","fd","fD","fn","fP","fBukz","fmP","fS","fz","fh");
$verbs_changed = array("kz","c","C","j","Yj","R","t","d","D","n","P","Bukz","mP","S","z","h");
$ku = array("k","K","g","G","N");
$cu = array("c","C","j","J","Y");
$Tu = array("w","W","q","Q","R");
$tu = array("t","T","d","D","n");
$pu = array("p","P","b","B","m");
$antastha = array("y","r","l","v");
$ushma = array("S","z","s","h");
$iN = array("i","I","u","U");
$pratya =  array("aR","ak","ik","uk","eN","ac","ic","ec","Ec","aw","aR","iR","yaR","am","yam","Yam","Nam","yaY","Jaz","Baz","aS","haS","vaS","JaS","jaS","vaS","Cav","yay","may","Jay","Kay","cay","yar","Jar","Kar","car","Sar","al","hal","val","ral","Jal","Sal");
$sup = array("su!","Ow","jas","am","O","Sas","wA","ByAm","Bis","Ne","ByAm","Byas","Nasi!","ByAm","Byas","Nas","os","Am","Ni","os","sup");
$acsup = array("O","jas","am","Ow","Sas","wA","Ne","Nasi!","Nas","os","Am","Ni","os");
$hlsup = array("su!","ByAm","Bis","Byas","sup");
$prathama = array("su!","O","jas","am","Ow","Sas");
$sarvanama = array("sarva","viSva","uBa","uBaya","atara","atama","anya","anyatara","itara","tvat","tva","nema","sima","tyad","tad","yad","etad","idam","adas","eka","dvi","yuzmad","asmad","Bavat","kim","idakam","etara");
$zasadi = array("Sas","wA","ByAm","Bis","Ne","ByAm","Byas","Nasi!","ByAm","Byas","Nas","os","Am","Ni","os","sup");
$sarvanamasthana = array("su!","O","jas","am","Ow","Si");
$yacibham = array("Sas","wA","Ne","Nasi!","Nas","os","Am","os","Ni");
$tRtIyAdiSvaci = array("wA","Ne","Nasi!","Nas","os","Am","Ni","os");
$tRtIyAdi = array("wA","ByAm","Bis","Ne","ByAm","Byas","Nasi!","ByAm","Byas","Nas","os","Am","Ni","os","sup");
$eksup = array("su!","am","wA","Ne","Nasi!","Nas","Ni",);
$dvisup = array("O","Ow","ByAm","ByAm","ByAm","os","os",);
$bahusup = array("jas","Sas","Bis","Byas","Byas","Am","sup");
$diksamAsa = array("uttarapUrvA","dakziRapUrvA","uttarapaScimA","dakziRapaScimA");
$sarvanamastri = array("sarvA","viSvA","uBA","uBayA","qatarA","qatamA","anyA","anyatarA","itarA","tvA","nemA","simA","pUrvA","parA","avarA","dakziRA","uttarA","aparA","aDarA","svA","antarA","ekA","dvA","kA","idA");
$svasrAdi = array("svasf","tisf","catasf","nanAndf","duhitf","yAtf","mAtf");
$tyadadi = array("dvi","tyad","tad","yad","etad","idam","adas","eka","idakam");
$acdir = array("A","A","I","I","U","U","F","F","F","F","e","o","E","O",);
$tiG = array("tip","tas","Ji");
/* Function to find pratyAhAra from given two letters */ 
// Enter your letters in the arguments like prat('Jl') will mean pratyAhAra jhal.
function prat($text)  // prat for pratyAhAra
{
global $shiv; 
if ($text === "ra") // for circumventing the imaginary ra pratyAhAra
{
$text = array("r","l");
} 
elseif ($text === "yR") // for circumventing the yaN pratyAhAra because of problem of double N
{
$text = array("y","y","v","v","r","r","l","l");
}
else
{
$a = str_split($text);
$a[1] = str_replace($a[1],"-".$a[1],$a[1]); 
$text = array_slice($shiv,array_search($a[0],$shiv),array_search($a[1],$shiv)-array_search($a[0],$shiv)+1);    
$b = implode(" ",$text);
$b = str_replace(" -R","",$b);
$b = str_replace(" -k","",$b);
$b = str_replace(" -N","",$b);
$b = str_replace(" -c","",$b);
$b = str_replace(" -w","",$b);
$b = str_replace(" -m","",$b);
$b = str_replace(" -Y","",$b);
$b = str_replace(" -z","",$b);
$b = str_replace(" -S","",$b);
$b = str_replace(" -v","",$b);
$b = str_replace(" -y","",$b);
$b = str_replace(" -r","",$b);
$b = str_replace(" -l","",$b);
$b = str_replace("a","a A",$b);
$b = str_replace("i","i I",$b);
$b = str_replace("u","u U",$b);
$b = str_replace("f","f F",$b);
$b = str_replace("x","x X",$b);
$b = str_replace("y","y y",$b);
$b = str_replace("v","v V",$b);
$b = str_replace("r","r r",$b);
$b = str_replace("l","l l",$b);
$text = explode(" ",$b);
}
return $text;
}
/* function pratyAhAra check is for checking in regular expressions. 
 * In regular expressions we don't treat arrays. usually it is 'aAiIuU'. 
 * so this function converts the pratyAhAra to this flat format. */
function pc($text) // pratyAhAra check
{
$text = "'".implode("",prat($text))."'";
return $text;
}
/* Function to find the nth letter in the word */
function f($text,$n) // Not used in code.
{
$p = str_split($text);
$text = $p[$n-1];
return $text;
}

/* find string after removing 'n' letters from beginning of the word (sa for string after) */
function sa($text,$n)        // Not used in code.
{
$p = str_split($text);
$a = "";
for ($q=0;$q<$n;$q++)
{ $text = ltrim($text,$p[$q]); }
return $text;
}
/* find 'n'th letter from the end in a word (r for reverse direction) */
function r($text,$n)                 // Not used in code
{
$p = str_split($text);
$text = $p[count($p)-$n];
return $text;
}
/* find the string remaining after removing n characters from the end (sb for string before) */
function sb($text, $n)        // Not used in code.
{
$p = str_split($text);
$a= "";
for ($q=0;$q<$n;$q++)
{$text = chop($text,$p[count($p)-$q-1]);} 
return $text;
}

/* Function one is for replacing one letter in the whole array of $text with another letter */
// There are three arguments, $a is the array which you want to change, $b is the array which will be put in place of the replaced one.
// $merge can take two values. 0 will mean that the whole $text will be replaced with the new replaced values. Used in case of mandatory Adezas.
// 1 will mean that $text will not be replaced, but the replaced values will be added to it. Used in case of optional Adezas.
function one($a,$b,$merge)
{global $text;
    for($z=0;$z<count($text);$z++)
    {
        $p = $text[$z];
        for($i=0;$i<count($a);$i++)
        {
            $p =  str_replace($a[$i],$b[$i],$p);    
        }
        $text1[$z] = $p;
    }
    if ($merge === 0)
    {
        $text = $text1;
        $text = array_unique($text);
        $text = array_values($text);
    }
    if ($merge === 1)
    {
        $text = array_merge($text,$text1);
        $text = array_unique($text);
        $text = array_values($text);
    }
return $text;  
}
/* Function two is for replacing one letter in the whole array of $text with another letter */
// There are five arguments, $a,$b are the arrays which you want to change, $c,$d are the arrays which will be put in place of the replaced one.
// $merge can take two values. 0 will mean that the whole $text will be replaced with the new replaced values. Used in case of mandatory Adezas.
// 1 will mean that $text will not be replaced, but the replaced values will be added to it. Used in case of optional Adezas.
// 2 = without + sign, mandatory (apadAnta etc)
// 3 = without + sign, optional
// 4 = with + sign only, mandatory (padAnta etc)
// 5 = with + sign only, optional.
function two($a,$b,$c,$d,$merge)
{
    global $text;
    for ($z=0;$z<count($text);$z++)
    {$p = $text[$z];
          for($i=0;$i<count($a);$i++)
          {
           for($j=0;$j<count($b);$j++)
                {
                if($merge<2)
                {
                $p =  str_replace($a[$i].$b[$j],$c[$i].$d[$j],$p);   
                $p =  str_replace($a[$i]."+".$b[$j],$c[$i]."+".$d[$j],$p); 
                }
                elseif ($merge<4)
                {
                $p =  str_replace($a[$i].$b[$j],$c[$i].$d[$j],$p);                       
                }
                else
                {
                $p =  str_replace($a[$i]."+".$b[$j],$c[$i]."+".$d[$j],$p);                                           
                }
                }
          }
     $text1[$z]  = $p;      
    }
if (($merge === 0) || ($merge === 2) ||($merge === 4) )
    {
        $text2 = $text1;
        $text2 = array_unique($text2);
        $text2 = array_values($text2);
    }
if (($merge === 1) || ($merge === 3) ||($merge === 5) )
    {
        $text2 = array_merge($text,$text1);
        $text2 = array_unique($text2);
        $text2 = array_values($text2);
    }
    return $text2;
}

/* Function three is for replacing one letter in the whole array of $text with another letter */
// There are seven arguments, $a,$b,$c are the arrays which you want to change, $d,$e,$f are the arrays which will be put in place of the replaced one.
// $merge can take two values. 0 will mean that the whole $text will be replaced with the new replaced values. Used in case of mandatory Adezas.
// 1 will mean that $text will not be replaced, but the replaced values will be added to it. Used in case of optional Adezas.
function three($a,$b,$c,$d,$e,$f,$merge)
{global $text;
   for ($z=0;$z<count($text);$z++)
    {$p = $text[$z]; 
     for($i=0;$i<count($a);$i++)
    {
    for($j=0;$j<count($b);$j++)
        {
        for($k=0;$k<count($c);$k++)
            {
            $p =  str_replace($a[$i].$b[$j].$c[$k],$d[$i].$e[$j].$f[$k],$p);       
           $p =  str_replace($a[$i]."+".$b[$j].$c[$k],$d[$i]."+".$e[$j].$f[$k],$p);       
           $p =  str_replace($a[$i].$b[$j]."+".$c[$k],$d[$i].$e[$j]."+".$f[$k],$p);       
           $p =  str_replace($a[$i]."+".$b[$j]."+".$c[$k],$d[$i]."+".$e[$j]."+".$f[$k],$p);       
            }
        }
    }
    $text1[$z] = $p;
    }
    if ($merge === 0)
    {
        $text = $text1;
        $text = array_unique($text);
        $text = array_values($text);
    }
    if ($merge === 1)
    {
        $text = array_merge($text,$text1);
        $text = array_unique($text);
        $text = array_values($text);
    }
    return $text;
}


/* function flatten is a function to flatten a multidimentional array */
function flatten(array $array) 
{
    $return = array();
    array_walk_recursive($array, function($a) use (&$return) { $return[] = $a; });
    return $return;
}

/* function savarna is to find out savarNa of a character from the given pratyAhAra */
// Actual function to find out the savarNa of a character from the given pratyAhAra. e.g. savarNa("a",prat('ac')) will give 
// savarNa of letter 'a' from the pratyAhAra 'ac'.
function savarna($inarray,$array) // Known issue - words having two Asyas.
{
for($z=0;$z<count($inarray);$z++)
{
$text = $inarray[$z];    
    global $kantha,$talu,$murdha,$danta,$oshtha,$nasika,$kanthatalu,$kanthoshtha,$dantoshtha,$sprushta,$ishatsprushta,$vivruta,$samvruta,$aghosha,$alpaprana,$ghosha,$mahaprana,$ac,$udatta,$anudatta,$svarita,$shvasa,$nada,$vivara,$samvara,$hl,$ru,$e;
    // defining an array for sthAna
$i=0;
if (in_array($text,$kantha)) { $sthana[$i] = $kantha; $i++; }
if (in_array($text,$talu)) { $sthana[$i] =  $talu; $i++; }
if (in_array($text,$murdha)) { $sthana[$i] = $murdha; $i++; }
if (in_array($text,$danta)) { $sthana[$i] = $danta; $i++; }
if (in_array($text,$oshtha)) { $sthana[$i] = $oshtha; $i++; }
if (in_array($text,$nasika)) { $sthana[$i] = $nasika; $i++; }
if (in_array($text,$kanthatalu)) { $sthana[$i] = $kanthatalu; $i++; }
if (in_array($text,$kanthoshtha)) { $sthana[$i] = $kanthoshtha; $i++;}
if (in_array($text,$dantoshtha)) { $sthana[$i] = $dantoshtha; $i++; }
// defining an array for Abhyantara prayatna for consonants
$j=0;
if (in_array($text,$sprushta)) { $abhyantara[$j] = $sprushta; $j++; }
if (in_array($text,$ishatsprushta)) { $abhyantara[$j] = $ishatsprushta; $j++; }
if (in_array($text,$vivruta)) { $abhyantara[$j] = $vivruta; $j++; }
if (in_array($text,$samvruta)) { $abhyantara[$j] = $samvruta; $j++; }
// defining an array for bAhya prayatna for consonants
$k=0;
if (in_array($text,$aghosha)) { $ghosh[$k] = $aghosha; $k++; }
if (in_array($text,$alpaprana)) { $prana[$k] = $alpaprana; $k++; }
if (in_array($text,$ghosha)) { $ghosh[$k] = $ghosha; $k++; }
if (in_array($text,$mahaprana)) { $prana[$k] = $mahaprana; $k++; }
// defining an array for bAhya prayatna of vowels
$u=0;
if (in_array($text,$ac)) { $svar[$u] = $udatta; $u++; }

// Finding out intersections of sthAna, Abhyantara prayatna and bAhya prayatnas of the given letter and the given array. 
if(empty($sthana)===FALSE)
{
$sthanasamya = array_intersect(flatten($sthana),$array); 
//echo "The letters in the pratyAhAra with same sthAna (Asya) as the letter input are: ".implode(",",$sthanasamya)."</br>";    
}
if(empty($abhyantara)===false)
{
$abhyantarasamya = array_intersect(flatten($abhyantara),$array);
//echo "The letters in the pratyAhAra with the same Abhyantara prayatna as the letter input are: ".implode(",",$abhyantarasamya)."</br>";    
}
if(empty($ghosh)===FALSE)
{
$ghoshasamya = array_intersect(flatten($ghosh),$array);
//echo "The letters in the pratyAhAra with the same ghoSa as the letter input are: ".implode(",",$ghoshasamya)."</br>";    
}
if(empty($prana)===FALSE)
{
$pranasamya = array_intersect(flatten($prana),$array);
//echo "The letters in the pratyAhAra with the same prANa as the letter input are: ".implode(",",$pranasamya)."</br>";    
}
if(empty($svar)===false)
{
if(in_array($text,$ac)) { $svarasamya = array_intersect(flatten($svar),$array,$ac); 
//echo "The letters in the pratyAhAra with the same udAtta/anudAtta/svarita as the letter input are: ".implode(",",$svarasamya)."</br>";
}    
}

$l = array_intersect($sthanasamya,$abhyantarasamya,$ghoshasamya,$pranasamya);
$m = array_intersect($sthanasamya,$abhyantarasamya,$ghoshasamya);
$n = array_intersect($sthanasamya,$abhyantarasamya);
$o = array_intersect($sthanasamya,$abhyantarasamya,$pranasamya);
$p = array_intersect($sthanasamya,$ghoshasamya);
$q = array_intersect($sthanasamya,$pranasamya);
// Defining savarNas for consonants
if(in_array($text,$hl))
{
    if(empty($sthanasamya)===false&&empty($abhyantarasamya)===false&&empty($ghoshasamya)===false&&empty($pranasamya)===FALSE&&empty($l)===false) 
    {//echo "four match";
            $savarna = implode(", ",$l);     
    }
    elseif (empty($sthanasamya)===false&&empty($abhyantarasamya)===false&&empty($ghoshasamya)===false&&empty($m)===false)
    {//echo "three match";
            $savarna = implode(", ",$m);     
    }
    elseif (empty($sthanasamya)===false&&empty($abhyantarasamya)===false&&empty($pranasamya)===false&&empty($o)===false)
    {//echo "three match";
            $savarna = implode(", ",$o);     
    }
    elseif (empty($sthanasamya)===false&&empty($abhyantarasamya)===false&&empty($n)===false)
    {//echo "Two match";
            $savarna = implode(", ",$n);     
    }
     elseif (empty($sthanasamya)===false&&empty($ghoshasamya)===false&&empty($p)===false)
    {//echo "Two match";
            $savarna = implode(", ",$p);     
    } elseif (empty($sthanasamya)===false&&empty($pranasamya)===false&&empty($q)===false)
    {//echo "Two match";
            $savarna = implode(", ",$q);     
    }
    else
    {//echo "no match";
    $savarna = implode(", ",$sthanasamya);    
    }
} 
// defining savarNas for vowels
else
{  
    if (in_array($text,$ru)||in_array($text,$e))
    {// patch for $ru
        for($i=0;$i<4;$i++)
        {
        if ($text === $ru[$i])
        {
            if (in_array($text,$array))
            { $savarna = "f, F, x, X"; }
            else
            { $savarna = ""; }
        }
        // patch for non sAvarNya of e,E,o,O
        elseif ($text === $e[$i])
        {
            if (in_array($text,$array))
            { $savarna = $text; }
            else
            { $savarna = ""; }
        }
        }
    }
    
    
    else 
    {// In case of other vowels.
        $savarna = implode(", ",$sthanasamya);
    }

}
// giving output to the browser for savarNa letter
//echo "The savarna letter of '".$text."' among the given pratyAhAra is: ";    
// stores that savarNa letter in memory.
$arr[$z] =  $savarna;
}
return $arr;
}

/* function display will show the text on screen. */
// There are three arguments. 0 will simply display the message. 
// 1 will show an additional message in dvitva. 
// 2 is used only once in the code, where there were two optional forms.
// 3 is for aGgAdhikAra.
// 4 is for yaNaH pratiSedho vAcyaH in case of yaN.
// 5 is for sarvAdeza.
// 6 is for bhasya adhikAra.
// 7 is for padasya, padAt, anudAttaM sarvamapAdAdau adhikAra.

function display($n)
{global $text;
    if ($n === 1) 
        {
        echo "<p class = hn>Please note: Wherever there is dvitva, it is optionally negated by sarvatra zAkalyasya. (8.4.51)</p>";
        echo "<p class = hn>द्वित्व का सर्वत्र सर्वत्र शाकल्यस्य (८.४.५१) से पाक्षिक निषेध होता है ।</p>";
        }
    if ($n === 2) 
        { 
        global $text1; $text2 = $text; $text = $text1; 
        }
    if ($n === 3) 
        {
        echo "<p class = pa>yasmAtpratyayavidhistadAdi pratyaye'Ggam (2.4.13) and aGgasya (6.4.1) </p>";
        echo "<p class = pa>यस्मात्प्रत्ययविधिस्तदादि प्रत्ययेऽङ्गम्‌ (२.४.१३) तथा अङ्गस्य (६.४.१) </p>";
        }
    if ($n === 4) 
        {
        echo "<p class = hn>N.B.: yaNaH pratiSedho vAcyaH (vA 4806) prevents application of saMyogAntasya lopaH (8.2.23) </p>";
        echo "<p class = hn>यणः प्रतिषेधो वाच्यः (वा ४८०६) से संयोगान्तस्य लोपः (८.२.२३) का निषेध होता है ।</p>";
        }
    if ($n === 5) 
        {
        echo "<p class = hn>N.B.: anekAlzitsarvasya (1.1.55) mandates sarvAdeza.  </p>";
        echo "<p class = hn>अनेकाल्शित्सर्वस्य (१.१.५५) से सर्वादेश होता है ।</p>";
        }
    if ($n === 6) 
        {
        echo "<p class = pa>yasmAtpratyayavidhistadAdi pratyaye'Ggam (2.4.13) aGgasya (6.4.1) and bhasya (6.4.129) :</p>";
        echo "<p class = pa>यस्मात्प्रत्ययविधिस्तदादि प्रत्ययेऽङ्गम्‌ (२.४.१३), अङ्गस्य (६.४.१) तथा भस्य (६.४.१२९) :</p>";
        }
    if ($n === 7) 
        {
        echo "<p class = pa>padasya (8.1.16), padAt (8.1.17) and anudAttaM sarvamapAdAdau (8.1.18) :</p>";
        echo "<p class = pa>पदस्य (८.१.१६), पदात्‌ (८.१.१७) तथा अनुदात्तं सर्वमपादादौ (८.१.१८) :</p>";
        }
    for($i=1;$i<count($text)+1;$i++)
    {
        echo "<p class = form>$i - ".convert($text[$i-1])."</p>";
    }
    echo "<hr>";
    if ($n === 2) { $text1 = $text; $text = $text2; } 
    
}


/* function dvitva will be used to duplicate a letter */
// It has six arguments, first four arguments are the arrays which need to be replaced. 
// $location is to specify which of these 4 consecutive arrays is to be duplicated. e.g. 2 will mean that the second member will be duplicated.
// $merge is to specify whether to replace (0) or add (1) to the existing array. 0 is used for mandatory dvitva and 1 is used for optional dvitva.
function dvitva ($kantha,$talu,$murdha,$oshtha,$location,$merge)
{ 
 global $text;   
// this is an array of the input values to use below 
 // get all possible combianations of $kantha+$talu+$murdha
//$combinations = get_string_combinations(); 
   $combinations = array(); 
     foreach($kantha as $k) // "a","k","g","n","h"
     { 
        foreach($talu as $t) // "i","c","j","y","s"
        { 
            foreach($murdha as $m) // "f","w","q","r","z"
            {
                foreach ($oshtha as $o)
                {
                 $combinations[] = $k.$t.$m.$o;    
                }
            } 
        } 
     } 

$values1 = array();
foreach ($text as $stti => $string)  // 'aifkcwh', 'aifkcwhsz', 'kim', 'aif'
{
    $values = array($string);  
       reset($values); 
  // loop through $values using an array pointer 
    // while the current array pointer position is not null/false
    while(current($values)!==false)
    {
        // on the first iteration, $values will be the inputted string 
        // from $strings_to_test... our example is "aifkcwh"
        $value = current($values); 
        if ($merge === 1)
        {
        $values1[] = current($values);
        }
        // for each possible combination of $kantha.$talu.$murdha
        // let's say our first combination is "aif"
        foreach($combinations as $ci => $combination)
        {  
            // look and see if the current value we are looking
            // at ("aifkcwh") contains this combination string  
            if (strpos($value,$combination)!==false)
            { 
                // if it does... we perform the string mutation
                // "aif" does exist in the string "aifkcwh"

                // get the second letter in the combination string
               // echo $combination. "These are combinations </br>";
                $single = $combination[$location-1];   // i 

                // double that second letter
                $post = substr($combination,$location-1);
                // echo $post. "These are posts </br>";
                $pre = chop($combination,$post);
                // echo $pre. "These are pres </br>";
                // create a new string that is the combination with the 
                // second letter doubled... 
                $newcom = $pre.$combination[$location-1].$post;
               // echo $newcom."These are newcoms </br> ";
                // replace that string in $values so that
                // aifkcwh becomes aiifkcwh
                $newval = str_replace($combination, $newcom, $value); // aiifkcwh

                // does the new value ("aiifkcwh") exist in $values?  
                // have we already recorded this mutation?  
                if (!in_array($newval,$values1)) 
                { 
                    // if not... append it to the array $values
                    $values1[] = $newval; 
                    // now, values would go from being = array([0]=>'aifkcwh'); 
                    // to array ([ 0] => 'aifkcwh', [1] => 'aiifkcwh' ); 
                }
                else 
                {
                }
            } 
        } // <-- end of the foreach statement, this will go through all combinations 
          //     in our combinations array for this particular value which is currently aifkcwh


        // next($values) increments the array pointer so that we move to the next
        // value in the $values array.  since we just added a value, 
        // $values now contains array ([ 0] => 'aifkcwh', [1] => 'aiifkcwh' ); 

        // before this statement index 0, current($values) == 'aifkcwh'
        next($values);  
        // after this statement index 1, current($values) == 'aiifkcwh'
        // for the next loop, we will test this string for all the combinations
        // if there is no next value, the `while` loop will end 
    }  

    // after we have gone through every possible combination for "aifkcwh",
    // we will have something like this: 
    /*
        Array
          (
                [0] => aifkcwh
                [1] => aiifkcwh
                [2] => aifkccwh
                [3] => aiifkccwh
          )
    */
    // and we add that to the $output array that contains an index for 
    // each input string, which contains all possible mutations of that string 
    $output[$string] = $values1; 
}

$output = flatten($output);
$output = array_unique($output);
$output = array_values($output);

return $output;
}





/* function lopa is not used in the code because it is not stable */
function lopa ($kantha,$talu,$murdha,$oshtha,$location,$merge)
{ 
 global $text;   
// this is an array of the input values to use below 


 // get all possible combianations of $kantha+$talu+$murdha
//$combinations = get_string_combinations(); 
   $combinations = array(); 

     foreach($kantha as $k) // "a","k","g","n","h"
     { 
        foreach($talu as $t) // "i","c","j","y","s"
        { 
            foreach($murdha as $m) // "f","w","q","r","z"
            {
                foreach ($oshtha as $o)
                {
                 $combinations[] = $k.$t.$m.$o;    
                }
            } 
        } 
     } 
//print_r($combinations);
$values1 = array();
foreach ($text as $stti => $string)  // 'aifkcwh', 'aifkcwhsz', 'kim', 'aif'
{

    $values = array($string);  
    
    reset($values); 


    // loop through $values using an array pointer 
    // while the current array pointer position is not null/false
    while(current($values)!==false)
    {
        // on the first iteration, $values will be the inputted string 
        // from $strings_to_test... our example is "aifkcwh"
        $value = current($values); 
        
       if ($merge === 1)
        {
        $values1[] = current($values);
        } 
        // for each possible combination of $kantha.$talu.$murdha
        // let's say our first combination is "aif"
        foreach($combinations as $ci => $combination)
        {  
            // look and see if the current value we are looking
            // at ("aifkcwh") contains this combination string  
            if (strpos($value,$combination)!==false)
            {   $posterior = substr($value,strpos($value,$combination)+$location+2);
                $previous = chop($value,$posterior);
                $previous = substr($previous,0,strlen($previous)); 
                $newval = $previous.$posterior; 
               // echo $value."<br>".$combination."</br>".$previous."</br>".$posterior."</br>";
                // have we already recorded this mutation?  
                if (!in_array($newval,$values1)) 
                { 
                    // if not... append it to the array $values
                    $values1[] = $newval; 
                    // now, values would go from being = array([0]=>'aifkcwh'); 
                    // to array ([ 0] => 'aifkcwh', [1] => 'aiifkcwh' ); 
                }
                else 
                {
                }
            } 
        } // <-- end of the foreach statement, this will go through all combinations 
          //     in our combinations array for this particular value which is currently aifkcwh
        next($values);  
    }  

    $output[$string] = $values1;
}
// print_r($output);
$output = flatten($output);
$output = array_unique($output);
$output = array_values($output);

return $output;
}

function nosavarna($c)
{
    global $ac;
     $i = array("i","I");$u = array("u","U");$f = array("f","F","x","X");
    
    if ( $c === $i[0] ) {$non = array_diff($ac, $i);}
    if ( $c === $i[1] ) {$non = array_diff($ac, $i);}
    if ( $c === $u[0] ) {$non = array_diff($ac, $u);}
    if ( $c === $u[1] ) {$non = array_diff($ac, $u);}
    if ( $c === $f[0] ) {$non = array_diff($ac, $f);}
    if ( $c === $f[1] ) {$non = array_diff($ac, $f);}
    if ( $c === $f[2] ) {$non = array_diff($ac, $f);}
    if ( $c === $f[3] ) {$non = array_diff($ac, $f);}
       return $non;
}
 
/* function get_string_combinations is a subset of the function dvitva and lopa */
 function get_string_combinations()
 {
     $kantha = array("a","k","g","n","h");
     $talu   = array("i","c","j","y","s");
     $murdha = array("f","w","q","r","z");

     $combinations = array(); 

     foreach($kantha as $k) // "a","k","g","n","h"
     { 
        foreach($talu as $t) // "i","c","j","y","s"
        { 
            foreach($murdha as $m) // "f","w","q","r","z"
            {
                $combinations[] = $k.$t.$m; 
            } 
        } 
     } 
     // this gives us an array if 125 items 
     /*
     $combinations = 
        Array
        (
             [0] => aif
             [1] => aiw
             [2] => aiq
             [3] => air
             [4] => aiz
             .... 
             [121] => hsw
             [122] => hsq
             [123] => hsr
             [124] => hsz
        ) 
     */
     return $combinations;
 }
 
/* function merge is not used in the code */
 function merge($text,$text1)
 {
     $text = array_merge($text,$text1);
    $text = array_unique($text);
    $text = array_values($text);
    return $text;
 }
/* function flat is used to make an array useful for regular expressions */
 function flat($array)
 {
     $array = "'".implode("",$array)."'";
     return $array;
 }
/* function blank will return an array having n blank members. blank(2) === array("",""); */
 function blank($n)
 {
     $array = array();
     while(count($array)< $n+1)
     {
        array_push($array,"");
     }
     return $array;
 }
/* function blank1 will return an array having n members of $a. blank("a",2) === array("a","a"); */
 function blank1($a,$n)
 {
     $array = array();
     while(count($array)< $n+1)
     {
        array_push($array,$a);
     }
     return $array;
 }
 

/* function checkarray is used to see whether the sequence of $a,$b,$c,$d is found in any of the members of $text */ 
 function checkarray($a,$b,$c,$d)
 {
     global $text;
     $array = $text;
    $combinations = array();
     foreach ($a as $aa)
     {
         foreach ($b as $bb)
         {
             foreach ($c as $cc)
             {
                 foreach ($d as $dd)
                 {
                     $combinations[] = $aa.$bb.$cc.$dd;
                 }
             }
         }
     }
     $counter = array();
     for ($i=0;$i<count($array);$i++)
     {
         for($j=0;$j<count($combinations);$j++)
         {
             if(strpos($array[$i],$combinations[$j]) !== false)
             {
                 
                 $counter = 1;
                 break;
             }
             else
             {
                 $counter = 0;
             }  
            // echo $array[$i]."</br>".$combinations[$j]."</br>".$counter."</br>";
         }
           if ($counter === 1)
           {
               break;
           }
           else 
           {
               $counter = 0;
           }
        
     }
     return $counter;
 }



/* function sub is a modified version of checkarray. It searches for the consecutive occurences of $a,$b,$c in the members of array $text. 
 * $repeat 0 will mean that the sequence doesnt matter. 1 will mean that the sequence has to be the same.
 */ 
 function sub($a,$b,$c,$repeat)
{   
     global $text;
     $needle = array();
    // for different length and all combinations
    if($repeat !== 1)
    {
        foreach ($a as $aa)
        {
         foreach ($b as $bb)
         {
             foreach ($c as $cc)
             {
                 $needle[]=$aa.$bb.$cc;
                 $needle[]=$aa."+".$bb.$cc;
                 $needle[]=$aa.$bb."+".$cc;
                 $needle[]=$aa."+".$bb."+".$cc;
             }
         }
        }
    }
    // for similar length arrays and ordered combinations.
    if ($repeat === 1)
    {
        for($i=0;$i<count($a);$i++)
        {
            $needle[] = $a[$i].$b[$i].$c[$i];
            $needle[] = $a[$i]."+".$b[$i].$c[$i];
            $needle[] = $a[$i].$b[$i]."+".$c[$i];
            $needle[] = $a[$i]."+".$b[$i]."+".$c[$i];
        }
    }
    /*** map with preg_quote ***/
    $needle = array_map('preg_quote', $needle); 
    /*** loop of the array to get the search pattern ***/
    global $first;
    foreach ($needle as $pattern)
    { 
        if (($repeat <2 && count(preg_grep("/$pattern/", $text)) >0) || ($repeat ===2 && strpos(strrev($first), strrev($pattern)) === 0) || ($repeat ===3 && strpos($first,$pattern) === 0) || ($repeat ===4 && strpos(strrev($second), strrev($pattern)) === 0) || ($repeat ===5 && strpos($second,$pattern) === 0))
        {
        $can = 1;
        break;
        }  
        else
        {
            $can = 0;
        }
    }
if ($can === 1)
{
    return true;
}
else
{
    return false;
}

}

/* Function to find savarna of a given letter from the given array. */
function sl($text,$array) // Known issue - words having two Asyas.
{
    global $kantha,$talu,$murdha,$danta,$oshtha,$nasika,$kanthatalu,$kanthoshtha,$dantoshtha,$sprushta,$ishatsprushta,$vivruta,$samvruta,$aghosha,$alpaprana,$ghosha,$mahaprana,$ac,$udatta,$anudatta,$svarita,$shvasa,$nada,$vivara,$samvara,$hl,$ru,$e;
    // defining an array for sthAna
$i=0;
if (in_array($text,$kantha)) { $sthana[$i] = $kantha; $i++; }
if (in_array($text,$talu)) { $sthana[$i] =  $talu; $i++; }
if (in_array($text,$murdha)) { $sthana[$i] = $murdha; $i++; }
if (in_array($text,$danta)) { $sthana[$i] = $danta; $i++; }
if (in_array($text,$oshtha)) { $sthana[$i] = $oshtha; $i++; }
if (in_array($text,$nasika)) { $sthana[$i] = $nasika; $i++; }
if (in_array($text,$kanthatalu)) { $sthana[$i] = $kanthatalu; $i++; }
if (in_array($text,$kanthoshtha)) { $sthana[$i] = $kanthoshtha; $i++;}
if (in_array($text,$dantoshtha)) { $sthana[$i] = $dantoshtha; $i++; }
// defining an array for Abhyantara prayatna for consonants
$j=0;
if (in_array($text,$sprushta)) { $abhyantara[$j] = $sprushta; $j++; }
if (in_array($text,$ishatsprushta)) { $abhyantara[$j] = $ishatsprushta; $j++; }
if (in_array($text,$vivruta)) { $abhyantara[$j] = $vivruta; $j++; }
if (in_array($text,$samvruta)) { $abhyantara[$j] = $samvruta; $j++; }
// defining an array for bAhya prayatna for consonants
$k=0;
if (in_array($text,$aghosha)) { $ghosh[$k] = $aghosha; $k++; }
if (in_array($text,$alpaprana)) { $prana[$k] = $alpaprana; $k++; }
if (in_array($text,$ghosha)) { $ghosh[$k] = $ghosha; $k++; }
if (in_array($text,$mahaprana)) { $prana[$k] = $mahaprana; $k++; }
// defining an array for bAhya prayatna of vowels
$u=0;
if (in_array($text,$ac)) { $svar[$u] = $udatta; $u++; }

// Finding out intersections of sthAna, Abhyantara prayatna and bAhya prayatnas of the given letter and the given array. 
if(empty($sthana)===FALSE)
{
$sthanasamya = array_intersect(flatten($sthana),$array); 
//echo "The letters in the pratyAhAra with same sthAna (Asya) as the letter input are: ".implode(",",$sthanasamya)."</br>";    
}
if(empty($abhyantara)===false)
{
$abhyantarasamya = array_intersect(flatten($abhyantara),$array);
//echo "The letters in the pratyAhAra with the same Abhyantara prayatna as the letter input are: ".implode(",",$abhyantarasamya)."</br>";    
}
if(empty($ghosh)===FALSE)
{
$ghoshasamya = array_intersect(flatten($ghosh),$array);
//echo "The letters in the pratyAhAra with the same ghoSa as the letter input are: ".implode(",",$ghoshasamya)."</br>";    
}
if(empty($prana)===FALSE)
{
$pranasamya = array_intersect(flatten($prana),$array);
//echo "The letters in the pratyAhAra with the same prANa as the letter input are: ".implode(",",$pranasamya)."</br>";    
}
if(empty($svar)===false)
{
if(in_array($text,$ac)) 
        { $svarasamya = array_intersect(flatten($svar),$array,$ac); 
//echo "The letters in the pratyAhAra with the same udAtta/anudAtta/svarita as the letter input are: ".implode(",",$svarasamya)."</br>";
        }    
}
if(empty($sthanasamya)===false && empty($abhyantarasamya)===false && empty($ghoshasamya)===false && empty($pranasamya)===false)
{ $l = array_intersect($sthanasamya,$abhyantarasamya,$ghoshasamya,$pranasamya); }
if(empty($sthanasamya)===false && empty($abhyantarasamya)===false && empty($ghoshasamya)===false)
{ $m = array_intersect($sthanasamya,$abhyantarasamya,$ghoshasamya); }
if(empty($sthanasamya)===false && empty($abhyantarasamya)===false)
{ $n = array_intersect($sthanasamya,$abhyantarasamya); }
if(empty($sthanasamya)===false && empty($abhyantarasamya)===false && empty($pranasamya)===false)
{ $o = array_intersect($sthanasamya,$abhyantarasamya,$pranasamya); }
if(empty($sthanasamya)===false && empty($ghoshasamya)===false)
{ $p = array_intersect($sthanasamya,$ghoshasamya); }
if(empty($sthanasamya)===false && empty($pranasamya)===false)
{ $q = array_intersect($sthanasamya,$pranasamya); }
// Defining savarNas for consonants
if(in_array($text,$hl))
{
    if(empty($sthanasamya)===false&&empty($abhyantarasamya)===false&&empty($ghoshasamya)===false&&empty($pranasamya)===FALSE&&empty($l)===false) 
    {//echo "four match";
            $savarna = implode(", ",$l);     
    }
    elseif (empty($sthanasamya)===false&&empty($abhyantarasamya)===false&&empty($ghoshasamya)===false&&empty($m)===false)
    {//echo "three match";
            $savarna = implode(", ",$m);     
    }
    elseif (empty($sthanasamya)===false&&empty($abhyantarasamya)===false&&empty($pranasamya)===false&&empty($o)===false)
    {//echo "three match";
            $savarna = implode(", ",$o);     
    }
    elseif (empty($sthanasamya)===false&&empty($abhyantarasamya)===false&&empty($n)===false)
    {//echo "Two match";
            $savarna = implode(", ",$n);     
    }
     elseif (empty($sthanasamya)===false&&empty($ghoshasamya)===false&&empty($p)===false)
    {//echo "Two match";
            $savarna = implode(", ",$p);     
    } elseif (empty($sthanasamya)===false&&empty($pranasamya)===false&&empty($q)===false)
    {//echo "Two match";
            $savarna = implode(", ",$q);     
    }
    else
    {//echo "no match";
    $savarna = implode(", ",$sthanasamya);    
    }
} 
// defining savarNas for vowels
else
{  
    if (in_array($text,$ru)||in_array($text,$e))
    {// patch for $ru
        for($i=0;$i<4;$i++)
        {
        if ($text === $ru[$i])
        {
            if (in_array($text,$array))
            { $savarna = "f, F, x, X"; }
            else
            { $savarna = ""; }
        }
        // patch for non sAvarNya of e,E,o,O
        elseif ($text === $e[$i])
        {
            if (in_array($text,$array))
            { $savarna = $text; }
            else
            { $savarna = ""; }
        }
        }
    }
    
    
    else 
    {// In case of other vowels.
        $savarna = implode(", ",$sthanasamya);
    }
    
    if (in_array($text,$array))
    {
        $savarna = $text;
    }
}
// giving output to the browser for savarNa letter
//echo "The savarna letter of '".$text."' among the given pratyAhAra is: ".$savarna;    
// stores that savarNa letter in memory.
return $savarna;
}


/* Function one is for replacing one letter in the whole array of $text with another letter */
// There are three arguments, $a is the array which you want to change, $b is the array which will be put in place of the replaced one.
// $merge can take two values. 0 will mean that the whole $text will be replaced with the new replaced values. Used in case of mandatory Adezas.
// 1 will mean that $text will not be replaced, but the replaced values will be added to it. Used in case of optional Adezas.
function one1($text,$a,$b,$merge)
{
        for($i=0;$i<count($a);$i++)
        {
            $text =  str_replace($a[$i],$b[$i],$text);    
        }
return $text;  
}
/* Function two is for replacing one letter in the whole array of $text with another letter */
// There are five arguments, $a,$b are the arrays which you want to change, $c,$d are the arrays which will be put in place of the replaced one.
// $merge can take two values. 0 will mean that the whole $text will be replaced with the new replaced values. Used in case of mandatory Adezas.
// 1 will mean that $text will not be replaced, but the replaced values will be added to it. Used in case of optional Adezas.
function two1($text,$a,$b,$c,$d,$merge)
{
    for($i=0;$i<count($a);$i++)
          {
    for($j=0;$j<count($b);$j++)
            {
      $text =  str_replace($a[$i].$b[$j],$c[$i].$d[$j],$text);   
            }
          }
    return $text;
}

/* Function three is for replacing one letter in the whole array of $text with another letter */
// There are seven arguments, $a,$b,$c are the arrays which you want to change, $d,$e,$f are the arrays which will be put in place of the replaced one.
// $merge can take two values. 0 will mean that the whole $text will be replaced with the new replaced values. Used in case of mandatory Adezas.
// 1 will mean that $text will not be replaced, but the replaced values will be added to it. Used in case of optional Adezas.
function three1($text,$a,$b,$c,$d,$e,$f,$merge)
{
     for($i=0;$i<count($a);$i++)
    {
    for($j=0;$j<count($b);$j++)
        {
        for($k=0;$k<count($c);$k++)
            {
         $text =  str_replace($a[$i].$b[$j].$c[$k],$d[$i].$e[$j].$f[$k],$text);       
            }
        }
    }
    return $text;
}

/* function to search the occurence of a pattern in any of the member of an array */
function arr($text,$a)
{
    foreach ($text as $value)
    {
        if (preg_match($a,$value))
        {
            $count[] = 1;
            break;
        }
        else 
        {
            $count[] = 0;
        }
    }
    if (in_array(1,$count))
    {
        return true;
    }
    else
    {
        return false;
    }
}

/* function to remove the last n letters from a word in the $text array and replace them with another word */
// Write this function with a fresh mind. It is going all wrong.
function last($a,$b,$merge)
{
    global $text;
    foreach ($text as $value)
    {
        for($i=0;$i<count($a);$i++)
        { $c = str_replace("\\","",$a[$i]);
            if (preg_match('/('.$a[$i].')$/',$value) || preg_match('/('.$c.')$/',$value))
            {
                $value1[] = substr($value,0,-strlen($a[$i])).$b[$i];
                if ($merge === 1)
                {
                    $value1[] = $value;
                }
            }
            else
            {
                $value1[] = $value;
            }
        }
        if (array_unique($value1)===array($value))
        {
            $value2[] = array_unique($value1);
        }
        elseif ($merge === 1)
        {
            $value2[] = array_unique($value1);
        }
        else
        {
            $value2[] = array_diff($value1,array($value));
        }
        $value1 = array();
    }
    $text = flatten($value2);
    $text = array_unique($text);
    $text = array_values($text);
    return $text;
}

/* function to remove the first n letters from a word in the $text array and replace them with another word */
function first($a,$b,$merge)
{
    global $text;
    foreach ($text as $value)
    {
        for($i=0;$i<count($a);$i++)
        {
            if (preg_match('/('.$a[$i].')$/',$value))
            {
                $value1[] = $b[$i].substr($value,strlen($a[$i]));
                if ($merge === 1)
                {
                    $value1[] = $value;
                }
            }
            else
            {
                $value1[] = $value;
            }
        }
        if (array_unique($value1)===array($value))
        {
            $value2[] = array_unique($value1);
        }
        elseif ($merge === 1)
        {
            $value2[] = array_unique($value1);
        }
        else
        {
            $value2[] = array_diff($value1,array($value));
        }
        $value1 = array();
    }
    $text = flatten($value2);
    $text = array_unique($text);
    $text = array_values($text);
    return $text;
}
/* vriddhi function */
function vriddhi($a)
{ $ac = array("a","A","i","I","u","U","f","F","x","X","e","o","E","O",);
  $acreplace = array("A","A","E","E","O","O","Ar","Ar","Al","Al","E","O","E","O",);
    foreach ($a as $value)
    {
        $out[] = str_replace($ac,$acreplace,$value);
    }
    return $out;
}
/* guna function */
function guna($a)
{ $ac = array("a","A","i","I","u","U","f","F","x","X","e","o","E","O",);
  $acreplace = array("a","a","e","e","o","o","ar","ar","al","al","e","o","e","o",);
    foreach ($a as $value)
    {
        $out[] = str_replace($ac,$acreplace,$value);
    }
    return $out;
}
/* dirgha function */
function dirgha($a)
{ $ac = array("a","A","i","I","u","U","f","F","x","X","e","o","E","O",);
  $acreplace = array("A","A","I","I","U","U","F","F","F","F","e","o","E","O",);
    foreach ($a as $value)
    {
        $out[] = str_replace($ac,$acreplace,$value);
    }
    return $out;
}

/* anekAca function */
function anekAca($a)
{
    $ac = array("a","A","i","I","u","U","f","F","x","X","e","o","E","O",);
    $b = preg_split('/['.flat($ac).']/',$a);
    if (count($b)>2)
    {
        return true; 
        //echo "1";
    }
    else
    {
        return false; 
        //echo "0";
    }
}
/* (ends) function */
// to find if there is any member of array which end in a particular member of another array.
// 0 -> doesn't start with but ends with it. 1 -> ends with it or is equal to it. 2 -> is equal to it.
function ends($a,$b,$n)
{
    foreach ($a as $aa)
    {
        foreach ($b as $bb)
        {
            if ($n===0)
            {
                if (strpos($aa,$bb)>0 && strpos(strrev($aa),strrev($bb)) ===0)
                {
                    $can[] = 1;
                }
                else
                {
                    $can[] = 0;
                }                
            }
            if ($n===1)
            {
                if (strpos($aa,$bb) >= 0 && strpos(strrev($aa),strrev($bb)) ===0)
                {
                    
		    $can[] = 1;
                }
                else
                {
                    $can[] = 0;
                }                
            }
            if ($n===2)
            {
                if ($aa===$bb)
                {
                    
		    $can[] = 1;
                }
                else
                {
                    $can[] = 0;
                }                
            }
        }
    }
    if (in_array(1,$can))
    {
        return true;
    }
    else
    {
        return false;
    }
}

/* function Ti to remove the Ti */
function Ti($merge)
{   
    global $text;
    $te1 = '/(['.pc('ac').'])(['.pc('hl').']*)([+])/';
    $te2 = '$3';
        foreach ($text as $value)
        {
            $val[] = preg_replace($te1,$te2,$value);
        }
        if ($merge===0)
        {
            $text = $val;
        }
        if ($merge === 1)
        {
            $text = array_merge($text,$val);
        }        
    $val=array();
    $text = array_unique($text);
    $text = array_values($text);
    return $text;
}

/* function mit */
// $pattern is the pattern to search in the word to add mit pratyaya.
// $b is the addition to upadha
// $merge 0 is replacement, 1 is optional.
function mit($pattern,$b,$merge)
{   global $text;
    $te1 = '/(['.pc('ac').'])(['.pc('hl').']*)([+])/';
    $te2 = '$1'.$b.'$2$3';
        foreach ($text as $value)
        {
            if (preg_match($pattern,$value))
            {
                $val[] = preg_replace($te1,'$1n$2$3',$value); 
            }
            else
            {
                $val[] = $value;
            }
        }        
        if ($merge===0)
        {
            $text = $val;
        }
        if ($merge === 1)
        {
            $text = array_merge($text,$val);
        }        
    $val=array();
    $text = array_unique($text);
    $text = array_values($text);
    return $text;
}
/* function samprasarana */
function samprasarana($a,$merge)
{
    $yan = array("y","v","r","l");
    $yanik = array("i","u","f","x");
    foreach ($a as $value)
    {
    $b[] = str_replace($yan,$yanik,$a);        
    }    
    return $b;
}
/* function samprasarana */
// $a to contain the array of it markers to check.
// $b. 0 for it. 1 for itprakriti. 2 for itpratyaya
function itcheck($a,$b)
{
    global $text; global $it; global $itprakriti; global $itpratyaya;
    if ($b===0)
    {
        if(count(array_intersect($it,$a))>0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    if ($b===1)
    {
        if(count(array_intersect($itprakriti,$a))>0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    if ($b===2)
    {
        if(count(array_intersect($itpratyaya,$a))>0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
}

/* function it (to find an it marker). The function adds the marker to its arrays. */
// $pattern is the pattern to look for
// $a 0 for finding it in the whole word. 1 for it in prakriti. 2 for it in pratyaya.
function it($pattern)
{
    global $text; global $it; global $itprakriti; global $itpratyaya;
        foreach ($text as $value)
        {
            $b = preg_split($pattern,$value,null,PREG_SPLIT_DELIM_CAPTURE);
            for($i=1;$i<((count($b)+1)/2);$i++)
            {
                $b[$i*2-1]= str_replace("!","",$b[$i*2-1]);
                $b[$i*2-1]= str_replace("+","",$b[$i*2-1]);
                $it = array_merge($it,array($b[$i*2-1]));
                $it = array_unique($it);
                $it = array_values($it);                
            }                   
        }
       foreach ($text as $value)
        {
            $c = explode("+",$value);
            $b = preg_split($pattern,$c[0],null,PREG_SPLIT_DELIM_CAPTURE);
            for($i=1;$i<((count($b)+1)/2);$i++)
            {
                $b[$i*2-1]= str_replace("!","",$b[$i*2-1]);
                $b[$i*2-1]= str_replace("+","",$b[$i*2-1]);
                $itprakriti = array_merge($itprakriti,array($b[$i*2-1]));
                $itprakriti = array_unique($itprakriti);
                $itprakriti = array_values($itprakriti);         
            }                   
        }
       foreach ($text as $value)
        {
            $c = explode("+",$value);
            $pattern = str_replace("[+]","^",$pattern); 
            $b = preg_split($pattern,$c[1],null,PREG_SPLIT_DELIM_CAPTURE);
            for($i=1;$i<((count($b)+1)/2);$i++)
            {
                $b[$i*2-1]= str_replace("!","",$b[$i*2-1]);
                $b[$i*2-1]= str_replace("+","",$b[$i*2-1]);
                $itpratyaya = array_merge($itpratyaya,array($b[$i*2-1]));
                $itpratyaya = array_unique($itpratyaya);
                $itpratyaya = array_values($itpratyaya);         
            }                   
        }
//        print_r($it);
//        print_r($itprakriti);
//        print_r($itpratyaya);
}
/* function to find out it markers when they can occur only in the pratayayas. */
function itprat($pattern)
{
    global $text; global $it; global $itprakriti; global $itpratyaya; 
       foreach ($text as $value)
        {
            $c = explode("+",$value);
            $b = preg_split($pattern,$c[1],null,PREG_SPLIT_DELIM_CAPTURE);
            for($i=1;$i<((count($b)+1)/2);$i++)
            {
                $b[$i*2-1]= str_replace("!","",$b[$i*2-1]);
                $b[$i*2-1]= str_replace("+","",$b[$i*2-1]);
                $itpratyaya = array_merge($itpratyaya,array($b[$i*2-1]));
                $itpratyaya = array_unique($itpratyaya);
                $itpratyaya = array_values($itpratyaya);         
            }                   
        }
//        print_r($it);
//        print_r($itprakriti);
//        print_r($itpratyaya);
}

/* function antya to do antyAdeza */
function antya($a,$rep)
{
    foreach ($a as $value)
    {
        $value1[] = substr($value,0,-1).$rep;
    }
    return $value1;
}

/* An attempt to create an all encompassing function 
 * name is panini
 * three arrays for checking,
 * one for adding additional checking in addition to sub function
 * one for adding whether pratyaya / pada
 *  one for the 0/1/2/3/4 etc of sub function, 
 * three for the substituted, 
 * three for substitution, 
 * one for 0/1 of one/two/three function,
 * one for english sutra name,
 * one for english sutra number
 * one for hindi sutra name,
 * one for hindi sutra number
 * 
 */
?>