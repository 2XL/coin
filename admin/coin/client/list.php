<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/config_coin.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . $_PATH . '/admin/redirect.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . $_PATH . '/bd/bd_admin.php');


$link = obrirBD();
$list_client = getAllUsers($link);
?>


<!--
<pre>
<?php print_r($list_client); ?>
</pre>
-->
<table class="table_list">
    <caption>
	Manage clients
    </caption>
    <thead>
	<tr>
	    <td>
		name
	    </td>
	    <td>
		surename
	    </td>
	    <td>
		civilstatus
	    </td>
	    <td>
		dni
	    </td>  
	    <td>
		email
	    </td>
	    <td>
		edit
	    </td>
	</tr>
    </thead>
    <tbody>
	<?php
	if (isset($list_client)) {
	    foreach ($list_client as $client) {
		?>
		<tr>
		    <td>
			<?php echo $client['name']; ?>
		    </td>
		    <td>
			<?php echo $client['surename']; ?>
		    </td>
		    <td>
			<?php echo $client['civilstatus']; ?>
		    </td>
		    <td>
			<?php echo $client['dni']; ?>
		    </td>  
		    <td>
			<?php echo $client['email']; ?>
		    </td>
		    <td>
			<a href="index.php?id=<?php echo $client['id_user']; ?>">
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


<?php
tancarBD($link);
