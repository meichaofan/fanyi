<?php
//查看文件夹下的内容
require_once 'function.php';
$folder=$_SESSION['user_folder'].DIRECTORY_SEPARATOR.'source';
opendirectory($folder,$meurl);
