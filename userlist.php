<?php session_start(); $pagen = "Explore";
$needallusers = true;
include('userspass.php');
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
echo '<center><h1>Find any user!</h1><h3><a href="?sort=R">Random</a></h3></center>';
echo '<table><tbody>';
echo '<tr><td><a href="userlist.php?sort=name">Sort by Name</a></td><td><a href="userlist.php?sort=JoinDate">Sort by joining Date</a></td><td><a href="?sort=nPost">Sort by activity</a></td><td><a href="?sort=id">Sort by ID</a></td></tr>';
$spseudo = $pseudo;
/*foreach ($pseudo as $data) {
	array_push($spseudo, $data);
}*/
if ($_GET['sort']=="JoinDate") {
	uasort($spseudo, 'cmp1');
	//$spseudo = $pseudo;
} elseif ($_GET['sort']=="name") {
	//$spseudo = $pseudo;
	asort($spseudo);
	//echo 'sort by name';
} elseif ($_GET['sort']=="nPost") {
	uasort($spseudo, 'cmp2');
} elseif ($_GET['sort']=="id") {
	uasort($spseudo, 'cmp3');
	$spseudo = array_reverse($spseudo);
} elseif ($_GET['sort']=='R') {
	shuffle($spseudo);
}
foreach ($spseudo as $n => $act) {
        if ($act !== "") {
	echo '<tr><td class="i"> ';
	echo ' <a href="users/'.$act.'"> '.$act.'</a>';
	echo '</td><td class="i">'.$udate[$act].'</td><td class="i">';
	echo count(explode("/n", fread(fopen("users/".$act."/act.dat", "r"), filesize("users/".$act."/act.dat"))))-1;
	echo ' posts</td><td class="i">'.$id[$act];
	echo '</td></tr>';
        }
}
echo '</tbody></table>';
//print_r($pseudo);
//print_r($spseudo);
?>