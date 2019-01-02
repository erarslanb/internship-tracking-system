<html>
    <head>

<?php
			include_once 'dbaccess.php';
            session_start();
            $id = $_SESSION['id'];
            $_SESSION['sid'] = $id;
            unset($_SESSION['secid'], $_SESSION['iid']);

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
          <li><a href="welcomeStudent.php">My Applications</a></li>
          <li><a href="Companies.php">Companies</a></li>
          <li  style="float:right"><a href="index.php">Log Out</a></li>
        </ul>
      </div>
        <div>
				<p>&nbsp;</p>

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
        echo "<table id=\"applications\" >
            <tr>
                <th>Name</th>
                <th>City</th>
                <th>Quota</th>
                <th>ID</th>
            </tr>";
        for (; $i < $size; $i++) {

  				$city=mysqli_result($companies, $i, "city");
  				$company_name=mysqli_result($companies, $i, "company_name");
  				$quota=mysqli_result($companies, $i, "available_quota");

          $applicationID = mysqli_query($db, "SELECT appl_id FROM company NATURAL JOIN comp_appl
                                              WHERE company_name = '$company_name'
                                              AND   city = '$city'");

          $applID = mysqli_result($applicationID, 0, "appl_id");



          echo "<tr>";
  				echo "<td>";
  				echo $company_name;
  				echo "</td><td>";
  				echo $city;
  				echo "</td><td>";
  				echo $quota;
          echo "</td><td>";
          echo $applID;
  				echo "</td>";

  				$form = $form + 1;

  				echo "<td><form id= \"$form\" method=\"post\" action=\"cancelApplication.php\">
  						<input name=\"company_name\" type=\"hidden\" value=\"$company_name\">
  						<input name=\"city\" type=\"hidden\" value=\"$city\">
  						<input name=\"applID\" type=\"hidden\" value=\"$applID\">
  						<input name=\"submit\" type=\"submit\" value=\"Cancel Application\">
  						</form></td>";

              echo "<td><form id= \"$form\" method=\"post\" action=\"addReport.php\">
        <input name=\"company_name\" type=\"hidden\" value=\"$company_name\">
        <input name=\"city\" type=\"hidden\" value=\"$city\">
        <input name=\"applID\" type=\"hidden\" value=\"$applID\">
        <input name=\"submit\" type=\"submit\" value=\"Add Report\">
        </form></td></tr>";

            }}
            else{
              echo "You don't have any applications.";
            }
?>
            </table>
        </div>
        <br><br>
        <div>
			 <p>&nbsp;</p>
       <form action="application.php" method="post">
         <input type="submit" value="Apply For a Company">
        </div>

    </body>
</html>
