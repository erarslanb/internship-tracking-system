<html>
    <head>
        <b><font size="5">Companies Available for Application</font></b>
		
	<style>
		#applications {
		font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
		border-collapse: collapse;
		width: 50%;
		}
	
		#applications td, #applications th {
		border: 1px solid #ddd;
		padding: 8px;
		}
		
		#applications tr:nth-child(even){background-color: #f2f2f2;}

		#applications tr:hover {background-color: #ddd;}

		#applications th {
		padding-top: 14px;
		padding-bottom: 14px;
		text-align: left;
		background-color: #A1BAFF;
		color: white;
		font-size: 18;
		}
		
	</style>
    </head>
    <br><br>
	
 <?php 
include_once 'dbaccess.php';
	
    session_start();
	
    $sid = $_SESSION['sid'];
    $size = $_SESSION['size'];
 ?>
        <body>
        <div>
        <table id="applications">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Quota</th>
            </tr>
<?php 
    $available= mysqli_query($db,"SELECT * FROM company C 
										WHERE C.cid not in (
											SELECT A.cid from apply as A
											WHERE A.sid = $sid) AND C.quota <> '0'");
									
    $queryResult = mysqli_fetch_array($available) or die(mysqli_error());
    $size=mysqli_num_rows($available);
    $i = 0;
	
    while ($i < $size) {
            $cid=mysqli_result($available, $i, "cid");
            $cname=mysqli_result($available, $i, "cname");
            $quota=mysqli_result($available, $i, "quota");
			
            ?><tr> 
					<td><?php echo "$cid"?></td>
					<td><?php echo "$cname"?></td>
					<td><?php echo "$quota"?></td>
            </tr><?php
            $i = $i + 1;
    }
?>
        </table>
        </div>
         <br><br>
         <div> 
             <form action="apply.php" method="post">
                Company ID:  <input type="text" name="cid">
                <input type="submit" value="Apply"> 
            </form>
         </div>
         <?php
        $sid = $_SESSION['sid'];
         if (isset($_SESSION['insert']) && isset($_SESSION['cid'])){
             $temp = $_SESSION['insert'];
             $coid = $_SESSION['cid'];
                ?>  <div>
                    <h3><?php 
                    if ($temp == "true"){
                        $_SESSION['insert'] = "";
                        echo "Successfully applied to: " ."$coid";?> </h3><?php
                    } else if ($temp == "false"){
                        $_SESSION['insert']="";
                        echo "Could not apply to: " ."$coid";?> </h3> <?php
                    } else {}?>
                </div> <?php
    
         }
?>
		  <div>
		  <form action="welcome.php" method="post">
		  <input type="submit" value="Back">
         </form>
		 
		  <form action="index.php" method="post">
        <input type="submit" value="Log Out">
        </form>
		  </div>

    </body>   
</html>
