import java.lang.*;
import java.io.*;
import java.sql.*;

public class Main {
    static final String SQLCLASS = "org.sqlite.JDBC";
    //static final String SQLCLASS = "org.gjt.mm.mysql.Driver";
    static final String SQLURL = "jdbc:sqlite:test.db";
    //static final String SQLURL = "jdbc:mysql://localhost:3306/test"
    static final String SQLUSER = "";
    static final String SQLPWD = "";
    static Connection conn = null;
    static Statement statm = null;
    static ResultSet rs = null;




    public static void main(String[] args) {

//*******************DB*************************
            if (conn == null) {
                try{
                    Class.forName(SQLCLASS);
                    //conn = DriverManager.getConnection(SQLURL,SQLUSER,SQLPWD);
                    conn=DriverManager.getConnection(SQLURL);
                } catch (Exception ex) {
                    System.err.println(ex.getClass().getName() + " : " + ex.getMessage());
                    System.out.println("Connessione non OK, uscita programma.");
                    System.exit(0);
                }
            }
            System.out.println("In esecuzione: " + sql);
            if (sql != "") {
                try {
                    statm = conn.createStatement();
                    if (scelta == 1) {
                        rs = statm.executeQuery(sql);
                        while (rs.next())
                            System.out.println(rs.getInt("_id") + ", " + rs.getString("nome") + ", " + rs.getString("cognome") + ", " + rs.getString("citta"));
                    } else {
                        statm.execute(sql);
                        //statm.executeQuery(sql);
                    }
                } catch (Exception ex) {
                    System.err.println(ex.getClass().getName() + " : " + ex.getMessage());
                    System.out.println("Query " + sql + " ha dato eccezione");
                }
            }
        } while (scelta != 4) ;
        System.out.println("Programma terminato.");
    }
}

