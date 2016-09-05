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

$select_str = "SELECT * FROM  ".$satInfoTable." ; ";
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


$select_time = "SELECT (time) FROM  ".$globalParamTable." ; ";
$row = mysql_fetch_array(mysql_query($select_time));
$timeinfo = $row['time'];

$select_str2 = "SELECT * FROM  ".$satInfoTable." limit ".$startoff." , ".$pageSize." ; ";
$result = mysql_query($select_str2);

echo '{';
echo '"report":"ok","total":"'.$totalnum.'","pageIndex":"'.$pageoffset.'","pageSize":"'.$pageSize.'","totalpage":"'.$totalpage.'","users":[';

$count=0;
$num=mysql_num_rows($result);
while($row = mysql_fetch_array($result))
{
	$count++;

	$nim_type=$row['nim_type'];
	$lnb=$row['lnb'];
    $is_on22k=$row['is_on22k'];
    $diseqc_type_1_0=$row['diseqc_type_1_0'];
    $diseqc_port_1_0=$row['diseqc_port_1_0'];
	$diseqc_type_1_1=$row['diseqc_type_1_1'];
	$diseqc_port_1_1=$row['diseqc_port_1_1'];
    $diseqc_1_1_mode=$row['diseqc_1_1_mode'];
    $boxchipid=$row['boxchipid'];		
    $add_time=$row['date'];		

		
	echo '{"nim_type":"'.$nim_type
	.'","lnb":"'.$lnb
	.'","is_on22k":"'.$is_on22k	
	.'","diseqc_type_1_0":"'.$diseqc_type_1_0
	.'","diseqc_port_1_0":"'.$diseqc_port_1_0
	.'","diseqc_type_1_1":"'.$diseqc_type_1_1
	.'","diseqc_port_1_1":"'.$diseqc_port_1_1
	.'","diseqc_1_1_mode":"'.$diseqc_1_1_mode
	.'","boxchipid":"'.$boxchipid
	.'","add_time":"'.$add_time.'"}';

	if($count<$num)
	  echo ',';

}	              

 echo ']';
 echo '}';

 mysql_close($con);
?>

