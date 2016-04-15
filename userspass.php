<?php
header('Content-type: text/html UTF-16');
$dirn = 'connectpage/../';
$mainurl = 'http://adri326.890m.com/';
$useragent=$_SERVER['HTTP_USER_AGENT'];
//really long, I found it on internet
if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))) {
	$isonmobile = true;
} else {
    if (isset($_GET['isonmobile'])) {
        $isonmobile = true;
    } else {
	   $isonmobile = false;
    }
}
//db.php contain the PDO connection, that will be stored in $db
include('db.php');
if (isset($needallusers) AND $needallusers) {
   $stmt = $db->prepare("SELECT * FROM `userspass`");
} else {
   $stmt = $db->prepare("SELECT * FROM `userspass` WHERE `pseudo` = :pseudo OR `pseudo` = :pseudo2");
   $stmt->bindParam(':pseudo', $pseudo);
  $stmt->bindParam(':pseudo2', $pseudo2);
  if (isset($_SESSION['pseudo'])) $pseudo = $_SESSION['pseudo'];
  else $pseudo = "";
  if (isset($pseudog)) $pseudo2 = $pseudog;
  else $pseudo2 = "";
}
if ($stmt->execute()) {
	$n = 0;
	while ($row = $stmt->fetch()) {
		$rows = $row;
		$n += 1;
		$pseudo[$n] = $row['pseudo'];
		$udate[$rows['pseudo']] = $row['JoinDate'];
		$userspass[$row['pseudo']] = $row['password'];
		$dev[$row['pseudo']] = $row['dev'];
		$udirn[$row['pseudo']] = $row['udirn'];
		$admin[$row['pseudo']] = $row['admin'];
		$desc[$row['pseudo']] = $row['desc'];
		$id[$row['pseudo']] = $row['id'];
	}
}

