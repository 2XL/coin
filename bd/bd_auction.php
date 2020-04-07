<?php

require_once ($_SERVER['DOCUMENT_ROOT'] . '/config_coin.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . $_PATH . '/bd/bd.php');

/* * * GET ** */

function getSearchAuctionByFilter($id_user, $title, $dPublish, $dClosure, $dCreation, $vMax, $vMin, $type, $link) {

    /*
      $currentDate = date('y-m-d',time());
      $currentTimestamp = date
     */

    // tractament del parametres de entrada els imputs 
    $query = "
            select auctions.*, pictures.path
            from auctions inner join pictures on auctions.id_auction = pictures.id_auction
            where 
                id_user !=  '" . mysql_real_escape_string($id_user) . "' and 
                auctions.title like  \"%" . mysql_real_escape_string($title) . "%\" and
                '" . mysql_real_escape_string($dPublish) . "' < CURRENT_DATE and
                '" . mysql_real_escape_string($dClosure) . "' > CURRENT_DATE and
                '" . mysql_real_escape_string($dCreation) . "' < CURRENT_TIMESTAMP and
                value_starting BETWEEN  '" . mysql_real_escape_string($vMin) . "' and  '" . mysql_real_escape_string($vMax) . "' and
                type =  '" . mysql_real_escape_string($type) . "' and 
                auctions.id_auction not in (
                    select id_auction 
                    from auction_follow 
                    where id_user = '" . mysql_real_escape_string($id_user) . "'
                )  
                ";

    $result = selectBD($query, $link);
    return $result;
}

function getSearchAllAuction($id_user, $link) {
    // tractament del parametres de entrada els imputs 
    $query = "
            select * 
            from auctions 
            where 
                id_user !=  '" . mysql_real_escape_string($id_user) . "' and 
                id_auction not in (
                    select id_auction 
                    from auction_follow 
                    where id_user = '" . mysql_real_escape_string($id_user) . "'
		    
                )
                ";

    $result = selectBD($query, $link);
    return $result;
}

function getAuctionByID($id_auction, $link) {
    $query = " 
    select * from auctions
    where id_auction = '" . mysql_real_escape_string($id_auction) . "' 
    ";
    $result = selectBD($query, $link);
    return $result[0];
}

function getUserByIdAndName($id, $username, $link) {
    return selectCountBD("
	select count(*) from users
	where
	    name like '" . mysql_real_escape_string($username) . "' and 
	    id_user = '" . mysql_real_escape_string($id) . "'  
	     
	", $link);
}

function getFollowingAuctionByUserID($id_user, $link) {


    $query = "  
    select id_auction, pictures.path, pictures.title  from pictures natural join auction_follow
    where id_user = '" . mysql_real_escape_string($id_user) . "'";




    $result = selectBD($query, $link);

    return $result;
}

function getBidByID($id_bid, $link) {
    $query = " 
    select * from bids
    where id_bid = '" . mysql_real_escape_string($id_bid) . "' 
    ";
    $result = selectBD($query, $link);

    return (isset($result[0]) ? $result[0] : 0 );
}

function getUserById($id_user, $link) {
    $result = selectBD("
	select * from users
	where 
	id_user = '" . mysql_real_escape_string($id_user) . "'
	", $link);
    return (isset($result[0]) ? $result[0] : 0 );
}

function getPaysByUser($id_user, $link) {
    $query = "	 
	select payset.atitle as title, payset.id_bid, payset.id_pay, payset.ispaid, payset.id_user as id_buyer, payset.id_owner as id_seller, payset.value, payset.value_starting, (payset.value_starting+payset.value) as to_pay , pictures.path, pictures.title as picname
	    from pictures inner join	(
		select pays.*, auctions.title as atitle, auctions.id_user as id_owner, auctions.value_starting
		    from auctions inner join	( 
			SELECT	*   
			    FROM (pays natural join bids)
				where id_user = " . mysql_real_escape_string($id_user) . ") as pays on auctions.id_auction = pays.id_bid_auction ) as payset on  payset.id_bid_auction = pictures.id_auction ";
    $result = selectBD($query, $link);
    return $result;
}

function getBidPaidByIdBid($id_bid, $link) {
    $query = "SELECT * FROM bids natural join pays where id_bid = " . mysql_real_escape_string($id_bid) . "";
    $result = selectBD($query, $link);
    return $result;
}

function getAuctionWinByIdBid($id_bid, $link) {
    $query = " select id_auction, id_bid, auctions.id_user as auctioner, bids.id_user as bidder from auctions inner join bids on id_bid = current_bid where id_bid = " . mysql_real_escape_string($id_bid) . "";
    $result = selectBD($query, $link);
    return $result[0];
}

/* * * COUNT * * */

function countAuctionBids($id_auction, $link) {
    $query = "
    select count(*) from bids where id_bid_auction = '" . mysql_real_escape_string($id_auction) . "' 
    ";

    $result = selectBD($query, $link);
    return ($result['0']['count(*)']);
}

/* * * UPDATE ** */

function updateAuctionIdBid($id_auction, $id_bid, $link) {
    $query = " 
    update 
	auctions 
    set 
	current_bid = '" . mysql_real_escape_string($id_bid) . "' 
    where 
	id_auction = '" . mysql_real_escape_string($id_auction) . "'";
    updateBD($query, $link);
}

function updatePayToPaidById($id_pay, $link) {
    $query = "
    update
	pays
    set
	ispaid = 1
    where
	id_pay = '" . mysql_real_escape_string($id_pay) . "'";
    updateBD($query, $link);
}

/* * * EXISTS ** */

function existPayByIdBid($id_bid, $link) {
    $query = "    
    select count(*) from pays
    where id_bid = '" . mysql_real_escape_string($id_bid) . "'";
    $result = selectBD($query, $link);
    return $result[0]['count(*)'];
}

/* * * INSERT ** */

function insertNewAuction($id_user, $title, $date_start, $date_end, $value_starting, $value_reserve, $min_bid_num, $active, $type, $link) {

    $query = "
    insert into 
        auctions (
                id_user, title, date_start, date_end, value_starting, value_reserve, min_bids, active, type
                )
        values  (        
			'" . mysql_real_escape_string($id_user) . "',                          
			'" . mysql_real_escape_string($title) . "',                            
			'" . mysql_real_escape_string($date_start) . "',                            
			'" . mysql_real_escape_string($date_end) . "',                            
			'" . mysql_real_escape_string($value_starting) . "',
			'" . mysql_real_escape_string($value_reserve) . "', 
			'" . mysql_real_escape_string($min_bid_num) . "' ,
			'" . mysql_real_escape_string($active) . "' ,
                        '" . mysql_real_escape_string($type) . "'  
                )";
    insertBD($query, $link);
    return mysql_insert_id($link);
}

function insertAuctionPicture($id_auction, $title, $path, $link) {

    $query = "
    insert into 
        pictures(
                id_auction, title, path)
        values(
                    '" . mysql_real_escape_string($id_auction) . "',                          
                    '" . mysql_real_escape_string($title) . "',                            
                    '" . mysql_real_escape_string($path) . "'
                        
                )";
    insertBD($query, $link);
    return mysql_insert_id($link);
}

function insertUserFollowingAuction($id_auction, $id_user, $link) {
    $query = " 
    insert into auction_follow(
    id_user, id_auction)
    values( 
    '" . mysql_real_escape_string($id_user) . "',
    '" . mysql_real_escape_string($id_auction) . "' 
    )";
    insertBD($query, $link);
    return mysql_insert_id($link);
}

function insertAuctionBid($id_user, $id_auction, $value, $link) {

    $query = " 
    insert into bids(
    id_user, id_bid_auction, value)
    values( 
    '" . mysql_real_escape_string($id_user) . "',
    '" . mysql_real_escape_string($id_auction) . "',
    '" . mysql_real_escape_string($value) . "' 
    )";
    insertBD($query, $link);
    return mysql_insert_id($link);
}

function insertPay($id_bid, $link) {
    $query = "insert into pays(id_bid) value('" . mysql_real_escape_string($id_bid) . "')";
    insertBD($query, $link);
    return mysql_insert_id($link);
}

/* ** DROP ** */







