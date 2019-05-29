<!-- HTML FORM -->
<!DOCTYPE html>
<html>
<head>
	<title>Email Register Demo</title>
	<style type="text/css">
		header{
			text-align: center;
		}
	</style>
</head>
<body>
	<header><h1>Demo of an Sign Up Email Registration In Php</h1>
		<h3>When signing up it sends an email to the user with a link containing a randomly generated hash code.<br/> Once the user clicks the link they are prompted to enter a password to complete their account registration.</h3>
	</header>
	<br/>

	<?php
		include('signup.php'); //file for signup or signIn
	?>
</body>
</html>