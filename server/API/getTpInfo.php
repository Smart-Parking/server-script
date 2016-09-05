<?php

include('../db/config.php');

        $con = mysql_connect($dbserver,$user,$password);
        if (!$con)
        {
                die ('Could not connect: ' . mysql_error());
                echo '{"report":"fail"}';
                exit();
        }
		mysql_select_db($db_name, $con);

$select_str = "SELECT * FROM  ".$tpInfoTable." ; ";
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
}

$startoff=($pageoffset-1)*$pageSize;
$totalpage=ceil($totalnum/$pageSize);


$select_str2 = "SELECT * FROM  ".$tpInfoTable." limit ".$startoff." , ".$pageSize." ; ";
$result = mysql_query($select_str2);

echo '{';
echo '"report":"ok","total":"'.$totalnum.'","pageIndex":"'.$pageoffset.'","pageSize":"'.$pageSize.'","totalpage":"'.$totalpage.'","users":[';

$count=0;
$num=mysql_num_rows($result);
while($row = mysql_fetch_array($result))
{
	$count++;

	$tp_id=$row['tp_id'];
	$freq=$row['freq'];
	
	$sym=$row['sym'];
	$bandwidth=$row['bandwidth'];
	$polarity=$row['polarity'];
	$qam_type=$row['qam_type'];
	$tbUpdateFinish=$row['tbUpdateFinish'];
	$shouldUpgrade=$row['shouldUpgrade'];
    $add_time=$row['date'];;
		
	echo '{"tp_id":"'.$tp_id
	.'","freq":"'.$freq
	.'","sym":"'.$sym	
	.'","bandwidth":"'.$bandwidth
	.'","polarity":"'.$polarity
	.'","qam_type":"'.$qam_type
	.'","tbUpdateFinish":"'.$tbUpdateFinish
	.'","shouldUpgrade":"'.$shouldUpgrade
	.'","add_time":"'.$add_time.'"}';

	if($count<$num)
	  echo ',';

}	              

 echo ']';
 echo '}';

 mysql_close($con);
?>

