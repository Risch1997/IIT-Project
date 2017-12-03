<?php include('includes/top.php'); ?>

		<?php
		if(isset($_SESSION['status']) && $_SESSION['status'] == 'authorized') {
			echo "
			<div id=\"select\">
			<h1>Select an option</h1>
			<div class=\"groupoption\">
				<a href=\"view.php\" class=\"selecthref\"><button class=\"selectbutton\">View Group(s)</button></a>
			</div>
			<div class=\"groupoption\">
				<a href=\"join.php\" class=\"selecthref\"><button class=\"selectbutton\">Join Group</button></a>
			</div>
			<div class=\"groupoption\">
				<a href=\"create.php\" class=\"selecthref\"><button class=\"selectbutton\">Create Group</button></a>
			</div>";
		}
		else {
			echo "
			<div class=\"content\">
				<h2>Welcome to Chore Tracker!</h2>
				<p>Here is where stuff goes.</p>
			</div>";
		}
		?>

<?php include('includes/footer.php'); ?>
