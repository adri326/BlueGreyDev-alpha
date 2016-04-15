<?php session_start();
$pagen = "editing page";
include('userspass.php');
$rows = 32;
$cols = 128;
$title = $_GET['dir'].'/'.$_GET['title'];
echo '<br />you are on: <a href="'.$title.'">'.$title.'</a>';

if (isset($_SESSION['pseudo']) AND isset($_SESSION['password']) AND $_SESSION['password'] == $userspass[$_SESSION['pseudo']])
{
		$file = fopen($title, "r");
		$data = fread($file, filesize($title));
        if (substr($data, 6, 18) == "///SECURED///") {
        	echo '<h1>NOT AUTORISED</h1>';
        }
        else {
			echo '<br /><br />'.$file.'<br />'.filesize($title).'<br />'.strlen($data).'<br /><div style="border: 1px solid #222222; border-radius: 2px;">';
			echo str_replace("	", "<rr style='color:white;'>tab</rr>",str_replace("
", "<br />", htmlspecialchars($data)));
			echo '</div><br />';
			echo '<form method="post" action="'.$_GET['ok'].'">';
			echo 'name : <input type="hidden" name="title" value="'.$_GET['title'].'" /><br />';
            echo 'dir : <input type="hidden" name="dir" value="'.$_GET['dir'].'" /><br />';
			echo 'content : <textarea name="contents" rows='.$rows.', cols="'.$cols.'">'.$data.'</textarea>';
			echo '<input type="submit" name="ok"></form>';
		fclose($file);
        }
	}
