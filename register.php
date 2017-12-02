<?php include('includes/top.php'); ?>

	<div id="create">
		<h1>Registration</h1>
		<form name="registration" action="" method="POST">
			<table id="registration">
				<tr>
					<td><input type="text" name="firstName" placeholder="First Name"></td>
				</tr>
				<tr>
					<td><input type="text" name="lastName" placeholder="Last Name"></td>
				</tr>
				<tr>
					<td><input type="email" name="email" placeholder="Email Address"></td>
				</tr>
				<tr>
					<td><input type="password" name="password" placeholder="Password"></td>
				</tr>
				<tr>
					<td><input type="password" name="passwordc" placeholder="Confirm Password"></td>
				</tr>
				<tr>
					<td><input type="submit" name="registerSubmit" value="Register" class="submit"></td>
				</tr>
			</table>
		</form>
	</div>
	</body>
</html>
