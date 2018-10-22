public class Controller {

	public static void main(String[] args) {



		String fileName = "numbers";

		
		
		Goldbach goldbach  = new Goldbach();
		TextUserInterface TUI = new TextUserInterface(goldbach);
		
		TUI.getFileName(fileName);
	}
}
