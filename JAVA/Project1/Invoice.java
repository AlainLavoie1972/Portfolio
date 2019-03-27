/**
 * 
 */

/**
 * Class Name: Invoice
 * Author: Alain Lavoie
 * Purpose:
 * Date: Feb. 13, 2019
 */
public class Invoice implements Payable{
	//Properties
	private String invoiceNumber;
	private String partNumber;
	private String partDescription;
	private int quantity;
	private double unitPrice;
	
	//Constructors
	Invoice(String invoiceNumber, String partNumber, String partDescription, int quantity, double unitPrice){
		this.invoiceNumber = invoiceNumber;
		this.partNumber = partNumber;
		this.partDescription = partDescription;
		this.quantity = quantity;
		this.unitPrice = unitPrice;
	}
	
	//Getters
	public String getInvoiceNumber() {
		return invoiceNumber;
	}

	public String getPartNumber() {
		return partNumber;
	}

	public String getPartDescription() {
		return partDescription;
	}

	public int getQuantity() {
		return quantity;
	}

	public double getUnitPrice() {
		return unitPrice;
	}
		
	//Methods
	
	/**
	 * Method:	toString();
	 * Purpose:	To override the java toString method
	 * returns:	String representation of the object
	 */
	public String toString() {
		double total = generatePaymentAmount();
		
		return "Invoice#" + "        " + "Part Number" + "        " + "Description" + "        " + "Unit Price" + "        " + "Total\n" +
				invoiceNumber + "           " + partNumber + "             " + partDescription + "             " + unitPrice + "            " + total + ".";
	}

	/* 
	 * @see Payable#generatePaymentAmount()
	 * Purpose:	to calculate the total for the invoice.
	 * returns:	the total amount payable from the invoice class
	 */
	@Override
	public double generatePaymentAmount() {
		double total = unitPrice * quantity;
		total = Math.round(total * 100.0) / 100.0;
		return total;
	}
}