function curPageName() {
 	return substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
}
function saveState($states) {
	/*$logfiles = fopen('.a/ALOG.php', "r");
	$logdatas = fread($logfiles, filesize('.a/ALOG.php'));
	fclose($logfiles);
	$logfiles = fopen('.a/ALOG.php', "w");*/
	/*$logdatas = "
<br />".$pagen.' '.date(DATE_RFC2822).' '.$_SESSION['pseudo'].' '.$_SERVER['REMOTE_ADDR'];
	foreach($states as $datas) {
		$logdatas = $logdatas." ".$datas.' ';
	}
	$logfiles = fopen('.a/ALOG.php', "a");
	fwrite($logfiles, $logdatas);
	fclose($logfiles);*/
}
function savePage() {
	if (isset($_POST['title']))
	{
		if  (isset($_POST['contents']))
		{
			if (isset($_POST['dir']))
			{
				if ((!(substr(fread(fopen($_POST['dir'].'/'.$_POST['title'], "r"), filesize($_POST['dir'].'/'.$_POST['title'])), 6, 18) == "///SECURED///")) OR $userslevel_seepass[$_SESSION['pseudo']] == "true") {
					$file = fopen($_POST['dir'].'/'.$_POST['title'], "w");
					fwrite($file, str_replace('	', '	', $_POST['contents']));
					fclose($file);
					saveState(array('saveWithDir', $_POST['dir'], $_POST['title']));
				}
			} else {
				if ((!(substr(fread(fopen($_POST['title'], "r"), filesize($_POST['title'])), 6, 18) == "///SECURED///")) OR $userslevel_seepass[$_SESSION['pseudo']] == "true") {
				$file = fopen($_POST['title'], "w");
				fwrite($file, str_replace('	', '	', $_POST['contents']));
				fclose($file);
				saveState(array('saveWithoutDir', $_POST['dir'], $_POST['title']));
				}
			}
		}
	}
}
function curPageURL() {
	$pageURL = 'http';
	if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	$pageURL .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") {
	 $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	} else {
	 $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	}
	return $pageURL;
}
if (!(isset($pagen))) {
    $pagen = curPageName();
}
//include('password.php');
if (!($avoid_starter)) include('e_starter.php');
$debug = FALSE;
if (isset($_SESSION['pseudo']) AND isset($_SESSION['password']) AND $_SESSION['password'] == $userspass[$_SESSION['pseudo']]) {
    $connected = "true";
    $dirn = $udirn[$_SESSION['pseudo']];
}
else {
    $connected = "false";
}
function doreada($uri, $doreadAddOn, $doreadAddOnV, $doreadAddOnN, $isonmobile) {
	try {
		$list = scandir($uri);
		echo '<center><table>';
		$n = 1;
		$ndiv = 2;
		if ($isonmobile)  { $ndiv = 1;
		}
		$list = array_reverse($list);
		foreach($list as $act) {
			if (substr($act, strlen($act)-3, strlen($act)) == 'wdg' AND substr($act, 0, 1) !== ".") {
				$n += 1;
				if ($n/$ndiv == round($n/$ndiv)) {
					echo '<tr style="padding-top: 25% !important; vertical-align: top;"><td class="post">';
				}
				else {
					echo '<td class="post">';
				}
				$uritype= $uri.str_replace('wdg', 'wdd', $act);
				if ($doreadAddOn == "true") { echo '<a href="'.$doreadAddOnV.'?post='.$act.'">'.$doreadAddOnN.'</a>'; }
				$ftype = fopen($uritype, "r");
				$type = fread($ftype, filesize($uritype));
				fclose($ftype);
				$file = fopen($uri.$act, 'r');
				if ($type=="HTML") {
					echo '<center>'.fread($file, filesize($uri.$act)).'</center>';
				}
				elseif ($type=="SCRATCH") {
					$content = fread($file, filesize($uri.$act));
					$len = substr($content, 0, 1);
					$nchange = 1;
					if ($len=="1") {
						$len = substr($content, 0, 2);
						$nchange = 2;
					}
					$suser = "";
					$nchange_ = 0;
					if (substr($content, $len+$nchange, 1)=="+") {
						$nchange_ = 5;
						$nchange_ += substr($content, $nchange+$len+1, 4);
						$len_ = substr($content, $nchange+$len+1, 4);
						$suser = ' by <a href="http://scratch.mit.edu/users/'.substr($content, $nchange+$len+5, $len_).'"> '.substr($content, $nchange+$len+5, $len_).'</a>';
					}
					echo '<center><h2>'.htmlspecialchars(substr($content, $len+1+$nchange_)).'</h2><h4>Scratch project';
					echo $suser;
					echo '</h4><br /><a class="imgtoscratch" href="../../scratch.php?code='.htmlspecialchars(substr($content, $nchange, $len)).'"><img class="imgtoscratch" src="https://scratch.mit.edu/static/site/projects/thumbnails/'.htmlspecialchars(substr($content, $nchange, $len-4)).'/'.htmlspecialchars(substr($content, $len-4+$nchange, 4)).'.png" /></a></center>';
				}
				elseif ($type=="APK") {
					$content = fread($file, filesize($uri.$act));
					$len = intval(substr($content, 0, 4));
					echo '<center><h2>'.htmlspecialchars(substr($content, 4, $len)).'</h2><h4>Application</h4><a href="files/'.htmlspecialchars(substr($content, $len+4)).'"><img src="http://adri326.890m.com/white_robot.png"></a></center>';
				} elseif ($type=="SCRATCHUSER") {
					$content = fread($file, filesize($uri.$act));
					$len = intval(substr($content, 0, 4));
					echo '<center><h2>'.htmlspecialchars(substr($content, $len+4)).'</h2><h3><a href="https://scratch.mit.edu/users/'.htmlspecialchars(substr($content, 4, $len)).'">'.htmlspecialchars(substr($content, 4, $len)).'</h3><img src="/Scratchcat.png" /></a></center>';
				}
				fclose($file);
				if (($n+1)/$ndiv == round(($n+1)/$ndiv)) {
					echo '</td></tr>';
				}
				else {
					echo '</td>';
				}
			}
		}
		echo '</table></center>';
	}
	catch (Exception $e) {
		echo $e;
	}
	return "";
}
function doread($uri, $a, $b, $c) {
	$useragent=$_SERVER['HTTP_USER_AGENT'];
	if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))) {
		$isonmobile = true;
	} else {
 		if (isset($_GET['isonmobile'])) {
			$isonmobile = true;
		} else {
			$isonmobile = false;
		}
	}
	doreada($uri, $a, $b, $c, $isonmobile);
}
function dorea($uri) {
	doread($uri, "", "", "");
}
function issafe($content) {
    $r = true;
    if (!(strstr($_POST['content'], '<script')===FALSE)) {
        $r = false;
    }
    if (!(strstr($_POST['content'], '<style')===FALSE)) {
        $r = false;
    }
    return $r;
}
?>