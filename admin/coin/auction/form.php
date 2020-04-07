<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/config_coin.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . $_PATH . '/admin/redirect.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . $_PATH . '/bd/bd_admin.php');


if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
$link = obrirBD();
$auction = getAuctionById($id, $link);
?>
<!--
<h5>
    form auction
</h5>
<pre>
    <?php print_r($auction); ?>
</pre>
-->
<form id="updateauction" action="save_auction.php" method="post">
    <table class="table_edit">
	<caption>
	    Edit Auction
	</caption>
	<tr>
	    <td>
		id auction
	    </td>
	    <td>
		<input type="hidden" name="id_auction" value="<?php echo $auction['id_auction']; ?>">
		<?php echo $auction['id_auction']; ?>
	    </td>
	</tr> 
	<tr>
	    <td>
		title
	    </td>
	    <td>
		<input type="text" name="title" value="<?php echo $auction['title']; ?>">
	    </td>
	</tr>
	<tr>
	    <td>
		date start
	    </td>
	    <td>
		<input type="date" name="date_start" value="<?php echo $auction['date_start']; ?>">
	    </td>
	</tr>
	<tr>
	    <td>
		date end
	    </td>
	    <td>
		<input type="date" name="date_end" value="<?php echo $auction['date_end']; ?>">
	    </td>
	</tr>
	<tr>
	    <td>
		value starting
	    </td>
	    <td>
		<input type="text" name="value_starting" value="<?php echo $auction['value_starting']; ?>">
	    </td>
	</tr>
	<tr>
	    <td>
		value reserve
	    </td>   
	    <td>
		<input type="text" name="value_reserve" value="<?php echo $auction['value_reserve']; ?>">
	    </td>
	</tr>
	<tr>
	    <td>
		submit
	    </td>
	    <td>
		<a class="button-blue"  href="javascript:submitForm()">Update!</a>
	    </td>
	</tr>

    </table>
</form>







<script type="text/javascript" >
    function submitForm()
    {
	document.forms['updateauction'].submit();
    }
</script>



<?php
tancarBD($link);
