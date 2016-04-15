<div class="left" id="lefttop">
	<h2>Welcome on BlueGreyDev</h2>
	<h3><a href="inscription.php">The registration is now out!</a></h3>
	<h3><a href="findForum.php">The forums are now out !</a></h3>
	<h4>This is our new mascott:</h4>
	<a href="/BlueGreyBot_800x800.png"><img src="BlueGreyBot_128x128.png" /></a>
</div>
<div class="right" id="righttop">
	<h2>To participate, you need to login. You don't have any account? <a href="inscription.php">Register here!</a></h2><br />
	<?php 
	if (isset($_SESSION['pseudo']) AND isset($_SESSION['password']) AND sha1($_SESSION['password']) == $userspass[$_SESSION['pseudo']]) {
		echo 'You are connected, <a href="disconnect.php">disconnect here</a>!<br /><a href="unpost.php">Manage your page</a>';
        if ($admin[$_SESSION['pseudo']]==1) {
            echo '<br />You are an administrator, <a href="admin">here is the admin page</a>';
        }
        echo '<h3><a href="/discuss.php">Do you saw the last feature? IRC!</h3>';
    
	} else {
		echo '<form method="post" action="http://adri326.890m.com/trt.php">Username: <input type="text" name="pseudo" /> <br />Password: <input type="password" name="password" /> <br />Submit: <input type="submit" name="ok" /> <br /></form>';
	}
		?>
		
</div>
<div class="left" id="leftbottom">
	<!--<h2>Annonce aux utilisateurs:</h2><br />
	<h3>Tout va changer! Le style (vous pouvez le voir), mais aussi les parties de d&egrave;veloppement et des zones de partages seront &eacute;tablies.</h3>
	<br />
	D&eacute;sormais, il n'y aura plus de log (qui conserverait les modifications de tout fichier, les dates de ces modifications, l'heure et l'utilisateur ayant modifi&eacute; le fichier). Il y aura par contre des s&eacute;curit&eacute;s, pour &eacute;viter que vous ne modifiez les fichiers de base ou les fichiers personnels des autres utilisateurs.<br />
	L'interface aussi changera : vous aurez un espace personnel, un espace partag&eacute; priv&eacute; et une zone ouverte &agrave; tout le monde, ainsi qu'une interface de partage hors utilisateurs inscrits.<br />
	Les mots de passes et les pseudonymes seront sauvegard&eacute;s dans une base SQL. L'inscription automatique sera en cons&eacute;quence possible. Je suis preneur pour toute aide.<br />
	Ces modifications sont en cours de d&eacute;veloppement, seul cette page et la <a href="connectpage/appdownload.php">page de t&eacute;l&eacute;chargement d'applications</a> sont accessible. Je suis preneur pour de l'aide au d&eacute;veloppement ou juste quelques id&eacute;es.<br />
	Attention: pensez &agrave; installer la mise &agrave; jour de mon application Galaxy Particles avant le 1er mars, date o&ugrave; je bougerais l'index des applications.<br />
	-->
	<h2>What will you find on this site?</h2>
	<br />This site will be used to share programs, scratch projects or user-madeapplications. It will help you to share them by making you more visible.
	<br />
	<a href="mailto:adrien.burgun@orange.fr">Contact me for any information!</a>
	<br /><br />
	<h2>How can you use this site?</h2>
	<a href="/license.php">You can see here the general utilisation license</a>
	<h3><a href="partenaires.php">Our collaborators</a></h3>
</div>
<div class="right" id="rightbottom">
	You can find my apps <a href="connectpage/appdownload.php">here</a>.
	<br />Want to find me?<br />
	<center><table><tbody>
		<tr>
			<td class="i2 i1"><a href="https://scratch.mit.edu/users/adri326">adri326 on Scratch</a></td>
		</tr><tr>
			<td class="i2 i1"><a href="mailto:adrien.burgun@orange.fr">adri326's mail</a></td>
		</tr><tr>
			<td class="i2 i1"><a href="https://plus.google.com/u/0/109298254468686423781/posts">adri326 on Google+</a></td>
		</tr><tr>
			<td class="i2 i1"><a href="https://www.facebook.com/profile.php?id=100009224182291">adri326 on Facebook</a></td>
		</tr><tr>
			<td class="i2 i1"><a href="users/adri326/">adri326 on this website</a></td>
		</tr>
	</tbody></table></center>
	<br />
	My social life take me more and more time, and I haven't so much time for this website, but I try to work on it the most time I can!
</div>