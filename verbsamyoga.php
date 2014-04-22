<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="mystyle.css">
</link>
</meta>
</head>
<body>
<?php
 header('Content-type: text/html; charset=utf-8');
include 'function.php';
$verbslist = file("verbsslp.txt");
//print_r($a);
foreach ($a as $value)
{
        $text = $value;
        $text1 = preg_split('/['.pc('ac').']/',$text);
        foreach ($text1 as $val1)
        {
            $val1 = str_replace(array("1","2","3","4","5","6","7","8","9","0"),blank(0),$val1);
            if (preg_match('/['.pc('hl').']['.pc('hl').']/',$val1))
            {
                $set[] = $val1;
            }
        }
}
$verbsamyoga = array_unique($set);
?>