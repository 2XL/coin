<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/config_coin.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . $_PATH . '/pages/redirect.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . $_PATH . '/bd/bd_lang.php');
require ($_SERVER['DOCUMENT_ROOT'] . $_PATH . '/controller/include/language.php');
?>

<!DOCTYPE html> 
<html>
    <head>
	<title>My Coin Auction</title>
	<?php require_once ($_SERVER['DOCUMENT_ROOT'] . $_PATH . '/view/head.php'); ?>
    </head>
    <body>

        <!-- top : header --> 
	<?php require ($_SERVER['DOCUMENT_ROOT'] . $_PATH . '/view/menu.php'); ?> 

        <!-- middle : body -->
        <div class="container"> 
            <!--
		body : header
                create a form to insert a new auction 
            -->
            <div class="row">
                <div class="col-lg-9">
		    <!--   
			<form id="createAuction" name="auction" enctype="multipart/form-data" action="" method="post"> 
		    -->
		    <form id="createAuction" name="auction" enctype="multipart/form-data" action="<?php echo $_PATH; ?>/controller/create/create_auction.php" method="post"> 

                        <input type="hidden" name="id_user" value="<?php echo $_COOKIE['iduser']; ?>">

                        <div class="form-group">
                            <label for="formTitle"> 
				<?php echo $label['title']; ?>
                            </label>
                            <input required class="form-control" type="text"  name="title" id="formTitle" placeholder="<?php echo $placeholder['title']; ?>">
                        </div>

                        <div class="form-group">
                            <label for="formDStart"><?php echo $label['date_start']; ?></label> 
                            <input required class="form-control" type="date" name="dStart" id="formDStart" value="<?php
			    if (strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') !== false) {
				echo (date("Y-m-d")); // chrome
			    } else {
				echo (date("d-m-Y")); // firefox
			    }
			    ?>" placeholder="<?php echo $placeholder['date_start']; ?>"> 
                        </div> 
                        <div class="form-group">
			    <label for="formDEnd"><?php echo $label['date_end']; ?></label>      
                            <input required class="form-control" type="date" name="dEnd" id="formDEnd" value="<?php
			    if (strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') !== false) {
				echo (date("Y-m-d"));
			    } else {
				echo (date("d-m-Y"));
			    }
			    ?>" placeholder="<?php echo $placeholder['date_end']; ?>"> 
                        </div>  
			<div class="form-group">
                            <label for="formReserve"><?php echo $label['value_reserve']; ?></label>
                            <input required class="form-control" type="number" name="rValue" id="formRValue" value="1" placeholder="<?php echo $placeholder['value_reserve']; ?>">
                        </div>
			<div class="form-group">
			    <label for="formMinBid"><?php echo $label['bid_intents']; ?></label>
			    <input required class="form-control" type="number" name="mBidNum" id="formMinBid" value="1" placeholder="<?php echo $placeholder['bid_intents']; ?>">
			</div>
                        <div class="form-group">
                            <label for="formImage"><?php echo $label['image']; ?></label>
                            <input required type="file" class="form-control" name="image" id="formImage" >
                        </div>
                        <div class="form-group"> 
                            <label for="formType"><?php echo $label['type_auction']; ?></label>
                            <br>
                            <div class="btn-group" data-toggle="buttons"  >

                                <label class="btn btn-default active">
                                    <input type="radio" name="type" value="1" checked=""><?php echo $label['american']; ?>
                                </label> 
                            </div> 
                        </div> 

                        <div class="form-group">
                            <label for="formSubmit"><?php echo $label['publish']; ?></label>
                            <button class="btn btn-primary" id="formSubmit" type="submit">
				<?php echo $button['auction_publish']; ?>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-3">

                </div>
            </div>


	    <!-- bottom : alert -->
	    <div class="row">
		<?php if (isset($_GET['success'])) { ?>
    		<div class = "alert-box" style = "">
    		    <div class = "alert alert-success" >
    			<a href = "#" class = "close" data-dismiss = "alert">&times;
    			</a>
    			<strong><?php echo $alert['note']; ?></strong>
			    <?php
			    echo $alert['success_auction_create'];
			    ?>
    		    </div>
    		</div>
		<?php } ?>

		<?php if (isset($_GET['error'])) { ?> 
    		<div class="alert-box" style="">
    		    <div class="alert alert-danger" >
    			<a href="#" class="close" data-dismiss="alert">&times;</a>
    			<strong><?php echo $alert['warning']; ?></strong>
			    <?php
			    echo $alert['error_auction_create'];
			    ?>
    		    </div>
    		</div>
		<?php } ?>
	    </div>
	    <!--bottom : footer -->
	    <?php require ($_SERVER['DOCUMENT_ROOT'] . $_PATH . '/view/footer.php'); ?>
	</div>


	<!-- modal : -->
	<?php require $_SERVER['DOCUMENT_ROOT'] . $_PATH . '/view/contact.php'; ?>
	<script src="<?php echo $_PATH; ?>/js/jquery-1.11.0.min.js"></script>
	<script src="<?php echo $_PATH; ?>/js/bootstrap.js"></script>
    </body>
</html>


<script type="text/javascript">
    $("#formTitle").on("focusout", function() {
	if ($("#formTitle").val() === '')
	{
	    alert('title cant be undefined');
	    $("#formDStart").attr("disabled", true);
	}
	else
	{
	    $("#formDStart").attr("disabled", false);
	    $("#formDEnd").attr("disabled", false);
	    $("#formMinBid").attr("disabled", false);
	    $("#formRValue").attr("disabled", false);
	}
    });
 
    function ValidateDate(dtValue)
    {
	var dtRegex = new RegExp(/\b\d{1,2}[\/-]\d{1,2}[\/-]\d{4}\b/);
	return dtRegex.test(dtValue);
    }
</script>









