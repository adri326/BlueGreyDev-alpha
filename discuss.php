<?php session_start();
$pagen = "Discuss!";
include('userspass.php');
if (isset($_SESSION['pseudo']) and isset($_SESSION['password']) and $_SESSION['password'] !== '' and sha1($_SESSION['password']) == $userspass[$_SESSION['pseudo']]) {
    $stmt = $db->prepare("SELECT * FROM `chat`");
    if ($stmt->execute()) {
        $n = 0;
        $chat = $stmt->fetchAll();
    }
    $stmt = $db->prepare('UPDATE `userInfo` SET `lastChatCount` = '.count($chat).' WHERE pseudo = :pseudo');
    $stmt->bindParam(':pseudo', $_SESSION['pseudo']);
    if ($stmt->execute()) {} else { echo 'failed '; var_dump($stmt->errorInfo()); };
    if (isset($_POST['message']) AND substr($_POST['message'], 0, 1)!="/") {
        $stmt = $db->prepare('SELECT `isMute` FROM `userInfo` WHERE pseudo = :pseudo');
        $stmt->bindParam(':pseudo', $_SESSION['pseudo']);
        if ($stmt->execute()) {
            $isMute = $stmt->fetch()['isMute'];
                if ($isMute==0) {
                $stmt = $db->prepare('INSERT INTO `u310736235_db`.`chat` (`pseudo` , `post`) VALUES ( :pseudo , :post )');
                $stmt->bindParam(':pseudo', $_SESSION['pseudo']);
                $stmt->bindParam(':post', $_POST['message']);
                $stmt->execute();
            } else {
                echo 'You are muted';
            }
        } else {
            echo 'failed ';
            var_dump($stmt->errorInfo());
        }
        
    }
    if (isset($_POST['message']) AND substr($_POST['message'], 0, 1)=="/" AND $admin[$_SESSION['pseudo']]==1) {
        echo 'Command typed: '.$_POST['message'];
        $command = substr($_POST['message'], 1, strpos($_POST['message'], ' ')-1);
        if ($command=="mute") {
            $stmt = $db->prepare('UPDATE `userInfo` SET `isMute` = 1 WHERE pseudo = :pseudo');
            $pseudo = substr($_POST['message'], strpos($_POST['message'], ' ')+1);
            $stmt->bindParam(':pseudo', $pseudo);
            if (($stmt->execute())) {
                echo '<br />successfully muted '.$pseudo;
            } else {
                echo 'failed ';
                var_dump($stmt->errorInfo());
            }
        }
        if ($command=="unmute") {
            $stmt = $db->prepare('UPDATE `userInfo` SET `isMute` = 0 WHERE pseudo = :pseudo');
            $pseudo = substr($_POST['message'], strpos($_POST['message'], ' ')+1);
            $stmt->bindParam(':pseudo', $pseudo);
            if (($stmt->execute())) {
                echo '<br />successfully unmuted '.$pseudo;
            } else {
                echo 'failed ';
                var_dump($stmt->errorInfo());
            }
        }
    }
    include('chat.php');
    $r = $r.'<tr><td colspan="2"></td></tr></tbody></table></div><form method="post"><input type="text" name="message" placeholder="Type here your message" style="width: ';
    if ($isonmobile) $r = $r.'12';
    else $r = $r.'40';
    $r = $r.'em;" /><input type="submit" name="submit" value="Send" /></form>';
    echo '<h3>Do not post any personal info, adress or passwords</h3>';
    echo $r;
    echo '<script src="/chat.js"></script>';
} else {
    echo 'You aren\'t connected!';
}