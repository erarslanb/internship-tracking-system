<html>
    <head>
         <h1 style = "color:black;"> <font size="6">Welcome Professor</font>
 
<?php 
            session_start();  
            $username = $_SESSION['username'];
            $_SESSION['username'] = "$username";
			echo "<font size=6>$username</font>";

 ?> 
			</h1>
	<style>

		#reports {
		font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
		border-collapse: collapse;
		width: 80%;
		}
	
		#reports td, #reports th {
		border: 1px solid #ddd;
		padding: 8px;
		}
		
		#reports tr:nth-child(even){background-color: #f2f2f2;}
		#reports tr:nth-child(odd){background-color: #C9C9C9;}
	
		#reports tr:hover {background-color: #ddd;}

		#reports th {
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
            <table id="reports" >
                <tr>
						<th>Report ID</th>
                    <th>Student ID</th>
						<th>Student Name</th>
                    <th>Course</th>
                    <th>Grade</th>
                </tr>
<?php
include_once 'dbaccess.php';
	
                        $sid = $_SESSION['sid'];
                        $_SESSION['sid'] = "$sid";

                        $queryLogin= mysqli_query($db, "SELECT * FROM summer_training_report NATURAL JOIN 
																										submits NATURAL JOIN student ");
                        $size=mysqli_num_rows($queryLogin);
						
                        if ($size > 0){
                             $queryResult = mysqli_fetch_array($queryLogin) or die(mysqli_error());
                        }
                        $_SESSION['size'] = $size;
                        $i = 0;
                        for (; $i < $size; $i++) {
                                $sid= mysqli_result($queryLogin, $i, "sid");
                                $sname=mysqli_result($queryLogin, $i, "sname");
								$report_id=mysqli_result($queryLogin, $i, "report_id");
                                $course_name=mysqli_result($queryLogin, $i, "course_name");
								$grade=mysqli_result($queryLogin, $i, "grade");
                                ?><tr>
										<td><?php echo "$report_id"?></td>
										<td><?php echo "$sid"?></td>
										<td><?php echo "$sname"?></td>
										<td><?php echo "$course_name"?></td>
										<td><?php echo "$grade"?></td>
                              </tr><?php
                        }
?>
            </table>
        </div>
         <br><br>
         <div> 
             <form action="evaluate.php" method="post">
                Report ID:  <input type="text" name="report_id">
					Grade:  <input type="text" name="grade">
                <input type="submit" value="Update Grade"> 
            </form>
         </div>
         <?php
        $sid = $_SESSION['sid'];
         if (isset($_SESSION['evaluate']) && isset($_SESSION['report_id'])){
             $temp = $_SESSION['evaluate'];
                ?>  <div>
                    <h3><?php 
                    if ($temp == "true"){
                        $_SESSION['evaluate'] = "";
                        echo "Evaluation successful.";?> </h3><?php
						header("Location: welcomeInstructor.php");
                    } else if ($temp == "false"){
                        $_SESSION['evaluate']="";
                        echo "Evaluation not successful.";?> </h3> <?php
                    } else {}?>
                </div> <?php
    
         }
?>
		 
		  <form action="index.php" method="post">
        <input type="submit" value="Log Out">
        </form>
		  </div>
    </body>   
</html>

