<?php session_start();
$pagen = 'BlueGreyDev';
if (isset($_POST['pseudo']))
{
	$_SESSION['pseudo'] = $_POST['pseudo'];
}
if (isset($_POST['password']))
{
	$_SESSION['password'] = $_POST['password'];
}
include('userspass.php');
include('MAIN.php');
?>
	</body>
</html>