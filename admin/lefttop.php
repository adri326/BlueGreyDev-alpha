<?php
$file = fopen('../post/postscount.dat', 'r');
$postcount = fread($file, filesize('../post/postscount.dat'));
fclose($file);
if ($_GET['okay']=="lefttop") {
$stmt = $db->prepare("UPDATE admintool SET lastUserCount = '".count($pseudo)."', lastPostCount = '".$postcount."' WHERE pseudo = '".$_SESSION['pseudo']."'");
$stmt->execute();
$admindata['lastPostCount'] = $postcount;
$admindata['lastUserCount'] = count($pseudo);
}
if (!$isonmobile) echo '<table><tr><td>';
echo '<h1 id="count1">'.count($pseudo).'</h1><h2 id="text1_">users on this site</h2>';
echo '<h3 id="text1">'.(count($pseudo)-$admindata['lastUserCount']).' users joined since your last visit</h3>';
if (!$isonmobile) echo '</td><td>';
echo '<h1 id="count2">'.$postcount.'</h1><h2 id="text2_">posts on this site</h2>';
echo '<h3 id="text2">'.($postcount-$admindata['lastPostCount']).' posts since your last visit</h3>';
if (!$isonmobile) echo '</td></tr></table>';
echo '<h3><a href="?okay=lefttop">Okay!</a></h3>';
?>