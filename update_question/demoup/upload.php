<?php
	if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],"uploads/".$_FILES["fileToUpload"]["name"]))
	{
		echo "Copy/Upload Complete<br>";
	}
?>