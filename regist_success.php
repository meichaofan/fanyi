<?php
$_SESSION['regist']=1; //1.表示注册成功，账号未激活
//注册成功，在user文件夹下，创建用户的家目录
$app_path=dirname(__FILE__);
$path=$app_path.DIRECTORY_SEPARATOR.'user';
$home=$path.DIRECTORY_SEPARATOR.$_SESSION['username'];
$res1=mkdir($home,0777,true);
//在家目录下创建两个文件夹，source,destinate,并把common中的文件，复制到source中
if($res1){
    $source=$home.DIRECTORY_SEPARATOR.'source';
    $destinate=$home.DIRECTORY_SEPARATOR.'destinate';
    $res2=mkdir($source,0777,true);
    $res3=mkdir($destinate,0777,true);
    if($res2&&$res3){
        //复制文件
        $src=$app_path.DIRECTORY_SEPARATOR.'common'.DIRECTORY_SEPARATOR.'one.pdf';
        $dst=$source.DIRECTORY_SEPARATOR.'example.pdf';
        copy($src, $dst);
    }
}
?>
<div class="alert alert-success" role="alert">恭喜您，注册成功！<br/>请登录到您的邮箱及时激活您的帐号！</div>
