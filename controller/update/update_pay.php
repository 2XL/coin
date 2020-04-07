<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/config_coin.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . $_PATH . '/bd/bd_auction.php');




 
 
$returno = '';
if (isset($_REQUEST['return'])) {
    $id_pay = $_REQUEST['return'];
    $link = obrirBD();
    updatePayToPaidById($id_pay, $link);  
    tancarBD($link);
    $returno = '?sucess';
}else 
    if(isset($_GET['cancel']))
    {
    $returno = "?error&";
    }

// update auction so its not active and dont display anymore in bids...

 
header('Location: ' . $_PATH . '/pages/pay.php'.$returno);

// create pay then redirect to pay it :D


