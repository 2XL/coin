<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 
if (isset($_GET['lang'])) {
    setcookie("lang", $_GET['lang'], time() + $_COOKIETIMEOUT);
    $_SESSION['lang'] = $_GET['lang'];
    header('Location: ' . $_SERVER['PHP_SELF']);
} else {
    if (!isset($_COOKIE['lang'])) { // no hi ha se asigna un per defect
	setcookie("lang", 'esp', time() + $_COOKIETIMEOUT);
	$_SESSION['lang'] = 'esp';
	header('Location: ' . $_SERVER['PHP_SELF']);
    }
} 
 

// get all page text by language
$link_lang = obrirBD();
$lang = isset($_COOKIE['lang']) ? $_COOKIE['lang'] : $_SESSION['lang']; 
$menu = getMenuLangByLang($lang, $link_lang);
$button = getButtonLangByLang($lang, $link_lang);
$label = getLabelLangByLang($lang, $link_lang);
$modal = getModalLangByLang($lang, $link_lang);
$option = getOptionLangByLang($lang, $link_lang);
$alert = getAlertLangByLang($lang, $link_lang);
$placeholder = getPlaceholderLangByLang($lang, $link_lang);
tancarBD($link_lang);