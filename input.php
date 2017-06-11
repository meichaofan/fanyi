<?php
?>
<form action="index.php?left=input&right=output" method="post" >
<div class="btn-toolbar">
<div class="btn-group" role="group" >
 <button id="src" type="button" class="btn btn-default">英文</button>
</div>
<button type="button" class="btn btn-success" id="qie" ><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;<span class="glyphicon glyphicon-arrow-right"></button>
<div class="btn-group" role="group" >
 <button id="des" type="button" class="btn btn-default">中文</button>
</div>
<div class="btn-group pull-right"  role="group" >
  <button type="submit" class="btn btn-warning">翻译</button>
</div>
</div>
<div class="worldwrap" id="wordCount">
<textarea class="form-control" width="80%" rows="3" name="content" placeholder="请输入要翻译的文字"><?php if(isset($_REQUEST['content']))
    echo $_REQUEST['content'];?></textarea>
<p class="text-right" ><var class="word">100</var>/100</p>
</div>
<input id="flag1" type="hidden" name="flag" value="0" />
<form>
<script src="js/input.js"></script>
<script>
	$("#qie").click(function(){
			if($("#src").html()=='中文'){
				$("#src").html('英文');
				$("#des").html('中文');
				$("#flag1").val('0');
			}else{
				$("#src").html('中文');
				$("#des").html('英文');
				$("#flag1").val('1');
			}
		});
</script>
