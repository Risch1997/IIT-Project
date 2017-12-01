<?php include('includes/top.php'); ?>
		<h1>Welcome to Chore Tracker!</h1>
		<?php
		if(isset($_SESSION['status']) && $_SESSION['status'] == 'authorized') {
			$query = $dbcon->query("SELECT * FROM `users` WHERE userID = " . $_SESSION['userID']);
			$user = $query->fetch(PDO::FETCH_ASSOC);
			
			echo "
			Welcome, " . $user['firstName'] . "! <a href=\"index.php?status=logout\">Logout</a><br/>
			<a href=\"createGroup.php\">Create a new group</a><br/>
			<a href=\"groupView\">View your groups</a>";
		}
		else {
			echo "
			<a href=\"login.php\">Existing user? Click here to log in!</a><br/>
			<a href=\"register.php\">Need an account? Click here to register!</a>";
		}
		?>
		
<?php include('includes/footer.php') ?>		