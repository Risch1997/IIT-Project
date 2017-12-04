 <?php include('includes/top.php'); ?>

 		<?php
 			if(isset($_POST['joinSubmit'])) {
 				$groupCode = isset($_POST['groupCode']) ? make_safe($_POST['groupCode']) : '';

 				if(!$groupCode) {
 					$error = "An error has occurred: You did not enter a valid group code. Group codes are 8 character string containing upper and lower case letters, as well as numbers.";
 				}
 				else {
 					$query = $dbcon->query("SELECT * FROM `groups` WHERE `groupCode` = '$groupCode'");
 					if($query->rowCount() > 0) {
 						$group = $query->fetch(PDO::FETCH_ASSOC);
 						$groupID = $group['groupID'];
 						$dbcon->exec("INSERT INTO `group_users` (`groupID`, `userID`) VALUES($groupID, " . $_SESSION['userID'] . ")");
 						header("Location: index.php");
 					}
 					else
 						$error = "It appears that the code you provided is not associated with any group in ChoreTracker. Please try again.";
 				}
 			}
 		?>

 		<form name="joinGroup" action="" method="POST">
 			<?php if(isset($error)) echo $error; ?>
 			<table id="jointable">
				<h1>Enter Group Code<h1>
 				<td><input type="text" name="groupCode" placeholder="Enter provided code" style="display:block; clear:none; position: relative;"></td>
 				<td><input type="submit" name="joinSubmit" value="Join!" class="submit"></td>
 			</table>
 		</form>

 <?php include('includes/footer.php'); ?>
