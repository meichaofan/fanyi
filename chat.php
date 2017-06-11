<?php
session_start();
require_once 'database.php';
ini_set('date.timezone','Asia/Shanghai');
$content = $_POST['content'];
$user=isset($_SESSION['username'])?$_SESSION['username']:"游客".session_id();
$_SESSION['username']=$user;
/*
 * 数据库的设计
 * 字段：
 *  1. id int not null auto increment primary key comment '编号'：
 *  2. username varchar(32) not null comment '用户名'： 
 *  3. msg varchar(1024) not null comemnt '消息体':
 *  4. add_time int(10) not null comment '时间'
 *  
 */
$db->insert('chat', array('user'=>$user,'msg'=>$content,'msg_time'=>time()));
if($db->id()){
    echo 'success';
}else{
    echo 'fail';
}

