<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title></title>
 <!-- required files for booklet -->
 <script src="booklet/jquery-1.5.min.js" type="text/javascript"></script>
<script src="booklet/jquery-ui-1.8.9.custom.min.js" type="text/javascript"></script>
<script src="booklet/jquery.easing.1.3.js" type="text/javascript"></script>
<script src="booklet/jquery.booklet.1.2.0.min.js" type="text/javascript"></script>
<link href="booklet/jquery.booklet.1.2.0.css" type="text/css" rel="stylesheet" media="screen, projection, tv" />

<script type="text/javascript"> 
// we will add our javascript code here 
              $(function() {
                  $('#mybook5').booklet({
						closed: true,
						covers: true,
						menu: '#custom-menu',
						arrows:true,
						pageSelector: true,
						chapterSelector: true
					});
								  });

    </script>
  </head>

<body>
<form action="" method="get" target="_blank">
<select name="cars">
  <option value="booklet/cat_far112011/Faris11_01.jpg">Saab 95</option>
  <option value="booklet/cat_far112011/Faris11_02.jpg">Saab 95</option>
  <option value="booklet/cat_far112011/Faris11_03.jpg">Mercedes SLK</option>
  <option value="audi">Audi TT</option>
</select>
<input type="submit" value="Submit" />
</form>
<p>Click the "Submit" button to send input to the server.</p>

               Include Cover Booklet <br />   
               <div id="custom-menu"></div>
					<div id="mybook5"> <br />
						<div class="b-load"><div>
                             <!--<h3>Front Cover</h3>-->           
                             <img  src="booklet/cat_far112011/Faris11_01.jpg" />
                        </div>
                        <div title="This is a page title" > 
                            <img  src="booklet/cat_far112011/Faris11_02.jpg" />
                        </div>
                        <div title="This is another title"> 
                            <img  src="booklet/cat_far112011/Faris11_03.jpg" />
                        </div>
                        <div title="This is another title"> 
                            <img  src="booklet/cat_far112011/Faris11_04.jpg" />
                        </div>
                        <div title="Hooray for titles!"> 
                            <img  src="booklet/cat_far112011/Faris11_05.jpg" />
                        </div>
                        <div title="This is another title"> 
                            <img  src="booklet/cat_far112011/Faris11_06.jpg" />
                        </div>
                         <div title="This is another title">
                            <img  src="booklet/cat_far112011/Faris11_07.jpg" />
                        </div>
                         <div title="This is a page title" >
                            <img  src="booklet/cat_far112011/Faris11_08.jpg" />
                        </div>
                        <div title="This is another title"> 
                            <img  src="booklet/cat_far112011/Faris11_09.jpg" />
                        </div>
                        <div title="This is another title"> 
                            <img  src="booklet/cat_far112011/Faris11_10.jpg" />
                        </div>
                        <div title="This is another title"> 
                            <img  src="booklet/cat_far112011/Faris11_11.jpg" />
                        </div>
                        <div title="This is another title"> 
                            <img  src="booklet/cat_far112011/Faris11_12.jpg" />
                        </div>
                        <div title="This is another title"> 
                            <img  src="booklet/cat_far112011/Faris11_13.jpg" />
                        </div>
                        <div title="This is another title"> 
                           <img  src="booklet/cat_far112011/Faris11_14.jpg" />
                        </div>
                        <div title="This is another title"> 
                         	<img  src="booklet/cat_far112011/Faris11_15.jpg" />
                        </div>
                        <div title="This is another title"> 
                           <img  src="booklet/cat_far112011/Faris11_16.jpg" />
                        </div>
                        <div title="This is another title"> 
                         	<img  src="booklet/cat_far112011/Faris11_17.jpg" />
                        </div>
                        <div title="This is another title"> 
                           <img  src="booklet/cat_far112011/Faris11_18.jpg" />
                        </div>
                        <div title="This is another title"> 
                         	<img  src="booklet/cat_far112011/Faris11_19.jpg" />
                        </div>
                        <div title="This is another title"> 
                         	<img  src="booklet/cat_far112011/Faris11_20.jpg" />
                        </div>
                        <div title="This is another title"> 
                         	<img  src="booklet/cat_far112011/Faris11_21.jpg" />
                        </div>
                        <div title="This is another title"> 
                         	<img  src="booklet/cat_far112011/Faris11_22.jpg" />
                        </div>
                        <div title="This is another title"> 
                         	<img  src="booklet/cat_far112011/Faris11_23.jpg" />
                        </div>
                          <div> 
                           <!-- <h3>Back Cover</h3>--><img  src="booklet/cat_far112011/Faris11_24.jpg" />
                        </div>
                    </div>
                </div>
                <div class="code-wrap">
                <script type="syntaxhighlighter" class="brush: js"><![CDATA[
                    $(function() {
                        $('#mybook5').booklet({
							closed: true,
							covers: true,
							menu: '#custom-menu',
							pageSelector: true,
							chapterSelector: true
						});
                    });
                ]]></script>
                </div>
            </div>  
            <div class="clear"></div>
        </div>    
    </div>

</body>
</html>