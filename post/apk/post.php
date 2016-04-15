<?php session_start();
include('../../userspass.php');
if (isset($_SESSION['pseudo']) AND isset($_SESSION['password']) AND $_SESSION['password'] !== '' AND sha1($_SESSION['password']) == $userspass[$_SESSION['pseudo']]) {
$date = date("Y\-m\-d\-H\-i\-s");
$target_dir = "../../users/".$_SESSION['pseudo'].'/files/'.$date.'/';
mkdir("../../users/".$_SESSION['pseudo'].'/files/'.$date);
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
$imagefileext = substr($_FILES['fileToUpload']['name'], strrpos($_FILES['fileToUpload']['name'], '.'));
echo '<center>';
if ($_FILES["fileToUpload"]["size"] > 5000000) {
    echo "<h2>Sorry, your file is too large, contact the administrator to upload it via FTP</h2>";
    $uploadOk = 0;
}
echo '<b>'.substr($_FILES['fileToUpload']['name'], 0, strrpos($_FILES['fileToUpload']['name'], '.')-0);
echo '</b>'.$imagefileext.'';
if ($imagefileext!==".apk") {
	$uploadOk = 0;
	echo "<h2>Your file isn't an application, it cannot be uploaded</h2>";
}

if ($uploadOk == 0) {
    echo "<h2>Sorry, your file was not uploaded, it is either not an application, or it is too large</2>";
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "<h2>The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded</h2>";
        if (fwrite(fopen('../../users/'.$_SESSION['pseudo'].'/activity/'.$date.'.wdg', 'w'), sprintf("%04d", strlen($_POST['title'])).$_POST['title'].$date.'/'.$_FILES['fileToUpload']['name']) AND fwrite(fopen('../../users/'.$_SESSION['pseudo'].'/activity/'.$date.'.wdd', 'w'), 'APK') AND fwrite(fopen('../../users/'.$_SESSION['pseudo'].'/act.dat', 'a'), '/nPosted an android app')) {
        	echo '<br /><h2>The application has been posted on your page</h2>';
        } else {
        	echo '<br /><h2>There were an error while posting your application on your page, but the file is still there</h2>';
        }
    } else {
        echo " Sorry, there was an error uploading your file.";
    }
}
}
?>