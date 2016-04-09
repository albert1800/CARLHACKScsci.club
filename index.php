<?php 

require('includes/config.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo SiteTitle;?></title>
<link href="<?php echo Dir;?>style/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="container">

	<div id="logo"><a href="<?php echo Dir;?>"><img src="images/computer.jpg" alt="<?php echo SiteTitle;?>" title="<?php echo SiteTitle;?>" border="0" height="64px" width="64px" /></a></div><!-- close logo -->
	
	<!-- START NAVIGATION -->
	<div id="navigation">
	<ul class="menu">
	<li><a href="<?php echo Dir;?>">Home</a></li>
	<?php
		//get all of the pages
		$sql = mysql_query("SELECT * FROM posts WHERE isRoot='1' ORDER BY postID");
		while ($row = mysql_fetch_object($sql))
		{
			echo "<li><a href=\"".Dir."?p=$row->postID\">$row->postTitle</a></li>"; 
		}
	?>
	</ul>
	</div>
	<!-- END NAVIGATION -->
	
	<div id="content">
	
	<?php	
	//if no page clicked on load home page default to it of 1
	if(!isset($_GET['p'])){
		$q = mysql_query("SELECT * FROM posts WHERE postID='1'");
	} else { //load requested page based on the id
		$id = $_GET['p']; //get the requested id
		$id = mysql_real_escape_string($id); //make it safe for database use
		$q = mysql_query("SELECT * FROM posts WHERE postID='$id'");
		$q = mysql_query("SELECT * FROM posts WHERE postID='$id'");
	}
	
	//get post data from database and create an object
	$r = mysql_fetch_object($q);
	
	//print the post content
	echo "<h1>$r->postTitle</h2>";
	echo $r->postCont;
	?>
	
	</div><!-- close content div -->

	<div id="footer">	
			<div class="copy">&copy; <?php echo SiteTitle.' '. date('Y');?> </div>
	</div><!-- close footer -->
</div><!-- close wrapper -->

</body>
</html>