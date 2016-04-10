<?php 

require('../includes/config.php'); 

//redirect to previous page if no id is provided
if(!isset($_GET['id']) || $_GET['id'] == ''){ 
	header('Location: '.AdminDir); 
}

if(isset($_POST['submit'])){

	$title = $_POST['pageTitle'];
	$content = $_POST['pageCont'];
	$postID = $_POST['postID'];
	
	$title = mysql_real_escape_string($title);
	$content = mysql_real_escape_string($content);
	
	mysql_query("UPDATE posts SET postTitle='$title', postCont='$content' WHERE postID='$pageID'");
	$_SESSION['success'] = 'Post Updated';
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

<div id="logo"><a href="<?php echo Dir;?>"><img src="../images/computer.jpg" alt="<?php echo SiteTitle;?>" title="<?php echo SiteTitle;?>" border="0" height="64" width="64"/></a></div><!-- close logo -->

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

<h1>Edit Page</h1>

<?php
$id = $_GET['id'];
$id = mysql_real_escape_string($id);
$q = mysql_query("SELECT * FROM posts WHERE postID='$id'");
$row = mysql_fetch_object($q);
?>


<form action="" method="post">
<input type="hidden" name="postID" value="<?php echo $row->postID;?>" />
<p>Title:<br /> <input name="postTitle" type="text" value="<?php echo $row->postTitle;?>" size="100" />
</p>
<p>content<br /><textarea name="postCont" cols="100" rows="30"><?php echo $row->postCont;?></textarea>
</p>
<p><input type="submit" name="submit" value="Submit" class="button" /></p>
</form>

</div>

<div id="footer">	
		<div class="copy">&copy; <?php echo SiteTitle.' '. date('Y');?> </div>
</div><!-- close footer -->
</div><!-- close wrapper -->

</body>
</html>
