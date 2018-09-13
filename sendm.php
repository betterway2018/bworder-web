<html>
<head>
<title>ThaiCreate.Com PHP Sending Email</title>
</head>
<body>


 <?      
             //  ini_set("SMTP", "localhost");
                ini_set("SMTP", "mail.loxinfo.co.th");
                ini_set("sendmail_from", "bworder@mistine.co.th");

	// $strTo = "sutasinee_w@mistine.co.th,paolopaolo137@yahoo.com,paolopaolo886@hotmail.com,wichianhotcom@hotmail.com,wi1926chian@gmail.com";
                    $strTo =    "wichianhotcom@hotmail.com";
	 $strSubject = "Test Send Email";
	// $strHeader = "From: webmasterbw@thaicreate.com";
                    $strHeader = "From: bworder@mistine.co.th";
   	  

                     $strMessage = "DATATEST";

	 $flgSend = @mail($strTo,$strSubject,$strMessage,$strHeader);  // @ = No Show Error //
	 if($flgSend)
	{
		echo "Email Sending. bworder1";
	}
	else
	{
		echo "Email Can Not Send. bworder1";
	}
?>
</body>
</html>
