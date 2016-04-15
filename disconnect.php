<?php session_start();
$pagen = "disconnect page";
include('userspass.php');
saveState(array('disconnect', $_SESSION['pseudo']));
session_destroy();
echo 'You have been disconnected, back to the <a href="trt.php">main page</a>';
?>