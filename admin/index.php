<?php 
require('../includes/config.php'); 

//make sure user is logged in, function will redirect use if not logged in
login_required();

//if logout has been clicked run the logout function which will destroy any active sessions and redirect to the login page
if(isset($_GET['logout'])){
	logout();
}

//run if a page deletion has been requested
if(isset($_GET['delpage'])){
		
	$delpage = $_GET['delpage'];
	$delpage = mysql_real_escape_string($delpage);
	$sql = mysql_query("DELETE FROM posts WHERE postID = '$delpage'");
    $_SESSION['success'] = "Post Deleted"; 
    header('Location: ' .AdminDir);
   	exit();
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo SiteTitle;?></title>
<link href="<?php echo Dir;?>style/style.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" type="text/javascript">
	function delpage(id, title)
	{
	   if (confirm("You are about to delete the post '" + title + "', Are you sure?"))
	   {
		  window.location.href = '<?php echo AdminDir;?>?delpage=' + id;
	   }
	}
</script>
</head>
<body>

<div id="wrapper">

<div id="logo"><a href="<?php echo AdminDir;?>"><img src="../images/computer.jpg" alt="<?php echo SiteTitle;?>" border="0" height="64px" width="64px" /></a></div>

<!-- NAV -->
<div id="navigation">
	<ul class="menu">
		<li><a href="<?php echo AdminDir;?>">Admin</a></li>		
		<li><a href="<?php echo Dir;?>" target="_blank">View Website</a></li>
		<li><a href="<?php echo AdminDir;?>?logout">Logout</a></li>
	</ul>
</div>
<!-- END NAV -->

<div id="content">

<!--<?php 
	//show any messages if there are any.
	messages();
?>-->

<h1>Manage Posts</h1>

<table>
<tr>
	<th><strong>Title</strong></th>
	<th><strong>Action</strong></th>
</tr>

<?php
$sql = mysql_query("SELECT * FROM posts ORDER BY postID");
while($row = mysql_fetch_object($sql)) 
{
	echo "<tr>";
		echo "<td>$row->postTitle</td>";
		if($row->postID == 1){ //home page hide the delete link
			echo "<td><a href=\"".AdminDir."edit.php?id=$row->postID\">Edit</a></td>";
		} else {
			echo "<td><a href=\"".AdminDir."edit.php?id=$row->postID\">Edit</a> | <a href=\"javascript:delpage('$row->postID','$row->postTitle');\">Delete</a></td>";
		}
		
	echo "</tr>";
}
?>
</table>

<p><a href="<?php echo AdminDir;?>addnew.php" class="button">Add Post</a></p>
</div>

<div id="footer">	
		<div class="copy">&copy; <?php echo SiteTitle.' '. date('Y');?> </div>
</div><!-- close footer -->
</div><!-- close wrapper -->

</body>
</html>
