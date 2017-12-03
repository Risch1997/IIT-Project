<?php 
include('includes/top.php'); 

if(isset($_SESSION['status']) && $_SESSION['status'] == 'authorized') {
	echo "
	<div id=\"select\">
	<h1>Select an option</h1>
	<div class=\"groupoption\">
		<a href=\"create.php\" class=\"selecthref\"><button class=\"selectbutton\">Create group</button></a>
	</div>
	<div class=\"groupoption\">
		<a href=\"join.php\" class=\"selecthref\"><button class=\"selectbutton\">Join group</button></a>
	</div>
	<div class=\"groupoption\">
		<a href=\"view.php\" class=\"selecthref\"><button class=\"selectbutton\">View group</button></a>
	</div>";
}
else {
	echo "
	<div class=\"content\">
		<h2>Welcome to Chore Tracker!</h2>
		<p>Here is where stuff goes.</p>
	</div>";
}

include('includes/footer.php'); ?>
