<?php session_start();
$pagen = 'download an application';
include('userspass.php');
	echo '<br /><br /><br /><br />';
	$page = 'users/adri326/apk';
	$fileslist = scandir($page);
	$a = 1;
	$c = 1;
	$n = count($fileslist);
	echo '<div style="padding-left:25px;"><strong><u>'.($n).' files found: </u></strong></div><br /><table><tr>';
	while ($a < $n)
	{
        if (substr($fileslist[$a], 0, 1) == '.') {
			
			$c = $c + 1;
			
			$a = $a + 1;
		}
		else
		{
			if (is_dir($page.'/'.$fileslist[$a]))
			{
				if (($a-$c) <10) {
					echo '<td class="i">'.($a-$c).' ==> <a href="index.php?page='.$page.'/'.$fileslist[$a].'">'.$fileslist[$a].'</a></td></tr><tr>';
				}
				else
				{
					echo '<td class="i">'.($a-$c).' => <a href="index.php?page='.$page.'/'.$fileslist[$a].'">'.$fileslist[$a].'</a></td></tr><tr>';
				}
			$a = $a + 1;
			}
			else
			{
				if (($a-$c) <10) {
					echo '<td class="i">'.($a-$c).' ==> <a href="'.$page.'/'.$fileslist[$a].'">'.$fileslist[$a].'</a></td></tr><tr>';
		$a = $a + 1;
				}
				else
				{
					echo '<td class="i">'.($a-$c).' => <a href="'.$page.'/'.$fileslist[$a].'">'.$fileslist[$a].'</a></td></tr><tr>';
		$a = $a + 1;
				}
			}
		}
		
	}
	echo '</tr></table>';
	echo 'You can go back to the <a href="trt.php"> main page</a><br />';
    include('ender.php');
?>