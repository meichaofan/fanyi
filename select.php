<?php

$status=$_SESSION['status'];
//判断用户是否已经激活，几乎后才能上传文件
if($status!=1){
    echo "<script>alert('您好，此用户尚未激活，请前往邮箱进行激活');history.go(-1);</script>";
    exit;
}

?>
<body>
	<div class="container kv-main">
		<hr>
		<form enctype="multipart/form-data" method="post">
			<label><h4><?php echo "本地上传 Max:" . ini_get('upload_max_filesize') . "," . ini_get('max_file_uploads') . "个";?></h4></label>
			<input id="file-fr" name="file-fr[]" type="file" multiple>
		</form>
		<hr>
		<br>
	</div>
