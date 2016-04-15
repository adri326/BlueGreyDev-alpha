<?php session_start();
include('../../userspass.php');
if (isset($_SESSION['pseudo']) AND isset($_SESSION['password']) AND $_SESSION['password'] !== '' AND sha1($_SESSION['password']) == $userspass[$_SESSION['pseudo']]) {
  $date = date("Y\-m\-d\-H\-i\-s");
  if (issafe($_POST['content']) AND isset($_POST['content'])) {
    fwrite(fopen('../../users/'.$_SESSION['pseudo'].'/activity/'.$date.'.wdg', "w"), $_POST['content']);
    fwrite(fopen('../../users/'.$_SESSION['pseudo'].'/activity/'.$date.'.wdd', 'w'), 'HTML');
    fwrite(fopen('../../users/'.$_SESSION['pseudo'].'/act.dat', 'a'), '/nPosted text');
    $f = fopen('../postscount.dat', 'r');
    $n = fread($f, filesize('../postscount.dat'));
    fclose($f);
    $f = fopen('../postscount.dat', 'w');
    fwrite($f, $n+1);
    fclose($f);
    echo '<center><h2>Everything is OK</h2></center>';
  } else {
    if (issafe($_POST['content'])) {
  	 echo '<center><h2>You haven\'t filled all the entries</h2></center>';
    } else {
        echo '<center><h2>Your HTML contains some Javascript or &lt;style&gt; balise. In this case, you should use style="..."</h2></center>';
    }
  	echo '<h2>Modify here your HTML :</h2>Please do not input any "script", or it won\'t be posted <form action="send.php" method="post"><textarea name="content">'.$_POST['content'].'</';
    echo 'textarea><input type="submit" name="submit" value="Submit" /></form>';
  }
}
?>