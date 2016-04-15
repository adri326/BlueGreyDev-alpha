<?php session_start();
include('../../userspass.php');
if (isset($_SESSION['pseudo']) AND isset($_SESSION['password']) AND $_SESSION['password'] !== '' AND $_SESSION['password'] == $userspass[$_SESSION['pseudo']]) {
	echo '<center><h2>Upload your file (.apk) : </h2><br /><form action="post.php" enctype="multipart/form-data" method="post"><input type="file" name="fileToUpload" /><br /><br /><h2>Enter a name : <br /><input type="text" name="title" /><br />';
	echo '<input type="submit" name="submit" value="Submit" /></form></center>';
} else {
	include('../../connect_p-in.php');
}
?>