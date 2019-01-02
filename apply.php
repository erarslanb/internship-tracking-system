<?php
include_once 'dbaccess.php';

    session_start();
    $company_name = $_POST['company_name'];
	  $_SESSION['company_name'] = $company_name;
	  $city = $_POST['city'];
    $sid = $_SESSION['sid'];
    $size = $_SESSION['size'];

    $quotaQuery= mysqli_query($db, "SELECT * FROM company
																	WHERE company_name= '$company_name'  AND city = '$city' ");
	$currentQuota = mysqli_result($quotaQuery, 0, "available_quota");

  $quota = (int) $currentQuota;
	$string = (string) $currentQuota;

	$_SESSION['quota'] = $string;

    if ($quota >0){
    $insertApplication= mysqli_query($db,"INSERT INTO application VALUES()");
		$idQuery = mysqli_query($db, "SELECT appl_id FROM application ORDER BY appl_id DESC LIMIT 0,1");

		$temp = mysqli_result($idQuery, 0, "appl_id");
		$applID = (int)$temp;

		$_SESSION['applid'] = $applID;

		$insert = mysqli_query($db,"INSERT INTO makes(student_id, appl_id) VALUES ('$sid', '$applID');");
		$insert2= mysqli_query($db, "INSERT INTO comp_appl VALUES('$applID', '$company_name', '$city');");

        if($insert && $insert2){
            $_SESSION['insert'] = "true";
			      mysqli_query($db,"UPDATE company SET available_quota = available_quota-1
											       WHERE company_name= '$company_name'  AND city = '$city' ;");
            header("Location: application.php");
        } else {
            $_SESSION['insert'] = "false";
            header("Location: application.php");
        }
    } else {

		echo "Something went wrong. \"
		<br><br>
        <form action=\"welcomeStudent.php\" method=\"post\">
        <input type=\"submit\" value=\"Home\">
        </form> ";
    }
?>
