<?php
//if user clicks sing in button
if(isset($_POST['signin'])){//check the global post var for values needed
	if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['password']) && !empty($_POST['password'])){
		$username = $_POST['username'];//username from post array
		$password = $_POST['password'];//email from post array
		$db_conn = mysqli_connect("localhost", "al", "Crowley!72", "everify");//db connection string
		$qry = "SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1;";//query
		$result = mysqli_query($db_conn, $qry);//result of query against the db
		$user = mysqli_fetch_assoc($result);//fetch the record
		mysqli_close($db_conn);//close connection
		if($user){//if their is a result from the query
				$name = $user['username'];//username
				$em = $user['email'];//email
				$dateCreated = $user['created_at'];//date email was sent
				$updatedAt = $user['updated_at'];//date the db updated with new password
				//a simple display to show the user the record
				$msg = "<div class='statusmsg'><h3>User Name: " . $name . "<br/>Email was sent on: " . $dateCreated . "<br/>To: " . $em . "<br/>Updated Password on: " . $updatedAt . "</h3></div>";
				echo "$msg";
		}else{//else display error message
			$msg = "<div class='error'><h3>Sorry <br/> Username: " . $username . "<br/> Or <br/> Password: " . $password . "<br/> Do not match any users in the database.</h3></div>";
				echo "$msg";
		}
	}
}
?>
<!-- HTML FORM -->
<!DOCTYPE html>
<head>
<title>Sign In</title>
</head>
<style type="text/css">
	.statusmsg{
			    font-size: 20px;
			    padding: 3px; 
			    background: #aaf7c8; 
			    border: 1px solid #DFDFDF;
			}
	.error{
				font-size: 20px;
			    padding: 3px; 
			    background: #ea8383; 
			    border: 1px solid #DFDFDF; 
	}
</style>
</head>
<body>
	<div style="width: 40%; margin: 20px auto;">
		<form method="post">
			<h2>Sign In</h2>
			<input  type="text" name="username" value="<?php $username; ?>"  placeholder="Username">
			<input type="password" name="password" value="<?php $password ?>" placeholder="Password">
			<input type="submit" class="" name="signin" value="Sign In">
			<p>
				Not a Member Yet? <a href="index.php">Sign up</a>
			</p>
		</form>
	</div>
</body>
</html>