<html>
<body>

<?php
// Including arrays and functions 
include "C://xampp//htdocs//sanskrit//function.php";
//include "C://xampp//htdocs//sanskrit//dvitva.php";
// set execution time to an hour
ini_set('max_execution_time', 36000);

// Reading from the HTML input.
$first = $_POST["first"];
$second = $_POST['second'];
// displaying the data back to the user
echo "You entered: ".$first." + ".$second."</br></br>";


/* main coding part starts from here.
 * Based on Siddhantakaumudi text.
 */
$text = array();
// joining the two words
$text[0] = (string)($first.$second); 
/*iko yaNaci (6.1.77) */
//$text = two(prat('ik'),prat('ac'),prat('yR'),prat('ac'),0);
echo "By iko yaNaci : </br>";
display();
/*anaci ca (8.4.47)*/ // Here the sudhI + upAsya - what about the Asy - Assy is possbile ? Code gives it. But there are 4 options. Code gives two only.
// The cause for using $hrasva instead of $ac is that the dIrgha vowels are debarred by dIrghAdAcAyANAm.
$text = dvitva($hrasva,prat('yr'),prat('hl'));
echo "By anaci ca : There are two options :</br>";
display();
/* jhalAM jaz jhaSi (8.4.53) */
$text = two(prat('Jl'),prat('Jz'),savarna(prat('Jl'),prat('jS')),prat('Jz'),0);
echo "By jhalAM jaz jhaSi : </br>";
display();
/* saMyogAntasya lopaH (8.2.23) */ // coding pending because not clear. And also 'yaNaH pratiSedho vAcyaH' prohibits its application.
/* yaNo mayo dve vAcye (vA 5018) yaN in paJcamI and may in SaSThI)*/
//$text = dvitva(prat('yR'),prat('my'),array(""));
echo "By yaNo mayo dve vAcye (yaN in paJcamI and may in SaSThI) :</br>";
display(); 
/* yaNo mayo dve vAcye (vA 5018) may in paJcamI and yaN in SaSThI)*/
//$text = dvitva(prat('my'),prat('yR'),array(""));
echo "By yaNo mayo dve vAcye (may in paJcamI and yaN in SaSThI) :</br>";
display();
/* nAdinyAkroze putrasya (8.4.48) */
if (preg_match('/[putra]$/',$first) && $second === "AdinI")
{
    echo "If Akroza is meant : The dvivacana doesn't happen. </br> Otherwise dvivacana will happen.</br>";
}
/* vA hatajagdhayoH (vA 5022) */
if (preg_match('/[putra]$/',$first) && $second === "hatI")
{
echo "By vA hatajagdhayoH : </br>";
display();
}
if (preg_match('/[putra]$/',$first) && $second === "jagDI")
{
echo "By vA hatajagdhayoH : </br>";
display();
}

?>
</body>
</html>