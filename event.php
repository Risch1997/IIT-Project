<?php include('includes/top.php'); ?>


<?php
	if (isset($_GET['id'])){
		$choreID = $_GET['id'];
		$query = $dbcon->query("SELECT * FROM chores WHERE choreID = $choreID");
		$chore = $query->fetch(PDO::FETCH_ASSOC);

		$query2 = $dbcon->query("SELECT * FROM events WHERE choreID = $choreID");
		$event = $query2->fetch(PDO::FETCH_ASSOC);
		echo "<h2>Chore: " . $chore['choreName'] . "</h2>";

		// find the name of the reportedUserID
		$query3 = $dbcon->query("SELECT firstName, lastName FROM users WHERE users.userID = " . $event['reportedUserID']);
		$name = $query3->fetch(PDO::FETCH_ASSOC);
		echo "Assigned to: " . $name['firstName'] . " " . $name['lastName'] . "</br>";

		// find name of reporter
		$query4 = $dbcon->query("SELECT firstName, lastName FROM users WHERE users.userID = " . $event['reporterUserID']);
		$name2 = $query4->fetch(PDO::FETCH_ASSOC);
		echo "Reporter: " . $name2['firstName'] . " " . $name2['lastName'];
	}

?>
<input type="submit" name="commend" value="commend" class="submit">
<input type="submit" name="reprimand" value="Reprimand" class="submit">
