<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/config_coin.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . $_PATH . '/bd/bd_lang.php');
require ($_SERVER['DOCUMENT_ROOT'] . $_PATH . '/controller/include/language.php');
?> 
<!DOCTYPE html>

<html> 
    <head>
        <title>Coin CE</title> 
	<?php require_once ($_SERVER['DOCUMENT_ROOT'] . $_PATH . '/view/head.php'); ?>
	<script src="//code.jquery.com/jquery-1.10.2.js"></script>  
    </head> 
    <body>
        <!-- top : header -->
	<?php require ($_SERVER['DOCUMENT_ROOT'] . $_PATH . '/view/menu.php'); ?>
        <!-- middle --> 
        <div class="container" >
            <div class="jumbotron">
                <h1 class='text-center'>.Coin.</h1> 

                <!-- TESTING CODE SPACE -->
                <div>
                    <pre>
			<br>
			<?php if(isset($_COOKIE['name'])) {echo $label['welcome'].' '.$_COOKIE['name']; }else{
			    echo $label['welcome_guest'];
			    
			} ?>
			<br> 
                    </pre> 
                </div> 
                <!-- Button trigger modal --> 
		<?php if (!isset($_COOKIE['iduser'])) { ?>
    		<button class="btn btn-default btn-lg pull-left" data-toggle="modal" data-target="#SignIn">
			<?php echo $button['signin']; ?>
    		</button>
    		<button class="btn btn-primary btn-lg pull-right" data-toggle="modal" data-target="#LogIn">
			<?php echo $button['login']; ?>
    		</button> 
    		<button class="btn btn-warning btn-lg" data-toggle="modal" data-target="#pwdRecovery">
			<?php echo $button['recover']; ?>
    		</button>
		<?php } else { ?>
    		<button class="btn btn-danger btn-lg pull-right" id="logOutButton" onclick="window.location.href = 'logout.php'">
			<?php echo $button['logout']; ?>
    		</button>
		<?php } ?>
            </div> 
        </div>

        <div class='container'> 
	    <!-- alert message -->
	    <?php if (isset($_GET['error'])) { ?> 
    	    <div class="alert-box" style="">
    		<div class="alert alert-danger" >
    		    <a href="#" class="close" data-dismiss="alert">&times;</a>
    		    <strong><?php echo $alert['warning']; ?></strong>

			<?php
			if ($_GET['error'] == 'pwdupt') {
			    echo $alert['error_pwdupt'];
			} else {
			    echo $alert['error_login'];
			}
			?>


    		</div>
    	    </div>
	    <?php } else if (isset($_GET['success'])) { ?>
    	    <div class = "alert-box" style = "">
    		<div class = "alert alert-success" >
    		    <a href = "#" class = "close" data-dismiss = "alert">&times;
    		    </a>
    		    <strong><?php echo $alert['note']; ?></strong>
			<?php
			if ($_GET['success'] == 'pwdupt') {
			    echo $alert['success_pwdupt'];
			} else if ($_GET['success'] == 'request') {
			    echo $alert['success_request'];
			} else {
			    echo $alert['note_recover'];
			}
			?>
    		</div>
    	    </div>
		<?php
	    } else if (isset($_GET['signin'])) {
		if ($_GET['signin'] === 'success') {
		    ?>
		    <div class = "alert-box" style = "">
			<div class = "alert alert-success" >
			    <a href = "#" class = "close" data-dismiss = "alert">&times;
			    </a>
			    <strong><?php echo $alert['note']; ?></strong>
			    <?php echo $alert['note_signin']; ?>
			</div>
		    </div>

		<?php } else {
		    ?>
		    <div class = "alert-box" style = "">
			<div class = "alert alert-danger" >
			    <a href = "#" class = "close" data-dismiss = "alert">&times;
			    </a>
			    <strong><?php echo $alert['warning']; ?></strong>
			    <?php echo $alert['warning_signin']; ?>
			</div>
		    </div>
		    <?php
		}
	    }
	    ?>
        </div>

        <!-- bottom : footer --> 
	<?php require ($_SERVER['DOCUMENT_ROOT'] . $_PATH . '/view/footer.php'); ?>



        <!-- modal : contact -->

	<?php require $_SERVER['DOCUMENT_ROOT'] . $_PATH . '/view/contact.php'; ?>

        <!-- Modal sample -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                    </div>
                    <div class="modal-body">
                        ... body ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $button['close']; ?></button>
                        <button type="button" class="btn btn-primary"><?php echo $button['save']; ?></button>
                    </div>
                </div>
            </div>
        </div>


	<!-- Modal sample pwdRecovery -->
	<div class="modal fade" id="pwdRecovery" tabindex="-1" role="dialog" aria-labelledby>
	    <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel"><?php echo $modal['m_pass_recovery']; ?></h4>
                    </div>
                    <div class="modal-body">
                        <form id="pwdRecoveryForm" name="pwdRecovery" action="util/recovery.php" method="post">
                            <div class="form-group">
                                <label for="inputEmail"><?php echo $label['email']; ?></label>
                                <input required type="email" class="form-control" name="email" id="inputEmail" placeholder="<?php echo $placeholder['email']; ?>">
                            </div> 

                            <button type="submit" name="resquest" class="btn btn-primary"><?php echo $button['request']; ?></button>
			    <button type="submit" name="quest" class="btn btn-default"><?php echo $button['quest']; ?></button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $button['close']; ?></button> 

                    </div>

                </div>
            </div>
	</div>

        <!-- Modal sample SignIn -->
        <div class="modal fade" id="SignIn" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel"><?php echo $modal['m_signin']; ?></h4>
                    </div>
                    <div class="modal-body"> 
                        <form id="signinForm" name="signin" action="util/signin.php" method="post"> 
                            <div class="form-group">
                                <label for="inputName"><?php echo $label['name']; ?></label>  
                                <input required class="form-control" type="text" name="name" id="formName" placeholder="<?php echo $placeholder['name']; ?>"> 
                            </div> 
                            <div class="form-group">
                                <label for="formSurename"><?php echo $label['surename']; ?></label>
                                <input required class="form-control" type="text" name="surename" id="formSurename" placeholder="<?php echo $placeholder['surename']; ?>">
                            </div> 
                            <div class="form-group">
                                <label for="formBirthday"><?php echo $label['birthday']; ?></label> 
                                <input required class="form-control" type="date" name="birthday" id="formBirthday" value="12-12-2012" placeholder="<?php echo $placeholder['birthday']; ?>"> 
                            </div> 
                            <div class="form-group"> 
                                <label for="formMarriage"><?php echo $label['state']; ?><br>
                                    <select class="form-control" name="marriage" id="formMarriage">
                                        <option value="single"><?php echo $option['single']; ?></option>
                                        <option value="maried"><?php echo $option['married']; ?></option>
                                        <option value="divorced"><?php echo $option['divorced']; ?></option>
                                        <option value="widowed"><?php echo $option['widowed']; ?></option>
                                    </select>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="formEmail"><?php echo $label['email']; ?></label>
                                <input required class="form-control" type="email" name="email" id="formEmail" placeholder="<?php echo $placeholder['email']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="formDNI"><?php echo $label['dni']; ?></label>
                                <input required class="form-control" type="text" name="dni" id="formDNI" placeholder="<?php echo $placeholder['dni']; ?>">
                            </div>



                            <!-- passwd -->	    
                            <div class="form-group">
                                <label for="formPass"><?php echo $label['password']; ?></label>
                                <input required class="form-control" type="password" name="password" id="formPass" placeholder="<?php echo $placeholder['password']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="formRePass"><?php echo $label['password_re']; ?></label>
                                <input required class="form-control" type="password" name="passwordre" id="formRePass" placeholder="<?php echo $placeholder['password_re']; ?>">
                            </div>
                            <!-- passwd-re -->



                            <div class="form-group">
                                <label for="formQuest"><?php echo $label['quest']; ?></label>
                                <input required class="form-control" type="text" name="quest" id="formQuest" placeholder="<?php echo $placeholder['quest']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="formQuestAns"><?php echo $label['quest_ans']; ?></label>
                                <input required class="form-control" type="text" name="qanswer" id="formQuestAns" placeholder="<?php echo $placeholder['quest_ans']; ?>">
                            </div>

                            <!-- submit -->
                            <div class="form-group">
                                <label for="formSubmit"><?php echo $label['submit']; ?></label>
                                <button type="submit" class="btn pull-right" id="formSubmit" ><?php echo $button['submit']; ?></button> 
                            </div>
                        </form> 
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-right" data-dismiss="modal"><?php echo $button['close']; ?></button>
                    </div>
                </div> 
            </div>
        </div> 

        <!-- Modal sample LogIn-->
        <div class="modal fade" id="LogIn" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Login</h4>
                    </div>
                    <div class="modal-body">
                        <form id="loginForm" name="login" action="login.php" method="post">
                            <div class="form-group">
                                <label for="inputEmail"><?php echo $label['email']; ?></label>
                                <input type="email" class="form-control" name="email" id="inputEmail" placeholder="<?php echo $placeholder['email']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="inputPassword"><?php echo $label['password']; ?></label>
                                <input type="password" class="form-control" name="password" id="inputPassword" placeholder="<?php echo $placeholder['password']; ?>">
                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox"><?php echo $label['remember']; ?></label>
                            </div>
                            <button type="submit" class="btn btn-primary"><?php echo $button['login']; ?></button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $button['close']; ?></button> 

                    </div> 
                </div>
            </div>
        </div> 

        <script src="js/bootstrap.js"></script> 
        <script src="js/bootstrap-datepicker.js"></script> 
        <script src="js/bootstrap-datetimepicker.min.js"></script>


        <script type="text/javascript">
		    // signin password eval
		    $("#formRePass").on("focusout", function() {
			if ($("#formRePass").val() === $("#formPass").val())
			{
			    //   alert("ok "+$("#formRePass").val());			 
			}
			else
			{
			    alert("not match " + $("#formRePass").val());
			}
		    });


        </script>


    </body>
</html>


















