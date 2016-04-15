<?php session_start();
$pagen = 'Inscription';
include('userspass.php');
try {
    if (0==0) {
	echo '<br /><center><h1>Register here:</h1></center><br />';
if (isset($_POST['pseudo'])) {
	if (isset($_POST['pseudo']) AND isset($_POST['pass1']) AND isset($_POST['pass2']) AND !(in_array($_POST['pseudo'], $pseudo))) {
		$toexe = "INSERT INTO `userspass` (`pseudo`, `password`, `email`, `Joindate`, `desc`, `admin`, `dev`) VALUES ('".str_replace("'", "&#39;", htmlspecialchars($_POST['pseudo']))."', '".sha1($_POST['pass1'])."', '', '".date('Y\-m\-d')."', '".str_replace("'", "&#39;", $_POST['desc'])."', 0, 0 )";
		//echo $toexe;
		$stmt = $db->prepare($toexe);
		if ($stmt->execute()) {
		    if (mkdir("users/".$_POST['pseudo'])
			         AND fwrite(fopen("users/".htmlspecialchars($_POST['pseudo'])."/index.php", "w"),
			             '<?php session_start; $pagen = "'.htmlspecialchars($_POST['pseudo']).' on BlueGreyDev"; $pseudog = "'.htmlspecialchars($_POST['pseudo']).'"; include("../../userspass.php"); include("../starter.php"); dorea("activity/"); ?>')?><?
			         AND fwrite(fopen('users/'.htmlspecialchars($_POST['pseudo']).'/act.dat', 'w'), 'Created account')
			         AND mkdir('users/'.htmlspecialchars($_POST['pseudo']).'/files/')
			         AND mkdir('users/'.$_POST['pseudo'].'/activity/')
			         AND $db->prepare('INSERT INTO  `u310736235_db`.`userInfo` (`pseudo` ,`lastChatCount` ,`isMute`) VALUES ("'.str_replace("'", "&#39;", htmlspecialchars($_POST['pseudo'])).'", "0", "0");')->execute() {
				echo '<center><h2>You have been registered!</h2><h3><a href="users/'.$_POST['pseudo'].'/">Here is your account</a></h3></center><br />';
				$print = 0;
                $_SESSION['pseudo'] = $_POST['pseudo'];
                $_SESSION['password'] = $_POST['pass1'];
			} else {
			    echo '<center><h3>failed (2nd step)</h3></center>';
			    $print = 1;
			}
		} else {
		  echo '<center><h3>failed (1st step)</h3></center>';
		  //print_r($stmt->errorInfo());
		  $print = 1;
		
		}
		
	}
	else {
		echo '<center><h3>You haven\'t filled all the entries, or your pseudo already exist. <a href="/userlist.php">Check here!</a></h3></center>';
		$print = 1;
	}
}
else {
    echo '<center><h1>Register here!</h1><h3>You shouldn\'t use the same password as your accounts on other websites, like your <a href="http://scratch.mit.edu/">scratch</a> account</h3></center>';
	$print = 1;
}
if ($print==1) {
	echo '<form method="post" action="inscription.php">Username: <input type="text" name="pseudo" value="'.$_POST['pseudo'].'" /><!-- <br />Email (facultative):<input type="email" name="email" value="'.$_POST['email'].'" />--> <br />Password: <input type="password" name="pass1" /> <br />Confirm password :<input type="password" name="pass2" /> <br />Description: <textarea name="desc" row="16" col="16" ></textarea><br />Submit: <input type="submit" name="inscr" value="submit" /> <br /></form>';
}
}
}
catch (Exception $e) {
	//echo $e;
}
//echo '<br />The inscription is off for security<br /><a href="trt.php">Home</a>';
?>
