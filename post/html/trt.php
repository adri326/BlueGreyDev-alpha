<?php session_start();
include('../../userspass.php');
if (isset($_SESSION['pseudo']) AND isset($_SESSION['password']) AND $_SESSION['password'] !== '' AND sha1($_SESSION['password']) == $userspass[$_SESSION['pseudo']]) {
echo '<h2>Type here your HTML :</h2>Please do not input any "script", or it won\'t be posted <form action="send.php" method="post"><textarea name="content"></';
echo 'textarea><input type="submit" name="submit" value="Submit" /></form>';
} else {
include('../../connect_p-in.php');
}
?>