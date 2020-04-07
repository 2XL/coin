<?php

require_once ($_SERVER['DOCUMENT_ROOT'] . '/config_coin.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . $_PATH . '/bd/bd_auction.php');


 

$param = 0;

if (isset($_COOKIE['iduser']) && $_COOKIE['iduser'] != "") {
    $id_user = $_COOKIE['iduser'];
    $param++;
}

if (isset($_COOKIE['name']) && $_COOKIE['name'] != "") {
    $name = $_COOKIE['name'];
    $param++;
}

if ($param == 2) {
 
    $link = obrirBD();
    $result = getUserByIdAndName($id_user, $name, $link);
    tancarBD($link);
}

if (isset($result) && ($result > 0)) {
 //   echo 'ok';
} else {
  //  echo 'log out';
  
    Header("Location: ../index.php");
   // require_once ($_SERVER['DOCUMENT_ROOT'] . $_PATH . '/logout.php');
}


 
/*
if ($access) {
    echo 'ur gona log out!';
    
} */