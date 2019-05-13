import javax.swing.*;
import java.awt.event.ActionEvent;
import java.awt.*;
import java.awt.event.ActionListener;
import java.lang.reflect.Array;
import java.util.ArrayList;


public class StudentLoanApp extends JFrame implements A_L_LoanPayable{
	
	
	 
	//Variables for the student 
	private String studentNumber, firstName, middleName,lastName, aptNumber, strNumber, streetName, city, province, postCode, interest, amortization;
	
	//Variables for the calculate listener
	private String strNum, strFirst, strMiddle, strLast, strApt, strStrNum, strStrName, strCity, strProv, strPCode, strOsl, strCsl, strInt, strAmort;
	
	private String oSlPayment, cSlPayment, totalPayment, grandTotal, borrowed, totIter;
	
	//Variables for the CSL loan calculations
	private double princOsl, princCsl, inter, OSL, CSL;
	
	private int amrt;
	
	private static int count;

	//Variables for the OSL loan calculations
	private double cslPayment, oslPayment;
	
	//Variables for the display of the loan calculations		ps.(totalRepaid2) maybe.
	private double dispCslAmount, dispOslAmount, dispAmort, dispCurPrmInt, dispCslTotal, dispOslTotal, dispTotMonPayments, dispTotRepay, dispTotLoan, dispTotInt, dispPrime;
	
	//Variables for the labels of the student information form
	private JLabel lblStudentNum, lblfName, lblmName, lbllName, lblApartNum, lblStrNum, lblStrName, lblCity, lblProv, lblPostCode, lblCslAmount, lblOslAmount, lblInterest, lblAmort;
	//dispFirst, dispLast, dspMid, dispstNum;
	
	//Variable for the text boxes that accompany the previous labels on the student information form.
	private JTextField txtStudentNum, txtfName, txtmName, txtlName, txtApartNum, txtStrNum, txtStrName, txtCity, txtProv, txtPostCode, txtCslAmount, txtOslAmount, txtInterest, txtAmort;

	//Variables for the second part of the form, it displays the information after the calculations.
	private JLabel lbldisplay1, lbldisplay2, lbldisplay3, lbldisplay4, lbldisplay5, lbldisplay6, lbldisplay7, lbldisplay8, lbldisplay9, lbldisplay10, lbldisplay11, lbldisplay12;
	
	//Variables for the text boxes that will display the results of the calculations
	JTextField txtdispSid, txtdispName, txtdispOSL, txtdispCSL, txtdispInt, txtdispAmort, txtdispMonCSLAm, txtdispMonOSLAm, txtdispTotMoPay, txtdispTotAmRepay, txtdispToAmBor, txtdispTotInt;
	
	//JButton variables
	JButton calcPayments, clearFields, next, prev;

	private String OSLAmount;

	private String CSLAmount, studComp;
	
