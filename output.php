<?php
require_once 'function.php';
// 取得翻译的内容
if (isset($_REQUEST['content']))
    $content = $_REQUEST['content'];
$flag = isset($_REQUEST['flag']) ? $_REQUEST['flag'] : 0;
if ($flag == 0) {
    $from = 'en';
    $to = 'zh';
} else 
    if ($flag == 1) {
        $from = 'zh';
        $to = 'en';
    }

// 调用翻译的函数
?>
<div class="btn-group" role="group">
	<button type="button" class="btn btn-default">中文</button>
</div>
<textarea class="form-control" rows="3" disabled>
<?php translate($content,$from,$to); ?>
</textarea>

