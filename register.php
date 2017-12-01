<?php include('includes/top.php'); ?>

		<h1>Registration</h1>
		<form name="registration" action="" method="POST">
			<table id="registration">
				<tr>
					<td><label for="firstName">First Name</label></td>
					<td><input type="text" name="firstName"></td>
				</tr>
				<tr>
					<td><label for="lastName">Last Name</label></td>
					<td><input type="text" name="lastName"></td>
				</tr>
				<tr>
					<td><label for="email">Email Address</label></td>
					<td><input type="email" name="email"></td>
				</tr>
				<tr>
					<td><label for="password">Password</label></td>
					<td><input type="password" name="password"></td>
				</tr>
				<tr>
					<td><label for="passwordc">Confirm Password</label></td>
					<td><input type="password" name="passwordc"></td>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" name="registerSubmit" value="Register"></td>
				</tr>
			</table>
		</form>
	</body>
</html>