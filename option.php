<?php session_start();
include('userspass.php');
if (isset($_SESSION['pseudo']) AND isset($_SESSION['password']) AND $_SESSION['password'] == $userspass[$_SESSION['pseudo']])
{
	
	/////\\\\\
	
	if (isset($_POST['ok'])) {
		if (isset($_POST['visualchart'])) {
			$_SESSION['vchart'] = $_POST['visualchart'];
			saveState(array("option".$_POST['visualchart']));
		}
	}
	if (isset($_POST['naccount']) AND isset($_POST['accept']) AND isset($_POST['type']) AND isset($_POST['email'])) {
		$faccount = fopen('.a/rq.log', "r");
		if (filesize('.a/rq.log') > 0) {
			$faccountdata = fread($faccount, filesize('.a/rq.log'));
		}
		fclose($faccount);
		$faccount = fopen('.a/rq.log', "w");
		fwrite($faccount, $faccountdata."<br />".$_POST['pseudo'].' '.$_POST['email'].' '.$_SERVER['REMOTE_ADDR'].' '.$_POST['type'].' '.$_POST['mail']);
                saveState(array("createAccount", $_POST['pseudo'], $_POST['email'], $_POST['type']));
		fclose($faccount);
	}
	else {if (isset($_POST['naccount'])) { echo 'Sorry, you haven\'t filled in all the informations...<br />'; }}
		
	
	/////\\\\\
	
	echo '<form action="option.php" method="post">';
	echo 'Version de la charte visuelle : <span><br /><input type="radio" name="visualchart" value="1" ';
	if (isset($_SESSION['vchart']) AND $_SESSION['vchart'] == 1) {
		echo 'checked';
	}
	echo ' />Julie<br />';
	echo '<input type="radio" name="visualchart" value="0"';
	if (isset($_SESSION['vchart']) AND $_SESSION['vchart'] == 0) {
		echo 'checked';
	}
	echo ' />Adrien</span>';
	echo '<br />';
	
	/////>>save<<\\\\\
	
	echo '<input type="submit" name="ok" value="Enregistrer" />';
	
	/////>>request account<<\\\\\
	
	echo '<br /><br /><form action="option.php" method="post">Demander un compte personnel :<br />';
	echo 'Nom d\'utilisateur : <input type="text" name="pseudo" /><br />';
	echo 'Adresse mail : <input type="email" name="email" /><br />';
	echo '<input type="checkbox" name="accept" />J\'accepte que mon ip, mon mot de passe, mon pseudo et d\'autres informations entrées dans le site seront enregistrées. Le nombre d\'informations enregistrées pourra varier à tout moment, sans avertissement.<br />';
	echo '<input type="radio" name="type" value="basic" />Basic<br />';
	echo '<input type="radio" name="type" value="admin" />Administrator<br />';
	echo '<input type="radio" name="type" value="tryer" />Testeur<br />';
	echo '<input type="submit" name="naccount" value="Request Account" /></form>';
}
?>