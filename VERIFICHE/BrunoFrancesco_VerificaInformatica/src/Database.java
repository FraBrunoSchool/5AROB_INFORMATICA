import java.sql.*;
import java.util.Vector;

public class Database {
    private String URL;
    private String driver;
    private int iResult;
    private Connection con;
    private ResultSet result;


    public Database(String URL, String driver) {
        this.URL = URL;
        this.driver = driver;
        this.iResult = 0;
        this.con = null;
        this.result = null;
    }

    public Vector<String> execute_query(String query){
        try {
            Class.forName(driver);
        } catch (ClassNotFoundException e) {
            e.printStackTrace();
            System.out.println("Driver non trovato");
        }
        try {
            this.con = DriverManager.getConnection(URL);
            System.out.println("Connessione fatta.");
        } catch (SQLException throwables) {
            throwables.printStackTrace();
            System.out.println("Errore di connessione.");
        }
        Vector<String> result = new Vector<String>();
        if (this.con != null) {
            try {
                Statement stat = this.con.createStatement();
                System.out.println("Query: " + query);
                this.result = stat.executeQuery(query);
                result = print_query_result();
                this.con.close();
            } catch (SQLException e) {
                e.printStackTrace();
                System.out.println("Errore di esecuzione query.");
            }
        }
        return result;
    }

    public String execute_update(String query){
        try {
            Class.forName(driver);
        } catch (ClassNotFoundException e) {
            e.printStackTrace();
            System.out.println("Driver non trovato");
        }
        try {
            this.con = DriverManager.getConnection(URL);
            System.out.println("Connessione fatta.");
        } catch (SQLException throwables) {
            throwables.printStackTrace();
            System.out.println("Errore di connessione.");
        }
        if (this.con != null) {
            try {
                Statement stat = this.con.createStatement();
                System.out.println("Query: " + query);
                this.iResult = stat.executeUpdate(query);
                this.con.close();
            } catch (SQLException e) {
                e.printStackTrace();
                System.out.println("Errore di esecuzione query.");
            }
        }
        return "Record aggiunti: " + String.valueOf(iResult);
    }

    private Vector<String> print_query_result() throws SQLException {
        ResultSetMetaData rsmd = this.result.getMetaData();
        Vector<String> result = new Vector();
        int columnsNumber = rsmd.getColumnCount();
        String ColumnName = "";
        for (int i = 1; i <= columnsNumber; i++) {
            ColumnName += "-" + rsmd.getColumnName(i);
        }
        result.add(ColumnName);
        while (this.result.next()) {
            String resultLine = "";
            for (int i = 1; i <= columnsNumber; i++) {
                String columnValue = this.result.getString(i);
                resultLine += "-" + columnValue;
            }
            result.add(resultLine);
        }

        return result;
    }
}

