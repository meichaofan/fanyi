<?php
include_once 'database.php'; //连接数据库
include_once 'function.php';
session_start();
$username=stripslashes(trim($_POST['username']));
$password=$_POST['password'];
$num=$db->select('user', ['id','gender','status'],array('username'=>$username,'password'=>md5($password)));

var_dump($num);

if(isset($num[0])){
    //用户以激活，跳转到首页
    if($num[0]['status']==1){
        $_SESSION['status']=1;
        $_SESSION['gender']=$num[0]['gender'];
        $_SESSION['username']=$username;
        $_SESSION['user_folder']=dirname(__FILE__).DIRECTORY_SEPARATOR.'user'.DIRECTORY_SEPARATOR.$username;
        header("location:http://47.94.19.205:8081/");
    }else{
        //用户注册成功，但是未激活
        $_SESSION['status']=0;
        $_SESSION['gender']=$num[0]['gender'];
        $_SESSION['username']=$username;
        $_SESSION['user_folder']=dirname(__FILE__).DIRECTORY_SEPARATOR.'user'.DIRECTORY_SEPARATOR.$username;
        header("location:http://47.94.19.205:8081/index.php?register_success");
    }
}else{
    echo "<script>alert('用户名或密码错误，请重新登陆');history.go(-1);</script>";
}
