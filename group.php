<?php include('includes/top.php'); ?>


<?php
if(isset($_GET['id'])) {
	$groupID = $_GET['id'];
	$query = $dbcon->query("SELECT * FROM groups WHERE groupID = $groupID");
	$group = $query->fetch(PDO::FETCH_ASSOC);

	echo "
		<div style=\"font-size:30px; margin:10px\">
			Welcome to the " . $group['groupName'] . " household!
		</div>";

	echo "
		<div id=\"household\" style=\"font-size:20px; border-style:solid; width: 20%; padding: 10px; float:right\">
			Members <br>
			<table>";
	$query = "SELECT users.firstName, users.lastName FROM users, group_users WHERE group_users.groupID = " . $groupID;
	$result = $dbcon->query($query);
	foreach ($result as $row){
		echo "
				<tr>
					<td>". $row['firstName'] . "</td>
					<td>". $row['lastName'] . "</td>
				</tr>";
	}
	echo "
			</table>
		</div>";

	echo "
	
		<div id=\"chores\" style=\"font-size:20px; border-style:solid; width: 30%; padding: 10px; float:left\">";
	if(isset($_POST['addChore'])) {
		$choreName = isset($_POST["choreName"]) ? make_safe($_POST['choreName']) : '';
		$choreValue = isset($_POST["choreValue"]) ? make_safe($_POST['choreValue']) : '';
		$dbcon->exec("INSERT INTO `chores` (`groupID`, `choreName`, `choreValue`) VALUES ($groupID, '$choreName', $choreValue)");
	}

?>

			<h3>Chores</h3>
			<table id="choreTable">
				<tr>
					<td>Chore Name</td>
					<td>Value</td>
				</tr>
			<?php
				$query = $dbcon->query("SELECT * FROM chores WHERE groupid = $groupID");
				while($chore = $query->fetch(PDO::FETCH_ASSOC)){
					echo "
				<tr>
					<td>". $chore['choreName'] . "</td>
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

<?php include("includes/footer.php"); ?>
