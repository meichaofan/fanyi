<?php

/**
 * 帮助类函数
 */

/*
 * 1.
 * function gettime()
 * 获取文件或目录时间
 */
function gettime($filename)
{
    return "修改时间: " . date("Y-m-d H:i:s", filemtime($filename)) . "\n" . "创建时间: " . date("Y-m-d H:i:s", filectime($filename));
}

/*
 * 2.
 * function uCode($text)
 * 转换成utf-8编码
 */
function uCode($text)
{
    return mb_convert_encoding($text, 'UTF-8', 'GBK');
}

/*
 * 3.
 * function gCode($text)
 * 转换成fbk编码
 */
function gCode($text)
{
    return mb_convert_encoding($text, 'GBK', 'UTF-8');
}

/*
 * 4.
 * function dirSize()
 * 获取目录的大小
 */
function dirSize($directoty)
{
    $dir_size = 0;
    if ($dir_handle = opendir($directoty)) {
        while ($filename = readdir($dir_handle)) {
            $subFile = $directoty . DIRECTORY_SEPARATOR . $filename;
            if ($filename == '.' || $filename == '..') {
                continue;
            } elseif (is_dir($subFile)) {
                $dir_size += dirSize($subFile);
            } elseif (is_file($subFile)) {
                $dir_size += filesize($subFile);
            }
        }
        closedir($dir_handle);
    }
    return ($dir_size);
}

/*
 * 5.
 * function Size()
 * 计算文件大小
 */
function Size($size)
{
    $sz = " KMGT";
    $factor = floor((strlen($size) - 1) / 3);
    return ($size > 1024) ? sprintf("%.2f", $size / pow(1024, $factor)) . @$sz[$factor] : $size;
}

/**
 * 6.function translate()
 * 翻译
 */
function translate($content)
{
    $url = "http://fanyi.baidu.com/v2transapi";
    $data = array(
        'from' => 'en',
        'to' => 'zh',
        'query' => trim($content)
    );
    $data = http_build_query($data);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_REFERER, 'http://fanyi.baidu.com');
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    $result = curl_exec($ch);
    curl_close($ch);
    $result = json_decode($result, true);
    echo $result['trans_result']['data']['0']['dst'];
}

/**
 * 在线人数
 */
function online()
{
    $mc = new Memcache();
    // 连接memcache
    $mc->connect("localhost", 11211);
    // 获取 在线用户 IP 和 在线时间数据
    $online_members = $mc->get('online_members');
    // 获取访问人数
    $access_members = $mc->get('access_members');
    // 如果为空，初始化数据
    if (! $online_members) {
        $online_members = array();
    }
    if (! $access_members) {
        $access_members = 0;
    }
    // 获取用户ip
    $ip = $_SERVER['REMOTE_ADDR'];
    // 为访问用户重新设置在线时间
    $online_members[$ip] = time();
    if ($_SESSION['access']) {
        $access_members ++;
        // 设置标志位
        $_SESSION['flag'] = 'accessed';
        $_SESSION['access'] = false;
    }
    foreach ($online_members as $k => $v) {
        // 如果三分钟后再未访问页面，刚视为过期
        if (time() - $v > 180) {
            unset($online_members[$k]);
        }
    }
    // 重新设置在线用户
    $mc->set('online_members', $online_members);
    // 设置访问记录
    $mc->set('access_members', $access_members);
    // 重新获取在线用户数据
    $online_members = $mc->get('online_members');
    $access_members = $mc->get('access_members');
    // 输入统计在线人数
    return array(
        count($online_members),
        $access_members
    );
}

/*
 * function postmail()
 * 发送邮件
 */
function postmail($username, $token, $to)
{
    error_reporting(E_STRICT);
    date_default_timezone_set('Asia/Shanghai'); // 设定时区东八区
    require_once ('class.phpmailer.php');
    include ('class.smtp.php');
    $mail = new PHPMailer();
    $mail->CharSet = "utf-8"; // 设定邮件编码，默认ISO-8859-1，如果发中文此项必须设置，否则乱码
    $mail->IsSMTP();
    $mail->SMTPDebug = 0;
    $mail->SMTPAuth = true; // 启用 SMTP 验证功能
    $mail->SMTPSecure = "ssl"; // 安全协议，可以注释掉
    $mail->Host = 'smtp.qq.com'; // SMTP 服务器
    $mail->Port = 465; // SMTP服务器的端口号
    $mail->Username = '1783590642@qq.com';
    $mail->Password = 'adpnbhsdpiokbigi';
    $mail->SetFrom('1783590642@qq.com', '一如当年');
    $mail->Subject = "用户帐号激活"; // 邮件标题
    $body = "亲爱的" . $username . "：<br/>感谢您在我站注册了新帐号。<br/>请点击链接激活您的帐号。<br/> 
    <a href='http://47.94.19.205:8081/active.php?verify=" . $token . "' target= 
'_blank'>http://47.94.19.205:8081/active.php?verify=" . $token . "</a><br/> 
    如果以上链接无法点击，请将它复制到你的浏览器地址栏中进入访问，该链接24小时内有效。";
    $mail->MsgHTML($body);
    $mail->addAddress($to);
    if (! $mail->Send()) {
        return false;
    } else {
        return true;
    }
}

/*
 * 读取目录文件
 *
 */
function opendirectory($folder,$meurl)
{
    echo "<form method=\"POST\" action='translate.php'><div class=\"table-responsive\">
    <table class=\"table table-striped\"><thead><tr><th width=20px></th>
    <th>文件名</th><th>大小</th><th>预览</th><th>翻译</th></thead>";
    $content2 = "";
    $b = 1;
    $folder = $folder;
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
            // 翻译
            $translate = "<td><a href='{$meurl}?left=preview&file=" . htmlspecialchars($stylesheet) . "&folder=$folder&right=translate'>翻译</a></td>\n";
            
            $path = $ufolder.DIRECTORY_SEPARATOR.$stylesheet;
            if (! is_dir($sstylesheet)) {
                // 获取文件大小
                $filesize = Size(filesize($path));
            }
            if (strstr($sstylesheet, ".pdf")) {
                $content2[$b] = "$trontd<td><span><img src=\"image/pdf.jpg\" width=\"15px\" height=\"15px\"></img></span>
                <input name='select_item[f][$sstylesheet]' type='checkbox' id='$sstylesheet' value='{$ufolder}{$sstylesheet}' style=\"display:none\"></td><td _order='3{$sstylesheet}' _ext='3' _time='1'><a href='{$ufolder}{$sstylesheet}' target='_blank'>{$sstylesheet}</a></td>\n" . "<td _size='1'>" . $filesize . "</td>" . $preview . $translate . "<tr>";
            }
            $b ++;
        }
    }
    // 关闭文件流
    closedir($style);
    for ($j = 1; $j < $b; $j ++)
        echo $content2[$j];
    echo "</table></div></form>";
}

