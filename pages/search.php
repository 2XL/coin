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
	   <title>My Coin Search</title>
	<?php require_once ($_SERVER['DOCUMENT_ROOT'] . $_PATH . '/view/head.php'); ?>
    </head>
    <body>

	<!-- top : header -->

	<?php require ($_SERVER['DOCUMENT_ROOT'] . $_PATH . '/view/menu.php'); ?>

        <!-- middle : body -->
        <div class="container">                   
            <div class="row">
                <div class="col-xs-4">
                    <div class="row"> 
                        <form id="auctionFilter" method="post" name="aFilterForm" action="search.php" >
                            <div class="form-group">
                                <label for="formTitle">
				    <?php echo $label['title']; ?>
                                </label>
                                <input type="text" class="form-control" name="title" id="formTitle" placeholder="<?php echo $placeholder['title']; ?>"> 
                            </div>
                            <div class="form-group">
                                <label for="formDPublish">
				    <?php echo $label['date_publish_since']; ?> 
                                </label>
                                <input type="date" class="form-control" name="dPublish" id="formDPublish" value="1901-12-13" placeholder="spec auction publication">
                            </div>
                            <div class="form-group">
                                <label for="formDClosure">
				    <?php echo $label['date_closure_until']; ?> 
                                </label>
                                <input type="date" class="form-control" name="dClosure" id="formDClosure" value="2038-01-19" placeholder="spec auction closure" >
                            </div>
                            <div class="form-group">
                                <label for="formDCreation">
				    <?php echo $label['date_create_since']; ?> 
                                </label>
                                <input type="date" class="form-control" name="dCreation" id="formDCreation" value="<?php echo date('Y-m-d', time()) ?>" placeholder="spec auction creation" >
                            </div>
                            <div class="form-group">
                                <label for="formMinValue">
				    <?php echo $label['value_min_bid']; ?> 
                                </label>
                                <input type="number" class="form-control" name="vMin" value="0" id="formMinValue" placeholder="set an starting value">
                            </div>
                            <div class="from-group">
                                <label for="formMaxValue">
				    <?php echo $label['value_max_bid']; ?> 
                                </label>
                                <input type="number" class="form-control" name="vMax" value="1000000" id="formMaxValue" placeholder="set a maximum value">
                            </div>  
			    <input type="hidden" name="type" value="1" >

			    <br>
                            <div class="form-group">
                                <label for="formSubmit"><?php echo $label['submit']; ?> </label>
                                <button class="btn btn-primary" id="formSubmit" type="submit">
				    <?php echo $button['filter']; ?> 
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-xs-8">
                    <!-- utilitzar com un marge lateral entre les dues zones -->
                </div>

            </div>
	    <hr>
            <div class="row">
                <div class="col-xs-12">
                    <!-- llistar totes les entrades, resultat de bd aplicant filtre utilitzant els parametres de filtratge y identificador del usari y bids aplostant -->

                    <div class="row">
                        <!-- filter result --> 
                        <div> 
                            <h3>
				<?php echo $label['result']; ?> : 
                            </h3>
                        </div>
                        <!-- do php -->  

			<?php
			if (isset($_REQUEST['title'])) {


			    $id_user = $_COOKIE['iduser'];
			    $title = $_REQUEST['title'];

			    $dPublish = $_REQUEST['dPublish'];
			    $dClosure = $_REQUEST['dClosure'];
			    $dCreation = $_REQUEST['dCreation'];

			    $vMax = $_REQUEST['vMax'];
			    $vMin = $_REQUEST['vMin'];

			    $type = $_REQUEST['type'];
			    /*
			      echo '<pre>';
			      print_r($_REQUEST);
			      echo '</pre>';
			     */
			    $link = obrirBD();
			    $result = getSearchAuctionByFilter($id_user, $title, $dPublish, $dClosure, $dCreation, $vMax, $vMin, $type, $link);
			    $length = count($result);
			    if ($length == 0) {
				echo '<br>0 ' . $label['result_found'] . '...';
			    } else {
				echo '<br>' . $length . ' ' . $label['result_found'] . ': ';
			    }

			    $numCols = 4;
			    $cols = $length % $numCols;
			    $rows = $length / $numCols;
			    $index = 0;
			    ?>


    			<form name="formAuctionFollow" action="<?php echo $_PATH; ?>/controller/create/create_auction_follow.php" method="post"> 
    			    <div class="row">
    				<button  class="btn btn-primary" type="submit"><?php echo $button['submit']; ?> </button> 
    			    </div>
				<?php for ($i = 0; $i < $rows; $i++) { ?>

				    <div class="row"> 
					<?php for ($j = 0; $j < $numCols; $j++) { ?>
	    				<div class="col-sm-3 col-lg-3" >
	    				    <img class="img-responsive center-block" src="<?php echo $result[$index]['path']; ?>" alt="<?php echo $result[$index]['title']; ?>" >
	    				    <p><?php echo $result[$index]['title']; ?></p>
	    				    <input type="checkbox" name="<?php echo $index; ?>" value="<?php echo $result[$index]['id_auction']; ?>" >
	    				</div>
					    <?php
					    $index++;
					    if ($index === $length) {
						break;
					    }
					}
					?> 
				    </div>

				<?php } ?>
    			    <div class="row">
    				<button class="btn btn-primary" type="submit" name=""><?php echo $button['submit']; ?></button> 
    			    </div>
    			</form>

			    <?php
			} else {
			    echo '<br>please submit the filter';
			}
			?>
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
    </body>
</html>

<?php tancarBD($link); ?>

<script type="text/javascript">


    /** 
     * user jquery to update the selected filters from server post parameters or get whatever...
     **/



</script>









