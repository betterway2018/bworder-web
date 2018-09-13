<?php
//http://www.mistine.co.th/Catalogue/Mistine/Mistine_201109/xml/Pages.xml
//$xml = simplexml_load_file("test.xml");

$xml = simplexml_load_file("xml/Pages.xml");
foreach($xml->body[0]->attributes() as $a => $b) {
 if($a=='type') {
  echo $a,'="',$b,"\"</br>";
  } else { }
  }
?>
<br />
<?php
$xml = simplexml_load_file("test2.xml");
foreach($xml->body[0]->attributes() as $a => $b) {
 if($a=='type') {
  echo $a,'="',$b,"\"</br>";
  } else { }
  }
?> 
