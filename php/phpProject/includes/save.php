<?php
//function to display back to the user the information inputed from all the forms
function surveySaveForm(){//called on line 155 of index.php
?>
<!-- HTML table to display users input back to them -->
	<h2>Survey Review</h2>
	<form method="POST" >
	<table>
	<tr><td><h3>Student</h3></d><td><?php echo $_SESSION['student']; ?></td></tr>
	<tr><td><h3>Full Name</h3></td><td><?php echo $_SESSION['full_name']; ?></td></tr>
	<tr><td><h3>Age</h3></td><td><?php echo $_SESSION['age']; ?></td></tr>
<?php if (isset($_SESSION['item'])){ ?>
	<tr><td><br></td><td></td></tr>
	<tr><td><h3>Item Puchased</h3></td><td><?php echo $_SESSION['item']; ?></td></tr>
<?php } ?>
<?php if (isset($_SESSION['howPurchased'])){ ?>
	<tr><td><h3>Purchased by</h3></td><td><?php echo $_SESSION['howPurchased']; ?></td></tr>
<?php } ?>

<?php if (isset($_SESSION['recommend'])){ ?>
	<tr><td><br></td><td></td></tr>
	<tr><td><h3>Recommendation</h3></td><td><?php echo $_SESSION['recommend']; ?></td></tr>
<?php } ?>
<?php if (isset($_SESSION['sat'])){ ?>
	<tr><td><h3>Satisfaction Level(1-5)</h3></td><td><?php echo $_SESSION['satisfaction']; ?></td></tr>
<?php } ?>

	</table>
    <table>
    <tr>
        <td><input type="submit" name="back" value="Back"></td>
        <td><input type="submit" name="next" value="Save"></td>
    </tr>
    <tr>
		<td><input type="submit" name="cancel" value="Cancel"></td>
    </tr>
    </table>
	</form>
<?php
}//end surveySaveForm
?>
<?php
//function to save users input to the db
function saveContact(){//called on line 166 of index.php
	$db_conn = dbconnect();//get the connection string and connect to the db from db_operations.php file
	//load the values from the session array into varables for easier query string
	$student = $_SESSION['student'];
	$fullname = $_SESSION['full_name'];
	$age = $_SESSION['age'];
	$item = $_SESSION['item'];
	$how = $_SESSION['howPurchased'];
	$rec = $_SESSION['recommend'];
	$sat = $_SESSION['satisfaction'];
	//check the rec variable to change it from Yes or No to Y or N to match column value
	if($rec == "No"){
		$reco = "N";
	}elseif($rec == "Yes"){
		$reco = "Y";
	}
	//if connection fails display error message
if(!$db_conn){
	echo "Something went wrong!";

}else{//if connection succesful
	//query to insert customer info to the customer table
	$qry_cus = "INSERT INTO customer (full_name, age, student, cus_created, cus_modified, cus_deleted) VALUES ('$fullname', ' $age ', ' $student ', now(), now(), 'N');";
		//if values loaded successfully
		if($db_conn->query($qry_cus)){
			//start to build the html to display back to user once all the info has been uploaded
			$html = "<h1>Your Survey Was Successfully Uploaded</h1><br>" .
					"<h3>Name: " . $fullname . "</h3><br>" .
					"<h3>Age:  " . $age . "</h3><br>" .
					"<h3>Student: " . $student . "</h3><br>"; 

		}
		//get the inserted id of the customer to use as foreign keys in other tables
	$id = $db_conn->insert_id;
	//query to insert purchase details info to the purchasedItem table
	$qry_pur = "INSERT INTO purchasedItems (purch_cusId, howPurchased, purchases, purch_created, purch_modified) VALUES ($id, '$how', '$item', now(), now());";
			//if values loaded successfully
			if($db_conn->query($qry_pur)){
				//continue to build the html to display back to user once all the info has been uploaded
				$html .= "<h3>Purchased by: " . $how. "</h3><br>" .
						 "<h3>Item Purchased:  " . $item . "</h3><br>" .
						 "<h3>Purchased On: " . date("Y-m-d") . "</h3><br>"; 
			}
	//query to insert satisfaction  info to the satisfaction table
	$qry_sat = "INSERT INTO satisfaction (sat_cusId, satisfaction, recommend, sat_created, sat_modified) VALUES ($id, $sat, '$reco', now(), now());";
		//if values loaded successfully
		if($db_conn->query($qry_sat)){
			//continue to build the html to display back to user once all the info has been uploaded
				$html .= "<h3>Satisfaction (1-5): " . $sat. "</h3><br>" .
						 "<h3>Would Recommend:  " . $rec . "</h3><br>";
						 
		}
	}
	//function to disconnect from the db found in db_operations.php file
	dbdisconnect($db_conn);
	//complete the message back to the user
	$html .= "<br><h3>We thank you very much for taking the survey.</h3>";
	//return the html to be echoed back to the user
	return $html;
}//end of saveContact() funtion


?>
