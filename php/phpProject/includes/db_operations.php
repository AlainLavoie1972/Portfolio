<?php

//function to connect to mysql db
function dbconnect(){
//vars for the connection string
$host = "localhost";
$user = "lilmamas_alain";
$db = "lilmamas_demo";
$pw = "!Lavoie36!";
//db connection string
$db_conn = mysqli_connect($host, $user, $pw, $db);
	if ($conn ->connect_errno) {
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}
	//return the connection
	return $db_conn;
}//end dbconnect() funtcion

//$db_conn = dbconnect();
//function to close connection to the db
function dbdisconnect($db_conn){
	$db_conn->close();
}//end of dbdisconnect function

?>