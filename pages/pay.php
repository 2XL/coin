<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/config_coin.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . $_PATH . '/pages/redirect.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . $_PATH . '/bd/bd_auction.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . $_PATH . '/bd/bd_lang.php');
require ($_SERVER['DOCUMENT_ROOT'] . $_PATH . '/controller/include/language.php');
?> 
<!DOCTYPE html>  
<html>
    <head>
	<title>My Coin Pay</title>
	<?php require_once ($_SERVER['DOCUMENT_ROOT'] . $_PATH . '/view/head.php'); ?>
    </head>
    <body>


	<!-- top : header --> 
	<?php require ($_SERVER['DOCUMENT_ROOT'] . $_PATH . '/view/menu.php'); ?>


	<?php
	$id_user = $_COOKIE['iduser'];
	$link = obrirBD();
	$list_pays = getPaysByUser($id_user, $link);
	tancarBD($link);
	?> 



        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">

		    <?php foreach ($list_pays as $pay) { ?>
    		    <div class="list-group <?php
			if ($pay['ispaid'] == 1) {
			    echo 'checked';
			}
			?> " onclick="window.location.href = 'pay.php?idpay=<?php echo $pay['id_pay']; ?>&topay=<?php echo $pay['to_pay']; ?>'"> 
    			<a href="#" class="list-group-item">
    			    <h4 class="list-group-item-heading">
				    <?php echo $pay['title']; ?>
    			    </h4> 
    			    <p class="list-group-item-text">
    				<img class="img-responsive center-block" src="<?php echo $pay['path']; ?>" alt="<?php echo $pay['picname']; ?>" >
    			    </p>
    			</a> 
    		    </div>
		    <?php } ?> 

                </div>
		<?php if (isset($_GET['idpay']) && isset($_GET['topay'])) { ?>
    		<div class="col-lg-9 col-md-9 col-sm-9">
    		    <div class="list-group">
    			<div class="list-group">
    			    <div class='list-group-item'>
				    <?php echo $label['pay_gateway']; ?>
    			    </div> 
    			    <div class="list-group-item">

				    <?php echo $label['auction_result']; ?>: 
    				<strong><?php
					echo $_GET['topay'];
					?></strong>
    				cent
    			    </div> 
    			    <div class="list-group-item"> 
    				1<?php echo $label['auction_interes']; ?>: 
    				<strong><?php
					$paytoweb = ceil($_GET['topay'] * 0.01);
					echo $paytoweb;
					?></strong>
    				cent     
    			    </div> 
    			    <div class='list-group-item'>
				    <?php echo $label['total_to_pay']; ?>:
    				<strong><?php
					$totaltopay = $_GET['topay'] + $paytoweb;
					echo $totaltopay;
					?></strong> cent
    			    </div>
    			</div>


    			<br>


    			<form method='post' action='<?php echo $_PATH; ?>/controller/update/update_pay.php'>
    			    <input type='hidden' name='id_pay' value='<?php echo $_GET['idpay']; ?>'>
    			    <input type='hidden' name='total' value='<?php echo $totaltopay; ?>'>
    			    <button type='submit' name="return" value="<?php echo $_GET['idpay']; ?>" class='btn btn-primary'>
				    <?php echo $button['pay_paypal']; ?>
    			    </button>
    			</form>


    			<form name="_xclick" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
    			    <input type="hidden" name="cmd" value="_xclick">
    			    <input type="hidden" name="business" value="xl16salou-facilitator@gmail.com">
    			    <input type="hidden" name="currency_code" value="EUR">
    			    <input type="hidden" name="item_name" value="<?php echo $pay['title']; ?>">
    			    <input type="hidden" name="amount" value="<?php echo $totaltopay / 100; ?>">
    			    <input type="hidden" name="rm" value="2">
    			    <input type="hidden" name="notify_url" value="http://stacktracks.com/coin/controller/update/update_pay.php?notify">
    			    <input type="hidden" name="return" value="http://stacktracks.com/coin/controller/update/update_pay.php?return=<?php echo $_GET['idpay']; ?>"> <!-- path cas de ok -->
    			    <input type="hidden" name="cancel_return" value="http://stacktracks.com/coin/controller/update/update_pay.php?cancel=<?php echo $_GET['idpay']; ?>"> <!-- path cas de fallo pero se genera el payment igual ment o se recarrega la pagina de pagament-->
    			    <input type="image" src="http://www.paypalobjects.com/es_XC/i/btn/btn_buynow_LG.gif" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!">
    			</form>


			    <?php ?>
    		    </div>
    		</div>
		<?php }
		?>
	    </div>
	    <!-- bottom : footer -->
	    <div class='container'> 
		<!-- alert message -->
		<?php if (isset($_GET['error'])) { ?> 
    		<div class="alert-box" style="">
    		    <div class="alert alert-danger" >
    			<a href="#" class="close" data-dismiss="alert">&times;</a>
    			<strong><?php echo $alert['warning']; ?></strong>
    			Payment Failed
    		    </div>
    		</div>
		<?php } else if (isset($_GET['success'])) {
		    ?>
    		<div class = "alert-box" style = "">
    		    <div class = "alert alert-success" >
    			<a href = "#" class = "close" data-dismiss = "alert">&times;
    			</a>
    			<strong><?php echo $alert['note']; ?></strong>
    			Payment Succeed   
    		    </div>
    		</div>
		<?php }
		?>
	    </div>
	    <!-- bottom : footer --> 
	    <?php require ($_SERVER['DOCUMENT_ROOT'] . $_PATH . '/view/footer.php'); ?>

	</div>
	<!-- modal : -->

	<?php require $_SERVER['DOCUMENT_ROOT'] . $_PATH . '/view/contact.php'; ?>


	<script src="<?php echo $_PATH; ?>/js/jquery-1.11.0.min.js"></script>
	<script src="<?php echo $_PATH; ?>/js/bootstrap.js"></script>
    </body>
</html>



<script type="text/javascript">


			    /** 
			     * user jquery to update the selected filters from server post parameters or get whatever...
			     **/



</script>




<?php





