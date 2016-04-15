<?php session_start(); $pagen = "Explore"; include('userspass.php');
$stmt = $db->prepare('SELECT pseudo, DATE_FORMAT(JoinDate, \'%d/%m/%Y\') AS date FROM userspass WHERE 1');
if ($stmt->execute(array($_GET['name']))) {
	$n = 0;
	while ($row = $stmt->fetch()) {
		$n += 1;
		$udate[$row['pseudo']] = $row['date'];
		//$udate[$rows['pseudo']] = array("J"=>$rows['jour'], "M"=>$rows['mois'], "A"=>$rows['annee']);
	}
}
function cmp1($a, $b) {
	/*if ($udate[$a]==$udate[$b]) {
		return 0;
	}
	return ($udate[$a] > $udate[$b]) ? -1 : 1;*/
	return 0-strcmp($udate[$a], $udate[$b]);
}
function cmp2($a, $b) {
	$ac = count(explode("/n", fread(fopen("users/".$a."/act.dat", "r"), filesize("users/".$a."/act.dat"))));
	$bc = count(explode("/n", fread(fopen("users/".$b."/act.dat", "r"), filesize("users/".$b."/act.dat"))));
	if ($bc>$ac) {
		return 1;
	} elseif ($bc<$ac) {
		return -1;
	} else {
		return 0;
	}
	return 0;
}
function cmp3($a, $b) {
	if ($id[$a]>$id[$b]) {
		return -1;
	} elseif ($id[$a]<$id[$b]) {
		return 1;
	} else {
		return 0;
	}
	return 0;
}
echo '<center><h1>Explore and find your love!</h1><h2><a href="findForum.php">New feature: forums!</a></h2><br /><br /><br />';
echo '<div class="i"><h2><a href="userlist.php">List all the users</a></h2></div><br />';
echo '<div class="i"><h2><a href="findForum.php">Explore the forums</a></h2></div>';
?>