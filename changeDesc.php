<?php session_start();
include('userspass.php');
if (isset($_SESSION['pseudo']) and isset($_SESSION['password']) and $_SESSION['password'] !== '' and sha1($_SESSION['password']) == $userspass[$_SESSION['pseudo']]) {
	echo '<center><h2>Type here your new description :</h2><form action="/unpost.php" method="post"><textarea name="desc">'.$desc[$_SESSION['pseudo']].'</'.'textarea><input type="submit" /></form>';
}