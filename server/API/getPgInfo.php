<?php

include('../../db/config.php');

        $con = mysql_connect($dbserver,$user,$password);
        if (!$con)
        {
                die ('Could not connect: ' . mysql_error());
                echo '{"report":"fail"}';
                exit();
        }
		mysql_select_db($db_name, $con);

$select_str = "SELECT * FROM  ".$pgInfoTable." ; ";
$result = mysql_query($select_str);
$totalnum=mysql_num_rows($result);

if(isset($_REQUEST["pageoffset"]))
{
	        $pageoffset=mysql_real_escape_string($_REQUEST["pageoffset"]);
}
else
{
	        $pageoffset=1;
}
if(isset($_REQUEST["pageSize"]))
{
	$pageSize=mysql_real_escape_string($_REQUEST["pageSize"]);
}	
else
{
	$pageSize=$totalnum;
	//$pageSize = 1 ;
}

$startoff=($pageoffset-1)*$pageSize;
$totalpage=ceil($totalnum/$pageSize);

$select_str2 = "SELECT * FROM  ".$pgInfoTable."  order by date desc limit ".$startoff." , ".$pageSize.";";
$result = mysql_query($select_str2);

echo '{';
echo '"report":"ok","total":"'.$totalnum.'","pageIndex":"'.$pageoffset.'","pageSize":"'.$pageSize.'","totalpage":"'.$totalpage.'","users":[';

$count=0;
$num=mysql_num_rows($result);
while($row = mysql_fetch_array($result))
{
	$count++;

	$name=$row['name'];
	$s_id=$row['s_id'];
    $orig_net_id=$row['orig_net_id'];	
    $pcr_pid=$row['pcr_pid'];
	$pmt_pid=$row['pmt_pid'];
    $video_pid=$row['video_pid'];
	$video_type=$row['video_type'];
    $audio_ch_num=$row['audio_ch_num'];
	$audio=$row['audio'];
    $ca_system_id=$row['ca_system_id'];
	$ecm_num=$row['ecm_num'];
    $ca_ecm=$row['ca_ecm'];
	$bitrate=$row['bitrate'];
    $tp_id=$row['tp_id'];
	$user_able=$row['user_able'];
    $sort_able=$row['sort_able'];
	$shouldUpgrade=$row['shouldUpgrade'];
	$add_time=date("YmdHis",$row['date']);
	$boxId=$row['boxchipid'];

	echo '{"name":"'.$name
	.'","s_id":"'.$s_id
	.'","orig_net_id":"'.$orig_net_id	
	.'","pcr_pid":"'.$pcr_pid		
	.'","pmt_pid":"'.$pmt_pid	
	.'","video_pid":"'.$video_pid		
	.'","video_type":"'.$video_type	
	.'","audio_ch_num":"'.$audio_ch_num		
	.'","audio":"'.$audio	
	.'","ca_system_id":"'.$ca_system_id		
	.'","ecm_num":"'.$ecm_num	
	.'","ca_ecm":"'.$ca_ecm		
	.'","bitrate":"'.$bitrate	
	.'","tp_id":"'.$tp_id	
	.'","boxId":"'.$boxId		
	.'","user_able":"'.$user_able	
	.'","sort_able":"'.$sort_able
	.'","time":"'.$add_time
	.'","shouldUpgrade":"'.$shouldUpgrade.'"}';

	if($count<$num)
	  echo ',';

}	              

 echo ']';
 echo '}';

 mysql_close($con);
?>

