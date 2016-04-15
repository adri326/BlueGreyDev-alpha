<?php session_start();
include('userspass.php');
if (isset($_GET['code'])) {
echo '<center><iframe height="402" frameborder="0" width="485" allowfullscreen="" src="https://scratch.mit.edu/projects/embed/'.$_GET['code'].'" allowtransparency="true"></center>';
}
?>