import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.time.LocalDate;
import java.util.GregorianCalendar;

public class Menu {

    public void menu(Supermercato s){
        boolean ricarica=true;
        while(ricarica) {
            menuGrafico();
            int n= 0;
            try {
                n = Tastiera.leggiIntero("Inserisci numero per sceglire l'opzione del menù", 0, 9);
            } catch (ValoreNonRange valoreNonRange) {
                valoreNonRange.printStackTrace();
            }
            ricarica = false;
            switch (n){
                case 0:
                    // Esci
                    ricarica=false;
                    break;
                case 1:
                    // Aggiungi prodotto
                    aggiungi(s);
                    ricarica=true;
                    break;
                case 2:
                    // Ricerca prodotto per nome
                    ricercaNome(s);
                    ricarica=true;
                    break;
                case 3:
                    // Ricerca prodotto per codice
                    ricercaCodice(s);
                    ricarica=true;
                    break;
                case 4:
                    // Update prodotto
                    updateProdotto(s);
                    ricarica=true;
                    break;
                case 5:
                    // Delete prodotto
                    deleteProdotto(s);
                    ricarica=true;
                    break;
                case 6:
                    // Recupera nome e numero responsabile
                    numRespNomeResp(s);
                    ricarica=true;
                    break;
                case 7:
                    // Recupera prodotti di uno specifico reparto
                    ricercaProdottiReparto(s);
                    ricarica=true;
                    break;
                case 8:
                    // Salva su file
                    s.salvaSupermercatoCSV();
                    ricarica=true;
                    break;
                case 9:
                    // Ricarica menù
                    ricarica=true;
                    break;
            }
            System.out.println("\n\nElementi del magazzino: \n" + s.toString());
        }
    }

    public void menuGrafico(){
        System.out.println("MENU:");
        System.out.println("\t0. Esci");
        System.out.println("\t1. Aggiungi prodotto");
        System.out.println("\t2. Ricerca prodotto per nome");
        System.out.println("\t3. Ricerca prodotto per codice");
        System.out.println("\t4. Update prodotto");
        System.out.println("\t5. Delete prodotto");
        System.out.println("\t6. Recupera nome e numero responsabile");
        System.out.println("\t7. Recupera prodotti di uno specifico reparto");
        System.out.println("\t8. Salva su file");
        System.out.println("\t9. Ricarica menù");
    }

    public void aggiungi(Supermercato s){
        System.out.println("Inserisci i valori del prodotto che vuoi inserire: ");
        s.addProdotto(creaProdotto());
        System.out.println("prodotto aggiunto");
    }


