<?php
$file = 'TORRENT/ubuntu.16.04.1.server.i386.iso';
$path = '/home/krolanta.fr/files/'.$file;
$url  = 'http://api.krolanta.fr/files/'.$file;
if (file_exists($path)) {
	//echo "exit";exit;
	/*
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($path).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($path));
    readfile($url);
    exit;*/
	
	header("Location: $url");
}



?>