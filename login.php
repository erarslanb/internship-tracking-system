<?php

include_once 'dbaccess.php';
    session_start();

    $username='';
    $password='';
        $username= $_POST['name'];
        $password= $_POST['pass'];
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
		$_SESSION['sid'] = $password;
        $queryLoginSt= mysqli_query($db, "SELECT sid
																FROM student 
																WHERE sname= '$username' AND sid='$password'");


        $rowNumSt = mysqli_num_rows($queryLoginSt);
		
		$queryLoginInst= mysqli_query($db, "SELECT iid
																FROM instructor 
																WHERE iname= '$username' AND password='$password'");
			
		$rowNumInst = mysqli_num_rows($queryLoginInst);
		

        if($rowNumSt > 0){
            echo "Successfully logged in.";
            header('Location: welcomeStudent.php');
        } else if($rowNumInst > 0){
            echo "Successfully logged in.";
            header('Location: welcomeInstructor.php');
		}else{

        ?> <html>
        <div>
           <head>"Incorrect username or password"</head>
            <form action="index.php" method="post">
                <input type="submit" value="OK!"> 
            </form>
        </div>
        </html> <?php
        }
?>   
