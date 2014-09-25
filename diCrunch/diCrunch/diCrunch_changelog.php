<?PHP

$license = nl2br(file_get_contents("./diCrunch_changelog.txt"));

$license = preg_replace("#http://(.*)(\.( |\n|<)| |<)#isU", "<a href=\"http://\\1\" target=\"_blank\">http://\\1</a>\\2", $license);

$license = preg_replace("#'''(.*)'''#isU", "<b>\\1</b>", $license);

$op .= <<<CWS

<div class="wrapper">
<h2>Changelog &nbsp; &middot; &nbsp; <a href="{$_SERVER['PHP_SELF']}">Return</a> &raquo;</h2>


<div class="preferenceheading">
<b>diCrunch</b> &mdash; History of development
</div>
<div class="preferencefield">

{$license}
</div>
CWS;


?>