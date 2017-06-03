<?php
include_once 'database.php';
$verify=stripcslashes($_GET['verify']);
$nowtime=time();
$data=$db->select('user', ['id','token_exptime'],array('status'=>0,'token'=>$verify));

if($data[0]){
    if($nowtime>$data[0]['token_exptime']){
        header("Location:http://localhost:8888/translatetools/index.php?left=active_fail&right=diy");
    }else{
        $result=$db->update('user', array('status'=>1),array('id'=>$data[0]['id']));
        if($result)  header("Location:http://47.94.19.205:8081/index.php?left=active_success&right=diy");
    }
}
