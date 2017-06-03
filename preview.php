<?php
$file=$_REQUEST['file'];
$folder=$_REQUEST['folder'];
$path=$folder.DIRECTORY_SEPARATOR.$file;
$filename=substr($file,0,-4);

$path1=explode('/', $path);
$length=count($path1);
$newpath=DIRECTORY_SEPARATOR.$path1[$length-4].DIRECTORY_SEPARATOR.$path1[$length-3].DIRECTORY_SEPARATOR.$path1[$length-2].DIRECTORY_SEPARATOR.$path1[$length-1];
if(file_exists($path)){
    echo "<div class=\"sub-header\">文件名: $filename</div>";
    echo "<embed src='$newpath' width='100%' height='850px'></embed>";
};
