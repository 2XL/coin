<?php

require_once ($_SERVER['DOCUMENT_ROOT'] . '/config_coin.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . $_PATH . '/bd/bd.php');



/* * * GET ** */

function getUser($username, $link) {

    $result = selectBD("
	select * from users
	where
	    email like '" . mysql_real_escape_string($username) . "'
	", $link);
    return $result[0];
}

function getAdminByUsername($username, $link) {
    $result = selectBD("
	select * from users
	where
	    email like '" . mysql_real_escape_string($username) . "'
	", $link);

    return $result[0];
}


function getUserByUsername($username, $link) {
    $result = selectBD("
	select * from users
	where
	    email like '" . mysql_real_escape_string($username) . "'
	", $link);

    return $result[0];
}

function getAdminById($id, $link) {
    $result = selectBD("
	select * from users
	where
	    id_user = '" . mysql_real_escape_string($id) . "'
	", $link);

    return $result[0];
}

 

function getAllUsers($link) {
    $result = selectBD("
	select * from users 
	", $link);
    return $result;
}

function getUserById($id_user, $link) {
    $result = selectBD("
	select * from users
	where 
	id_user = '" . mysql_real_escape_string($id_user) . "'
	", $link);
    return $result[0];
}

function getAuctionByID($id_auction, $link) {
    $query = " 
    select * from auctions
    where 
    id_auction = '" . mysql_real_escape_string($id_auction) . "' 
    ";
    $result = selectBD($query, $link);
    return $result[0];
}

function getAllAuctions($link) {
    $result = selectBD("
	select * from auctions 
	", $link);
    return $result;
}

function getAllPays($link) {
    $result = selectBD(" 
	SELECT * FROM pays natural join bids
	", $link);
    return $result;
}

function getPayById($id_pay, $link) {
    $query = " 
    select * from pays
    where 
    id_pay = '" . mysql_real_escape_string($id_pay) . "' 
    ";
    $result = selectBD($query, $link);
    return $result[0];
}

/* * * EXIST ** */
/*
  function existsAdminPwd($username, $pwd, $link) {
  return selectCountBD("
  select count(*) from admin
  where
  username like '".mysql_real_escape_string($username)."' and
  password like '".mysql_real_escape_string($pwd)."'
  ", $link);
  }
 */

function existsAdminPwd($username, $pwd, $link) {
    return selectCountBD("
	select count(*) from users
	where
	    email like '" . mysql_real_escape_string($username) . "' and 
	    password like '" . mysql_real_escape_string($pwd) . "' and
	    is_admin = 1
	", $link);
}

function existsUserPwd($username, $pwd, $link) {
    return selectCountBD("
	select count(*) from users
	where
	    email like '" . mysql_real_escape_string($username) . "' and 
	    password like '" . mysql_real_escape_string($pwd) . "'  
	     
	", $link);
}



/** UPDATE */
function updateClient($id_user, $name, $surename, $civilstatus, $quest, $qanswer, $is_admin, $link) {
    updateBD("
        update 
            users 
        set
	    name = '" . mysql_real_escape_string($name) . "',
	    surename = '" . mysql_real_escape_string($surename) . "',
	    civilstatus = '" . mysql_real_escape_string($civilstatus) . "',
	    quest = '" . mysql_real_escape_string($quest) . "',
	    qanswer = '" . mysql_real_escape_string($qanswer) . "',
	    is_admin = '" . mysql_real_escape_string($is_admin) . "'  
        where 
            id_user = '" . mysql_real_escape_string($id_user) . "'
            ", $link);
}

function updateAuction($id_auction, $title, $date_start, $date_end, $value_starting, $value_reserve, $link) {
    updateBD("
        update 
            auctions 
        set
	    title = '" . mysql_real_escape_string($title) . "',
	    date_start = '" . mysql_real_escape_string($date_start) . "',
	    date_end = '" . mysql_real_escape_string($date_end) . "',
	    value_starting = '" . mysql_real_escape_string($value_starting) . "',
	    value_reserve = '" . mysql_real_escape_string($value_reserve) . "'
        where 
            id_auction = '" . mysql_real_escape_string($id_auction) . "'
            ", $link);
}

function updatePay($id_pay, $amount, $link) {
    updateBD("
        update 
            pays 
        set
	    amount = '" . mysql_real_escape_string($amount) . "',
	    
        where 
            id_auction = '" . mysql_real_escape_string($id_pay) . "'
            ", $link);
}


function updateIsPaid($id_pay, $ispaid, $link){
    $query = "
    update pays
    set ispaid = $ispaid
	    where id_pay = $id_pay";
    
    
    updateBD($query, $link);
}