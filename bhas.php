<?php
$file = file("C:\\Users\\Dhaval\\Dropbox\\slpverbs.txt");
for ($i=0;$i<count($file);$i++)
{
    $file[$i] = trim($file[$i]);
if(preg_match('/[bgqd]([^aAiIuUfFxXeEoO]*)[aAiIuUfFxXeEoO][BGQDh]$/',$file[$i]))
{
echo $file[$i].'","';
}
}
?>