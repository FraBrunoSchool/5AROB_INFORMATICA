/*
Utilizzando il db Fabbrica già creato, creare il progetto Java che permetta di eseguire le seguenti operazioni (già fatte per teoria)  nell'ordine:
- Per far diventare 3 il responsabile di PLFR ok
- Per eliminare il record dell'operaio  RSMR ok
- Per aumentare di 30€ lo stipendio di tutti gli operai della SedeA dei responsabili con codice A e B inseriti da tastiera ok
- Per reinserire la riga dell’operaio RSMR ok
- Codice e data assunzione degli operai/e della sede B del responsabile il cui nome e cognome viene inserito da tastiera in ordine crescente di data di assunzione
- Lo stipendio massimo degli operai della sede A, quello minimo e quello medio
- Contare gli operai/e della sede B con responsabile di codice X inserito da tastiera
*/

public class Main {
    /*
     * "jdbc:sqlite:test.db"
     * "org.sqlite.JDBC"
     */
    public static void main(String[] args) {
        Database db = new Database("jdbc:sqlite:Fabbrica.db", "org.sqlite.JDBC");
        /*
            Situazione attuale DB
        */
        System.out.println(db.execute_query("SELECT * FROM SedeA_Codice"));
        System.out.println("");
        /*
            Per far diventare 3 il responsabile di PLFR
        */
        System.out.println(db.execute_update("UPDATE SedeA_Codice SET CodR = 3 WHERE CodOperaio = 'PLFR';"));
        System.out.println("");
        /*
            Situazione attuale DB
        */
        System.out.println(db.execute_query("SELECT * FROM SedeA_Codice"));
        System.out.println("");
        /*
            Per eliminare il record dell'operaio  RSMR
        */
        System.out.println(db.execute_update("DELETE FROM SedeA_Codice WHERE CodOperaio = 'RSMR'"));
        System.out.println("");
        /*
            Situazione attuale DB
        */
        System.out.println(db.execute_query("SELECT * FROM SedeA_Codice"));
        System.out.println("");
        /*
            Per reinserire la riga dell’operaio RSMR
        */
        System.out.println(db.execute_update("INSERT INTO SedeA_Codice VALUES ('RSMR', 'F', '2020-10-30', 1000.99, 1)"));
        System.out.println("");
        /*
            Situazione attuale DB
        */
        System.out.println(db.execute_query("SELECT * FROM SedeA_Codice"));
        System.out.println("");
        /*
            Per aumentare di 30€ lo stipendio di tutti gli operai della SedeA
            dei responsabili con codice A e B inseriti da tastiera
        */
        System.out.println(db.execute_update("UPDATE SedeA_Codice SET Stipendio = Stipendio + 30 WHERE CodR  IN(1, 3)"));
        System.out.println("");
        /*
            Situazione attuale DB
        */
        System.out.println(db.execute_query("SELECT * FROM SedeA_Codice"));
        System.out.println("");
        /*
            Codice e data assunzione degli operai/e della sede B del responsabile il cui nome e cognome viene inserito da tastiera in ordine crescente di data di assunzione
        */
        System.out.println(db.execute_query("SELECT CodOperaio, Assunto_Il FROM SedeB, Responsabili WHERE CodR=CodResp AND Responsabili.Cognome = 'Fassa' AND Responsabili.Nome = 'Maria'"));
        System.out.println("");
        /*
            Lo stipendio massimo degli operai della sede A, quello minimo e quello medio
        */
        System.out.println(db.execute_query("SELECT max(SedeA.Stipendio) AS 'max', min(SedeA.Stipendio) AS 'min', avg(SedeA.Stipendio) AS 'avg' FROM SedeA"));
        System.out.println("");
        /*
            Contare gli operai/e della sede B con responsabile di codice X inserito da tastiera
        */
        System.out.println(db.execute_query("SELECT count(*) AS n_resp FROM SedeB WHERE SedeB.CodR = 1"));
        System.out.println("");
    }
}
