<?php
function getSizeFile($url) { 
    if (substr($url,0,4)=='http') { 
        $x = array_change_key_case(get_headers($url, 1),CASE_LOWER); 
        if ( strcasecmp($x[0], 'HTTP/1.1 200 OK') != 0 ) { $x = $x['content-length'][1]; } 
        else { $x = $x['content-length']; } 
    } 
    else { $x = @filesize($url); } 

    return $x; 
} 

function exten_name($filexten) {
	if($filexten=='.txt'){return 'text/plain';}
	if($filexten=='.htm'){return 'text/html';}
	if($filexten=='.html'){return 'text/html';}
	if($filexten=='.php'){return 'text/html';}
	if($filexten=='.css'){return 'text/css';}
	if($filexten=='.js'){return 'application/javascript';}
	if($filexten=='.json'){return 'application/json';}
	if($filexten=='.xml'){return 'application/xml';}
	if($filexten=='.swf'){return 'application/x-shockwave-flash';}
	if($filexten=='.flv'){return 'video/x-flv';}

	// images
	if($filexten=='.png'){return 'image/png';}
	if($filexten=='.jpe'){return 'image/jpeg';}
	if($filexten=='.jpeg'){return 'image/jpeg';}
	if($filexten=='.jpg'){return 'image/jpeg';}
	if($filexten=='.gif'){return 'image/gif';}
	if($filexten=='.bmp'){return 'image/bmp';}
	if($filexten=='.ico'){return 'image/vnd.microsoft.icon';}
	if($filexten=='.tiff'){return 'image/tiff';}
	if($filexten=='.tif'){return 'image/tiff';}
	if($filexten=='.svg'){return 'image/svg+xml';}
	if($filexten=='.svgz'){return 'image/svg+xml';}

	// archives
	if($filexten=='.zip'){return 'application/zip';}
	if($filexten=='.rar'){return 'application/x-rar-compressed';}
	if($filexten=='.exe'){return 'application/x-msdownload';}
	if($filexten=='.msi'){return 'application/x-msdownload';}
	if($filexten=='.cab'){return 'application/vnd.ms-cab-compressed';}

	// audio/video
	if($filexten=='.mp3'){return 'audio/mpeg';}
	if($filexten=='.qt'){return 'video/quicktime';}
	if($filexten=='.mov'){return 'video/quicktime';}

	// adobe
	if($filexten=='.pdf'){return 'application/pdf';}
	if($filexten=='.psd'){return 'image/vnd.adobe.photoshop';}
	if($filexten=='.ai'){return 'application/postscript';}
	if($filexten=='.eps'){return 'application/postscript';}
	if($filexten=='.ps'){return 'application/postscript';}

	// ms office
	if($filexten=='.doc'){return 'application/msword';}
	if($filexten=='.rtf'){return 'application/rtf';}
	if($filexten=='.xls'){return 'application/vnd.ms-excel';}
	if($filexten=='.ppt'){return 'application/vnd.ms-powerpoint';}

	// open office
	if($filexten=='.odt'){return 'application/vnd.oasis.opendocument.text';}
	if($filexten=='.ods'){return 'application/vnd.oasis.opendocument.spreadsheet';}
}
?>