<?php include('includes/top.php'); ?>
	
		<?php
			if(isset($_POST['groupSubmit'])) {
				$groupName = isset($_POST['groupName']) ? make_safe($_POST['groupName']) : '';
				$groupCode = randomString();
				
				if(!$groupName) {
					$error = "An error has occurred: You did not enter a valid group name.";
				}
				else {
					$dbcon->exec("INSERT INTO `groups` (`groupName`, `groupCode`) VALUES('$groupName', '$groupCode')");
					$groupID = $dbcon->lastInsertId();
					$dbcon->exec("INSERT INTO `group_users` (`groupID`, `userID`) VALUES($groupID, " . $_SESSION['userID'] . ")");
					$query = $dbcon->query("SELECT * FROM `users` WHERE userID = " . $_SESSION['userID']);
					$user = $query->fetch(PDO::FETCH_ASSOC);
					$i = 1;
					while(isset($_POST['email'.$i])) {
						$recipient = make_safe($_POST['email'.$i]);
						$subject = "ChoreTracker: You have been invited to a new group!";
						$message = "Hello,

You have been invited by " . $user['firstName'] . " " . $user['lastName'] . " to join the group $groupName on ChoreTracker. You can join the group by logging in to Chore Tracker and using the following Group Code:

$groupCode

If you think you have received this message in error, please ignore this email.";
						if(!mail($recipient, $subject, $message))
							$error = "An error occurred: Unable to send email to $recipient";
						$i++;
					}
					header("Location: index.php");
				}
			}
		?>

		<div id="creategroupdiv">
			<h1>Create Group</h1>
			<?php if(isset($error)) echo $error; ?>
			<form name="creategroup" action="" method="POST">
				<table id="createGroupTable">
					<tr>
						<td><input type="text" name="groupName" placeholder="Create a group name"></td>
					</tr>
					<tr>
						<td><input type="text" name="email1" placeholder="Send invitation to valid email address"></td>
					</tr>
				</table>
				<button class="submit" type="button" id="addEmail">Add Another Email</button><input type="submit" name="groupSubmit" value="Create" class="submit">
			</form>
		</div>

<?php include('includes/footer.php'); ?>
