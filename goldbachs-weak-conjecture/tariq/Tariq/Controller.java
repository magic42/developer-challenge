import java.io.File;
import java.io.FileNotFoundException;

public class Controller {

	public static void main(String[] args) {
		
		String fileName = "numbers";
		
		Goldbach goldbach  = new Goldbach();
		TextUserInterface TUI = new TextUserInterface(goldbach);

		File numberFile = new File(fileName);
		
		TUI.parseFile(numberFile);
	}
}
