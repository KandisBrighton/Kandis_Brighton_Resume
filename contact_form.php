<?php
    $name = $_POST['name'];
	$mail = $_POST['mail'];
	//$url = $_POST['url'];
	$message = $_POST['message'];
	$to = 'kandisbrighton@gmail.com'; 
	$subject = 'Message from Resume Contact Form';

	mail($to, $subject, $message, "From: " . $mail);
//	header("Location: index.html");
?>