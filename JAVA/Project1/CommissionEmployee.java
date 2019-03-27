/**
 * Sub class of Employee super class
 */

/**
 * Class Name: CommissionEmployee
 * Author: Alain Lavoie
 * Purpose: To create an commissioned employee object with some of the params inherited from the employee superClass.
 * Date: Feb. 17, 2019
 */
public class CommissionEmployee extends Employee{
	//Properties
	private double commRate;
	private double salesMade;
	
	//Constructors
	CommissionEmployee(String firstName, String lastName, String sinNumber, double commRate, double salesMade) {
		super(firstName,lastName,sinNumber);
		this.commRate = commRate;
		this.salesMade = salesMade;
	}
	//Getters and Setters

	public double getCommRate() {
		
		return this.commRate;
	}

	public void setCommRate(double commRate) {
		this.commRate = commRate;
	}

	public double getSalesMade() {
		return salesMade;
	}

	public void setSalesMade(double salesMade) {
		this.salesMade = salesMade;
	}
	
	
	//Methods
	
	/* (non-Javadoc)
	 * @see Employee#getEarnings()
	 */
	@Override
	public double getEarnings() {
		double earnings = getSalesMade() * getCommRate();
		earnings = Math.round(earnings * 100.0) / 100.0;
		return earnings;
	}
	
	public double generatePaymentAmount() {
		double amount = getEarnings();
		return amount;
	}
	
	
	public String toString() {
		double fomedCommRate = commRate * 100; 
		return super.toString() + "\nThis is a commissioned employee who works on a commission rate of: " + fomedCommRate + "%\n" +
					"Their Earnings for this month were $" + getEarnings() + " on sales of: $" + getSalesMade() + ".";
	}
	
	
	
	
	
	
}
