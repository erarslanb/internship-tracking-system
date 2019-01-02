<html>
    <head>
          <font size="6">Welcome</font>

<?php
			include_once 'dbaccess.php';
            session_start();
            $id = $_SESSION['sid'];
            $_SESSION['sid'] = "$id";

			$secretary= mysqli_query($db, "SELECT * FROM secretary 
																	WHERE employee_id = '$id' ");

			$name=mysqli_result($secretary, 0, "employee_name");

			echo " <font size=6>$name</font>";

 ?>

 	<style>
		#firms {
		font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
		border-collapse: collapse;
		width: 50%;
		}

		#firms td, #firms th {
		border: 1px solid #ddd;
		padding: 8px;
		}

		#firms tr:nth-child(even){background-color: #f2f2f2;}

		#firms tr:hover {background-color: #ddd;}

		#firms th {
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
            <table id="firms" >
                <tr>
                    <th>Name</th>
                    <th>City</th>
                    <th>Quota</th>
                    <th>Phone</th>
                    <th>Address</th>
                </tr>
<?php
include_once 'dbaccess.php';

            //$sid = $_SESSION['sid']; //?
           // $_SESSION['sid'] = "$sid"; //?

			$companies= mysqli_query($db, "SELECT * FROM company");

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
                $phone = mysqli_result($companies,$i,"phone");
                $address = mysqli_result($companies,$i,"address");

              /*?  $applicationID = mysqli_query($db, "SELECT appl_id FROM company NATURAL JOIN comp_appl
                                                    WHERE company_name = '$company_name'
                                                    AND   city = '$city'");*/

                //$applID = mysqli_result($applicationID, 0, "appl_id");



               /* echo "<tr>";
  							echo "<td>";
  							echo $company_name;
  							echo "</td><td>";
  							echo $city;
  							echo "</td><td>";
  							echo $quota;
                echo "</td><td>";
                echo $applID;
  							echo "</td>";
*/

                echo "<tr>";
                echo "<td>";
                echo $company_name;
                echo "</td><td>";
                echo $city;
                echo "</td><td>";
                echo $quota;
                echo "</td><td>";
                echo $phone;
                echo "</td><td>";
                echo $address;
                echo "</td>";
                
  							$form = $form + 1;

  							echo "<td><form id= \"$form\" method=\"post\" action=\"removeCompany.php\">
  									<input name=\"company_name\" type=\"hidden\" value=\"$company_name\">
  									<input name=\"city\" type=\"hidden\" value=\"$city\">
  									<input name=\"applID\" type=\"hidden\" value=\"$applID\">
  									<input name=\"submit\" type=\"submit\" value=\"Remove Company\">
  									</form></td></tr>";
                  }}
?>