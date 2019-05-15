<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>  

<?php   
// define variables and set to empty values
$first_nameErr = $last_nameErr = $emailErr = $personal_emailErr = $phoneErr = $personal_phoneErr = "";
$first_name = $last_name = $email = $personal_email = $phone = $personal_phone = "";





if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (empty($first_name = $_POST["first_name"])) {
    $first_nameErr = "First name is required";
  } else {
    $first_name = test_input($first_name = $_POST["first_name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$first_name)) {
      $first_nameErr = "Only letters and white space allowed"; 
    }
  }
  
  if (empty($last_name = $_POST["last_name"])) {
    $last_nameErr = "Last name is required";
  } else {
    $last_name = test_input($last_name = $_POST["last_name"]);
    // check if last_name contains only letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$last_name)) {
      $last_nameErr = "Only letters and white space allowed";  
    }
  }

  if (empty($email = $_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($email = $_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Wrong format for email"; 
    }
  }
    
  if (empty($phone = $_POST["phone"])) {
    $phoneErr = "Phone Number is required";
  } else {
    $phone = test_input($phone = $_POST["phone"]);
    // check if phon_num is well-formed
    if(preg_match("/^[0-9]{3}-[0-9]{4}-[0-9]{4}$/", $phone)) {
      $phone = "Wrong format for Phone Number"; 
    }
  }

  if (empty($personal_email = $_POST["personal_email"])) {
    $personal_emailErr = "Personal or Business is Required";
  } else {
      
    $personal_email = test_input($personal_email = $_POST["personal_email"]);
  }

  if (empty($personal_phone = $_POST["personal_phone"])) {
    $personal_phoneErr = "Personal or business is required";
  } else {
    $personal_phone = test_input($personal_phone = $_POST["personal_phone"]);
  }
}
    

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>  
<h2>PHP Form Validation Example</h2>
<p><span class="error">* required field.</span></p>


<form method="post" action="insertdata.php">  
  First Name: <input type="text" name="first_name" value="<?php $first_name ?>">
  <span class="error">* <?php echo $first_nameErr;?></span>
  <br><br>
  Last Name: <input type="text" name="last_name" value="<?php $last_name ?>">
  <span class="error">* <?php echo $last_nameErr;?></span>
  <br><br>
  E-mail: <input type="text" name="email" value="<?php $email ?>">
  <span class="error">* <?php echo $emailErr;?></span>
  <br>
  Is This Personal E-mail: <br><input type="radio" name="personal_email" <?php if (isset($personal_email)); ?> value="1">Personal Email
  <span class="error">* <?php echo $personal_emailErr;?></span>
  <br>
  <input type="radio" name="personal_email" <?php if (isset($personal_email)); ?> value="2">Business Email
  <span class="error">* <?php echo $personal_emailErr;?></span>
  
  <br><br>
  Phone Number: <input type="text" name="phone" value="<?php $phone ?>">
  <span class="error"><?php echo $phoneErr;?></span>
  <br>
  Is this personal Phone Number: <br><input type="radio" name="personal_phone" <?php if (isset($personal_phone)); ?> value="1">Personal Phone
  <span class="error">* <?php echo $personal_phoneErr;?></span>
  <br>
  <input type="radio" name="personal_phone" <?php if (isset($personal_phone)); ?> value="2">Business Phone
  <span class="error">* <?php echo $personal_phoneErr;?></span>
  
  <br><br>
  <input type="submit" name="submit" value="Submit">  
</form>


</body>
</html>