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

$select_str = "SELECT * FROM  ".$liveLzmaTable." ; ";
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

$select_str2 = "SELECT * FROM  ".$liveLzmaTable." order by datetime desc limit ".$startoff." , ".$pageSize." ; ";
$result = mysql_query($select_str2);

echo '{';
echo '"report":"ok","total":"'.$totalnum.'","pageIndex":"'.$pageoffset.'","pageSize":"'.$pageSize.'","totalpage":"'.$totalpage.'","users":[';

$count=0;
$num=mysql_num_rows($result);
while($row = mysql_fetch_array($result))
{
	$count++;

	$lzma=$row['lzma'];
	$lzmamd5=$row['lzmamd5'];
    $lzmaEncrypt=$row['lzmaEncrypt'];
    $add_time=$row['datetime'];
		
	echo '{"lzma":"'.$wwwroot.$lzma
	.'","lzmaEncrypt":"'.$wwwroot.$lzmaEncrypt
	.'","lzmamd5":"'.$lzmamd5	
	.'","add_time":"'.$add_time.'"}';

	if($count<$num)
	  echo ',';

}	              

 echo ']';
 echo '}';

 mysql_close($con);
?>

