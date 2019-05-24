
<?php
//function to load the html data to the index.php page
function load(){
	//start the count to get rhymes from the db
	$round = $_SESSION['round'];
	//include the head.php file which has the links to scripts, and css
	include("includes/head.php");
?>
<!-- html to display the textboxes for user input -->
<header><h1 class="live">Here's Your Quick Lib</h1></header>
	<form method="Post" class="adjustable">
		<!-- this line calls the getrhyme function, takes the complete rhyme and stores it for use in rebuild function and takes the last element of the array out -->
		<?php $elements = getRhyme($round); $fullRhyme = end($elements); array_pop($elements);  ?>
		<input type="hidden" name="rhyme" value="<?php echo $fullRhyme; ?>">
		<div class="form-div adjustable">
			<h3>Lets Play</h3>
			<?php if(isset($elements))://check to see that there are elements to be displayed ?>
			<?php foreach($elements as $element)://loop through the array and  ?>
			<br>
			<?php echo $element; //display each element?>
			<?php endforeach; ?>
			<?php endif; ?>
			<br>
			<input type="submit" name="submit" id="player" value="OK GIV'ER">
		</div>
	</form>
<?php
}
?>

<?php
//funtion to end the game
function thankYou(){ ?>
<form method="post">
<header><h1 class="live">Thanks For Playing Quick Libs</h1></header>
<div class="instr">
		<h3>Hope you had as much fun as me and my daughter. We will add more riddles when time permits.</h3>
</div>
<input type="submit" name="done" class="button" value="Done">
</form>

<?php } ?>
