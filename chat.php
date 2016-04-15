<?php
$stmt = $db->prepare("SELECT * FROM `chat` ORDER BY `chat`.`id`  DESC LIMIT 0, 10");
if ($stmt->execute()) {
    $n = 0;
    $chat = array_reverse($stmt->fetchAll());
}
$stmt = $db->prepare('SELECT `lastChatCount` FROM `userInfo` WHERE `pseudo` = :pseudo');
$stmt->bindParam(':pseudo', $_GET['pseudo']);
if ($stmt->execute()) $n2 = $stmt->fetchAll()[0]['id'];
if ($chat[0]['id']==$n2) {
    $r = "unchanged";
} else {
    $r = $r."<div id=\"chat\"><table><tbody>";
    foreach($chat as $n => $act) {
        
        if (count($chat)-$n<10) {
            $r = $r."<tr><td class='i' style='padding: 4px;' width='10%'><a href='/users/".$act['pseudo']."'>".$act['pseudo']."</a></td><td class='i' width='90%'>".htmlspecialchars($act['post'])."</td></tr>";
        }
    }
    $stmt = $db->prepare('UPDATE `userInfo` SET `lastChatCount` = :count WHERE `pseudo` = :pseudo');
    $stmt->bindParam(':pseudo', $_GET['pseudo']);
    $stmt->bindParam(':count', $chat[0]['id']);
    $stmt->execute();
}
?>