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
include "slp-dev.php"; // includes code for conversion from SLP to devanagari,
include "dev-slp.php"; // includes code for devanagari to SLP.
$verbslist = file("verbsslp.txt");
foreach ($verbslist as $value)
{
    if(preg_match('/[iIuUfFxX][vr]$/',$value))
    {
        $value=trim($value);
        $set[] = $value;
        echo '"'.$value.'",';
    }
}
?>