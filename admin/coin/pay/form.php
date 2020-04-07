<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/config_coin.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . $_PATH . '/admin/redirect.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . $_PATH . '/bd/bd_admin.php');



$link = obrirBD();
$pay = getPayById($_GET['id'], $link);



?>


 


<form id="updatepay" action="save_pay.php" method="post">
    <table class="table_edit">
	
	<input type="hidden" name="id_pay" value="<?php echo $pay['id_pay']; ?>">
	
	<caption>
	    Edit pay
	</caption>
	
	<tr>
	    <td>
		is paid?
	    </td>
	    <td>
		<input type="checkbox" name="ispaid" <?php if($pay['ispaid'] == 1){ echo 'checked';} ?>>
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
	document.forms['updatepay'].submit();
    }
</script>

<?php
tancarBD($link);
