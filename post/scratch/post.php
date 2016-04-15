<?php session_start();
include('../../userspass.php');
if (isset($_SESSION['pseudo']) and isset($_SESSION['password']) and $_SESSION['password'] !== '' and sha1($_SESSION['password']) == $userspass[$_SESSION['pseudo']]) {
  $date = date("Y\-m\-d\-H\-i\-s");
  if (isset($_POST['title']) AND isset($_POST['content'])) {
  if ($scratchData = file_get_contents('http://scratch.mit.edu/api/v1/project/'.$_POST['content'].'/') AND $scratchDecoded = json_decode($scratchData, TRUE) AND $uname = $scratchDecoded['creator']['username']) {
  if (fwrite(fopen('../../users/'.$_SESSION['pseudo'].'/activity/'.$date.'.wdg', "w"), strlen($_POST['content']).$_POST['content'].'+'.sprintf("%04d",strlen($uname)).$uname.$_POST['title'])) {
  if (fwrite(fopen('../../users/'.$_SESSION['pseudo'].'/activity/'.$date.'.wdd', 'w'), 'SCRATCH')) {
  	if (fwrite(fopen('../../users/'.$_SESSION['pseudo'].'/act.dat', 'a'), '/nPosted an scratch project')) {
       $f = fopen('../postscount.dat', 'r');
       $n = fread($f, filesize('../postscount.dat'));
       fclose($f);
       $f = fopen('../postscount.dat', 'w');
       fwrite($f, $n+1);
       fclose($f);
  		  	if (true) {
  				echo '<center><h2>All worked nice, your project is now posted!</h2></center>';
  			}
  		
  	} else {
  		echo '<center><h2>Oops, there were an error :/</h2><br /><h3>4th step crash</h3></center>';
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