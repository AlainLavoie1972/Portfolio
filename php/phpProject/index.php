<?php 	session_start(); //Start the session 
echo "<p style='color:red;'>Example of a multi part form which uses post and session arrays to save inputed data throughout and upload to mySql db<br>use random values to complete the forms</p>";
	//Check to see if the session is already started
	if (!isset($_SESSION['mode'])){
		//if not set it in Display mode to start the survey.
		$_SESSION['mode'] = "Display";
		$_SESSION['add_part'] = 0;//Start the add_part var in the session array
		$_POST['new'] = "new";//show this is a new survey
		formSurveyDisplay();//Bring up the first form found on this page.
	}
	//Files required throughout the survey
	require_once("./includes/db_operations.php");
	require_once("./includes/displaySurvey.php");
	require_once("./includes/personalInfoPage.php");
	require_once("./includes/clearBeginSurveyFromSession.php");
	require_once("./includes/purchaseDescPage.php");
	require_once("./includes/customerSatisfactionPage.php");
	require_once("./includes/errorDisplay.php");
	require_once("./includes/save.php");
?>
<html>
	<head>
		<title>Ace Electronics</title>
	</head>
	<body>
<?php


//button handling 
//if the post variable begin == Begin
if (isset($_POST['begin']) && ($_POST['begin'] == "Begin")){
	//Set the session mode to Begin
	$_SESSION['mode'] = "Begin";
	//Set the Session add_part var to zero
	$_SESSION['add_part'] = 0;
} 
//if the button next is clicked anywhere in the survey set post to Next
else if(isset($_POST['next']) && ($_POST['next'] == "Next")){
	//Keep session mode to Begin
	$_SESSION['mode'] = "Begin";
}
//if the No Thank You button is clicked 
else if (isset($_POST['no_thx']) && ($_POST['no_thx'] == "No Thank You")){
	//check the session mode if it is in begin
	if ($_SESSION['mode'] == "Begin"){
		//set the add_part var back to 0
		$_SESSION['add_part'] = 0;
		//Call the clear survey function from the file on line 12
		clearBeginSurveyFromSession();
	}
		//set the session mode back to Display
		$_SESSION['mode'] = "Display";
}
//if use clicks cancel
else if (isset($_POST['cancel']) && ($_POST['cancel'] == "Cancel")){
	//set the add_part var back to 0
		$_SESSION['add_part'] = 0;
		//set the session mode back to Display
		$_SESSION['mode'] = "Display";
		//Call the clear survey function from the file on line 12
		clearBeginSurveyFromSession();
		formSurveyDisplay();//Bring up the first form found on this page.
}
//Debugging helpers
	//echo "<pre>\n";
	//echo "Post variable <br>";
	//var_dump($_POST);
	//echo "<br>Session variable <br>";
	//var_dump($_SESSION);
	//echo "<br>Server<br>";
	//var_dump($_SERVER['REQUEST_METHOD']);
	//echo "</pre>\n";

