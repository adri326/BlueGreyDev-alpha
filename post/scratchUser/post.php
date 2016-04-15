<?php session_start();
include('../../userspass.php');
if (isset($_SESSION['pseudo']) and isset($_SESSION['password']) and $_SESSION['password'] !== '' and sha1($_SESSION['password']) == $userspass[$_SESSION['pseudo']]) {
  $date = date("Y\-m\-d\-H\-i\-s");
  if (isset($_POST['title']) AND isset($_POST['content'])) {
  if (fwrite(fopen('../../users/'.$_SESSION['pseudo'].'/activity/'.$date.'.wdg', "w"), sprintf("%04d",strlen($_POST['content'])).$_POST['content'].$_POST['title'])) {
  if (fwrite(fopen('../../users/'.$_SESSION['pseudo'].'/activity/'.$date.'.wdd', 'w'), 'SCRATCHUSER')) {
  	if (fwrite(fopen('../../users/'.$_SESSION['pseudo'].'/act.dat', 'a'), '/nPromoted an scratch user')) {
  		  	if (true) {
       $f = fopen('../postscount.dat', 'r');
       $n = fread($f, filesize('../postscount.dat'));
       fclose($f);
       $f = fopen('../postscount.dat', 'w');
       fwrite($f, $n+1);
       fclose($f);
  				echo '<center><h2>All worked nice, your user promotion is now posted!</h2></center>';
  			}
  } else {
  	echo '<center><h2>Oops, there were an error :/</h2><br /><h3>3rd step crash</h3></center>';
  }
  } else {
  	echo '<center><h2>Oops, there were an error :/</h2><br /><h3>2nd step crash</h3></center>';
  }
  } else {
  	echo '<center><h2>Oops, there were an error :/</h2><br /><h3>1st step crash</h3></center>';
  }
  } else {
  	echo '<center><h2>Oops, you forgot to write down some stuff</h2></center>';
  }
}