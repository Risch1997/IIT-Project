<?php include('includes/top.php'); ?>


<?php
$userID = $_SESSION['userID'];
if(isset($_GET['id'])) {
	$groupID = $_GET['id'];
	$query = $dbcon->query("SELECT * FROM groups WHERE groupID = $groupID");
	$group = $query->fetch(PDO::FETCH_ASSOC);

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
		$dbcon->exec("UPDATE `group_users` SET `score` = " . ($chore['choreValue'] + $user['score']) . " WHERE `groupID` = $groupID AND `userID` = $reportedUserID");
	}

	echo "

		<div id=\"groupwelcomediv\">
			<h1>Welcome to the " . $group['groupName'] . " household!</h1>
		</div>

		<div id=\"addchorediv\">
			<h1>Add a Chore</h1>
			<form id=\"createChore\" name=\"createChore\" action=\"\" method=\"POST\">
				<input type=\"text\" class=\"form-control\" id=\"chore\" name=\"choreName\" placeholder=\"Chore Name\">
				<input type=\"text\" class=\"form-control\" id=\"score-val\" name=\"choreValue\" placeholder=\"Score Value\">
				<input type=\"submit\" name=\"addChore\" value=\"Add Chore\" class=\"submit\">
			</form>
		</div>

		<div id=\"household\">
		<div id=\"householddiv\">
			<h1>Members</h1>
			</div>
			<table id=\"householdtable\">
			</div>";


	$query = "SELECT users.firstName, users.lastName, users.userID ,group_users.score FROM users, group_users WHERE group_users.userID = users.userID AND group_users.groupID = " . $groupID;
	// $result = $dbcon->query($query);


	echo "<tr><th>First Name</th><th>Last Name</th><th>Score</th><th>View</th></tr>";
	foreach ($dbcon->query($query) as $result){

		echo "
				<tr>
					<td>". $result['firstName'] . "</td>
					<td>". $result['lastName'] . "</td>
					<td>". $result['score'] . "</td>
					
					<td><a href=\"profile.php?userID=" . $result['userID'] . "&groupID=$groupID\"><input type=\"submit\" name=\"viewProfile\" value=\"View\" class=\"profilesubmit\"></a></td>
				</tr>";
	}

	echo "
			</table>
		</div>";

?>
				<div id="chores">
					<div id="choresdiv">
						<h1>Chores</h1>
					</div>


					<table id="chorestable">

					<tr>
						<th>Chore Name</th>
						<th>Chore Value</th>
						<th>Edit Chore</th>
					</tr>

				<?php
					$query = $dbcon->query("SELECT * FROM chores WHERE groupid = $groupID");
					while($chore = $query->fetch(PDO::FETCH_ASSOC)){
						echo "
					<tr>
						<td class=\"choretdlable\">". $chore['choreName'] . "</a></td>
						<td class=\"choretdlable\">" . $chore['choreValue'] . "</td>
						<td><a href=\"editChore.php?choreID=" . $chore['choreID'] . "&groupID=$groupID\"><input type=\"submit\" name=\"editChore\" value=\"Edit\" class=\"editchoresubmit\"></a></td>
					</tr>";
					}
				}

				?>

				</table>
			</div>



			<div id="addeventdiv">
				<h1>Report an Event</h1>
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
