<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Ad. superblack</title>

<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js' type='text/javascript'></script><!---->
<!--<script src='http://gj37765.googlecode.com/svn/bloggerwidget/%5Bwww.gj37765.blogspot.com%5Dmd.js'type='text/javascript'></script>-->
<script language="javascript">
jQuery(document).ready(function() {
function makingdifferent_slider()  {
var mdwh = jQuery(window).height();
var mdpph = jQuery("#mdpopupslider").height();
var mdfromTop = jQuery(window).scrollTop()+50;
 jQuery("#mdpopupslider").css({"top":mdfromTop});
}jQuery(window)
.scroll(makingdifferent_slider)
.resize(makingdifferent_slider)
//alert(jQuery.cookie('sreqshown'));
//var mdww = jQuery(window).width();
//var mdppw = jQuery("#mdpopupslider").width();
//var mdleftm = (mdww-mdppw)/2;
var mdleftm = 0;
//var mdwh = jQuery(window).height();
//var mdpph = jQuery("#mdpopupslider").height();
//var mdfromTop = (jQuery(window).scrollTop()+mdwh-mdpph) / 2; 
jQuery("#mdpopupslider").animate({opacity: "1", left: "0" , left: mdleftm}, 1000).show();        
jQuery("#mdclose").click(function() {
jQuery("#mdpopupslider").animate({opacity: "0", left: "-500"}, 1000).show(); });});
</script>

</head>

<body>
<div id="mdpopupslider" 
style="position:absolute;
width:300px;
height:300px;
background:none;
top:150px;
border:none;
z-index:999;
display:none;
padding:10px;
left:-300px;">
<a href="#" id="mdclose" style="color:#ddd!important;" onclick="return false;"> 
<img src="http://4.bp.blogspot.com/-yN0okpbOdSs/Tz9o5EffWmI/AAAAAAAACok/HI8xTgL-Fho/s1600/%5Bwww.gj37765.blogspot.com%5Dclose.png" align="right"  border = "0"/>
</a>
<img src="ad/superblackorder.gif" width="250" height="300" align="right" />
<!--<iframe src="//www.facebook.com/plugins/likebox.php?href=http://www.facebook.com/pages/PlugublogFan/319685818094326&amp;width=300&amp;height=260&amp;colorscheme=dark&amp;show_faces=true&amp;border_color=%23333333&amp;stream=false&amp;header=false" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:300px; height:260px;" allowtransparency="true"></iframe>-->

<!--<div style=" float:right;  margin-right:35px;margin-top:-10px;  font-size:9px;" ><a href="http://plugublog.blogspot.com/">plugublog</a> / <a href="http://plugublog.blogspot.com/">+Get This!</a></div>-->

<div style=" float:right;  margin-right:35px;margin-top:-10px;  font-size:9px;" ><a href="#"></a> <a href="#"></a></div>
</div>
</body>
</html>
