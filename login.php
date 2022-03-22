<?php
require "php/connection.php";
session_start();

require "php/find_resources.php";

require "php/login_process.php";
?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/login.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="javascript/toggle_login.js"></script>
</head>

<body>

<?php require "php/header.php"; ?>

<main>
	<div id="login_container" class="container clearfix">
		<h1 class="title">Login</h1>
		<form action="" method="post" id="login_form">
			<label for="username">Username</label>
				<input type="text" name="username" id="username" autocomplete="off" />
			<label for="password">Password</label>	
				<input type="password" name="password" id="password" />
				<input type="submit" name="login" id="login" value="Login" />
		</form>
		<p class="error"><?php echo $error; ?></p>
		<p class="link"><a href="register.php">Not a member? Sign up!</a></p>
	</div>	
</main>

<?php require "php/footer.php"; ?>

</body>
</html>
