<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=IE7" >
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Betterway (Thailand)Co., Ltd.</title>
<link rel="stylesheet" type="text/css" href="jQuery/css/ikikkok-slide.css"/>
<link rel="stylesheet" type="text/css" href="css/demo.css"/>
<script language="javascript" src="jQuery/jquery-1.6.2.min.js"></script>
<script language="javascript" src="jQuery/ikikkok-slide.js"></script>
<script>
$(document).ready(function(){
	if($('#ikikkok-slide').get(0)){
		$('#ikikkok-slide').ikikkokSlider({height:170});
	}
});
</script>
<style>
div.reccommnetdetail{
	width:120px;
	margin-right:5px; 
	float:left;
	text-align:center;
	}	
div.reccommnetdetail p{
	margin:0px;
	padding:0px;
	border:0px;
	line-height:200%;
	}	

div.reccommnetdetail span{
	line-height:200%;
	color:#ff0000;
	}	


img.reccomment {
	width:120px; 
	-moz-border-radius:10px; 
	-webkit-border-radius:10px;
	border-radius:10px;
	border:1px solid #dcdcdc;
	}	
div.reccomment {
	width:930px;
	height:142px;
	text-align:center;  
	padding:10px 2px;
	/*border:1px solid #CCCCCC;
	background-color:#FFFFFF;*/
	background-image:url(http://www.catalogfridayonline.com/image_onweb/bgfbw.gif);
	background-repeat:no-repeat;
	}	
a.catrec {
	
}	
</style>
</head>

<body>
<div id="ikikkok-slide">
    <div class="navigator"></div>
    <div class="contents">
    <div align="center">
       <div class="reccomment">
<a href="http://www.catalogfridayonline.com/" target="_new"><div style=" width:165px; margin-right:5px; float:left;"><!--<a class="catrec" href="http://10.0.0.8/catalogfridayonline/index.php">
<img  src="http://10.0.0.8/catalogfridayonline/image_onweb/logofBW.gif" title="" width="120"  style="border:none;" />
				</a>	-->&nbsp;		
				</div></a>
<?
//OR Conditions = 'hot.gif'
$sqlrec = "SELECT detail.subcatagory AS subcat, detail.Catagory AS cat,detail.Subcode AS Subcode,detail.BILLDESC AS BILLDESC,detail.Normalprice AS Normalprice,detail.selectsize AS selectsize,detail.Shortdesc AS Shortdesc,detail.logobrand,pcode.BILLCODE AS BILLCODE,detail.FSCODE AS FSCODE,pcode.PRICE AS PRICE,detail.price_c AS price_c,detail.Image1 AS Image1,detail.Image2 AS Image2,detail.Image3 AS Image3,detail.Image4 AS Image4,detail.Image5 AS Image5,detail.Image6 AS Image6,detail.Image7 AS Image7,pcode.Conditions AS condi,pcode.Status AS Status,pcode.Id AS pid,detail.Description1 AS desc1
 FROM productdetail AS detail JOIN productcode AS pcode ON detail.FSCODE = pcode.FSCODE WHERE Conditions='new.gif' AND CAMP = '201305' AND Status = 'Active' AND Subcode <> '000000'  ORDER By RAND() LIMIT 6";

$conn = mysql_connect("27.254.44.111","catalog", "friday") or die("Could not connect to Database");
					mysql_select_db("catalogfridayonline",$conn) or die("Could not select database");
					mysql_query("SET character_set_results=tis620");
					mysql_query("SET character_set_client=tis620");
					mysql_query("SET character_set_connection=tis620");
$resultrec = mysql_query($sqlrec,$conn) or die("Error : ".mysql_error());
if($resultrec){
		if(mysql_num_rows($resultrec) != 0){
			while($rowrec = mysql_fetch_array($resultrec)){
				if($rowrec["Status"] == "Clearance"){
				
					$big = '<img src="http://www.catalogfridayonline.com/Images/bigsale.png" style="display:block; position:absolute; overflow:visible; width:120px; border:none;" />';
				
				}else{
					$big ='<img src="http://www.catalogfridayonline.com/image_onweb/logobwn.png" style="display:block; position:absolute; overflow:visible; border:none; width:120px;" />';
				}
				$Campain = $rowrec["Campain"];
				print '<div class="reccommnetdetail"><a  class="catrec" href="http://www.catalogfridayonline.com/detail.php?id='.$rowrec["pid"].'" target="_blank" style="">
				'.$big.'
				<img class="reccomment" src="http://www.catalogfridayonline.com/image_product/'.$rowrec["Image1"].'" alt="'.$rowrec["BILLCODE"].' : '.$rowrec["BILLDESC"].'" title="'.$rowrec["BILLCODE"].' : '.$rowrec["BILLDESC"].'"  />
				</a>			
				</div>';
				}
			
		}
	mysql_free_result($resultrec);	
}else{
	
	}
?>
<div style="clear:both"></div>

</div>
</div>
<div align="center">
	<a href="http://www.mistine.co.th/activities_ladycareq/index.php" target="_blank"><img src="images/bannerladycare.jpg" border="0"/></a>
</div>
<div align="center">
	<a href="http://www.catalogfridayonline.com" target="_blank"><img src="images/banner_catonlinebw.jpg" border="0"/></a>
</div>
<div align="center">
	<a href="http://www.mistine.co.th/beautywebboard/indexnew.php" target="_blank"><img src="images/webboardl.gif" border="0"/></a>
</div>

         
        <!--<div class="demo1"><div>Modify your banner content here.</div>-->
        <!--<div class="demo2"><div>Modify your banner content here.</div>-->
  </div>
        
        <!--<div class="demo1"><div>Modify your banner content here.</div>-->
        <!--<div class="demo1"><div>Modify your banner content here.</div>-->
        </div>
        	<!--<ol>
            	<li class="html"><div>Modify your banner content here.</li>
            	<li class="link">Hypertext Link</li>
            </ol>-->
       
</div>
</body>
</html>
