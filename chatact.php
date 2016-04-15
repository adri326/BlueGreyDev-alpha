<?php
$avoid_starter = true;
include('userspass.php');
include('chat.php');
if ($r!="unchanged") $r = $r.'<tr><td colspan="2"></td></tr></tbody></table></div>';
echo $r;
?>