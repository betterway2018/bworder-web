<?php 
session_start();   //  ทำการ  START 
clearstatcache();
header('Content-type: text/html; charset=utf-8');
 
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Description of newdsmorder
 *
 * @author wichian_w
 */
class newdsmorder extends CI_Controller {

    //var   $useragent  = "CodeIgniter";
    //put your code here
    public function __construct() {
        parent::__construct();
        // ทำการ LOAD  MODEL ด้วยระบบถึงจะทำงาน   
       
        $this->load->library('session');
        $this->load->library('sessiontemp');
        require_once('nusoap.php');
	    $client = new soapclient('http://10.0.0.119/bworder/WriteLog.php'); 
    }

    
    public function confirm() {
        // กรณ๊ที่ทำการส่งข้อความไปทำการ   confirm        
        $campaign = $_GET['camp'];
        $po = $_GET['po'];
        $dist = $_GET['dist'];
        $mslno = $_GET['mslno'];
        $chkdgt = $_GET['chkdgt'];
        $rep_name = $_SESSION['name'];
        $email = $_SESSION['email'];
        //$filename = iconv('windows-874', 'UTF-8', $rep_name);
        $filename = $rep_name;    
        $Flagtemp = 'C';
        // confirmTemp  กรณีที่ทำการ  confirm Data Temp อีกครั้ง 
        $this->confirmTemp($campaign, $po, $dist, $mslno, $chkdgt, $rep_name, $email, $filename, $Flagtemp);
        // ทำการ echo Data กลับไป
        echo "<meta http-equiv='refresh' content='0;URL=../../../index.php'>";
    }


    public function send_mail($dist, $to, $divisionname, $rep_name, $str_rep_code, $str_camp, $str_current_date, $str_current_time, $str_dwn_date, $msg, $tot_amt, $Flagtemp) {
        // ข้อความในส่วนของ HEADER
        
   
            
        $strcamp = substr($str_camp, 4,2)."/".substr($str_camp, 0,4);
        $strcurrentdate = substr($str_current_date,6,2)."/".substr($str_current_date,4,2)."/".substr($str_current_date,0,4);
        $strcurrenttime = substr($str_current_time,0,2).":".substr($str_current_time,2,2).":".substr($str_current_time,4,2);
        $strdwndate = substr($str_dwn_date,6,2)."/".substr($str_dwn_date,4,2)."/".substr($str_dwn_date,0,4);
        
        if($strcamp == '')
        {
            $strcamp  = $str_camp;
        }
         if($strcurrentdate == '')
        {
            $strcurrentdate  = $str_current_date;
        }
         if($strcurrenttime == '')
        {
            $strcurrenttime  = $str_current_time;
        }
        if($strdwndate == '')
        {
            $strdwndate  = $str_dwn_date;
        }
        $msg_header = "";
        $msg_header .="<font style='font-family:Tahoma, Geneva, sans-serif;font-size:12 ;color:#252525'>";
        $msg_header .= "เรียน สมาชิกเขต  $dist  คุณ $divisionname<br />";
        $msg_header .=" รหัสสมาชิก  $str_rep_code<br />";
        $msg_header .="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ทางบริษัทฯ ขอขอบคุณที่ท่านได้สั่งซื้อสินค้าผ่านทางเว็บไซต์ http://www.bworder.com ";
        $msg_header .="ในรอบจำหน่ายที่  $strcamp<br />";
        $msg_header .= "วันที่สั่งซื้อผลิตภัณฑ์  $strcurrentdate  เวลา  $strcurrenttime <br />";
        $msg_header .= "วันที่ดาวน์โหลดข้อมูล  $strdwndate ";
        $msg_header .="</font>";
        
         
        $MailMessage = "";
        $MailMessage .=$msg_header;
        $MailMessage .='<table width=560 border=0 cellspacing=0 cellpadding=0 ';
        $MailMessage .='style="font-family:Tahoma, Geneva, sans-serif;font-size:12 ;color:#252525">';
        $MailMessage .= '<tr>';
        $MailMessage .= '<td height=23 width="44" style="border-bottom:dotted #5F5F5F 1px;border-top:dotted #5F5F5F 1px">ลำดับ</td>';
        $MailMessage .= '<td  height=23 width="71" style="border-bottom:dotted #5F5F5F 1px;border-top:dotted #5F5F5F 1px">รหัสสินค้า</td>';
        $MailMessage .='<td height=23  width="362" style="border-bottom:dotted #5F5F5F 1px;border-top:dotted #5F5F5F 1px">ชื่อสินค้า/รายละเอียด</td>';
        $MailMessage .= ' <td  height=23 width="83"  align="right" style="border-bottom:dotted #5F5F5F 1px;border-top:dotted #5F5F5F 1px">จำนวนสั่งซื้อ</td>';
        $MailMessage .= ' <td  height=23 width="85"  align="right" style="border-bottom:dotted #5F5F5F 1px;border-top:dotted #5F5F5F 1px">ราคา/หน่วย</td>';
        $MailMessage .= '<td  height=23 width="85"  align="right" style="border-bottom:dotted #5F5F5F 1px;border-top:dotted #5F5F5F 1px">ราคารวม</td>';
        $MailMessage .='</tr>';

        $MailMessage .=$msg;
        $MailMessage .= "<tr>";
        $MailMessage .= '<td height=23 width="44" style="border-bottom:dotted #5F5F5F 1px;border-top:dotted #5F5F5F 1px">&nbsp;</td>';
        $MailMessage .= '<td  height=23 width="71" style="border-bottom:dotted #5F5F5F 1px;border-top:dotted #5F5F5F 1px">&nbsp;มูลค่ารวม</td>';
        $MailMessage .='<td height=23  width="362" style="border-bottom:dotted #5F5F5F 1px;border-top:dotted #5F5F5F 1px">&nbsp;</td>';
        $MailMessage .= '<td  height=23 width="83" align="right" style="border-bottom:dotted #5F5F5F 1px;border-top:dotted #5F5F5F 1px">&nbsp;</td>';
        $MailMessage .= '<td  height=23 width="85"  align="right" style="border-bottom:dotted #5F5F5F 1px;border-top:dotted #5F5F5F 1px">&nbsp;</td>';
        $MailMessage .= '<td  height=23 width="85"  align="right" style="border-bottom:dotted #5F5F5F 1px;border-top:dotted #5F5F5F 1px">&nbsp;';
        $MailMessage .= $tot_amt . '</td>';
        $MailMessage .="</tr>";
        $MailMessage .="</table>";

        $MailMessage .='<font style="font-family:Tahoma, Geneva, sans-serif;font-size:12 ;color:#252525">';
        $MailMessage .= '<br><br><b>หมายเหตุ : </b> อีเมลล์ฉบับนี้เป็นการแจ้งข้อมูลอัตโนมัติ กรุณาอย่าตอบกลับ<br />';
        $MailMessage .='หากต้องการสอบถามรายละเอียดเพิ่มเติมกรุณา ติดต่อผ่านทาง Call Center โทร 02-118-5111<br />';
        $MailMessage .='วันจันทร์-ศุกร์ เวลา 8.00-24.00 น.    วันเสาร์-อาทิตย์ เวลา 8.00-17.30 น. <br /></font>';

        if ($Flagtemp == 'C') {
            $MailSubject = "ยืนยัน BWORDER  คุณ $rep_name";
            $MailSubject .= " รหัสสมาชิก  $str_rep_code ";
        } else if ($Flagtemp == 'D') {
            $MailSubject = "ลบข้อมูล BWORDER  คุณ $rep_name";
            $MailSubject .= " รหัสสมาชิก  $str_rep_code ";
        }

		if( $to  == ''){
			$to  = 'bwdsmmistine@gmail.com';
		}

		require_once('class.phpmailer.php');
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->CharSet="UTF-8";
		$mail->SMTPSecure = 'tls';
	  	$mail->Host = 'mailcorp.truemail.co.th';
		$mail->Port = 25;
		$mail->SMTPAuth = true;
		$mail->Username = 'mistineinfo@mistine.co.th';
		$mail->Password = '1234';

		$mail->From = 'mistineinfo@mistine.co.th';
		$mail->FromName = 'BWORDER.COM';
		$mail->AddAddress($to);         
		$mail->AddBCC('bwdsmmistine@gmail.com');
		$mail->IsHTML(true);
		$mail->Subject = $MailSubject;
		$mail->Body    = $MailMessage ;
		
		if(!$mail->Send())
		{
				//echo "Mailer Error: " . $mail->ErrorInfo;
		        return TRUE; 
		}
		else
		{
				//echo "Message sent!";
				return TRUE; 
		}
		return TRUE; 
    }

