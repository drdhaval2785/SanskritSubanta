<?php
// include function.php
include "function.php";
include "dev-slp.php";

// set execution time to an hour
ini_set('max_execution_time', 36000);
// set memory limit to 1000 MB
ini_set("memory_limit","1000M");
// input the words
$test = file("C:\\xampp\\htdocs\\sanskrit\\reverse-250026-dev.txt");

//$test = array("vfdDirAdEc");
// process to remove the consonants and vowels

$ap = array(" ",".","|",",","0","1","2","3","4","5","6","7","8","9","!","A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
$b = one1($test,$ap,blank(count($ap)),0);
$a = array_map('convert1',$b);
for($i=0;$i<count($a);$i++)
{
    $text = array($a[$i]);
    $text = one(array(" ",".","|",",","0","1","2","3","4","5","6","7","8","9","!"),blank(15),0);
    $text = two($ac,array("M","H"),blank(count($ac)),array("+","+"),0);
    $acextended = array_merge($ac,array("+")); 
    $text = three($acextended,$hl,$hl,blank1("+",count($acextended)),blank(count($hl)),blank(count($hl)),0);
    $text = three($ac,$hl,array(" "),blank1("+",count($ac)),$hl,array(" "),0);
    $text = one($dirgha,blank1("+",count($dirgha)),0);
    $text = one($hrasva,blank1("-",count($hrasva)),0);
    $text = one($hl,blank(count($hl)),0);
    $text = one(array("+","-"),array("G","L"),0);
    $text = one(array("\r\n","<br>","</br>","\n"),array("","","","",),0);
    $matra = 2*substr_count($text[0],"G") + substr_count($text[0],"L");
    $input[] = $test[$i].", ".$matra.", ".$text[0];  
}

$inputtext = implode("\r\n",$input);
$inputtext = str_replace("\r\n,","",$inputtext);
file_put_contents("C:\\one.txt",$inputtext);


?>