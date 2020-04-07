<?php

require_once ($_SERVER['DOCUMENT_ROOT'] . '/config_coin.php');
//require_once ($_SERVER['DOCUMENT_ROOT'] . $_PATH . '/visit.php');
/*
setcookie("idUser", "", time());
setcookie("tokenUser", "", time());
unset($_COOKIE['idUser']);
unset($_COOKIE['tokenUser']);
*/
 

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
 
if (isset($_POST['login'])) {
    //  echo 'out';
    header("Location: " . $_PATH . "/admin/login.php?logout");
} else if (isset($_GET['error'])) {
    //  echo 'error';
    header("Location: " . $_PATH . "/admin/login.php?error");
} else {
    header("Location: " . $_PATH . "/admin/login.php");
}
  