/**
 * Tester class
 */

/**
 * Class Name: A_L_TestPayment1
 * Author: Alain Lavoie
 * Purpose: To test the methods in the Employee super class and sub classes.
 * Date: Feb. 17, 2019
 */
public class A_L_TestPayment1 {

	
	public static void main(String[] args) {
		
		//  1)Create an array called testArray of an appropriate type that can hold any type of Employee or an Invoice
		//  and size it to 10 elements.
		Payable testArray[] = new Payable[10];
		
		//	2) You will also be creating two Invoice objects and then you are going to instantiate four workers,
		//	employee1, employee2, and employee3, and employee4. Each employee will be one of the four different
		//	types.
		//	Use the array element reference variables to create the objects, as shown in the example below.
		//testArray[0] = new Invoice(“Feb0001”, “AC234”, “Widget”, 25, 2.99);
		
		//	Invoice Elements
		testArray [0] = new Invoice("Feb0001", "AW234", "Widget", 25, 2.99);
		testArray [1] = new Invoice("Feb0002", "AF235", "Flange", 125, 3.37);
		
		//	Employee Objects
		testArray [2] = new SalariedEmployee("Diana", "Orr", "111-111-111", 2489.85);
		testArray [3] = new CommissionEmployee("David", "Kim", "222-222-222", 0.125, 49378.98);
		testArray [4] = new SalPlusCommEmployee("Ken", "Bonvanie", "333-333-333", 0.085,8477.95, 500);
		testArray [5] = new HourlyEmployee("Jane", "Robertson", "444-444-444", 17.85, 87.5);
		int i = 0;
		for(i = 0; i < 6; i++ ) {
			System.out.println(testArray[i].toString());
			System.out.println("Payment amount generated is $" + testArray[i].generatePaymentAmount() + "\n");
		}
		
	}
	
}
