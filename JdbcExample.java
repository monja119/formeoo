import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;

public class JdbcExample {
    public static void main(String[] args) {
        String jdbcUrl = "jdbc:mysql://localhost:3306/formeoo";
        String username = "user";
        String password = "password";

        try {
            Connection connection = DriverManager.getConnection(jdbcUrl, username, password);
            // Perform database operations here
            connection.close();
        } catch (SQLException e) {
            e.printStackTrace();
        }
    }
}
