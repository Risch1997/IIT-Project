<?php include('includes/top.php'); ?>

		
	<h1 style="text-align: center">Your Groups</h1>

	
	<?php
		echo '<table class="groupList" style="border:solid; width: 30%">';
		// $query = "SELECT groups.groupName, groups.groupID FROM groups, group_users WHERE ". $_SESSION['userID']." = group_users.userID";
		$query = "SELECT * FROM groups";
		$result = $dbcon->query($query);
		
		
		
		foreach ($result as $row){
			echo '<td>
				<form method="post" action="group.php?id='. $row['groupID'].'">
				<input type="label" name="groupname" value='.'"'.$row['groupName'].'"'.'>
				<input type="hidden" name="groupid" value='.'"'.$row['groupID'].'"'.'>
          		<input type="submit" value="View" id="view_btn" class="submit"></form>
          		</td>';	
         }
	?>
	


<?php include('includes/footer.php'); ?>