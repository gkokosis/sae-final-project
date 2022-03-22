<?php
require "php/connection.php";
session_start();

require "php/find_resources.php";

require "php/registration_process.php";

?>

<!DOCTYPE html>
<html>
<head>
<title>Register</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/login.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="javascript/toggle_login.js"></script>
</head>

<body>

<?php require "php/header.php"; ?>

<main>
	<div id="registration_container" class="container clearfix">
		<h1 class="title">Sign up</h1>
		<form action="" method="post">
			<div class="entry">
				<label for="username">Username</label>
				<input type="text" name="username" id="username" value="<?php echo $username; ?>" />
				<p class="error"><?php echo $username_error; ?></p>
			</div>
			<div class="clearfix">
				<div class="entry left">
					<label for="password1">Password</label>
					<input type="password" name="password1" id="password1" />
					<p class="error"><?php echo $password1_error; ?></p>
				</div>
				<div class="entry left">
					<label for="password2">Repeat password</label>
					<input type="password" name="password2" id="password2" />
					<p class="error"><?php echo $password2_error; ?></p>
				</div>
			</div>
			<div class="clearfix">	
				<div class="entry left">
					<label for="firstname">First name</label>
					<input type="text" name="firstname" id="firstname" value="<?php echo $firstname; ?>" />
					<p class="error"><?php echo $firstname_error; ?></p>
				</div>
				<div class="entry left">
					<label for="lastname">Last name</label>
					<input type="text" name="lastname" id="lastname" value="<?php echo $lastname; ?>" />
					<p class="error"><?php echo $lastname_error; ?></p>
				</div>
			</div>
			<div class="entry">
				<label for="email">E mail</label>
				<input type="email" name="email" id="email" value="<?php echo $email; ?>" />
				<p class="error"><?php echo $email_error; ?></p>
			</div>
			<div id="register_submit">
				<input type="submit" name="register" id="register" />
			</div>
		</form>
		<p class="link"><a href="login.php">Already a member? Log in!</a></p>
	</div>	
</main>

<?php require "php/footer.php"; ?>

</body>
</html>