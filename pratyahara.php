<html>
<body>

<?php
// Known issue: Needs better treatment of double occurence of -R.
$text = $_POST["pratya"];
$it = $_POST['it'];
echo "You entered: </br>".$text."</br>";
$shiv=array("a","i","u","-R","f","x","-k","e","o","-N","E","O","-c","h","y","v","r","-w","l","-R","Y","m","N","R","n","-m","J","B","-Y","G","Q","D","-z","j","b","g","q","d","-S","K","P","C","W","T","c","w","t","-v","k","p","-y","S","z","s","-r","h","-l");
$a = str_split($text);
$a[1] = str_replace($a[1],"-".$a[1],$a[1]);
$pratyahara = array_slice($shiv,array_search($a[0],$shiv),array_search($a[1],$shiv)-array_search($a[0],$shiv)+1);
$pratyahara = implode (" ",$pratyahara);
if ($it === "n")
{
$pratyahara = str_replace(" -R","</br>",$pratyahara);
$pratyahara = str_replace(" -k","</br>",$pratyahara);
$pratyahara = str_replace(" -N","</br>",$pratyahara);
$pratyahara = str_replace(" -c","</br>",$pratyahara);
$pratyahara = str_replace(" -w","</br>",$pratyahara);
$pratyahara = str_replace(" -m","</br>",$pratyahara);
$pratyahara = str_replace(" -Y","</br>",$pratyahara);
$pratyahara = str_replace(" -z","</br>",$pratyahara);
$pratyahara = str_replace(" -S","</br>",$pratyahara);
$pratyahara = str_replace(" -v","</br>",$pratyahara);
$pratyahara = str_replace(" -y","</br>",$pratyahara);
$pratyahara = str_replace(" -r","</br>",$pratyahara);
$pratyahara = str_replace(" -l","</br>",$pratyahara);
}
if ($it === "y")
{
$pratyahara = str_replace(" -R"," -R</br>",$pratyahara);
$pratyahara = str_replace(" -k"," -k</br>",$pratyahara);
$pratyahara = str_replace(" -N"," -N</br>",$pratyahara);
$pratyahara = str_replace(" -c"," -c</br>",$pratyahara);
$pratyahara = str_replace(" -w"," -w</br>",$pratyahara);
$pratyahara = str_replace(" -m"," -m</br>",$pratyahara);
$pratyahara = str_replace(" -Y"," -Y</br>",$pratyahara);
$pratyahara = str_replace(" -z"," -z</br>",$pratyahara);
$pratyahara = str_replace(" -S"," -S</br>",$pratyahara);
$pratyahara = str_replace(" -v"," -v</br>",$pratyahara);
$pratyahara = str_replace(" -y"," -y</br>",$pratyahara);
$pratyahara = str_replace(" -r"," -r</br>",$pratyahara);
$pratyahara = str_replace(" -l"," -l</br>",$pratyahara);
}

if ($text === "ra" && $it === "y")
{
echo "The pratyahara is:</br> r -w l</br>";
}
elseif ($text === "ra" && $it === "n")
{
echo "The pratyahara is:</br> r l</br>";
}
elseif ($text === "yR" && $it === "y")
{
echo "The pratyahara is:</br> y v r -w l -R</br>";
}
elseif ($text === "yR" && $it === "n")
{
echo "The pratyahara is:</br> y v r </br>l</br>";
}

elseif (in_array($text[1],$shiv)!==false)
{
echo "The pratyahara is: </br>".$pratyahara;
}
else
{
echo "This is not a valid pratyAhAra";
}

?>

</body>
</html>