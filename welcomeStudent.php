<html>
    <head>
          <font size="6">Welcome</font>
 
<?php 
			include_once 'dbaccess.php';
            session_start();  
            $id = $_SESSION['sid'];
            $_SESSION['sid'] = "$id";
			
			$student= mysqli_query($db, "SELECT * FROM student
																	WHERE student_id = '$id' ");
																	
			$name=mysqli_result($student, 0, "student_name");							
									
			echo " <font size=6>$name</font>";

 ?> 
	<style>
		#applications {
		font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
		border-collapse: collapse;
		width: 50%;
		}
	
		#applications td, #applications th {
		border: 1px solid #ddd;
		padding: 8px;
		}
		
		#applications tr:nth-child(even){background-color: #f2f2f2;}

		#applications tr:hover {background-color: #ddd;}

		#applications th {
		padding-top: 12px;
		padding-bottom: 12px;
		text-align: left;
		background-color: #A1BAFF;
		color: white;
		}
		
	</style>
    </head>
    <body>
        <div>
				<p>&nbsp;</p>
            <table id="applications" >
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Quota</th>
                </tr>
<?php
include_once 'dbaccess.php';
	
                        $sid = $_SESSION['sid'];
                        $_SESSION['sid'] = "$sid";

						$companies= mysqli_query($db, "SELECT * FROM student NATURAL JOIN makes NATURAL JOIN application 
																																		NATURAL JOIN comp_appl NATURAL JOIN company
																							WHERE student_id = '$sid' ");
																							
                        $size=mysqli_num_rows($companies);
						
                        $_SESSION['size'] = $size;
                        $i = 0;
						$form = 0;
						
						$applID = $_SESSION['applid'];
						if($size >0){
                        for (; $i < $size; $i++) {
							
							$city=mysqli_result($companies, $i, "city");
							$company_name=mysqli_result($companies, $i, "company_name");
							$quota=mysqli_result($companies, $i, "available_quota");
							
                            echo "<tr>";
							echo "<td>";
							echo $company_name;
							echo "</td><td>";
							echo $city;
							echo "</td><td>";
							echo $quota;
							echo "</td>";
				
							$form = $form + 1;
			
							echo "<td><form id= \"$form\" method=\"post\" action=\"cancelApplication.php\">
									<input name=\"company_name\" type=\"hidden\" value=\"$company_name\">
									<input name=\"city\" type=\"hidden\" value=\"$city\">
									<input name=\"applID\" type=\"hidden\" value=\"$applID\">
									<input name=\"submit\" type=\"submit\" value=\"Cancel Application\">
									</form></td></tr>";		
                        }}
?>
            </table>
        </div>
        <br><br>
        <div>
			 <p>&nbsp;</p>
           <?php $link = '<a href="application.php'. "\""; echo("$link".'>Apply For New Company</a>');?>
        </div>
        <div>
			<form action="index.php" method="post">
				<input type="submit" value="Log Out">
			</form>
        </div>
    </body>   
</html>

