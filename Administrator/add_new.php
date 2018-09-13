
<script src="ckeditor/ckeditor.js"></script>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

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

<script src="ckeditor/ckeditor.js"></script>
<div class="container">
<h2>เพิ่มคำถามที่สมาชิกสอบถามเข้ามาบ่อย</h2>
<form action="update.php"method="post">

  หัวข้อ :   <input type="text" name ="SUBJECT" id ="SUBJECT"  class="form-control" size ="80" value ="" >

<BR>

  ลำดับการเเสดงผล :  <input type="text" name ="SEQ_NO" id ="SEQ_NO"  class="form-control" size ="80" value ="" >

<BR>

 <textarea cols="80" id="editor1" name="editor1" rows="25">

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
