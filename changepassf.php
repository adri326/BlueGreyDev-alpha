<?php session_start();
include('userspass.php');
if (isset($_SESSION['pseudo']) AND isset($_SESSION['password']) AND sha1($_SESSION['password']) == $userspass[$_SESSION['pseudo']])
{
  if (true) {
    //$filepass = fopen($pf[$_SESSION['pseudo']], "r");
    if (sha1($_POST['pass']) == $userspass[$_SESSION['pseudo']]) {
      if ($_POST['npass1'] == $_POST['npass2']) {
        //fclose($filepass);
        //fwrite(fopen($pf[$_SESSION['pseudo']], "w"), '<?php ///SECURE///'.$_POST['npass1']);
        $toexe = 'UPDATE `userspass` SET `password` = "'.sha1($_POST['npass1']).'" WHERE `pseudo` = "'.$_SESSION['pseudo'].'" AND `password` = "'.sha1($_SESSION['password']).'"';
        $stmt = $db->prepare($toexe);
        //saveState(array('ChangePass', 'true'));
        if ($stmt->execute()) {
          echo '<center><h2>Password changed!</h2><h3>You\'ll need to login again :</h3>';
          echo '<form method="post" action="http://adri326.890m.com/trt.php">Username: <input type="text" name="pseudo" /> <br />Password: <input type="password" name="password" /> <br />Submit: <input type="submit" name="ok" /> <br /></form></center>';
        } else {
          echo '<center><h2>Sorry, there were an error while changing your password</h2></center>';
          //echo '<br />'.$toexe.'<br />';
          //var_dump($stmt->errorInfo());
        }
      }
    }
  }
}

?>