	static Student student;
	
	
	
	
	StudentLoanApp(){
		//count++;
		JFrame mainFrame = new JFrame();
		mainFrame.setLayout(new BorderLayout(20,20));
		
		JPanel perInfoPanel = new JPanel();
		perInfoPanel.setLayout(new GridLayout(10,2,10,10));
		perInfoPanel.setBorder(BorderFactory.createTitledBorder("Personal Information "));
		
		JPanel fPanel = new JPanel();
		fPanel.setLayout(new GridLayout(5,2,10,10));
		fPanel.setBorder(BorderFactory.createTitledBorder("Financial Information "));
		
		OSLAmount = Double.toString(student.getOslLoanAmount());
		CSLAmount = Double.toString(student.getCslLoanAmount());
		studComp = student.getStudentID();
	    
			//Labels
			lblStudentNum = new JLabel("Student Number: ");
	      	lblStudentNum.setOpaque(false);
			lblfName = new JLabel("First Name: ");
			lblmName = new JLabel("Middle Name: ");
			lbllName = new JLabel("Last Name: ");
			lblApartNum = new JLabel("Apartment #: ");
			lblStrNum = new JLabel("Street Number: ");
			lblStrName = new JLabel("Street Name: ");
			lblCity = new JLabel("City: ");
			lblProv = new JLabel("Province: ");
			lblPostCode = new JLabel("Postal Code: ");
			lblCslAmount = new JLabel("CSL Amount: ");
			lblOslAmount = new JLabel("OSL Loan Amount: ");
			lblInterest = new JLabel("Enter The Interest Rate: ");
			lblAmort = new JLabel("Enter Amortization: ");
			
			//Text fields
			
			txtStudentNum = new JTextField(student.getStudentID());
	      	txtStudentNum.setBorder(BorderFactory.createLineBorder(Color.BLACK, 2));
			txtfName = new JTextField(student.getFirstName());
			txtfName.setBorder(BorderFactory.createLineBorder(Color.BLACK, 2));
			txtmName = new JTextField(student.getMiddleName());
			txtmName.setBorder(BorderFactory.createLineBorder(Color.BLACK, 2));
			txtlName = new JTextField(student.getSurname());
			txtlName.setBorder(BorderFactory.createLineBorder(Color.BLACK, 2));
			txtApartNum = new JTextField(student.getAptNumber());
			txtApartNum.setBorder(BorderFactory.createLineBorder(Color.BLACK, 2));
			txtStrNum = new JTextField(student.getStreetNumber());
			txtStrNum.setBorder(BorderFactory.createLineBorder(Color.BLACK, 2));
			txtStrName = new JTextField(student.getStreetName());
			txtStrName.setBorder(BorderFactory.createLineBorder(Color.BLACK, 2));
			txtCity = new JTextField(student.getCity());
			txtCity.setBorder(BorderFactory.createLineBorder(Color.BLACK, 2));
			txtProv = new JTextField(student.getProvince());
			txtProv.setBorder(BorderFactory.createLineBorder(Color.BLACK, 2));
			txtPostCode = new JTextField(student.getPostalCode());
			txtPostCode.setBorder(BorderFactory.createLineBorder(Color.BLACK, 2));
			txtCslAmount= new JTextField(CSLAmount);
			txtCslAmount.setBorder(BorderFactory.createLineBorder(Color.BLACK, 2));
			txtOslAmount = new JTextField(OSLAmount);
			txtOslAmount.setBorder(BorderFactory.createLineBorder(Color.BLACK, 2));
			txtInterest = new JTextField();
			txtInterest.setBorder(BorderFactory.createLineBorder(Color.BLACK, 2));
			txtAmort = new JTextField();
			txtAmort.setBorder(BorderFactory.createLineBorder(Color.BLACK, 2));
			
			//Buttons
			calcPayments = new JButton("Calculate Loan Payments");
		    calcPayments.setBorder(BorderFactory.createLineBorder(Color.BLUE,2));
		    clearFields = new JButton("Clear Fields");
		    clearFields.setBorder(BorderFactory.createLineBorder(Color.BLUE,2));
		    
		    //Register event listeners
		    clearFields.addActionListener(new clearListener());
		    calcPayments.addActionListener(new calcListener());
			
			//Add elements to the forms
			perInfoPanel.add(lblStudentNum);
			perInfoPanel.add(txtStudentNum);
			perInfoPanel.add(lblfName);
			perInfoPanel.add(txtfName);
			perInfoPanel.add(lblmName);
			perInfoPanel.add(txtmName);
			perInfoPanel.add(lbllName);
			perInfoPanel.add(txtlName);
			perInfoPanel.add(lblApartNum);
			perInfoPanel.add(txtApartNum);
			perInfoPanel.add(lblStrNum);
			perInfoPanel.add(txtStrNum);
			perInfoPanel.add(lblStrName);
			perInfoPanel.add(txtStrName);
			perInfoPanel.add(lblCity);
			perInfoPanel.add(txtCity);
			perInfoPanel.add(lblProv);
			perInfoPanel.add(txtProv);
			perInfoPanel.add(lblPostCode);
			perInfoPanel.add(txtPostCode);
		    fPanel.add(lblCslAmount);
		    fPanel.add(txtCslAmount);
		    fPanel.add(lblOslAmount);
		    fPanel.add(txtOslAmount);
		    fPanel.add(lblInterest);
		    fPanel.add(txtInterest);
		    fPanel.add(lblAmort);
		    fPanel.add(txtAmort);
		    fPanel.add(calcPayments);
		    fPanel.add(clearFields);
		
		  mainFrame.add(perInfoPanel, BorderLayout.PAGE_START);
		  mainFrame.add(fPanel, BorderLayout.PAGE_END);
		  mainFrame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		  mainFrame.setTitle("Al Lavoie's Student Loan Calculator");
		  mainFrame.setSize(425, 500);
		  mainFrame.setVisible(true);
		   
			
	}
	
