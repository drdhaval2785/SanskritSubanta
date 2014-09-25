<?PHP

$license = nl2br(file_get_contents("./diCrunch_license.txt"));

$license = preg_replace("#http://(.*)(\.( |\n|<)| |<)#isU", "<a href=\"http://\\1\" target=\"_blank\">http://\\1</a>\\2", $license);

$op .= <<<CWS

<div class="wrapper">
<h2>License &nbsp; &middot; &nbsp; <a href="{$_SERVER['PHP_SELF']}">Return</a> &raquo;</h2>


<div class="preferenceheading">
<b>GNU GPL</b> &mdash; GNU General Public License
</div>
<div class="preferencefield">

{$license}
</div>
CWS;


?>