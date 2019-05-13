/**
 * 
 */

import java.applet.*;
import javafx.application.*;
import javafx.event.ActionEvent;
import javafx.event.EventHandler;
import javafx.geometry.Pos;
import javafx.scene.*;
import javafx.scene.layout.*;
import javafx.scene.text.Text;
import javafx.scene.control.*;//must add this to get access to the controls
import javafx.stage.*;
/**
 * Class Name: MilesConverter
 * Author: Alain Lavoie
 * Purpose:
 * Date: Mar. 28, 2019
 */
public class MilesConverter extends Application{
	
	//Properties to be used for getting the value from the user that will be converted
	//They are declared outside the start method so they can be accessed from other methods as well.
	TextField inputDistance, result;

	public void init()
	{
		
	}
	
	@Override
	public void start(Stage primaryStage) throws Exception {
		
		
		try
		{
		//This is the primary box and has the title of the window
		primaryStage.setTitle("Al Lavoie's Nautical Mile Converter");
		
		//This will be the content inside the primary box. GridPane will separate the window into rows and cols.
		//This is also the root node.
		GridPane grid = new GridPane();
		//This positions elements towards the center of the window.
		grid.setAlignment(Pos.CENTER);
		
		//set the vgap and hgap props to the grid
		grid.setVgap(30);
		grid.setHgap(30);
		
		//This is the scene t will allow you to add elements to the root pane which is grid.
		Scene scene = new Scene(grid, 500,300);
		
		//Get the stylesheet.
		scene.getStylesheets().add(getClass().getResource("style.css").toExternalForm());
		
		//Create Label for the user to enter the distance, and the result
		Label distInput = new Label("Enter distance in nautical miles");
		Label lblresult = new Label("Result");
		
		//set id's for the textboxes.
		distInput.setId("label");
		lblresult.setId("label");
		
		//Create Textboxes for the user input, and result.
		inputDistance = new TextField();
		result = new TextField();
		
		//set id's for the textfields.
		inputDistance.setId("txtBox");
		result.setId("txtBox");
		
		//Create the buttons
		Button convert = new Button("Convert");
		Button clear = new Button("Clear");
		
		//set id's for the btns
		convert.setId("btn");
		clear.setId("btn");
		
		//Set the focus on the inputDistance textBox
		inputDistance.requestFocus();
		
		//register the btnConvert Listener to the button convert.
		convert.setOnAction(new btnConvert());
		
		//register the btnClear Listener to the button clear
		clear.setOnAction(new btnClear());
		
		//add the elements to the root node which is grid
		grid.add(distInput, 0, 0);
		grid.add(inputDistance, 1, 0);
		grid.add(lblresult, 0, 1);
		grid.add(result, 1, 1);
		grid.add(convert, 0, 3);
		grid.add(clear, 1, 3);
		
		//Start to process the scene object.
		primaryStage.setScene(scene);
		//Now start to run the window.
		primaryStage.show();
		}
		catch(Exception e)
		{
			System.out.println(e.getMessage());
		}
	}
	
	//Create the private inner class to listen for the button click "convert"
	private class btnConvert implements EventHandler<ActionEvent>{

		@Override
		public void handle(ActionEvent event) {
			//variables for the conversion
			double dist, sum, formedDistance;
			double CONVERSION_FACTOR = 0.868976;
			
			//Get the string value from the text box.
			String distance = inputDistance.getText();
			
			//Convert it to a numeric value of type double
			dist = Double.parseDouble(distance);
			
			//Multiply the distance x conv Fact 
			sum = dist * CONVERSION_FACTOR;
			
			//Format the dist to 2 decimal places
			formedDistance = Math.round(sum * 100.0) / 100.0;
			
			//Convert back to string
			String stringSum = Double.toString(formedDistance);
			//add some text to the number string
			String formatedSumString = stringSum + " Statute Miles";
			//set the result into the result textbox
			result.setText(formatedSumString);
		}
		
	}
	
	private class btnClear implements EventHandler<ActionEvent>{

		
		@Override
		public void handle(ActionEvent event) {
			//clear the input boxes
			inputDistance.clear();
			result.clear();
			//set focus on the inputDistance textBox. 
			inputDistance.requestFocus();
			
		}
		
	}
	
	public void stop()
	{
		
	}

	
	public static void main(String[] args) {
		launch();
	}
	
}
