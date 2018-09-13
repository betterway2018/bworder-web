<?php
ini_set("SMTP","61.19.251.167");
if(mail("contact@netdesignhost.com","TEST MAIL FROM PHP SCRIPT","JUST TEST","From: contact@netdesignhost.com"))
echo "Sent";
else echo "Not Sent";
?>