public class Controller {

	public static void main(String[] args) {
		
		Goldbach goldbach  = new Goldbach();
		TextUserInterface TUI = new TextUserInterface(goldbach);
		
		while(true){
			TUI.prompt();
		}
	}
}
