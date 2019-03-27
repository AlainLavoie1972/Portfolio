/**
 * Tester class
 */

/**
 * Class Name: A_L_TestSetters
 * Author: Alain Lavoie
 * Purpose: To test getters and setters in super and sub classes.
 * Date: Feb. 17, 2019
 */
public class A_L_TestSetters {

	
	public static void main(String[] args) {
		
		CommissionEmployee kim = new CommissionEmployee("David", "Kim", "222-222-222", 0.125, 49378.98);
		SalPlusCommEmployee bonvanie = new SalPlusCommEmployee("Ken", "Bonvanie", "333-333-333", 0.085,8477.95, 500);
		SalariedEmployee orr = new SalariedEmployee("Diana", "Orr", "111-111-111", 2489.85);
		HourlyEmployee robertson = new HourlyEmployee("Jane", "Robertson", "444-444-444", 17.85, 87.5);

		System.out.println("---------------Before Changes--------------");
		System.out.println(kim.getEarnings());
		System.out.println(bonvanie.getEarnings());
		System.out.println(orr.getEarnings());
		System.out.println(robertson.getEarnings());
		
		orr.setSalary(2875.95);
		kim.setSalesMade(67875.56);
		bonvanie.setSalesMade(32579.59);
		robertson.setRate(18.65);
		
		System.out.println("---------------After Changes--------------");
		System.out.println(kim.getEarnings());
		System.out.println(bonvanie.getEarnings());
		System.out.println(orr.getEarnings());
		System.out.println(robertson.getEarnings());
		
		System.out.println("---------------To String--------------");
		System.out.println(kim.toString() + "\n");
		System.out.println(bonvanie.toString() + "\n");
		System.out.println(orr.toString() + "\n");
		System.out.println(robertson.toString() + "\n");
	}
	
}
