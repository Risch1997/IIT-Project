<?php 

// Create a new user and add it to the `users` database
function create_user($firstName, $lastName, $email, $password) {
    global $dbcon;

    // Fail-safe
    if (user_exists($email))
        return false;

    // Generate random salt
    $salt = hash('sha256', uniqid(mt_rand(), true));

    // Prepend the salt to the password and hash it
    $salted = hash('sha256', $salt . $password);

    // Inset the new user into the `users` database
    $dbcon->exec("INSERT INTO `users`
    ( `firstName`, `lastName`, `email`, `password`, `salt` )
    VALUES
    ( '$firstName', '$lastName', '$email', '$salted', '$salt' )");

    // If we made it this far we were successful
    return true;
}

// Attempt to log in with given email and password combination
function login($email, $password) {
    global $dbcon;

    // Query `users` database for this user's salt, get's set to empty string by default
    $query = $dbcon->query("SELECT `salt` FROM `users` WHERE `email`='$email';");
    $query = $query->fetch(PDO::FETCH_ASSOC);
    $salt = ($query) ? $query['salt'] : '';

    // Prepend the salt to the entered password and hash it
    $salted = hash('sha256', $salt . $password);

    // Query `users` database for entry with entered email and salted password
    $query = $dbcon->query("SELECT * FROM `users` WHERE `email`='$email' AND `password`='$salted';");
	if($query->rowCount() > 0) {
		$user = $query->fetch(PDO::FETCH_ASSOC);
		
		// Set session variables
		$_SESSION['userID'] = $user['userID'];
		$_SESSION['status'] = 'authorized';

		return true;
	}
	else
		return false;
}

// Log the current user out
function logout() {
    // Unset session variables
    unset($_SESSION['user_id']);
    unset($_SESSION['status']);

    // Clear browser cookie
    setcookie(session_name(), time() - 72000);

    // Destroy session
    session_destroy();
}

function user_exists($email) {
    global $dbcon;

    // Query database for a user with the given email
    $query = $dbcon->query("SELECT * FROM `users` WHERE `email`='$email'");
    $user = $query->fetch(PDO::FETCH_ASSOC);

    // Check if we found any users and return accordingly
    if (count($user) > 1)
        return true;
    else
        return false;
}

?>