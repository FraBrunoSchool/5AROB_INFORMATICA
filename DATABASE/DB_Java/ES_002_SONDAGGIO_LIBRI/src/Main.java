/*
    Esercizio di preparazione alla verifica di laboratorio
    ======================================================
    Creare un DB SQLite "sondaggioLibri.db" con 2 tabelle:
    - tabella Libri: _id, titolo, autore
    - tabella Voti: _id, nVoti, id_libro
    Mettere alcuni dati fittizi.
    Scrive programma console per:
    - visualizzare "titolo, autore, nVoti";
    - inserire voti;
    - modificare voti;
    - cancellare voti.
    Buon lavoro !
*/

public class Main {
    public static void main(String[] args) throws ValoreNonRange {
        Menu m = new Menu();
        m.menu("jdbc:sqlite:sondaggiolibri.db", "org.sqlite.JDBC");
    }
}
