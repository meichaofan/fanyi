<?php
$file = $_REQUEST['file'];
$folder = $_REQUEST['folder'];
$path = $folder .DIRECTORY_SEPARATOR. $file;
// php处理pdf
$content=shell_exec("/usr/local/bin/pdftotext -layout -enc GBK $path -");
//转码
$content=mb_convert_encoding($content,'UTF-8','GBK');


//pdf->text完成后，将保存成.txt文本 并放入destination目录中

$content=preg_split("/[.!:]/",$content);
echo "<div class='alert alert-success' role='alert'>";
for($i=0;$i<count($content);$i++){
    $url="http://fanyi.baidu.com/v2transapi";
    $data=array(
        'from'=>'en',
        'to'=>'zh',
        'query'=>trim($content[$i])
        );
    $data=http_build_query($data);
    $ch=curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_REFERER,'http://fanyi.baidu.com');
    curl_setopt ( $ch, CURLOPT_HEADER, 0 );
    curl_setopt ( $ch, CURLOPT_POST, 1 );
    curl_setopt ( $ch, CURLOPT_POSTFIELDS, $data );
    curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
    curl_setopt ( $ch, CURLOPT_TIMEOUT, 10 );
    $result = curl_exec ( $ch );
    curl_close ( $ch );
    $result=json_decode($result,true);
    echo $result ['trans_result'] ['data'] ['0'] ['dst']."<br>";
}
echo "</div>";
?>
