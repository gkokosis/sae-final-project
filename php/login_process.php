<?php 
// Check if there is an active user, and redirect to the profile page
if(isset($_SESSION["login_id"])){
	header("location: profile.php");
}

// Start login
$error= "";

if(isset($_POST["login"])){
	// Check for empty fields
	if(empty($_POST["username"]) or empty($_POST["password"])){
		$error= "Please complete both username and password";
	} else {
		$username= $connection->real_escape_string($_POST["username"]);
		$password= $_POST["password"];

		$sql= "SELECT * FROM users WHERE username= '$username'";

		$result= $connection->query($sql);

		// Check if the info match a record in the database
		if($result->num_rows == 1){
			$row= $result->fetch_assoc();
			if(password_verify($password, $row["hash"])){
				// Login succesfull
				$_SESSION["login_id"] = $row["login_id"];
				$_SESSION["user_id"] = $row["id"];
				$_SESSION["firstname"] = $row["firstname"];
				$_SESSION["role"] = $row["role"];

				/* If the user came here from a resource page we will redirect him 
				back to that page, otherwise we redirect him to the profile page */
				if(isset($_GET["from"])) {
					$resource_id = $_GET["from"];
					header("location: resource.php?resource=". $resource_id);
				} else {
					header("location: profile.php");
				}
			} else {
				// Wrong password
				$error= "Username and password don't match";
			}
		} else {
			// Wrong username or username does not exist
			$error= "Username and password don't match";
		}
	}
}
?>