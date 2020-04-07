<?php
require_once ($_SERVER['DOCUMENT_ROOT'].'/config_coin.php'); 
require_once ($_SERVER['DOCUMENT_ROOT'] . $_PATH . '/bd/bd.php');



/* * * GET ** */

function getFullVisitants($link) {
	return selectBD("
		select 
			* 
		from 
			web_visitant  
		order by 
			id_visitant
	", $link);
}

function getVisitantsBetween($timeInit, $timeFinal, $link) {
	return selectBD("
		select 
			* 
		from 
			web_visitant  
		where 
			data > STR_TO_DATE('" . mysql_real_escape_string($timeInit) . "', '%d-%m-%Y') and
			data <  STR_TO_DATE('" . mysql_real_escape_string($timeFinal) . "', '%d-%m-%Y') 
	", $link);
}

function getUniqueVisitantsBetween($timeInit, $timeFinal, $link) {
	return selectBD("
		select 
			* 
		from 
			web_visitant  
		where 
			data > STR_TO_DATE('" . mysql_real_escape_string($timeInit) . "', '%d-%m-%Y') and
			data <  STR_TO_DATE('" . mysql_real_escape_string($timeFinal) . "', '%d-%m-%Y') 
		group by ip
	", $link);
}

function getVisitorNewIncome($timeInit, $timeFinal, $link) {
	$result = selectBD("  
		select 
			count(*) as visitante, date_format(data, '%d/%M/%y') as fecha
		from 
			web_visitant
		where
				data >= STR_TO_DATE('" . mysql_real_escape_string($timeInit) . "', '%d-%m-%Y') and 
				data <= STR_TO_DATE('" . mysql_real_escape_string($timeFinal) . "', '%d-%m-%Y')
		group by day(data), month(data), year(data)
		order by data asc 
	", $link);
	return $result;
}

/* * * COUNT ** */

function countVisitantsBetween($timeInit, $timeFinal, $link) {
	$result = selectBD("
		select 
			count(*) as n
		from 
			web_visitant  
		where 
			data > STR_TO_DATE('" . mysql_real_escape_string($timeInit) . "', '%d-%m-%Y') and
			data <  STR_TO_DATE('" . mysql_real_escape_string($timeFinal) . "', '%d-%m-%Y') 
	", $link);
	return $result[0]['n'];
}

function countUniqueVisitantsBetween($timeInit, $timeFinal, $link) {
	$result = selectBD("
		select
			count(*) as n
		from 
			(
			select 
				* 
			from 
				web_visitant  
			where 
				data > STR_TO_DATE('" . mysql_real_escape_string($timeInit) . "', '%d-%m-%Y') and
				data <  STR_TO_DATE('" . mysql_real_escape_string($timeFinal) . "', '%d-%m-%Y') 
			group by ip
			) as unicos
	", $link);
	return $result[0]['n'];
}

function countFullVisitants($link) {
	$result = selectBD("
		select 
			count(*) as n
		from 
			web_visitant   
	", $link);
	return $result[0]['n'];
}

function countUniqueFullVisitants($link) {
	$result = selectBD(" 
		select count(*) as n
		from 
			(
			select 
				* 
			from 
				web_visitant   
			group by ip
			) as unicos
	", $link);
	return $result[0]['n'];
}

/* * * EXIST ** */



/* * * UPDATE ** */




/* * * INSERT ** */

function insertNewVisitant($tag, $ip, $specs, $logged, $link) {
	insertBD("
		insert 
		into 
			web_visitant 
		(
			tag, 
			ip, 
			specs,
			logged
			)
        values	
		(
			'" . mysql_real_escape_string($tag) . "',
			'" . mysql_real_escape_string($ip) . "', 
			'" . mysql_real_escape_string($specs) . "', 
			'" . mysql_real_escape_string($logged) . "'  
			)", $link);
	return mysql_insert_id($link);
}


/* * * CHECK * * */
function checkVisitantBlacklisted($ip, $link){
	return selectBD("
		select 
			id_blacklist
		from 
			blacklist  
		where 
			ip = '" . mysql_real_escape_string($ip) . "'
	", $link);
}


?> 

