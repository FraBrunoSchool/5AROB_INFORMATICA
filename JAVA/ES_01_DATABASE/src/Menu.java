import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;

public class Menu {

    static void Show() {
        InputStreamReader r = new InputStreamReader(System.in);
        BufferedReader br = new BufferedReader(r);
        String sql = null;
        int scelta = 0;
        do {
            System.out.println("Gestione database");
            System.out.println("=================");
            System.out.println("Premi 1 per visualizzare tutti i record.");
            System.out.println("Premi 2 per aggiungere nuovo record.");
            System.out.println("Premi 3 per cancellare un record.");
            System.out.println("Premi 4 per uscire.");
            System.out.println("Immettere scelta:");
            try {
                scelta = Integer.parseInt(br.readLine());
            } catch (IOException e) {
                System.out.println("Scelta non riconosciuta");
            }
            switch (scelta) {
                case 1: //visualizza tutti i record
                    sql = "SELECT * FROM impiegati;";
                    break;
                case 2: //aggiungi nuovo record
                    System.out.println("Immetti nome:");
                    String nome = null;
                    try {
                        nome = br.readLine();
                    } catch (IOException e) {
                        System.out.println("Errore in immissione nome.");
                        nome = "errore";
                    }
                    System.out.println("Immetti cognome:");
                    String cognome = null;
                    try {
                        cognome = br.readLine();
                    } catch (IOException e) {
                        System.out.println("Errore in immissione cognome.");
                        cognome = "errore";
                    }
                    System.out.println("Immetti città :");
                    String citta = null;
                    try {
                        citta = br.readLine();
                    } catch (IOException e) {
                        System.out.println("Errore in immissione città.");
                        citta = "errore";
                    }
                    sql = "INSERT INTO impiegati (nome, cognome, citta ) VALUES ('" + nome + "', '" + cognome + "', '" + citta + "' );";
                    break;
                case 3: //cancella record specifico
                    int s = 0;
                    System.out.println("Immetti ID record da cancellare:");
                    try {
                        s = Integer.parseInt(br.readLine());
                    } catch (IOException e) {
                        System.out.println("Errore in immissione ID record.");
                        s = 0;
                    }
                    if (s == 0) {
                        System.out.println("Numero record non valido.");
                        sql = "";
                    } else {
                        sql = "DELETE FROM impiegati WHERE _id = " + s + " ;";
                    }
                    break;
                case 4: //uscire dal programma
                    sql = "";
                    break;
            }
        }while (scelta != 4);
    }
}

