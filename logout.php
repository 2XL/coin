<?php

require_once ($_SERVER['DOCUMENT_ROOT'] . '/config_coin.php');
//echo 'user is attempting to logout!';

setcookie("iduser", "", time() + (3600 * 8));
setcookie("name", "", time() + (3600 * 8));

if (isset($_COOKIE['iduser'])) {
    unset($_COOKIE['iduser']);
}
if (isset($_COOKIE['name'])) {
    unset($_COOKIE['name']);
}

if (isset($_SERVER['HTTP_COOKIE'])) {
    $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
    foreach($cookies as $cookie) {
        $parts = explode('=', $cookie);
        $name = trim($parts[0]);
	 
        setcookie($name, '', time()-1000);
        setcookie($name, '', time()-1000, '/');
	unset($_COOKIE[$name]); 
    }
} 
session_destroy(); 
header("Location:  " . $_PATH . '/index.php');


