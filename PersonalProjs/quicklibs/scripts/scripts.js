//Function to collapse the welcome message
function CollapseForm(el){
	//var formId = document.getElementById('welcome');
	var divId = document.getElementById('welcomediv');

	divId.style.display = "none";
}

//window event to get voices from the browser
window.speechSynthesis.onvoiceschanged = function() {
    window.speechSynthesis.getVoices();
    
};

// Create a new utterance for the specified text and add it to
// the queue.
function speak(text) {

	// Get the voice select element.
	var voiceSelect = window.speechSynthesis.getVoices();
	//lenght of text
	var vLen = voiceSelect.length;

  // Create a new instance of SpeechSynthesisUtterance.
	var msg = new SpeechSynthesisUtterance();
  
  // Set the text.
	msg.text = text;
  
  
  // If a voice has been selected, find the voice and set the
  // utterance instance's voice attribute.
	
		msg.voice = voiceSelect[2];
		
		msg.rate = 0.8;//set the rate
		msg.pitch = 0;//set the pitch
	
  
  // Queue this utterance.
	window.speechSynthesis.speak(msg);
}


// Set up an event listener for when the 'speak' button is clicked.
function butt(msgIn) {
	var msgIn = document.getElementById('read').innerHTML;//get the text that is displayed on the page
	var len = msgIn.length;//check to make sure there is text 
	if (msgIn.length > 0) {//if greater than zero means there is text there
		speak(msgIn);//send the text to the speak function for prcessing
	}
}

