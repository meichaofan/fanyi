<?php
require_once 'function.php';
//取得翻译的内容
if(isset($_REQUEST['content']))
$content=$_REQUEST['content'];
//调用翻译的函数
?>
<div class="btn-group" role="group" >
<button type="button" class="btn btn-default">中文</button>
</div>
<textarea class="form-control"  rows="3" disabled>
<?php translate($content); ?>
</textarea>

