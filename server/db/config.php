<?php

include $_SERVER['DOCUMENT_ROOT']."/server/db/local.php" ;

$db_name =  "liveDB";


///global param table , save the global param 
$userTable =  "userTable";


///global param table , save the global param 
$globalParamTable =  "globalParamTable";

///the live file[lzma] table ,which used for stb phone client !
$liveLzmaTable =  "liveLzmaTable";


define("LIVE_LZMA_COUNT", "10");


///the live url list ,model 2
///used to saving the url list info 
$liveUrlTable =  "liveUrlTable";
///the live src server list ,model 2
///used to saving the server list info 
$serverListTable =  "serverListTable";
///the local stb client list , model 1&3
///one of them used to do scanf for tp info 
$stbListTable =  "stbListTable";

//client device collect table
$clientChipIdList = "clientChipIdList";

//tp update load info 
///sat info table 
$satInfoTable =  "satInfoTable";
///tp info table
$tpInfoTable =  "tpInfoTable";
///pg info table
$pgInfoTable =  "pgInfoTable";

///save the tp box mapping info ; you can get how many boxes in this tp , and get the the scan box belong to which tp !
$tpStbboxMapTable ="tpStbboxMapTable";



////stb recording box the max bandwidth 
$stb_client_bandwidth_max = 8*3*1024*1024 ; 


////do  tp scanf time diff 
$TP_SCANF_TIME_STEP = 24*60*60 ;
//the tp should return max time 
//if do not , so you should start a new tp scanf time !
$TP_SCANF_PASS_TIME =  30*60 ;  

////do  hear beat time , 
$SERVER_ID_HEARTBEAT_TIME = 60 ;
/// the server time out 
/// it is a datetime info , so 1000 means 10:00,
/// 20160630143655 
$SERVER_ID_TIME_OUT_STEP = 10*60 ;  //////  10:00  10 minutes 

//use less right now  yiyuan !
///msybe can used as that the stb sort box valid timeout info 
$STB_VALID_MAX_TIME_OUT = 5*60 ;    /// 5:00 5 minutes


$FREQ_DIFF_MAX_LEN = 100 ;
$SYM_DIFF_MAX_LEN = 50 ;

///box upload msg : status define !
define("BOX_STATUS_IDLE", "0");
define("BOX_STATUS_RUNNING", "1");
define("BOX_STATUS_TPSCANF", "2");

///box download msg status next cmd define !
define("BOX_CMD_KEEPING", "0");
define("BOX_CMD_STOP", "1");
define("BOX_CMD_NEW_RECORD", "2");
define("BOX_CMD_TPSCANF", "3");


/* End of file config.php */
