<?php
error_reporting(E_ALL ^ E_NOTICE);
$text = 'hello';

include('langlayer.class.php');
$lang = new languageLayer();

$lang->getResponse($text);


if( $lang->errorCode ){
    
    die('error ('.$lang->errorCode.'): '.$lang->errorText);
    
}

var_dump($lang->response);
?>
