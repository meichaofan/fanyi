<?php
include_once 'header.php';
session_start();
if (! isset($_SESSION['flag'])) {
$_SESSION['access'] = true;
}
$meurl = $_SERVER['PHP_SELF'];
$left = (isset($_REQUEST['left'])) ? htmlspecialchars($_REQUEST['left']) : 'home';
$right = (isset($_REQUEST['right'])) ? htmlspecialchars($_REQUEST['right']) : 'diy';
$folder = (isset($_REQUEST['folder'])) ? htmlspecialchars($_REQUEST['folder']) : './';


?>
<body class="container">
<nav class="navbar navbar-default" role="navigation">
<div class="container-fluid">
<div class="navbar-header">
<ul class="nav navbar-nav navbar-right">
<li><a href="?left=home&right=diy"><span
class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;首页</a></li>
<?php 
//用户登录成功，就可以进入用户家目录
if(isset($_SESSION['username']))
echo '<li><a href="?left=userhome"><span class="glyphicon glyphicon-heart-empty"></span>&nbsp;&nbsp;家目录</a></li>';
?>
<?php
if(isset($_SESSION['username']))
echo "<li><a href='?left=select'><span class='glyphicon glyphicon-file'></span>&nbsp;&nbsp;上传文件</a></li>";
?>
<li><a href="?left=input&right=output"><span
class="glyphicon glyphicon-arrow-right"></span>&nbsp;&nbsp;短句翻译</a></li>
<?php 
//判断用户有无登录，不管是否激活成功
if(isset($_SESSION['username']))
echo "<li><a href='?left=logout'><span class='glyphicon glyphicon-log-out'></span>&nbsp;&nbsp;退出</a></li>";
?>
</ul>
</div>
<ul class="nav navbar-nav navbar-right">
<?php if(isset($_SESSION['username']) && isset($_SESSION['gender'])){
    if($_SESSION['gender']==0){
echo "<li><img style='width: 50px;height: 50px;' class='img-circle' src='image/boy.jpg' alt='头像'/></li> ";
    }else{
echo "<li><img style='width: 50px;height: 50px;' class='img-circle' src='image/girl.jpg' alt='头像'/></li> ";
    }
}
else{
?>
<li><a href="register.php"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;注册</a></li>
<li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span>&nbsp;&nbsp;登录</a></li>
<?php } ?>
</ul>
</div>
</nav>
<div class="row">
    <div class="col-md-1 col-md-offset-11"><div id="player2" class="aplayer"></div></div>
</div>
<div class="col-sm-6">
<div class="jumbotron">
<?php
switch ($left) {
case 'home':
require_once 'home.php';
break;
case 'select':
require_once 'select.php';
break;
case 'preview':
require_once 'preview.php';
break;
case 'translate':
require_once 'translate.php';
break;
case 'input':
require_once 'input.php';
break;
case 'regist_success':
require_once 'regist_success.php';
break;
case 'regist_fail':
require_once 'regist_fail.php';
break;
case 'active_success':
require_once 'active_success.php';
break;
case 'active_fail':
require_once 'active_fail.php';
break;
case 'logout':
require_once 'logout.php';
break;
case 'userhome':
require_once 'userhome.php';
break;
}
?>
</div>
</div>
<div class="col-sm-6">
<div class="jumbotron">
<?php
switch ($right) {
case 'translate':
require_once 'translate.php';
break;
case 'output':
require_once 'output.php';
break;
case 'diy':
require_once 'diy.php';
break;
}
?>
</div>
</div>
<nav class="navbar navbar-default navbar-fixed-bottom">
<p class="text-right"><?php require_once 'function.php'; $number=online(); echo "当前在线人数：".$number[0]."&nbsp;&nbsp"."历史访问人数：".$number[1];  ?></p>
</nav>
<?php
include_once 'footer.php';
?>