	void displayPanel(){
		
		//Panel to hold the personal details of the form
		JPanel infoDisplay = new JPanel(new GridLayout(13,2,10,10));
		infoDisplay.setBorder(BorderFactory.createTitledBorder("Loan Calculations"));
		JFrame disp = new JFrame();
		disp.add(infoDisplay);
		
		next = new JButton("Next Student");
	    next.setBorder(BorderFactory.createLineBorder(Color.BLUE,2));
	   
	    
	    prev = new JButton("Previous Student");
	    prev.setBorder(BorderFactory.createLineBorder(Color.BLUE,2));
	    
		lbldisplay1 = new JLabel("Student Number: ");
		lbldisplay2 = new JLabel("Student Name: ");
		lbldisplay3 = new JLabel("Csl Amount: ");
		lbldisplay4 = new JLabel("Osl Amount: ");
		lbldisplay5 = new JLabel("Current Prime Rate: ");
		lbldisplay6 = new JLabel("Amotization Period: ");
		lbldisplay7 = new JLabel("Monthly CSL Payment: ");
		lbldisplay8 = new JLabel("Monthly Osl Payment: ");
		lbldisplay9 = new JLabel("Total Monthly Payments: ");
		lbldisplay10 = new JLabel("Total Repaid Amount: ");
		lbldisplay11 = new JLabel("Total Amount Borrowed: ");
		lbldisplay12 = new JLabel("Total Interest Paid: ");
		
		txtdispSid = new JTextField(txtStudentNum.getText());
		txtdispSid.setBorder(BorderFactory.createLineBorder(Color.BLACK, 2));
		txtdispName = new JTextField(txtfName.getText() + " " + txtmName.getText() + " " + txtlName.getText());
		txtdispName.setBorder(BorderFactory.createLineBorder(Color.BLACK, 2));
		txtdispCSL =  new JTextField(txtCslAmount.getText());
		txtdispCSL.setBorder(BorderFactory.createLineBorder(Color.BLACK, 2));
		txtdispOSL = new JTextField(txtOslAmount.getText());
		txtdispOSL.setBorder(BorderFactory.createLineBorder(Color.BLACK, 2));
		txtdispInt = new JTextField(strInt);
		txtdispInt.setBorder(BorderFactory.createLineBorder(Color.BLACK, 2));
		txtdispAmort = new JTextField(strAmort);
		txtdispAmort.setBorder(BorderFactory.createLineBorder(Color.BLACK, 2));
		txtdispMonCSLAm = new JTextField(cSlPayment);
		txtdispMonCSLAm.setBorder(BorderFactory.createLineBorder(Color.BLACK, 2));
		txtdispMonOSLAm = new JTextField(oSlPayment);
		txtdispMonOSLAm.setBorder(BorderFactory.createLineBorder(Color.BLACK, 2));
		txtdispTotMoPay = new JTextField(totalPayment);
		txtdispTotMoPay.setBorder(BorderFactory.createLineBorder(Color.BLACK, 2));
		txtdispTotAmRepay = new JTextField(grandTotal);
		txtdispTotAmRepay.setBorder(BorderFactory.createLineBorder(Color.BLACK, 2));
		txtdispToAmBor = new JTextField(borrowed);
		txtdispToAmBor.setBorder(BorderFactory.createLineBorder(Color.BLACK, 2));
		txtdispTotInt = new JTextField(totIter);
		txtdispTotInt.setBorder(BorderFactory.createLineBorder(Color.BLACK, 2));
		
		infoDisplay.add(lbldisplay1);
		infoDisplay.add(txtdispSid);
		infoDisplay.add(lbldisplay2);
		infoDisplay.add(txtdispName);
		infoDisplay.add(lbldisplay3);
		infoDisplay.add(txtdispCSL);
		infoDisplay.add(lbldisplay4);
		infoDisplay.add(txtdispOSL);
		infoDisplay.add(lbldisplay5);
		infoDisplay.add(txtdispInt);
		infoDisplay.add(lbldisplay6);
		infoDisplay.add(txtdispAmort);
		infoDisplay.add(lbldisplay7);
		infoDisplay.add(txtdispMonCSLAm);
		infoDisplay.add(lbldisplay8);
		infoDisplay.add(txtdispMonOSLAm);
		infoDisplay.add(lbldisplay9);
		infoDisplay.add(txtdispTotMoPay);
		infoDisplay.add(lbldisplay10);
		infoDisplay.add(txtdispTotAmRepay);
		infoDisplay.add(lbldisplay11);
		infoDisplay.add(txtdispToAmBor);
		infoDisplay.add(lbldisplay12);
		infoDisplay.add(txtdispTotInt);
		infoDisplay.add(prev);
		infoDisplay.add(next);
		
		//Main container
	    Container display = this.getContentPane();
	    display.setLayout(new BorderLayout(20,20));
	    display.add(infoDisplay);
	    setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		setTitle("Al Lavoie's Student Loan Application");
		setSize(425,500);
		setVisible(true);
		
	}
	
