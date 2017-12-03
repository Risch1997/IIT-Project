<?php include('includes/top.php'); ?>
<html>
	<body>
		<label style="float:right"><a href="home.php">Home</a></label>
		<h1>Create group</h1>
		<form name="creategroup" action="" method="POST">
			<table id="creategroup">
				<tr>
					<td><label for="groupname">Group Name</label></td>
					<td><input type="text" name="groupname"></td>
				</tr>
				<tr>
					<td><label for="invitation">Send an invitation</label></td>
					<td><input type="text" name="groupname" placeholder="Enter valid email address"></td>
				</tr>

					<td></td>
					<td><input type="submit" name="creategroup" value="Create"></td>
				</tr>
			</table>
		</form>
	</body>
</html>