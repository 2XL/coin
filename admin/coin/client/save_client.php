<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/config_coin.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . $_PATH . '/admin/redirect.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . $_PATH . '/bd/bd_admin.php');


$id_user = $_REQUEST['id_user'];
$name = $_REQUEST['name'];
$surename = $_REQUEST['surename'];
$civilstatus = $_REQUEST['civilstatus'];
$quest = $_REQUEST['quest'];
$qanswer = $_REQUEST['qanswer'];
$is_admin = (isset($_REQUEST['is_admin'])) ? 1 : 0;

$link = obrirBD();

updateClient($id_user, $name, $surename, $civilstatus, $quest, $qanswer, $is_admin, $link);

tancarBD($link);

$dir = 'index.php?id=' . $id_user . '&ok';
header("Location: $dir ");
