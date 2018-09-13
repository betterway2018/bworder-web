
  <%
	' Since our software must run on IIS 4.0 and IIS 5.0 we need to make sure the
	' settings are the same.
	Response.Buffer = True
	Response.ExpiresAbsolute
	session.Timeout=60
' -----------------------------------------------------------------------------
' GENERAL SYSTEM MODULES
' -----------------------------------------------------------------------------
	' This file contains predefined ADO constants for VBScript
	%>
	<!--#INCLUDE FILE="../Include/adovbs.inc" -->
	<% 

' -----------------------------------------------------------------------------
' GLOBAL VARIABLE DECLARATION AND SYSTEM INITIALIZATION
' -----------------------------------------------------------------------------
		Dim  strPageTitle
		Dim DBPath 
		Dim Conn
		Dim Sql


		Const  ShowNewProduct=10  'กำหนดจำนวนรายการสินค้าโปรโมชั่น 
				
		Const CataloguePDF = "../catalogue_mistine/"
		Const CatalogueMistine = "../catalogue_mistine/" 
		Const CatalogueFriday = "http://www.friday.co.th/Catalogue/"
		
		Const CataloguePages ="../catalogue_mistine/pages/"
		Const CatalogueDownload="../catalogue_mistine/download/"
		Const DataPathPath="../Data/"
		Const IncludePath="../Include/"		
		
		Const MailServer = "203.146.127.180"
		

	%>



<!--
<SCRIPT language=JavaScript1.2                    
	 src="../Include/butterfly.js" 
 	type=text/JavaScript>
 </SCRIPT>
 
 -->
