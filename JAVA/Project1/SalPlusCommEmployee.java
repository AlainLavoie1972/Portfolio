/**
 * subclass of CommissionEmployee
 */

/**
 * Class Name: SalPlusCommEmployee
 * Author: Alain Lavoie
 * Purpose: To create an salaried plus commissioned employee object with some of the params inherited from the CommissionEmployee sub Class.
 * Date: Feb. 17, 2019
 */
public class SalPlusCommEmployee extends CommissionEmployee{

	//Properties
	private double baseSalary;
	//Constructors
	SalPlusCommEmployee(String firstName, String lastName, String sinNumber, double salesMade, double commRate, double baseSalary) {
		super(firstName,lastName,sinNumber,salesMade,commRate);
		this.baseSalary = baseSalary;
	}
	
	//Getters and Setters
	public double getBaseSalary() {
		return baseSalary;
	}
	public void setBaseSalary(double baseSalary) {
		this.baseSalary = baseSalary;
	}
	public double getEarnings() {
		double earnings = super.getSalesMade() * super.getCommRate();
		earnings = earnings + getBaseSalary();
		earnings = Math.round(earnings * 100.0) / 100.0;
		return earnings;
	}
	
	//Methods
	
	public double generatePaymentAmount() {
		double amount = getEarnings();
		return amount;
	}
	
	public String toString() {
		
		return super.toString() + "\nThis employee is a probationary employee who also recieves a base salary of $" + getBaseSalary() + "\n" +
					"Their straight commission earnings for the period were $" + Math.round((getCommRate() * getSalesMade()) * 100.0) / 100.0 + ".";
	}
}
