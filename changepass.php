<?php session_start();
include('userspass.php');
if (isset($_SESSION['pseudo']) AND isset($_SESSION['password']) AND sha1($_SESSION['password']) == $userspass[$_SESSION['pseudo']])
{
  if (in_array($_SESSION['pseudo'], $pseudo)) {
    echo '<center><form method="post" action="changepassf.php">';
    echo 'Previous password : <br /><input type="text" name="pass" />';
    echo '<br />New password : <br /><input type="text" name="npass1" />';
    echo '<br />Password confirmation : <br /><input type="text" name="npass2" />';
    echo '<br /><input type="submit" name="npass" value="Save password" /></form></center>';
  }
}

?>