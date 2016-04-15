<?php if (isset($mainurl)) {
	//echo $pseudog;
	echo '<table><tbody>';
	if ($isonmobile) {
		echo '<tr><td style="width: 25%;" id="profileLeft"><center><h2>'.$pseudog.'</h2><br /><h3>Joined the '.$udate[$pseudog].'</h3></center></td></tr><tr><td style="width: 50%;"><center><h2>Last activity:</h2><table><tbody>';
		$actlistpre = explode("/n", fread(fopen("act.dat", "r"), filesize("act.dat")));
		for ($i = 1; $i <= 5; $i++) {
			//echo $i;
			if (isset($actlistpre[count($actlistpre)-$i])) {
				$actlist[$i] = $actlistpre[count($actlistpre)-$i];
			}
		}
		foreach($actlist as $actdata) {
			echo '<tr><td class="i">'.$actdata.'</td></tr>';
		}
		echo '</tbody></table></center></td></tr><tr><td id="profileRight"><center><h2>Who am I?</h2>'.$desc[$pseudog].'</center></td></tr></tbody></table>';
	} else {
		echo '<tr><td style="width: 25%;" id="profileLeft"><center><h2>Who am I?</h2>'.$desc[$pseudog].'</center></td><td style="width: 50%;"><center><a href="../activity.php?user='.$pseudog.'"><h2>Last activity:</h2></a><table><tbody>';
		$actlistpre = explode("/n", fread(fopen("act.dat", "r"), filesize("act.dat")));
		for ($i = 1; $i <= 5; $i++) {
			//echo $i;
			if (isset($actlistpre[count($actlistpre)-$i])) {
				$actlist[$i] = $actlistpre[count($actlistpre)-$i];
			}
		}
		//var_dump($actlistpre);
		//echo '<br />'.count($actlistpre).'<br />';
		//var_dump($actlist);
		foreach($actlist as $actdata) {
			echo '<tr><td class="i">'.$actdata.'</td></tr>';
		}
		echo '</tbody></table></center></td><td id="profileRight"><center><h2>'.$pseudog.'</h2><br /><h3>Joined the '.$udate[$pseudog].'</h3></center></td></tr></tbody></table>';
	}
	echo '<br /><br />';
}
?>