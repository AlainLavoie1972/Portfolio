<?php

 if(isset($_POST['submit'])){
$server   = "localhost";
$user     = "al";
$pswd     = "Crowley!72";
$database = "validate";

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$email_personal = $_POST['personal_email'];
$phone = $_POST['phone'];
$phone_personal = $_POST['personal_phone'];


$dbConn = new mysqli($server, $user, $pswd, $database);

	if($dbConn->connect_error){
	  die("Connection failed: " . $dbConn->connect_error);
	}
	echo "Connected successfully<br>";

	$query = ("INSERT INTO demo (first_name, last_name, email, email_personal, phone, phone_personal) 
	          VALUES ('$first_name', '$last_name', '$email', '$email_personal', '$phone', '$phone_personal')"); 

	if (mysqli_query($dbConn, $query)){
	  echo "1 Record Added <br>";
	  print_r("First Name: " . $first_name . "<br>");

	  print_r("Last Name: " . $last_name . "<br>");

	  print_r("Email : " . $email . "<br>");

	  print_r("Email Personal: " . $email_personal . "<br>");

	  print_r("Phone: " . $phone . "<br>");

	  print_r("Phone Personal: " . $phone_personal . "<br>");

	  mysqli_close($dbConn);
	  
	  	echo "Connection closed";
	 
	}
	else{
	  echo "Insert Failed <br>";
	  print_r("First Name: " . $first_name . "<br>");

	  print_r("Last Name: " . $last_name . "<br>");

	  print_r("Email : " . $email . "<br>");

	  print_r("Email Personal: " . $email_personal . "<br>");

	  print_r("Phone: " . $phone . "<br>");

	  print_r("Phone Personal: " . $phone_personal . "<br>");
	  mysqli_close($dbConn);
	  
	  	echo "Connection closed";

	}
}

?>