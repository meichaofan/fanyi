<?php
include_once 'database.php'; //连接数据库
include_once 'function.php';
session_start();
$username=stripslashes(trim($_POST['username']));
$num=$db->select('user','id',array('username'=>$username));
if(isset($num[0])){
    echo "<script>alert('用户名已存在，请换个其它用户名');history.go(-1);</script>";
    exit;
}
//将用户密码加密，构造激活识别码
$password=md5(trim($_POST['password']));
$email=trim($_POST['email']);
$regtime=time();
$gender=$_POST['gender']=='male' ? 0 : 1;

//创建用于激活识别码
$token = md5($username.$password.$regtime);
$token_exptime = time()+60*60*24; //过期时间

//插入数据库
$db->insert('user', array('username'=>$username,'password'=>$password,'gender'=>$gender,'email'=>$email,'token'=>$token,'token_exptime'=>$token_exptime,'regtime'=>$regtime));
if($db->id()){
    //此时用户名、密码、邮箱等信息已经插入到数据库中
    $_SESSION['username']=$username;
    $_SESSION['login']=true;
    $_SESSION['status']=0; //0-表示注册成功，账号未激活，1-表示注册成功，账号激活成功
    $_SESSION['regist']=0; //0-表示注册不成功，账号未激活 //1.表示注册成功，账号未激活
    $_SESSION['gender']=$gender;
    $_SESSION['user_folder']=dirname(__FILE__).DIRECTORY_SEPARATOR.'user'.DIRECTORY_SEPARATOR.$username;
    $state=postmail($username, $token, $email);
    if($state){
        header("Location:http://47.94.19.205:8081/index.php?left=regist_success&right=diy");
    }else{
        header("Location:http://47.94.19.205.8081/index.php?left=regist_fail&right=diy");
    }
}






















