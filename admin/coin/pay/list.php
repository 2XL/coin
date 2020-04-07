<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/config_coin.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . $_PATH . '/admin/redirect.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . $_PATH . '/bd/bd_admin.php');
 
$link = obrirBD();
$list_pay = getAllPays($link);

?>
<!--
<h5>
list pay
</h5>
<pre>
<?php print_r($list_pay); ?>
</pre>
-->
<table class="table_list">
    <caption>
	Manage pays
    </caption>
    <thead>
	<tr>
	    <td>
		id_bid
	    </td>
	    <td>
		id_pay
	    </td>
	    <td>
		value
	    </td>
	    <td>
		ispaid
	    </td>  
	    <td>
		id_auction
	    </td>
	    <td>
		edit
	    </td>
	</tr>
    </thead>
    <tbody>
	<?php
	if (isset($list_pay)) {
	    foreach ($list_pay as $pay) {
		?>
		<tr>
		    <td>
			<?php echo $pay['id_bid']; ?>
		    </td>
		    <td>
			<?php echo $pay['id_pay']; ?>
		    </td>
		    <td>
			<?php echo $pay['value']; ?>
		    </td>
		    <td>
			<?php echo $pay['ispaid']; ?>
		    </td>  
		    <td>
			<?php echo $pay['id_bid_auction']; ?>
		    </td>
		    <td>
			<a href="index.php?id=<?php echo $pay['id_pay']; ?>">
			    <img src="<?php echo $_PATH . '/admin/images/icons/icon-edit.png'; ?>"  />
			</a>
		    </td>
		</tr>
		<?php
	    }
	}
	?>
    </tbody> 
</table>