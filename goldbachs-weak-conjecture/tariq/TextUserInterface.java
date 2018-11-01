import java.util.Scanner;
import java.io.File;
import java.io.FileNotFoundException;

/**
 * The Class TextUserInterface.
 */
public class TextUserInterface {

	/** The input. */
	private Scanner input;
	
	/** The goldbach. */
	private Goldbach goldbach;
	
	/** The dumb count. */
	private int dumbCount;
	
	/**
	 * Instantiates a new text user interface.
	 *
	 * @param goldbach the goldbach
	 */
	public TextUserInterface(Goldbach goldbach){
		input = new Scanner(System.in);
		this.goldbach =  goldbach;
		dumbCount = 0;
	}
	
	/**
	 * Prompts the user to type something in
	 */
	public void prompt(){
		
		display(menu());
		
		String userInput = input.nextLine().trim();
		
		switch (userInput){
		
		case "1" : 
			display("Enter the file name and make sure it is in the numbersDirectory folder");
			try{
				String fileName = "numbersDirectory/" + input.nextLine().trim();
				File numberFile = new File(fileName);
				parseFile(numberFile);
			}
			catch(Exception e) {
				display("file could not be found, check your spelling or something");
			}
			
			break;
		case "2" :
			display(rules());
			String numberInput = input.nextLine().trim();
			try{
				int number = Integer.parseInt(numberInput);
				display(goldbach.findSum(number));
			}
			catch(Exception e) {
				display(error());
				dumbCount++;
				rules();
			}
			break;
		default:
			display(error());
			dumbCount++;
			break;
		}
	}
	
	/**
	 * Displays the string given in.
	 *
	 * @param info the info
	 */
	private void display(String info) {
		System.out.println(info);
	}
	
	/**
	 * returns the list of options
	 *
	 * @return the string
	 */
	public String menu(){
		String menu = "Welcome, Choose what mode you would like to use:\n" +
				"1: parse through the given file to see the sum in primes for many numbers \n" +
				"2: Enter a single number to see find it's sum in primes ";	
		return menu;
		
	}
	
	/**
	 * Rules that determine a valid number
	 *
	 * @return the string
	 */
	public String rules(){
		String rules = "Enter a number that is:\n" +
				"- Greater than 5 \n" +
				"- An Odd Number \n" +
				"- A whole number";
		return rules;
	}
	
	/**
	 * Error.
	 *
	 * @return the string
	 */
	public String error(){
		if(dumbCount <= 2) {
			return "Mate, could I have  proper number, please\n";	
		}
		else if (5 >= dumbCount && dumbCount >= 3){
			return "You're not very bright are you? See your keyboard yeah, "
				+ "press one of the numbers then enter\n";
		}
		else {
			return "You are absolutely hopeless, end this program now.\n";
		}
	}
	
	/**
	 * Parses the file.
	 *
	 * @param numberFile the number file
	 */
	public void parseFile(File numberFile){
		
		try {
			Scanner inputStream = new Scanner(numberFile);// load file into scanner
			while (inputStream.hasNext()) {
				
				String numberData = inputStream.nextLine();
				try{
					int number = Integer.parseInt(numberData);
					display(goldbach.findSum(number) + " = " + number);
				}
				catch(Exception e){
					display(error());
				}	
			}
			inputStream.close();
		}
		catch(FileNotFoundException e){
			e.printStackTrace();
		}
	}
	
	
}
