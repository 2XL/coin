 
<?php
$menu_active = ucfirst(pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME));
// echo $menu_active.' '.$lang;
?>

<div class="navbar navbar-inverse navbar-static-top"> 
    <div class="container"> 
	<a href="<?php echo $_PATH . '/index.php'; ?>" class="navbar-brand">BidCoin</a>
	<button class="navbar-toggle" data-toggle="collapse" data-target=".navHeaderCollapse"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
	<div class="collapse navbar-collapse navHeaderCollapse">

	    <ul class="nav navbar-nav navbar-right"> 
		<?php if (isset($_COOKIE['iduser'])) { ?>
    		<li <?php if ($menu_active == 'Pay') {
		    echo 'class="active"';
		} ?> ><a href="<?php echo $_PATH . '/pages/pay.php'; ?>" ><?php echo $menu['mycoin']; ?></a></li>
    		<li <?php if ($menu_active == 'Search') {
		    echo 'class="active"';
		} ?> ><a href="<?php echo $_PATH . '/pages/search.php'; ?>"><?php echo $menu['search']; ?></a></li>
    		<li <?php if ($menu_active == 'Bid') {
		    echo 'class="active"';
		} ?> ><a href="<?php echo $_PATH . '/pages/bid.php'; ?>"><?php echo $menu['bid']; ?></a></li>
    		<li <?php if ($menu_active == 'Auction') {
		    echo 'class="active"';
		} ?> ><a href="<?php echo $_PATH . '/pages/auction.php'; ?>"><?php echo $menu['auction']; ?></a></li>
<?php } else { ?>

<?php } ?>
		<li><a href="#contact" data-toggle='modal'><?php echo $menu['contact']; ?></a></li>
		<li class="dropdown">

		    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $menu['social']; ?><b class="caret"></b></a>
		    <ul class="dropdown-menu">
			<li><a href="#">Twitter</a></li>
			<li><a href="#">Facebook</a></li>
			<li><a href="#">Google+</a></li>
			<li><a href="#">Instagram</a></li>
		    </ul>
		</li> 
		<li class="dropdown"> 
		    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $menu['lang']; ?><b class="caret"></b></a>  
		    <ul class="dropdown-menu">
			<li <?php
			    if ($lang == 'eng') {
				echo 'class="active"';
			    }
			    ?>><a href="?lang=eng">English</a></li>
			<li <?php
			    if ($lang == 'esp') {
				echo 'class="active"';   
			    }
			    ?>><a href="?lang=esp">Spanisha</a></li> 
			<li <?php
			    if ($lang == 'cat') {
				echo 'class="active"';
			    }
			    ?>><a href="?lang=cat">Catala</a></li> 
			<li <?php
			    if ($lang == 'tst') {
				echo 'class="active"';
			    }
			    ?>><a href="?lang=tst">Chineese</a></li> 
		    </ul>
		</li> 
	    </ul>
	</div> 
    </div>
</div> 
