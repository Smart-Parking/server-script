<?php

/*
ini_set('display_errors',1);            //������Ϣ
ini_set('display_startup_errors',1);    //php����������Ϣ
error_reporting(-1);                    //��ӡ�����е� ������Ϣ
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
