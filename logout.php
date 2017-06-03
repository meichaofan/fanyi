<?php
//销毁session数据
unset($_SESSION['access']);
unset($_SESSION['folder']);
unset($_SESSION['status']);
unset($_SESSION['username']);
unset($_SESSION['gender']);
unset($_SESSION['user_folder']);
?>
<div class="alert alert-info" role="alert">成功注销，退出登录</div>
<?php
header('Refresh:1;url=http://47.94.19.205:8081');
?>
