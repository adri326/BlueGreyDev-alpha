<?php
session_start();
include('userspass.php');
if (isset($_SESSION['pseudo']) AND isset($_SESSION['password']) AND $_SESSION['password'] == $userspass[$_SESSION['pseudo']])
{
$target_dir = "../connectpage/link/";
if (isset($_GET['indexpage'])) {
  $target_dir = $_GET['indexpage'].'/';
}
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["img_submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    /*if($check !== false) {
        echo "File is ok: " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        //$uploadOk = 0;
    }*/
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large, contact the administrator to upload it via FTP.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        saveState(array("UploadSuccess", $_FILES["fileToUpload"]["tmp_name"], $target_file));
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        saveState(array("UploadFail", $_FILES["fileToUpload"]["tmp_name"], $target_file));
        echo " Sorry, there was an error uploading your file.";
    }
}
if (isset($_GET['indexpage'])) {
echo '<br /><a href="index.php?page='.$_GET['indexpage'].'" >Back to the Index</a>';
}
}
?>