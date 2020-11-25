import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.util.Vector;

public class Menu {

    public void menu(String URL, String driver){
        Database db = new Database(URL, driver);
        boolean ricarica=true;
        while(ricarica) {
            menuGrafico();
            int n = 0;
            n = leggiIntero("Inserisci numero per sceglire l'opzione del menù", 0, 6);
            ricarica = false;
            switch (n) {
                case 0:
                    // Esci
                    ricarica = false;
                    break;
                case 1:
                    // visualizzare candidati ordinati per sesso e nome
                    visualizza(db);
                    ricarica = true;
                    break;
                case 2:
                    // generare i record per i possibili abbinamenti uomo-donna
                    generazione(db);
                    ricarica = true;
                    break;
                case 3:
                    // modificare abbinamenti per immissione giudizi (uno solo oppure entrambi)
                    modifica(db);
                    ricarica = true;
                    break;
                case 4:
                    // cancellare abbinamenti con media giudizi < 50% oppure un giudizio < 25%
                    cancella(db);
                    ricarica = true;
                    break;
                case 5:
                    // tramite una query parametrizzata trova e visualizza le coppie con una media giudizi al di sopra di un valore imputabile a tastiera
                    selezionePersonale(db);
                    ricarica = true;
                    break;
                case 6:
                    // Ricarica menù
                    ricarica = true;
                    break;
            }
        }
    }

    private void visualizza(Database db) {
        Vector<String> result =  db.execute_query("SELECT * FROM Candidati ORDER BY sesso, nome");
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

    private void visualizzaUpdate(Database db) {
        Vector<String> result =  db.execute_query("SELECT * FROM Abbinamenti");
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

    private void modifica(Database db){
        visualizzaUpdate(db);
        int id_mod = leggiIntero("Scegli id del record da modificare", 1, 9);
        String campo = readString("Scegli quale campo modificare tra 'giudizio1' e 'giudizio2");
        float valore = leggiFloat("Inserisi il nuovo valore del campo " + campo + " del record " + id_mod);
        db.execute_update("UPDATE Abbinamenti SET " + campo + " = " + valore + " WHERE _id = " + id_mod);
        visualizzaUpdate(db);
    }

    private void cancella(Database db){
        visualizzaUpdate(db);
        Vector<String> result = db.execute_query("SELECT _id FROM Abbinamenti WHERE ((giudizio1 + giudizio2) / 2) < 50 OR (giudizio1 < 25 OR giudizio2 <25)");
        result.remove(0);
        for (String s:result) db.execute_update("DELETE FROM Abbinamenti WHERE _id = " + (s.split("-"))[1]);
        visualizzaUpdate(db);
    }

    private void selezionePersonale(Database db){
        float valore = leggiFloat("Inserisi la media del giudizio che vuoi");
        Vector<String> result = db.execute_query("SELECT *,  ((giudizio1 + giudizio2) / 2) AS MediaGiudizi FROM Abbinamenti WHERE ((giudizio1 + giudizio2) / 2) > " + valore);
        visualizza(db);
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

    private void generazione(Database db){
        Vector<String> result = db.execute_query("Select DISTINCT Abbinamenti.* FROM Abbinamenti, Candidati WHERE Candidati.sesso <> 'F' ");
        System.out.println("Queste sono le combinazioni");
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

        int id1 = leggiIntero("inserisci id1 della candidato che vuoi aggiunere", 1, 9);
        int id2 = leggiIntero("inserisci id2 della candidato che vuoi aggiunere", 1, 9);
        float giudizio1 = leggiFloat("inserisci giudizio1'");
        float giudizio2 = leggiFloat("inserisci giudizio2'");
        db.execute_update("INSERT INTO Abbinamenti (_id1, _id2, giudizio1, giudizio2) VALUES ("+ id1 +" , "+ id2 +" , "+ giudizio1 +" , " + giudizio2 + " ));");
        visualizzaUpdate(db);
    }

    private int leggiIntero(String msg, int min, int max){
        BufferedReader tastiera = new BufferedReader(new InputStreamReader(System.in));
        int numInt = 0;
        boolean errore;
        do {
            errore = false;
            System.out.println(msg);
            try {
                numInt = Integer.parseInt(tastiera.readLine());
                if (numInt < min || numInt > max){
                    System.out.println("inserire un numero tra " + min + "e" + max);
                    continue;
                }
                errore = true;
            } catch (NumberFormatException e) {
                System.out.println("numero non valido");
            } catch (IOException e) {
                System.out.println("errore nell'input");
            }
        }while (!errore);
        return numInt;
    }

    public static float leggiFloat(String mess){
        BufferedReader tastiera = new BufferedReader(new InputStreamReader(System.in));
        float numFloat = 0;
        boolean errore;
        do {
            errore = false;
            System.out.println(mess);
            try {
                numFloat = Float.parseFloat(tastiera.readLine());
                errore = true;
            } catch (NumberFormatException e) {
                System.out.println("numero non valido");
            } catch (IOException e) {
                System.out.println("errore nell'input");
            }
        }while (!errore);
        return numFloat;
    }

    private String readString(String mess){
        BufferedReader tastiera = new BufferedReader(new InputStreamReader(System.in));
        String app = null;

        boolean errore;
        do {
            errore = false;
            System.out.println(mess);
            try {
                app = tastiera.readLine();
                errore = true;
            } catch (IOException e) {
                System.out.printf("errore di IO");
            }
        }while (!errore);

        return app;
    }

    public void menuGrafico(){
        System.out.println("MENU:");
        System.out.println("\t0. Esci");
        System.out.println("\t1. visualizzare candidati ordinati per sesso e nome");
        System.out.println("\t2. generare i record per i possibili abbinamenti uomo-donna");
        System.out.println("\t3. modificare abbinamenti per immissione giudizi (uno solo oppure entrambi)");
        System.out.println("\t4. cancellare abbinamenti con media giudizi < 50% oppure un giudizio < 25%");
        System.out.println("\t5. tramite una query parametrizzata trova e visualizza le coppie con una media giudizi al di sopra di un valore imputabile a tastiera");
        System.out.println("\t6. Ricarica menù");
    }
}