    public function index() {
	 $client = new soapclient('http://10.0.0.119/bworder/WriteLog.php'); 
        date_default_timezone_set('Asia/Bangkok');   
        $rowlisttemp  = 25;        
        $login = $_SESSION['login'];
		if ($login != 1) {
            echo "<meta http-equiv='refresh' content='0;URL=../check_login.php'>";
        }
        $GETTEMP = '';
        
        // เป็น FLAG ที่ทำการ DELETE DATA 
        $DelFlag  = '';
        $Listorderproduct = array();  // ต้องเอาไว้บนสุดเท่านั้น 
        // กรณีที่ Data ทำการ Load ขึ้นมาครั้งแรก      
        // ตัวที่ทำการ GET ได้เลย       
        $dist = $_GET['dist'];
        $mslno = substr("00000" . $_GET['mslno'], -5);
        $chkdgt = $_GET['chkdgt'];
        $campaign = $_GET['camp'];
	$strcurrentdate = date("Ymd");
	$strcurrenttime = date("H:i:s");
        //   
        if ($dist == "" || $mslno == "" || $chkdgt == "") {
            echo "<meta http-equiv='refresh' content='0;URL=../index.php'>";
         //echo "1111";
        }
        if ($campaign == "") {
            echo "<meta http-equiv='refresh' content='0;URL=../index.php'>";  
        // echo "2222";
        }
        $this->sessiontemp->set('Pass', 'N');
        $id = $_GET['id'];
        $rep_name = $_GET['rep_name'];
        //$filename = iconv('windows-874', 'UTF-8', $rep_name);        
        $filename = $rep_name;       
        //$rep_arbal = $_SESSION['rep_arbal'];
        // ตัวที่ยังต้องนำไปทำการ คำนวณใหม่ก่อน    
        if (strlen($id) == 10) {
            $dist = substr($id, 0, 4);
            $mslno = substr($id, 4, 5);
            $chkdgt = substr($id, 9, 1);
        } elseif (strlen($id) == 9) {
            $dist = substr($id, 0, 3);
            $mslno = substr($id, 3, 5);
            $chkdgt = substr($id, 8, 1);
        }
        $rep_name = $_SESSION['name'];
        $email = $_SESSION['email'];
        //$filename = iconv('windows-874', 'UTF-8', $rep_name);
		$filename = $rep_name; 
        $rowload = 0;
        $flagload = 0;
        $order_no = 0;
        if ($_GET['doMode'] == "Edit") {
            $flagload = "UPDATE";
        } else {
            $flagload = "INSERT";
        }
        
  
                    
        // กรณีที่ PAGE ทำการเปิดมา
        if ($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['doMode']) && ($_GET['doMode'] == "New" || $_GET['doMode'] == "Edit")) {
                $this->db->trans_start();
                $this->db->select(" * ");
                $this->db->from("Order_Header");
                $this->db->where("DIST", $dist);
                $this->db->where("mslno", $mslno);
                $this->db->where("chkdgt", $chkdgt);
                $this->db->where("ordcamp", $campaign);
                $this->db->where("dwnflag", 'N');
                $this->db->where("delflag", 'N');
                $rs = $this->db->get();
                $this->db->trans_complete();
                if ($rs->num_rows() > 0) {
                    // ข้อมูลที่อยู่ใน Table หลัก      
                    $GETTEMP = 'H';
                    $row_order = $rs->row_array();
                    $strcamp = substr($campaign, 4, 2) . "/" . substr($campaign, 0, 4);
                    $strpo = substr("000000" . $row_order['ORDER_NO'], -6);
                    $order_no = $row_order['ORDER_NO'];
					$order_date = $row_order['ORDDATE'];
					$order_time = $row_order['ORDTIME'];
                    $flag = "UPDATE";
                    $this->sessiontemp->set('strcamp', $strcamp);
                    $this->sessiontemp->set('strpo', $strpo);
                    $this->sessiontemp->set('order_no', $order_no);
					$this->sessiontemp->set('order_date', $order_date);
					$this->sessiontemp->set('order_time', $order_time);
                } else {
                    $this->sessiontemp->set('strcamp', 'N');
                    $this->sessiontemp->set('strpo', 'N');
                    $this->sessiontemp->set('order_no', 'N');
					$this->sessiontemp->set('order_date', '');
					$this->sessiontemp->set('order_time', '');
                    // ทำการเพิ่มกรณีที่ไม่มีข้อมูลส่วนไหนเลย                    
                      $flagload = "INSERT";
                }
            
            $this->sessiontemp->set('ORH', $GETTEMP);
            if ($GETTEMP == 'H') {  // ทำการ  GETDETAIL จาก  BASE จริง
			//	echo 'ORDER_DETAIL';
                $rsdetail = $this->GETORDERDETAIL($campaign, $order_no, $dist, $mslno, $chkdgt, 'ORDER_DETAIL');

				$i = 0;

				if ($rsdetail) {
					$data['rstemp'] = $rsdetail->result_array();
					
					foreach ($data['rstemp']as $row_order_detail) {
						$i = $i + 1;
						// echo 'Loop'.$i.'| BILLCODE '. $row_order_detail['BILLCODE'];
						$userinfo = array(
							'code' => $row_order_detail['BILLCODE'],
							'qty' => $row_order_detail['QTY'],
							'desc' => $row_order_detail['BILLDESC'],
							'price' => $row_order_detail['PRICE'],
							'amount' => $row_order_detail['AMOUNT'],
							'brand' => $row_order_detail['BRAND'],
							'vmflag' => $row_order_detail['VMFLAG'],
							'orderqty' => $row_order_detail['ORDERQTY']);
							$Listorderproduct[$i] = $userinfo;
					}
				}	
				
				// row ที่ทำงาน
				$rowadd  = $rowlisttemp  - $i;
				if($rowadd  > 0)
				{
					FOR ($add = 1; $add<= $rowadd; $add++) {
							$i = $i + 1;
							$userinfo = array(
							'code' =>'','qty' =>'',
							'desc' => '', 'price' => '',
							'amount' =>'', 'brand' => '',
							'vmflag' => '', 'orderqty' => '');
							$Listorderproduct[$i] = $userinfo;
					}
				}
				else
				{
					FOR ($add = 1; $add<= $rowlisttemp; $add++) {
							$i = $i + 1;
							$userinfo = array(
							'code' =>'','qty' =>'',
							'desc' => '', 'price' => '',
							'amount' =>'', 'brand' => '',
							'vmflag' => '', 'orderqty' => '');
							$Listorderproduct[$i] = $userinfo;
					} 
				}
				// ทำการ ADDROW 
				$rowload = $i;                

            } else if ($GETTEMP == 'L') {  // ทำการ  GETDETAIL จาก ฺBASE LOG
                //  echo 'ORDERDETAIL';
                $rsdetail = $this->GETORDERDETAIL($campaign, $order_no, $dist, $mslno, $chkdgt, 'ORDER_DETAIL');
                $data['rstemp'] = $rsdetail->result_array();
                $i = 0;
                //    echo '22';
                foreach ($data['rstemp']as $row_order_detail) {
                    $i = $i + 1;
                    // echo 'Loop'.$i.'| BILLCODE '. $row_order_detail['BILLCODE'];
                    $userinfo = array(
                        'code' => $row_order_detail['BILLCODE'],
                        'qty' => $row_order_detail['QTY'],
                        'desc' => $row_order_detail['BILLDESC'],
                        'price' => $row_order_detail['PRICE'],
                        'amount' => $row_order_detail['AMOUNT'],
                        'brand' => $row_order_detail['BRAND'],
						'vmflag' => $row_order_detail['VMFLAG'],
						'orderqty' => $row_order_detail['ORDERQTY']);
                    $Listorderproduct[$i] = $userinfo;
                }
                
                
                // row ที่ทำงาน
                $rowadd  = $rowlisttemp  - $i;
                if($rowadd  > 0)
                {
                    FOR ($add = 1; $add<= $rowadd; $add++) {
                            $i = $i + 1;
                            $userinfo = array(
                            'code' =>'','qty' =>'',
                            'desc' => '', 'price' => '',
                            'amount' =>'', 'brand' => '',
				  'vmflag' => '', 'orderqty' => '');
                            $Listorderproduct[$i] = $userinfo;
                    }
                }
                else
                {
                       FOR ($add = 1; $add<= $rowlisttemp; $add++) {
                            $i = $i + 1;
                            $userinfo = array(
                            'code' =>'','qty' =>'',
                            'desc' => '', 'price' => '',
                            'amount' =>'', 'brand' => '',
							'vmflag' => '', 'orderqty' => '');
                            $Listorderproduct[$i] = $userinfo;
                    } 
                }
                // ทำการ ADDROW 
                $rowload = $i;

            }
        }
        // ส่วนการทำงานของ EVENT 
        if ($this->input->post("btn_addrow") != null) {
            // ทำการเก็บ  Data ออกมาก่อนเพื่อความสะดวก       
            $this->sessiontemp->set('Pass', 'N');
            $num = $this->sessiontemp->get('orderrow');
            $num = $num + $rowlisttemp;
            $this->sessiontemp->set('orderrow', $num);
            $this->sessiontemp->set('action', 'A');
        } else if ($this->input->post("btn_delselect") != null) {
            // ทำการ ลบ ข้อมูลออกไปจาก TEXT ที่ป้อนเข้ามา            
            $this->sessiontemp->set('action', 'D');

            // กรณีที่ทำการกด DELETE เข้ามา              
        } else if ($this->input->post("btn_delelectall") != null) {
            // กรณีที่ทำการ DELETE ALL
            // กรณีทีทำการเปิดมาก่อน
            $order_noDel = '';
            $order_noDel = $this->sessiontemp->get('order_no');
			$order_date = $this->sessiontemp->set('order_date', $order_date);
			$order_itme = $this->sessiontemp->set('order_time', $order_time);
            if ($order_noDel == 'N') {
                // กรณีที่ทำการดึงมาจากตอนที่ทำการ Save
                $order_noDel = $this->sessiontemp->get('ordernogen');
            }
            //echo 'DATATEMP001.' . $order_noDel;
			//กรณีที่ทำการ DELETE รายการทั้งหมด 
              $DelFlag =  $this->DELETEDATA($order_noDel, $campaign, $dist, $mslno, $chkdgt, '', '', '', 'A', $strcurrentdate, $strcurrenttime);            
              if($DelFlag == '0')
                {
                    echo "<script type=\"text/javascript\">alert('พบข้อผิดพลาดในการเชื่อมต่อฐานข้อมูล ไม่สามารถลบข้อมูลได้ กดปุ่ม OK ระบบจะกลับไปที่หน้าจอเมนู เพื่อลองใหม่อีกครั้ง') </script>";      
                    $this->sessiontemp->set('Pass', 'Y');  
                    echo "<meta http-equiv='refresh' content='0;URL=../../../index.php'>";
                    $this->db->trans_rollback();          
                    return 0;
                }  
            $this->sessiontemp->set('order_no', 'N');
            $num = $rowlisttemp;
            $this->sessiontemp->set('orderrow', $num);
            $this->sessiontemp->set('action', 'A');
       
            // กรณีที่ทำการกด DELETE เข้ามา       
            //  echo 'DATATEMP002.'.$order_noDel;
        } else {
            if ($flagload == "UPDATE") {
                $this->sessiontemp->set('action', 'L');
                $num = $rowload;
            } else {
                $this->sessiontemp->set('action', 'N');
                $num = $rowlisttemp;
            }
            $this->sessiontemp->set('orderrow', $num);
        }
        $flag = $this->sessiontemp->get('action');
        if ($flag == 'A') {  // กรณ๊ที่ทำการ ADD DATA เข้าไปในระบบ 
            $num = $this->sessiontemp->get('orderrow');
            $num = $num - $rowlisttemp;
            for ($i = 1; $i <= $num; $i++) {
                $userinfo = array(
                    'code' => $this->input->post("txtcode_" . $i),
                    'qty' => $this->input->post("txtqty_" . $i),
                    'desc' => $this->input->post("txtdesc_" . $i),
                    'price' => $this->input->post("txtprice_" . $i),
                    'amount' => $this->input->post("txtamount_" . $i),
                    'brand' => $this->input->post("txtbrand_" . $i),
			'vmflag' => $this->input->post("txtvmflag_" . $i),
			'orderqty' => $this->input->post("txtorderqty_" . $i));
                // จากนั้นทำการเอา                 
                $Listorderproduct[$i] = $userinfo;
            }
        } else if ($flag == 'D') {  // กรณ๊ที่ทำการ DEL  DATA เข้าไปในระบบ 
            // กรณ๊ที่ทำการ DeleteData 
            $numdel = $this->sessiontemp->get('orderrow');
            $num_del = 0;
            $numall = 0;
            $i_del = 0;  // เป็นตัวที่ทำการเก็บ Data กรณีที่ทำการ Delete 
            $msg = ''; // เป็นตัวที่บอกว่าเหลือจากการลบ 
            $amount = 0;

            // ทำการเก็บรายการทั้งหมดก่อน
            for ($p = 1; $p <= $numdel; $p++)
            {
                $billcode = $this->input->post("txtcode_" . $p);
                if ($billcode <> '') 
                    {
                        $numall = $numall + 1;
                    }
            }
          
            
         $bill_codehbd  = '';  
        // BLOCK 0999
        // เก็บรายการที่เป็นของขวัญไว้ก่อน
        //          if($dist == '0999')
        //            {
                    $this->db->select(" BILLCODE,BILLDESC,PRICE,BRAND,SPCFLG,DISCFLG,INCTFLG,FREEFLG ");
                    $this->db->from("billcodehbd");                    
                   // $this->db->where("BILLCODE", $bill_code);
                    $rshbd = $this->db->get();
                    if ($rshbd->num_rows() > 0) 
                    {
                            $row_billcodehbd = $rshbd->row_array();
                            $bill_codehbd = $row_billcodehbd['BILLCODE'];
                    }                         
      //}

            // ทำการส่ง DATA ไปทำการลบข้อมูล 
            $list = 0 ;
            $list_hbd = 0 ; // เก็บจำนวน LiST วันเกิด
            $billCodeHBD = '' ;
            // กรณีที่ทำการลบทีละแถวทำการตรวจสอบ BAND อย่างเดียว 
            $countbandch = 0;
            $countbandall = 0;
            for ($i = 1; $i <= $numdel; $i++) 
            {
                 // echo 'LOOP  '.$i ;
                 $ch = $this->input->post("chk_" . $i);                
                 $brandAll = $this->input->post("txtbrand_" . $i);
                if((int) $brandAll == 2)
                 {
                        $countbandall  = $countbandall + 1;
                 }
              
                
                // กรณีที่ทำการ GET รหัสสินค้า
                $billcode = $this->input->post("txtcode_" . $i);
                if ($ch == 'on') 
                   {
                    // เก็บเพื่อที่จะอาไปลบกับจำนวนทั้งหมดเพื่อหาขอขวัญวันเกิด
                    if($billcode != '')
                    {
                        $list_hbd  = $list_hbd + 1;
                    }

                    $num_del = $num_del + 1;
                    
                    // ทำการตรวจสอบจำนวน ฺBAND 
                    $brandCheck = $this->input->post("txtbrand_" . $i);
                    if((int) $brandCheck == 2)
                    {
                       $countbandch  = $countbandch +1;
                    }                              
                      
                    //  ทำการส่งข้อมูลไปทำการ ลบออกมีอะไรบ้าง                   
                    $list = $num_del;
                    $listall = $numall;
                    // กรณีที่ทำการ ลบรายการต้องต้องการ Delete 
                    $order_noDel = '';
                    $order_noDel = $this->sessiontemp->get('order_no');
                    $order_date = $this->sessiontemp->get('order_date');
					$order_time = $this->sessiontemp->get('order_time');
					if ($order_noDel == 'N') {
                        // กรณีที่ทำการดึงมาจากตอนที่ทำการ Save
                        $order_noDel = $this->sessiontemp->get('ordernogen');
                    }
                    //  echo '$order_noDel......'.$order_noDel.' | '.$list.' | '.$listall ;  
                                       
						

                    // ทำการลบแตละรายการ
                     $DelFlag =   $this->DELETEDATA($order_noDel, $campaign, $dist, $mslno, $chkdgt, $billcode, $list, $listall, 'A', $strcurrentdate, $strcurrenttime);
                    // echo "DEL" . $DelFlag;
                     if($DelFlag == '0')
                     {
                            echo "<script type=\"text/javascript\">alert('พบข้อผิดพลาดในการเชื่อมต่อฐานข้อมูล ไม่สามารถลบข้อมูลได้ กดปุ่ม OK ระบบจะกลับไปที่หน้าจอเมนู เพื่อลองใหม่อีกครั้ง') </script>";      
                            $this->sessiontemp->set('Pass', 'Y');  
                            echo "<meta http-equiv='refresh' content='0;URL=../../../index.php'>";
                            $this->db->trans_rollback();          
                            return 0;
                     }                     
                }
                else 
                {
                    $i_del = $i_del + 1;                    
                    if($billcode != ''){
                    $billCodeHBD  = $billcode;
                    }
                    
                    $userinfo = array(
                        'code' => $this->input->post("txtcode_" . $i),
                        'qty' => $this->input->post("txtqty_" . $i),
                        'desc' => $this->input->post("txtdesc_" . $i),
                        'price' => $this->input->post("txtprice_" . $i),
                        'amount' => $this->input->post("txtamount_" . $i),
                        'brand' => $this->input->post("txtbrand_" . $i),
						'vmflag' => $this->input->post("txtvmflag_" . $i),
						'orderqty' => $this->input->post("txtorderqty_" . $i));
                    $amountlist = $this->input->post("txtamount_" . $i);
                    //  กรณีเหลือจากการ  DELETE ส่งไปทำการ GENEMAIL  
                 
                    $msg .= '<tr>';
                    $msg .= '<td align="center">' . $i_del . '</td>';
                    $msg .= '<td align="center">' . $this->input->post("txtcode_" . $i) . '</td>';
                    $msg .= '<td>' . $this->input->post("txtdesc_" . $i) . '</td>';
                    $msg .= '<td align="right">' . $this->input->post("txtqty_" . $i) . '</td>';
                    $msg .= '<td align="right">' . $this->input->post("txtprice_" . $i) . '</td>';
                    $msg .= '<td align="right">' . $this->input->post("txtamount_" . $i) . '</td>';
                    $msg .= '</tr>';
                    $amount = $amount + $amountlist;
                    $Listorderproduct[$i_del] = $userinfo;                    
                }
            }
            
            
                        $listbdb  = $numall - $list_hbd;
                        if($listbdb == 1)
                         {
                             if($bill_codehbd == $billCodeHBD)
                                 {
                                        $DelFlag =  $this->DELETEDATA($order_noDel, $campaign, $dist, $mslno, $chkdgt, '', '', '', 'B', $strcurrentdate, $strcurrenttime);            
                                        if($DelFlag == '0')
                                        {
                                        echo "<script type=\"text/javascript\">alert('พบข้อผิดพลาดในการเชื่อมต่อฐานข้อมูล ไม่สามารถลบข้อมูลได้ กดปุ่ม OK ระบบจะกลับไปที่หน้าจอเมนู เพื่อลองใหม่อีกครั้ง') </script>";      
                                        $this->sessiontemp->set('Pass', 'Y');  
                                        echo "<meta http-equiv='refresh' content='0;URL=../../../index.php'>";
                                        $this->db->trans_rollback();          
                                        return 0;
                                        }  
                                        $this->sessiontemp->set('order_no', 'N');
                                        $num = $rowlisttemp;
                                        $this->sessiontemp->set('orderrow', $num);
                                        $this->sessiontemp->set('action', 'A');         
                                 }
                            }
                    
                            
   
                                        $listband  = $countbandall - $countbandch;
                                        $listbdb  = $numall - $list_hbd;                                         
                                       
                                        

                                                     
                                        // กรณีที่ทำการดึงข้อมูลรายการสินค้า
                                        $this->db->select(" BILLCODE,BILLDESC,PRICE,BRAND,SPCFLG,DISCFLG,INCTFLG,FREEFLG  ");
                                        $this->db->from("billcodepromotion");    
                                        $this->db->where("CAMP", $campaign);
                                        // $this->db->where("BILLCODE", $bill_code);
                                        $rshbd = $this->db->get();
										$bill_codehfd = "";
                                        if ($rshbd->num_rows() > 0)                                       
                                        {
                                        $row_billcodefd = $rshbd->row_array();
                                        $bill_codehfd = $row_billcodefd['BILLCODE'];  
                                        }              
                                        if((int)$listband == 0 &&  (int)$listbdb > 1 && $bill_codehfd <> "")
                                        {
                                           try
                                                {
                                                        // ทำการลบ สินค้า FD
                                                        $datadetailFD = array(
                                                        'DELFLAG' => 'Y'
                                                        );                                        
                                                        $this->db->trans_begin();     
                                                        $this->db->where("DIST", $dist);
                                                        $this->db->where("mslno", $mslno);
                                                        $this->db->where("chkdgt", $chkdgt);
                                                        $this->db->where("ordcamp", $campaign);
                                                        $this->db->where("ORDER_NO", $order_noDel);
                                                        $this->db->where("BILLCODE", $bill_codehfd);
                                                        $this->db->update('ORDER_DETAIL', $datadetailFD);                                        
                                                        if ($this->db->trans_status() === FALSE)
                                                        {    
                                                            $this->db->trans_rollback();           
                                                            return 0;
                                                        }
                                                        else 
                                                        {                                   
                                                                $this->db->trans_commit();               
                                                        }                                                             
                                                        
                                                        $msg = '';                                                  
                                                        $Tempband = $Listorderproduct;
                                                        $listbd = 0;
                                                            FOR ($i = 1; $i <= $i_del; $i++) 
                                                            {           
                                                                if ($Tempband != null) 
                                                                    {
                                                                    $Bcodedata = $Tempband[$i]['code'];
                                                                    $Bqty = $Tempband[$i]['qty'];
                                                                    $Bdesc = $Tempband[$i]['desc'];
                                                                    $Bprice = $Tempband[$i]['price'];
                                                                    $Bamount = $Tempband[$i]['amount'];
                                                                    $Bbrand = $Tempband[$i]['brand'];
										    $Borderqty = $Tempband[$i]['orderqty'];
										    $Bvmflag = $Tempband[$i]['vmflag'];
																	
                                                                    if( $Bcodedata  != $bill_codehfd)
                                                                    {
                                                                        $listbd = $listbd + 1;
                                                                        $userinfo = array(
                                                                        'code' =>$Bcodedata,
                                                                        'qty' =>$Bqty,
                                                                        'desc' => $Bdesc,
                                                                        'price' => $Bprice,
                                                                        'amount' => $Bamount,
                                                                        'brand' => $Bbrand,
																		'orderqty' => $Borderqty,
																		'vmflag' => $Bvmflag);
                                                                        $amountlist =$Bamount;
                                                                        //  กรณีเหลือจากการ  DELETE ส่งไปทำการ GENEMAIL                                                                                    
                                                                        $msg .= '<tr>';
                                                                        $msg .= '<td align="center">' .$listbd. '</td>';
                                                                        $msg .= '<td align="center">' . $Bcodedata . '</td>';
                                                                        $msg .= '<td>' . $Bdesc . '</td>';
                                                                        $msg .= '<td align="right">' .$Bqty . '</td>';
                                                                        $msg .= '<td align="right">' .$Bprice. '</td>';
                                                                        $msg .= '<td align="right">' .$Bamount . '</td>';
                                                                        $msg .= '</tr>';
                                                                        $amount = $amount + $amountlist;
                                                                        $Listorderproduct[$listbd] = $userinfo;  
                                                                    }
                                                                }
                                                            }                                                        
                    
                                                    }
                                                    catch (Exception $e)                      
                                                    {                                                 
                                                            echo $e->getError();                                            
                                                    }                                                                         
                                            }
                                            else if((int)$listband == 0 &&  (int)$listbdb ==  1)
                                            {
                                                // ทำการ Connect DataBase 
                                                if($billCodeHBD == $bill_codehfd)
                                                {
                                                        $DelFlag =  $this->DELETEDATA($order_noDel, $campaign, $dist, $mslno, $chkdgt, '', '', '', 'B', $strcurrentdate, $strcurrenttime);            
                                                        if($DelFlag == '0')
                                                        {
                                                            echo "<script type=\"text/javascript\">alert('พบข้อผิดพลาดในการเชื่อมต่อฐานข้อมูล ไม่สามารถลบข้อมูลได้ กดปุ่ม OK ระบบจะกลับไปที่หน้าจอเมนู เพื่อลองใหม่อีกครั้ง') </script>";      
                                                            $this->sessiontemp->set('Pass', 'Y');  
                                                            echo "<meta http-equiv='refresh' content='0;URL=../../../index.php'>";
                                                            $this->db->trans_rollback();          
                                                            return 0;
                                                        }  
                                                        $this->sessiontemp->set('order_no', 'N');
                                                        $num = $rowlisttemp;
                                                        $this->sessiontemp->set('orderrow', $num);
                                                        $this->sessiontemp->set('action', 'A');  
                                                }
                                            }

                  
	

          //  $this->SendemaillistDelete($campaign, $this->sessiontemp->get('order_no'), $dist, $mslno, $chkdgt, $rep_name, $email, $filename, $msg, $amount);
            $FlagTemp = $this->sessiontemp->get('DELETEALL');
            if ($FlagTemp == 'Y') {
                $num = $rowlisttemp;
				$this->sessiontemp->set('order_no', 'N');
                $this->sessiontemp->set('orderrow', $num);
                $this->sessiontemp->set('action', 'A');
            } else {
                $numdel = $numdel - $num_del;
		  $this->sessiontemp->set('orderrow', $numdel);
            }
       
            
        }
		
