<?php
session_start();//begin the session
include("includes/functions.php");//file needed for processing
include("includes/head.php");//file containing html head elements 
//see if this is a new user
if(!isset($_SESSION['round'])){
	displayWelcome();//function on line 35 to display welcome message 
	$_SESSION['round'] = 1;//start the count to kkep track of which rhymes have been done
}
//once the user clicks lets play
elseif(isset($_POST['play'])){
	include('includes/loadForm.php');//file needed to display the form
	$_SESSION['round'] += 1;//increment the session var. Rhyme id starts at 2
	load();//function to load the form found in loadForm.php
}
//once the user fills the form and clicks done
elseif(isset($_POST['submit'])){
	include("includes/displayresult.php");//file needed to display the result of the user input
	result($_GET);//the result is stored in the GLOBAL GET var and passed into the result function from file displayresult.php
}
//once user has seen result and clicked next
elseif(isset($_POST['next'])){
	include('includes/loadForm.php');//file needed to display the form
	$_SESSION['round'] += 1;//increment the session var.
	if($_SESSION['round'] == 6){
		thankYou();//funtion on line 36 of loadform.php

	}elseif($_SESSION['round'] > 1 && $_SESSION['round'] < 6){
		load();//function to load the form found in loadForm.php
	}
}
if(isset($_POST['done'])){
include('includes/loadForm.php');
//kill the session and cookie
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
//destroy the session
session_destroy();

unset($_SESSION['round']);
header('Location: index.php');
}
?>


</body>
</html>

<?php function displayWelcome(){ ?>
<div id="welcomediv">
	<header><h1 class="live">Welcome To Quick Libs</h1></header>

	<form method="post" id="welcome">
	<div class="instr">
		<h2 style="color: #ff0000;">For best results use chrome browser</h2>
		<h3>A game of madlibs for all ages. Click the play button<br/>the page will load some text boxes with descriptions<br/>
		of the type of words to enter. When done entering the words<br/>simply click the button to have your riddle appear.<br/>
		You can read it yourself, or have voice synthesys read it for you!!</h3>
		<input type="submit" class="button center" name="play" value="Play Quicklibs" onclick="CollapseForm(document.getElementById('welcomediv'));">
	</div>
	</form>
</div>
<?php } ?>