<?php include('includes/top.php'); ?>


<?php
	if (isset($_GET['choreID']) && isset($_GET['groupID'])){
		$choreID = $_GET['choreID'];
		$groupID = $_GET['groupID'];

		if(isset($_POST['editChore'])) {
			$choreName = isset($_POST['choreName']) ? make_safe($_POST['choreName']) : '';
			$choreValue = isset($_POST['choreValue']) ? make_safe($_POST['choreValue']) : '';
			$dbcon->exec("UPDATE `chores` SET `choreName` = '$choreName', `choreValue` = $choreValue WHERE `groupID` = $groupID AND `choreID` = $choreID");
			header("Location: group.php?id=$groupID");
		}

		$query = $dbcon->query("SELECT * FROM chores WHERE choreID = $choreID AND groupID = $groupID");
		$chore = $query->fetch(PDO::FETCH_ASSOC);
		echo "
		<div id=\"editchorediv\">
		<h1>Edit Chore</h1>
		<form id=\"editChoreForm\" method=\"POST\" action=\"\">
			<table>
				<tr>
					<td><label for=\"choreName\">Chore Name</label></td>
					<td><input type=\"text\" name=\"choreName\" value=\"" . $chore['choreName'] . "\"></td>
				</tr>
				<tr>
					<td><label for=\"choreValue\">Chore Value</label></td>
					<td><input type=\"text\" name=\"choreValue\" value=\"" . $chore['choreValue'] . "\"></td>
				</tr>
			</table>
			<input type=\"submit\" name=\"editChore\" class=\"submit\" value=\"Edit Chore\">
		</form>
		</div>";
	}

?>
<?php include('includes/footer.php') ?>	