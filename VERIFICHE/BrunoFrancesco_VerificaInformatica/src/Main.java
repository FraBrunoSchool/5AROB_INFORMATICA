/*
Creare un DB SQLite "agenziaMatrimoniale.db" con 2 tabelle:
- tabella Candidati: _id, nome, sesso, eta, altezza, peso
- tabella Abbinamenti: _id, _id1, _id2, giudizio1, giudizio2 (da 0 a 100%)
Mettere alcuni dati fittizi quali Paperino, Paperina, Gastone, Brigitta, Paperone, Amelia, nella tabella Candidati.
Scrivere programma console per:
- visualizzare candidati ordinati per sesso e nome, eventualmente incolonnati;
- generare i record per i possibili abbinamenti uomo-donna;
- modificare abbinamenti per immissione giudizi (uno solo oppure entrambi);
- cancellare abbinamenti con media giudizi < 50% oppure un giudizio < 25%;
- tramite una query parametrizzata trova e visualizza le coppie con una media giudizi al di sopra di un valore imputabile a tastiera.
Facoltativo: funzioni di gestione anagrafica clienti.
*/

public class Main {
    public static void main(String[] args) {
        Menu m = new Menu();
        m.menu("jdbc:sqlite:agenziaMatrimoniale.db", "org.sqlite.JDBC");
    }
}
