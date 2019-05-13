
abstract public interface A_L_LoanPayable {
	
	final double ANNUAL_RATE_TO_MONTHLY_RATE = 0.00083333333333333;
	
	abstract double calculateLoanPayment(double principle, double annPrimRate, int amort);

	
}
