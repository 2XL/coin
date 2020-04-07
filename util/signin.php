<?php
 
require_once ($_SERVER['DOCUMENT_ROOT'] . '/config_coin.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . $_PATH . '/bd/bd_signin.php');
 
 
  
$name = $_POST['name'];
$surename = $_POST['surename'];
$birthday = $_POST['birthday'];
$marriage = $_POST['marriage'];
$dni = $_POST['dni'];
$email = $_POST['email'];
$password = $_POST['password'];
$passwordre = $_POST['passwordre'];
$quest = $_POST['quest'];
$qanswer = $_POST['qanswer'];

$link = obrirBD();
 

$result = getUserByEmail($email, $link);

if ($result !== null) {
    // insert new user to database
    $signin = 'error';
    // redirect user already exists en index report
} else {
    insertNewUser($name, $surename, $birthday, $marriage, $email, $dni, md5($password), $quest, $qanswer, $link);
    $signin = 'success';
}
tancarBD($link);

$dir = $_PATH . '/index.php?signin=' . $signin;
 
header("Location: $dir");





