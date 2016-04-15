<?php session_start();
$pagen = "Post";
include('../userspass.php');
$postclass = array(
  'scratch' => 'Scratch',
  'html' => 'HTML',
  'scratchUser' => 'Promote a Scratch user'
);
$postclassDesc = array(
  'scratch' => 'Scratch is a simple language where you can easyly create little programms and share them. It is the best way to learn programming',
  'html' => 'HTML (HyperText Markup Language) is the language of websites, whith it you can write text, place images or put sounds, videos or boxes',
  'scratchUser' => 'Promoting a scratch user is a good way to help him to be known, and it could really help him to progress'
); 


if (isset($_SESSION['pseudo']) and isset($_SESSION['password']) and $_SESSION['password'] !== '' and sha1($_SESSION['password']) == $userspass[$_SESSION['pseudo']]) {
  echo '<center><h2>Select an posting mode / file type</h2></center><br />';
  echo '<table><tbody>';
  foreach($postclass as $posttype => $postname) {
    echo '<tr><td class="i1"><h3><a href="';
    echo $posttype.'">'.$postname.'</h3>'.$postclassDesc[$posttype].'</a></td></tr>';
  }
  echo '</tbody></table>';
  //echo '<tr><td class="i1"><a href="apk">.apk</a></td></tr><tr><td class="i1"><a href="html">Hypertext</a></td></tr></tbody></table>';
} else {
  include('../connect_p-in.php');
}
?>