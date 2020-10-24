public class Main {
    public static void main(String[] args) {
        try {
            Supermercato s = new Supermercato("coop", "megazzino", "magazzino.csv");
            Menu m = new Menu();
            m.menu(s);
        }catch (Exception e){
            System.out.println("error");
        }
    }
}
