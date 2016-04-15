<?php session_start();
include('userspass.php');
$stmt = $db->prepare('SELECT * FROM forum_master WHERE 1 LIMIT 0, 100');
if ($stmt->execute()) {
	$n = -1;
	while ($row = $stmt->fetch()) {
		$n += 1;
		$forumTitle[$n] = $row['name'];
		$forumDesc[$n] = $row['desc'];
		$forumId[$n] = $row['id'];
		$forumDir[$n] = $row['dir'];
	}
	$nfound = 0;
	$nn = $n;
	echo '<center><h1>Find your forum:</h1><br /><br /><form action="" method="get"><input type="text" name="fsearch" class="forumInput" value="'.$_GET['fsearch'].'" /><input type="submit" style="font-size: 200%; height: 1.5em;"/></form><br /><h2><br /><br /><a href="newForum.php">Or create one</a></h2><br /><br /></center>';
	asort($forumDir);
	if (isset($_GET['fsearch'])) {
	   $inDir = $_GET['fsearch'];
	}
	else if (isset($_GET['ftitle'])) {
	   $inDir = $_GET['ftitle'];
	} else {
	   $inDir = '/';
	}
	foreach($forumDir as $n => $actDir) {
		$actDesc = $forumDesc[$n];
		$actTitle = $forumTitle[$n];
		$actId = $forumId[$n];
		if (!isset($_GET['ftitle']) OR ($_GET['ftitle']==$actTitle AND $actTitle != "")) {
			if (!isset($_GET['fdesc']) OR ($_GET['fdesc']==$actDesc AND $actDesc != "")) {
				if (!(isset($_GET['fsearch']) AND $_GET['fsearch']!="") OR (levenshtein(strtoupper($_GET['fsearch']), strtoupper($actTitle))/strlen($actTitle)<0.5) OR (levenshtein(strtoupper($_GET['fsearch']), strtoupper($actDesc))/strlen($actDesc)<0.8) OR $_GET['fsearch']==$actId OR strtoupper($_GET['fsearch'])==strtoupper($actDir)) {
					$nfound += 1;
					echo '<div class="i" style="margin-left: ';
					if (!$isonmobile) {
					   echo ((substr_count($actDir, '/')-1)*4);
					}
					if ((!$isonmobile) OR ((substr_count($actDir, '/')-substr_count($inDir, '/'))<1)) {
					   echo 'em"><h2 style="forumTitle"><a href="showForum.php?forum='.$actId.'">'.$actTitle.'</a> - #'.$actId.'</h2><div class="forumAdditional"><table><tbody><tr><td><h4 class="forumDir">'.$actDir.'</h4></td></tr><tr><td><h4 class="forumSub"><a href="?fsearch=/'.$actTitle.'/">see subforums </a> or <a href="newForum.php?dir=/'.$actTitle.'/"> create a subforum</a></h4></td></tr></tbody></table></div><div class="forumDesc">'.$actDesc.'</div></div>';
					}
				}
			}
		}
	}
}