<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/config_coin.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . $_PATH . '/admin/redirect.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . $_PATH . '/bd/bd_admin.php');


$link = obrirBD();
$list_auction = getAllAuctions($link);
?>
<!--
<pre>
<?php print_r($list_auction); ?>
</pre>

<h5>
list auction
</h5>

    [id_auction] => 34
    [id_user] => 7
    [current_bid] => 15
    [title] => 50 centimos holandes 1999
    [date_start] => 2014-05-03
    [date_end] => 2014-05-30
    [date_create] => 2014-05-03 18:37:07
    [value_starting] => 10000
    [value_reserve] => 100
    [active] => 1
    [type] => 1
    [min_bids] => 12

-->

<table class="table_list">
    <caption>
	Manage auctions
    </caption>
    <thead>
	<tr>
	    <td>
		title
	    </td>
	    <td>
		active
	    </td>
	    <td>
		min_bids
	    </td> 
	    <td>
		value_starting
	    </td>
	    <td>
		date_create
	    </td> 
	    <td>
		edit
	    </td>
	</tr>
    </thead>
    <tbody>
	<?php
	if (isset($list_auction)) {
	    foreach ($list_auction as $auction) {
		?>
		<tr>
		    <td>
			<?php echo $auction['title']; ?>
		    </td>
		    <td>
			<?php echo $auction['active']; ?>
		    </td>
		    <td>
			<?php echo $auction['min_bids']; ?>
		    </td>
		    <td>
			<?php echo $auction['value_starting']; ?>
		    </td>  
		    <td>
			<?php echo $auction['date_create']; ?>
		    </td> 
		    <td>
			<a href="index.php?id=<?php echo $auction['id_auction']; ?>">
			    <img src="<?php echo $_PATH . '/admin/images/icons/icon-edit.png'; ?>"  />
			</a>
		    </td>
		</tr>
		<?php
	    }
	}
	?>
    </tbody> 
    <tfoot>

    </tfoot>
</table>



<?php
tancarBD($link);
