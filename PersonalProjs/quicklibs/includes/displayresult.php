
<?php 
//function to display the result of the limerick with user input
function result($val){ 
include("includes/head.php");
?>

<?php if(isset($_GET['limerick']))://get the limerick ?>
	<!-- this button triggers an event listener in scripts.js see file for comments -->
	<button id="speak" class="button" style="margin-left: 40%; margin-top: 2vh;" onclick="butt();">Read Aloud</button>
	<form method="post">
		<?php $limerick = $_GET['limerick'];//load the result into a variable ?>
		<div id="text" class="lines"><h3 id="read"><?php echo $limerick;//display the result  ?></h3></div>
		<input type="submit" name="next" value="Next">
	</form>
<?php endif ?>
<?php } ?>