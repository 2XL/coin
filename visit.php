<?php
require_once ($_SERVER['DOCUMENT_ROOT'].'/config_coin.php'); 
require_once ($_SERVER['DOCUMENT_ROOT'] . $_PATH.'/bd/bd_web_visitant.php');  

 
function curPageURL() {
	$pageURL = 'http';
	if (isset($_SERVER["HTTPS"]) && $_SERVER == "on") {
		$pageURL .= "s";
	}
	$pageURL .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") {
		$pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
	} else {
		$pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
	}
	return $pageURL;
}
 
 
$link = obrirBD(); 
$logged = isset($_COOKIE['iduser']) ? $_COOKIE['iduser'] : 0; 
insertNewVisitant($_SERVER['HTTP_USER_AGENT'], $_SERVER['REMOTE_ADDR'], curPageURL(), $logged, $link);


 
tancarBD($link);

 

