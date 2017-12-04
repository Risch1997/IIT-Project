<?php include('includes/top.php'); ?>

		
	<h1 style="text-align: center">Your Groups</h1>

	
	<?php
		echo '<table class="groupList" style="border:solid; width: 30%">';
		$query = "SELECT groups.groupName, groups.groupID FROM groups, group_users WHERE ". $_SESSION['userID']." = group_users.userID";
		
		$result = $dbcon->query($query);
		
		
		
		foreach ($result as $row){
			echo '
				<form method="post" action="group.php?id='. $row['groupID'].'">';
			echo '<tr><td><label style="font-size:20px">' . $row['groupName'] . '</label></td>';

			echo	'<input type="hidden" name="groupname" value='.'"'.$row['groupName'].'"'.'>
				<input type="hidden" name="groupid" value='.'"'.$row['groupID'].'"'.'>
          		<td><input type="submit" value="View" id="view_btn" class="submit" style="float:right"></form>
          		</td></tr>';	
         }
	?>
	


<?php include('includes/footer.php'); ?>

