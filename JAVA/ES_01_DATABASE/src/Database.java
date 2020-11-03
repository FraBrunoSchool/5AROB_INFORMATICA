import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.Statement;

public class Database {

    final String SQLCLASS = "org.sqlite.JDBC";
    //static final String SQLCLASS = "org.gjt.mm.mysql.Driver";
    final String SQLURL = "jdbc:sqlite:test.db";
    //static final String SQLURL = "jdbc:mysql://localhost:3306/test"
    final String SQLUSER = "";
    final String SQLPWD = "";
    Connection conn = null;
    Statement statm = null;
    ResultSet rs = null;

}
