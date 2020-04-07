<?php 
require_once ($_SERVER['DOCUMENT_ROOT'] . '/config_coin.php'); 
require_once ($_SERVER['DOCUMENT_ROOT'] . $_PATH . '/bd/bd_auction.php');

$id_bid = $_REQUEST['id_bid']; 
$link = obrirBD();
 
$hasToCreate = existPayByIdBid($id_bid, $link);

$created = 'false';
if ($hasToCreate == 0) {
    $id_pay = insertPay($id_bid, $link);
    $created = 'true';
    $ids = getAuctionWinByIdBid($id_bid, $link);

    $bidder = $ids['bidder'];
    $auctioner = $ids['auctioner'];
    $auction = $ids['id_auction'];
    $bid = $ids['id_bid'];


    $_auction = getAuctionByID($auction, $link);
    $_bid = getBidByID($bid, $link);
    $_bidder = getUserById($bidder, $link);
    $_auctioner = getUserById($auctioner, $link);
 

    $delivery_bidder = mail($_bidder['email'], 'u won an auction', 'bid ' . $_bid['id_bid'] . ' has owned auction ' . $_auction['title'] . ' now u have to pay!', 'From: stacktracks@stacktracks.com');
    $delivery_auctioner = mail($_auctioner['email'], 'u sold a auction', 'auction ' . $_auction['title'] . ' successfully sold now pending to be paid!', 'From: stacktracks@stacktracks.com');
 
}
tancarBD($link); 
header('Location: ' . $_PATH . '/pages/pay.php?idbid=' . $id_bid);
