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
	<title>My Coin Bid</title>
<?php require_once ($_SERVER['DOCUMENT_ROOT'] . $_PATH . '/view/head.php'); ?>
    </head>
    <body>

        <!-- top : header -->

<?php require ($_SERVER['DOCUMENT_ROOT'] . $_PATH . '/view/menu.php'); ?>
	<?php
	$link = obrirBD();
	$id_user = $_COOKIE['iduser'];
	if (isset($_GET['auction'])) {
	    //  echo 'has bid';
	    $id_auction = $_GET['auction'];
	    $auction = getAuctionByID($id_auction, $link);
	    // load menu data
	} else {
	    //  echo 'no auction selected'; 
	}

	$result = getFollowingAuctionByUserID($id_user, $link);
	?>
        <!-- middle : body -->
        <div class="container">
            <div class="row">
                <!-- list al current following auction's // implementar un onclick redirect -->
                <div class="col-lg-3 col-md-3 col-sm-3">
<?php foreach ($result as $coin) { ?>
    		    <div class="list-group" onclick="window.location.href = 'bid.php?auction=<?php echo $coin['id_auction']; ?>'"> 
    			<a href="#" class="list-group-item">
    			    <h4 class="list-group-item-heading">
    <?php echo $coin['title']; ?>
    			    </h4> 
    			    <p class="list-group-item-text">
    				<img class="img-responsive center-block" src="<?php echo $coin['path']; ?>" alt="<?php echo $coin['title']; ?>" >
    			    </p>
    			</a> 
    		    </div>
<?php } ?>
                </div>
                <!-- show onclick option menu for action bid, redirected by get and display form menu -->
                <div class="col-lg-9 col-md-9 col-sm-9">
                    <div class="list-group">
                        <a href="#" class="list-group-item"> 
			    <div class="list-group-item-heading">
<?php
if (isset($_GET['auction'])) {

    $bidable = 0;
    $current_id_bid = ($auction['current_bid'] === null) ? null : $auction['current_bid'];
    ?>
    				<p><?php echo $label['title']; ?>: <?php echo $auction['title']; ?></p> 
    				<br>
    				<p><?php echo $label['current_bid']; ?>: <?php echo $current_id_bid === null ? 'nobody' : $current_id_bid; ?></p>
    <?php
    $datetime1 = new DateTime("now");
    $datetime2 = new DateTime($auction['date_end']);
    $interval = $datetime1->diff($datetime2);
    $deadline = $interval->format('%R%a');
    ?> 
    				<p><?php echo $label['time_left']; ?>: <?php echo $interval->format('%R%a ') . $label['days']; ?> </p>
    				<p><?php echo $label['value_reserve']; ?>: <?php
				$current_winner = "";
				echo $auction['value_starting'];
				if ($current_id_bid === null) {

				    $current_winner = $label['nobody'];
				} else {
				    $current_bid = getBidByID($current_id_bid, $link);
				    if ($id_user === $current_bid['id_user']) {
					$current_winner = $label['me'];
				    } else {
					$current_winner = $label['other'];
				    }
				}
    ?> 
    				</p>
    				<p>
    <?php echo $label['current_winner']; ?>: 
					<?php
					echo $current_winner;
					?>
    				</p>
				    <?php } ?>
			    </div>
			    <hr> 
