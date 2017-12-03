<?php
session_start();
include('resources/functions/load.php');
?>
<!doctype html>
<html>
	<head>
		<title>Chore Tracker</title>
		<meta charset="utf-8">
		<link rel="stylesheet"  href="style.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	<body>

			<h1 class="Name"><a href="index.php">ChoreTracker.com</a></h1>

			<?php
			if(isset($_SESSION['status']) && $_SESSION['status'] == 'authorized') {
				$query = $dbcon->query("SELECT * FROM `users` WHERE userID = " . $_SESSION['userID']);
				$user = $query->fetch(PDO::FETCH_ASSOC);

				echo "
				<div class=\"SignUp\">
					Welcome, " . $user['firstName'] . "! <a href=\"index.php?status=logout\">Logout</a>
				</div>";
			}
			else{
				echo "<div class=\"SignUp\"><a href=\"login.php\">Log In</a></div>";
			}
			?>

<?php

// Handle users logging in
if (isset($_POST['loginSubmit'])) {
    // Get input values from form
    $email = isset( $_POST['email'] ) ? make_safe($_POST['email']) : '';
    $password = isset( $_POST['password'] ) ? make_safe($_POST['password']) : '';

    // Check if fields are filled
    if (!$email || !$password) {
        echo "<script>console.log( 'Both an email and password are required' );</script>";
    } else {
        if (login($email, $password)) {
            echo "<script>console.log( 'Successfully logged in!' );</script>";
            header('Location: index.php');
        }
		else {
            echo "<script>console.log( 'Incorrect email or password' );</script>";
        }
    }
}

//Register a new user
if(isset($_POST['registerSubmit'])) {
    $firstName = isset( $_POST['firstName'] ) ? make_safe($_POST['firstName']) : '';
    $lastName = isset( $_POST['lastName'] ) ? make_safe($_POST['lastName']) : '';
    $email = isset( $_POST['email'] ) ? make_safe($_POST['email']) : '';
	$password = isset( $_POST['password'] ) ? make_safe($_POST['password']) : '';
    $passwordc = isset( $_POST['passwordc'] ) ? make_safe($_POST['passwordc']) : '';

    if (!$firstName || !$lastName || !$email || !$password || !$passwordc) {
        echo "<script>alert( 'All fields must be filled in' );</script>";
    }
	else if (user_exists($email)) {
        echo "<script>alert( 'A user with that email already exists' );</script>";
    }
	else if ($password != $passwordc) {
        echo "<script>alert( 'Passwords must match' );</script>";
    }
	else {
        if (create_user($firstName, $lastName, $email, $password)) {
            if (login($email, $password)) {
                $_SESSION["state"] = "new_user";
                header('Location: index.php');
            }
        } else {
            echo "<script>alert( 'Woops! Something seems to have went wrong' );</script>";
        }
    }
}

//Log a User Out
if(isset($_GET['status']) && $_GET['status'] == 'logout') {
	logout();
}

?>
