<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/config_coin.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . $_PATH . '/admin/redirect.php');

$link = obrirBD();


$url = explode("/", $_SERVER['PHP_SELF']);
$menu = $url[count($url) - 2];
?>



<table id="menu" cellpadding="0" cellspacing="0">


    <tr class="first <?php if ($menu == "stats") echo "active"; ?>">
        <td>
            <a href="<?php echo $_PATH . "/admin/coin/stats"; ?>">
               NO Stats 
            </a>
        </td>
    </tr>

    <tr class="<?php if ($menu == "client") echo "active"; ?>">
	<td>
	    <a href="<?php echo $_PATH . "/admin/coin/client"; ?>">
		Clients 
	    </a>
	</td>
    </tr> 

 
    <tr class="<?php if ($menu == "pay") echo "active"; ?>">
	<td>
	    <a href="<?php echo $_PATH . "/admin/coin/pay"; ?>">
		Payments  
	    </a>
	</td>
    </tr>
    <tr class="last <?php if ($menu == "auction") echo "active"; ?>">
	<td>
	    <a href="<?php echo $_PATH . "/admin/coin/auction"; ?>">
		Auctions 
	    </a>
	</td>
    </tr>


</table>



<?php
tancarBD($link);
?>
