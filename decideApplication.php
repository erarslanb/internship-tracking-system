<html>
<head>
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
		text-align: center;
		background-color: #2f4f4f;
		color: white;
		font-size: 18;
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

 <?php
include_once 'dbaccess.php';

    session_start();

    $id = $_SESSION['secid'];
 ?>

        <div>
          <ul>
            <li><a href="decideApplication.php">Current Applications</a></li>
            <li><a href="Companies.php">Companies</a></li>
            <li  style="float:right"><a href="index.php">Log Out</a></li>
          </ul>
        </div>
</head>
<body>
        <br></br>

        <div>
          <b><font size="5">Current Applications Pending Approval</font></b>
        </div>

        <br></br>
        <div>
        <table id="applications">
            <tr>
                <th>Student ID</th>
                <th>Student Name</th>
                <th>Company Name</th>
                <th>City</th>
                <th>Status</th>
            </tr>
<?php
    $students = mysqli_query($db, "SELECT * FROM student");
    $stsize = mysqli_num_rows($students) or die();

    $j = 0;

    while($j < $stsize){

    $student = mysqli_result($students, $j, "student_id");

    $stID = (int)$student;

	  $applications = mysqli_query($db, "SELECT * FROM student NATURAL JOIN makes NATURAL JOIN
                                  application NATURAL JOIN comp_appl NATURAL JOIN company
                                    WHERE student_id = $stID");

    $size=mysqli_num_rows($applications) or die();
    $i = 0;

	  $form = 0;
    while ($i < $size) {
            $sid=mysqli_result($applications, $i, "student_id");
            $company_name=mysqli_result($applications, $i, "company_name");
            $city=mysqli_result($applications, $i, "city");
            $sname=mysqli_result($applications, $i, "student_name");
            $applID = mysqli_result($applications, $i, "appl_id");
            $status = mysqli_result($applications,  $i, "status");

			echo "<tr>";
      echo "<td>";
      echo $sid;
			echo "</td><td>";
      echo $sname;
			echo "</td><td>";
			echo $company_name;
			echo "</td><td>";
			echo $city;
      echo "</td><td>";
			echo $status;
			echo "</td>";

			$form = $form + 1;

      if($status <> "APPROVED"){
        $postStatus = "APPROVED";
  			echo "<td><form id=\"$form\" method=\"post\" action=\"decide.php\">
  						<input name=\"status\" type=\"hidden\" value=\"$postStatus\">
  						<input name=\"id\" type=\"hidden\" value=\"$applID\">
              <input name=\"submit\" type=\"submit\" value=\"Approve\">
  						</form></td>";
      }else{
        echo "<td><form id=\"$form\" method=\"post\" action=\"decide.php\">
  						<input name=\"status\" type=\"hidden\" value=\"\">
  						<input name=\"id\" type=\"hidden\" value=\"\">
              <button type=\"button\"disabled>Approve</button>
  						</form></td>";
      }

     if($status <> "DENIED"){
       $postStatus = "DENIED";
       echo "<td><form id= \"$form\" method=\"post\" action=\"decide.php\">
  					<input name=\"status\" type=\"hidden\" value=\"$postStatus\">
  					<input name=\"id\" type=\"hidden\" value=\"$applID\">
            <input name=\"submit\" type=\"submit\" value=\"Deny\">
  					</form></td></tr>";
    }else{
      echo "<td><form id=\"$form\" method=\"post\" action=\"decide.php\">
            <input name=\"status\" type=\"hidden\" value=\"\">
            <input name=\"id\" type=\"hidden\" value=\"\">
            <button type=\"button\"disabled>Deny</button>
            </form></td>";
    }
    $i = $i + 1;

    }
    $j = $j + 1;
  }
		echo "</table></div>";

?>
		  <div>
		  <form action="welcomeSecretary.php" method="post">
		  <input type="submit" value="Back">
      </form>

		  <form action="index.php" method="post">
        <input type="submit" value="Log Out">
        </form>
		  </div>

    </body>
</html>