	 $order_no_delitem = $this->sessiontemp->get('order_no');
	 $rep_name = $this->sessiontemp->get('rep_name');	   
	////////////////////////////////////////////////////////////////////////////////////////// EMAIL  ////////////////////////////////////////////////////////////////////////////////////////// 					
	 $this->DeleteByItem($dist,$mslno,$chkdgt, $campaign,$order_no_delitem, $rep_name, $email);
     ////////////////////////////////////////////////////////////////////////////////////////// EMAIL  ////////////////////////////////////////////////////////////////////////////////////////// 		
		
        // ทำการเก็บ session ไว้เพื่อที่จะไปทำการget ที่  
        
        $this->sessiontemp->set('campaign', $campaign);
        $this->sessiontemp->set('dist', $dist);
        $this->sessiontemp->set('mslno', $mslno);
        $this->sessiontemp->set('chkdgt', $chkdgt);
        $this->sessiontemp->set('rep_name', $filename);
        $this->sessiontemp->set('email', $email);
        $this->MailPlan_by_camp($dist, $campaign);
        $data['orderdata'] = $Listorderproduct;
        $this->load->view('formorder', $data);
    }

    // ทำการดึงรายการสั่งชื้อสินค้าขึ้นมาทำการตรวจสอบก่อน 
    public function GETORDERDETAIL($campaign, $order_no, $dist, $mslno, $chkdgt, $Table) {
       //  echo $campaign . '|' . $order_no . '|' . $dist . '|' . $mslno . '|' . $chkdgt . '|' . $Table;
        $this->db->trans_start();
        $this->db->select(" * ");
        $this->db->from($Table);
        $this->db->where("DIST", $dist);
        $this->db->where("mslno", $mslno);
        $this->db->where("chkdgt", $chkdgt);
        $this->db->where("ordcamp", $campaign);
        $this->db->where("ORDER_NO", $order_no);
        $this->db->where("DWNFLAG", 'N');
        $this->db->where("DELFLAG", 'N');
        $rsdetail = $this->db->get();
        $this->db->trans_complete();
        if ($rsdetail->num_rows() > 0) {
        //    echo num_rows() ;
            return $rsdetail;
        } else {
            return null;
        }
    }
	
		
