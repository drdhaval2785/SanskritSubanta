<?PHP

$programs = array(
	"msword" => "Microsoft Word",
);


$date = gmdate("r");


$templates['msword']['name'] = "di_{$_POST['src']}_{$_POST['tgt']}";
$templates['msword']['bad_characters'] = array("^");
$templates['msword']['character_mark'] = "ChrW({{CHAR}})";
$templates['msword']['omit_quotes'] = 1;
$templates['msword']['start'] = <<<CWS

Sub {$templates['msword']['name']}()
'
' Macro: {$templates['msword']['name']}
' Automatically produced by diCrunch {$version}
' Creation date: {$date} 
' Online at http://www.bhasa.net/diCrunch.php
'

CWS;

$templates['msword']['repeat'] = <<<CWS

With Selection.Find
  .Text = "{{SEARCH}}"
  .Replacement.Text = "{{REPLACE}}"
  .Wrap = wdFindContinue
  .MatchCase = True
End With
Selection.Find.Execute Replace:=wdReplaceAll

CWS;

$templates['msword']['end'] = <<<CWS

End Sub

CWS;

$templates['msword']['help'] = <<<CWS

<b>1.</b> Open Microsoft Word, go to Tools &gt; Macro &gt; Macros or click ALT+F8. <br />
<b>2.</b> Copy in the name of the macro (ie. di_hk_unicode), click Create and the macro editor opens. <br />
<b>3.</b> Copy the macro text that was produced to the clipboard. <br />
<b>4.</b> In the macro editor, replace the text beginning with Sub and ending with End Sub with the text you've copied. <br />
<b>5.</b> The macro is now available at Tools &gt; Macro. Select the macro to be applied and click "Run".<br />
<b>6.</b> Replacing will be faster if you are in normal view instead of print view. View &gt; Normal.
CWS;



?>