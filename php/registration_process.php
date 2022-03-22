<?php

// Check if there is an active user, and redirect to the profile page
if(isset($_SESSION["login_id"])){
	header("location: profile.php");
}

// Variables to hold error values
$username_error= "";
$password1_error= "";
$password2_error= "";
$firstname_error= "";
$lastname_error= "";
$email_error= "";
$valid= true;

// Variables to hold field values on reload
$username= "";
$firstname= "";
$lastname= "";
$email= "";

// Regular expressions
$text_pattern="/^[a-zA-Z][a-zA-Z0-9 .-]{1,25}$/";
$email_pattern="/^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,4}$/";

// Sanitize function
function sanitize($input){
	$input= trim($input);
	$input= stripslashes($input);
	$input= htmlspecialchars($input);

	return $input;
}

// Start validation
if(isset($_POST["register"])){

	// Validate username
	if(empty($_POST["username"])){
		$username_error= "Username is required";
		$valid= false; 
	} else {
		$username= sanitize($_POST["username"]);

		if(!preg_match($text_pattern, $username)){
			$username_error= "Username is not valid.";
			$valid= false;
		} else {
			// Check if username already exists
			$sql_check= "SELECT username FROM users WHERE username= '$username'";
			$result_check= $connection->query($sql_check);
			if($result_check->num_rows > 0){
				$username_error= "Username ". $username. " already exists, please try another";
				$username= "";
				$valid= false;
			} 
		}
	}

	// Validate password
	if(empty($_POST["password1"])){
		$password1_error= "Password is required";
		$valid= false;
	} elseif(empty($_POST["password2"])){
		$password2_error= "Please repeat your password";
		$valid= false;
	} elseif($_POST["password1"] !== $_POST["password2"]){
		$password1_error= "Passwords don't match";
		$password2_error= "Passwords don't match";
		$valid= false;
	} else {
		$password= $_POST["password1"];
		$hash= password_hash($password, PASSWORD_BCRYPT);
	}

	// Validate first name
	if(empty($_POST["firstname"])){
		$firstname_error= "Your name is required";
		$valid= false; 
	} else {
		$firstname= sanitize($_POST["firstname"]);

		if(!preg_match($text_pattern, $firstname)){
			$firstname_error= "Your first name is not valid.";
			$valid= false;
		}
	}

	// Validate last name
	if(empty($_POST["lastname"])){
		$lastname_error= "Your name is required";
		$valid= false; 
	} else {
		$lastname= sanitize($_POST["lastname"]);

		if(!preg_match($text_pattern, $lastname)){
			$lastname_error= "Your last name is not valid.";
			$valid= false;
		}
	}

	// Validate email
	if(empty($_POST["email"])){
		$email_error= "Email is required";
		$valid= false; 
	} else {
		$email= sanitize($_POST["email"]);

		if(!preg_match($email_pattern, $email)){
			$email_error= "E-mail is not valid.";
			$valid= false;
		}
	}

	// Check if all fields are valid and save user in database
	if($valid == true){
		$username= $connection->real_escape_string($username);
		$firstname= $connection->real_escape_string($firstname);
		$lastname= $connection->real_escape_string($lastname);
		$email= $connection->real_escape_string($email);
		$login_id= $username. rand(1111, 9999);

		$sql= "INSERT INTO users (login_id, username, hash, role, firstname, lastname, email) VALUES ('$login_id', '$username', '$hash', '2', '$firstname', '$lastname', '$email')";

		$result= $connection->query($sql);

		if($result == true){
			// Data inserted succesfully to the database
			header("location: thankyou.php");
		} else {
			$error= "Something went wrong, please try again";
		}
	}

}

?>