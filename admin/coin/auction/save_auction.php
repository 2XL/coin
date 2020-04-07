<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/config_coin.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . $_PATH . '/admin/redirect.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . $_PATH . '/bd/bd_admin.php');

 

/* 
Array
(
    [id_auction] => 34
    [title] => 50 centimos holandes 1999
    [date_start] => 2014-05-03
    [date_end] => 2014-05-30
    [value_starting] => 10000
    [value_reserve] => 100
) 
*/



$id_auction  = $_REQUEST['id_auction'];
$title = $_REQUEST['title'];
$date_start = $_REQUEST['date_start'];
$date_end = $_REQUEST['date_end'];
$value_starting = $_REQUEST['value_starting'];
$value_reserve = $_REQUEST['value_reserve'];


$link = obrirBD();




updateAuction($id_auction, $title, $date_start, $date_end, $value_starting, $value_reserve, $link);

tancarBD($link);


$dir = 'index.php?id='.$id_auction.'&ok';
header("Location: $dir ");