    public Prodotto creaProdotto(){
        String produttore = Tastiera.readString("Inserisci il nome del produttore: ");
        String reparto = Tastiera.readString("Inserisci il nome del reparto: " +
                "(scegli tra ABBIGLIAMENTO,\n" +
                "    ALIMENTARI,\n" +
                "    ELETTRONICA,\n" +
                "    PROFUMERIA,\n" +
                "    LIBRERIA,\n" +
                "    PULIZIA,\n" +
                "    PRODOTTI_TIPICI,\n" +
                "    BIBITE)");
        String categoria = Tastiera.readString("Inserisci la categoria del prodotto: " +
                "(scegli tra UOMO,\n" +
                "    DOLCI,\n" +
                "    MONITOR,\n" +
                "    INFORMATICA,\n" +
                "    FRUTTA_VERDURA,\n" +
                "    PC_CASA,\n" +
                "    DONNA,\n" +
                "    CLASSICI)");
        String scaffale = Tastiera.readString("Inserisci il nome dello scaffale: ");
        String nomeProdotto = Tastiera.readString("Inserisci il nome del prodotto: ");
        double quantita = 1; // quantità di default minima
        try {
            quantita = Tastiera.leggiDouble("Inserisci la quantità del prodotto: ", 1, 99999999);
        } catch (ValoreNonRange valoreNonRange) {
            valoreNonRange.printStackTrace();
        }
        long codiceProdotto = 0;
        try {
            codiceProdotto = Tastiera.leggiIntero("Inserisci il codice del prodotto: ", 0, 999999999);
        } catch (ValoreNonRange valoreNonRange) {
            valoreNonRange.printStackTrace();
        }
        String unitaMisura = Tastiera.readString("Inserisci l'unità di misura:  " +
                "(scegli tra LITRI,\n" +
                "    CHILI,\n" +
                "    PEZZI)"
        );
        float prezzo = 0;
        try {
            prezzo = Tastiera.leggiFloat("Inserisci il prezzo del prodotto: ", 0, 999999999);
        } catch (ValoreNonRange valoreNonRange) {
            valoreNonRange.printStackTrace();
        }
        String taglia = Tastiera.readString("Inserisci la taglia:  ");
        float sconto = 0;
        try {
            sconto = Tastiera.leggiFloat("Inserisci lo sconto del prodotto: ", 0, 999999999);
        } catch (ValoreNonRange valoreNonRange) {
            valoreNonRange.printStackTrace();
        }
        String responsabile = Tastiera.readString("Inserisci il nome del responsabile:  ");
        String telefono = Tastiera.readString("Inserisci il numero di telefono del responsabile:  ");
        GregorianCalendar scadenza = new GregorianCalendar();
        int anno, mese, giorno;
        mese = giorno = 1; // giorno e mese di default
        anno = 1900; // anno di default
        try {
            anno = Tastiera.leggiIntero("Inserisci l'anno di scadenza del prodotto: ", 0, 999999999);
        } catch (ValoreNonRange valoreNonRange) {
            valoreNonRange.printStackTrace();
        }
        try {
            mese = Tastiera.leggiIntero("Inserisci il mese di scadenza del prodotto: ", 0, 999999999);
        } catch (ValoreNonRange valoreNonRange) {
            valoreNonRange.printStackTrace();
        }
        try {
            giorno = Tastiera.leggiIntero("Inserisci il giorno di scadenza del prodotto: ", 0, 999999999);
        } catch (ValoreNonRange valoreNonRange) {
            valoreNonRange.printStackTrace();
        }
        System.out.println("ora creo il nuovo prodotto");
        Prodotto nuovoProdotto = new Prodotto(produttore, Reparto.valueOf(reparto.toUpperCase()), Categoria.valueOf(categoria.toUpperCase()),
                scaffale, nomeProdotto, quantita, codiceProdotto, UnitaMisura.valueOf(unitaMisura.toUpperCase()),
                prezzo, taglia, sconto, responsabile, telefono, LocalDate.of(anno, mese, giorno));
        return nuovoProdotto;
    }

    public void ricercaNome(Supermercato s){
        String nome = Tastiera.readString("Inserisci il nome del prodotto che cerchi: ");
        Prodotto p = s.ricercaProdotto(nome);
        if (p == null){
            System.out.println("il prodotto non esiste");
        } else {
            System.out.println("Ecco il prodotto che cerca: " + p.toStringSave());
        }
    }

    public void ricercaCodice(Supermercato s){
        long codice = 0;
        try {
            codice = Tastiera.leggiIntero("Inserisci il codice del prodotto che cerchi: ", 0, 999999999);
        } catch (ValoreNonRange valoreNonRange) {
            valoreNonRange.printStackTrace();
        }
        Prodotto p = s.ricercaProdotto(codice);
        if (p == null){
            System.out.println("il prodotto non esiste");
        } else {
            System.out.println("Ecco il prodotto che cerca: " + p.toStringSave());
        }
    }

    public void updateProdotto(Supermercato s){
        long codice = 0;
        try {
            codice = Tastiera.leggiIntero("Inserisci il codice del prodotto che vuoi aggiornare: ", 0, 999999999);
        } catch (ValoreNonRange valoreNonRange) {
            valoreNonRange.printStackTrace();
        }
        Prodotto nuovoProdotto = creaProdotto();
        s.updateProdotto(codice, nuovoProdotto);
    }

    public void deleteProdotto(Supermercato s){
        long codice = 0;
        try {
            codice = Tastiera.leggiIntero("Inserisci il codice del prodotto che vuoi eliminare: ", 0, 999999999);
        } catch (ValoreNonRange valoreNonRange) {
            valoreNonRange.printStackTrace();
        }
        s.deleteProdotto(codice);
    }

    public void numRespNomeResp(Supermercato s){
        String reparto = Tastiera.readString("Inserisci il nome del reparto in cui cerchi il nome del responsabile: ");
        System.out.println(s.telefonoResponsabile(reparto));
    }

    public void ricercaProdottiReparto(Supermercato s){
        String reparto = Tastiera.readString("Inserisci il nome del reparto di cui vuoi sapere i prodotti: ");
        String print = "";
        for (Prodotto p : s.ricercaValoreReparto(reparto)) print += p.toStringSave() + "\n";
        System.out.println(print);
    }
}