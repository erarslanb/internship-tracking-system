<html>
    <head>

<?php
        include_once 'dbaccess.php';
        session_start();
 ?>

	<style>

		#reports {
		font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
		border-collapse: collapse;
		width: 50%;
		}

		#reports td, #reports th {
		border: 1px solid #ddd;
		padding: 8px;
		}

		#reports tr:nth-child(even){background-color: #f3f3f3;}

		#reports tr:hover {background-color: #ddd;}

		#reports th {
		padding-top: 12px;
		padding-bottom: 12px;
		text-align: center;
		background-color: #2f4f4f;
		color: white;
		}

    ul {
      list-style-type: none;
      margin: 0;
      padding: 0;
      overflow: hidden;
      background-color: #333;
    }

    li {
      float: left;
    }

    li a {
      display: block;
      color: white;
      text-align: center;
      padding: 14px 16px;
      text-decoration: none;
    }

    /* Change the link color to #111 (black) on hover */
    li a:hover {
      background-color: green;
    }

	</style>
    </head>
    <body>
      <div>
        <ul>
          <li><a href="welcomeInstructor.php">Reports</a></li>
          <li><a href="companies.php">Companies</a></li>
          <li><a href="students.php">Students</a></li>
          <li  style="float:right"><a href="index.php">Log Out</a></li>
          <input type="text" placeholder="Search..">
        </ul>
      </div>
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

        $id = $_SESSION['id'];
        $_SESSION['iid'] = $id;
        unset($_SESSION['sid'], $_SESSION['secid']);

        $queryLogin= mysqli_query($db, "SELECT * FROM summer_training_report
                                    NATURAL JOIN submits NATURAL JOIN student ");
        $size=mysqli_num_rows($queryLogin);

        if ($size > 0){
             $queryResult = mysqli_fetch_array($queryLogin) or die(mysqli_error());
        }

        $_SESSION['size'] = $size;
        $i = 0;
        $form = 0;

          for (; $i < $size; $i++) {
            $sid= mysqli_result($queryLogin, $i, "student_id");
            $sname=mysqli_result($queryLogin, $i, "student_name");
            $report_id=mysqli_result($queryLogin, $i, "report_id");
            $course_name=mysqli_result($queryLogin, $i, "course_name");
            $grade=mysqli_result($queryLogin, $i, "grade");

            echo "<tr>";
            echo "<td>";
            echo $report_id;
            echo "</td><td>";
            echo $sid;
            echo "</td><td>";
            echo $sname;
            echo "</td><td>";
            echo $course_name;
            echo "</td><td>";
            echo $grade;
            echo "</td>";

            $form = $form + 1;

            echo "<td><form id= \"$form\" method=\"post\" action=\"evaluation.php\">
						<input name=\"report_id\" type=\"hidden\" value=\"$report_id\">
						<input name=\"id\" type=\"hidden\" value=\"$id\">
						<input name=\"submit\" type=\"submit\" value=\"Evaluate\">
						</form></td>";

            echo "<td><a href=\"uploads/"."$sid".".pdf\"> Download </a></td></tr>";

          }
?>
        </table>
        </div>
        <br><br>
         <?php
        $id = $_SESSION['iid'];
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
