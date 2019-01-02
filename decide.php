<?php
include_once 'dbaccess.php';

    session_start();
	$applID =  $_POST['id'];
  $secid = $_SESSION['secid'];
	$status = $_POST['status'];

  $decide= mysqli_query($db,"UPDATE application SET status = '$status'
														WHERE appl_id = '$applID'");

  $decideAppl = mysqli_query($db, "INSERT INTO decides_appl VALUES ($secid, $applID, '$status')");


  if($decide){
      $_SESSION['decide'] = "true";
      header("Location: decideApplication.php");
  } else {
      $_SESSION['decide'] = "false";
      header("Location: decideApplication.php");
  }
?>
</head>
        <form action="decideApplication.php" method="post">
        <input type="submit" value="Home">
        </form><?php

?>
