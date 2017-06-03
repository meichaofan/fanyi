<?php
session_start();
$enclosedFolder=$_SESSION['folder'].DIRECTORY_SEPARATOR;
$files =count(isset($_FILES['file-fr']['name'])?$_FILES['file-fr']['name']:0);
$infofilesUploaded = array();
for($i = 0; $i < $files; $i++) {
    $nameFile=isset($_FILES['file-fr']['name'][$i])?$_FILES['file-fr']['name'][$i]:null;
    $nameTemp=isset($_FILES['file-fr']['tmp_name'][$i])?$_FILES['file-fr']['tmp_name'][$i]:null;
    $pathFile=$enclosedFolder.$nameFile;
    move_uploaded_file($nameTemp,$pathFile);
}
echo json_encode(1);
?>
