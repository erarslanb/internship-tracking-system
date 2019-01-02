<?php
include_once 'dbaccess.php';

    session_start();
    $company_name =$_POST['company_name'];
    $city = $_POST['city'];

    $deleteCompany = mysqli_query($db,"DELETE FROM company WHERE company_name = '$company_name' AND city = '$city' ");
    $deleteAdd = mysqli_query($db, "DELETE FROM adds WHERE company_name = '$company_name' AND city = '$city' ");

    $applications= mysqli_query($db, "SELECT * FROM comp_appl NATURAL JOIN application
                                   WHERE company_name = '$company_name' AND city = '$city' ");

    $size=mysqli_num_rows($applications);

    $i = 0;

    if($size > 0 && $deleteCompany){
      for (; $i < $size; $i++) {
        $applID = mysqli_result($applications, $i, 'appl_id');

		    mysqli_query($db,"DELETE FROM application WHERE appl_id = $applID");

      }
        echo("Applications successfully canceled.");
		header("Location: welcomeSecretary.php");
    }else {
    header("Location: welcomeSecretary.php");
    }
?>
