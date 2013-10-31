<?php
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
$antastha = array("y","r","l","v");
$ushma = array("S","z","s","h");
$ru = array("f","F","x","X");
$ac = array("a","A","i","I","u","U","f","F","x","X","e","o","E","O",);
$hl = array("k","K","g","G","N","c","C","j","J","Y","w","W","q","Q","R","t","T","d","D","n","p","P","b","B","m","y","r","l","v","S","z","s","h");
$e = array("e","E","o","O");
$dirgha = array("A","I","U","F","X","e","E","o","O");
$hrasva = array("a","i","u","f","x");
       
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
function pc($text) // pratyAhAra check
{
$text = "'".implode("",prat($text))."'";
return $text;
}
function f($text,$n) // find 'n'th letter in the word
{
$p = str_split($text);
$text = $p[$n-1];
return $text;
}
function sa($text,$n)	// find string after removing 'n' letters from beginning of the word (sa for string after)
{
$p = str_split($text);
$a = "";
for ($q=0;$q<$n;$q++)
{ $text = ltrim($text,$p[$q]); }
return $text;
}
function r($text,$n) 		// find 'n'th letter from the end in a word (r for reverse direction)
{
$p = str_split($text);
$text = $p[count($p)-$n];
return $text;
}
function sb($text, $n)	// find the string remaining after removing n characters from the end (sb for string before)
{
$p = str_split($text);
$a= "";
for ($q=0;$q<$n;$q++)
{$text = chop($text,$p[count($p)-$q-1]);} 
return $text;
}
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
    }
    if ($merge === 1)
    {
        $text = array_merge($text,$text1);
        $text = array_unique($text);
        $text = array_values($text);
    }
return $text;  
}
function two($a,$b,$c,$d,$merge)
{
    global $text;
    for ($z=0;$z<count($text);$z++)
    {$p = $text[$z];
          for($i=0;$i<count($a);$i++)
          {
    for($j=0;$j<count($b);$j++)
            {
      $p =  str_replace($a[$i].$b[$j],$c[$i].$d[$j],$p);    
            }
          }
     $text1[$z]  = $p;      
    }
    if ($merge === 0)
    {
        $text = $text1;
    }
    if ($merge === 1)
    {
        $text = array_merge($text,$text1);
        $text = array_unique($text);
        $text = array_values($text);
    }
    return $text;
}

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
            }
        }
    }
    $text1[$z] = $p;
    }
    if ($merge === 0)
    {
        $text = $text1;
    }
    if ($merge === 1)
    {
        $text = array_merge($text,$text1);
        $text = array_unique($text);
        $text = array_values($text);
    }
    return $text;
}


// A function to flatten a multidimentional array
function flatten(array $array) 
{
    $return = array();
    array_walk_recursive($array, function($a) use (&$return) { $return[] = $a; });
    return $return;
}

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

// function to show the text on screen.
function display()
{global $text;
    for($i=1;$i<count($text)+1;$i++)
    {
        echo "$i : ".$text[$i-1]."</br>";
    }
    echo "</br>";
}


function dvitva($kantha,$talu,$murdha)
{
global $text;
$combinations = array(); 

// get all possible combianations of $kantha+$talu+$murdha
foreach($kantha as $ki => $k)
{ 
    foreach($talu as $ti => $t)
    { 
        foreach($murdha as $mi => $m)
        {
            $combinations[] = $k.$t.$m; 
        } 
    } 
}
$strings_to_test = $text; 
foreach ($strings_to_test as $stti => $string) 
{
    $values = array($string); 
    reset($values); 
    while(current($values)!==false)
    {
        $value = current($values); 
        foreach($combinations as $ci => $combination)
        { 
            if (strpos($value,$combination)!==false)
            {
                // found in string 
                $newval = do_string_replacements($value, $combination);  
                if (!in_array($newval,$values)) 
                {
                    $values[] = $newval; 
                }
            } 
        }
        next($values); 
    }  
    $output[] = $values; 
}

$output1 = flatten($output);
return $output1;
}

function do_string_replacements($value, $combination)
{
    $single = $combination[1];  
    $double = str_repeat($single, 2);    
    $newcom = str_ireplace($single, $double, $combination);   
    $newval = str_ireplace($combination, $newcom, $value);
    return $newval; 
} 

?>