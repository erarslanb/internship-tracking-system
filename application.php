<html>
    <head>
        <b><font size="5">Companies Available for Application</font></b>
		
	<style>
		#applications {
		font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
		border-collapse: collapse;
		width: 50%;
		}
	
		#applications td, #applications th {
		border: 1px solid #ddd;
		padding: 4px;
		}
		
		#applications tr:nth-child(even){background-color: #f2f2f2;}

		#applications tr:hover {background-color: #ddd;}

		#applications th {
		padding-top: 14px;
		padding-bottom: 14px;
		text-align: left;
		background-color: #A1BAFF;
		color: white;
		font-size: 18;
		}
		
	</style>
    </head>
    <br><br>
	
 <?php 
include_once 'dbaccess.php';
	
    session_start();
	
    $sid = $_SESSION['sid'];
    $size = $_SESSION['size'];
 ?>
        <body>
        <div>
        <table id="applications">
            <tr>
                <th>Company Name</th>
                <th>City</th>
                <th>Quota</th>
            </tr>
<?php 
	$applications = mysqli_query($db, "SELECT * FROM makes");
	 $number=mysqli_num_rows($applications);
	
	if($number >0){
    $available= mysqli_query($db,"SELECT * FROM company C
 										WHERE NOT EXISTS (
											SELECT * FROM student NATURAL JOIN makes NATURAL JOIN application 
																						 NATURAL JOIN comp_appl NATURAL JOIN company
											WHERE student_id = '$sid' AND C.company_name = company_name AND C.city = city) 
										AND available_quota > 0" );
	}
	else{
	$available= mysqli_query($db,"SELECT * FROM company
 									WHERE available_quota > 0" );
	}
						
    $size=mysqli_num_rows($available) or die(); 
    $i = 0;
	
	$form = 0;
    while ($i < $size) {
            $city=mysqli_result($available, $i, "city");
            $company_name=mysqli_result($available, $i, "company_name");
            $quota=mysqli_result($available, $i, "available_quota");
			
			echo "<tr>";
            echo "<td>";
			echo $company_name;
			echo "</td><td>";
			echo $city;
			echo "</td><td>";
			echo $quota;
			echo "</td>";
			
			$form = $form + 1;
			
			echo "<td><form id= \"$form\" method=\"post\" action=\"apply.php\">
						<input name=\"company_name\" type=\"hidden\" value=\"$company_name\">
						<input name=\"city\" type=\"hidden\" value=\"$city\">
						<input name=\"submit\" type=\"submit\" value=\"Apply\">
						</form></td></tr>";		
            $i = $i + 1;

    } 
		echo "</table></div>";

        $sid = $_SESSION['sid'];
         if (isset($_SESSION['insert']) && isset($_SESSION['company_name'])){
             $temp = $_SESSION['insert'];
             $cname = $_SESSION['company_name'];
                echo" <div> <h3>";
                    if ($temp == "true"){
                        $_SESSION['insert'] = "";
                        echo "Successfully applied to: " ."$cname"."</h3>";
                    } else if ($temp == "false"){
                        $_SESSION['insert']="";
                        echo "Could not apply to: " ."$cname"." </h3>";
                    } else {}
                echo"</div>"; 
    
         }
?>
		  <div>
		  <form action="welcomeStudent.php" method="post">
		  <input type="submit" value="Back">
         </form>
		 
		  <form action="index.php" method="post">
        <input type="submit" value="Log Out">
        </form>
		  </div>

    </body>   
</html>
