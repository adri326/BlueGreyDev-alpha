<?php session_start();
include('userspass.php');
if (isset($_GET['dir'])) {
	$dir = $_GET['dir'];
} else {
	$dir = '/';
}
if (isset($_SESSION['pseudo']) and isset($_SESSION['password']) and $_SESSION['password'] !== '' and sha1($_SESSION['password']) == $userspass[$_SESSION['pseudo']]) {
	if (isset($_POST['title'])) {
		$stmt = $db->prepare("INSERT INTO `forum_master`(`id`, `name`, `desc`, `dir`) VALUES (NULL, '".$_POST['title']."' , '".str_replace("'", "&#39;", htmlSpecialChars($_POST['desc']))."', '".$dir."')");
		if ($stmt->execute()) {
			/*$toexe = 'SELECT * FROM forum_master WHERE name = '.$_POST['title'].' LIMIT 0, 30';
			$stmt->execute();
			$id = $stmt->fetch()['id'];*/
			echo '<center><h2>Your forum has been created</h2><h3><a href="findForum.php?ftitle='.$_POST['title'].'">Your forum is here</a></h3></center>';
		} else {
			echo '<center><h2>There were an error while creating your forum</h2></center>';
		}
	}
	echo '<center><h2>Create an forum</h2><form action="newForum.php?dir='.$dir.'" method="post"><h3>Title :</h3><input type="text" name="title" style="width: 80%; height: 1.5em; font-size: 120%;" /><h3>Description :</h3><textarea name="desc" style="font-size: 120%;"></'.'textarea><input type="submit" /></center>';
} else {
	include('connect_p-in.php');
}