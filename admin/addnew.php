<?php 
require('../includes/config.php'); 

if(isset($_POST['submit'])){

	$title = $_POST['postTitle'];
	$content = $_POST['postCont'];
	
	$title = mysql_real_escape_string($title);
	$content = mysql_real_escape_string($content);
	
	mysql_query("INSERT INTO posts (postTitle,postCont) VALUES ('$title','$content')")or die(mysql_error());
	
		//send notification
		$sql = mysql_query("SELECT * FROM users WHERE subscribed='1'");
//		 this line loads the library 
			require('../Services/Twilio.php');
		while ($row = mysql_fetch_object($sql))
		{
			$account_sid = 'AC271b8182001cd93d00267b56f0e514b2'; 
			$auth_token = 'd945639188b144ed491463e880460cba'; 
			$client = new Services_Twilio($account_sid, $auth_token); 
 
			$client->account->messages->create(array( 
			'To' => $row->phone_number, 
			'From' => "+13204210506",
			'Body' => "hi $row->first_name, don't miss the new content posted on csci.club, $title",   
			));
	}
	$_SESSION['success'] = 'Post Added';
	header('Location: '.AdminDir);
	exit();
	

}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo SiteTitle;?></title>
<link href="<?php echo Dir;?>style/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="wrapper">

<div id="logo"><a href="<?php echo Dir;?>"><img src="../images/computer.jpg" alt="<?php echo SiteTitle;?>" title="<?php echo SiteTitle;?>" border="0" height="64px" width="64px"/></a></div><!-- close logo -->

<!-- NAV -->
<div id="navigation">
<ul class="menu">
<li><a href="<?php echo AdminDir;?>">Admin</a></li>
<li><a href="<?php echo AdminDir;?>?logout">Logout</a></li>
<li><a href="<?php echo Dir;?>" target="_blank">View Website</a></li>
</ul>
</div>
<!-- END NAV -->

<div id="content">

<h1>Add Page</h1>

<form action="" method="post">
<p>Title:<br /> <input name="postTitle" type="text" value="" size="100" /></p>
<p>content<br /><textarea name="postCont" cols="100" rows="30"></textarea></p>
<p><input type="submit" name="submit" value="Submit" class="button" /></p>
</form>

</div>

<div id="footer">	
		<div class="copy">&copy; <?php echo SiteTitle.' '. date('Y');?> </div>
</div><!-- close footer -->
</div><!-- close wrapper -->

</body>
</html>
