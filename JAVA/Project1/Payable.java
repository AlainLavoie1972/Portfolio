/**
 * 
 */

/**
 * Class Name: Payable
 * Author: Alain Lavoie
 * Purpose: To be implemented by the Invoice and Employee classes.
 * Date: Feb. 13, 2019
 */
public interface Payable {
	/**
	*Method:	generatePaymentAmount();
	*Purpose:	Abstract method to be implemented by the Invoice and Employee classes.
	*Returns:	Double
	*/
	public double generatePaymentAmount();

}
