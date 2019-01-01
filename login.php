<?php

include_once 'dbaccess.php';
    session_start();

    $id='';
    $password='';
        $sid= $_POST['id'];
        $password= $_POST['pass'];
		$_SESSION['sid'] = $sid;
        $_SESSION['password'] = $password;
        $queryLoginSt= mysqli_query($db, "SELECT student_id
																FROM student
																WHERE student_id= '$sid' AND password='$password'");


        $rowNumSt = mysqli_num_rows($queryLoginSt);

		$queryLoginInst= mysqli_query($db, "SELECT employee_id
																FROM instructor
																WHERE employee_id= '$sid' AND password='$password'");

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
