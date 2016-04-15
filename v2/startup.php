<?php

session_start();

require __DIR__.'/classes/mysql.php';
require __DIR__.'/classes/userClass.php';

$mysql = new MySQLHandler('mysql.hostinger.fr', 'u310736235_db', 'u310736235_root', 'administrator');

$usersData = $mysql->executeCommand('SELECT * FROM `userspass`');

if ($usersData !== false) {
    
    foreach ($usersData as $actN => $actUser) {
        
        $user[$actN] = new User($actUser);
        
        if (isset($_GET['dev'])) echo $user[$actN]->getState();
        
        if (isset($_SESSION['password']) AND isset($_SESSION['pseudo']) AND $user[$actN]->isConnected(sha1($_SESSION['password']))) {
            
            if (isset($_GET['dev'])) echo ' <span style="color: #91CDF2">Connected</span>';
            $connectedAs = $user[$actN]->getPseudo();
            
        }
        
        echo '<br />';
        
    }

} else {
    
    echo 'There were an error while loading the users';
    
}

unset($usersData);
unset($actN);
unset($actUser);
unset($mysql);

include(__DIR__.'/classes/drawableClass.php');
$d = new Drawable("scratch", "818009287lol");
echo $d->draw();

?>