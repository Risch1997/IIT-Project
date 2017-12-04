<?php include('includes/top.php'); ?>
		<?php
		if(isset($_SESSION['status']) && $_SESSION['status'] == 'authorized') {
			echo "
			<h1>Create a New Group</h1>
			<form name=\"createGroup\" action=\"\" method=\"POST\">
				<table id=\"createGroup\">
					<tr>
						<td><label for=\"groupName\">Group Name</label></td>
						<td><input type=\"text\" name=\"groupName\"></td>
					</tr>
					<tr>
						<td></td>
						<td><input type=\"submit\" name=\"groupSubmit\" value=\"Create Group\"></td>
					</tr>
				</table>
			</form>";
		}
		else {
			header("Location: login.php");
		}
		?>

<?php include('includes/footer.php') ?>	