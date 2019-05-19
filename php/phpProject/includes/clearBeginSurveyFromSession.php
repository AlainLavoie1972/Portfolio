<?php
//funtion to clear the survey from the session variable
function clearBeginSurveyFromSession(){//called on lines 49,61, 150, 169 of index.php
	//if values are set then unset them
	if (isset($_SESSION['full_name'])){
		unset($_SESSION['full_name']);
	}
	if (isset($_SESSION['age'])){
        unset($_SESSION['age']);
	}
	if (isset($_SESSION['student'])){
        unset($_SESSION['student']);
	}
	if (isset($_SESSION['purchases'])){
        unset($_SESSION['purchases']);
	}
	if (isset($_SESSION['how'])){
        unset($_SESSION['how']);
	}
	if (isset($_SESSION['recommend'])){
        unset($_SESSION['recommend']);
	}
	if (isset($_SESSION['sat'])){
        unset($_SESSION['sat']);
	}
	
}//end clearBeginSurveyFromSession function
?>
