/**
 * 
 */

/**
 * Class Name: Super class Employee
 * Author: Alain Lavoie
 * Purpose: To hold common features, and methods to be implemented for the subclasses. 
 * Date: Feb. 13, 2019
 */
abstract public class Employee implements Payable{
	//Properties
	private String firstName;
	private String lastName;
	private String sinNumber;
	
	//Constructors
	Employee(String firstName, String lastName, String sinNumber){
		this.firstName = firstName;
		this.lastName = lastName;
		this.sinNumber = sinNumber;
	}
	
	//Getters and Setters
	public String getFirstName() {
		return firstName;
	}

	public void setFirstName(String firstName) {
		this.firstName = firstName;
	}

	public String getLastName() {
		return lastName;
	}

	public void setLastName(String lastName) {
		this.lastName = lastName;
	}

	public String getSinNumber() {
		return sinNumber;
	}
	
	//Methods
	/**
	 * Method:	toString();
	 * Purpose:	To override the java toString method
	 * returns:	String representation of the object
	 */
	public String toString() {
		
		return "Surname" + "          " + "First Name" + "          " + "SIN\n" +
				getLastName() + "            " + getFirstName() + "             " + getSinNumber();
		
	}
	/**
	 * Method: Abstract getEarnings(); 
	 * Purpose:	To be implemented from employees subclasses 
	 * Returns:	double 
	 */
	abstract public double getEarnings();
	
	/* 
	 * @see Payable#generatePaymentAmount()
	 * Purpose:	to calculate the total for the invoice.
	 * returns:	the total amount payable from the invoice class
	 */
	@Override
	public double generatePaymentAmount() {
		double amount = getEarnings();
		return amount;
	}
}
