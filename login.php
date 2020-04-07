<?php
session_start();
require_once ($_SERVER['DOCUMENT_ROOT'] . '/config_coin.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . $_PATH . '/bd/bd_signin.php');

// una cosa es login i lo altre es redirect
// login genera identificador de sessió
// redirect bloqueja els accesos sense identificador de sessió valid

/*
echo '<pre>';
print_r($_POST);
echo '</pre>';
*/
$link = obrirBD();

$fail = false;
$access = false;
$login_result = "";

if (isset($_POST['email']) && ($_POST['password'] != "")) {

    $email = $_POST['email'];
    if (!existsLoginByEmail($email, $link)) {
	$login_result = "1";
	$fail = true;
    }
    $pass = $_POST['password'];
} else {
    echo 'imput wrong format! ';
    $login_result = "2";
    $fail = true;
}

// echo ' comprovar si la combinació de user and password existeix en la bd';

if (!$fail) {
    $result = getUserByEmailAndPass($email, md5($pass), $link);
    $length = count($result);

    if ($length == 0) {
//	echo '<br>login failed';
	$login_result = "3";
	//   
    } else {
//	echo '<br>login suecced';
//	echo '<br>welcome: ' . $result[0]['name'];

	/*
	 * generar cookie i generar identificador de sessió
	 * podria fer una taula de sessió i registrar tots els logins i logouts dels usuaris
	 * seria bo per fer estadistiques...
	 */

	// crear 
	setcookie("iduser", $result[0]['id_user'], time() + ($_COOKIETIMEOUT));
	setcookie("name", $result[0]['name'], time() + ($_COOKIETIMEOUT));
	
	$_SESSION['iduser'] = $result[0]['id_user'];
	$_SESSION['name'] = $result[0]['name'];
//	echo $_SESSION['name']. '<br>';
	$access = true;
    }
}
tancarBD($link);


if (!$access) {
    header("Location:  index.php?error=" . $login_result);
    //   require_once ($_SERVER['DOCUMENT_ROOT'] . $_PATH . '/logout.php');
} else {
    // anar a home
    header("Location:  index.php");
}

// paso 1 tercio del dia pensando en ti
// paso 1 tercio del dia soñando en estar contigo
// paso el ultimo tercio del dia añorandote.




 































