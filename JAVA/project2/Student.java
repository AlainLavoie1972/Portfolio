
public class Student {
	private String studentID, surname, middleName, firstName, aptNumber, streetNumber, streetName, city, province, postalCode;
	private double cslLoanAmount, oslLoanAmount;
	
	Student(String sid, String sn, String mn, String fn, String aptNum, String stNum, String stName,
			String city, String pcode, String prov,  double csl, double osl) {
		this.studentID = sid;
		this.surname = sn;
		this.middleName = mn;
		this.firstName = fn;
		this.aptNumber = aptNum;
		this.streetNumber = stNum;
		this.streetName = stName;
		this.city = city;
		this.postalCode = pcode;
		this.province = prov;
		this.cslLoanAmount = csl;
		this.oslLoanAmount = osl;
	}

	public String getSurname() {
		return surname;
	}

	public void setSurname(String surname) {
		this.surname = surname;
	}

	public String getMiddleName() {
		return middleName;
	}

	public void setMiddleName(String middleName) {
		this.middleName = middleName;
	}

	public String getFirstName() {
		return firstName;
	}

	public void setFirstName(String firstName) {
		this.firstName = firstName;
	}

	public String getAptNumber() {
		return aptNumber;
	}

	public void setAptNumber(String aptNumber) {
		this.aptNumber = aptNumber;
	}

	public String getStreetNumber() {
		return streetNumber;
	}

	public void setStreetNumber(String streetNumber) {
		this.streetNumber = streetNumber;
	}

	public String getStreetName() {
		return streetName;
	}

	public void setStreetName(String streetName) {
		this.streetName = streetName;
	}

	public String getCity() {
		return city;
	}

	public void setCity(String city) {
		this.city = city;
	}

	public String getProvince() {
		return province;
	}

	public void setProvince(String province) {
		this.province = province;
	}

	public String getPostalCode() {
		return postalCode;
	}

	public void setPostalCode(String postalCode) {
		this.postalCode = postalCode;
	}

	public double getCslLoanAmount() {
		return cslLoanAmount;
	}

	public void setCslLoanAmount(double cslLoanAmount) {
		this.cslLoanAmount = cslLoanAmount;
	}

	public double getOslLoanAmount() {
		return oslLoanAmount;
	}

	public void setOslLoanAmount(double oslLoanAmount) {
		this.oslLoanAmount = oslLoanAmount;
	}

	public String getStudentID() {
		return studentID;
	}
	
	public String toString() {
		return "Student Name: " + getSurname() + ", " + getMiddleName() + " " + getFirstName() + "\n" +
				"Student Number: " + getStudentID() + "\n" +
				"CSL Amount: " + getCslLoanAmount() + "\n" +
				"OSL Amount: "+ getOslLoanAmount() + "\n\n";
		
	}
	
}
