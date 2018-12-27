import java.sql.*;

public class DatabaseAccess {
    
    private static Statement statement = null;
    private static ResultSet resultSet = null;

    public static void main(String[] args) {
        try {

            Connection connection = DriverManager.getConnection("jdbc:mysql://localhost:3306/batuhan_erarslan?useUnicode=true&useLegacyDatetimeCode=false&serverTimezone=Turkey","root","");

            System.out.println("Connected Successfully");

            statement = connection.createStatement();
            
            statement.executeUpdate("DROP TABLE IF EXISTS submits ;");
            statement.executeUpdate("DROP TABLE IF EXISTS summer_training_report ;");
            statement.executeUpdate("DROP TABLE IF EXISTS apply;");
            statement.executeUpdate("DROP TABLE IF EXISTS company;");
            statement.executeUpdate("DROP TABLE IF EXISTS student ;");
            statement.executeUpdate("DROP TABLE IF EXISTS instructor ;");

            
            statement.executeUpdate("CREATE TABLE student(" +
                    "sid INT NOT NULL," +
                    "sname VARCHAR(50)," +
                    "telno CHAR(10), " +
                    "scity VARCHAR(20)," +
                    "year CHAR(20)," +
                    "gpa FLOAT," +
                    "PRIMARY KEY (sid) " +
                    ")ENGINE=InnoDB;");
            
            statement.executeUpdate("CREATE TABLE employee(" +
                    "employee_id INT," +
                    "employee_name VARCHAR(50)," +
                    "telno CHAR(10), " +
                    "icity VARCHAR(20)," +
                    "email VARCHAR(255) NOT NULL UNIQUE," +
                    "password VARCHAR(50) NOT NULL,"+
                    "PRIMARY KEY (iid) " +
                    ")ENGINE=InnoDB;");
            
            statement.executeUpdate("CREATE TABLE instructor(" +
                    "iid INT," +
                    "iname VARCHAR(50)," +
                    "telno CHAR(10), " +
                    "icity VARCHAR(20)," +
                    "email VARCHAR(255) NOT NULL UNIQUE," +
                    "password VARCHAR(50) NOT NULL,"+
                    "PRIMARY KEY (iid) " +
                    ")ENGINE=InnoDB;");
            
            statement.executeUpdate("CREATE TABLE secretary(" +
                    "iid INT," +
                    "iname VARCHAR(50)," +
                    "telno CHAR(10), " +
                    "icity VARCHAR(20)," +
                    "email VARCHAR(255) NOT NULL UNIQUE," +
                    "password VARCHAR(50) NOT NULL,"+
                    "PRIMARY KEY (iid) " +
                    ")ENGINE=InnoDB;");

            statement.executeUpdate("CREATE TABLE company(" +
                    "cid CHAR(12)," +
                    "cname VARCHAR(20)," +
                    "quota INT, " +
                    "PRIMARY KEY (cid) " +
                    ")ENGINE=InnoDB;");

            statement.executeUpdate("CREATE TABLE apply(" +
                    "sid INT NOT NULL," +
                    "cid CHAR(8)," +
                    "PRIMARY KEY (sid, cid), " +
                    "FOREIGN KEY (sid) REFERENCES student(sid) ON DELETE CASCADE," +
                    "FOREIGN KEY (cid) REFERENCES company(cid) ON DELETE CASCADE" +
                    ")ENGINE=InnoDB;");
            
            statement.executeUpdate("CREATE TABLE summer_training_report("+
            		"report_id INT NOT NULL AUTO_INCREMENT," +
            		"course_name VARCHAR(10) NOT NULL,"+
            		"grade VARCHAR(3) NOT NULL DEFAULT 'N/A'," +
            		"PRIMARY KEY (report_id)" +
            		")ENGINE=InnoDB;");
            
            statement.executeUpdate("ALTER TABLE summer_training_report AUTO_INCREMENT=300000;");

            statement.executeUpdate("CREATE TABLE submits("+
            		"sid INT NOT NULL,"+
            		"report_id INT NOT NULL,"+
            		"FOREIGN KEY (sid) REFERENCES student(sid) ON DELETE CASCADE,"+
            		"FOREIGN KEY (report_id) REFERENCES summer_training_report(report_id) ON DELETE CASCADE,"+
            		"PRIMARY KEY (report_id)"+
            		")ENGINE=InnoDB;");



            statement.executeUpdate("INSERT INTO student(sid, sname, telno, scity, year, gpa)" +
                    "VALUES ('21000001','Ayse', '5321113333', 'Ankara' ,   'senior',   '2.75' )," +
                    " 		('21000002','Ali' , '5355361234', 'Istanbul' , 'junior',   '3.44' )," +
                    " 		('21000003','Veli', '5553214455', 'Istanbul' , 'freshman', '2.36' )," +
                    " 		('21000004','John', '5335336622', 'Chicago' ,  'freshman', '2.55' )");
            
            statement.executeUpdate("INSERT INTO instructor(iid, iname, telno, icity, email, password)" +
                    "VALUES ('31000001','Ozgur',  '5321113335', 'Ankara' ,   'ozgur@bilkent.edu.tr',   'ozgurpass' )," +
                    " 		('31000002','Arif' , '5355364321', 'Istanbul' , 'arif@bilkent.edu.tr',  'arifpass' )");
            
            statement.executeUpdate("INSERT INTO summer_training_report(course_name, grade)" +
                    "VALUES	('CS299', DEFAULT(grade))," +
                    "	 	('CS299', DEFAULT(grade))," +
                    " 		('CS299', DEFAULT(grade))," +
                    "		('CS399', DEFAULT(grade))");
            
            statement.executeUpdate("INSERT INTO submits(sid, report_id)" +
                    "VALUES	('21000001', 300003)," +
                    "	 	('21000002', 300001)," +
                    " 		('21000003', 300002)," +
                    "		('21000004', 300000)");

            statement.executeUpdate("INSERT INTO company(cid, cname, quota)" +
                    "VALUES ('C101', 'tubitak',        '2' )," +
                    "	 	('C102', 'aselsan',        '5' )," +
                    " 		('C103', 'havelsan',       '3' )," +
                    " 		('C104', 'microsoft',      '5' )," +
                    " 		('C105', 'merkez bankasi', '3' )," +
                    " 		('C106', 'tai',            '4' )," +
                    "		('C107', 'milsoft',        '2' )");

            statement.executeUpdate("INSERT INTO apply(sid, cid)" +
                    "VALUES ('21000001','C101' )," +
                    "		('21000001','C102' )," +
                    " 		('21000001','C103' )," +
                    " 		('21000002','C101' )," +
                    " 		('21000002','C105' )," +
                    " 		('21000003','C104' )," +
                    " 		('21000003','C105' )," +
                    " 		('21000004','C107' )");
            
            
            String[] companies = {"C101", "C102", "C103", "C104", "C105", "C106", "C107"};
            
            for(int i=0 ; i<companies.length; i++) {
            	            
            ResultSet rs1 = statement.executeQuery("SELECT COUNT(sid) FROM apply WHERE cid = '" +companies[i]+"'");
            rs1.next();
            int count1 = rs1.getInt(1);

            ResultSet rs2 = statement.executeQuery("SELECT quota FROM company WHERE cid = '" +companies[i]+"'");
            rs2.next();
            int count2 = rs2.getInt(1);

            statement.executeUpdate("UPDATE company SET quota = '" +(count2-count1)+ "' WHERE cid = '" +companies[i]+"'");
            }

            resultSet = statement.executeQuery("SELECT * FROM student;");
            ResultSetMetaData rsmd = resultSet.getMetaData();
            int columnsNumber = rsmd.getColumnCount();
            while (resultSet.next()) {
                for (int i = 1; i <= columnsNumber; i++) {
                    if (i > 1) System.out.print(",  ");
                    String columnValue = resultSet.getString(i);
                    System.out.print(columnValue + " " + rsmd.getColumnName(i));
                }
                System.out.println("");
            }


        } catch (SQLDataException e) {
            System.out.println("SQLState: " + e.getSQLState());
            System.out.println("VendorError: " + e.getErrorCode());
            System.out.println(" Not Connected");

        } catch (Exception e) {
            // handle any errors
            System.out.println("Not Connected");
            System.out.println("Exception: " + e.getMessage());

        }
    }

	private static void AUTO_INCREMENT(int i, int j) {
		// TODO Auto-generated method stub
		
	}
}