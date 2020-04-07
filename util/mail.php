<?php

// sender mail
// destination mail
// subject
// message
// return page
// source page
// stacktracks@stacktracks.com
 

if (isset($_POST['email']) &&
	isset($_POST['subject']) &&
	isset($_POST['message']) &&
	isset($_POST['return']) &&
	isset($_POST['source'])) {

    $to = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    $return = $_POST['return'];
    $source = $_POST['source']; 
    $delivery = mail($to, $subject, $message, 'From: stacktracks@stacktracks.com');


    if ($delivery) { // if accepted for delivery but not necesary delivered!
	$url = $source; //here you set the url 
    } else {
	$url = $return;
    }
} else {
    $url = "http://" . $_SERVER['HTTP_HOST'];
}
$time_out = 2; //here you set how many seconds to untill refresh
header("refresh: $time_out; url=$url");
