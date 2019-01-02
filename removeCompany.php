<?php
include_once 'dbaccess.php';

    session_start();
    $company_name =$_POST['company_name'];
    $city = $_POST['city'];

    $deleteCompany = mysqli_query($db,"DELETE FROM company WHERE company_name = '$company_name' ");

     if ($deleteCompany){
		mysqli_query($db,"DELETE FROM application WHERE company_name = '$company_name'");
        echo $applID;
        echo("Application successfully canceled.");
		header("Location: welcomeSecretary.php");
    }else {
		echo ("Something went wrong.");
    }
?>
