<%@ WebService Language="VB" Class="Orders" %>

Imports System
Imports System.Web
Imports System.Web.Services
Imports System.Xml.Serialization
Imports System.Data

' To allow this Web Service to be called from script, using ASP.NET AJAX, uncomment the following line.
' <System.Web.Script.Services.ScriptService()> _
<WebService(Namespace:="http://tempuri.org/")> _
<WebServiceBinding(ConformsTo:=WsiProfiles.BasicProfile1_1)> _  
Public Class Orders
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
            .Database = "bwc_orders"
            .UID = "bwc_orders"
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
    Public Sub Mysql_Database(ByVal Server As String, ByVal Database As String, ByVal UID As String, ByVal PWD As String) 
        With MySql_Info
            .Server = Server
            .Database = Database
            .UID = UID
            .PWD = PWD
        End With
    End sub
    
    <WebMethod()> _
    Public Function Order_Header(ByVal QueryString As String) As DataSet
        If QueryString = "" Then
            QueryString = "Select * from order_header"
        End If
        Dim ds As New DataSet
        If Connect_Database() = ConnectionState.Open Then
            If ds.Tables.Contains("order_header") Then ds.Tables("order_header").Clear()
            Dim da As New Odbc.OdbcDataAdapter(QueryString, MySQL_Conn)
            da.Fill(ds, "order_header")
            If MySQL_Conn.State = ConnectionState.Open Then MySQL_Conn.Close()
            Return ds
        Else
            If MySQL_Conn.State = ConnectionState.Open Then MySQL_Conn.Close()
            Return ds
        End If
    End Function
    
    <WebMethod()> _
    Public Function Order_Detail(ByVal QueryString As String) As DataSet
        If QueryString = "" Then
            Return Nothing
        End If
        Dim ds As New DataSet
        If Connect_Database() = ConnectionState.Open Then
            If ds.Tables.Contains("order_detail") Then ds.Tables("order_detail").Clear()
            Dim da As New Odbc.OdbcDataAdapter(QueryString, MySQL_Conn)
            da.Fill(ds, "order_detail")
            If MySQL_Conn.State = ConnectionState.Open Then MySQL_Conn.Close()
            Return ds
        Else
             If MySQL_Conn.State = ConnectionState.Open Then MySQL_Conn.Close()
            Return ds
        End If
       
    End Function
    
End Class
