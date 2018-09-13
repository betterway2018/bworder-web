<%
' FileName="Connection_ado_conn_string.htm"
' Type="ADO" 
' DesigntimeType="ADO"
' HTTP="true"
' Catalog=""
' Schema=""
Dim MM_strConn_STRING
MM_strConn_STRING = Provider=Microsoft.Jet.OLEDB.4.0;Data Source=" & server.MapPath("Data\FridayDbOrder.mdb") &";Persist Security Info=False;
%>
