/**
 * Sub class of the Employee super class
 */

/**
 * Class Name: HourlyEmployee
 * Author: Alain Lavoie
 * Purpose: To create an Hourly employee object with some of the params inherited from the employee superClass.
 * Date: Feb. 13, 2019
 */
public class HourlyEmployee extends Employee{

	//Properties
	private double rate;
	private double hours;
	
	//Constructors
	HourlyEmployee(String firstName, String lastName, String sinNumber, double rate, double hours){
		super(firstName,lastName,sinNumber);
		this.rate = rate;
		this.hours = hours;
	}
	
	//Getters and Setters
	public double getRate() {
		return rate;
	}


	public void setRate(double newRate) {
		this.rate = newRate;
	}


	public double getHours() {
		return hours;
	}

	//Methods
	
	/**
	 * Method:	toString();
	 * Purpose:	To override the java toString method
	 * returns:	String representation of the object
	 */
	public String toString() {
		
		return super.toString() + "\nThis employee is a hourly paid employee with an hourly rate of $" + getRate() + "\n" +
					"This employee's earning for the month are $" + getEarnings() + ", based on: " + getHours() + " worked.";
		
	}

	/* (non-Javadoc)
	 * @see Employee#getEarnings()
	 */
	@Override
	public double getEarnings() {
		double earnings = getRate() * getHours();
		earnings = Math.round(earnings * 100.0) / 100.0;
		return earnings;
	}
	
	

	
}
