<html>
    <head>
<?php
			include_once 'dbaccess.php';
            session_start();


 ?>
	<style>
		#students {
		font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
		border-collapse: collapse;
		width: 50%;
		}

		#students td, #students th {
		border: 1px solid #ddd;
		padding: 8px;
		}

		#students tr:nth-child(even){background-color: #f3f3f3;}

		#students tr:hover {background-color: #ddd;}

		#students th {
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
        <?php if( isset($_SESSION['iid'])){ ?>
          <li><a href="welcomeInstructor.php">Reports</a></li>
          <li><a href="companies.php">Companies</a></li>
          <li><a href="students.php">Students</a></li>
          <li  style="float:right"><a href="welcomeInstructor.php">Back</a></li>
          <li  style="float:right"><a href="index.php">Log Out</a></li>
        <?php } else if( isset($_SESSION['secid'])){?>
          <li><a href="companies.php">Companies</a></li>
          <li><a href="students.php">Students</a></li>
          <li><a href="decideApplication.php">Applications</a></li>
          <li  style="float:right"><a href="welcomeSecretary.php">Back</a></li>
          <li  style="float:right"><a href="index.php">Log Out</a></li>
        <?php }else{?>
          <li><a href="students.php">Students</a></li>
          <li  style="float:right"><a href="index.php">Log In</a></li>
        <?php }?>
        </ul>
      </div>
        <div>
				<p>&nbsp;</p>
            <table id="students" >
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Gpa</th>
                    <th>Status</th>
                </tr>
                <form action="students.php" method = "get">
                <input type="text" placeholder="Search by Name" name="searchname">
                <button type="submit"><value="searchname"><i class="fa fa-search"></i></button>
              </form>

              <form action="students.php" method = "get">
              <input type="text" placeholder="Search by ID" name="searchid">
              <button type="submit"><value="searchname"><i class="fa fa-search"></i></button>
            </form>
<?php
include_once 'dbaccess.php';

			$students= mysqli_query($db, "SELECT * FROM student");

      if(isset($_GET['searchname'])){
        $searchname = $_GET['searchname'];
      $students = mysqli_query($db, "SELECT * FROM student WHERE student_name LIKE '%$searchname%'");
      }

      if(isset($_GET['searchid'])){
        $searchid = $_GET['searchid'];
      $students = mysqli_query($db, "SELECT * FROM student WHERE student_id LIKE '%$searchid%'");
      }

      $size=mysqli_num_rows($students);

      $_SESSION['size'] = $size;
      $i = 0;
			$form = 0;

			if($size >0){
        for (; $i < $size; $i++) {

					$sid=mysqli_result($students, $i, "student_id");
					$student_name=mysqli_result($students, $i, "student_name");
					$gpa=mysqli_result($students, $i, "gpa");
          $status=mysqli_result($students, $i, "student_status");
          echo "<tr>";
					echo "<td>";
					echo $sid;
					echo "</td><td>";
					echo $student_name;
					echo "</td><td>";
					echo $gpa;
          echo "</td><td>";
          echo $status;
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
