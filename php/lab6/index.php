<?php 

if(isset($_POST['submit'])){


	$uname = $_POST['username'];
	$pw = $_POST['password'];
	$item = $_POST['itemRequested'];
	$price = $_POST['ppi'];
	$qty = $_POST['qty'];

	$ok = validateUser($uname, $pw);
	
	if($ok == false){
		echo "Please check form for errors";
	}elseif($ok == true){
		insert($uname,$pw,$item,$price,$qty);
	}
	
}

function insert($uname,$pw,$item,$price,$qty){

	$server   = "localhost";
	$user     = "al";
	$pswd     = "Crowley!72";
	$database = "processing";
	$user_id = null;
	$total = 0.0;
	$dbConn = new mysqli($server, $user, $pswd, $database);

	if($dbConn->connect_error){
	  	die("Connection failed: " . $dbConn->connect_error);
		}else{
			echo "Connected successfully<br>";
		}

	$query = ("INSERT INTO tblusers (username, password) 
	          VALUES ('$uname', '$pw')"); 
	$add_user = mysqli_query($dbConn, $query);

	if ($add_user){
		$user_id = $dbConn->insert_id;
		$total = $qty * $price;	
	}

	$query2 = ("INSERT INTO tblorders (userID, itemOrdered, price, qty, total) 
	          VALUES ('$user_id', '$item', '$price', '$qty', '$total')"); 
	$add_values = mysqli_query($dbConn, $query2);
	if($add_values){

	echo "Order successfully posted<br>";
	  print_r("User name: " . $uname . "<br>");

	  print_r("User Id: " . $user_id . "<br>");

	  print_r("Item Ordered : " . $item . "<br>");

	  print_r("Quantity: " . $qty . "<br>");

	  print_r("Total: " . $total . "<br>");

	  mysqli_close($dbConn);
	  
	}
}

function validateUser($user,$pw){
	$pass = true;
	if(strlen($user) <= 0){
		echo "Username must be chosen!";
		$pass = false;
	}elseif (strlen($user) > 20) {
		echo "User name must not be longer than 20 Characters!";
		$pass = false;
	}else{
		$pass = true;
	}
		
	if($pass == true){
		if(strlen($pw) <= 0){
			echo "Password must be chosen!";
			$pass = false;
		}elseif (strlen($pw) > 20) {
			echo "Password must not be longer than 20 Characters!";
			$pass = false;
		}else{
			$pass = true;
		}
	}
	return $pass;
}

?>
<header><h3>This example uses a function to validate the user name and password. Once they pass validation the item orderd, and details will be added to the database.<br/>The database consists of 2 tables. One table called tblusers which holds the user name and password. Table 2 holds the item details<br/>along with the inserted user ID from the user table for association<br/><br/>Enter any name password and item with price and qty. If added it will be displayed back with the total price.</h3></header>
<form method="post">
	Username: <input type="text" name="username" value="<?php $uname; ?>"><br/>
	Password: <input type="text" name="password" value="<?php $pw; ?>"><br/>
	Item Requested: <input type="text" name="itemRequested" value="<?php $item; ?>"><br/>
	Price per Item <input type="text" name="ppi" value="<?php $price; ?>"><br/>
	Qty: <input type="number" name="qty" value="<?php $qty; ?>"><br/>
	<input type="submit" name="submit">
</form>
