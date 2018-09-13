<html>
<head>
<title>Sending Email</title>
</head>
<body>
<?php include("i_function_msg.php"); ?>
<?

	$strFrom=$_POST['txtFrom'];
	$strFromName = $_POST['txtFromName'];
	$strTo = $_POST["txtTo"];
	$strSubject = $_POST["txtSubject"];
	$strMessage = nl2br($_POST["txtDescription"]);
	//$strMessage = $_POST["txtDescription"];

	//*** Uniqid Session ***//
	$strSid = md5(uniqid(time()));

	$strHeader = "";
	$strHeader .= "From: ".$strFromName."<". $strFrom.">\n";
//	 $strHeader .= "Reply-To: ".$strFrom;
//	$headers .= "\r\nCc: he@$hisdomain.com";
	$strHeader .="\r\nBcc: nawin_m@mistine.co.th";
	$strHeader .= "MIME-Version: 1.0\n";
	$strHeader .= "Content-Type: multipart/mixed; boundary=\"".$strSid."\"\n\n";
//	strHeader = "Content-type: text/html; charset=windows-874\n"; // or UTF-8 // 
	$strHeader .= "This is a multi-part message in MIME format.\n";

	$strHeader .= "--".$strSid."\n";
	$strHeader .= "Content-type: text/html; charset=windows-874\n"; // or UTF-8 //
	$strHeader .= "Content-Transfer-Encoding: 7bit\n\n";
	
	

	//$strHeader .= $strMessage."\n\n";
	$Attach="";
	//*** Attachment ***//

	if($_FILES["fileAttach1"]["name"] != "")
	{
		$strFilesName1 = $_FILES["fileAttach1"]["name"];
		$strContent1 = chunk_split(base64_encode(file_get_contents($_FILES["fileAttach1"]["tmp_name"]))); 
		
		$Attach .= "--".$strSid."\n";
		$Attach .= "Content-Type: application/octet-stream; name=\"".$strFilesName1."\"\n"; 
		$Attach .= "Content-Transfer-Encoding: base64\n";
		$Attach .= "Content-Disposition: attachment; filename=\"".$strFilesName1."\"\n\n";
		$Attach .= $strContent1."\n\n";
	}

	$msg =$strMessage."\n\n".$Attach;
	//*** Send Email***//
	//	echo "Header :$strHeader \n\n  Message:$strMessage";

	
	$flgSend = mail($strTo, $strSubject,$msg,$strHeader);  // @ = No Show Error //
	if($flgSend)
	{
		AlertMessage("Send E-mail to $strTo complete.","division.php");
	}
	else
	{
		AlertMessage("Send E-mail to $strTo fail. ","division.php");
	}
?>
</body>
</html>
