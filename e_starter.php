<?php session_start(); ?><!DOCTYPE html>
<html>
    <head>
        <title>
            <?php if (isset($pagen)) { echo $pagen; } else { echo curPageName(); } ?>
        </title>
        <link rel="stylesheet" href="<?php if ($isonmobile) { echo $mainurl.'pstyle.css'; } else { echo $mainurl.'cstyle.css'; } ?>"></link>
        <!--[if lt IE 9]>
            <script src="http://github.com/aFarkas/html5shiv/blob/master/dist/html5shiv.js"></script>
        <![endif]-->
        <meta charset="UTF-8" />
        <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="manifest" href="/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">
        <meta name="description" content="You always got worried because no one see your projects and your programs? We let you share a lot of programs in a lot of languages from a lot of platforms." />
        <script>
  		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
 		 (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
 		 m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
 		 })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		 
 		 ga('create', 'UA-75354706-2', 'auto');
 		 ga('send', 'pageview');<?php $chat = $_GET['chat'] ?>
 		 <?php if ($chat == "true") { ?>var pseudo = "<?php echo $_SESSION['pseudo']; ?>", pw = "<?php echo sha1($_SESSION['password']) ?>", sid = "<?php echo session_id(); ?>";<?php } ?>
        </script>
        <?php if ($chat == "true") { ?><script src="/chat.js"></script><?php } ?>
        <script>
        function scrollHandler() {
            var iconTable = document.getElementById('iconTable');
            var scroll = document.body.scrollTop || document.documentElement.scrollTop || 0;
            var height = document.body.height;
            iconTable.style.opacity = 1-Math.pow(scroll/<?php if ($isonmobile) echo '500'; else echo '50';?>, 1.5);
            iconTable.style.top = (<?php if ($isonmobile) echo '120'; else echo '30';?>-Math.pow(scroll/<?php if ($isonmobile) echo '500'; else echo '50';?>, 1.5)*<?php if ($isonmobile) echo '120'; else echo '30';?>)+"px";
        }
        window.addEventListener('scroll', scrollHandler);
        <?php if ($isonmobile) echo 'window.setInterval(scrollHandler(), 5);'; ?>
        </script>
    </head>
    <body onscroll="scrollHandler();">
    <div class="header">
    <table id="nav"><tbody><tr>
    	<td class="i3" id="nav1"><h2><a class="h2" href="http://adri326.890m.com/trt.php"><!--img id="nav1img" src="<?php echo $mainurl; ?>home.png" height="100%" width="25%" />--!>Home</a></h2></td>
    	<td class="i3" id="nav2"><h2><a class="h2" href="http://adri326.890m.com/users/<?php if (isset($_SESSION['pseudo'])) { echo $_SESSION['pseudo']; echo '">My page'; } else { echo 'adri326">My page'; } ?></a></h2></td>
        <td class="i3" id="nav3"><h2><a class="h2" href="http://adri326.890m.com/explore.php">Explore</a></h2></td>
        <?php if (strpos($page, "users") !== false) { echo '<td class="i3"><h2><a href="http://adri326.890m.com/newpage.php?title='.getCurrentURL().'&indexpage=users/'.$_SESSION['pseudo'].'">Edit</a></h2></td>'; } ?>
    </tr></tbody></table>
    </div>
    <table class="iconsTable" id="iconTable"><tbody><tr>
        <td class="posterItem">
            <a href="http://adri326.890m.com/post/">
                <img src="http://adri326.890m.com/plus_icon.png" width="30px" height="30px" />
            </a>
        </td>
        <td class="posterItem">
            <img id="BlueGreyBot" src="http://adri326.890m.com/BlueGreyBot_80x80_black.png" width="30px" height="30px" />
        </td>
        <?php if (isset($_SESSION['pseudo']) AND isset($_SESSION['password']) AND sha1($_SESSION['password']) == $userspass[$_SESSION['pseudo']]) { ?>
        <td class="posterItem">
            <a href="http://adri326.890m.com/discuss.php">
                <center style="line-height: <?php if ($isonmobile) echo '120px'; else echo '30px'; ?>"><span id="textAnim" style='font: "Arial", Arial, sans-serif; color: #ffffff; text-align: center;'><?php
                    $stmt = $db->prepare("SELECT * FROM `chat`");
                    if ($stmt->execute()) {
                        $n = 0;
                        $chat = $stmt->fetchAll();
                    }
                    $n1 = count($chat);
                    $stmt = $db->prepare("SELECT * FROM `userInfo` WHERE pseudo = :pseudo");
                    $stmt->bindParam(':pseudo', $_SESSION['pseudo']);
                    if ($stmt->execute()) {
                        $n2 = $stmt->fetch()['lastChatCount'];
                    }
                    if ($n1-$n2!=0 AND isset($n2)) { echo $n1-$n2; } else { echo 'A'; }
                ?></span></center>
            </a>
        </td>
        <?php } ?>
        <?php if ($pseudog == ''.$_SESSION['pseudo'].'' AND isset($_SESSION['password'])) { ?>
        
        <td class="posterItem">
            <a href="http://adri326.890m.com/unpost.php">
                <img src="http://adri326.890m.com/pencil-white-icon.png" width="20px" height="20px" style="margin: 5px;" />
            </a>
        </td>
        
        
        <? } ?>
        
    </tr></tbody></table>
    <?php if ($chat == "true") { ?><div id="chatBox"><div id="chat">Chat is loading...</div><form onsubmit="send(); return false;"><table><tbody><tr><td><input id="message"></input></td><td><input type="submit" onclick="send();" value="send" /></td></tr></tbody></table></form></div><?php } ?>
    <div class="contain">
        