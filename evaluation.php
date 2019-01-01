<?php
include_once 'dbaccess.php';

    session_start();

    $_SESSION['report_id'] = $_POST['report_id'];
    $_SESSION['sid'] = $_POST['sid'];
?>

<html>
    <div>
      <form action="evaluate.php" method="post">
         Evaluation Status:  <input type="text" name="grade">
         <input type="submit" value="Update">
     </form>
    </div>
</html>
