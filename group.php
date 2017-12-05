<?php include('includes/top.php'); ?>
<link rel="Stylesheet" href="style.css" type="text/css" />

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
		<div id=\"household\" style=\"font-size:20px; border-style:solid; height: 100%; width: 20%; margin: 20px; float:right\">
			<h3 style=\"text-align:center\">Members</h3> <br>
			<table>";
	$query = "SELECT users.firstName, users.lastName,users.userID FROM users, group_users WHERE group_users.userID = users.userID AND group_users.groupID = " . $groupID;
	// $result = $dbcon->query($query);
	
	foreach ($dbcon->query($query) as $result){

		echo "
				<tr>
					<td>". $result['firstName'] . "</td>
					<td>". $result['lastName'] . "</td>
					<td>". $result['userID'] . "</td>
				</tr>";
	}
	
	echo "
			</table>
		</div>";

	echo "
	
		<div id=\"chores\" style=\"font-size:20px; border-style:solid; width: 47%; margin:20px; float:right;text-align:center\">";
	if(isset($_POST['addChore'])) {
		$choreName = isset($_POST["choreName"]) ? make_safe($_POST['choreName']) : '';
		$choreValue = isset($_POST["choreValue"]) ? make_safe($_POST['choreValue']) : '';
		$assignedTo = isset($_POST["assigned"]) ? make_safe($_POST['assigned']) : '';
		$assigner = isset($_POST["assigner"]) ? make_safe($_POST['assigner']) : '';
		$dbcon->exec("INSERT INTO `chores` (`groupID`, `choreName`, `choreValue`) VALUES ($groupID, '$choreName', $choreValue)");
		$choreID = $dbcon->lastInsertId();
		$dbcon->exec("INSERT INTO `events` (`reporterUserID`, `choreID`, `reportedUserID`) VALUES ($assigner, $choreID, $assignedTo)"); 
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
			</div>
			<div id="addChore">
				<h3>Add a Chore</h3>
				<form id="createChore" name="createChore" action="" method="POST">

					<input type="text" class="form-control" id="chore" name="choreName" placeholder="Chore Name">

					<input type="text" class="form-control" id="score-val" name="choreValue" placeholder="Score Value">

					<input type="text" class="form-control" id="assigned" name="assigned" placeholder="Enter userID of person to assign to...">
					
					<input type="hidden" class="form-control" id="assigner" name="assigner" value="<?php echo $_SESSION['userID']?>"/>
					<input type="submit" name="addChore" value="Add Chore" class="submit">
				</form>
			</div>
		

<?php include("includes/footer.php"); ?>
