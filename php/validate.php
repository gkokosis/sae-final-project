<?php
//General info here

$pizza = "ordering pizza";
// Initializing variables
$valid = true;

// Variables to hold the final values
$fname="";
$email="";
$msg="";

// Error variables
$fname_error="";
$email_error="";
$msg_error="";


// Regular expressions
$text_pattern="/^[a-zA-Z][a-zA-Z0-9 .-]{1,25}$/";  //used for First and Last name
$email_pattern="/^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,4}$/";


/* Start validation */
if($_SERVER["REQUEST_METHOD"]=="POST")
{
	/* Validate first name */
	if(empty($_POST["fname"]))
	{
		$fname_error= "Name is required";
		$valid= false;
	}
	else
	{
		$fname= sanitize_input($_POST["fname"]);
		
		if(!preg_match($text_pattern, $fname))
		{
			$fname_error= "Your real name is required";
			$valid= false;	
		}
	}
	
	
	/* Validate e-mail */
	if(empty($_POST["email"]))
	{
		$email_error= "Email is required";
		$valid= false;
	}
	else
	{
		$email= sanitize_input($_POST["email"]);
		
		if(!preg_match($email_pattern, $email))
		{
			$email_error= "Email is not valid";
			$valid= false;	
		}
	}
	
	
	/* Validate message */
	if(strlen($_POST["msg"])== 0)
	{	
		$msg_error= "Message is required";
		$valid= false;	
	}
	else
	{
		$msg= sanitize_input($_POST["msg"]);
		
		if(strlen($msg)>500)
		{
			$msg_error= "Whoa, too much information, cut it down a bit!";
			$valid= false;	
		}
	}
	
	// Mail variables
	$own_mail= "test@georgioskokosis.eu";
	$subject= "Contact form";
	$headers= "From: Contact_form@georgioskokosis.eu";	  
	$safe_msg= wordwrap($msg, 70, "\r\n");
	$safe_msg= $safe_msg. "\r\n".
			   " ". "\r\n".	
			   "Contact info". "\r\n".
			   "Name: ". $fname. "\r\n".
			   "E-mail: ". $email; 		  
	
	// Thank you mail variables		  
	$thanks_subject= "Thank you for contacting us";
	$thanks_msg= "Hello ". $fname. "\r\n".
				 "Thank you for contacting Community Sports Center!". "\r\n".
				 "We have received your inquiry and will try to respond within 24 hours.". "\r\n".
				 "Contact team at C.S.C"  ;
	$thanks_headers= "From: George <test@georgioskokosis.eu>". "\r\n".
					 "Reply-To: George <test@georgioskokosis.eu>";		  
	
	/* Check if all the fields are valid and send mail to the site admin with the info */
	if($valid == true)
	{
		$pizza = "pizza!";
		$send_to_me= mail($own_mail, $subject, $safe_msg, $headers);
	} else {
		$pizza = "no pizza :(";
	}
	
	/* Check if mail sent correctly and sends thank you mail to the user. Redirects to the homepage */
	if($send_to_me == true)
	{
		mail($email, $thanks_subject, $thanks_msg, $thanks_headers);
		header("Location: index.php");
		exit;
	}
}


/* Functions used */
function sanitize_input($input)
{
	$input= trim($input);
	$input=	stripslashes($input);
	$input= htmlspecialchars($input);
	
	return $input;
}
?>