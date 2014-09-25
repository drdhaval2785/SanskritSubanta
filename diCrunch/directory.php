<?php
/*$dir= "C:/Users/Dhaval/Downloads/Astangahrdayasamhita_txt/";
$filename = glob("C:/Users/Dhaval/Downloads/Astangahrdayasamhita_txt/*.txt");
$filenew = str_replace($dir,$dir."new/",$filename);
$h=0;
while ($h<count($filename))
{
echo $filename[$h]."<br>";
$h++;
}*/

function ListFiles($dir) {

    if($dh = opendir($dir)) {

       $files = Array();
        $inner_files = Array();

        while($file = readdir($dh)) {
            if($file != "." && $file != ".." && $file[0] != '.') {
                if(is_dir($dir . "/" . $file)) {
                    $inner_files = ListFiles($dir . "/" . $file);
                    if(is_array($inner_files)) $files = array_merge($files, $inner_files); 
                } else {
                    array_push($files, $dir . "/" . $file);
                }
            }
        }

        closedir($dh);
        return $files;
    }
}
$a = Listfiles('C:/Users/Dhaval/Downloads/Astangahrdayasamhita_txt');
echo $a[1];

?>