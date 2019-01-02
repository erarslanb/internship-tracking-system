
<?php
include_once 'dbaccess.php';

    session_start();
    $sid = $_SESSION['sid'];
	$coursename = $_POST['COURSENAME'];





	$report = mysqli_query($db,"INSERT INTO summer_training_report(course_name) VALUES('$coursename') ");
	$xxx = mysqli_query($db,"SELECT report_id FROM summer_training_report ORDER BY report_id DESC LIMIT 0,1 ");
	$reportID = mysqli_result($xxx,0,"report_id");
	$temp = (int)$reportID;
	mysqli_query($db,"INSERT INTO submits VALUES('$sid', $temp) ");

	header('Location: welcomeStudent.php');
?>
