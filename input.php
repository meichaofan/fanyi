<?php
?>
<form>
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
<form>
<script src="js/input.js"></script>
<script>
	$("#qie").click(function(){
			$("#src").html()=='中文'?$("#src").html('英文'):$("#src").html('中文');
			$("#des").html()=='英文'?$("#des").html('中文'):$("#des").html('英文');
		});
	// method="post" action="index.php?left=input&right=output"
	
	$("form").submit(function(){
		var url = "index.php?left=input&right=output";
		var content = $("textarea[name=content]").val();
		var data = {};
		//判断是英译汉还是汉译英
		if($("#src").html()=='英文'){
    		data.flag=0; //0 英译汉  1 汉译英
		}else{
			data.flag=1; //0 英译汉  1 汉译英
		}
		data.content=content;
		$.post(url,data);
		return false;
		})
	
	
	
		
</script>
