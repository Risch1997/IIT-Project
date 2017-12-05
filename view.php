<?php include('includes/top.php'); ?>

<div id="viewdiv">
	<h1>Your Groups</h1>
</div>

	<?php
		echo '<table class="grouplisttable">';
		$query = "SELECT groups.groupName, groups.groupID FROM groups, group_users WHERE ". $_SESSION['userID']." = group_users.userID";

		$result = $dbcon->query($query);


		foreach ($result as $row){
			echo "
			<tr>
				<td class=\"tdlable\"><label style=\"font-size:20px\">" . $row['groupName'] . "</label></td>
				<td><a href=\"group.php?id=" . $row['groupID'] . "\"><input type=\"submit\" name=\"joinSubmit\" value=\"View\" class=\"viewsubmit\"></a></td>
			</tr>";
         }
		 echo "</table>";
	?>

</div>


<?php include('includes/footer.php'); ?>
