<?php require_once('Connections/bwc_orders.php'); ?>
<?php 
 date_default_timezone_set('Asia/Bangkok');  
$dist=$_SESSION['dist'];
$mslno=$_SESSION['mslno'];
$chkdgt=$_SESSION['chkdgt'];
$HBD=$_SESSION['HBD'];

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


 
 
         
         
$BILLCODE = '';
$BILLDESC= '';
$query_billcode= " Select   BILLCODE,BILLDESC,PRICE,BRAND,SPCFLG,DISCFLG,INCTFLG,FREEFLG  From  billcodehbd  ";
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
                                                       echo  'สุขสันต์วันเกิดค่ะ คุณ  '.$_SESSION['name'].'  บริษัทขอส่งมอบความสุขในวันสำคัญของคุณ';
			       echo "<br>";
			       echo  'ด้วยชุดของขวัญพิเศษ  '.$BILLDESC.'   จำนวน 1 ชิ้น โดยไม่มีค่าใช้จ่ายค่ะ';
                                                                echo "<br>";

                                                                // กรณีที่ทำการ POPUP ข้อมูล
                                                                mysql_query("SET AUTOCOMMIT=0"); 
                                                                mysql_query("START TRANSACTION");
                                                                mysql_query("BEGIN");
                                                                $sql_upmsl="UPDATE mslmst  SET SHOWPOP = '2' ,BIRTHDATETEMP =".date('Ymd');
                                                                $sql_upmsl .=" Where  DIST='$dist' AND MSLNO=$mslno AND CHKDGT =$chkdgt ";
                                                                $result_up=mysql_query($sql_upmsl,$bwc_orders);
                                                                if (!$result_up) 
                                                               {
                                                                        mysql_query("ROLLBACK");
                                                                        die('Error 0 :' . mysql_error());
                                                                        exit;
                                                                }                                                                  
		?>
        </p>
        <?php 			 
		   }
			?>
</div>

<?php } ?>


