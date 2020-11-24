import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.time.LocalDate;
import java.util.GregorianCalendar;
import java.util.Vector;

public class Menu {

    public void menu(String URL, String driver) throws ValoreNonRange {
        Database db = new Database(URL, driver);
        boolean ricarica=true;
        while(ricarica) {
            menuGrafico();
            int n= 0;
            try {
                n = Tastiera.leggiIntero("Inserisci numero per sceglire l'opzione del menù", 0, 5);
            } catch (ValoreNonRange valoreNonRange) {
                valoreNonRange.printStackTrace();
            }
            ricarica = false;
            /*
            - visualizzare "titolo, autore, nVoti";
            - inserire voti;
            - modificare voti;
            - cancellare voti.
            */
            switch (n){
                case 0:
                    // Esci
                    ricarica=false;
                    break;
                case 1:
                    // visualizzare
                    visualizza(db);
                    ricarica=true;
                    break;
                case 2:
                    // inserire voti
                    inserisci(db);
                    ricarica=true;
                    break;
                case 3:
                    // modificare voti
                    modifica(db);
                    ricarica=true;
                    break;
                case 4:
                    // cancellare voti
                    cancella(db);
                    ricarica=true;
                    break;
                case 5:
                    // Ricarica menù
                    ricarica=true;
                    break;
            }
            // System.out.println("\n\nElementi del magazzino: \n" + s.toString());
        }
    }

    private void visualizza(Database db) {
        Vector<String> result =  db.execute_query("SELECT Libri.titolo, Libri.autore, Voti.nVoti FROM Libri, Voti WHERE Libri._id = Voti.id_libro");
        //System.out.println(result);
        for (String v: result) {
            String print = "";
            int cont = 0;
            for (String el: v.split("-")) {
                if (cont < 1 || (v.split("-")).length - 1 == cont) print += el;
                else print += el + ", ";
                cont++;
            }
            System.out.println(print);
        }
    }

    private void inserisci(Database db) throws ValoreNonRange {
        visualizzaUpdate(db);
        String nome_libro = Tastiera.readString("Inserisci il nome del libro a cui inserire dei voti");
        int n_voti = Tastiera.leggiIntero("Inserisci n_voti del libro: " + nome_libro, 0, 999999999);
        db.execute_update("INSERT INTO Voti (nVoti, id_libro) VALUES ("+ n_voti +", (SELECT _id FROM Libri WHERE titolo = '" + nome_libro +"'));");
        visualizza(db);
    }

    private void visualizzaUpdate(Database db) {
        Vector<String> result =  db.execute_query("SELECT Voti.*, Libri.titolo, Libri.autore FROM Libri, Voti WHERE Libri._id = Voti.id_libro");
        System.out.println(result);
        for (String v: result) {
            String print = "";
            int cont = 0;
            for (String el: v.split("-")) {
                if (cont < 1 || (v.split("-")).length - 1 == cont) print += el;
                else print += el + ", ";
                cont++;
            }
            System.out.println(print);
        }
    }

    private void modifica(Database db) throws ValoreNonRange {
        visualizzaUpdate(db);
        int voti_id = Tastiera.leggiIntero("Inserisci _id di voiti che vuoi modificare: ", 0, 999999999);
        int n_voti = Tastiera.leggiIntero("Inserisci n_voti del libro con: " + voti_id, 0, 999999999);
        db.execute_update("UPDATE Voti SET nVoti = " + n_voti + " WHERE _id = " + voti_id);
        visualizza(db);
    }

    // ON UPDATE CASCADE ON DELETE SET NULL

    private void cancella(Database db) throws ValoreNonRange {
        visualizzaUpdate(db);
        int voti_id = Tastiera.leggiIntero("Inserisci _id di voiti che vuoi eliminare: ", 0, 999999999);
        db.execute_update("DELETE FROM Voti WHERE _id = " + voti_id);
        visualizza(db);
    }

    public void menuGrafico(){
        System.out.println("MENU:");
        System.out.println("\t0. Esci");
        System.out.println("\t1. visualizzare \"titolo, autore, nVoti\"");
        System.out.println("\t2. inserire voti");
        System.out.println("\t3. modificare voti");
        System.out.println("\t4. cancellare voti");
        System.out.println("\t5. Ricarica menù");
    }
}