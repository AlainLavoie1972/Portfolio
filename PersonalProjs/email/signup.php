<?php
//empty vars
$username = "";
$email = "";
//if user clicks register
if(isset($_POST['new_user'])){
	//check their is text in the textboxes
		if(isset($_POST['username']) && !empty($_POST['username']) AND isset($_POST['email']) && !empty($_POST['email'])){
        	//get username from global var POST
			$username = $_POST['username'];
			//get email from global var POST
    		$email = $_POST['email'];
    		//generate the random hash value to construct the url link for verification
    		$hash = md5( rand(0,1000));
    		 
    		 		
					$db_conn = mysqli_connect("localhost", "al", "Crowley!72", "everify");//db connection string
					if($db_conn){//if conection is successful
						//insert qry
						$qry = "INSERT INTO users (username, email, password, hash, created_at, updated_at) VALUES ('$username', '$email', 'null', '$hash', now(), now());";
						//run the query against the db
						$result = mysqli_query($db_conn, $qry);
						
								

							//email header data
							$to      = $email;//user email
							$subject = 'Signup | Verification';//subject of email
							//message body line 42 is the link created with the users email and randomly generated hash value
							$message = '
							 
							Thanks for signing up!' . "\n" . '
							Your account has been created, Click the link below to create your password.' . "\n" . '
							After creating your password you can sign in and fill out your profile.
							 
							------------------------
							Username: '. $username .'
							------------------------
							 
							Please click this link to activate your account:
							http://localhost/email/verify.php?email='.$email.'&hash='.$hash.'
							 
							'; 
							                     
							$headers = 'From: alain@lavoiedevelopment.com' . "\r\n"; //extra headers
							mail($to, $subject, $message, $headers);//mail function creates the ability to send email directly from your website. 

							mysqli_close($db_conn);
							//send a message to the user that registration was successful and to check email
					$msg = "<div class='stausmsg'>Account created <br /> please verify it by clicking the activation link that has been sent to your email.</div>";
			 		}else{
			 			//if connection fails
						die(mysqli_error($db_conn));
						$msg = "<div class='error'>Something went wrong <br /> Please try again.</div>";
					}
    	}
}


 

?>
<!-- HTML FORM -->
<!DOCTYPE html>
<head>
<title>Sign up </title>
<!-- styles for the messages -->
<style type="text/css">
	.statusmsg{
			    font-size: 12px;
			    padding: 3px; 
			    background: #aaf7c8;
			    border: 1px solid #DFDFDF;
			}
	.error{
				font-size: 12px;
			    padding: 3px; 
			    background: #ea8383;
			    border: 1px solid #DFDFDF;
	}
</style>
</head>
<body>
	<div style="width: 40%; margin: 20px auto;">
		<form method="post">
			<h2>Registration</h2>
			<input  type="text" name="username" value="<?php echo $username; ?>"  placeholder="Username">
			<input type="email" name="email" value="<?php echo $email ?>" placeholder="Email">
			<input type="submit" class="" name="new_user" value="Register">
			<p>
				Already a member? <a href="signin.php">Sign in</a>
			</p>
		</form>
	</div>
</body>
</html>

