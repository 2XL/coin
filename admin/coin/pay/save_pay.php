<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/config_coin.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . $_PATH . '/admin/redirect.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . $_PATH . '/bd/bd_admin.php');

 


$id_pay = $_REQUEST['id_pay']; 
$ispaid = (isset($_REQUEST['ispaid'])) ? 1 : 0;

$link = obrirBD();

updateIsPaid($id_pay, $ispaid, $link);

tancarBD($link);

$dir = 'index.php?id=' . $id_pay . '&ok';
header("Location: $dir ");
