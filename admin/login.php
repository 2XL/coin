<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/config_coin.php');
if (isset($_SERVER['HTTP_COOKIE'])) {
    $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
    foreach($cookies as $cookie) {
        $parts = explode('=', $cookie);
        $name = trim($parts[0]);
	  
        setcookie($name, '', time()-1000);
        setcookie($name, '', time()-1000, '/');
	unset($_COOKIE[$name]); 
    }
} 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">


<html xmlns="http://www.w3.org/1999/xhtml"> 
    <head>
        <title><?php echo $_WEBNAME; ?> - Admin</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link href="<?php echo $_PATH . "/admin/css/style.css"; ?>" rel="stylesheet" type="text/css" />
	<link href="<?php echo $_PATH . "/admin/css/login.css"; ?>" rel="stylesheet" type="text/css" />
    </head>
    <body>
	<form id="form" action="<?php echo $_PATH . "/admin/coin/index.php"; ?>" method="post">
	    <table id="login">
		<caption><?php echo $_WEBNAME; ?> - User Login</caption>
		<tr>
		    <td>
			User<br/>
			<input type="text" name="username" style="width: 200px;"/>
		    </td>
		</tr>
		<tr>
		    <td>
			Password<br/>
			<input type="password" name="password" style="width: 200px;"/>
		    </td>
		</tr>
		<tr>
		    <td>
			<input type="hidden" name="login" value="login"/>
			<a class="button-blue" href="javascript:document.forms['form'].submit();">Enter</a>
			<?php if (isset($_GET['error'])) { ?>
    			<span>Wrong data!</span>
			<?php } ?>
		    </td>
		</tr>
		<tr>
		    <td>
			<a href="" onclick="mostrar_email_request" style="font-size: 10px;">Have you forgotten your username/password?</a> 
		    </td> 
		</tr> 
	    </table>
        </form>
    </body>
</html>


