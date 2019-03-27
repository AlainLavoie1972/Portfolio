/**
 * Sub class of the Employee super class
 */

/**
 * Class Name: SalariedEmployee
 * Author: Alain Lavoie
 * Purpose: To create an Salaried employee object with some of the params inherited from the employee superClass.
 * Date: Feb. 13, 2019
 */
public class SalariedEmployee extends Employee{

	//Properties
	private double salary;
	
	//Constructors
	SalariedEmployee(String firstName, String lastName, String sinNumber, double salary) {
		super(firstName, lastName, sinNumber);
			this.salary = salary;
	}
	
	
	//Getters and Setters

	public double getSalary() {
		return salary;
	}


	public void setSalary(double salary) {
		this.salary = salary;
	}


	//Methods
	
	/* (non-Javadoc)
	 * @see Employee#getEarnings()
	 */
	@Override
	public double getEarnings() {
		double earnings = getSalary();
		earnings = Math.round(earnings * 100.0) / 100.0;
		return earnings;
	}
	
	/**
	 * Method:	toString();
	 * Purpose:	To override the java toString method
	 * returns:	String representation of the object
	 */
	public String toString() {
		
		return super.toString() + "\nThis Employee is a salaried employee with a monthly salary of $" + getEarnings() + ".";
		
	}
	
	public double generatePaymentAmount() {
		double payment = getEarnings();
		return payment;
	}
}
