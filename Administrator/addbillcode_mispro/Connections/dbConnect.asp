<%

strConnOrders = "Provider=Microsoft.Jet.OLEDB.4.0;Data Source=" & server.MapPath("../Data/MistineOrders.mdb") &";Persist Security Info=False;" 
strConnPromotion = "Provider=Microsoft.Jet.OLEDB.4.0;Data Source=" & server.MapPath("../Data/Promotion.mdb") &";Persist Security Info=False;" 
strConnData = "Provider=Microsoft.Jet.OLEDB.4.0;Data Source=" & server.MapPath("../Data/MistineData.mdb") &";Persist Security Info=False;" 
strConnCounter = "Provider=Microsoft.Jet.OLEDB.4.0;Data Source=" & server.MapPath("../Data/Counter.mdb") &";Persist Security Info=False;" 


Private Function strConnCatalogue (CampaignCode )
	strConnCatalogue = "Provider=Microsoft.Jet.OLEDB.4.0;Data Source=" &  _
									server.MapPath("../Catalogue/" & "Mistine_" &  CampaignCode & "/Data/" & "Catalogue_" &  CampaignCode &".mdb") &";Persist Security Info=False;" 
End Function
%>
