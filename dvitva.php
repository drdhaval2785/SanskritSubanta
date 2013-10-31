<?php
$kantha = array("a","A","k","K","g","G","N","h","H");
$talu = array("i","I","c","C","j","J","Y","y","S");
$murdha = array("f","F","w","W","q","Q","R","r","z");
$text = array("aifkcw","aif");


function dvitva($kantha,$talu,$murdha)
{global $text;
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

$output = flatten($output);
return $output;
}
function do_string_replacements($value, $combination)
{
    $single = $combination[1];  
    $double = str_repeat($single, 2);    
    $newcom = str_ireplace($single, $double, $combination);   
    $newval = str_ireplace($combination, $newcom, $value);
    return $newval; 
} 
// A function to flatten a multidimentional array
/*function flatten(array $array) 
{
    $return = array();
    array_walk_recursive($array, function($a) use (&$return) { $return[] = $a; });
    return $return;
}*/

print_r(dvitva($kantha,$talu,$murdha));

?>
