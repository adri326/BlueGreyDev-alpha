<?php include('userspass.php');
if ($_GET['pass']=="08476") {
	foreach($pseudo as $act) {
		$stmt = $db->prepare('UPDATE userspass SET `password` = "'.sha1($userspass[$act]).'" WHERE password = "'.$userspass[$act].'" AND pseudo = "'.$act.'"');
		if ($stmt->execute()) {
			echo '<br />'.$act.' sucessfull';
		} else {
			echo '<br />'.$act.' failed';
			var_dump($stmt-errorInfo());
		}
	}
}