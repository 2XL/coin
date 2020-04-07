<?php

require_once ($_SERVER['DOCUMENT_ROOT'] . '/config_coin.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . $_PATH . '/bd/bd_auction.php');


  
/*
 * set where you want to store files
 * in this example we keep file in folder upload - centralitzat root/img/user
 */
/** STORE FILE IF ISSET * */
$name = $_FILES['image']['name'];
$tmp_name = $_FILES['image']['tmp_name'];
$relpath = $_PATH . '/img/user/' . $name;
$path = $_SERVER['DOCUMENT_ROOT'] . $_PATH . '/img/user/' . $name;

if (isset($_FILES)) {
    if (copy($tmp_name, $path)) {
//	echo 'feedback ok';
//	echo "<img src=\"$relpath\" width=\"150\" height=\"150\">";
    } else {
//	echo 'feedback error';
    }
}
// echo ' this show the requests args ';
$link = obrirBD();


// 1r generar un auction nou 
$id_user = $_REQUEST['id_user'];
$title = $_REQUEST['title'];
$date_start = $_REQUEST['dStart'];
$date_end = $_REQUEST['dEnd'];


if (strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') !== false) {
    // chrome
    $date_start = $_REQUEST['dStart'];
    $date_end = $_REQUEST['dEnd'];
} else {
    // firefox - no rula
    $date = str_replace('/', '-', $_REQUEST['dStart']);
    $date_start = date('Y-m-d', strtotime($date));
    $date = str_replace('/', '-', $_REQUEST['dEnd']);
    $date_end = date('Y-m-d', strtotime($date));
}

$value_reserve = $_REQUEST['rValue']; // check if the reserve price is lower then the starting
$value_starting = isset($_REQUEST['sValue']) ? $_REQUEST['sValue'] : $value_reserve;

// $active = isset($_REQUEST['isActive']) ? 1 : 0;
$min_bid_number = $_REQUEST['mBidNum'];
$active = 1;
$type = $_REQUEST['type'];

$id_auction = insertNewAuction($id_user, $title, $date_start, $date_end, $value_starting, $value_reserve, $min_bid_number, $active, $type, $link);
 
// 2n linkar image amb auctino id
$id_picture = insertAuctionPicture($id_auction, $name, $relpath, $link);

// crear una instancia de pay de negoci per el propietari

tancarBD($link);
header('Location: '.$_PATH.'/pages/auction.php?success');
