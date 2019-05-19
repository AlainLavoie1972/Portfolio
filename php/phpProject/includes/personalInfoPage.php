
<?php

function personalInfoForm(){//function to display the personal information form
	//empty variable declaration
	$full_name = "";
	$age = "";
	$student = "";
	//check to see if this a returning user 
	if (isset($_SESSION['student'])) {//if student var is already set then it is a returning user
		$student = $_SESSION['student'];//load the values from the session var back into the student var
	} else if (isset($_POST['student'])){//check the post array for info already entered
		$prev = $_POST['student'];//load the post student var to a variable to compare the value
		if (($prev == "Yes_Ft") || ($prev == "Yes_Pt") //if it is one of the 3 values listed
			|| ($prev == "No")) {
			$student = $_POST['student'];//Load it into the post array
		}

 	}
 	//same as above but for name
	if (isset($_SESSION['full_name'])){
		$full_name = $_SESSION['full_name'];
	} else if (isset($_POST['full_name'])){
		$full_name = $_POST['full_name'];
		
	}
	//same as above but for age
	if (isset($_SESSION['age'])){
		$age = $_SESSION['age'];
	} else if (isset($_POST['age'])){
		$age = $_POST['age'];
		
	}
	
?>
<!-- Html form to gather users full name, age, and if user is a student -->
  <h3>Personal Information</h3>
    
	<br>
	<form method="POST" action="">
	<table>
	<tr><td><label for="full_name">Full Name</label></td>
		<td><input type="text" name="full_name" id="full_name" size="50" maxlength="100" value="<?php echo $full_name; ?>"></td>
	</tr>
	<tr><td><label for="age">Age</label></td>
		<td><input type="text" name="age" id="age" size="50" maxlength="3" value="<?php echo $age; ?>"></td>
	</tr>
	<tr><td><label for="student">Student:</label></td>
				<td><select id="student" name="student" size="1">

	<?php $student="";
			if((strlen($student) ==0) ){ ?>
					<option selected="selected" disabled="disabled" >Choose one</option>
	<?php } else { ?>
					<option value="">Choose one</option>
	<?php }
		  if ($student == "YesFt"){ ?>
					<option selected="selected" value="Yes_Ft">Yes, full time</option>
	<?php } else { ?>
					<option value="Yes_Ft">Yes, full time</option>
	<?php }
		  if ($student == "YesPt"){ ?>
					<option selected="selected" value="Yes_Pt">Yes, part time</option>
	<?php } else { ?>
					<option value="Yes_Pt">Yes, part time</option>
	<?php }
		  if ($student == "No"){ ?>
					<option selected="selected" value="No">No</option>
	<?php } else { ?>
					<option value="No">No</option>
		<?php } ?>
				</select></td>
		</tr>
	</tr>
	</table>
	<br>
	<table>
	<tr>
		
		<td><input type="submit" name="next" value="Next"></td>
	</tr>
    </tr>
    <tr><td><input type="submit" name="cancel" value="Cancel"></td>
    </tr>
	</table>
	</form>

<?php

}

?>

<?php
//function to validate the data inputed bu the user called in index.php line 111
function validateContactName(){
	//declare the err_msgs array
	$err_msgs = array();
	if (!isset($_POST['student'])){//Check to see the user chose one of the 3 choices from the student ddl
		$err_msgs[] = "No student type specified";//if not load the message into the error array
	} else {//if user did chose one of the values
		//the trim function is used to remove the white spaces and other predefined characters from the left and right sides of a string. 
		$student = trim($_POST['student']);
		if (!(($student == "No") //if the $student var does not equal one of the 3 listed values 
			  || ($student == "Yes_Ft")
			  || ($student == "Yes_Pt"))){
			//load the message into the errors array
			$err_msgs[] = "A student type or no must be chosen.";
		}
	}//if error array count == 0;
	if (count($err_msgs) == 0){
		$_POST['student'] = $student;//set the post array var student to the users input
	}
	//same as above but for name
		if (!isset($_POST['full_name'])){
			$err_msgs[] = "A full name must be specified";
		}else {
			$full_name = trim($_POST['full_name']);
			if (strlen($full_name) == 0){//check there is text in the box if not
				$err_msgs[] = "A full name must be specified";//load the message into the error array
			} else if (strlen($full_name) > 100) {//if the value exceeds 100 characthers 
				//load the message into the error array
				$err_msgs[] = "The full name must be no longer than 100 characters in length.";
			}
		}
		//same as above but for age
		if (!isset($_POST['age'])){
			$err_msgs[] = "please specify an age";
		}else {
			$age = trim($_POST['age']);
			if (strlen($age) == 0){//check there is text in the box if not
				$err_msgs[] = "An age must be specified";//load the message into the error array
			} else if (strlen($age) > 3) {//if the value exceeds 3 characthers 
				//load the message into the error array
				$err_msgs[] = "The age must be Numeric charachters.";
			}
		}
		//if no errors 
		if (count($err_msgs) == 0){
			//load the values into the post array
			$_POST['full_name'] = $full_name;
			$_POST['age'] = $age;
			$_post['student'] = $student;
		}
	//if errors return the array to be displayed
	return $err_msgs;
}//end validateContactName function
?>

<?php
//function to set the post variables from the user input into the session array for use later
function contactNamePostToSession(){//function called on line 117 of index.php
	
	$_SESSION['full_name'] = $_POST['full_name'];
	$_SESSION['age'] = $_POST['age'];
	$_SESSION['student'] = $_POST['student'];
	
}//end contactNamePostToSession function

?>