	public class calcListener implements ActionListener{
		
		@Override
		public void actionPerformed(ActionEvent e) {
			strNum = txtStudentNum.getText();
			strFirst = txtfName.getText();
			strMiddle = txtmName.getText();
			strLast = txtlName.getText();
			strApt = txtApartNum.getText();
			strStrNum = txtStrNum.getText();
			strStrName = txtStrName.getText();
			strCity = txtCity.getText();
			strProv = txtProv.getText();
			strPCode = txtPostCode.getText();
			strOsl = txtOslAmount.getText();
			strCsl = txtCslAmount.getText();
			strInt = txtInterest.getText();
			strAmort = txtAmort.getText();
			
			princOsl = Double.parseDouble(strOsl);
			princCsl = Double.parseDouble(strCsl);
			inter = Double.parseDouble(strInt);
			amrt = Integer.parseInt(strAmort);
			
			double interAddCsl = inter + 2.5;
			double interAddOsl = inter + 1.0;
			
			oslPayment = calculateLoanPayment(princOsl, interAddOsl, amrt);
			cslPayment = calculateLoanPayment(princCsl, interAddCsl, amrt);
			
			double toto = oslPayment * 60;
			double totc = cslPayment * 60;
			double grantot = Math.round((toto + totc) * 100.00) / 100.00; 
			double formatOsl = Math.round(oslPayment * 100.00 ) / 100.00;
			double formatCsl = Math.round(cslPayment * 100.00 ) / 100.00;
			double totalPay = Math.round((oslPayment + cslPayment) * 100.00) / 100.00;
			double borrowedTot = Math.round((princOsl + princCsl) * 100.00) / 100.00;
			double intPaid = Math.round((grantot - borrowedTot) * 100.00) / 100.00;
			cSlPayment = Double.toString(formatCsl);
			oSlPayment = Double.toString(formatOsl);
			totalPayment = Double.toString(totalPay);
			grandTotal = Double.toString(grantot);
			borrowed = Double.toString(borrowedTot);
			totIter = Double.toString(intPaid);
			
			
			displayPanel();
		}

	}
	
	
	public class clearListener implements ActionListener{

		@Override
		public void actionPerformed(ActionEvent e) {
			 txtStudentNum.setText("");
			 txtfName.setText("");
			 txtmName.setText("");
			 txtlName.setText("");
			 txtApartNum.setText("");
			 txtStrNum.setText("");
			 txtStrName.setText("");
			 txtCity.setText("");
			 txtProv.setText("");
			 txtPostCode.setText("");
			 txtOslAmount.setText("");
			 txtCslAmount.setText("");
			 txtInterest.setText("");
			 txtAmort.setText("");
			
		}
		
	}
	

	@Override
	public double calculateLoanPayment(double principle, double annPrimRate, int amort) {
		double pr = principle;
		double apr = annPrimRate;
		double am = amort;
		double mRate = apr * ANNUAL_RATE_TO_MONTHLY_RATE;
		
		double payment = pr * mRate * (Math.pow((1 + mRate),amrt)) / (Math.pow((1 + mRate), amrt) - 1);
		return payment;
	}
	

	public static void main(String[] args) {
		
		ArrayList<Student> students = new ArrayList<Student>();
		
		students.add(new Student("0813950", "Lavoie", "Richard", "Alain", "N/A","54", "Waterloo St. N", "Goderich", "Ontario", "N7A 2W3", 2500, 1500));
		students.add(new Student("0975648", "Smithsonian", "L", "John", "23","800", "Young St. S", "Toronto", "Ontario", "T9U 1N7", 3700, 1976));
		students.add(new Student("0654234", "Calamasisi", "Ann", "Grace", "115","1", "Adelaide St. N", "London", "Ontario", "M7F 2O9", 900, 290));
		students.add(new Student("0267895", "Groabnure", "Andrew", "Micheal", "726","76", "Baltic Ave", "Windsor", "Ontario", "B6Y 5B7", 7000, 4000));
		students.add(new Student("0584562", "McJonad", "Owen", "Mathew", "900","990", "St. James W.", "Kitchener", "Ontario", "M0K 8N6", 3400, 2000));
		student = students.get(count);
		//OSLAmount = Double.toString(student.getOslLoanAmount());
		//CSLAmount = Double.toString(student.getCslLoanAmount());
		System.out.println(students.toString());
		new StudentLoanApp();

	}

}






















