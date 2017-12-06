<?php include('includes/top.php'); ?>


<?php
$userID = $_SESSION['userID'];
if(isset($_GET['id'])) {
	$groupID = $_GET['id'];
	$query = $dbcon->query("SELECT * FROM groups WHERE groupID = $groupID");
	$group = $query->fetch(PDO::FETCH_ASSOC);

	echo "
		<div style=\"font-size:30px; margin:10px\">
			Welcome to the " . $group['groupName'] . " household!
		</div>";

	echo "
		<div id=\"household\" style=\"font-size:20px; border-style:solid; height: 100%; width: 29%; margin: 20px; float:right\">
			<h3 style=\"text-align:center\">Members</h3> <br>
			<table>";


	$query = "SELECT users.firstName, users.lastName,group_users.score FROM users, group_users WHERE group_users.userID = users.userID AND group_users.groupID = " . $groupID;
	// $result = $dbcon->query($query);


	echo "<tr><th>First Name</th><th>Last Name</th><th>Score</th></tr>";
	foreach ($dbcon->query($query) as $result){

		echo "
				<tr>
					<td>". $result['firstName'] . "</td>
					<td>". $result['lastName'] . "</td>
					<td>". $result['score'] . "</td>
				</tr>";
	}

	echo "
			</table>
		</div>";

	echo "

		<div id=\"chores\" style=\"font-size:20px; border-style:solid; width: 29%; margin:20px; float:right;text-align:center\">";
	if(isset($_POST['addChore'])) {
		$choreName = isset($_POST["choreName"]) ? make_safe($_POST['choreName']) : '';
		$choreValue = isset($_POST["choreValue"]) ? make_safe($_POST['choreValue']) : '';
		$dbcon->exec("INSERT INTO `chores` (`groupID`, `choreName`, `choreValue`) VALUES ($groupID, '$choreName', $choreValue)");
	}
	if(isset($_POST['reportSubmit'])) {
		
		$reporterUserID = $_SESSION['userID'];
		$choreID = isset($_POST["chore"]) ? make_safe($_POST['chore']) : '';
		$reportedUserID = isset($_POST["reportedUser"]) ? make_safe($_POST['reportedUser']) : '';
		$dbcon->exec("INSERT INTO `events` (`reporterUserID`, `groupID`, `choreID`, `reportedUserID`) VALUES ($reporterUserID, $groupID, $choreID, $reportedUserID)");
		
		$query = $dbcon->query("SELECT `choreValue` FROM `chores` WHERE `choreID` = $choreID");
		$chore = $query->fetch(PDO::FETCH_ASSOC);
		$query = $dbcon->query("SELECT score FROM `group_users` WHERE `groupID` = $groupID AND `userID` = $reportedUserID");
		$user = $query->fetch(PDO::FETCH_ASSOC);
		$dbcon->exec("UPDATE `group_users` SET `score` = " . ($chore['choreValue'] + $user['score']) . " WHERE `groupID` = $groupID AND `userID` = $userID");
	}

?>

				<h3>Chores</h3>
				<table id="choreTable">
					<tr>
						<th>Chore Name</th>
						<th>Value</th>
					</tr>
				<?php
					$query = $dbcon->query("SELECT * FROM chores WHERE groupid = $groupID");
					while($chore = $query->fetch(PDO::FETCH_ASSOC)){
						echo "
					<tr>
						<td><a href=\"event.php?id=" . $chore['choreID'] . "\">". $chore['choreName'] . "</a></td>
						<td>" . $chore['choreValue'] . "</td>
					</tr>";
					}
				}

				?>

				</table>
				
				<h3>Add a Chore</h3>
				<form id="createChore" name="createChore" action="" method="POST">
					<input type="text" class="form-control" id="chore" name="choreName" placeholder="Chore Name">
					<input type="text" class="form-control" id="score-val" name="choreValue" placeholder="Score Value">
					<input type="submit" name="addChore" value="Add Chore" class="submit">
				</form>
			</div>
			
			<div id="reports">
				<h3>Report an Event</h3>
				<form id="reportEvent" name="createChore" action="" method="POST">
					<table>
						<tr>
							<td>
								<label for="chore">Chore</label>
							</td>
							<td>
								<select name="chore">
								<?php
									$query = $dbcon->query("SELECT * FROM `chores` WHERE `groupID` = $groupID");
									while($chore = $query->fetch(PDO::FETCH_ASSOC)) {
										echo "
										<option value=\"" . $chore['choreID'] . "\">" . $chore['choreName'] . "</option>";
									}
								?>
								
								</select>
							</td>
						</tr>
						<tr>
							<td>
								<label for="chore">User</label>
							</td>
							<td>
								<select name="reportedUser">
								<?php
									$query = $dbcon->query("SELECT * FROM `users` WHERE `userID` in (SELECT `userID` FROM `group_users` WHERE `groupID` = $groupID)");
									while($user = $query->fetch(PDO::FETCH_ASSOC)) {
										echo "
										<option value=\"" . $user['userID'] . "\">" . $user['firstName'] . " " . $user['lastName'] . "</option>";
									}
								?>
								
								</select>
							</td>
						</tr>
					</table>
					<input type="submit" name="reportSubmit" value="Report Event" class="submit">
				</form>
					
			</div>


<?php include("includes/footer.php"); ?>
