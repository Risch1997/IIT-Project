<?php include('includes/top.php'); ?>
<?php
	if (isset($_GET['userID']) && isset($_GET['groupID'])){
		$userID = $_GET['userID'];
		$groupID = $_GET['groupID'];


		// load user name
		$query = $dbcon->query("SELECT firstName, lastName FROM users WHERE userID = $userID");
		$name = $query->fetch(PDO::FETCH_ASSOC);
		echo $name['firstName'] . ' ' . $name['lastName'] . '</br>';
		
		// load uesr score
		$query = $dbcon->query("SELECT score FROM group_users WHERE userID = $userID");
		$score = $query->fetch(PDO::FETCH_ASSOC);
		echo $score['score'];

				

		// load the chores user was assigned to
		$query = "SELECT chores.choreName FROM chores, events WHERE events.reportedUserId = $userID AND events.choreID = chores.choreID AND chores.groupID = $groupID";

		foreach ($dbcon->query($query) as $result){
			echo $result['choreName'];
		}

	}

?>
<?php include('includes/footer.php') ?>	