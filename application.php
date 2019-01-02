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

    $id = $_SESSION['sid'];
    $size = $_SESSION['size'];
 ?>

        <div>
          <ul>
            <li><a href="welcomeStudent.php">My Applications</a></li>
            <li><a href="Companies.php">Companies</a></li>
            <li  style="float:right"><a href="index.php">Log Out</a></li>
          </ul>
        </div>
</head>
<body>
        <br></br>

        <div>
          <b><font size="5">Companies Available for Application</font></b>
        </div>

        <br></br>
        <div>
        <table id="applications">
            <tr>
                <th>Company Name</th>
                <th>City</th>
                <th>Quota</th>
                <th></th>
            </tr>
<?php
  $available= mysqli_query($db,"SELECT * FROM company " );
  $size=mysqli_num_rows($available) or die();

  $i = 0;

	$form = 0;
    while ($i < $size) {
      $city=mysqli_result($available, $i, "city");
      $company_name=mysqli_result($available, $i, "company_name");
      $quota=mysqli_result($available, $i, "available_quota");

      $applied = mysqli_query($db, "SELECT * FROM  makes NATURAL JOIN application
                                          NATURAL JOIN comp_appl NATURAL JOIN company
                                    WHERE student_id = $id AND company_name = '$company_name' AND city = '$city'");

      $full = mysqli_query($db, "SELECT * FROM  makes NATURAL JOIN application
                                          NATURAL JOIN comp_appl NATURAL JOIN company
                                    WHERE available_quota <= 0");

      $appliednum = mysqli_num_rows($applied);

      $fullnum = mysqli_num_rows($full);

			echo "<tr>";
      echo "<td>";
			echo $company_name;
			echo "</td><td>";
			echo $city;
			echo "</td><td>";
			echo $quota;
			echo "</td>";

			$form = $form + 1;

      if($appliednum <= 0 && $fullnum <=0){
  			echo "<td><form id= \"$form\" method=\"post\" action=\"apply.php\">
  						<input name=\"company_name\" type=\"hidden\" value=\"$company_name\">
  						<input name=\"city\" type=\"hidden\" value=\"$city\">
  						<input name=\"submit\" type=\"submit\" value=\"Apply\">
  						</form></td></tr>";
      }else{
        echo "<td><form id= \"$form\" method=\"post\" action=\"apply.php\">
  						<input name=\"company_name\" type=\"hidden\" value=\"\">
  						<input name=\"city\" type=\"hidden\" value=\"\">
              <button type=\"button\"disabled>Apply</button>
  						</form></td></tr>";
      }
            $i = $i + 1;

    }
		echo "</table></div>";

        $id = $_SESSION['sid'];
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
