<?php session_start();
include('../userspass.php');
echo '<center><a href="'.$_GET['user'].'/"><h2>Last activity of '.$_GET['user'].' :</h2></a><table><tbody>';
$actlist = explode("/n", fread(fopen($_GET['user']."/act.dat", "r"), filesize($_GET['user']."/act.dat")));
foreach(array_reverse($actlist) as $actdata) {
	echo '<tr><td class="i">'.$actdata.'</td></tr>';
}
echo '</tbody></table>';
?>