<?php

/* Check if user role is correct for displaying this page, and redirect him
accordingly if not */
if(isset($_SESSION["login_id"])) {
	if($_SESSION["role"] == 1) {
		header("location: admin.php");
	}
} else {
	header("location: login.php");
}

/* Find out if the user has any active bookings. This will be used later in the html 
in order to create a table displaying the active bookings */
date_default_timezone_set("Europe/London");
		
$user_id = $_SESSION["user_id"];
$timestamp = new DateTime("today");
$today = $timestamp->format("U");

$new_timestamp = new DateTime;

$user_info_sql = "SELECT booking_day, name FROM bookings INNER JOIN resources ON bookings.resource_id = resources.id WHERE bookings.user_id = '$user_id' AND bookings.booking_day >= '$today' ORDER BY bookings.booking_day";

$user_info_result = $connection->query($user_info_sql);

/* Edit details script */

/* Initialize variables */
$email = "";
$email2 = "";

$email_error = "";
$email2_error = "";
$password_error = "";
$password2_error = "";
$old_password_error = "";

$email_valid = true;
$password_valid = true;

$email_outcome = "";
$password_outcome = "";

/* Regular expressions */
$email_pattern="/^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,4}$/";

// Sanitize function
function sanitize($input){
	$input= trim($input);
	$input= stripslashes($input);
	$input= htmlspecialchars($input);

	return $input;
}

// Validate email
if(isset($_POST["change_email"])) {
	$email = sanitize($_POST["email"]);
	$email2 = sanitize($_POST["email2"]);
	if(empty($_POST["email"])){
		$email_error= "Email is required";
		$email_valid= false; 
	} elseif(empty($_POST["email2"])) {
		$email2_error = "Please repeat your email";
		$email_valid = false;
	} elseif($_POST["email"] !== $_POST["email2"]) {
		$email2_error = "Emails don't match";
		$email_valid = false;
	} else {
		$email= sanitize($_POST["email"]);

		if(!preg_match($email_pattern, $email)){
			$email_error= "E-mail is not valid.";
			$email_valid= false;
		}
	}

	if($email_valid == true){
		$email= $connection->real_escape_string($email);

		$change_email_sql= "UPDATE users SET email ='$email' WHERE id = '$user_id'";

		$change_email_result= $connection->query($change_email_sql);

		if($change_email_result == true){
			// Email succesfully changed
			$email_outcome = "Email updated succesfully!";
			$email = "";
			$email2 = "";
		} else {
			$email_outcome = "Something went wrong, please try again";
		}
	}
}


// Validate password
if(isset($_POST["change_password"])) {
	if(empty($_POST["old_password"])) {
		$old_password_error = "The old password is required";
		$password_valid = false;
	} elseif(empty($_POST["password"])){
		$password_error= "Password is required";
		$password_valid= false;
	} elseif(empty($_POST["password2"])){
		$password2_error= "Please repeat your password";
		$password_valid= false;
	} elseif($_POST["password"] !== $_POST["password2"]){
		$password2_error= "Passwords don't match";
		$password_valid= false;
	} else {
		$password= $_POST["password"];
		$hash= password_hash($password, PASSWORD_BCRYPT);
		$old_password = $_POST["old_password"];

		$check_old_password_sql = "SELECT * FROM users WHERE id = '$user_id'";

		$check_old_password_result = $connection->query($check_old_password_sql);

		if($check_old_password_result->num_rows == 1){
			$row= $check_old_password_result->fetch_assoc();
			if(password_verify($old_password, $row["hash"]) == false ){
				$old_password_error = "This is not the correct password";
				$password_valid = false;	
			}
		}
	}

	if($password_valid == true){

		$change_password_sql = "UPDATE users SET hash ='$hash' WHERE id = '$user_id'";

		$change_password_result = $connection->query($change_password_sql);

		if($change_password_result == true){
			
			$password_outcome = "You succesfully set a new password!";
		} else {
			$password_outcome = "Something went wrong, please try again";
		}
	}
}

?>