public function DeleteByItem($dist,$mslno,$chkdgt, $campaign,$order_no, $rep_name, $email)
{
////////////////////////////////////////////////////////////////////////////////////////Send mail  delete by item ////////////////////////////////////////////////////////////////////////////////////////////////////////

                $this->db->select(" * ");
                $this->db->from("order_detail");
                $this->db->where("DIST", $dist);
                $this->db->where("mslno", $mslno);
                $this->db->where("chkdgt", $chkdgt);
                $this->db->where("ordcamp", $campaign);
                $this->db->where("ORDER_NO", $order_no);
                $this->db->where("dwnflag", 'N');
                $this->db->where("delflag", 'N');
                $rsdetail = $this->db->get(); 
		   $sql_stament = $this->db->last_query();	
			$tot_amt	= 0;$msg=" ";	   
                if ($rsdetail->num_rows() > 0)
                {
                            $data['rstemp'] = $rsdetail->result_array();
                            $i = 0;                
                            foreach ($data['rstemp']as $rowdetail) 
                            {  
		
                                $i = $i + 1;
                                $msg .= '<tr>';
                                $msg .= '<td align="center">' . $i . '</td>';
                                $msg .= '<td align="center">' . $rowdetail['BILLCODE'] . '</td>';
                                $msg .= '<td>' . $rowdetail['BILLDESC'] . '</td>';
                                $msg .= '<td align="right">' . $rowdetail['QTY'] . '</td>';
                                $msg .= '<td align="right">' . $rowdetail['PRICE'] . '</td>';
                                $msg .= '<td align="right">' . $rowdetail['AMOUNT'] . '</td>';
                                $msg .= '</tr>';  
                                $tot_amt=$rowdetail['AMOUNT'] + $tot_amt;
					$divisionname = $this->sessiontemp->get('rep_name');
					$Email = $this->sessiontemp->get('email');
					$str_rep_code = $dist . '-' . $mslno . '-' . $chkdgt;
				
					//$str_dwn_date = $DwnDate;
					/*********************** call web service log order *****************/
								$bill_code=$rowdetail['BILLCODE'] ;
								$order_no=$rowdetail['ORDER_NO'] ;
								$campaign=$rowdetail['ORDCAMP'] ;	
								$current_date=$rowdetail['ORDDATE'] ;
								$current_time=$rowdetail['ORDTIME'] ;
								$dist=$rowdetail['DIST'] ;
								$mslno=$rowdetail['MSLNO'] ;
								$chkdgt=$rowdetail['CHKDGT'] ;
								$bill_qty=$rowdetail['QTY'] ;
								$bill_price=$rowdetail['PRICE'] ;
								
								       $Date = date('Ymd');
									 $time = date('His')."|".$rowdetail['LISTNO'] ;
									 $client = new soapclient('http://10.0.0.119/bworder/WriteLog.php'); 
								       $param_Detail=$bill_code."|".$order_no."|".$campaign."|".$current_date."|".$current_time."|".$dist."|".$mslno."|".$chkdgt."|".$bill_qty."|".$bill_price."|0"."|0"."|U"."|".$Date."|".$time;
									 $param_D = array( 'your_name' =>  $param_Detail); 

									$response = $client->call('WriteData',$param_D); 
									//var_dump($param_D);
									//Process result 
									if($client->fault) 
									{ 
										echo "FAULT: <p>Code: (".$client->faultcode."</p>"; 
										echo "String: ".$client->faultstring; 
									} 
									else 
									{ 
										echo $response; 
									} 
							
								
                            } 
							
								
					       $order_date = $this->sessiontemp->get('order_date');
						$order_time = $this->sessiontemp->get('order_time');
						$strdwndate = $this->sessiontemp->get('DwnDate');
						 $str_dwn_date = $strdwndate;
						 $strcurrentdate = date('Ymd');
						$strcurrenttime = date('His');
///////////////////////////////////////////////////////////////////////////////////////  HTML  Send mail  delete by item ////////////////////////////////////////////////////////////////////////////////////////////////////////	
						$str_rep_code = $dist.'-'.substr('0000'.$mslno,-5).'-'.$chkdgt;
						$msg_header = "";
        $msg_header .="<font style='font-family:Tahoma, Geneva, sans-serif;font-size:12 ;color:#252525'>";
        $msg_header .= "เรียน สมาชิกเขต $dist  คุณ $divisionname  <br />";
        $msg_header .=" รหัสสมาชิก  $str_rep_code<br />";
        $msg_header .="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ทางบริษัทฯ ขอขอบคุณที่ท่านได้สั่งซื้อสินค้าผ่านทางเว็บไซต์ http://www.bworder.com ";
        $msg_header .="ในรอบ_จำหน่ายที่  $campaign<br />";
        $msg_header .= "วันที่สั่งซื้อผลิตภัณฑ์  $strcurrentdate  เวลา  $strcurrenttime <br />";
        $msg_header .= "วันที่ดาวน์โหลดข้อมูล  $strdwndate  ";
        $msg_header .="</font>";
        $MailMessage = "";
        $MailMessage .=$msg_header;
        $MailMessage .='<table width=560 border=0 cellspacing=0 cellpadding=0 ';
        $MailMessage .='style="font-family:Tahoma, Geneva, sans-serif;font-size:12 ;color:#252525">';
        $MailMessage .= '<tr>';
        $MailMessage .= '<td height=23 width="44" style="border-bottom:dotted #5F5F5F 1px;border-top:dotted #5F5F5F 1px">ลำดับ</td>';
        $MailMessage .= '<td  height=23 width="71" style="border-bottom:dotted #5F5F5F 1px;border-top:dotted #5F5F5F 1px">รหัสสินค้า</td>';
        $MailMessage .= '<td height=23  width="362" style="border-bottom:dotted #5F5F5F 1px;border-top:dotted #5F5F5F 1px">ชื่อสินค้า/รายละเอียด</td>';
        $MailMessage .= ' <td  height=23 width="83"  align="right" style="border-bottom:dotted #5F5F5F 1px;border-top:dotted #5F5F5F 1px">จำนวนสั่งซื้อ</td>';
        $MailMessage .= ' <td  height=23 width="85"  align="right" style="border-bottom:dotted #5F5F5F 1px;border-top:dotted #5F5F5F 1px">ราคา/หน่วย</td>';
        $MailMessage .= '<td  height=23 width="85"  align="right" style="border-bottom:dotted #5F5F5F 1px;border-top:dotted #5F5F5F 1px">ราคารวม</td>';
        $MailMessage .='</tr>';
        $MailMessage .=$msg;
        $MailMessage .= "<tr>";
        $MailMessage .= '<td height=23 width="44" style="border-bottom:dotted #5F5F5F 1px;border-top:dotted #5F5F5F 1px">&nbsp;</td>';
        $MailMessage .= '<td  height=23 width="71" style="border-bottom:dotted #5F5F5F 1px;border-top:dotted #5F5F5F 1px">&nbsp;มูลค่ารวม</td>';
        $MailMessage .= '<td height=23  width="362" style="border-bottom:dotted #5F5F5F 1px;border-top:dotted #5F5F5F 1px">&nbsp;</td>';
        $MailMessage .= '<td  height=23 width="83" align="right" style="border-bottom:dotted #5F5F5F 1px;border-top:dotted #5F5F5F 1px">&nbsp;</td>';
        $MailMessage .= '<td  height=23 width="85"  align="right" style="border-bottom:dotted #5F5F5F 1px;border-top:dotted #5F5F5F 1px">&nbsp;</td>';
        $MailMessage .= '<td  height=23 width="85"  align="right" style="border-bottom:dotted #5F5F5F 1px;border-top:dotted #5F5F5F 1px">&nbsp;';
        $MailMessage .= $tot_amt . '</td>';
        $MailMessage .="</tr>";
        $MailMessage .="</table>";

        $MailMessage .='<font style="font-family:Tahoma, Geneva, sans-serif;font-size:12 ;color:#252525">';
        $MailMessage .= '<br><br><b>หมายเหตุ : </b> <br />';
	 $MailMessage .= '1. ท่านสมาชิกสามารถตรวจสอบแก้ไขเพิ่มเติมรายการสั่งซื้อของตนภายในวันที่ ' . $strdwndate . ' เวลา 10:00 น. <br />';
	 $MailMessage .= '2. รายการทั้งหมดยังไม่ได้ตรวจสอบเงื่อนไขการขาย/รายการสินค้าขาดสต๊อก และยอดเงินยังไม่ได้หักส่วนลด สมาชิกจะได้รับสินค้าครบตามรายการที่สั่งซื้อเมื่อสั่งสินค้าครบตามเงื่อนไข <br />';
	 $MailMessage .= '3. อีเมลล์ฉบับนี้เป็นการแจ้งข้อมูลอัตโนมัติ กรุณาอย่าตอบกลับ<br />';
	 $MailMessage .='หากต้องการสอบถามรายละเอียดเพิ่มเติมกรุณา ติดต่อผ่านทาง Call Center โทร  02-118-5111  <br />';
        $MailMessage .='วันจันทร์-ศุกร์ เวลา 8.00-24.00 น.    วันเสาร์-อาทิตย์ เวลา 8.00-17.30 น. <br /></font>';
		
	
	 $MailSubject = "(Bworder)แก้ไขสั่งซื้อสินค้าทางอินเตอร์เน็ต http://www.bworder.com";
///////////////////////////////////////////////////////////////////////////////////////  HTML  Send mail  delete by item ////////////////////////////////////////////////////////////////////////////////////////////////////////			
										   

             
	         $email = $this->sessiontemp->get('email');
		   if($email== '') {
				$email  = 'bwdsmorder@gmail.com';
			}
		require_once('class.phpmailer.php');
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->CharSet="UTF-8";
		$mail->SMTPSecure = 'tls';
		$mail->Host = 'mailcorp.truemail.co.th';
		$mail->Port = 25;
		//$mail->Username = 'mistineinfo@mistine.co.th';
		//$mail->Password = '1234';
		$mail->SMTPAuth = true;

		$mail_date = $strcurrentdate;
		$mail_time = $strcurrenttime;
		$mail_type = 'bw_delete';
		$currentCamp = $campaign;
		//$MailSubject = "TEST_WWWแก้ไขสั่งซื้อสินค้าทางอินเตอร์เน็ต http://www.bworder.comddddd|||||".$email ;
		//$MailMessage = "TEST_WWWแก้ไขสั่งซื้อสินค้าทางอินเตอร์เน็ต http://www.bworder.com(9999999999999999999999999";
		//$mail_user = 'bworder-01@mistine.co.th';
		$mail_user = $this->mail_log($mail_date, $mail_time, $mail_type, $dist, $mslno, $chkdgt, $campaign, $currentCamp, 0, 0, 0, $MailMessage,$email);
		$mail->Username = $mail_user;
		$mail->Password = 'sd1234';
		$mail->From = $mail_user ;
		$mail->FromName = 'BWORDER.COM';
		$mail->AddAddress($email);         
		$mail->AddBCC('bwdsmmistine@gmail.com');
		$mail->IsHTML(true);
		$mail->Subject = $MailSubject;
		$mail->Body    = $MailMessage ;
		
		if(!$mail->Send())
		{				 
				return TRUE;
		}
		else
		{				 
				return TRUE;
		}

		return TRUE;
	
	}
//////////////////////////////////////////////////////////////////////////////  Case user chick list order and cick button some /////////////////////////////////////////////////////
	else
	{

///////////////////////////////////////////////////////////////////////////////////////////////////////////    Into call  Function All //////////////////////////////////////////////////////////////////////////////////////////////////
          $filename = $this->sessiontemp->get('rep_name');	
		$str_rep_code = $dist.'-'.substr('0000'.$mslno,-5).'-'.$chkdgt;
		$str_current_date = date("Ymd");
		$str_current_time = date("H:i:s");
	     
		 //$this->SendemailDelete($dist, $email, $filename, $rep_name, $str_rep_code, $campaign, $str_current_date, $str_current_time);
            
		$this->SendemailDelete($campaign, $order_no, $dist, $mslno, $chkdgt, $rep_name, $email, $filename, $msg, $tot_amt, $str_current_date, $str_current_time);
	}
		
}

    public function MailPlan_by_camp($dist, $campaign) {
        ///   นำรอบจำหน่าย และเขต เพื่อหา  วันที่  Bill Date,ShipDate,วันที่จัดส่งสินค้า,และวันที่ download
        $bill_date = "";
        $ship_date = "";
        $dlv_date = "";
        $dwn_date = "";
        $bill_date1 = 0;
        $ship_date1 = 0;
        $dlv_date1 = 0;
        $bill_date2 = 0;
        $ship_date2 = 0;
        $dlv_date2 = 0;
        $query_campaign = "SELECT CAMP FROM TBL008 WHERE STATUS IN ('Current') ORDER BY CAMP ASC  LIMIT 1";
        //echo $query_campaign.'      ';
        // $rs ตัวที่ทำการ Return Data  
        $rs = $this->db->query($query_campaign);
        // ทำการเอา Data มาทำการเก็บข้อมูลส่วนนี้ก่อน 
        if ($rs->num_rows() != 0) {
            // $row_tblcampaign = $rs->row_array();
            $row_tblcampaign = $rs->row_array();
            $currentCamp = $row_tblcampaign['CAMP'];
        } else {
            $currentCamp = '';
        }
        $wrkDate = date('Ymd');
        $query = "sELECT * FROM TBL015 WHERE DIST = '$dist' AND SHIPDATE   >=   $wrkDate Order by CAMP  ASC  LIMIT 1";
        //echo $query.'      ';
        $rs = $this->db->query($query);
        if ($rs->num_rows() == 0) {
            $query_campaign = "SELECT CAMP FROM TBL008 WHERE STATUS IN ('Current') ORDER BY CAMP ASC  LIMIT 1";
            $rs = $this->db->query($query_campaign);
            if ($rs->num_rows() != 0) {
                //$row_tblcampaign = $rs->row_array();
                $row_tblcampaign = $rs->row_array();
                $currentCamp_by_ship = $row_tblcampaign['CAMP'];
            }
        } else {
            $row_mailplan1 = $rs->row_array();
            $currentCamp_by_ship = $row_mailplan1['CAMP'];
        }

        if (intval($campaign) == intval($currentCamp_by_ship)) {
            $order_type = "Current";
            //echo "xxx current xxxx";
        } elseif (intval($campaign) < intval($currentCamp_by_ship)) {
            $order_type = "Late";
            //echo "xxxxxlatexxxxxx" ;
        } elseif (intval($campaign) > intval($currentCamp_by_ship)) {
            $order_type = "Advance";
            //echo "xxx Advance xxx";
        }
        $this->sessiontemp->set('order_type', $order_type);
        //
        $this->db->trans_start();
        $query = "select  * FROM TBL015 WHERE DIST = '$dist' AND CAMP =$campaign   ORDER BY  CAMP  ASC ,BILLDATE ASC LIMIT 2";
       // echo $query;
        $rs = $this->db->query($query);
        $this->db->trans_complete();
        if ($rs->num_rows() == 0) {
            // echo 'AA';  
            $ordercamp = $currentCamp;
        } else {
            // echo 'BB';  
            //  $row_mailplan  = $rs->row_array();     
            $row_mailplan = $rs->row_array();
            $bill_date1 = $row_mailplan['BILLDATE'];
            $ship_date1 = $row_mailplan['SHIPDATE'];
            $dlv_date1 = $row_mailplan['DLVDATE'];
            $dwn_date = $row_mailplan['BILLDATE'];
            if ($rs->num_rows() == 1) {
                $bill_date = $row_mailplan['BILLDATE'];
                $ship_date = $row_mailplan['SHIPDATE'];
                $dlv_date = $row_mailplan['DLVDATE'];
                $dwn_date = $row_mailplan['BILLDATE'];
            } else if ($rs->num_rows() > 1) {
                // ทำการ GET Row ที่เป็นตัวแรกออกมาก่อน
                $row_mailplan = $query->row_array();
                $bill_date2 = $row_mailplan['BILLDATE'];
                $ship_date2 = $row_mailplan['SHIPDATE'];
                $dlv_date2 = $row_mailplan['DLVDATE'];
            } else {
                $bill_date2 = 0;
                $ship_date2 = 0;
                $dlv_date2 = 0;
            }
        }



        $c_camp = 26;
        $cur_camp_year = substr($campaign, 0, 4);
        $cur_camp_no = substr($campaign, -2);
        $next_y = 0;
        $next_no = 0;
        $last_no = 0;
        $last_year = 0;
        //Calulate Next Campaign
        if (intval($cur_camp_no) == intval($c_camp)) {
            $next_no = 1;
            $next_y = intval($cur_camp_year) + 1;
        } else {
            $next_no = intval($cur_camp_no) + 1;
            $next_y = $cur_camp_year;
        }
        $nextCamp = (string) $next_y . "" . substr("00" . (string) $next_no, -2);
        //Calculate Last Campaign 
        if (intval($cur_camp_no) == 1) {
            $last_no = $c_camp;
            $last_year = intval($cur_camp_year) - 1;
        } else {
            $last_no = intval($cur_camp_no) - 1;
            $last_year = $cur_camp_year;
        }
        $lastCamp = $last_year . substr("00" . $last_no, -2);
        $this->sessiontemp->set('lastCamp', $lastCamp);
        if ($order_type == "Late") {
           
            $this->db->trans_start();
            $query = " select  * FROM TBL015 WHERE DIST = '$dist' AND SHIPDATE >  '$dlv_date' Order by CAMP  ASC  LIMIT 1";
            //   echo $query.'      ';
            $rs = $this->db->query($query);
            $this->db->trans_complete();

            if ($rs->num_rows() == 0) {
                $row_mailplan2 = $rs->row_array();
                $dlv_date = $row_mailplan2['DLVDATE'];
            }
        }
        ////
        // วันที่ Download
        if (intval($bill_date) <= intval(date('Ymd'))) {
            if (date("l", strtotime("+1 day")) == "Saturday") {
                $date = date("Ymd", strtotime("+3 day"));
            } else if (date("l", strtotime("+1 day")) == "Sunday") {
                $date = date("Ymd", strtotime("+2 day"));
            } else {
                $date = date("Ymd", strtotime("+1 day"));
            }
            //$order_type="Late";	
            $dwn_date = $date;
        } else {
            $dwn_date = $bill_date;
        }
        // End Of Order
        $fmt_date = substr($dwn_date, 0, 4) . '-' . substr($dwn_date, 4, 2) . '-' . substr($dwn_date, 6, 2);
        $adate = date($fmt_date);
        $end_of_order = date("Ymd", strtotime("-1 days", strtotime($adate)));

        $this->sessiontemp->set('curcamp', $currentCamp);
        $this->sessiontemp->set('nextCamp', $nextCamp);
        $this->sessiontemp->set('end_of_order', $end_of_order);
        $this->sessiontemp->set('dlv_date', $dlv_date);
    }

    // ทำการ ตรวจสอบการหลุดของ Session
    public function CheckSession() {
        $login = $_SESSION['login'];
        if ($login != 1) {
            echo "9";
        } else {
            echo "1";
        }
    }

    //กรณีที่ทำการ DELETE ข้อมูลในส่วน
    public function DELETEDATA($order_no, $campaign, $dist, $mslnox, $chkdgt, $billcode, $list, $listall, $Flag, $strcurrentdate, $strcurrenttime) {
       

 	    //   require_once('nusoap.php');
		//Give it value at parameter 
		//Create object that referer a web services 
	 $client = new soapclient('http://10.0.0.119/bworder/WriteLog.php'); 
	 $mslno = (int) $mslnox;
       $i_item = $listall - $list;  // ทำการ UPDATE ITEM ที่เหลือจริง 
        if ($Flag == 'A') {
            if ($order_no != 0) {
                $datadetail = array(
                    'DELFLAG' => 'Y'
                );
                $dataitem = array(
                    'ITEMS' => $i_item
                );                           
                                                 
                if ($list == $listall) 
                   {
                    // ทำการลบ HEADER
                       $dataheader = array(
                        'DELFLAG' => 'Y',
						'UPDDATE' => $strcurrentdate,
						'UPDTIME' => $strcurrenttime
                       );
					   
                                try
                                {
                                    $this->db->trans_begin();      
                                    $this->db->where("DIST", $dist);
                                    $this->db->where("mslno", $mslno);
                                    $this->db->where("chkdgt", $chkdgt);
                                    $this->db->where("ordcamp", $campaign);
                                    $this->db->where("ORDER_NO", $order_no);
                                    $this->db->update('Order_Header', $dataheader);
		

                                    // กรณีที่เป็น DETAIL ตัวจริง
                                    $this->db->where("DIST", $dist);
                                    $this->db->where("mslno", $mslno);
                                    $this->db->where("chkdgt", $chkdgt);
                                    $this->db->where("ordcamp", $campaign);
                                    $this->db->where("ORDER_NO", $order_no);
                                    $this->db->update('ORDER_DETAIL', $datadetail);
                                 $this->db->trans_start();
		

	/*88888888888888888888888888888888 Call  Web Servic  88888888888888888888888888888888888888888*/						
			      $this->db->select(" * ");
				$this->db->from("ORDER_DETAIL");
				$this->db->where("DIST", $dist);
				$this->db->where("mslno", $mslno);
				$this->db->where("chkdgt", $chkdgt);
				$this->db->where("ordcamp", $campaign);
				$this->db->where("ORDER_NO", $order_no);
				$this->db->where("DELFLAG",'Y' );	
				$rshd1 = $this->db->get();
				$this->db->trans_complete();
						
				$time=date('His');
				$Date = date('Ymd');
			       $DELFLAG = "DELALL";				
				$param_Detail="0|".$order_no."|".$campaign."|".$strcurrentdate."|".$strcurrenttime."|".$dist."|".$mslno."|".$chkdgt."|0"."|0"."|0"."|"."|0".$DELFLAG."|".$Date."|".$time;
				$param_D = array( 'your_name' =>  $param_Detail); 
				$response1 = $client->call('WriteData',$param_D); 
				if($client->fault) 
				{ 
					echo "FAULT: <p>Code: (".$client->faultcode."</p>"; 
					echo "String: ".$client->faultstring; 
				} 
				else 
				{ 
					echo $response1; 
				} 

/*888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888*/		
				$Checkbirthdate  = 0;                                        
				$query_birthdate = "Select  birthdate   From mslmst  where  dist  = '$dist'  and mslno  = '$mslno' and  chkdgt = '$chkdgt' ";
				$rshbd1 = $this->db->query($query_birthdate);
				if ($rshbd1->num_rows() != 0) 
                                                            {
                                                                    $row_tbl014 = $rshbd1->row_array();    

                                                                            // กรณีทำการเปรียบเทียบการ SET ข้อมูล 
                                                                            $dateTemp =    $row_tbl014['birthdate'];      
                                                                            $birthdate1= substr($dateTemp, 4, 4);
                                                                            $wrkDate = date('Ymd');
                                                                            $birthdate2= substr($wrkDate, 4, 4);
                                                                            if($birthdate1  == $birthdate2)
                                                                            {
                                                                                $Checkbirthdate = 1;
                                                                            }                                            
                                                                            // กรณีที่ทำการตรวจสอบแล้วพบว่าเป็นวันเกิด
                                                                            if($Checkbirthdate == 1)
                                                                            {
                                                                                        $Mslmsttemp = array(
                                                                                        'BIRTHDATETEMP' => 0,
                                                                                        'SHOWPOP' => 0
                                                                                        );                                                                
                                                                                        $this->db->where("DIST", $dist);
                                                                                        $this->db->where("mslno", $mslno);
                                                                                        $this->db->where("chkdgt", $chkdgt);                                                          
                                                                                        $this->db->update('mslmst', $Mslmsttemp);     
                                                                            }
                                                            }
                                      //  }
                      
                      
                                    
                                    if ($this->db->trans_status() === FALSE)
                                    {     
                                        $this->db->trans_rollback();          
                                        return 0;
                                    }
                                    else 
                                    {                                   
                                        $this->db->trans_commit();       
                                        //ทำการเก็บ FLAG ไว้ กรณีที่ทำการ  
                                        $this->sessiontemp->set('DELETEALL', 'ํY');
                                        //ให้ทำการส่ง  Mail กรณีที่ทำการ  Delete ข้อมูลทังหมด 
                                        $campaign = $campaign;
                                        $po = $order_no;
                                        $dist = $dist;
                                        $mslno = $mslno;
                                        $chkdgt = $chkdgt;
                                        $rep_name = $this->sessiontemp->get('rep_name');
                                        $email = $this->sessiontemp->get('email');
                                        $filename = $this->sessiontemp->get('rep_name');
										
										
						
	/*88888888888888888888888888888888 Call  Web Servic  88888888888888888888888888888888888888888*/						
			 $this->db->select(" * ");
				$this->db->from("ORDER_DETAIL");
				$this->db->where("DIST", $dist);
				$this->db->where("mslno", $mslno);
				$this->db->where("chkdgt", $chkdgt);
				$this->db->where("ordcamp", $campaign);
				$this->db->where("ORDER_NO", $order_no);
				$this->db->where("DELFLAG",'Y' );	
				$rshd1 = $this->db->get();
				$this->db->trans_complete();
				$time=date('His');
				$Date = date('Ymd');
										
				foreach ($rshd1->result_array() as $row_order)
				{
						$bill_code = $row_order['BILLCODE'];
						$dist = $row_order['DIST'];
						$mslno = $row_order['MSLNO'];
						$chkdgt = $row_order['CHKDGT'];
						$campaign = $row_order['ORDCAMP'];
						$order_no = $row_order['ORDER_NO'];
						$dwnflag = $row_order['dwnflag'];
						$current_date = $row_order['ORDDATE'];
						$current_time = $row_order['ORDTIME'];
						$DwnDate = $row_order['DWNDATE'];
						$rep_namesend = $row_order['NAME'];
						$str_dwn_date = $row_order['DWNDATE'];
						$DELFLAG = "DELALL_".$row_order['DELFLAG'];				
					    $param_Detail=$bill_code."|".$order_no."|".$campaign."|".$current_date."|".$current_time."|".$dist."|".$mslno."|".$chkdgt."|0"."|0"."|0"."|".$rep_seq."|".$DELFLAG."|".$Date."|".$time;
										 $param_D = array( 'your_name' =>  $param_Detail); 
											
										$response1 = $client->call('WriteData',$param_D); 
										//Process result 
										//Process result 
										if($client->fault) 
										{ 
											echo "FAULT: <p>Code: (".$client->faultcode."</p>"; 
											echo "String: ".$client->faultstring; 
										} 
										else 
										{ 
											echo $response1; 
										} 
										
	}
		
										$msg = '';
										$amount	= 0;
										$this->SendemailDelete($campaign, $po, $dist, $mslno, $chkdgt, $rep_name, $email, $filename, $msg, $amount, $strcurrentdate, $strcurrenttime);
										$this->sessiontemp->set('Pass', 'Y');  
										//if ($dist <> '0999') { 
										echo "<meta http-equiv='refresh' content='0;URL=../../../index.php'>";
										//}
                                    }         
                                  
                                }
                                catch (Exception $e)                      
                                {                 
                                            echo $e->getError();
                                            return 0;
                                }    
                   }     
                   else
                   {
                    // กรณีที่ทำการ  DELETE ทีละแถว 
                        try
                    {
                                        $this->db->trans_begin();     
                                        
                                        $this->db->where("DIST", $dist);
                                        $this->db->where("mslno", $mslno);
                                        $this->db->where("chkdgt", $chkdgt);
                                        $this->db->where("ordcamp", $campaign);
                                        $this->db->where("ORDER_NO", $order_no);
                                        $this->db->update('Order_Header', $dataitem);

                                        $this->db->where("DIST", $dist);
                                        $this->db->where("mslno", $mslno);
                                        $this->db->where("chkdgt", $chkdgt);
                                        $this->db->where("ordcamp", $campaign);
                                        $this->db->where("ORDER_NO", $order_no);
                                        $this->db->where("BILLCODE", $billcode);
                                        $this->db->update('ORDER_DETAIL', $datadetail);
                                        $this->sessiontemp->set('DELETEALL', 'ํN');
                                        if ($this->db->trans_status() === FALSE)
                                        {    
                                            $this->db->trans_rollback();           
                                            return 0;
                                        }
                                        else 
                                        {                                   
                                                $this->db->trans_commit();               
                                        }                      
                                }
                                catch (Exception $e)                      
                                {                                                 
                                               echo $e->getError();                                            
                                }                         
                   }
            }
            else 
            {                              
                if ($list == $listall) 
                {
                    $this->sessiontemp->set('Pass', 'Y');
                    echo "<meta http-equiv='refresh' content='0;URL=../../../index.php'>";
                }
            }
        } else if ($Flag == 'B') {
            // กรณีที่ทำการลบรายการทั้งหมด  
            $dataheader = array(
                'DELFLAG' => 'Y',
				'UPDDATE' => $strcurrentdate,
				'UPDTIME' => $strcurrenttime
            );
          
            try
            {
                     $this->db->trans_begin();           
                     
                    $this->db->where("DIST", $dist);
                    $this->db->where("mslno", $mslno);
                    $this->db->where("chkdgt", $chkdgt);
                    $this->db->where("ordcamp", $campaign);
                    $this->db->where("ORDER_NO", $order_no);
                    $this->db->update('Order_Header', $dataheader);

                    $this->db->where("DIST", $dist);
                    $this->db->where("mslno", $mslno);
                    $this->db->where("chkdgt", $chkdgt);
                    $this->db->where("ordcamp", $campaign);
                    $this->db->where("ORDER_NO", $order_no);
                    $this->db->update('ORDER_DETAIL', $dataheader);
                    
                
				
					
					
                    // ทำการตรวจสอบด้วยว่าเป็นวันเกิดหรือไม่ 
                    //  if($dist == '0999')
                    //  { 
                                    $Checkbirthdate  = 0;                                        
                                    $query_birthdate = "Select  birthdate   From mslmst  where  dist  = '$dist'  and mslno  = '$mslno' and  chkdgt = '$chkdgt' ";
                                    $rshbd1 = $this->db->query($query_birthdate);
                                     if ($rshbd1->num_rows() != 0) 
                                        {
                                                $row_tbl014 = $rshbd1->row_array();    
                                              
                                                        // กรณีทำการเปรียบเทียบการ SET ข้อมูล 
                                                        $dateTemp =    $row_tbl014['birthdate'];      
                                                        $birthdate1= substr($dateTemp, 4, 4);
                                                        $wrkDate = date('Ymd');
                                                        $birthdate2= substr($wrkDate, 4, 4);
                                                        if($birthdate1  == $birthdate2)
                                                        {
                                                            $Checkbirthdate = 1;
                                                        }                                            
                                                        // กรณีที่ทำการตรวจสอบแล้วพบว่าเป็นวันเกิด
                                                        if($Checkbirthdate == 1)
                                                        {
                                                                    $Mslmsttemp = array(
                                                                    'BIRTHDATETEMP' => 0,
                                                                    'SHOWPOP' => 0
                                                                    );                                                                
                                                                    $this->db->where("DIST", $dist);
                                                                    $this->db->where("mslno", $mslno);
                                                                    $this->db->where("chkdgt", $chkdgt);                                                          
                                                                    $this->db->update('mslmst', $Mslmsttemp);     
                                                        }
                                        }
                      //}
                    
                    // กรณีที่เป็น DETAIL ตัวที่ทำการทดสอบ 
                    if ($this->db->trans_status() === FALSE)
                    {                                         
                    //    echo "<script type=\"text/javascript\">alert('พบข้อผิดพลาดในการเชื่อมต่อฐานข้อมูล ไม่สามารถลบข้อมูลได้ กดปุ่ม OK ระบบจะกลับไปที่หน้าจอเมนู เพื่อลองใหม่อีกครั้ง') </script>";      
                   //     $this->sessiontemp->set('Pass', 'Y');  
                   //     echo "<meta http-equiv='refresh' content='0;URL=../../../index.php'>";
                        $this->db->trans_rollback();              
                        return 0;
                    }
                    else 
                    {                                   
                            $this->db->trans_commit();      
                            $po = $order_no;
                            $dist = $dist;
                            $mslno = $mslno;
                            $chkdgt = $chkdgt;
                            $rep_name = $this->sessiontemp->get('rep_name');
                            $email = $this->sessiontemp->get('email');
                            $filename = $this->sessiontemp->get('rep_name');                    
                            $this->sessiontemp->set('Pass', 'Y');                           
                            echo "<meta http-equiv='refresh' content='0;URL=../../../index.php'>";
                    }                  
            }
            catch (Exception $e)                      
            {                 
                    echo $e->getError();
                    return 0;
            }    
            // echo '$001campaign : '.$campaign.' $po: '.$po.' $dist: '.$dist.' $mslno: '.$mslno.' $chkdgt: '.$chkdgt.' $rep_name: '.$rep_name.' $email: '.$email.' $filename: '.$filename;
            return 1;
        }
    }

    public function SendemailDelete($campaign, $po, $dist, $mslno, $chkdgt, $rep_name, $to, $filename, $msg, $amount, $strcurrentdate, $strcurrenttime) {
		$mslno = substr('0000'.$mslno,-5);
		$str_rep_code = $dist . '-' . $mslno . '-' . $chkdgt;
		$MailMessage = "";
		$msg_header = "";
		$msg_header .="<font style='font-family:Tahoma, Geneva, sans-serif;font-size:12 ;color:#252525'>";
		$msg_header .= "เรียน สมาชิกเขต $dist  คุณ $filename<br />";
		$msg_header .="ท่านได้ทำการลบรายการสั่งชื้อ รหัสสมาชิก  $str_rep_code<br />";
		$msg_header .="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ทางบริษัทฯ ขอขอบคุณที่ท่านได้ ให้ความสนใจทำรายการผ่านทางเว็บไซต์ http://www.bworder.com ";
		$msg_header .="ในรอบจำหน่ายที่  ".substr($campaign,4,2)."/".substr($campaign,0,4)."<br />";
		$msg_header .="</font>";
		$MailMessage .=$msg_header;
		$MailMessage .='<font style="font-family:Tahoma, Geneva, sans-serif;font-size:12 ;color:#252525">';
		$MailMessage .= '<br><br><b>หมายเหตุ : </b> อีเมลล์ฉบับนี้เป็นการแจ้งข้อมูลอัตโนมัติ กรุณาอย่าตอบกลับ<br />';
		$MailMessage .='หากต้องการสอบถามรายละเอียดเพิ่มเติมกรุณา ติดต่อผ่านทาง Call Center โทร 02-118-5111 <br />';
		$MailMessage .='วันจันทร์-ศุกร์ เวลา 8.00-24.00 น.    วันเสาร์-อาทิตย์ เวลา 8.00-17.30 น. <br /></font>';
		$MailSubject = "ลบข้อมูลสั่งชื้อรหัสสมาชิก  $str_rep_code";

		if ($to == '') {
			$to = 'bwdsmorder@gmail.com';
		}
		require_once('class.phpmailer.php');
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->CharSet="UTF-8";
		$mail->SMTPSecure = 'tls';
		$mail->Host = 'mailcorp.truemail.co.th';
		$mail->Port = 25;
		//$mail->Username = 'mistineinfo@mistine.co.th';
		//$mail->Password = '1234';
		$mail->SMTPAuth = true;

		$mail_date = $strcurrentdate;
		$mail_time = $strcurrenttime;
		$mail_type = 'bw_delete';
		$currentCamp = $campaign;
		
		//$mail_user = 'bworder-01@mistine.co.th';
		$mail_user = $this->mail_log($mail_date, $mail_time, $mail_type, $dist, $mslno, $chkdgt, $campaign, $currentCamp, 0, 0, 0, $MailMessage, $to);
		$mail->Username = $mail_user;
		$mail->Password = 'sd1234';
		$mail->From = $mail_user;
		$mail->FromName = 'BWORDER.COM';
		$mail->AddAddress($to);         
		$mail->AddBCC('bwdsmmistine@gmail.com');
		$mail->IsHTML(true);
		$mail->Subject = $MailSubject;
		$mail->Body    = $MailMessage ;
		
		if(!$mail->Send())
		{				 
				return TRUE;
		}
		else
		{				 
				return TRUE;
		}

		return TRUE;
    }

    // ส่งEmail ยืนยันการ DELEธฎ
    public function SendemaillistDelete($campaign, $po, $dist, $mslno, $chkdgt, $rep_name, $email, $filename, $msg, $amount) {
        //echo $campaign.'|'.$po.'|'.$dist.'|'.$mslno.'|'.$chkdgt.'|'.$rep_name.'|'.$email.'|'.$filename.'|';
        // กรณีที่ระบบมี PO เข้ามาในระบบ จากนั้นก็ทำการ GET  ข้อมูลออกมาก่อน 
        if ($po <> '') {
            $this->db->trans_start();
            $this->db->select(" * ");
            $this->db->from("Order_Header");
            $this->db->where("DIST", $dist);
            $this->db->where("mslno", $mslno);
            $this->db->where("chkdgt", $chkdgt);
            $this->db->where("ordcamp", $campaign);
            $this->db->where("ORDER_NO", $po);
            $this->db->where("dwnflag", 'N');
            $this->db->where("delflag", 'N');
            $rshd1 = $this->db->get();
            $this->db->trans_complete();
            // ทำการ GET ตาราง MASTER
            if ($rshd1->num_rows() > 0) 
                {
                $row_order = $rshd1->row_array();
                $current_date = $row_order['ORDDATE'];
                $current_time = $row_order['ORDTIME'];
                $DwnDate = $row_order['DWNDATE'];
                $rep_namesend = $row_order['NAME'];
                $current_date = $row_order['ORDDATE'];
                $current_time = $row_order['ORDTIME'];
                $str_dwn_date = $row_order['DWNDATE'];
		   $rep_seq = $row_order['rep_seq'];
                // ทำการส่ง MAIL DELETE กรณีที่ 1
                $str_rep_code = $dist . '-' . $mslno . '-' . $chkdgt;
                $tot_amt = $amount;
                $Flagtemp = 'C';
                $this->send_mail($dist, $email, $filename, $rep_namesend, $str_rep_code, $campaign, $current_date, $current_time, $str_dwn_date, $msg, $tot_amt, $Flagtemp);
         
		 
        
			
			}  
        }
    }

	public function mail_log($mail_date, $mail_time, $mail_type, $dist, $mslno, $chkdgt, $campaign, $currentCamp, $order_no, $items, $amount, $MailMessage, $to) {
		try {	
			if ($order_no=='') { $order_no = 0;}
			if ($items=='')    { $items = 0;} 
			if ($amount=='')   { $amount = 0;}
			$Mail_log = array(	'MAIL_DATE' => $mail_date,		'MAIL_TIME' => $mail_time,		'MAIL_TYPE' => $mail_type,
								'DIST' => $dist,				'MSLNO' => $mslno,				'CHKDGT' => $chkdgt,
								'ORDCAMP' => $campaign,			'CURCAMP' => $currentCamp,		'ORDER_NO' => $order_no,
								'ITEMS' => $items,				'TOTAL_AMOUNT' => $amount,		'MAIL_DETAIL' => $MailMessage,
								'MAIL_SEND' => 'N',				'MAIL_NAME' => $to
								);

			$this->db->insert('mail_log', $Mail_log);                   
			
			$Temp_seq = mysql_insert_id();
			$Temp_seq_num = $Temp_seq%5;
			
			if($Temp_seq_num == 0) {
				$mail_user = 'bworder-05@mistine.co.th';
			}
			else {
				$mail_user = 'bworder-0'.$Temp_seq_num.'@mistine.co.th';
			}
		} catch (Exception $e) {
			$mail_user = 'bworder-01@mistine.co.th';
		}
		return $mail_user;
	}
}

?>
