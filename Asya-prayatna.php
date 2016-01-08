<?php
$text = $_POST["letter"];
echo "You entered: ".$text."</br>";
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

// code part
$i=0;
if (in_array($text,$kantha)) { $sthana[$i] = "kantha"; $i++; }
if (in_array($text,$talu)) { $sthana[$i] =  "talu"; $i++; }
if (in_array($text,$murdha)) { $sthana[$i] = "murdha"; $i++; }
if (in_array($text,$danta)) { $sthana[$i] = "danta"; $i++; }
if (in_array($text,$oshtha)) { $sthana[$i] = "oshtha"; $i++; }
if (in_array($text,$nasika)) { $sthana[$i] = "nasika"; $i++; }
if (in_array($text,$kanthatalu)) { $sthana[$i] = "kanthatalu(kantha,talu)"; $i++; }
if (in_array($text,$kanthoshtha)) { $sthana[$i] = "kanthoshtha(kantha,oshtha)"; $i++;}
if (in_array($text,$dantoshtha)) { $sthana[$i] = "dantooshtha(danta,oshtha)"; $i++; }
$j=0;
if (in_array($text,$sprushta)) { $abhyantara[$j] = "sprushta"; $j++; }
if (in_array($text,$ishatsprushta)) { $abhyantara[$j] = "ishatsprushta"; $j++; }
if (in_array($text,$vivruta)) { $abhyantara[$j] = "vivruta"; $j++; }
if (in_array($text,$samvruta)) { $abhyantara[$j] = "samvruta"; $j++; }
$k=0;
if (in_array($text,$aghosha)) { $bahya[$k] = "aghosha"; $k++; }
if (in_array($text,$vivara)) { $bahya[$k] = "vivAra"; $k++; }
if (in_array($text,$shvasa)) { $bahya[$k] = "shvasa"; $k++; }
if (in_array($text,$alpaprana)) { $bahya[$k] = "alpaprana"; $k++; }
if (in_array($text,$ghosha)) { $bahya[$k] = "ghosha"; $k++; }
if (in_array($text,$samvara)) { $bahya[$k] = "samvara"; $k++; }
if (in_array($text,$nada)) { $bahya[$k] = "nada"; $k++; }
if (in_array($text,$mahaprana)) { $bahya[$k] = "mahaprana"; $k++; }
if (in_array($text,$ac)) { $bahya[$k] = "udatta"; $k++; }
if (in_array($text,$ac)) { $bahya[$k] = "anuudatta"; $k++; }
if (in_array($text,$ac)) { $bahya[$k] = "svarita"; $k++; }

$a = "The sthana is: ".implode(",",$sthana).".</br>"."The abhyantara prayatna is: ".implode(",",$abhyantara).".</br>"."The bahya prayatna is: ".implode(",",$bahya);

echo $a;

?>