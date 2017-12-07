<?php include('includes/top.php'); ?>
<?php
	if (isset($_GET['userID']) && isset($_GET['groupID'])){
		$userID = $_GET['userID'];
		$groupID = $_GET['groupID'];
		
		echo "<a href=\"group.php?id=$groupID\"><< Back to group page</a>";


		// load user name
		$query = $dbcon->query("SELECT firstName, lastName FROM users WHERE userID = $userID");
		$name = $query->fetch(PDO::FETCH_ASSOC);
		echo "
		<div id=\"profilediv\">
			<h1>" . $name['firstName'] . ' ' . $name['lastName'] . "</h1>";

		// load uesr score
		$query = $dbcon->query("SELECT score FROM group_users WHERE userID = $userID");
		$score = $query->fetch(PDO::FETCH_ASSOC);
		echo "<h2> Score = " . $score['score'] . "</h2>
		</div>
		<div id=\"profileinfo\">
		<h2 id=\"h2event\">Events</h2>
		<ul>";



		// load the chores user was assigned to
		$query = "SELECT chores.choreName FROM chores, events WHERE events.reportedUserId = $userID AND events.choreID = chores.choreID AND chores.groupID = $groupID";

		foreach ($dbcon->query($query) as $result){
			echo "<li>" . $result['choreName'] . "</Li>";
		}

		echo "</ul></div>";
	}

?>
<?php include('includes/footer.php') ?>
