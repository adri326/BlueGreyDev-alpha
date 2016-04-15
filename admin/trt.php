<?php session_start();
$needallusers = true;
include('../userspass.php');
if (isset($_SESSION['pseudo']) and isset($_SESSION['password']) and $_SESSION['password'] !== '' and sha1($_SESSION['password']) == $userspass[$_SESSION['pseudo']]) {
if ($admin[$_SESSION['pseudo']]==1) {
$stmt = $db->prepare("SELECT * FROM admintool WHERE  1");
$stmt->execute();
$admindatapre = $stmt->fetchAll();
foreach ($admindatapre as $actadmindata) {
if ($actadmindata['pseudo']==$_SESSION['pseudo']) {
$admindata = $actadmindata;
}
}
echo "<center><h1>Admin panel</h1><h2>Welcome ".$_SESSION['pseudo']." on the admin panel</h2></center>";
echo '<div class="left" id="lefttop">';
include('lefttop.php');
echo '</div><div class="right" id="righttop">';
include('righttop.php');
}
else {
echo "<center><h1>You are not an administrator, sorry</h1></center>";
}
} else {
include("../connect_p-in.php");
}
?>