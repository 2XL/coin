<?php

require_once ($_SERVER['DOCUMENT_ROOT'] . '/config_coin.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . $_PATH . '/bd/bd_auction.php');


/*  
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

 
/*
Array
(
    [id_user] => 1
    [id_auction] => 34
    [type] => 2
    [myValue] => 1000
)
 
 */


// create a bid 

$id_user = $_REQUEST['id_user'];
$id_auction = $_REQUEST['id_auction'];
$value = $_REQUEST['myValue'];

$link = obrirBD();

$id_bid = insertAuctionBid($id_user, $id_auction, $value, $link);

// update auction bid

updateAuctionIdBid($id_auction, $id_bid, $link);

tancarBD($link);

header('Location: '.$_PATH.'/pages/bid.php?auction='.$id_auction);
// 
