<?php
//function to display purchase details form
function purchaseDetailsForm(){//called on lines 87, 121, 129, 159 of index.php
	//check the session to see if it is a returning user
	if (isset($_SESSION['howPurchased'])) {// if session howPurchased is set
		$howPurchased = $_SESSION['howPurchased'];//load it back into the howPurchased var
	} else if (isset($_POST['howPurchased'])){//if it is set in the post var
		$prev = $_POST['howPurchased'];//set it to the prev variable to check the value against the listed values
		if (($prev == "onLine") || ($prev == "byPhone") 
			|| ($prev == "mobileApp") || ($prev == "inStore")) {
			//if it any of these values load it to the howPurchased var
			$howPurchased = $_POST['howPurchased'];
		
		}
 	}
 	//same as above
 	if (isset($_SESSION['purchases'])) {
		$purchases = $_SESSION['purchases'];
	} else if (isset($_POST['purchases'])){
		$prev = $_POST['purchases'];
		if (($prev == "phone") || ($prev == "smartTv") 
			|| ($prev == "tablet") || ($prev == "homeTheatre") || ($prev == "laptop")) {
			$purchases = $_POST['purchases'];
			$_POST['next'] = 'Next';
		}
 	}
	

?>	
<!-- HTML form for purchase details -->
<h4>How did you complete your purchase?</h4>
<form action="" method="post">
<input type="radio" name="how" value="onLine">On Line
<input type="radio" name="how" value="byPhone">By Phone
<input type="radio" name="how" value="mobileApp">Mobile App
<input type="radio" name="how" value="inStore">In Store
<br><br>
<h3>Which of the following didyou purchase?</h3>
<input type="checkbox" name="Item" value="phone">Phone</input>
<input type="checkbox" name="Item" value="smartTv">Smart TV</input>
<input type="checkbox" name="Item" value="tablet">Tablet</input>
<input type="checkbox" name="Item" value="homeTheatre">Home Theatre</input>
<input type="checkbox" name="Item" value="laptop">Laptop</input>
<input type="submit" name="next" value="Next">
</form>
<?php
}//end purchaseDetails function
?>

<?php
//Function to validate the user input
function validatePuchasedItems(){//called on line 126 of indes.php
	$err_msgs = array();//declare err_msgs array
	if(isset($_POST['next'])){//if user clicks next button
		if(empty($_POST['Item'])){//check the post item var and if empty
			$err_msgs[] = "No item specified";//load message in error aray
		}elseif(empty($_POST['how'])){//check the user inputed how the item was purchased
			$err_msgs[] = "No purchase method specified";//if not load the message in the error array
		}	
	}
	//if errors return to be displayed
	return $err_msgs;
}//end of validatePuchasedItems function

//function to move the values from the post array to the session array and continue to the next form
function purchaseDetailsPostToSession(){//called on line 133 of index.php
	//load the values to the session array
	$_SESSION['item'] = $_POST['Item'];
	$_SESSION['howPurchased'] = $_POST['how'];
	
}//end of  purchaseDetailsPostToSession function
?>
