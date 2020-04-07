<?php

require_once ($_SERVER['DOCUMENT_ROOT'] . '/config_coin.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . $_PATH . '/bd/bd.php');

/**
 * GET
 * check if the email already exists in the database
 */

/**
 * 
 * @param type $email
 * @param type $link
 * @return type
 * 
 *  use case:
 * 	1 - signin
 * 
 * 
 */
function langDictionary($array) {
    
    $dict = array();
    foreach ($array as $subarray) {
	if ($subarray['field'] == '' || $subarray['value'] == '') {
	    
	} else {
	    $dict[$subarray['field']] = $subarray['value'];
	}
    }
    return $dict;
}

function getMenuLangByLang($lang, $link) {
    $query = "SELECT field, " . mysql_real_escape_string($lang) . " as value "
	    . "FROM lang where section = 'menu'";
    $result = selectBD($query, $link);
    return langDictionary($result);
}

function getButtonLangByLang($lang, $link) {
    $query = "SELECT field, " . mysql_real_escape_string($lang) . " as value FROM lang where section = 'button'";
    $result = selectBD($query, $link);
    return langDictionary($result);
}

function getAlertLangByLang($lang, $link) {
    $query = "SELECT field, " . mysql_real_escape_string($lang) . " as value FROM lang where section = 'alert'";
    $result = selectBD($query, $link);
    return langDictionary($result);
}

function getLabelLangByLang($lang, $link) {
    $query = "SELECT field, " . mysql_real_escape_string($lang) . " as value FROM lang where section = 'label'";
    $result = selectBD($query, $link);
    return langDictionary($result);
}

function getOptionLangByLang($lang, $link) {
    $query = "SELECT field, " . mysql_real_escape_string($lang) . " as value FROM lang where section = 'option'";
    $result = selectBD($query, $link);
    return langDictionary($result);
}

function getModalLangByLang($lang, $link) {
    $query = "SELECT field, " . mysql_real_escape_string($lang) . " as value FROM lang where section = 'modal'";
    $result = selectBD($query, $link);
    return langDictionary($result);
}

function getPlaceholderLangByLang($lang, $link) {
    $query = "SELECT field, " . mysql_real_escape_string($lang) . " as value FROM lang where section = 'placeholder'";
    $result = selectBD($query, $link);
    return langDictionary($result);
}

//
function getPayLangByLang($lang, $link) {
    $query = "SELECT field, " . mysql_real_escape_string($lang) . " as value FROM lang where section = 'pay'";
    $result = selectBD($query, $link);
    return langDictionary($result);
}

function getSearchLangByLang($lang, $link) {
    $query = "SELECT field, " . mysql_real_escape_string($lang) . " as value FROM lang where section = 'search'";
    $result = selectBD($query, $link);
    return langDictionary($result);
}

function getBidLangByLang($lang, $link) {
    $query = "SELECT field, " . mysql_real_escape_string($lang) . " as value FROM lang where section = 'bid'";
    $result = selectBD($query, $link);
    return langDictionary($result);
}

function getAuctionLangByLang($lang, $link) {
    $query = "SELECT field, " . mysql_real_escape_string($lang) . " as value FROM lang where section = 'auction'";
    $result = selectBD($query, $link);
    return langDictionary($result);
}

function getContactLangByLang($lang, $link) {
    $query = "SELECT field, " . mysql_real_escape_string($lang) . " as value FROM lang where section = 'contact'";
    $result = selectBD($query, $link);
    return langDictionary($result);
}

/**
 * 
 * @param type $email
 * @param type $pass
 * @param type $link
 * @return type
 *  
 *  use case:
 * 	1 - login
 */
function getUserByEmailAndPass($email, $pass, $link) {
    $query = "
	SELECT 
	    *
	FROM
	    users
	WHERE
	    email = '" . mysql_real_escape_string($email) . "'
		AND
	    password = '" . mysql_real_escape_string($pass) . "'";
    $result = selectBD($query, $link);
    return $result;
}

function insertNewUser($name, $surename, $birthday, $civilstatus, $email, $dni, $password, $quest, $qanswer, $link) {

    // aqui cal vigilar els inputs si son null o esta definits o obligarlo en html... en la vista

    $query = "
	INSERT  
	INTO
	    users
		( name, surename, birthday, civilstatus, dni, email, password, quest, qanswer  
		)
	VALUES
		( 
	    '" . mysql_real_escape_string($name) . "',
	    '" . mysql_real_escape_string($surename) . "',
	    '" . mysql_real_escape_string($birthday) . "',
	    '" . mysql_real_escape_string($civilstatus) . "',
	    '" . mysql_real_escape_string($dni) . "',
	    '" . mysql_real_escape_string($email) . "',
	    '" . mysql_real_escape_string($password) . "',
	    '" . mysql_real_escape_string($quest) . "',
	    '" . mysql_real_escape_string($qanswer) . "'  
		)";

    insertBD($query, $link);
    return mysql_insert_id($link);
}

/**
 * INSERT  
 */
/**
 *  GET ** */
/*
  function getUser($username, $link){

  $result = selectBD("
  select * from admin
  where
  username like '".mysql_real_escape_string($username)."'
  ", $link);
  return $result[0];
  }

  function getAdminByUsername($username, $link) {
  $result = selectBD("
  select * from admin
  where
  username like '".mysql_real_escape_string($username)."'
  ", $link);

  return $result[0];
  }

  function getAdminById($id, $link) {
  $result = selectBD("
  select * from admin
  where
  id_admin = '".mysql_real_escape_string($id)."'
  ", $link);

  return $result[0];
  }

 */
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
?>