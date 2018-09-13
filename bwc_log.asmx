<%@ WebService Language="VB" Class="Log" %>

Imports System
Imports System.Web
Imports System.Web.Services
Imports System.Xml.Serialization
Imports System.Data

' To allow this Web Service to be called from script, using ASP.NET AJAX, uncomment the following line.
' <System.Web.Script.Services.ScriptService()> _
<WebService(Namespace := "http://tempuri.org/")> _
<WebServiceBinding(ConformsTo:=WsiProfiles.BasicProfile1_1)> _  
Public Class Log
    Inherits System.Web.Services.WebService 

    Public Structure MySqlConnect_Info
        Dim Server As String
        Dim Database As String
        Dim UID As String
        Dim PWD As String
    End Structure
    
  
    Private MySQL_Conn As New System.Data.Odbc.OdbcConnection
    Private MySql_Info As New MySqlConnect_Info
    
    Private Function Connect_Database() As ConnectionState
        'Dim strConn As String = "Provider=Microsoft.Jet.OLEDB.4.0;Data Source=" & Server.MapPath("../Job/Data/job_Test.mdb")
        With MySql_Info
            .Server = "localhost"
            .Database = "bwc_log"
            .UID = "bwc_log"
            .PWD = "bwo1212"
        End With
        
        If MySql_Info.Server = "" Or _
            MySql_Info.Database = "" Or _
            MySql_Info.UID = "" Then
            Return ConnectionState.Closed
        End If
        
        Dim MySqlConnStr As String = "DRIVER={MySQL ODBC 3.51 Driver};SERVER=" & MySql_Info.Server & _
                                     ";UID=" & MySql_Info.UID & ";pwd=" & MySql_Info.PWD & _
                                     ";database=" & MySql_Info.Database & ";option=3306"
        Try
            With MySQL_Conn
                If .State = Data.ConnectionState.Open Then .Close()
                .ConnectionString = MySqlConnStr
                .Open()
            End With
            Return MySQL_Conn.State
        Catch ex As Exception
            Return ConnectionState.Closed
        End Try
    End Function
       
    
    '##############################################################################################
    ' WEB SERVICE EXAMPLE
    ' The HelloWorld() example service returns the string Hello World.
    '##############################################################################################

    
    <WebMethod()> _
    Public Function Query(ByVal DIST As String, ByVal MSLNO As Integer, ByVal CHKDGT As Integer, ByVal DateTime1 As String, ByVal DateTime2 As String) As DataSet
        Dim QueryString As String = ""
        QueryString = "SELECT  ID,DIST,MSLNO,CHKDGT,LOG_DATETIME ,CONCAT(DIST,'-',RIGHT(CONCAT('00000',CAST(MSLNO AS CHAR)),5),'-',CAST(CHKDGT AS CHAR)) REP_CODE ,"
        QueryString = QueryString & " LOG_FUNCTION,LOG_DESCRIPTION FROM  BWC_LOG  "
        QueryString = QueryString & " WHERE LOG_DATETIME BETWEEN '" & DateTime1 & "' AND '" & DateTime2 & "'"
        If DIST <> "" Then
            QueryString = QueryString & " AND DIST ='" & DIST & "'"
        End If
        
        If MSLNO <> 0 Then
            QueryString = QueryString & " AND MSLNO =" & MSLNO
        End If
        
        If CHKDGT <> 0 Then
            QueryString =QueryString & " AND CHKDGT = " & CHKDGT 
        End If
        
        Dim ds As New DataSet
        If Connect_Database() = ConnectionState.Open Then
            If ds.Tables.Contains("bwc_log") Then ds.Tables("bwc_log").Clear()
            Dim da As New Odbc.OdbcDataAdapter(QueryString, MySQL_Conn)
            da.Fill(ds, "bwc_log")
            If MySQL_Conn.State = ConnectionState.Open Then MySQL_Conn.Close()
            Return ds
        Else
            If MySQL_Conn.State = ConnectionState.Open Then MySQL_Conn.Close()
            Return ds
        End If
    End Function

    <WebMethod()> _
    Public Function Download_Log(DateTime1 As String ,DateTime2 As String ) As DataSet
        Dim QueryString As String = ""
        
        QueryString = "Select * from BWC_LOG "
        QueryString = QueryString & " WHERE LOG_DATETIME BETWEEN '" & DateTime1 & "' AND '" & DateTime2 & "'"
        
        Dim ds As New DataSet
        If Connect_Database() = ConnectionState.Open Then
            If ds.Tables.Contains("bwc_log") Then ds.Tables("bwc_log").Clear()
            Dim da As New Odbc.OdbcDataAdapter(QueryString, MySQL_Conn)
            da.Fill(ds, "bwc_log")
            If MySQL_Conn.State = ConnectionState.Open Then MySQL_Conn.Close()
            Return ds
        Else
            If MySQL_Conn.State = ConnectionState.Open Then MySQL_Conn.Close()
            Return ds
        End If
        
    End Function
    
    <WebMethod()> _
    Public Function Delete_Log(DateTime1 As String ,DateTime2 As String ) As String 
        Dim QueryString As String = ""
        QueryString = "DELETE FROM BWC_LOG "
        QueryString = QueryString & " WHERE LOG_DATETIME BETWEEN '" & DateTime1 & "' AND '" & DateTime2 & "'"
        
        Dim cmd As New Odbc.OdbcCommand
        Try
            If Connect_Database() = ConnectionState.Open Then
                cmd = New Odbc.OdbcCommand(QueryString, MySQL_Conn)
                cmd.Prepare()
                '   cmd.Parameters(0).Value = DateTime1
                '  cmd.Parameters(1).Value = DateTime2
                cmd.ExecuteNonQuery()
                If MySQL_Conn.State = ConnectionState.Open Then MySQL_Conn.Close()
            Else
                If MySQL_Conn.State = ConnectionState.Open Then MySQL_Conn.Close()
            End If
            Return ""
        Catch ex As Exception
            Return ex.Message
        End Try

    End Function
    
End Class
