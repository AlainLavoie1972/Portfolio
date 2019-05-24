<?php 
//$_SESSION['round'] = 1;


//funtion called on page open to get the rhyme from the db
function getRhyme($round){
	$db_conn = mysqli_connect("localhost", "al", "Crowley!72", "limericks");//Connection string
	$sql = "SELECT rhyme FROM rhymes WHERE rhyme_id=$round;";//query
	$result = mysqli_query($db_conn, $sql);//this mysqli function performs a query against the db
	$rhyme = mysqli_fetch_assoc($result);//this mysqli function fetches a result row as an associative array.
	//make certain to check for deleted records
	if(empty($rhyme)){
		$round += 1;
		$sql = "SELECT rhyme FROM rhymes WHERE rhyme_id=$round;";
		$result = mysqli_query($db_conn, $sql);
		$rhyme = mysqli_fetch_assoc($result);
	}
	$_GET['rhyme'] = $rhyme['rhyme'];//Use the GLOBAL GET var to store the result
	$holdRhyme = $rhyme['rhyme'];//variable to hold the completed rhyme before sorting the various parts.
	$els = sortRhyme($rhyme['rhyme']);//els will hold the result of the sortRhyme function which dynamically creates the html needed for the rhyme
	$len = count($els);//get the length of the returned array
	$els[$len+1] = $holdRhyme;//add the unsorted rhyme to the end of the array for use later.
	
	return $els;//return the html back to the browser.
	
}