//Check the session var to see if it is in Begin mode, And the server request method is not in post
if(($_SESSION['mode'] == "Begin") && ($_SERVER['REQUEST_METHOD'] == "GET")){ 
	$_SESSION['add_part'] = 0; 
	//check the session add_part var to see if this is a returning user 
	//Use switch case on add_part variable
	switch ($_SESSION['add_part']) {	
		//if add_part = 1	
		case 1:
			//display the personal info form from file on line 11.
			personalInfoForm();
			break;
		case 2://if add_part =2
			//display the purchase details form from file on line 13.
			purchaseDetailsForm();
			break;
		case 3://if add_part =3
			//display the satisfaction form from file on line 14.
			customerSatisfactionForm();
			break;
		
		default:
	}	
}
//if server request method = POST begin the survey
else if($_SESSION['mode'] == "Begin"){
	//Check to see the add_part variable is set in the session array
	if(isset($_SESSION['add_part'])){
	//Session add_part = 0 time to start the new survey
	switch ($_SESSION['add_part']) {
		case 0://new survey
			//Increase the add part to 1
			$_SESSION['add_part'] = 1;
			//Get the personal info for from file on line 11 and display it.
			personalInfoForm();
			break;
		case 1://continue survey
			//validate the data inputed by the user
			$err_msgs = validateContactName();//function is in includes/personalInfoPage.php 
			if (count($err_msgs) > 0){//if err_msgs array count is more than zero
				displayErrors($err_msgs);//display errors
				personalInfoForm();//bring back the form
			} else {//if err_msgs array is empty
				//Post the data from the post var to the session var 
				contactNamePostToSession();//function is in includes/personalInfoPage.php 
				//increase the add_part to 2
				$_SESSION['add_part'] = 2;
				//bring up the purchase details form from file on line 13
				purchaseDetailsForm();
			}
			break;
		case 2://Continue survey
			//validate the data inputed by the user
			$err_msgs = validatePuchasedItems();//function is in includes/purchaseDescPage.php 
			if (count($err_msgs) > 0){//if err_msgs array count is more than zero
				displayErrors($err_msgs);//display errors
				purchaseDetailsForm();//Bring that form back.
			} else if ((isset($_POST['next']))//check if the user has clicked the next button to continue
					&& ($_POST['next'] == "Next")){//Make certain the button labeled Next is the one clicked
				//Post the data from the post var to the session var 
				purchaseDetailsPostToSession();//function is in includes/purchaseDescPage.php 
				$_SESSION['add_part'] = 3;//increase the add_part to 3
				//bring up the satisfaction form from file on line 14
				customerSatisfactionForm();
			} else if ((isset($_POST['back']))//If the user clicks the back button
						&& ($_POST['back'] == "Back")){
				$_SESSION['add_part'] = 1;//decrease the add_part var
				personalInfoForm();//pull the personal info form back up.
			}

			break;
		case 3://Continue survey
			//validate the data inputed by the user
			$err_msgs = validateRecommend();
			//Check to see if user has not clicked cancel and no errors from validation
			if ((!isset($_POST['cancel'])) && (count($err_msgs) > 0)){
				displayErrors($err_msgs);//If errors display them
				clearBeginSurveyFromSession();//clear the survey from the session array
			} else if ((isset($_POST['next']))//if user clicks next
					&& ($_POST['next'] == "Save")){//And next var in Post array is set to save
				customerSatisfactionPostToSession();//set the POST vars to session array
				$_SESSION['add_part'] = 4;//Increase add_part var to 4
				surveySaveForm();//call the function to save the survey and display the result before sending it to the db for review
			} else if ((isset($_POST['back']))//If user clicks back button
						&& ($_POST['back'] == "Back")){
				$_SESSION['add_part'] = 2;//set the add_part var back to 2
				purchaseDetailsForm();//bring the purchase details form back up
			}
			break;
		case 4://Continue to save survey to the db
			if ((isset($_POST['next']))//if post var next is set to save
					&& ($_POST['next'] == "Save")){
				$_SESSION['add_part'] = 0;//return the add_part to 0
				$done = saveContact();//save the info to the db and display the results back to the user with a thank you message
				echo $done;//echo the results
				$_SESSION['mode'] = "Complete";//set session var mode to complete
				clearBeginSurveyFromSession();//clear the survey from the session array function found in includes/clearBeginSurveyFromSession.php
			} else if ((isset($_POST['back']))//if back is clicked
						&& ($_POST['back'] == "Back")){
				$_SESSION['add_part'] = 3;//set add_part to 3
				customerSatisfactionForm();//bring back the satisfaction form
			}
			break;
		default:
		
	
	}
}

}

?>

</body>
	</html>

<?php
function formSurveyDisplay(){
?>

		<header>
			<h1>ACE ELECTRONICS<h1>
		</header>
		<form method="POST" action="">
			<h3>Welcome to Ace Electronics survey page.</h3>
			<br>
			<h4>We hope your shopping experience with us has been pleasant. At Ace Electronics we strive to be the best.
			Being the best is a constantly evolving task. One way for us to keep our customer service at highest level is 
			through customer input. We would love to hear about your experience. Good or Bad.
		</h4>
		<br><br>
			<h4>Please feel free to take the following survey, And help us improve our service. You may leave the survey
				at anytime. When you return your responses will be saved. No need to start again. Please feel free to click the 
			    <strong>Begin</strong> button.
			</h4>
			<br>

			<input type="submit" name="begin" value="Begin">
			<input type="submit" name="no_thx" value="No Thank You">
			</form>
<?php } ?>
	