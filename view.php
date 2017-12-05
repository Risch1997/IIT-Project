<?php include('includes/top.php'); ?>

		
	<h1 style="text-align: center">Your Groups</h1>

	
	<?php
		echo '<table class="groupList" style="border:solid; width: 30%">';
		$query = "SELECT groups.groupName, groups.groupID FROM groups, group_users WHERE ". $_SESSION['userID']." = group_users.userID";
		
		$result = $dbcon->query($query);
		
		
		
		foreach ($result as $row){
			echo "
			<tr>
				<td><label style=\"font-size:20px\">" . $row['groupName'] . "</label></td>
				<td><a href=\"group.php?id=" . $row['groupID'] . "\"><button type=\"button\"class=\"submit\" style=\"float:right\">View</button></a></td>
			</tr>";	
         }
		 echo "</table>";
	?>
	


<?php include('includes/footer.php'); ?>

