<?php 
// set maximum execution time to 1 hr
ini_set("max_execution_time",3600);
// Put your directory name in $dir. Your converted files will be stored in this 'Pathtodirectory/new/'.

$dir= "C:/dhaval/d drive/DCS/";
mkdir($dir."new");

$filename = glob('C:/dhaval/d drive/DCS/*.txt');
$filenew= str_replace($dir,$dir."new/",$filename);
$r=0;
while($r<count($filename))
{
$y = fopen($filename[$r],"r");
//echo $filename[$r]."<br>".$filenew[$r];
// reads your file into an array 
$lines = file($filename[$r]);
$count = count($lines);
//echo $count;
// applies the transliteration function to all members of the array and echo and store them

$x=0;
while($x<$count)
	{
	$text = $lines[$x];

// You can put the unnecessary strings here. they will be deleted. e.g. 'FN' for data which is being taken directly from DCS server
$identifier=array('FN');
$text= str_replace($identifier,'',$text);

//defines the input characters for Unicode Itrans
$ch['unicode'] = array(

30 => "Ā", // _a
31 => "Ī", // _i
32 => "Ū", // _u
33 => "Ṛ", // .r
34 => "Ṝ", // _.r
35 => "Ṅ", // 'n
36 => "Ñ", // ~n
37 => "Ṭ", // .t
38 => "Ḍ", // .d
39 => "Ṇ", // .n
40 => "Ś", // 's
41 => "Ṣ", // .s
42 => "ṃ", // 'm (anusvara)
43 => "Ḥ", // .h (visarga)
44 => "Ḷ", // .l
45 => "Ḹ", // _.l

50 => "Ḏ", // _D
51 => "Ẏ", // .Y

1 => "ā", // _a
2 => "ī", // _i
3 => "ū", // _u
4 => "ṛ", // .r
5 => "ṝ", // _.r
6 => "ṅ", // 'n
7 => "ñ", // ~n
8 => "ṭ", // .t
9 => "ḍ", // .d 
10 => "ṇ", // .n
11 => "ś", // 's
12 => "ṣ", // .s
13 => "ṁ", // 'm (anusvara)
14 => "ḥ", // .h (visarga)
15 => "ḷ", // .l
16 => "ḹ", // _.l

20 => "ḏ", // _d
21 => "ẏ", // .y

60 => "ɱ", // \-/ (candrabindu)
61 => "̮", // _ (ha_uk)
62 => "^", // ^ (ext. sandhi)
63 => "'", // avagraha
64 => "ɱ", // \_/ (candra e)
65 => "/x", // \ (virama)
66 => "…", // abbreviation
67 => "’", // Latin apostrophe

);

// Defines character set for Harward Kyoto protocol
$ch['hk'] = array(

30 => "%A", // _a
31 => "%I", // _i
32 => "%U", // _u
33 => "%R", // .r
34 => "%q", // _.r
35 => "%G", // 'n
36 => "%J", // ~n
37 => "%T", // .t
38 => "%D", // .d
39 => "%N", // .n
40 => "%z", // 's
41 => "%S", // .s
42 => "%M", // 'm (anusvara)
43 => "%H", // .h (visarga)
44 => "%L", // .l
45 => "%W", // _.l

50 => "%P", // _D
51 => "%Y", // .Y

1 => "A", // _a
2 => "I", // _i
3 => "U", // _u
4 => "R", // .r
5 => "q", // _.r
6 => "G", // 'n
7 => "J", // ~n
8 => "T", // .t
9 => "D", // .d 
10 => "N", // .n
11 => "z", // 's
12 => "S", // .s
13 => "M", // 'm (anusvara)
14 => "H", // .h (visarga)
15 => "L", // .l
16 => "W", // _.l

20 => "P", // _d
21 => "Y", // .y


60 => "~", // \-/ (candrabindu)
61 => "_", // _ (ha_uk)
62 => "^", // ^ (ext. sandhi)
63 => "'", // avagraha
64 => "~", // \_/ (candra e)
65 => "/x", // \ (virama)
66 => "@", // abbreviation
67 => "`", // Latin apostrophe

);
// Converts from Unicode ITRANS to HK protocol

$text = stripslashes($text);
$text = str_replace($ch['unicode'],$ch['hk'],$text);

$text = str_replace("\n ", "\n", $text);
// unblock this to remove the '-' sign
//$text = str_replace("-", "", $text);

// $q is array of consonants, $p is array of vowels in HK protocol
$q= array("k","h","g","G","c","j","J","T","D","N","t","d","n","p","b","m","y","r","l","v","z","S","s");
$p= array("a","A","i","I","u","U","R","lR","e","o",);
// removing the space between the consonants and vowels in case of split sandhi
$i=0;
while($i<23)
{
$j=0;
while($j<10)
{
$text = str_replace($q[$i]." ".$p[$j],$q[$i].$p[$j],$text);
$text = str_replace(" /'","/'",$text);
$j++;
}
$i++;
}

// $a is array of consonants except 't' and 'n'. $b is array of all consonants. This would remove the spaces between the consonants. Only 't' and 'n' are not included in $a because they are mostly used as endings in verb forms, and conventionally not joined. 
$a= array("k","h","g","G","c","j","J","T","D","N","d","p","b","m","y","r","l","v","z","S","s");
$b= array("k","h","g","G","c","j","J","T","D","N","t","d","n","p","b","m","y","r","l","v","z","S","s");

$i=0;
while($i<21)
{
$j=0;
while($j<23)
{
$text = str_replace($a[$i]." ".$b[$j],$a[$i].$b[$j],$text);
$text = str_replace(" /'","/'",$text);
$j++;
}
$i++;
}

// special preformatting
$text = str_replace("n n","nn",$text);
$text = str_replace("t t","tt",$text);



$v = "्"; // Virama

/* Main arrays */
// number array
$num['tra'] = array(
	60 => "0",
	61 => "1",
	62 => "2",
	63 => "3",
	64 => "4",
	65 => "5",
	66 => "6",
	67 => "7",
	68 => "8",
	69 => "9",
);

// The consonants 
$main['tra'] = array(

	//20 => "t ", // t end
		
	40 => "'", // apostrophe (avagraha)
	41 => "`", // Latin apostrophe (’)
	42 => "#", // Abbreviation
	
	116 => "kha",
	115 => "ka",
	118 => "gha",
	117 => "ga",
	119 => "Ga",

	121 => "cha",
	120 => "ca",
	123 => "jha",
	122 => "ja",
	124 => "Ja",

	126 => "Tha",
	125 => "Ta",
	128 => "Dha",
	127 => "Da",
	129 => "Na",

	131 => "tha",
	130 => "ta",
	133 => "dha",
	132 => "da",
	134 => "na",

	136 => "pha",
	135 => "pa",
	138 => "bha",
	137 => "ba",
	139 => "ma",
	
	140 => "ya",
	141 => "Ya",
	142 => "ra",
	143 => "la",
	144 => "va",
	
	145 => "za",
	146 => "Sa",
	147 => "sa",
	
	149 => "M",
	150 => "H",
	151 => "~",
	152 => "||", // ||
	153 => "|", // |
	154 => "Q", // Nukta
	155 => "@", // Abbreviation
	156 => ";", // Udatta
	157 => ":", // Anudatta (svarita)

	
	201 => "Pha",
	200 => "Pa",
	
	148 => "ha",
);
// The vowels
$vow['tra'] = array(

	257 => " R",
	258 => " q",
	259 => " L",
	260 => " W",
	
	261 => " e",
	262 => " ai",
	263 => " o",
	264 => " au",
	
	251 => " a",
	252 => " A",
	253 => " i",
	254 => " I",
	255 => " u",
	256 => " U",
);

// array of vowels attached at the end of consonants
$yukta['tra'] = array(

	307 => "R", // joint
	308 => "q", // joint
	309 => "L", // joint
	310 => "W", // joint
	
	311 => "e", // joint
	312 => "ai", // joint
	313 => "o", // joint
	314 => "au", // joint
	
	301 => "a", // joint
	302 => "A", // joint
	303 => "i", // joint
	304 => "I", // joint
	305 => "u", // joint
	306 => "U", // joint
);

// Target array of numbers
$num['scr'] = array(
	60 => "०", // 0
	61 => "१", // 1
	62 => "२", // 2
	63 => "३", // 3
	64 => "४", // 4
	65 => "५", // 5
	66 => "६", // 6
	67 => "७", // 7
	68 => "८", // 8
	69 => "९", // 9
);
// target array of consonants
$main['scr'] = array(

	//20 => "ৎ", // t end
	
	40 => "ऽ", // apostrophe (avagraha)
	41 => "’", // Latin apostrophe (’)
	42 => "॰", // Abbreviation
	
	116 => "ख", // kha
	115 => "क", // ka
	118 => "घ", // gha
	117 => "ग", // ga
	119 => "ङ", // Ga
	
	121 => "छ", // cha
	120 => "च", // ca
	123 => "झ", // jha
	122 => "ज", // ja
	124 => "ञ", // Ja
	
	126 => "ठ", // Tha
	125 => "ट", // Ta
	128 => "ढ", // Dha
	127 => "ड", // Da
	129 => "ण", // Na
	
	131 => "थ", // tha
	130 => "त", // ta
	133 => "ध", // dha
	132 => "द", // da
	134 => "न", // na
	
	136 => "फ", // pha
	135 => "प", // pa
	138 => "भ", // bha
	137 => "ब", // ba
	139 => "म", // ma
	
	140 => "य", // ya
	141 => "य़", // Ya
	142 => "र", // ra
	143 => "ल", // la
	144 => "व", // va
	
	145 => "श", // za
	146 => "ष", // Sa
	147 => "स", // sa

	
	149 => "ं", // M
	150 => "ः", // H
	151 => "ँ", // ~
	152 => "॥", // ||
	153 => "।", // |
	154 => "़", // . Nukta
	155 => "॰", // Abbreviation
	156 => "॑", // Udatta
	157 => "॒", // Anudatta (svarita)

	
	201 => "ঢ়", // Pha
	200 => "ড়", // Pa

	
	148 => "ह", // ha
);
// target array of vowels
$vow['scr'] = array(
	
	257 => " ऋ", // R
	258 => " ॠ", // q
	259 => " ऌ", // L
	260 => " ॡ", // W 
	
	261 => " ए", // e
	262 => " ऐ", // ai
	263 => " ओ", // o
	264 => " औ", // au
	
	251 => " अ", // a
	252 => " आ", // A
	253 => " इ", // i
	254 => " ई", // I
	255 => " उ", // u
	256 => " ऊ", // U
	
);
// target array of vowels to be attached to the consonants
$yukta['scr'] = array(
	
	307 => "ृ", // R joint
	308 => "ॄ", // q joint
	309 => "ॢ", // L joint
	310 => "ॣ", // W  joint
	
	311 => "े", // e joint
	312 => "ै", // ai joint
	313 => "ो", // o joint
	314 => "ौ", // au joint
	
	301 => "&#8205;", // a joint
	302 => "ा", // A joint
	303 => "ि", // i joint
	304 => "ी", // I joint
	305 => "ु", // u joint
	306 => "ू", // U joint
);

$yukta['scr'][301] = "";
// formatting the text before converting to devanagari
$text = " " . $text;
$text = str_replace("-", "- ", $text); // Ensure full vowel is given after dash
	$text = str_replace("^", "", $text); // Remove external sandhi break
	$text = str_replace("%", "", $text); // Remove XHK capital letter sign
/* Create half-consonants */
	
	$half['tra'] = array();
	$half['scr'] = array();
	
	foreach ($main['tra'] as $key => $val) {
		$half['tra'][$key] = str_replace("a", "", $val);
	

}
	foreach ($main['scr'] as $key => $val) {
		$half['scr'][$key] = $val . $v;
	}


/* Crunch joint vowels */
	
	foreach ($yukta['tra'] as $key => $val) {
		foreach ($half['tra'] as $hkey => $hval) {
			$obj = str_replace("{$v}", "", $half['scr'][$hkey]);
			$text = str_replace(($hval . $val),  ($obj . $yukta['scr'][$key]), $text);
		}
	}

	$text = str_replace("_", "_ ", $text); // For ha_uk etc.


	$text = str_replace ($main['tra'], $main['scr'], $text);
	$text = str_replace ($vow['tra'], $vow['scr'], $text);
	$text = str_replace ($half['tra'], $half['scr'], $text);
	$text = str_replace ($num['tra'], $num['scr'], " " . $text . " ");

	$text = str_replace("{$v}{$half['scr'][154]}", "{$half['scr'][154]}", $text); // Fix nuktas


	/* Crunch remaining full vowels, e.g. ha_uk  and sei */

	foreach ($vow['tra'] as $key => $val) {
		$objscr = str_replace(" ", "", $val);
		$objtra = str_replace(" ", "", $vow['scr'][$key]);
		$text = str_replace("{$objscr}", "{$objtra}",  $text);
	}

// cleaning up the text after processing

	$tidys = array("_ ", "- ", "\n ");
	$tidyr = array("", "-", "\n");

	$text = trim(str_replace(
$tidys, $tidyr, $text));

// fixation of some issues - where you can afford to manipulate the devanagari text

$text = str_replace("$","",$text);
$text = str_replace("&","।",$text);
$text = str_replace("/","।",$text);
$text = str_replace(" ऽ","ऽ",$text);


global $filename;
global $s;
// gives output to the browser. In case you need to get the output in text file, you can block this code and go to the code below.
echo $text."</br>";
//echo $lines[$x]."<br>";
//echo $lines[$x+1]."<br>"."<br>";
/* in case you need to get the output in a text file, you can unblock the code and specify the names of files to be created.*/
$trial= fopen($filenew[$r],'a+');
fputs($trial,$text."\r\n");
fclose ($trial);
$x++;


}
$r++;
}
?>