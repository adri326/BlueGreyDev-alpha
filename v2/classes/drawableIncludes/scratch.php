<?php
$len = substr($content, 0, 1);
$nchange = 1;
if ($len=="1") {
				$len = substr($content, 0, 2);
				$nchange = 2;
}
$suser = "";
$nchange_ = 0;
if (substr($content, $len+$nchange, 1)=="+") {
    $nchange_ = 5;
    $nchange_ += substr($content, $nchange+$len+1, 4);
    $len_ = substr($content, $nchange+$len+1, 4);
    $suser = ' by <a href="http://scratch.mit.edu/users/'.substr($content, $nchange+$len+5, $len_).'"> '.substr($content, $nchange+$len+5, $len_).'</a>';
}
echo '<center><h2>'.substr($content, $len+1+$nchange_).'</h2><h4>Scratch project';
echo $suser;
echo '</h4><br /><a class="imgtoscratch" href="../../scratch.php?code='.substr($content, $nchange, $len).'"><img class="imgtoscratch" src="https://scratch.mit.edu/static/site/projects/thumbnails/'.substr($content, $nchange, $len-4).'/'.substr($content, $len-4+$nchange, 4).'.png" /></a></center>';
?>