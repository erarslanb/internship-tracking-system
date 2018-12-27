<?php
include_once 'dbaccess.php';

    session_start();
    $sid = $_SESSION['sid'];
    $row =$_GET['row'];
    $deleteApplication = mysqli_query($db,"DELETE FROM apply WHERE sid = '$sid' AND cid = '$row'");
    if ($deleteApplication){
		mysqli_query($db,"UPDATE company SET quota = quota+1 WHERE cid = '$row';");
        echo("Application successfully canceled.");
    }else {
		echo ("Something went wrong.");
    }
?> 
<html>
    <form action="welcome.php" method="post">
    <input type="submit" value="Back">
    </form>
</html> 
