<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/config_coin.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . $_PATH . '/admin/redirect.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . $_PATH . '/bd/bd_admin.php');



if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

$link = obrirBD();
$client = getUserById($id, $link);
?>

<!--
<h5>
    form client
</h5>
<pre>
<?php print_r($client); ?>
</pre>
-->

<form id="updateclient" action="save_client.php" method="post">
    <table class="table_edit">
	<caption>
	    Edit Client
	</caption>

	<tr>
	    <td>
		id user
	    </td>
	    <td>
		<input type="hidden" name="id_user" value="<?php echo $client['id_user']; ?>">
		<?php echo $client['id_user']; ?>
	    </td>
	</tr>
	<tr>
	    <td>
		name
	    </td>
	    <td>
		<input type="text" name="name" value="<?php echo $client['name']; ?>">
	    </td>
	</tr>
	<tr>
	    <td>
		surename
	    </td>
	    <td>
		<input type="text" name="surename" value="<?php echo $client['surename']; ?>">
	    </td>
	</tr>
	<tr>
	    <td>
		civilstatus
	    </td>
	    <td> 
		<select name="civilstatus" form="updateclient"> 
		    <option value="single" <?php
		    if ($client['civilstatus'] == 'single') {
			echo 'selected="selected"';
		    }
		    ?>>Single</option>
		    <option value="widowed" <?php
		    if ($client['civilstatus'] == 'widowed') {
			echo 'selected="selected"';
		    }
		    ?>>Widowed</option>
		    <option value="divorced" <?php
		    if ($client['civilstatus'] == 'divorced') {
			echo 'selected="selected"';
		    }
		    ?>>Divorced</option>
		    <option value="married" <?php
		    if ($client['civilstatus'] == 'married') {
			echo 'selected="selected"';
		    }
		    ?>>Married</option>
		</select>
	    </td>
	</tr>
	<tr>
	    <td>
		quest
	    </td>
	    <td>
		<input type="text" name="quest" value="<?php echo $client['quest']; ?>">
	    </td>
	</tr>
	<tr>
	    <td>
		quest answer
	    </td>
	    <td>
		<input type="text" name="qanswer" value="<?php echo $client['qanswer']; ?>">
	    </td>
	</tr> 
	<tr>
	    <td>
		is admin
	    </td>
	    <td>
		<input type="checkbox" name="is_admin" value="1" <?php
		if ($client['is_admin'] == 1) {
		    echo ' checked ';
		}
		?> 
		       >
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
	document.forms['updateclient'].submit();
    }
</script>

<?php
tancarBD($link);