//function used to sort the words needed to be replaced
function sortRhyme($rhyme){//accepts the rhyme fetched from the getRhyme function.

	$unsorted = $rhyme;//the rhyme as it is stored in the database and before being sorted
	$sort = explode("$", $unsorted);//special words from the rhyme are entered into the db with $ at the start and end of the word 
	//so we sort the rhyme by getting only the words with $ surrounding them which returns an array from the php explode function

	$elements = array();//empty array which will hold html elements created when the sort array gets processed.
	
	foreach($sort as $sorted){//loop through the array of words and create a matching html element to display to the user.

		switch ($sorted) {//switch on the word type
			//different word types
			case 'feeling':
				//create the element to be displayed
				$feeling_element = "<label for='pick_a_emotion' class='adjustable'>Choose an emotion</label>
									<input type='text' name='pick_a_emotion' class='adjustable' placeholder='Ex. happy, mean, sad,...'>";
				array_push($elements, $feeling_element);//push it into the array

				break;
			case 'name':
				//$sorted = $name;
				$name_element = "<label for='pick_a_name' class='adjustable'>Choose a name</label>
									<input type='text' name='pick_a_name' class='adjustable' placeholder='Common name'>";
				array_push($elements, $name_element);
				break;
			case 'animal':
				//$sorted = $animal;
				$animal_element = "<label for='pick_a_animal' class='adjustable'>Choose an animal</label>
									<input type='text' name='pick_a_animal' class='adjustable' placeholder='Animal'>";
				array_push($elements, $animal_element);
				break;
			case 'body_part':
				//$sorted = $body_part;
				$bdpart_element = "<label for='pick_a_body_part' class='adjustable'>Choose a body part</label>
									<input type='text' name='pick_a_body_part' class='adjustable' placeholder='Body part'>";
				array_push($elements, $bdpart_element);
				break;
			case 'sound':
				//$sorted = $sound;
				$sound_element = "<label for='pick_a_sound' class='adjustable'>Choose a sound</label>
									<input type='text' name='pick_a_sound' class='adjustable' placeholder='Ex. screach, whisper, grunt,...'>";
				array_push($elements, $sound_element);
				break;
			case 'moving_verb':
				//$sorted = $moving_verb;
				$mv_ver_element = "<label for='pick_a_mv_verb' class='adjustable'>Choose a verb that is a motion</label>
									<input type='text' name='pick_a_mv_verb' class='adjustable' placeholder='Ex. Stop, move, sit,...'>";
				array_push($elements, $mv_ver_element);
				break;
			case 'size':
				$size_element = "<label for='pick_a_size' class='adjustable'>Choose a size</label>
									<input type='text' name='pick_a_size' class='adjustable' placeholder='Ex.Large, medium, small...'>";
				array_push($elements, $size_element);
				break;
			case 'main_entree':
				$main_entree_element = "<label for='pick_a_main_entree' class='adjustable'>Choose a Main entree</label>
									<input type='text' name='pick_a_main_entree' class='adjustable' placeholder='Ex. Beef, Pasta, Turkey...'>";
				array_push($elements, $main_entree_element);
				break;
			case 'side_dish':
				$side_dish_element = "<label for='pick_a_side_dish' class='adjustable'>Choose a side dish</label>
									<input type='text' name='pick_a_side_dish' class='adjustable' placeholder='Ex. Salad, patatoes, peas...'>";
				array_push($elements, $side_dish_element);
				break;
			case 'insect':
				$insect_element = "<label for='pick_a_insect' class='adjustable'>Choose an insect</label>
									<input type='text' name='pick_a_insect' class='adjustable' placeholder='Bugs'>";
				array_push($elements, $insect_element);
				break;
			case 'up_down_left_right':
				$up_down_left_right_element = "<label for='pick_a_up_down_left_right' class='adjustable'>Choose a direction</label>
									<input type='text' name='pick_a_up_down_left_right' class='adjustable' placeholder='Up, down, left or right.'>";
				array_push($elements, $up_down_left_right_element);
				break;
			case 'object':
				$object_element = "<label for='pick_a_object' class='adjustable'>Choose an object</label>
									<input type='text' name='pick_a_object' class='adjustable' placeholder='Object.'>";
				array_push($elements, $object_element);
				break;
			case 'action':
				$action_element = "<label for='pick_a_action' class='adjustable'>Choose an action</label>
									<input type='text' name='pick_a_action' class='adjustable' placeholder='Action.'>";
				array_push($elements, $action_element);
				break;
			case 'emotion':
				$emotion_element = "<label for='pick_a_emotion' class='adjustable'>Choose an emotion</label>
									<input type='text' name='pick_a_emotion' class='adjustable' placeholder='Ex. Love, hate, sadness,...'>";
				array_push($elements, $emotion_element);
				break;
			case 'vegetable':
				$vegetable_element = "<label for='pick_a_vegetable' class='adjustable'>Choose a vegetable</label>
									<input type='text' name='pick_a_vegetable' class='adjustable' placeholder='Vegetable'>";
				array_push($elements, $vegetable_element);
				break;
			case 'something_learned':
				$something_learned_element = "<label for='pick_something_learned' class='adjustable'>Choose a something you learn</label>
									<input type='text' name='pick_something_learned' class='adjustable' placeholder='Typing, math, act,...'>";
				array_push($elements, $something_learned_element);
				break;
			default:
				# code...
				break;
		}
	}
	$elArr = $elements;//hold all the html.
	$elements = array_unique($elArr);//Removes duplicate values from an array for repeating words
	
	return $elements;//return the html to the getRhyme function
}

