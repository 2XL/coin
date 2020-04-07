<?php

require_once ($_SERVER['DOCUMENT_ROOT'] . '/config_coin.php'); 
require_once ($_SERVER['DOCUMENT_ROOT'] . $_PATH . '/bd/bd_auction.php');

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */ 

/*
 * hi pots implementar amb diversos decisions de disseny
 * per començar podriem pimpam.. pim pam blablababal
 * 
 */

echo '<pre>';

print_r($_REQUEST);

echo '</pre>';


/*
echo $_COOKIE['iduser'];

$id_user = $_COOKIE['iduser'];
$link = obrirBD();
    
foreach ($_REQUEST as $id_auction) {
    echo '<br>'. $id_user. ' follows -> ' .$id_auction;
    insertUserFollowingAuction($id_auction, $id_user, $link);
}

tancarBD($link);


header('Location: '.$_PATH.'/pages/bid.php');
 * 
 */