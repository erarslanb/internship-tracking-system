<html>
    <head>

<?php
			include_once 'dbaccess.php';
            session_start();
            $id = $_SESSION['id'];
            $_SESSION['secid'] = $id;
            unset($_SESSION['sid'], $_SESSION['iid']);


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
        <li><a href="companies.php">Companies</a></li>
        <li><a href="students.php">Students</a></li>
        <li><a href="decideApplication.php">Applications</a></li>
        <li  style="float:right"><a href="index.php">Log Out</a></li>
      </ul>
    </div>

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

			$companies= mysqli_query($db, "SELECT * FROM company");

      $size=mysqli_num_rows($companies);

      $_SESSION['size'] = $size;
      $i = 0;
			$form = 0;

      $_SESSION['secid'] = $id;
			if($size >0){
        for (; $i < $size; $i++) {

					$city=mysqli_result($companies, $i, "city");
					$company_name=mysqli_result($companies, $i, "company_name");
					$quota=mysqli_result($companies, $i, "available_quota");
          $phone = mysqli_result($companies,$i,"phone");
          $address = mysqli_result($companies,$i,"address");


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
							<input name=\"submit\" type=\"submit\" value=\"Remove Company\">
							</form></td></tr>";
            }}

          echo "</table></div>";

           if (isset($_SESSION['add']) && isset($_SESSION['company_name'])){
               $temp = $_SESSION['add'];
               $cname = $_SESSION['company_name'];
                  echo" <div> <h3>";
                      if ($temp == "true"){
                          $_SESSION['add'] = "";
                          echo "Successfully added " ."$cname"." to the database."."</h3>";
                      }else if ($temp == "false"){
                          $_SESSION['add']="";
                          echo "Could not add " ."$cname"." to the database."." </h3>";
                          echo $_SESSION['add'];
                      }

          echo"</div>";
          }
  ?>
              <div>
      			 <p>&nbsp;</p>
                 <?php $link = '<a href="addCompany.php'. "\""; echo("$link".'>Add a New Company</a>');?>
              </div>
              <div>
                <br></br>
      			    <form action="index.php" method="post">
      				    <input type="submit" value="Log Out">
      			    </form>
              </div>
          </body>
      </html>
