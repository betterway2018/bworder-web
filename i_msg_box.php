<?php require_once('Connections/bwc_orders.php'); ?>
<?php 

date_default_timezone_set('Asia/Bangkok');  
$dist=$_SESSION['dist'];
$mslno=$_SESSION['mslno'];
$chkdgt=$_SESSION['chkdgt'];


mysql_select_db($database_bwc_orders, $bwc_orders);
$query_birthdate= " Select   birthdate   From mslmst  where  dist  = '$dist'  and mslno  = '$mslno' and  chkdgt = '$chkdgt'     and  SHOWPOP IS NULL and  BIRTHDATETEMP  IS NULL   ";
$tbl015=mysql_query($query_birthdate,$bwc_orders) or die(mysql_error());
$row_tbl015=mysql_fetch_assoc($tbl015);
$total_row_tbl015 = mysql_num_rows($tbl015);
 
$Checkbirthdate  = 0;
if ($total_row_tbl015 !=0) 
{
 $dateTemp =    $row_tbl015['birthdate'];      
 $birthdate1= substr($dateTemp, 4, 4);
 $wrkDate = date('Ymd');
 $birthdate2= substr($wrkDate, 4, 4);
    if($birthdate1  == $birthdate2)
    {
        $Checkbirthdate = 1;
    }  
 }
 else
 {
     // ทำการตรวจสอบที่ปีก่อนว่าได้ปีไหน 
        $query_birthdate= " Select   birthdatetemp,birthdate   From mslmst  where  dist  = '$dist'  and mslno  = '$mslno' and  chkdgt = '$chkdgt' ";
        $tbl015=mysql_query($query_birthdate,$bwc_orders) or die(mysql_error());
        $row_tbl015=mysql_fetch_assoc($tbl015);
        $total_row_tbl015 = mysql_num_rows($tbl015);
            if ($total_row_tbl015 !=0) 
            {
                    // กรณีทีทำการอ่าน YEAR 
                    $yearserver = date('Ymd');
                    $year1= substr($yearserver,0, 4);
                    // กรณีทีทำการอ่าน YEAR SYSTEM
                    $yearsystem =  $row_tbl015['birthdatetemp'];      
                    $year2= substr($yearsystem,0, 4);
                    if( (int)$year1  > (int)$year2 )
                    {
                        // กรณีทำการเปรียบเทียบการ SET ข้อมูล 
                        $dateTemp =    $row_tbl015['birthdate'];      
                        $birthdate1= substr($dateTemp, 4, 4);
                        $wrkDate = date('Ymd');
                        $birthdate2= substr($wrkDate, 4, 4);
                        if($birthdate1  == $birthdate2)
                        {
                             $Checkbirthdate = 1;
                        }  
                    }
            }
 }

   
//echo  "Special =$query_special -->".$totalRows_content_special ;
//echo "<br> All =$query_all-->".$totalRows_content_all ;

?>

<?php 
if ($Checkbirthdate ==1) {
	
?>
<link rel="stylesheet" href="Scripts/JQuery/themes/base/jquery.ui.all.css">
<script src="Scripts/jQueryPOP/jquery-1.4.4.js"></script>
<script src="Scripts/jQueryPOP/external/jquery.bgiframe-2.1.2.js"></script>
<script src="Scripts/jQueryPOP/ui/jquery.ui.core.js"></script>
<script src="Scripts/jQueryPOP/ui/jquery.ui.widget.js"></script>
<script src="Scripts/jQueryPOP/ui/jquery.ui.mouse.js"></script>
<script src="Scripts/jQueryPOP/ui/jquery.ui.button.js"></script>
<script src="Scripts/jQueryPOP/ui/jquery.ui.draggable.js"></script>
<script src="Scripts/jQueryPOP/ui/jquery.ui.position.js"></script>
<script src="Scripts/jQueryPOP/ui/jquery.ui.resizable.js"></script>
<script src="Scripts/jQueryPOP/ui/jquery.ui.dialog.js"></script>
<link href="Scripts/jQueryPOP/demos.css" rel="stylesheet" type="text/css">

<script>
	$(function() {
		// a workaround for a flaw in the demo system (http://dev.jqueryui.com/ticket/4375), ignore!
		$( "#dialog:ui-dialog" ).dialog( "destroy" );
	
		$( "#dialog-message" ).dialog({
			modal: true,
			height:320,
			width:550,
			buttons: {
				ปิด: function() {
					$(this).dialog( "close" );
				}
			}
		});
	});
</script>
    
    <div class="demo">

<div id="dialog-message" title="ส่งข้อความถึงท่านสมาชิก">
	
	       <?php 
		   if( $total_row_tbl015 !=0 ) {			 
			?><p>
		 <span class="ui-icon ui-icon-circle-check" style="float:left;  margin: 0 7px 5px  0;"></span>
         <?php 
                                                                echo  'เรียนคุณ  '.$_SESSION['name'];
			        echo "<hr>";
			        echo  'Happy brihtday ค่ะ ครบรอบวันเกิดปีนี้ขอให้มีความสุขมาก ๆ พบแต่เรื่องดีๆ ร่ำรวย ๆ นะคะ  ';
                                                        echo "<br>";
                                                       echo  'บริษัทขออนุญาตมอบสินค้าพิเศษ โดยไม่คิดมูลค่าแก่ท่าน ที่มีรายการสั่งชื้อสินค้า ในวันคล้ายวันเกิดค่ะ';
			        echo "<br>";				 
			         echo "<td width=100><img src='images_use/birthdate.jpg' alt='' width=100  height=90/></td>";     
                                
                                   
                           
		?>
        </p>
        <?php 			 
		   }
			?>
</div>

<?php } ?>


