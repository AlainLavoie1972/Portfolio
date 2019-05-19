<?php
//function to display customer satisfaction form
function customerSatisfactionForm(){//called on lines 91, 136, 173 of index.php
	$rec = "";//empty variable
	//check the session variable for returning user
	if (isset($_SESSION['recommend'])) {
		$rec = $_SESSION['recommend'];//if returning load the value back into the rec variable
	} else if (isset($_POST['recommend'])){//if set in post
		$rec1 = $_POST['recommend'];//check the value matches one of the values listed
		if (($rec1 == "Yes") || ($rec1 == "No")) {
			//if it matches load it in the rec variable
			$rec = $_POST['recommend'];
		}
 	}
 	//same as above
 	$sat = "";
 	if (isset($_SESSION['satisfaction'])){
 		$sat = $_SESSION['satisfaction'];
 	}else if (isset($_POST['satisfaction'])){
 		$sat1 = $_POST['satisfaction'];
 		if(($sat1 == 1 ) || ($sat1 == 2)
 			|| ($sat1 == 3) || ($sat1 == 4) || ($sat1 == 5)){
 			$sat = $_POST['satisfaction'];
 		}
 	}
 
 
?>
<!-- HTML form to get users satisfaction -->
<form method="POST">
	<table>
		<tr>
			<td>
				<label for="sat"><h3>How happy are you this device(s) on a scale<br>of 1 (not satified) to 5 (very satisfied)? :</h3></label>
				<input name="sat" type="radio" value="1">1
				<input name="sat" type="radio" value="2">2
				<input name="sat" type="radio" value="3" checked="checked">3
				<input name="sat" type="radio" value="4">4
				<input name="sat" type="radio" value="5">5
			</td>
		</tr>
	</table>
	<h3>Would you recommend the puchase of this device to a friend ?</h3>
	<table>
		<tr><td><label for="recommend">Recommend:</label></td>
			<td><select id="recommend" name="recommend" size="1">
<?php if((strlen($rec) ==0) ){ ?>
				<option selected="true" disabled="disabled" value="Recomend">Choose one</option>
<?php } else { ?>
				<option value="">Choose One</option>
<?php }
	  if ($rec == "Yes"){ ?>
				<option selected="selected" value="Yes">Yes</option>
<?php } else { ?>
				<option value="Yes">Yes</option>
<?php }
	  if ($rec == "No"){ ?>
				<option selected="selected" value="No">Friend</option>
<?php } else { ?>
				<option value="No">No</option>

<?php } ?>
			</select></td>
		</tr>
	</table>
	<br>
	<table>
		<tr><td><input type="submit" name="back" value="Back"></td>
		    <td><input type="submit" name="next" value="Save"></td>
		</tr>
		<tr><td><input type="submit" name="cancel" value="Cancel"></td>
		</tr>
	</table>

</form>

<?php

}//end customerSatisfactionForm function

?>

<?php
//function to validate the user input
function validateRecommend(){//called on line 146 of index.php
	$err_msgs = array();//declare error msgs array
	if (!isset($_POST['recommend'])){//check the user chose yes or no to recommend
		$err_msgs[] = "No recommendation specified";//if not load message into error array
	} else {//if user has chose yes or no
		//The trim() function is used to remove the white spaces and other predefined characters from the left and right sides of a string. 
		$recommend = trim($_POST['recommend']);
		if (!(($recommend == "Yes")//if recommend is not one of the values listed
			  || ($recommend == "No"))) {
			//load message into the error array
			$err_msgs[] = "A recommendation must be chosen.";
		}
	}
	if (count($err_msgs) == 0){
		$_POST['recommend'] = $recommend;
	}
	return $err_msgs;

	//same as above
	$err_msgs = array();
	if (!isset($_POST['sat'])){
		$err_msgs[] = "No satifaction specified";
	} else {
		$sat = trim($_POST['sat']);
		if (!(($sat == 1) || ($sat == 2)
			||($sat == 3) || ($sat == 4) || ($sat == 5))) {
			$err_msgs[] = "Please choose between 1-5 for satisfation.";
		}
	}
	if (count($err_msgs) == 0){
		$_POST['satisfaction'] = $sat;
	}
	//return errors if any for display
	return $err_msgs;
}//end of validateRecommend() function

?>

<?php
//function to transfer the values from post to session array
function customerSatisfactionPostToSession(){//called on line 153 of index.php
	//tranfer post values to session array
	$_SESSION['recommend'] = $_POST['recommend'];
	$_SESSION['satisfaction'] = $_POST['sat'];
}//end customerSatisfactionPostToSession function

?>
