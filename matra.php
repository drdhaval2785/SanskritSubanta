<?php
// include function.php
include "function.php";
include "dev-slp.php";

// set execution time to an hour
ini_set('max_execution_time', 36000);
// set memory limit to 1000 MB
ini_set("memory_limit","1000M");
// input the words
//$test = file("C:\\xampp\\htdocs\\sanskrit\\panini.txt");
$test = file_get_contents("C:\\xampp\\htdocs\\sanskrit\\panini.txt");
//$test = array("vfdDirAdEc");
// process to remove the consonants and vowels
$text = array_map('convert1',$test);
$text = one(array(" ",".","|",",","0","1","2","3","4","5","6","7","8","9","!"),blank(15),0);
$text = two($ac,array("M","H"),blank(count($ac)),array("+","+"),0);
$acextended = array_merge($ac,array("+")); 
$text = three($acextended,$hl,$hl,blank1("+",count($acextended)),blank(count($hl)),blank(count($hl)),0);
$text = three($ac,$hl,array(" "),blank1("+",count($ac)),$hl,array(" "),0);
$text = one($dirgha,blank1("+",count($dirgha)),0);
$text = one($hrasva,blank1("-",count($hrasva)),0);
$text = one($hl,blank(count($hl)),0);
$text = one(array("+","-"),array("G","L"),0);
for ($i=0;$i<count($text);$i++)
{
$matra[$i] = 2*substr_count($text[$i],"G") + substr_count($text[$i],"L");
}
for ($i=0;$i<count($text);$i++)
{
echo $test[$i].", ".$matra[$i].", ".$text[$i]."</br>";
}

?>
