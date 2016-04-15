<?php session_start();
include('userspass.php');
if (isset($_SESSION['pseudo']) and isset($_SESSION['password']) and $_SESSION['password'] !== '' and sha1($_SESSION['password']) == $userspass[$_SESSION['pseudo']]) {
	$doreadAddOn = "true";
	$doreadAddOnV = "unpost.php";
	$doreadAddOnN = "Unpost";
	echo '<center><h2>Clic on an unpost link to unpost something</h2><a href="/changeDesc.php"><h3>Clic here to change your description</h3></a><a href="changepass.php"><h3>Clic here to change your password</h3></a></center>';
	if (isset($_POST['desc'])) {
		$toexe = "UPDATE userspass SET `desc` = '".str_replace("'", "&#39;", htmlSpecialChars($_POST['desc']))."' WHERE `pseudo` = '".$_SESSION['pseudo']."'";
		$stmt = $db->prepare($toexe);
		if ($stmt->execute()) {
			echo '<center><h3>The description has been successful changed</h3></center>';
		} else {
			echo '<center><h3>There were an error while changing your desciption :</h3>';
			print_r($stmt->errorInfo());
			echo '<br />'.$toexe;
			echo '</center>';
		}
	}
	if (isset($_GET['post'])) {
		unlink("users/".$_SESSION['pseudo'].'/activity/'.$_GET['post']);
		unlink("users/".$_SESSION['pseudo'].'/activity/'.str_replace('wdg', 'wdd', $_GET['post']));
		echo 'deleted';
	}
	doread('users/'.$_SESSION['pseudo'].'/activity/', $doreadAddOn, $doreadAddOnV, $doreadAddOnN);
}