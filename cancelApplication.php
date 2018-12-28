<?php
include_once 'dbaccess.php';

    session_start();
    $sid = $_SESSION['sid'];
    $company_name =$_POST['company_name'];
	$city = $_POST['city'];
	$applID = $_POST['applID'];
	
    $deleteApplication = mysqli_query($db,"DELETE FROM application WHERE appl_id = '$applID' ");
	
    if ($deleteApplication){
		mysqli_query($db,"UPDATE company SET available_quota = available_quota+1 
											WHERE company_name = '$company_name' AND city = '$city';");
        echo("Application successfully canceled.");
		header("Location: welcomeStudent.php");
    }else {
		echo ("Something went wrong.");
    }
?> 