<?php
$canBid = false;
if (isset($_GET['auction']) && $deadline >= 0) {
    if ($current_id_bid !== null) {
	$bid = getBidByID($current_id_bid, $link);
	if ($bid['id_user'] === $id_user) {
	    $canBid = false;
	} else {
	    $canBid = true;
	}
    } else {
	$canBid = true;
    }
    ?>
    			    <h4>
    				<p>
    <?php echo $label['current_bid_counter']; ?>: 
					<?php
					$currentBidsCount = countAuctionBids($auction['id_auction'], $link);
					echo $currentBidsCount . '/' . $auction['min_bids'];
					$stillBidable = ($currentBidsCount == $auction['min_bids']) ? 0 : 1;
					if ($canBid && $currentBidsCount < $auction['min_bids']) {
					    $canBid = true;
					} else {
					    $canBid = false;
					}
					?>
    				</p>
    			    </h4> 

    			    <hr>
    			    <form name="formAuctionBid" method="POST" action="<?php echo $_PATH; ?>/controller/create/create_auction_bid.php">
    				<input type="hidden" name="id_user" value="<?php echo $id_user; ?>">
    				<input type="hidden" name="id_auction" value="<?php echo $auction['id_auction']; ?>">
    				<input type="hidden" name="type" value="<?php echo $auction['type']; ?>">
    				<!-- el precio va bajando pero en el caso que llegue a este yo lo aceptare -->
    				<div class="form-group">
    				    <label for="formCurrentValue">
    <?php echo $label['current_raise']; ?>
    				    </label>
    				    <input class="form-control" type="number" name="curValue" id="formCurrentValue" value="<?php
    $currentRaise = $current_id_bid === null ? 0 : $current_bid['value'];
    echo $currentRaise;
    ?>" disabled>
    				</div>
					       <?php if ($canBid) { ?>
					<div class="form-group"> 
					    <label for="formMyAmount"><?php echo $label['amount_to_raise']; ?></label> 
					    <input class="form-control" type="number" name="myValue" id="formMyAmountToRaise" value="<?php echo $currentRaise + 1; ?>">
					    <!-- current + minimum -->
					</div>
					<div class="form-group"> 
					    <label for="formBtn" ><?php echo $label['commit_bid']; ?></label>
					    <button type="submit" id="commitBidBtn" class="btn btn-primary">
	<?php echo $button['submit']; ?>
					    </button> 
					</div>
    <?php } ?>
    			    </form> 
				    <?php
				} else {
				    // echo '<br>none bidable...';
				    // check if has bidder if yes then the last by date is the winner els none
				}
				if (isset($deadline)) {
				    if ((isset($current_bid) && $id_user === $current_bid['id_user'])) {
					$id_bid = $current_bid['id_bid'];
					if ((isset($stillBidable) && $stillBidable == 0)) {
					    echo '<h1>' . $label['auction_win_limit'] . '</h1>';
					    $payment = getBidPaidByIdBid($id_bid, $link);
					    if (isset($payment['0']) && $payment['0']['ispaid'] == 1) {
						echo '<div class="text-success"><h2>' . $label['paid_true'] . '</h2></div>';
					    } else {
						echo '<form method="post" action="' . $_PATH . '/controller/create/create_pay.php" ><button class="btn btn-success" id="payBid" name="id_bid" value=' . $id_bid . '>' . $label['paid_false'] . '</button></form>';
					    }
					} else if ($deadline < 0) {
					    echo '<h1>' . $label['auction_win_deadline'] . '</h1>';

					    $payment = getBidPaidByIdBid($id_bid, $link);

					    if (isset($payment['0']) && $payment['0']['ispaid'] == 1) {
						echo '<div class="text-success"><h2>' . $label['paid_true'] . '</h2></div>';
					    } else {
						echo '<form method="post" action="' . $_PATH . '/controller/create/create_pay.php" ><button class="btn btn-success" id="payBid" name="id_bid" value=' . $id_bid . '>' . $label['paid_false'] . '</button></form>';
					    }
					}
				    } else {
					if ($deadline < 0 || (isset($stillBidable) && $stillBidable == 0)) {
					    echo '<h1>Closed</h1>';
					}
				    }
				}
				?>
			    </p> 
			</a> 
		    </div>
		</div>
	    </div>



	    <!-- bottom : alert -->


	    <!-- bottom : footer --> 
<?php require ($_SERVER['DOCUMENT_ROOT'] . $_PATH . '/view/footer.php'); ?>

        </div> 



	<!-- modal : -->

<?php require $_SERVER['DOCUMENT_ROOT'] . $_PATH . '/view/contact.php'; ?>
	<script src="<?php echo $_PATH; ?>/js/jquery-1.11.0.min.js"></script>
	<script src="<?php echo $_PATH; ?>/js/bootstrap.js"></script>
<?php tancarBD($link); ?>
    </body>
</html>

<script type="text/javascript">
			$("#formMyAmountToRaise").on("focusout", function() {
			    if ($('#formMyAmountToRaise').val() > $('#formCurrentValue').val()) {
				$("#commitBidBtn").attr("disabled", false);
			    } else {
				alert("Fail: the raisen amount has to be greater than " + $('#formCurrentValue').val());
				$("#commitBidBtn").attr("disabled", true);
			    }
			});

			$("#payBid").on("click", function() {

			});

</script>

