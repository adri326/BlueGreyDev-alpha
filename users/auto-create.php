<?php session_start();
include('../userspass.php');
/*if (isset($_SESSION['pseudo']) and isset($_SESSION['password']) and $_SESSION['password'] !== '' and $_SESSION['password'] == $userspass[$_SESSION['pseudo']]) {
foreach($pseudo as $act) {
fwrite(fopen($act.'/index.php', "w"), '<?php session_start; $pseudog = "'.$act.'"; $pagen = "'.$act.' on BlueGreyDev"; include("../../userspass.php"); include("../starter.php"); dorea("activity/"); ?>');
fwrite(fopen($act.'/act.dat', 'w'), 'Created account');
mkdir($act.'/activity');
mkdir($act.'/files');
echo $act;
}
}*/
?>