//function to rebuild the rhyme with the users inputed values.
function rebuild($values, $rhyme){

	//get the value of each of the html elements that the user inputed
	if(isset($values['pick_a_name'])){ $name = $values['pick_a_name'];}
	if(isset($values['pick_a_emotion'])){$feeling = $values['pick_a_emotion'];}
	if(isset($values['pick_a_animal'])){$animal = $values['pick_a_animal'];}
	if(isset($values['pick_a_body_part'])){$body_part = $values['pick_a_body_part'];}
	if(isset($values['pick_a_sound'])){$sound = $values['pick_a_sound'];}
	if(isset($values['pick_a_mv_verb'])){$moving_verb = $values['pick_a_mv_verb'];}
	if(isset($values['pick_a_size'])){$size = $values['pick_a_size'];}
	if(isset($values['pick_a_main_entree'])){$main_entree = $values['pick_a_main_entree'];}
	if(isset($values['pick_a_side_dish'])){$side_dish = $values['pick_a_side_dish'];}
	if(isset($values['pick_a_insect'])){$insect = $values['pick_a_insect'];}
	if(isset($values['pick_a_up_down_left_right'])){$up_down_left_right = $values['pick_a_up_down_left_right'];}
	if(isset($values['pick_a_object'])){ $object = $values['pick_a_object'];}
	if(isset($values['pick_a_action'])){ $action = $values['pick_a_action'];}
	if(isset($values['pick_a_emotion'])){ $emotion = $values['pick_a_emotion'];}
	if(isset($values['pick_a_vegetable'])){ $vegetable = $values['pick_a_vegetable'];}
	if(isset($values['pick_something_learned'])){ $something_learned = $values['pick_something_learned'];}

	//the complete rhyme unsorted
	$unsorted = $rhyme;
	//break the rhyme apart into an array of seperate words.
	$sort = explode(" ", $rhyme);
	
	foreach ($sort as $key => $value) {//loop through the array
		$word = stristr($value, "$");//start by getting the words that are wrapped in $
		
		if($word == true){//if found
			$valArr = str_split($value);//convert the string into an array
			$lastChar = end($valArr);//check the last value of the array
			if($lastChar == ","){//if it is a comma
				$trim = rtrim($value, ",");//remove the comma
				$value = $trim;//word with comma removed
			}
			else if($lastChar == "."){//if there's a period
				$trim = rtrim($value, ".");//remove the period
				$value = $trim;//word with period removed
			}
			
			switch ($value) {//switch on the type of word

				case '$something_learned$'://if the type of word matches the values in each case
					//replace the type of word in the string with the value the user inputed
					$rhyme = str_replace($value, $something_learned, $rhyme);
					
					break;
				case '$vegetable$':
					
					$rhyme = str_replace($value, $vegetable, $rhyme);
					
					break;
				case '$emotion$':
					
					$rhyme = str_replace($value, $emotion, $rhyme);
					
					break;
				case '$feeling$':
					
					$rhyme = str_replace($value, $feeling, $rhyme);
					
					break;
				case '$name$':
			
					$rhyme = str_replace($value, $name, $rhyme);
					
					
					break;
				case '$animal$':
					
					$rhyme = str_replace($value, $animal, $rhyme);
					

					break;
				case '$body_part$':
					
					$rhyme = str_replace($value, $body_part, $rhyme);
					

					break;
				case '$sound$':
					
					$rhyme = str_replace($value, $sound, $rhyme);
					

					break;
				case '$moving_verb$':
					
					$rhyme = str_replace($value, $moving_verb, $rhyme);
					
					break;
				case '$main_entree$':
					
					$rhyme = str_replace($value, $main_entree, $rhyme);
					
					break;
				case '$side_dish$':
					
					$rhyme = str_replace($value, $side_dish, $rhyme);
					
					break;
				case '$insect$':
					
					$rhyme = str_replace($value, $insect, $rhyme);
					
					break;
				case '$up_down_left_right$':
					
					$rhyme = str_replace($value, $up_down_left_right, $rhyme);
					
					break;	
				case '$object$':
					
					$rhyme = str_replace($value, $object, $rhyme);
					
					break;	
				case '$action$':
					
					$rhyme = str_replace($value, $action, $rhyme);
					
					break;	
				default:
					
					break;
					
			}

		}
		
	}
	//Once the words have all been changed set the GLOBAL GET variable with the complete limerick
	$_GET['limerick'] = $rhyme;
	
}
//once user enters data and clicks submit button
if (isset($_POST['submit'])) {
	//get the full rhyme which was stored in a hidden input 
	$rhyme = $_POST['rhyme'];
	//take the rhyme out of the post array
	$_POST['rhyme'] = null;
	//get the values the user inputed from the post var
	$values = $_POST;
	//send the values back to be rebuilt in to the original rhyme
	rebuild($values, $rhyme);
}



?>