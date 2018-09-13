/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( FCKConfig )
{
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
FCKConfig.LinkBrowser = true ;
FCKConfig.LinkBrowserURL = FCKConfig.BasePath + 'filemanager/browser/default/browser.html?Connector=connectors/php/connector.php' ;
FCKConfig.LinkBrowserWindowWidth = screen.width * 0.7 ; // 70%
FCKConfig.LinkBrowserWindowHeight = screen.height * 0.7 ; // 70% 
FCKConfig.ImageBrowser = true ;
FCKConfig.ImageBrowserURL = FCKConfig.BasePath + 'filemanager/browser/default/browser.html?Type=Image&Connector=connectors/php/connector.php' ;
FCKConfig.ImageBrowserWindowWidth = screen.width * 0.7 ; // 70% ;
FCKConfig.ImageBrowserWindowHeight = screen.height * 0.7 ; // 70% ;

FCKConfig.FlashBrowser = true ;
FCKConfig.FlashBrowserURL = FCKConfig.BasePath + 'filemanager/browser/default/browser.html?Type=Flash&Connector=connectors/php/connector.php' ;
FCKConfig.FlashBrowserWindowWidth = screen.width * 0.7 ; //70% ;
FCKConfig.FlashBrowserWindowHeight = screen.height * 0.7 ; //70% ;

FCKConfig.LinkUpload = true ;
FCKConfig.LinkUploadURL = FCKConfig.BasePath + 'filemanager/upload/php/upload.php' ;
FCKConfig.LinkUploadAllowedExtensions = "" ; // empty for all
FCKConfig.LinkUploadDeniedExtensions = ".(php|php3|php5|phtml|asp|aspx|ascx|jsp|cfm|cfc|pl|bat|exe|dll|reg|cgi)$" ; // empty for no one

FCKConfig.ImageUpload = true ;
FCKConfig.ImageUploadURL = FCKConfig.BasePath + 'filemanager/upload/php/upload.php?Type=Image' ;
FCKConfig.ImageUploadAllowedExtensions = ".(jpg|gif|jpeg|png)$" ; // empty for all
FCKConfig.ImageUploadDeniedExtensions = "" ; // empty for no one

FCKConfig.FlashUpload = true ;
FCKConfig.FlashUploadURL = FCKConfig.BasePath + 'filemanager/upload/php/upload.php?Type=Flash' ;
FCKConfig.FlashUploadAllowedExtensions = ".(swf|fla)$" ; // empty for all
FCKConfig.FlashUploadDeniedExtensions = "" ;

	
};
