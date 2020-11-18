import java.sql.*;

public class Database {
    /*
    * "jdbc:sqlite:test.db"
    * "org.sqlite.JDBC"
    */
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

    public String execute_query(String query){
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
        String print = "";
        if (this.con != null) {
            try {
                Statement stat = this.con.createStatement();
                System.out.println("Query: " + query);
                this.result = stat.executeQuery(query);
                print = print_query_result();
                this.con.close();
            } catch (SQLException e) {
                e.printStackTrace();
                System.out.println("Errore di esecuzione query.");
            }
        }
        return print;
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

    private String print_query_result() throws SQLException {
        ResultSetMetaData rsmd = this.result.getMetaData();
        String print = "";
        int columnsNumber = rsmd.getColumnCount();
        while (this.result.next()) {
            for (int i = 1; i <= columnsNumber; i++) {
                if (i > 1) print += ",  ";
                String columnValue = this.result.getString(i);
                print +=  rsmd.getColumnName(i) + " " + columnValue;
            }
            print += "\n";
        }
        return print;
    }
}
