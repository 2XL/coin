<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/config_coin.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . $_PATH . '/admin/redirect.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . $_PATH . '/admin/time.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
	<?php require_once ($_SERVER['DOCUMENT_ROOT'] . $_PATH . '/admin/head.php'); ?>
    </head>
    <body onload="javascript:timer();"> 
	<?php require_once ($_SERVER['DOCUMENT_ROOT'] . $_PATH . '/admin/header.php'); ?>
	<div id="content">
	    <table style="width: 100%;">
		<tr>
		    <td class="lateral">
			<?php require_once ($_SERVER['DOCUMENT_ROOT'] . $_PATH . '/admin/menu.php'); ?>
		    </td>
		    <td class="centro">
			<?php
			if (isset($_GET['id'])) {
			    require_once ($_SERVER['DOCUMENT_ROOT'] . $_PATH . '/admin/coin/auction/form.php');
			} else {
			    require_once ($_SERVER['DOCUMENT_ROOT'] . $_PATH . '/admin/coin/auction/list.php');
			}
			?>
		    </td>
		</tr>
		<tr>
                    <td class="lateral">
                    </td>
                    <td class="centro">
			<?php
			if (isset($_GET['ok']))
			    echo "<div class='message_ok' > Updated! </div>";
			if (isset($_GET['error'])) {
			    $msg = '';
			    if (isset($_GET['msg']))
				$msg = $_GET['msg'];
			    echo '<div class="message_error" > error ' . $msg . '</div>';
			}
			?> 
                    </td>
                </tr> 
	    </table>
	</div>
    </body>
</html>