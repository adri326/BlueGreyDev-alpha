<?php session_start();
include('../../userspass.php');
if (isset($_SESSION['pseudo']) AND isset($_SESSION['password']) AND $_SESSION['password'] !== '' AND sha1($_SESSION['password']) == $userspass[$_SESSION['pseudo']]) {
  echo '<center><h2>Input here the scratch user name :</h2><br />';
  echo '<form action="post.php" method="post"><input type="text" name="content" /><br /><br /><h2>And a little title :</h2><br /><input type="text" name="title" /><br /><br /><input type="submit" value="Submit" /></form></center>';
}
?>