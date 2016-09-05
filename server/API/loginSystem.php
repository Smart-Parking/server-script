<?php

include('../db/config.php');

        $con = mysql_connect($dbserver,$user,$password);
        if (!$con)
        {
                die ('Could not connect: ' . mysql_error());
                echo '{"report":"fail,can not conect !"}';
                exit();
        }
		mysql_select_db($db_name, $con);


if(!isset($_REQUEST["account"]) || !isset($_REQUEST["password"]) )
{
		echo '{'.'"report":"fail","account":"'.$_REQUEST["account"].'","password":"'.$_REQUEST["password"].'"}';
		mysql_close($con);
		exit();
}

$account=mysql_real_escape_string($_REQUEST["account"]);
$password=mysql_real_escape_string($_REQUEST["password"]);

$select_str = "SELECT * FROM  ".$userTable." where user= '".$account."'; ";
$result = mysql_query($select_str);

if($row = mysql_fetch_array($result))
{
	if($row['password'] == $password)
	{
		echo '{"report":"ok","level":"'.$row['level'].'","time":"'.$row['date'].'"}';
	}
	else
	{
		echo '{"report":"passwd do not match! ! password":"'.$row['password'].'","account":"'.$row['account'].'"}';		
	}

}
else
	echo '{"report":"fail mysql !"}';
{
}

mysql_close($con);
?>

