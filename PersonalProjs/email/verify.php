<?php
//variables needed to update the database
$email = "";
$hash = "";
//call the getUser function to retrieve the user from the db according to the hash
$user = getUser();//
$uid = (int)$user['user_id'];//the user id returned from the getUser function is a string so cast it to an INT 
$username = $user['username'];//the username

//function to get user from the database according to the hash emailed when registering
function getUser(){
//check that they are set in the GLOBAL get var
if(isset($_GET['email']) && $_GET['hash']){
	$email = $_GET['email'];//email
	$hash = $_GET['hash'];//hash
}

		$db_conn = mysqli_connect("localhost", "al", "Crowley!72", "everify");//db connection string
		$qry = "SELECT user_id, username, email , hash FROM users WHERE email='$email' AND hash='$hash' LIMIT 1;";//query to retrieve user
		$result = mysqli_query($db_conn, $qry);//result of of query
		$user = mysqli_fetch_assoc($result);//fetch the record
		mysqli_close($db_conn);
		return $user;//return the user as an array

}


//if user clicks register button after entering their password
if(isset($_POST['new_user'])){
	$username = $_POST['username'];//user name
	$password = $_POST['password'];//password
	$password_confirm = $_POST['password_confirm'];//password confirmation to verify they are the same

	//call the set password function and pass in the variables needed to confirm the passwords as well as update the database 
	setPassword($uid, $username, $password, $password_confirm);
}

function setPassword($uid, $username, $password, $password_confirm){

	$username = $username;//username
	$password = $password;//password
	$password_confirm = $password_confirm;//password verification
	//if they match
	if($password == $password_confirm){

		 $db_conn = mysqli_connect("localhost", "al", "Crowley!72", "everify");//db connection string
		 $qry = "UPDATE users SET password='$password' WHERE user_id='$uid';";// update query

		 $update = mysqli_query($db_conn, $qry);//update the db
		 //if update is true
		 if($update){//send message saying it was successfull
		 	echo "<div class='statusmsg'>Password changed succesfully</div>";
		 	$qry2 = "SELECT * FROM users WHERE username='$username';";
		 	$result = mysqli_query($db_conn, $qry2);//result of of query
			$user = mysqli_fetch_assoc($result);//fetch the record
			if($user){//if their is a result from the query
				$name = $user['username'];//username
				$em = $user['email'];//email
				$dateCreated = $user['created_at'];//date email was sent
				$updatedAt = $user['updated_at'];//date the db updated with new password
				//a simple display to show the user the record
				$msg = "<div class='statusmsg'><h3>User Name: " . $name . "<br/>Email was sent on: " . $dateCreated . "<br/>To: " . $em . "<br/>Updated Password on: " . $updatedAt . "</h3></div>";
				echo "$msg";
				mysqli_close($db_conn);
			}
		 }else{//else send error msg
		 	echo "<br><div class='error'>Something went wrong?</div>";
		 	mysqli_close($db_conn);
		 }
	}

}

?>
<!-- Html form  -->
<!DOCTYPE html>
 
<head>
    <title>Account Verification</title>
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

<?php if($user > 0): ?>
<form method="post" action="">
	<input  type="text" name="username" value="<?php echo $username; ?>" >
	<input type="text" id="firstpass" name="password" value="" placeholder="Chose your password">
	<input type="password" id="passconf" name="password_confirm" value="" placeholder="Retype your password">
	<div id="passchkdiv"></div>
			<button type="submit" class="" name="new_user">Register</button>	
</form>
<?php elseif($user <= 0): ?>
	<div class="statusmsg"><h3>The url is either invalid or you already have an activated account</h3></div>
<?php endif ?>

</body>
</html>