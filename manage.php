<?php
include 'function.php';
//打开文件夹，并将文件显示到左边
echo "<form method=\"POST\" action='translate.php'><div class=\"table-responsive\">
    <table class=\"table table-striped\"><thead><tr><th width=20px></th>
    <th>文件名</th><th>大小</th><th>预览</th><th>翻译</th></thead>";
$content2 = "";
$b = 1;
$folder="./source/";
// 首先读取./文件夹里面的内容
if (! $style = opendir($folder)) {
    printerror("目录不存在");
}
// 把folder存入SESSION中
if ($folder)
    $_SESSION['folder'] = $folder;
while ($stylesheet = readdir($style)) {
    $ufolder = $folder;
    $sstylesheet = $stylesheet;
    if ($sstylesheet !== "." && $sstylesheet !== "..") {
        // 点击实现变色
        $trontd = "<tr width=100%
        onclick='st=document.getElementById(\"$sstylesheet\").checked;
        if(st==true){
        document.getElementById(\"$stylesheet\").checked=false;
        this.style.backgroundColor=\"\";}
        else{document.getElementById(\"$stylesheet\").checked=true;
        this.style.backgroundColor=\"#fcdd8c\";}'>";
        // 预览pdf
        $preview = "<td><a href='{$meurl}?left=preview&file=" . htmlspecialchars($stylesheet) . "&folder=$folder'>预览</a></td>\n";
        //翻译
        $translate = "<td><a href='{$meurl}?left=preview&file=" . htmlspecialchars($stylesheet) . "&folder=$folder&right=translate'>翻译</a></td>\n";
        
        $path = $ufolder . $stylesheet;
        if (! is_dir($sstylesheet)) {
            // 获取文件大小
            $filesize = Size(filesize($path));
            }if (strstr($sstylesheet, ".pdf")) {
                $content2[$b] = "$trontd<td><span><img src=\"image/pdf.jpg\" width=\"15px\" height=\"15px\"></img></span>
                <input name='select_item[f][$sstylesheet]' type='checkbox' id='$sstylesheet' value='{$ufolder}{$sstylesheet}' style=\"display:none\"></td><td _order='3{$sstylesheet}' _ext='3' _time='1'><a href='{$ufolder}{$sstylesheet}' target='_blank'>{$sstylesheet}</a></td>\n" . "<td _size='1'>" . $filesize . "</td>"  . $preview  .$translate. "<tr>";
            }
            $b++;
    }
}
// 关闭文件流
closedir($style);
//表格标题设置
$lu = explode('/', $_SESSION['folder']);
array_pop($lu);
$u = '';
echo '<h5 class=\"sub-header\">';
foreach ($lu as $v) {
    $u = $u.$v.'/';
    if($v=='.'){$v='主页';}elseif($v==''){$v='根目录';}
    echo '<a href="'.$meurl.'?left=home&folder='.$u.'">'.$v.'</a> » ';
}
for ($j = 1; $j < $b; $j ++)
    echo $content2[$j];
echo "</table></div></form>";