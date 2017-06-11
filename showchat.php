<?php
session_start();
require_once 'database.php';
$user = isset($_SESSION['username']) ? $_SESSION['username'] : "游客" . session_id();
$maxId= $_REQUEST['maxId'];
$data = $db->select('chat', "*",array("id[>]"=>$maxId));
$msg=array();
foreach ($data as $key => $value) {
    // 遍历一下，如果是自己发现，则标记me，不是自己说的话，则标记you
    $value['msg_time'] = date("Y-m-d H:i:s", $value['msg_time']);
    if ($value['user'] == $user) {
        $value['who'] = 'me';
    } else {
        $value['who'] = 'you';
    }
    $msg[] = $value;
}
// var_dump($msg);
if($msg) echo json_encode($msg);