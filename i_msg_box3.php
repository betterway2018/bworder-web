<?php require_once('Connections/bwc_orders.php'); ?>
<?php 
date_default_timezone_set('Asia/Bangkok');  
$CountFriday =$_SESSION['countfriday']; 
$flag =$_SESSION['countfridayflag']; 
mysql_select_db($database_bwc_orders, $bwc_orders);       
$BILLCODE = '';
$BILLDESC= '';
$query_billcode= " Select   BILLCODE,BILLDESC,PRICE,BRAND,SPCFLG,DISCFLG,INCTFLG,FREEFLG  From  billcodepromotion   ";
$tblbillcode=mysql_query($query_billcode,$bwc_orders) or die(mysql_error());
$row_tblbillcode=mysql_fetch_assoc($tblbillcode);
$total_row_tblbillcode = mysql_num_rows($tblbillcode);
if ($total_row_tblbillcode !=0) 
{ 
   $BILLCODE =  $row_tblbillcode['BILLCODE'];   
   $BILLDESC=  $row_tblbillcode['BILLDESC'];   
}
//echo  "Special =$query_special -->".$totalRows_content_special ;
//echo "<br> All =$query_all-->".$totalRows_content_all ;

?>

<?php 
if ( (int) $CountFriday > 0 &&  $flag == "N") {	
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
                                                       echo  'เรียน คุณ  '.$_SESSION['name'];
			       echo "<br>";
                                                       echo  'บริษัทขอมอบของสมนาคุณสินค้าตัวอย่างฟรายเดย์แด่ท่านสมาชิก   ';
			       echo "<br>";
			       echo  'ด้วยชุดสินค้า  '.$BILLDESC.'   จำนวน 1 ชิ้น โดยไม่มีค่าใช้จ่ายค่ะ';
                                                       echo "<br>";                                                
		?>
        </p>
        <?php }?>
</div>

<?php } ?>


