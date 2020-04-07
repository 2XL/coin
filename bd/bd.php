<?php

require_once ($_SERVER['DOCUMENT_ROOT'] . '/config_coin.php');


function connectBD() {

//Sample Database Connection Syntax for PHP and MySQL.
//Connect To Database
    $hostname = "stacktracks.com:3306";
    $username = "stacktracks";
    $password = "XL16sal,."; 
    $dbname = 'coin';
    $connection = mysql_connect($hostname, $username, $password);
    if($connection){
	// echo '<br>bd_connected<br>';
    }else{
	// echo '<br>bd_fail<br>'; 
    }  
    mysql_select_db($dbname, $connection);

# Check If Record Exists
    return $connection;
      
}



function obrirBD() {
   
    
    
    /*
    //LOCAL 
	$bd_server  = "localhost";
	$bd_user    = "root";
	$bd_database = "coin";
	$bd_pwd     = ""; 
	
    $link = mysql_connect($bd_server, $bd_user, $bd_pwd);
    
    if ($link) {
	mysql_select_db($bd_database, $link);
	mysql_query("SET NAMES 'utf8'", $link);
    } 
    return $link;
    
    */
    return connectBD();
    
}
 
 
function tancarBD($link) {
    mysql_close($link);
}

function selectBD($query, $link) {
    return toArray(executarQuery($query, $link));
}

function selectCountBD($query, $link) {
    $result = toArray(executarQuery($query, $link));
    return ($result[0]['count(*)'] > 0);
}

function insertBD($query, $link) {
    return executarQuery($query, $link);
}

function updateBD($query, $link) {
    return executarQuery($query, $link);
}

function deleteBD($query, $link) {
    return executarQuery($query, $link);
}

function executarQuery($query, $link) {
    $resultat = mysql_query($query, $link);

    if (!$resultat) {
	echo $query;
	echo "<br/>
<b>MySQL Error: 
</b>";
	echo mysql_error();
	die();
    } else {
	return $resultat;
    }
}

function toArray($resultat) {
    $registres = array();

    if (mysql_num_rows($resultat) > 0) {
	while ($fila = mysql_fetch_assoc($resultat)) {
	    $registres[] = $fila;
	}
    }

    return $registres;
}
?>
