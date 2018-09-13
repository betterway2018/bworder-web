<?php 


session_start(); 
//require_once('check_login.php');
require_once('../include/i_config.php'); 
require_once('../Connections/bwc_content.php');



	mysql_select_db($database_bwc_content,$bwc_content);
mysql_query("SET NAMES 'utf8'");
	
	if($_GET["id"]){
$query="Select * From content_data  Where id= ".$_GET["id"];
$content_data = mysql_query($query, $bwc_content) or die(mysql_error());

$objResult = mysql_fetch_array($content_data);
	}

?>
<script src="ckeditor/ckeditor.js"></script>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="http://code.jquery.com/jquery-latest.js"></script>
</head>

  <meta charset="UTF-8">


<style>
table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
    text-align: left;
    padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}

th {
    background-color: #4CAF50;
    color: white;
}
</style>
</head>
<body>

<script src="https://cdn.ckeditor.com/ckeditor5/11.0.1/classic/ckeditor.js"></script>
<div class="container">
<h2>เพิ่มคำถามที่สมาชิกสอบถามเข้ามาบ่อย</h2>
<form action="update.php"method="post">

  หัวข้อ :   <input type="text" name ="SUBJECT" id ="SUBJECT"  class="form-control" size ="80" value ="<?php  echo $objResult["SUBJECT"]; ?>" >

<BR>

  ลำดับการเเสดงผล :  <input type="text" name ="SEQ_NO" id ="SEQ_NO"  class="form-control" size ="80" value ="<?php  echo $objResult["SEQ_NO"]; ?>" >

<BR>

 <textarea cols="80" id="editor1" name="editor1" rows="25">
 <?php  echo $objResult["DETAIL"]; ?>
      </textarea>
	  
	  <input type="hidden" name ="id" id ="id" size ="80"  value ="<?php  echo $_GET["id"]; ?>" >
<script>
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1');
    function CKupdate() {
        for (instance in CKEDITOR.instances)
            CKEDITOR.instances[instance].updateElement();
    }
</script>
<button type="summit" class="btn btn-primary btn-lg btn-block" style="
    background-color: deeppink;
    border-color: deeppink;
" >บันทึก</button>
<a href="index.php"><button type="button" class="btn btn-secondary btn-lg btn-block">ยกเลิก</button></a>

</form> 
</div>
</body>
</html>
