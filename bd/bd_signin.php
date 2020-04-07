<?php

require_once ($_SERVER['DOCUMENT_ROOT'] . '/config_coin.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . $_PATH . '/bd/bd.php');

function getUserByEmail($email, $link) {
    $query = "
	SELECT 
	    *
	FROM
	    users
	WHERE 
	    email = '" . mysql_real_escape_string($email) . "'";

    $result = selectBD($query, $link);


    return isset($result['0']) ? $result['0'] : null;
}

function getUserIdByEmail($email, $link) {
    $query = "
	SELECT 
	    id_user
	FROM
	    users
	WHERE 
	    email = '" . mysql_real_escape_string($email) . "'";

    $result = selectBD($query, $link);
    return $result['0']['id_user'];
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

    // cal vigilar que els emails siguins uniques 
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
function insertNewPassReset($id_user, $email, $session_key, $link) {

    $session_hash = md5($session_key . $email);

    $query = ""
	    . "insert into "
	    . "pass_reset "
	    . "(id_user, session_key, session_hash) "
	    . "values "
	    . "("
	    . "'" . mysql_real_escape_string($id_user) . "',
	    '" . mysql_real_escape_string($session_key) . "',
	    '" . mysql_real_escape_string($session_hash) . "'"
	    . ")";

    insertBD($query, $link);
    return mysql_insert_id($link);
    // key es un random que s'ha generat
    // hash es un hash del random
    // retorna el identificador i guarda el hash i el sense hash
}

/**
 * UPDATE ** */
function updateUserPassword($email, $password, $link) {

    $query = "
    update 
	users
    set 
	password =  '" . mysql_real_escape_string($password) . "'
    where 
	email =  '" . mysql_real_escape_string($email) . "'
    ";
    updateBD($query, $link);
}

/**
 *  GET ** */
/* * * EXIST ** */


function existsLoginByEmail($email, $link) {
    $query = ""
	    . "select count(*) from users "
	    . "where "
	    . "email like '" . mysql_real_escape_string($email) . "'";

    $result = selectCountBD($query, $link);
    return $result;
}
