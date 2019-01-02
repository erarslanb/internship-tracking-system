<?php
include_once 'dbaccess.php';

    session_start();
	$report_id =  $_SESSION['report_id'];
  $sid = $_SESSION['sid'];
	$grade = $_POST['grade'];
	$_SESSION['report_id'] = $report_id;

    $report= mysqli_query($db, "SELECT *FROM summer_training_report NATURAL JOIN submits
														 NATURAL JOIN student WHERE report_id = '$report_id' ");

        $evaluateReport= mysqli_query($db,"UPDATE summer_training_report SET  grade = '$grade'
																													WHERE report_id = '$report_id'");
        if($evaluateReport<50){
            $_SESSION['evaluate'] = "true";
            mysqli_query($db,"UPDATE evaluates SET eval_status = 'u' where report_id = '$report_id'");
            header("Location: welcomeInstructor.php");
        } 
        else if($evaluateReport<70){
            $_SESSION['evaluate'] = "true";
            mysqli_query($db,"UPDATE evaluates SET eval_status = 'r' where report_id = '$report_id'");
            header("Location: welcomeInstructor.php");
        }
        else  if($evaluateReport>70){
            $_SESSION['evaluate'] = "true";
            mysqli_query($db,"UPDATE evaluates SET eval_status = 's' where report_id = '$report_id'");
            header("Location: welcomeInstructor.php");
        }
        else {
            $_SESSION['evaluate'] = "false";
            header("Location: welcomeInstructor.php");
        }
?>
</head>
        <form action="welcomeInstructor.php" method="post">
        <input type="submit" value="Home">
        </form><?php

?>
