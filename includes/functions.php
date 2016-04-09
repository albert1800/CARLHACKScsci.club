<?php
if (!defined('included')){
die('You cannot access this file directly!');
}

//log user in ---------------------------------------------------
function login($user, $pass){

   //strip all tags from varible   
   $user = strip_tags(mysql_real_escape_string($user));
   $pass = strip_tags(mysql_real_escape_string($pass));

   // check user in db
   $sql = "SELECT * FROM users WHERE email = '$user' AND admin = '1'";
   $result = mysql_query($sql) or die('Query failed. ' . mysql_error());
   //get post data from database and create an object
	$r_object = mysql_fetch_object($result);
      
   if (password_verify($pass, $r_object->password_digest)) {
      // the username and password match,
      // set the session
	  $_SESSION['authorized'] = true;
					  
	  // direct to admin
      header('Location: '.AdminDir);
	  exit();
   } else {
	// define an error message
	$_SESSION['error'] = 'Sorry, wrong username or password';
   }
}

// Authentication
function logged_in() {
	if($_SESSION['authorized'] == true) {
		return true;
	} else {
		return false;
	}	
}

function login_required() {
	if(logged_in()) {	
		return true;
	} else {
		header('Location: '.AdminDir.'login.php');
		exit();
	}	
}

function logout(){
	unset($_SESSION['authorized']);
	header('Location: '.AdminDir.'login.php');
	exit();
}

// Render error messages
function messages() {
    $message = '';
    if($_SESSION['success'] != '') {
        $message = '<div class="msg-ok">'.$_SESSION['success'].'</div>';
        $_SESSION['success'] = '';
    }
    if($_SESSION['error'] != '') {
        $message = '<div class="msg-error">'.$_SESSION['error'].'</div>';
        $_SESSION['error'] = '';
    }
    echo "$message";
}

function errors($error){
	if (!empty($error))
	{
			$i = 0;
			while ($i < count($error)){
			$showError.= "<div class=\"msg-error\">".$error[$i]."</div>";
			$i ++;}
			echo $showError;
	}// close if empty errors
} // close function

?>