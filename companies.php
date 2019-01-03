<html>
    <head>
<?php
			include_once 'dbaccess.php';
            session_start();


 ?>
	<style>
		#companies {
		font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
		border-collapse: collapse;
		width: 50%;
		}

		#companies td, #companies th {
		border: 1px solid #ddd;
		padding: 8px;
		}

		#companies tr:nth-child(even){background-color: #f3f3f3;}

		#companies tr:hover {background-color: #ddd;}

		#companies th {
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
          <?php if(isset($_SESSION['sid'])){?>
          <li><a href="welcomeStudent.php">My Applications</a></li>
          <li><a href="companies.php">Companies</a></li>
          <li  style="float:right"><a href="welcomeStudent.php">Back</a></li>
          <li  style="float:right"><a href="index.php">Log Out</a></li>
        <?php } else if( isset($_SESSION['iid'])){?>
          <li><a href="welcomeInstructor.php">Reports</a></li>
          <li><a href="companies.php">Companies</a></li>
          <li><a href="students.php">Students</a></li>
          <li  style="float:right"><a href="welcomeInstructor.php">Back</a></li>
          <li  style="float:right"><a href="index.php">Log Out</a></li>
        <?php } else if( isset($_SESSION['secid'])){ ?>
          <li><a href="companies.php">Companies</a></li>
          <li><a href="students.php">Students</a></li>
          <li  style="float:right"><a href="welcomeSecretary.php">Back</a></li>
          <li  style="float:right"><a href="index.php">Log Out</a></li>
        <?php }else{?>
          <li><a href="companies.php">Companies</a></li>
          <li  style="float:right"><a href="index.php">Log In</a></li>
        <?php }?>
        </ul>
      </div>
        <div>
				<p>&nbsp;</p>
            <table id="companies" >
                <tr>
                    <th>Name</th>
                    <th>City</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Quota</th>
                </tr>
                <form action="companies.php" method = "get">
                <input type ="checkbox" name="city1" value = "Ankara" onchange="document.getElementById('formName').submit()">Limit to Companies in Ankara</input>
                <br></br>
                <input type="text" placeholder="Search.." name="searchname">
                <button type="submit"><value="searchname"><i class="fa fa-search"></i></button>
            </form>
<?php
include_once 'dbaccess.php';

			$companies= mysqli_query($db, "SELECT * FROM company");

      $searchcity = "";

      if(isset($_GET['city1']))
        $companies  = mysqli_query($db, "SELECT * FROM ankaracompanies");

      if(isset($_GET['searchname'])){
        $searchname = $_GET['searchname'];
        if(isset($_GET['city1'])){
          $companies = mysqli_query($db, "SELECT * FROM ankaracompanies WHERE company_name LIKE '%$searchname%'");
        }else
      $companies = mysqli_query($db, "SELECT * FROM company WHERE company_name LIKE '%$searchname%'");
      }

      $size=mysqli_num_rows($companies);

      $_SESSION['size'] = $size;
      $i = 0;
			$form = 0;

			if($size >0){
        for (; $i < $size; $i++) {

					$city=mysqli_result($companies, $i, "city");
					$company_name=mysqli_result($companies, $i, "company_name");
					$phone=mysqli_result($companies, $i, "company_phone");
          $address=mysqli_result($companies, $i, "address");
          $quota=mysqli_result($companies, $i, "available_quota");

          echo "<tr>";
					echo "<td>";
					echo $company_name;
					echo "</td><td>";
					echo $city;
					echo "</td><td>";
					echo $phone;
          echo "</td><td>";
          echo $address;
          echo "</td><td>";
          echo $quota;
					echo "</td>";

            }}

?>
            </table>
        </div>
        <br><br>
        <div>
        <!-- Load icon library -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</div>
        <div>
			<form action="index.php" method="post">
				<input type="submit" value="Log Out">
			</form>
        </div>
    </body>
</html>
