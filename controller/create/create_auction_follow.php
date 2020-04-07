<?php

require_once ($_SERVER['DOCUMENT_ROOT'] . '/config_coin.php'); 
require_once ($_SERVER['DOCUMENT_ROOT'] . $_PATH . '/bd/bd_auction.php');

 

//echo $_COOKIE['iduser'];

$id_user = $_COOKIE['iduser'];
$link = obrirBD();
    
foreach ($_REQUEST as $id_auction) {
    if(!is_numeric($id_auction))
    {break;}
  //  echo '<br>'. $id_user. ' follows -> ' .$id_auction;
    insertUserFollowingAuction($id_auction, $id_user, $link);
}

tancarBD($link);


header('Location: '.$_PATH.'/pages/bid.php');