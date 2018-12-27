<?php
include_once 'dbaccess.php';

    session_start();
    $cid = $_POST['cid'];
    $sid = $_SESSION['sid'];
    $size = $_SESSION['size'];
    $_SESSION['cid'] = $cid;
    $nOfApplications= mysqli_query($db, "SELECT COUNT(*) AS count FROM apply AS A WHERE A.sid = '$sid' "); 
    $result = mysqli_fetch_array($nOfApplications) or die(mysqli_error($db));
    
    if ($result['count'] < 3){
        $insertApplication= mysqli_query($db,"INSERT INTO apply VALUES ('$sid', '$cid');");
        if($insertApplication){
            $_SESSION['insert'] = "true";
			mysqli_query($db,"UPDATE company SET quota = quota-1 WHERE cid = '$cid';");
            header("Location: application.php");
        } else {
            $_SESSION['insert'] = "false";
            header("Location: application.php");
        }
    } else {
?> <head> 
		<?php 
		echo ("You have already applied to a maximum number of 3 companies ");
        ?>
	<br><br> 
</head>
        <form action="welcome.php" method="post">
        <input type="submit" value="Home">
        </form><?php       
    }
?> 
