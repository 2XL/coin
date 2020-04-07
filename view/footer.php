 
<div class = "navbar navbar-default navbar-fixed-bottom">
    <div class = "container">
	<p class = "navbar-text pull-left">
	    <?php echo $button['subscribe'];
	    ?>
	</p> 
	<a class="navbar-btn btn-warning btn">  <?php echo $button['subscribe']; ?></a> 
	<?php if (isset($_COOKIE['iduser'])) { ?>
    	<a class="navbar-btn btn btn-danger  pull-right" id="logOutButton" onclick="window.location.href = '<?php echo $_PATH; ?>/logout.php'">
		<?php echo $button['logout']; ?>
    	</a> 
	<?php } ?>
    </div>
</div>