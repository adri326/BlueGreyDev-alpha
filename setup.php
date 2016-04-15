<?php session_start();
include('userspass.php');
if (isset($_SESSION['pseudo']) AND isset($_SESSION['password']) AND sha1($_SESSION['password']) == $userspass[$_SESSION['pseudo']])
{
    echo '<form method="post" action="index.php">';
    echo 'page editing cols : <input type="number" name="cols" value="'.$_SESSION['cols'].'" />';
    echo '<br />page editing rows : <input type="number" name="rows" value="'.$_SESSION['rows'].'" />';
    echo '<br />auto-rows : <input type="checkbox" name="auto-rows" value="'.$_SESSION['auto-rows'].'" />';
    echo '<input type="submit" name="setup" value="Save changes" /></form>';
}
?>