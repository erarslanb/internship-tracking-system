import java.sql.*;

public class DatabaseAccess {
    
    private static Statement statement = null;
    private static ResultSet resultSet = null;

    public static void main(String[] args) {
        try {

            Connection connection = DriverManager.getConnection("jdbc:mysql://localhost:3306/batuhan_erarslan?useUnicode=true&useLegacyDatetimeCode=false&serverTimezone=Turkey","root","");

            System.out.println("Connected Successfully");

            statement = connection.createStatement();
            
            statement.executeUpdate("DROP TABLE IF EXISTS comp_appl ;");
            statement.executeUpdate("DROP TABLE IF EXISTS makes ;");
            statement.executeUpdate("DROP TABLE IF EXISTS submits ;");
            statement.executeUpdate("DROP TABLE IF EXISTS evaluates ;");
            statement.executeUpdate("DROP TABLE IF EXISTS summer_training_report ;");
            statement.executeUpdate("DROP TABLE IF EXISTS company;");
            statement.executeUpdate("DROP TABLE IF EXISTS student ;");
            statement.executeUpdate("DROP TABLE IF EXISTS instructor ;");
            statement.executeUpdate("DROP TABLE IF EXISTS secretary ;");
            statement.executeUpdate("DROP TABLE IF EXISTS employee ;");
            statement.executeUpdate("DROP TABLE IF EXISTS application;");
            
            statement.executeUpdate("CREATE TABLE employee(" +
                    "employee_id INT," +
                    "employee_name VARCHAR(50)," +
                    "phone CHAR(10), " +
                    "email VARCHAR(255) NOT NULL UNIQUE," +
                    "password VARCHAR(50) NOT NULL,"+
                    "PRIMARY KEY (employee_id) " +
                    ")ENGINE=InnoDB;");
            
            statement.executeUpdate("CREATE TABLE instructor(" +
                    "employee_id INT REFERENCES employee(employee_id)," +
                    "employee_name VARCHAR(50) REFERENCES employee(employee_name)," +
                    "phone CHAR(10) REFERENCES employee(phone), " +
                    "email VARCHAR(255) NOT NULL UNIQUE REFERENCES employee(email)," +
                    "password VARCHAR(50) NOT NULL REFERENCES employee(password),"+
                    "n_of_students INT NOT NULL DEFAULT 0," +
                    "PRIMARY KEY (employee_id)" +
                    ")ENGINE=InnoDB;");
            
            statement.executeUpdate("CREATE TABLE secretary(" +
                    "employee_id INT REFERENCES employee(employee_id)," +
                    "employee_name VARCHAR(50) REFERENCES employee(employee_name)," +
                    "phone CHAR(10) REFERENCES employee(phone), " +
                    "email VARCHAR(255) NOT NULL UNIQUE REFERENCES employee(email)," +
                    "password VARCHAR(50) NOT NULL REFERENCES employee(password),"+
                    "PRIMARY KEY (employee_id) " +
                    ")ENGINE=InnoDB;");

            statement.executeUpdate("CREATE TABLE student(" +
                    "student_id INT NOT NULL," +
                    "student_name VARCHAR(50)," +
                    "student_status CHAR(15), " +
                    "gpa FLOAT," +
                    "password VARCHAR(50) NOT NULL,"+
                    "PRIMARY KEY (student_id) " +
                    ")ENGINE=InnoDB;");

            statement.executeUpdate("CREATE TABLE application (" + 
            		"appl_id INT NOT NULL AUTO_INCREMENT," + 
            		"appl_date DATE NOT NULL DEFAULT '2019-01-01'," + 
            		"status VARCHAR( 20 ) NOT NULL DEFAULT 'PENDING'," + 
            		"PRIMARY KEY (appl_id)" +
                    ")ENGINE=InnoDB;");
            
            statement.executeUpdate("ALTER TABLE application AUTO_INCREMENT=400000;");
            
            statement.executeUpdate("CREATE TABLE summer_training_report("+
            		"report_id INT NOT NULL AUTO_INCREMENT," +
            		"course_name VARCHAR(10) NOT NULL,"+
            		"grade VARCHAR(3) NOT NULL DEFAULT 'N/A'," +
            		"PRIMARY KEY (report_id)" +
            		")ENGINE=InnoDB;");
            
            statement.executeUpdate("ALTER TABLE summer_training_report AUTO_INCREMENT=300000;");
            

            statement.executeUpdate("CREATE TABLE submits("+
            		"student_id INT NOT NULL,"+
            		"report_id INT NOT NULL,"+
            		"FOREIGN KEY (student_id) REFERENCES student(student_id) ON DELETE CASCADE,"+
            		"FOREIGN KEY (report_id) REFERENCES summer_training_report(report_id) ON DELETE CASCADE,"+
            		"PRIMARY KEY (report_id)"+
            		")ENGINE=InnoDB;");
            
            statement.executeUpdate("CREATE TABLE evaluates("+
            		"report_id INT NOT NULL,"+
            		"employee_id INT NOT NULL,"+
            		"eval_status VARCHAR(3) NOT NULL," +
            		"FOREIGN KEY (employee_id) REFERENCES employee(employee_id) ON DELETE CASCADE,"+
            		"FOREIGN KEY (report_id) REFERENCES summer_training_report(report_id) ON DELETE CASCADE,"+
            		"PRIMARY KEY (report_id)"+
            		")ENGINE=InnoDB;");

            statement.executeUpdate("CREATE TABLE makes("+
            		"student_id INT NOT NULL,"+
            		"appl_id INT NOT NULL,"+
            		"FOREIGN KEY (student_id) REFERENCES student(student_id) ON DELETE CASCADE,"+
            		"FOREIGN KEY (appl_id) REFERENCES application(appl_id) ON DELETE CASCADE,"+
            		"PRIMARY KEY (appl_id)"+
            		")ENGINE=InnoDB;");
            
            statement.executeUpdate("CREATE TABLE company(" +
                    "company_name VARCHAR(50) NOT NULL," +
                    "city VARCHAR(20) NOT NULL," +
                    "company_phone CHAR(12) NOT NULL UNIQUE, " +
                    "address VARCHAR(100), " +
                    "available_quota INT NOT NULL DEFAULT 0," +
                    "PRIMARY KEY (company_name, city)" +
                    ")ENGINE=InnoDB;");

            statement.executeUpdate("CREATE TABLE comp_appl("+
            		"appl_id INT NOT NULL ,"+
            		"company_name VARCHAR(50) NOT NULL," +
            		"city VARCHAR(20) NOT NULL," +
            		"FOREIGN KEY (appl_id) REFERENCES application(appl_id) ON DELETE CASCADE," +
            		"FOREIGN KEY (company_name, city) REFERENCES company(company_name, city) ON DELETE CASCADE," +
            		"PRIMARY KEY (appl_id)" +
            		")ENGINE=InnoDB;");
            
            statement.executeUpdate("INSERT INTO student(student_id, student_name, student_status, gpa, password)" +
                    "VALUES ('21000001','Ayse', 'Satisfactory', 2.6, 'aysepass')," +
                    " 		('21000002','Ali' , 'Satisfactory', 3.4, 'alipass')," +
                    " 		('21000003','Veli', 'Probation',    1.8, 'velipass')," +
                    " 		('21000004','John', 'Satisfactory', 2.9, 'johnpass' )");
            
            statement.executeUpdate("INSERT INTO instructor(employee_id, employee_name, phone, email, password)" +
                    "VALUES ('31000001','Ozgur',  '5321113335',  'ozgur@bilkent.edu.tr',   'ozgurpass' )," +
                    " 		('31000002','Arif' , '5355364321', 'arif@bilkent.edu.tr',  'arifpass' )");
            
            statement.executeUpdate("INSERT INTO summer_training_report(course_name, grade)" +
                    "VALUES	('CS299', DEFAULT(grade))," +
                    "	 	('CS299', DEFAULT(grade))," +
                    " 		('CS299', DEFAULT(grade))," +
                    "		('CS399', DEFAULT(grade))");
            
            statement.executeUpdate("INSERT INTO submits(student_id, report_id)" +
                    "VALUES	('21000001', 300003)," +
                    "	 	('21000002', 300001)," +
                    " 		('21000003', 300002)," +
                    "		('21000004', 300000)");

            statement.executeUpdate("INSERT INTO application(appl_id, appl_date, status)" +
                    "VALUES (DEFAULT(appl_id), DEFAULT(appl_date)   , DEFAULT(status))," +
                    "	 	(DEFAULT(appl_id), DEFAULT(appl_date)   , DEFAULT(status))," +
                    "	 	(DEFAULT(appl_id), DEFAULT(appl_date)   , DEFAULT(status))," +
                    "	 	(DEFAULT(appl_id), DEFAULT(appl_date)   , DEFAULT(status))," +
                    "	 	(DEFAULT(appl_id), DEFAULT(appl_date)   , DEFAULT(status))," +
                    "		(DEFAULT(appl_id), DEFAULT(appl_date)   , DEFAULT(status))");
            
            statement.executeUpdate("INSERT INTO company(company_name, city, company_phone, address, available_quota)" +
                    "VALUES ('tubitak',        'Ankara'   , '5321111111', '', 3)," +
                    "	 	('aselsan',        'Ankara'   , '5321111112', '', 5)," +
                    " 		('havelsan',       'Ankara'   , '5321111113', '', 7)," +
                    " 		('microsoft',      'Istanbul' , '5321111114', '', 2)," +
                    " 		('merkez bankasi', 'Istanbul' , '5321111115', '', 10)," +
                    " 		('tai',            'Ankara'   , '5321111116', '', 4)," +
                    "		('milsoft',        'Istanbul' , '5321111117', '', 1)");

            
//            statement.executeUpdate("INSERT INTO comp_appl(appl_id, company_phone)" +
//                    "VALUES	('21000001', 300003)," +
//                    "	 	('21000002', 300001)," +
//                    " 		('21000003', 300002)," +
//                    "		('21000004', 300000)");
           
            

//            statement.executeUpdate("INSERT INTO apply(sid, cid)" +
//                    "VALUES ('21000001','C101' )," +
//                    "		('21000001','C102' )," +
//                    " 		('21000001','C103' )," +
//                    " 		('21000002','C101' )," +
//                    " 		('21000002','C105' )," +
//                    " 		('21000003','C104' )," +
//                    " 		('21000003','C105' )," +
//                    " 		('21000004','C107' )");
            
            
//            String[] companies = {"C101", "C102", "C103", "C104", "C105", "C106", "C107"};
//            
//            for(int i=0 ; i<companies.length; i++) {
//            	            
//            ResultSet rs1 = statement.executeQuery("SELECT COUNT(sid) FROM apply WHERE cid = '" +companies[i]+"'");
//            rs1.next();
//            int count1 = rs1.getInt(1);
//
//            ResultSet rs2 = statement.executeQuery("SELECT quota FROM company WHERE cid = '" +companies[i]+"'");
//            rs2.next();
//            int count2 = rs2.getInt(1);
//
//            statement.executeUpdate("UPDATE company SET quota = '" +(count2-count1)+ "' WHERE cid = '" +companies[i]+"'");
//            }

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

}