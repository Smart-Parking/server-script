<?php

/*
ini_set('display_errors',1);            //错误信息
ini_set('display_startup_errors',1);    //php启动错误信息
error_reporting(-1);                    //打印出所有的 错误信息
ini_set('error_log', './error/error_log.txt'); 
*/

$wwwroot = "http://192.168.33.169/server/";
$localpath="/home/yiyuan/htdoc/server/";
$lzma = $localpath.'/tools/lzma k'; 

$relativePath="server" ;
$dbserver = "localhost";
#$host =     "localhost:3306";
$user =     "root";
$password = "root";

//save the upload log 
define("SAVE_UPLOAD_INFO", "1");
///debug info 
define("DEBUG_INFO", "1");

/* End of file config.php */
