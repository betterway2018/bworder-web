<?php //logout.php
session_start();
session_destroy(); //��ҧ session �ء���
header( 'Location: login.php') ;
//echo "<meta http-equiv='refresh' content='0;URL=login.php'>";
exit;
?>