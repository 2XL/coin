<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/config_coin.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . $_PATH . '/bd/bd_signin.php');

$email = $_REQUEST['email'];
// se envia un correu amb o sera un auto servei ? ... avere ...
// email de recuperacion

 
$link = obrirBD();
// 1 verificar si el correo electronico que se pasa por parametro existe 
if (isset($_REQUEST['setnewpass'])) {
    // update password
    $new_pass = $_REQUEST['password'];
    updateUserPassword($email, md5($new_pass), $link);
    $success = true;
} else {
    if (existsLoginByEmail($email, $link)) { // existe 
	if (isset($_REQUEST['quest'])) {

	    // comprovar si el correu existeix - envas afirmatiu redireccionar a un formulari amb un unic input
	    $user = getUserByEmail($email, $link);
	    $quest = $user['quest'];

	    if (isset($_REQUEST['checkans'])) {
		$answr = $user['qanswer'];
		if ($answr === $_REQUEST['answr']) {
		    ?>
		    <form method='post' action=''>
		        <input type="hidden" name="email" value="<?php echo $email; ?>">
		        <input type="text" name="password">
		        <button name="setnewpass" >Submit new password</button>
		    </form>

		    <?php
		}else{
		    header("Location:  ".$_PATH."/index.php?error=pwdupt");
		}
	    } else {
		?>

		<form method="post" action="">
		    <input type="hidden" name="email" value="<?php echo $email; ?>">
		    <input type="hidden" name="quest">
		    <label>Quest</label>
		    <input type="text" name="quest" value="<?php echo $quest; ?>" disabled>
		    <label>Answer</label>
		    <input type="text" name="answr" >
		    <button name="checkans">Check answr</button>
		</form> 
	    <?php } ?>
	    <?php
	} else {
	    $user = getUserByEmail($email, $link);
	    $recovery_path = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . '?email=' . $user["email"] . '&answr=' . $user['qanswer'] . '&checkans&quest';
	    $from = "stacktracks@stacktracks.com";
	    $to = $user['email'];
	    $subject = " password recovery ";
	    $message = " recoverylink: " . $recovery_path;
	    $resultMail = mail($to, $subject, $message, "From: $from\n");
	}
    } else {
	// no existe correo 
	header("Location:  ".$_PATH."/index.php?error=pwdupt");
    }
}

function make_seed() {
    list($usec, $sec) = explode(' ', microtime());
    return (float) $sec + ((float) $usec * 100000);
}

function spamcheck($field) {
    // Sanitize e-mail address
    $field = filter_var($field, FILTER_SANITIZE_EMAIL);
    // Validate e-mail address
    if (filter_var($field, FILTER_VALIDATE_EMAIL)) {
	return TRUE;
    } else {
	return FALSE;
    }
}

if (isset($success)) {
    header("Location:  ".$_PATH."/index.php?success=pwdupt");
} else if (isset($resultMail) && $resultMail == true) {
    header("Location:  ".$_PATH."/index.php?success=request");
} else {
    header("Location:  ".$_PATH."/index.php?error=pwdupt");
}