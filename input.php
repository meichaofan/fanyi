<?php
?>
<form method="post" action="index.php?left=input&right=output">
<div class="btn-toolbar">
<div class="btn-group" role="group" >
 <button type="button" class="btn btn-default">英文</button>
  <button type="button" class="btn btn-default">单词</button>
  <button type="button" class="btn btn-default">句子</button>
</div>
<div class="btn-group" role="group" >
  <button type="submit" class="btn btn-warning">翻译</button>
</div>

</div>
<div class="worldwrap" id="wordCount">
<textarea class="form-control" width="80%" rows="3" name="content" placeholder="请输入要翻译的文字"><?php if(isset($_REQUEST['content']))
    echo $_REQUEST['content'];?></textarea>
<p class="text-right" ><var class="word">100</var>/100</p>
</div>
<form>
