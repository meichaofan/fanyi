<?php
?>
<div class="alert alert-success" role="alert">欢迎<?php if(isset($_SESSION['username'])) echo $_SESSION['username'];?>使用此工具</div>

<div class="panel panel-success" style="width: 100%; height: 830px;">
	<div class="panel-heading">
		<h3 class="panel-title">Message</h3>
	</div>
	<div class="panel-body" id="chat_panel"
		style="width: 100%; height: 600px; overflow: scroll;"></div>
	<form action="chat.php" method="post">
		<div class="panel panel-success">
			<div class="panel-heading">
				<h3 class="panel-title">
					<small>留言框 &nbsp;&nbsp;<span class="emotion pull-right">表情</span></small>
				</h3>
			</div>
			<div class="panel-body" id="chat_panel">
				<div class="row">
					<div class="col-lg-12">
						<textarea id="saytext" rows="3" class="form-control" name="content"></textarea>
					</div>
				</div>
			</div>
			<button type="button" class="btn btn-default navbar-btn pull-right"
				onclick="send();">发送</button>
		</div>
	</form>
</div>

<script src="js/jquery.qqFace.js"></script>
<script>
function send(){
		var fm = document.getElementsByTagName("form")[0];
		var content=document.getElementsByName("content")[0].value;
		if(content==''||content==null){
			alert("留言内容不能为空");
			return;
		}
		var fmdata = new FormData(fm);
		var xhr = new XMLHttpRequest();
		xhr.onreadystatechange = function(){
			if(this.readyState==4){
				console.log(xhr.responseText);
			}
		}
		xhr.open('post','chat.php',true);
		xhr.send(fmdata);
        content="";
}
var maxId = 0;
function showMsg(){
	xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function(){
		if(this.readyState==4){
			if(this.responseText!=""){
			var res = eval('(' + this.responseText + ')');
			for(var i=0;i<res.length;i++){
				var user = res[i].user;
				var msg = replace_em(res[i].msg);
				//此处对msg做一个处理
				var msg_time = res[i].msg_time;
				var who = res[i].who;
			    maxId=res[i].id;
				//alert(user+msg_time+msg);
				//开始插入数据
				var pn = document.getElementById("chat_panel");
				var div = document.createElement("div");
				div.className="panel panel-default";
				var divheading = document.createElement("div");
				divheading.className="panel-heading";
				var divbody = document.createElement("div");
				divbody.className="panel-body";
				divheading.innerHTML=user+" "+msg_time;
				divbody.innerHTML=msg;
				if(who=="me"){
					div.className="panel panel-default text-right";
				}
				div.appendChild(divheading);
				div.appendChild(divbody);
				pn.appendChild(div);
				//alert(pn.style.height);
				//alert(pn.scrollHeight-pn.style.height);
				//pn.scrollTop = pn.scrollHeight-pn.style.height;
			}
			}
		}
	}
	xhr.open('get','showchat.php?maxId='+maxId,true);
	xhr.send(null);
}
window.onload = function (){
	 setInterval("showMsg()",3000);
}

$(function(){
	$('.emotion').qqFace({
		id:'facebox',
		assign:'saytext',
		path:'emoji/' //表情存放的路径
		});	
	
	
});

function replace_em(str){
	str = str.replace(/\</g,'&lt;');
	str = str.replace(/\>/g,'&gt;');
	str = str.replace(/\n/g,'<br/>');
	str = str.replace(/\[em_([0-9]*)\]/g,'<img src="emoji/$1.gif" border="0" />');
	return str;
}

</script>
