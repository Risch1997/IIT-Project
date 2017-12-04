<?php include('includes/top.php'); ?>


<?php
	$name = $_POST['groupname'];
	$groupID = $_POST['groupid'];

	echo '<div style="font-size:30px; margin:10px">';
	echo "Welcome to the " . $name . " household!";

	echo '</div>';

	echo '<div id="household" style="font-size:20px; border-style:solid; width: 20%; padding: 10px; float:right">';
	echo 'Members'."<br>";
	$query = "SELECT users.firstName, users.lastName FROM users, group_users WHERE group_users.groupID = " . $groupID;
	$result = $dbcon->query($query);
	foreach ($result as $row){
		echo "<tr><td>". $row['firstName'] . "</td>";
		echo " ";
		echo "<td>". $row['lastName'] . "</td></tr>";
		echo "<br>";
	}
	echo '</div>';

	echo '<div id="chores" style="font-size:20px; border-style:solid; width: 30%; padding: 10px; float:left">';
	$chore = '';
	$score = '';
	if(isset($_POST['addChore'])) {
		$chore = $_POST["chore"];
		$score = $_POST["score"];
		// $dbcon->exec("INSERT INTO `chorevalues` (`groupID`,`choreValue`) VALUES ($groupID, $score)");
		
		
		
	}
?>

<h3>Add a Chore</h3>
<form id="createChore" name="createChore" action="" method="POST">
	<input type="text" class="form-control" id="chore" name="chore" placeholder="Chore Name" value="<?php echo $chore ?>">

	<input type="text" class="form-control" id="score-val" name="score" placeholder="Score Value" value="<?php echo $score ?>">
	
	<input type="submit" name="addChore" value="Add Chore" class="submit">
</form>

<h3>Chores</h3>
<table id="choreTable">
<?php
	$query3 = 'select choreID from chorevalues';
	$res = $dbcon->query($query3);
	foreach ($res as $r){
		echo "<tr><td>". $r['choreID'] . "</td>";
	}

?>
</table>
