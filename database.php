<?php
use Medoo\Medoo;
//引入mdeoo.php
require_once 'Medoo.php';
//初始化
$db = new Medoo([
    'database_type'=>'mysql',
    'database_name'=>'fanyi',
    'server'=>'localhost',
    'username'=>'root',
    'password'=>'1534',
    'charset'=>'utf8',
    //端口：可选
    'port'=>'3306',
    //表前缀
    'prefix'=>'fanyi_',
    //pdo驱动
    'option'=>[PDO::ATTR_CASE=>PDO::CASE_NATURAL]
]);
