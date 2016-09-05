<?php
	include('../../../common/info.php');

	$error = "";
	$msg = "";
	$imageUrl="";
	$fileElementName = 'fileToUpload';
	$t=$_REQUEST["t"];
	if($t=="genre")
		$imageUrl="../upload/genre/default.png";
	else if($t=="film")
		$imageUrl="../upload/film/default.png";

	if(!empty($_FILES[$fileElementName]['error']))
	{
		switch($_FILES[$fileElementName]['error'])
		{

			case '1':
				$error = 'The uploaded file exceeds the upload_max_filesize directive in php.ini';
				break;
			case '2':
				$error = 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form';
				break;
			case '3':
				$error = 'The uploaded file was only partially uploaded';
				break;
			case '4':
				$error = 'No file was uploaded.';
				break;

			case '6':
				$error = 'Missing a temporary folder';
				break;
			case '7':
				$error = 'Failed to write file to disk';
				break;
			case '8':
				$error = 'File upload stopped by extension';
				break;
			case '999':
			default:
				$error = 'No error code avaiable';
		}
	}elseif(empty($_FILES['fileToUpload']['tmp_name']) || $_FILES['fileToUpload']['tmp_name'] == 'none')
	{
		$error = 'No file was uploaded..';
	}else 
	{
//			$msg .= " File Name: " . $_FILES['fileToUpload']['name'] . ", ";
//			$msg .= " File Size: " . @filesize($_FILES['fileToUpload']['tmp_name']);
			//for security reason, we force to remove all uploaded file
			//@unlink($_FILES['fileToUpload']);	

			if($t=="genre")
			{
				$newName="../upload/genre/".rand(1,1000000).time().$_FILES["fileToUpload"]["name"];
		        	move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],"../../".$newName);
				
			}
			else if($t=="film")
			{
				$newName=rand(1,1000000).time().$_FILES["fileToUpload"]["name"];
				move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],$vodMoviePath."/images/".$newName);
				$imageUrl = "http://".$_SERVER["SERVER_NAME"]."/movies/images/".$newName;
				$newName=$imageUrl;
			}

//			$imageUrl=$newName;
			$msg .=$newName;

	}		
	echo "{";
	echo				"error: '" . $error . "',\n";
	echo				"msg: '" . $msg . "'\n";
	echo "}";
?>
