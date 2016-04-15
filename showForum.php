<?php if (!isset($mainurl)) {
	session_start();
	include('userspass.php');
}
if (isset($_GET['forum'])) {
	if (isset($_POST['content'])) {
	    $content = $_POST['content'];
	    if ($_SESSION['pseudo']!="adri326") {
	       $content = htmlSpecialChars($_POST['content']);
	    }
		$toexe = "INSERT INTO `u310736235_db`.`forum_post` (`id`, `master`, `poster`, `content`) VALUES (NULL, ".$_GET['forum'].", '".$_SESSION['pseudo']."', '".str_replace("'", "&#39;", $content)."')";
		$stmt = $db->prepare($toexe);
		if ($stmt->execute()) {
			echo '<center><h3>Succesfully posted</h3></center>';
		} else {
			echo 'There were an error while posting';
		}
	}
	$toexe = 'SELECT * FROM forum_post WHERE master = '.$_GET['forum'].' LIMIT '.($_GET['pagen']*30).','.($_GET['pagen']*30+30);
	//echo $toexe;
	$stmt = $db->prepare($toexe);
	if ($stmt->execute()) {
		$n = 0;
		while ($row = $stmt->fetch()) {
			$rows = $row;
			$n += 1;
			$poster[$n] = $row['poster'];
			$id[$n] = $row['id'];
			$post[$n] = $row['content'];
		}
		$stmt = $db->prepare('SELECT * FROM forum_master WHERE id = '.$_GET['forum'].' LIMIT 0, 30');
		$stmt->execute();
		$stmtr = $stmt->fetch();
		$ftitle = $stmtr['name'];
		$fdir = $stmtr['dir'];
		$fdesc = $stmtr['desc'];
		echo '<center><h1>'.$ftitle.'</h1><h4>on '.$fdir.'</h4></center>';
		if (count($poster) != 0) {
			foreach($poster as $n => $act) {
				echo '<div class="i"><h3><a href="/users/'.$act.'">'.$act.'</a></h3>'.$post[$n].'</div>';
			}
		} else {
			echo '<h3>There is no post in this forum, sorry</h3>';
		}
		if (isset($_SESSION['pseudo']) and isset($_SESSION['password']) and $_SESSION['password'] !== '' and sha1($_SESSION['password']) == $userspass[$_SESSION['pseudo']]) {
			echo '<br /><center><h2>Post :</h2><form action="" method="post"><textarea name="content"></'.'textarea><input type="submit" /></form></center>';
		} else {
			echo '<center><h2>You need to login to participate to an forum</h2></center>';
		}
	}
}