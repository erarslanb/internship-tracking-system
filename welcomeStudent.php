<html>
    <head>
          <font size="6">Welcome</font>
 
<?php 
            session_start();  
            $username = $_SESSION['username'];
            $_SESSION['username'] = "$username";
			echo " <font size=6>$username</font>";

 ?> 
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
		padding-top: 12px;
		padding-bottom: 12px;
		text-align: left;
		background-color: #A1BAFF;
		color: white;
		}
		
	</style>
    </head>
    <body>
        <div>
				<p>&nbsp;</p>
            <table id="applications" >
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Quota</th>
                </tr>
<?php
include_once 'dbaccess.php';
	
                        $sid = $_SESSION['sid'];
                        $_SESSION['sid'] = "$sid";

                        $queryLogin= mysqli_query($db, "SELECT * FROM apply NATURAL JOIN company 
																							NATURAL JOIN student WHERE sid = '$sid' ");
                        $size=mysqli_num_rows($queryLogin);
						
                        if ($size > 0){
                             $queryResult = mysqli_fetch_array($queryLogin) or die(mysqli_error());
                        }
                        $_SESSION['size'] = $size;
                        $i = 0;
                        for (; $i < $size; $i++) {
                                $cid= mysqli_result($queryLogin, $i, "cid");
                                $cname=mysqli_result($queryLogin, $i, "cname");
                                $quota=mysqli_result($queryLogin, $i, "quota");
                                ?><tr>
										<td><?php echo "$cid"?></td>
										<td><?php echo "$cname"?></td>
										<td><?php echo "$quota"?></td>
										<td><?php $link = '<a href="cancelApplication.php?row=' . "$cid" . "\""; echo("$link".'>Cancel Application</a>');?></th>
                              </tr><?php
                        }
?>
            </table>
        </div>
        <br><br>
        <div>
			 <p>&nbsp;</p>
           <?php $link = '<a href="application.php'. "\""; echo("$link".'>Apply For New Company</a>');?>
        </div>
        <div>
			<form action="index.php" method="post">
				<input type="submit" value="Log Out">
			</form>
        </div>
    </body>   
</html>

